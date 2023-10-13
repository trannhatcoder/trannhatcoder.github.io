<?php 
  include 'config/constants.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>FOOD WEBSITE</title>
</head>
<body>
    <section class="top">
        <div class="container">
            <div class="rows justify-content" id="navBar">
                <div class="logo"><img src="images/logo.png"></div>
                <div class="menu-items">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#menu">Menu</a>
                          <ul class="sub-menu">
                        <?php
                          $sql = "SELECT name_category FROM tbl_category";
                          $res = mysqli_query($conn, $sql);
                          $count = mysqli_num_rows($res);
                          if($count > 0){
                            while($row=mysqli_fetch_assoc($res)){
                              $name_cat = $row['name_category'];
                              ?>
                                
                                  <li><a href=""><?php echo $name_cat; ?></a>
                                      <ul class="sub-menu">
                                        <?php
                                          $query = "SELECT foodName FROM tbl_menu INNER JOIN tbl_category ON tbl_menu.id_cat = tbl_category.id_cat";
                                          $result = mysqli_query($conn, $query);
                                          $count1 = mysqli_num_rows($result);
                                          if($count1 > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                              $foodName = $row['foodName'];
                                              ?>
                                              <li><a href=""><?php echo $foodName; ?></a></li>
                                              <?php
                                            }
                                          }
                                        ?>
                                      </ul> 
                                    </li>
                              <?php
                            }
                          }
                        ?>
                        </ul>
                        
                        </li>
                        <li><a href="#reservation">Reservation</a></li>
                        <li><a href="#aboutus">About Us</a></li>
                        <li><a href="#feedback">FeedBack</a></li>
                        <li><a href="#chef">Chef</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
            </div>
        </div>
    </section>
    