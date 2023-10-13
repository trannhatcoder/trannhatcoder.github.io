<?php include('partials/menu.php'); ?>

<script src="script-admin.js"></script>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['unauthorize'])){
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <br><br>

        

        <!-- button to add food -->
        <a href="add-food.php" class="btn-primary">Add Food</a>

        <br><br><br>

        <table class="tbl-full">

            <tr>
                <th>Food Id</th>
                <th>Food Name</th>
                <th>Image Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>

            <?php
            
                //sql
                $sql = "SELECT * FROM tbl_menu";
                //execute the query
                $res = mysqli_query($conn, $sql);

                //count row to check whether we have foods or not
                $count = mysqli_num_rows($res);

                $sn = 1;

                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        // get the values from individual columns
                        $foodId = $row['foodId'];
                        $foodName = $row['foodName'];
                        $imageName = $row['imageName'];
                        $price = $row['price'];
                        $category = $row['category'];

                        ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $foodName; ?></td>
                                <td>
                                    <?php
                                        if($imageName==""){
                                            //we do not have image, display error message
                                            echo "<div class='error'>Image not Added.</div>";
                                        }else{
                                            //we have image
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $imageName; ?>"width="100px" height="80px">
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td>$<?php echo $price; ?></td>
                                <td><?php echo $category; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?foodId=<?php echo $foodId; ?>" class="btn-secondary" onclick="return confirmUpdate()">Update</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?foodId=<?php echo $foodId; ?>&imageName=<?php echo $imageName; ?>" class="btn-danger" onclick="return confirmDelete()">Delete</a>
                                </td>
                            </tr>

                        <?php
                    }
                }else{
                    echo "<tr><td colspan='6' class='error'>Food not Added Yet.</td></tr>";
                }
            
            ?>

        </table>
        
    </div>
</div>


<?php include('partials/footer.php'); ?>