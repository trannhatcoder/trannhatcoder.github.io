<?php

    //authorization - access control
    //check whether the user is logged in or not
    if(!isset($_SESSION['user'])){//if user session is not set
        //user not loged in
        //redirect to login page with massage
        $_SESSION['no-login-message'] = "<div class='error'>Please login to access Admin Panel.</div>";
        //redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }
    
?>
