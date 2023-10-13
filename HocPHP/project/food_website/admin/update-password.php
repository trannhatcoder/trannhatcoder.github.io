<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
        ?>
    
        <form action="" method="POST">

            <label for="currentPassword">Current Password: </label>
            <input type="password" id="current_Password" name="current_password" placeholder="Current Password"><br>

            <label for="newPassword">New Password: </label>
            <input type="password" id="new_password" name="new_password" placeholder="New Password"><br>

            <label for="ConfirmPassword">Confirm Password: </label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password"><br>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button class="btn-primary" name="submit">Change Password</button>

        </form>
     
        <?php
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);
                
                //2. check whether the user with current ID and Current password exits or not
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password = '$current_password'";

                //execute the query
                $res = mysqli_query($conn, $sql);

                if($res==true){
                    $count = mysqli_num_rows($res);
                    if($count == 1){
                        if($new_password==$confirm_password){
                            $sql2 = "UPDATE tbl_admin SET
                            password = '$new_password'
                            WHERE id = '$id'
                            ";
                            //execute query
                            $res2 = mysqli_query($conn, $sql2);

                            if($res2==true){
                                $_SESSION['change-pwd'] = "<div class='success'> Password Changed Successfully.</div>";
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }else{
                                $_SESSION['change-pwd'] = "<div class='error'> Failed To Change Password!</div>";
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                        }else{
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match!</div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }else{
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found!</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>