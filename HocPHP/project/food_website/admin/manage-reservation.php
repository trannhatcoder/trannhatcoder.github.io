<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Reservation</h1>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>Id</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Date</th>
                <th>Time</th>
                <th>Number of Count</th>
                <th>Special Request</th>
            </tr>

            <?php
            
                //sql
                $sql = "SELECT * FROM tbl_reservation ORDER BY reservationId DESC";
                //execute the query
                $res = mysqli_query($conn, $sql);

                //count row to check whether we have foods or not
                $count = mysqli_num_rows($res);

                $sn = 1;

                if($count>0){
                    while($row = mysqli_fetch_assoc($res)){
                        //get the value
                        $reservationId = $row['reservationId'];
                        $customerName = $row['customerName'];
                        $phoneNumber = $row['phoneNumber'];
                        $email = $row['email'];
                        $date = $row['date'];
                        $time = $row['time'];
                        $numberOfCount = $row['numberOfCount'];
                        $specialRequest = $row['specialRequest'];

                        ?>
                            <tr>

                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $customerName; ?></td>
                                <td><?php echo $phoneNumber; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $time; ?></td>
                                <td><?php echo $numberOfCount; ?></td>
                                <td><?php echo $specialRequest; ?></td>

                            </tr>
                        <?php

                    }
                }else{
                    echo "<tr><td colspan='6' class='error'>Reservation not Order Yet.</td></tr>";
                }
            
            ?>
            
        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>