<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br><br>

        <?php
            if(isset($_SESSI0N['update'])){
                echo $_SESSI0N['update'];
                unset($_SESSI0N['update']);
            }
        ?>
        
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Food Name</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Date Time</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
                $sql = "SELECT * FROM tbl_order ORDER BY orderId DESC";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count the rows
                $count = mysqli_num_rows($res);

                $sn = 1;

                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $orderId = $row['orderId'];
                        $foodName = $row['foodName'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $dataTime = $row['dateTime'];
                        $customerName = $row['customerName'];
                        $phone = $row['phone'];
                        $email = $row['email'];   
                        $status = $row['status'];
                        
                        ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $foodName; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td>$<?php echo $total; ?></td>
                                <td><?php echo $dataTime; ?></td>
                                <td><?php echo $customerName; ?></td>
                                <td><?php echo $phone; ?></td>
                                <td><?php echo $email; ?></td>
                                <td>
                                    <?php
                                        if($status=="Pending"){
                                            echo "<lable>$status</lable>";
                                        }elseif($status=="On Delivery"){
                                            echo "<label style='color:orange'>$status</lable>";
                                        }elseif($status=="Delivered"){
                                            echo "<lable style='color:green'>$status</lable>";
                                        }elseif($status=="Cancelled"){
                                            echo "<lable style='color:red'>$status</label>";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $orderId; ?>" class="btn-secondary">Update Status</a>
                                </td>
                            </tr>
                        <?php
                    }
                }else{
                    echo "<tr><td colspan='12' class='error'>Order not Available!</td></tr>";
                }
            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>