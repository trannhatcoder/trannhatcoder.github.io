<?php
    $int_array = array();
    $only_array = array();
    $count_display = array();
    $string_new = "";

    if(isset($_POST['inp_array'])){
        $int_array = explode(",", $_POST['inp_array']);//khong dc ", " se gay ket qua khong dung
        $count_display = array_count_values($int_array);
        $only_array = array_unique($int_array);

        foreach($count_display as $key => $value){
            $string_new .= $key . ":" . $value . ", ";
        }
        $string_new = rtrim($string_new, ", "); // Loại bỏ dấu phẩy cuối cùng
    }
    function only_array($int_array){
        if(isset($int_array[0])){
            echo implode(", ", $int_array);
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đếm Số Lần Xuất Hiện</title>
</head>
<style>
    * {
        font-family: Tahoma;
    }
    table {
        width: 400px;
        margin: 100px auto;
    }
    table th {
        background: #66CCFF;
        padding: 10px;
        font-size: 18px;
    }
    input {
        width: 100%;
    }
</style>
<body>
    <form action="" method="POST">
        <table border="0">
            <thead>
                <tr>
                <th colspan="2">ĐẾM SỐ LẦN XUẤT HIỆN VÀ TẠO MẢNG DUY NHẤT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mảng:</td>
                    <td><input type="text" name="inp_array" value="<?php echo isset($_POST['int_array']) ? $_POST['int_array'] : ''; ?>" ></td>
                </tr>
                <tr>
                    <td>Số lần xuất hiện:</td>
                    <td><input type="text" name="count_display" value="<?php echo isset($string_new) ? $string_new : '';  ?>" disabled="disabled" ></td>
                </tr>
                <tr>
                    <td>Mảng duy nhất:</td>
                    <td><input type="text" name="only_array" value="<?php echo isset($only_array) ? only_array($only_array) : ''; ?>" disabled="disabled" ></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Thực hiện"></td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>
