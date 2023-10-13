<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Form Login</title>
    
</head>
<body>
    <div id="wrapper">
        <form action="" id="form-login" method="POST">
            <h1 class="form-heading">Login</h1>
            <?php
            
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            
            ?>
            
            <div class="form-group">
            <i class="fa-solid fa-user"></i>
                <input type="text" name="username" class="form-input" placeholder="Enter your name">
            </div>
            <div class="form-group">
            <i class="fa-solid fa-key"></i>
                <input type="password" name="password" class="form-input" placeholder="Enter your password">
                <div id="eye">
                <i class="fa-regular fa-eye-slash"></i>
                </div>
            </div>
            <input type="submit" name="submit" class="form-submit" value="Login">
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="app.js"></script>
</html>
<?php

    //check whether the submit button is click or not
    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        //sql to check whether the user with username and password exits or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        //3. execute the query
        $res = mysqli_query($conn, $sql);
        //4.count rows to check whether the user exits or not
        $count = mysqli_num_rows($res);
        if($count==1){
            $_SESSION['login'] = "<div class='success'>Login Succesfully.</div>";
            $_SESSION['user'] = $username;//check whether the user is logged in or not log out will unset it
            
            header('location:'.SITEURL.'admin/');
        }else{
            $_SESSION['login'] = "<div class='error'>Username or Password did not match!</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>