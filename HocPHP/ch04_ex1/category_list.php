<?php
require_once('database.php');

    // Get all categories
    $query = 'SELECT * FROM categories ORDER BY categoryID';
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();

    if(isset($_GET['categoryId'])){
        $id = $_GET['categoryId'];
        //delete category
        $query_cat = "DELETE FROM categories WHERE categoryID = '$id'";
        $statement = $db->prepare($query_cat);
        $statement->execute();
        if($statement){
            header('Location: category_list.php');
        }else{
            $smg = "Deleted Not Successfully";
            return $smg;
        }
    }

?>


<style>
    h2 {
        padding-top: 5px;
        margin-top: 20px;
    }
    label {
        font-size: 25px;
    }
    input[type="text"], input[type="submit"] {
        font-size: 20px;
    }
</style>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Product Manager</h1></header>
<main>
    <h1>Category List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>

        <!-- add code for the rest of the table here -->

        <?php foreach ($categories as $category):?>
        <tr>
            
            <td><?php echo $category['categoryName'];?></td>
            <td><a href="?categoryId=<?php echo $category['categoryID'] ?>">DELETE</a></td>
            
        </tr>
        <?php endforeach;?>

    </table>

    <h2>Add Category</h2>
    
    <!-- add code for the form here -->

    <form action="add_category.php" method="POST">
        <label for="">Name:</label>
        <input type="text" name="name">
        <input type="submit" name="submit" value="Add">
    </form>
    
    <br>
    <p><a href="index.php">List Products</a></p>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>