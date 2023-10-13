<?php include('partials-front/menu.php'); ?>

    <section class="order-food section-pading">
        <div class="container">
            <div class="row justify-content">
                <div class="section-title">
                    <h2 data-title="ORDER FORM">ORDER NOW</h2>
                </div>
            </div>
            
            <!-- <h2 class="text-center text-white">Fill this form to confirm your order.</h2> -->
            <?php
    
                //check whether food id is set or not
                if(isset($_GET['food_id'])){
                    //get the food id and details of the selected food
                    $food_id = $_GET['food_id'];

                    //get the details of the selected food
                    $sql = "SELECT * FROM tbl_menu WHERE foodId = $food_id";

                    //execute the query
                    $res = mysqli_query($conn, $sql);
                    //count rows
                    $count = mysqli_num_rows($res);
                    //check whether the data is available or not
                    if($count==1){
                        // get the data from database
                        $row = mysqli_fetch_assoc($res);
                        
                        $foodName = $row['foodName'];
                        $imageName = $row['imageName'];
                        $price = $row['price'];
                    }else{
                        //redirect to home page
                        header('location:'.SITEURL);
                    }
                }else{
                    header('location:'.SITEURL);
                }
            
            ?>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            //check whether the image is available or not
                            if($imageName==""){
                                //image not available
                                echo "<div class='error'>Image Not Add.</div>";
                            }else{
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $imageName; ?>" alt="Chicke Hawain Pizza">
                                <?php
                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-descs">
                        <h3><?php echo $foodName; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $foodName; ?>">
                        
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="orders-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Tran Nhat" class="input-responsive" required>

                    <div class="orders-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 098xxxxxxx" class="input-responsive" required>

                    <div class="orders-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. trannhat@gmail.com" class="input-responsive" required>

                    <div class="orders-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn-secondary">
                </fieldset>

            </form>

            <?php
            
                if(isset($_POST['submit'])){
                    //get all the details from  the form
                    $foodName = $_POST['food'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $dateTime = date("Y-m-d h:i:sa");
                    $status = "Pending";

                    $customerName = $_POST['full-name'];
                    $phone = $_POST['contact'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];

                    //sql
                    $sql2 = "INSERT INTO tbl_order SET
                        foodName = '$foodName',
                        qty = '$qty',
                        total = '$total',
                        dateTime = '$dateTime',
                        status = '$status',
                        customerName = '$customerName',
                        phone = '$phone',
                        email = '$email',
                        address = '$address'
                    ";
                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);
                    //check whether the query executed successfully or not
                    if($res2==true){
                        $_SESSION['order'] = "<div class='success'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }else{
                        $_SESSION['order'] = "<div class='error'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }
                }

            ?>

        </div>
    </section>

    <?php include('partials-front/footer.php'); ?>


</body>
</html>