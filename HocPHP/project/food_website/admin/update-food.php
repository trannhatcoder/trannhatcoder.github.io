<?php include('partials/menu.php'); ?>

<?php

    //check whether id is set or not
    if(isset($_GET['foodId'])){
        $foodId = $_GET['foodId'];
        //sql
        $sql = "SELECT * FROM tbl_menu WHERE foodId=$foodId";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //get the value based on query executed
        $row = mysqli_fetch_assoc($res);
        //get the individual values of selected food
        $foodName = $row['foodName'];
        $description = $row['description'];
        $price = $row['price'];
        $current_image = $row['imageName'];
        $category = $row['category'];
    }else{
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="foodId" value="<?php echo $foodId; ?>">
            <label for="foodName">Food Name: </label>
            <input type="text" name="foodName" value="<?php echo $foodName; ?>">

            <label for="description">Description: </label>
            <textarea name="description"><?php echo $description; ?></textarea>

            <label for="price">Price: </label>
            <input type="number" id="price" name="price" value="<?php echo $price; ?>"><br>

            <label for="image">Current Image: </label>
            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

            <label for="newImage">Select New Image: </label>
            <input type="file" name="image"> Maximum 2 MB<br>


            <label for="category"> Category: </label>
            <select name="category">
                <option value="Dessert" <?php if($category=="dessert") {echo "selected";} ?>>Dessert</option>
                <option value="Lunch" <?php if($category=="lunch") {echo "selected"; } ?>>Lunch</option>
                <option value="Dinner" <?php if($category=="dinner") {echo "selected"; } ?>>Dinner</option>
                <option value="Drinks" <?php if($category=="drinks") {echo "selected"; } ?>>Drinks</option>
            </select><br>

            <button class="btn-primary" name="submit">Update</button>
        </form>

        <?php
        
            if(isset($_POST['submit'])){
                //1. get all the details from the form
                $foodId = $_POST['foodId'];
                $foodName = $_POST['foodName'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                //2.upload the image if selected
                //check whether upload button is clicked or not
                if(isset($_FILES['image']['name'])){
                    //upload button clicked
                    $imageName = $_FILES['image']['name'];//new image name

                    //check whether the file is available or not
                    if($imageName != ""){
                        //rename the image
                        $ext = end(explode('.',$imageName));
                        $imageName = "Food-Name-".rand(0000,9999).".".$ext;

                        //get the source path and destination path
                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/food/".$imageName;
                        $upload = move_uploaded_file($src_path, $dest_path);

                        //chech whether the image is upload or not
                        if($upload == false){
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }

                        if($current_image != ""){
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);
                            //check whether the image is removed or not
                            if($remove==false){
                                $_SESSION['remove_failed'] = "<div class='error'>Failed to Remove current Image!</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();
                            }
                        }
                    }else{
                        $imageName = $current_image;
                    }
                }else{
                    $imageName = $current_image;
                }
                //4. Update the food in database
                $sql2 = "UPDATE tbl_menu SET
                    foodName = '$foodName',
                    description = '$description',
                    price = $price,
                    imageName = '$imageName',
                    category = '$category'
                    WHERE foodId = $foodId
                ";
                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                //check whether the query is selected or not
                if($res2==true){
                    $_SESSION['update'] = "<div class='success'>Food Update Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }else{
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food!</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>