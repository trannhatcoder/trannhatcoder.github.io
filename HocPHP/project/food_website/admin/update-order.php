<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Status</h1>
        <br><br>

        <?php
            //check whether id is set or not
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                //sql
                $sql = "SELECT * FROM tbl_order WHERE orderId = $id";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows
                $count = mysqli_num_rows($res);
                if($count==1){
                    $row = mysqli_fetch_assoc($res);
                    $status = $row['status'];
                }else{
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }else{
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">
            <label for="status">Status: </label>
            <select name="status">
                <option value="Pending"<?php if($status=="Pending") {echo "selected"; }?>>Pending</option>
                <option value="On Delivery"<?php if($status=="On Delivery") {echo "selected"; }?>>On Delivery</option>
                <option value="Delivered"<?php if($status=="Delivered") {echo "selected"; }?>>Delivered</option>
                <option value="Cancelled"<?php if($status=="Cancelled") {echo "selected"; }?>>Cancelled</option>
            </select><br>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button class="btn-primary" name="submit">Update</button>
        </form>

        <?php
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $status = $_POST['status'];
                $sql2="UPDATE tbl_order SET
                status = '$status'
                WHERE orderId = $id
                ";
                $res2 = mysqli_query($conn, $sql2);
                //check whether updated or not
                if($res2==true){
                    $_SESSI0N['update'] = "<div class='success'>Updated Status Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }else{
                    $_SESSION['update'] = "<div class='error'>Failed to Update Status!</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>