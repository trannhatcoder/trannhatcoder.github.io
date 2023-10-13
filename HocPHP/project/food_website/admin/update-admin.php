<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
        
            $id = $_GET['id'];

            //sql
            $sql = "SELECT * FROM tbl_admin WHERE id = $id";

            $res = mysqli_query($conn, $sql);

            if($res==true){
                $count = mysqli_num_rows($res);
                if($count==1){
                    $row = mysqli_fetch_assoc($res);

                    $fullname = $row['fullname'];
                    $username = $row['username'];
                }else{
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        
        ?>

        <form action="" method="POST">

            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $fullname; ?>"><br>

            <label for="username">UserName: </label>
            <input type="text" id="username" name="username" value="<?php echo $username; ?>"><br>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button class="btn-primary" name="submit">Update Admin</button>

        </form>

        <?php
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $fullname = $_POST['fullname'];
                $username = $_POST['username'];

                //sql query
                $sql2 = "UPDATE tbl_admin SET
                    fullname = '$fullname',
                    username = '$username'
                    WHERE id = '$id'
                ";
                $res2 = mysqli_query($conn,$sql2);
                if($res2==true){
                    $_SESSION['update'] = "<div class='success'>Update Admin Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }else{
                    $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>