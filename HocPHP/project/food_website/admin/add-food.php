<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['select'])){
                echo $_SESSION['select'];
                unset($_SESSION['select']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <label for="food-name">Food Name: </label>
            <input type="text" id="food-name" name="food-name"><br>

            <label for="description">Description: </label>
            <textarea name="description" id="description"></textarea><br>

            <label for="image-name">Select Image</label>
            <input type="file" name="image"> Maximum 2 MB<br>

            <label for="price">Price: </label>
            <input type="number" id="price" name="price"><br>

            <label for="category"> Category: </label>
            <select name="category" id="category">
                <option value="lunch">Lunch</option>
                <option value="dinner">Dinner</option>
                <option value="drinks">Drinks</option>
                <option value="dessert">Dessert</option>
            </select><br>

            <button class="btn-primary" name="submit">Upload</button>

        </form>

        <?php
            if(isset($_POST['submit'])){
                //get all the detail from the form
                $foodName = $_POST['food-name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
            
                //upload the image
                if(isset($_FILES['image']['name'])){
                    //get the detail of the selected image
                    $image_name = $_FILES['image']['name'];
                    //check whether the image is selected or not
                    if($image_name != "" ){
                        //rename the image
                        $ext = end(explode(".", $image_name));
                        //create new name for image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext;
                        //Upload the image
                        //source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];
                        //destination path for the image to be upload
                        $dst = "../images/food/".$image_name;

                        //finally upload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image upload or not
                        if($upload==false){
                            //redirect to add food page with error
                            $_SESSION['upload'] = "<div class=error>Failed to Upload the image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //stop the process
                            die();
                        }
                    }else{
                        $_SESSION['select'] = "<div class='error'>Please Select Image.</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        die();
                    }
                }else{
                    $image_name = "";
                }
                //insert into database
                $sql = "INSERT INTO tbl_menu SET
                    foodName = '$foodName',
                    imageName = '$image_name',
                    description = '$description',
                    price = $price,
                    category = '$category'
                ";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //check whether data insert or not
                if($res == true){
                    $_SESSION['add'] = "<div class='success'>Food Add Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }else{
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
            
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>