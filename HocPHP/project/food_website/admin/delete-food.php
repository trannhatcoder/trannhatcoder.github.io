<?php 

    include('../config/constants.php');

    if(isset($_GET['foodId']) && isset($_GET['imageName'])){
        //1. get id and image name
        $foodId = $_GET['foodId'];
        $imageName = $_GET['imageName'];

        //2. remove the image if available
        //check whether the image is available or not and delete only if available
        if($imageName!=""){
            $path = "../images/food/".$imageName;

            //remove image file from folder
            $remove = unlink($path);

            //check whether the image is removed or not
            if($remove==false){
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File!</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }
        //3. delete food from the database
        $sql = "DELETE FROM tbl_menu WHERE foodId = $foodId";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //redirect to manage food with message
        if($res==true){
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }else{
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food!</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }else{
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access!</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>