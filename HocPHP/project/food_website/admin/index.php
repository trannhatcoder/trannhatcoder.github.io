<?php include('partials/menu.php'); ?>

<script src="script-admin.js"></script>

    <!-- main content section start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>DashBoard</h1>
            <br><br>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br><br>
            <div class="col-4 text-center">
                <?php
                    $sql = "SELECT * FROM tbl_menu";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count; ?></h1>
                Foods
            </div>

            <div class="col-4 text-center">
                <?php 
                    $sql2 = "SELECT * FROM tbl_order";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2; ?></h1>
                Total Orders
            </div>

            <div class="col-4 text-center">
                <?php 
                    $sql3 = "SELECT SUM(total) AS total FROM tbl_order WHERE status = 'Delivered'";
                    $res3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_assoc($res3);
                    $total_revenue = $row3['total'];
                ?>
                <h1>$<?php echo $total_revenue; ?></h1>
                Revenue Generated
            </div>

    <div class="clearfix"></div>

        </div>
    </div>
    <!-- main content section end -->

    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        // Sử dụng Ajax để lấy các đơn hàng chưa được xử lý
        function getPendingOrders() {
            $.ajax({
                url: "get-pending-orders.php",
                success: function(data) {
                    // Nếu có đơn hàng chưa được xử lý, hiển thị thông báo
                    if(data != "") {
                        swal({
                            title: "Có đơn hàng mới cần duyệt!",
                            text: data,
                            icon: "info",
                            button: "Xem đơn hàng",
                        }).then((value) => {
                            window.location.href = "list-orders.php";
                        });
                    }
                }
            });
        }
        
        // Gọi hàm getPendingOrders() để kiểm tra các đơn hàng chưa được xử lý
        getPendingOrders();
    </script>

    <?php
        // Truy vấn cơ sở dữ liệu để lấy các đơn hàng chưa được xử lý
        $query = "SELECT * FROM tbl_order WHERE status = 'pending'";
        $result = mysqli_query($conn, $query);
        
        // Nếu có đơn hàng chưa được xử lý, hiển thị thông báo
        if(mysqli_num_rows($result) > 0) {
            echo "<div class='pending-orders'>
                    <p>Đơn hàng mới cần duyệt:</p>
                    <ul>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<li>".$row['orderId']." - ".$row['foodName']."</li>";
            }
            echo "</ul></div>";
        }
    ?> -->

    <?php include('partials/footer.php'); ?>

</body>
</html>