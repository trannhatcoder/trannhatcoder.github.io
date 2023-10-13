<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" placeholder="Enter Your Name"><br>

            <label for="username">UserName: </label>
            <input type="text" id="username" name="username" placeholder="Enter UserName"><br>

            <label for="password">PassWord: </label>
            <input type="password" name="password">

            <button class="btn-primary" name="submit">Upload</button>

        </form>

        <?php
        
            if(isset($_POST['submit'])){
                $fullname = $_POST['fullname'];
                $username = $_POST['username'];
                $password = md5($_POST['password']);

                //2.sql query to save the data into database
                $sql = "INSERT INTO tbl_admin SET
                    fullname = '$fullname',
                    username = '$username',
                    password = '$password'
                ";
                //3.execute the query 
                $res = mysqli_query($conn, $sql) or die(mysqli_error());
                //4. check whether the data is inserted or not
                if($res==true){
                    $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }else{
                    $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
                    header('location:'.SITEURL.'admin/add-admin.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>