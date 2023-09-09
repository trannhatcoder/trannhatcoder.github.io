<?php
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['discount'])){
        $product_description = filter_input(INPUT_POST, 'product_description');
        $list_price = filter_input(INPUT_POST, 'list_price');
        $discount_percent = filter_input(INPUT_POST, 'discount_percent');

        //calculator
        $discount_amount = $list_price * ($discount_percent/100);

        $discount_price = $list_price - $discount_amount;

        $list_price_fm = "$".number_format($list_price, 2);
        $discount_percent_fm = $discount_percent."%";
        $discount_amount_fm = "$".number_format($discount_amount, 2); 
        $discount_price_fm = "$".number_format($discount_price, 2);
    }
?>
<style>
    h1 {
        margin-top: 0;
        color: navy;
        text-align: center;
    }
    label {
        width: 10em;
        float: left;
        padding-right: 1em;
        padding-bottom: 0.5em;
        text-align: center;
        padding: 5px;
    }
</style>
<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>This page is under construction</h1>

        <label>Product Description:</label>
        <span><?php echo $product_description; ?></span><br>

        <label>List Price:</label>
        <span><?php echo $list_price_fm; ?></span><br>

        <label>Standard Discount:</label>
        <span><?php echo $discount_percent_fm; ?></span><br>

        <label>Discount Amount:</label>
        <span><?php echo $discount_amount_fm; ?></span><br>

        <label>Discount Price:</label>
        <span><?php echo $discount_price_fm; ?></span><br>
    </main>
</body>
</html>