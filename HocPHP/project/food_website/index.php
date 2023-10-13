<?php include('partials-front/menu.php'); ?>

    <section class="big-image">
        <div class="big-image-content">
            <h2>Nhà Hàng Thái Market</h2>
            <p>Đẳng cấp lên ngôi, vị ngọt đôi môi, niềm vui ngóng chờ giây phút mộng mơ</p>
            <a href="#menu"><button class="big-image-content-btn btn">MENU</button></a>
        </div>
        
    </section>
    
    <?php
        if(isset($_SESSION['reservation'])){
            echo $_SESSION['reservation'];
            unset($_SESSION['reservation']);
        }
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>
    <section class="about section-pading" id="aboutus">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h2 data-title="OUR STORY">ABOUT US</h2>
                </div>
            </div>
            <div class="row">
                <div class="about-item">
                    <h2>CHÀO MỪNG CÁC BẠN ĐẾN VỚI THAI MARKET</h2>
                    <p>Chào mừng đến với nhà hàng của chúng tôi! Tại đây, chúng tôi tự hào giới thiệu đến bạn một menu đa dạng với những món ăn đặc trưng của vùng miền. 
                        Với sự kết hợp của các nguyên liệu tươi ngon,các đầu bếp chuyên nghiệp của chúng tôi đã sáng tạo ra những món ăn 
                        độc đáo và ngon miệng. Bạn sẽ tìm thấy những món ăn truyền thống như phở, bún chả, bún bò Huế và các món ăn cay như thịt kho tộ, 
                        bò lúc lắc, và rau muống xào tỏi.
                    </p>
                    <a href="#menu">
                        <button class="btn">XEM MENU</button>  
                    </a>
                </div>
                <div class="about-item">
                    <img src="images/about.jpg" alt="Hình ảnh">
                    <div class="text">Hơn 10 năm kinh nghiệm</div>
                </div>  

                <!-- <div class="about-item">
                    <img src="images/menu11.jpg" alt="">
                </div>

                <div class="about-item">
                    <img src="images/menu11.jpg" alt="">
                </div> -->

            </div>
        </div>
    </section>
    <section class="menu section-pading" id="menu">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h2 data-title="ORDER NOW">OUR MENU</h2>
                </div>
            </div>

            <div class="row">

                <div class="menu-title">
                    <button class="menu-button active" data-title="lunch">Lunch</button>
                    <button class="menu-button" data-title="dinner">Dinner</button>
                    <button class="menu-button" data-title="drinks">Drinks</button>
                    <button class="menu-button" data-title="desert">Dessert</button>
                </div>

            </div>

            <?php
            
                $sql = "SELECT * FROM tbl_menu";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count row
                $count = mysqli_num_rows($res);
                //check whether food available or not
                if($count>0){
                    //food available
                    while($row = mysqli_fetch_assoc($res)){
                        //get the values
                        $foodId = $row['foodId'];
                        $foodName = $row['foodName'];
                        $imageName = $row['imageName'];
                        $description = $row['description'];
                        $price = $row['price'];

                        ?>

                            <div class="food-menu-box">
                                <div class="food-item">
                                    <?php
                                        //check whether image available or not
                                        if($imageName==""){
                                            echo "<div class='error'>Image not Available!</div>";
                                            }else{
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $imageName; ?>">
                                                <?php
                                            }
                                    ?>
                                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h3><?php echo $foodName; ?></h3>
                                    <p class="food-price">$<?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>
                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $foodId; ?>" class="btn-primary">Order Now</a>
                                </div>
                            </div>
                            
                        <?php
                        
                    }
                }else{
                    echo "<div class='error'>Food not Available!</div>";
                }
            
            ?>
            <div class="clearfix"></div>

    </section>

    <section class="reservation-food section-pading" id="reservation">
        <div class="container">
            <div class="row justify-content">
                <div class="section-title">
                    <h2 data-title="REGISTRATION">RESERVATION</h2>
                </div>
            </div>

            <form action="" method="POST" class="reservation">
                <label for="name" class="reservate">Họ tên:</label>
                <input type="text" id="name" name="name" class="input-reservate" required><br><br>
                
                <label for="phone" class="reservate">Số điện thoại:</label>
                <input type="tel" id="phone" name="phone" class="input-reservate" required><br><br>
                
                <label for="email" class="reservate">Email:</label>
                <input type="email" id="email" name="email" class="input-reservate" required><br><br>
                
                <label for="date" class="reservate">Ngày đặt bàn:</label>
                <input type="date" id="date" name="date" class="input-reservate" required><br><br>
                
                <label for="guests" class="reservate">Số lượng khách:</label>
                <input type="number" id="guests" name="guests" class="input-reservate" required><br><br>
                
                <label for="time" class="reservate">Thời gian đến:</label>
                <input type="time" id="time" name="time" class="input-reservate" required><br><br>
                
                <label for="special_requests" class="reservate">Yêu cầu đặc biệt:</label><br>
                <textarea id="special_requests" name="special_requests" rows="5" cols="40" class="input-reservate"></textarea><br><br>
                
                <input type="submit" name="submit" onclick="confirmReservationAndShowMessage()" value="Confirm Reservation" class="btn-third">

            </form>

            <?php
    
                if(isset($_POST['submit'])){
                    //echo "click";
                    //get all the details from the form
                    $customerName = $_POST['name'];
                    $phoneNumber = $_POST['phone'];
                    $email = $_POST['email'];
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $numberOfCount = $_POST['guests'];
                    $specialRequest = $_POST['special_requests'];

                    //create the sql
                    $sql = "INSERT INTO tbl_reservation SET
                        customerName = '$customerName',
                        phoneNumber = '$phoneNumber',
                        email = '$email',
                        date = '$date',
                        time = '$time',
                        numberOfCount = '$numberOfCount',
                        specialRequest = '$specialRequest'
                    ";

                    //execute the query
                    $res = mysqli_query($conn, $sql);


                    //check whether the query executed successfully or not
                    if($res == true){
                        $_SESSION['reservation'] = "<div class='success'>Reservation Successfully.</div>";
                        // header('location:'.SITEURL);
                    }else{
                        $_SESSION['reservation'] = "<div class='error'>Failed To Reservation.</div>";
                        // header('location:'.SITEURL);
                    }
                }
            
            ?>

            

        </div>
    </section>
      
    <section class="feedback section-pading" id="feedback">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h2 data-title="opinion">SOME FEEDBACK</h2>
                </div>
            </div>
            <div class="row">
                <div class="feedback-items">
                    <div class="feedback-item">
                        <div class="feedback-item-content">
                            <div class="feedback-item-img-content-text">
                                <h2>Amor Reggae</h2>
                                <p>Food Speciallist</p>
                            </div>
                            <div class="feedback-item-img-content-img">
                                <img class="img-responsive" src="images/feed2.jpg" alt="">
                            </div>
                        </div>
                        <p>
                            Thích trang nhà hàng bạn vì trang web đẹp mắt, chức năng đơn giản & tùy chỉnh món ăn tốt. 
                            Đã dùng nhiều trang web khác nhưng của bạn tốt nhất.
                        </p>
                        <div class="feedback-item-start">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>

                    <div class="feedback-item">
                        <div class="feedback-item-content">
                            <div class="feedback-item-img-content-text">
                                <h2>Urassaya Sperbund</h2>
                                <p>Food Speciallist</p>
                            </div>
                            <div class="feedback-item-img-content-img">
                                <img class="img-responsive" src="images/feed1.jpg" alt="">
                            </div>
                        </div>
                        <p>
                            Bữa tối tốt tại nhà hàng của bạn, web đẹp, dễ sử dụng, cho phép đặt bàn, tìm menu và đặt hàng trực tuyến. 
                            Sẽ sử dụng lại web của bạn cho các tiệc tối sau. 
                        </p>
                        <div class="feedback-item-start">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>

                    <div class="feedback-item">
                        <div class="feedback-item-content">
                            <div class="feedback-item-img-content-text">
                                <h2>Angelina Danilova</h2>
                                <p>Food Speciallist</p>
                            </div>
                            <div class="feedback-item-img-content-img">
                                <img class="img-responsive" src="images/feed3.jpg" alt="">
                            </div>
                        </div>
                        <p>
                            Rất hài lòng với trang web đặt món của nhà hàng của bạn vì dễ dàng và tiết kiệm thời gian. 
                            Cám ơn đội ngũ nhân viên đã hỗ trợ nhanh chóng, sẽ tiếp tục đặt món trên trang web của nhà hàng của bạn!
                        </p>
                        <div class="feedback-item-start">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>

                    <!-- <div class="feedback-item">
                        <div class="feedback-item-content">
                            <div class="feedback-item-img-content-text">
                                <h2>Angelina Danilova</h2>
                                <p>Food Speciallist</p>
                            </div>
                            <div class="feedback-item-img-content-img">
                                <img class="img-responsive" src="images/feed3.jpg" alt="">
                            </div>
                        </div>
                        <p>
                            Rất hài lòng với trang web đặt món của nhà hàng của bạn vì dễ dàng và tiết kiệm thời gian. 
                            Cám ơn đội ngũ nhân viên đã hỗ trợ nhanh chóng, sẽ tiếp tục đặt món trên trang web của nhà hàng của bạn!
                        </p>
                        <div class="feedback-item-start">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </section>

    <section class="team section-pading" id="chef">
        <div class="container">
            <div class="row">
                <div class="section-title" >
                    <h2 data-title="COLLEAGUE">OUR CHEFS</h2>
                </div>
            </div>

            <div class="row-2">
                <div class="team-items">
                    <img class="img-responsive" src="images/Test1.jpg" alt="">
                    <div class="team-items-text">
                        <h2>Michael Bảo Huỳnh</h2>
                        <span>Head Chef</span>
                    </div>
                </div>
                <div class="team-items">
                    <img class="img-responsive"  src="images/Test2.webp" alt="">
                    <div class="team-items-text">
                        <h2>Luke Nguyen</h2>
                        <span>Head Chef</span>
                    </div>
                </div>
                <div class="team-items">
                    <img class="img-responsive" src="images/Test3.jpg" alt="">
                    <div class="team-items-text">
                        <h2>Christine Ha</h2>
                        <span>Head Chef</span>
                    </div>
                </div>

                <!-- <div class="team-items">
                    <img class="img-responsive" src="images/Test3.jpg" alt="">
                    <div class="team-items-text">
                        <h2>Christine Ha</h2>
                        <span>Head Chef</span>
                    </div>
                </div> -->

            </div>

        </div>
        <div class="clearfix"></div>
    </section>

    <?php include('partials-front/footer.php'); ?>
    
    <script>
      $(document).read(function(){
        $('.sub-menu').parent('li').addClass('has-child');
      });
    </script>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</body>
</html>