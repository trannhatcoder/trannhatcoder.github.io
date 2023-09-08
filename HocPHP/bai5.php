<?php
    if(isset($_POST['a']) && isset($_POST['b']) && isset($_POST['c']) && isset($_POST['submit'])){
        $a = $_POST['a'];
        $b = $_POST['b'];
        $c = $_POST['c'];
        $delta = pow($b, 2)-4*$a*$c;
        $x1 = -$b+sqrt($delta)/2*$a;
        $x2 = -$b-sqrt($delta)/2*$a;
        if($delta > 0){
            $nghiem = "Phuong trinh co 2 nghiem phan biet: "."x1 = ".$x1." ".",x2 = ".$x2;
        }else if($delta == 0){
            $nghiem = "Phuong trinh co nghiem kep: ".(-$b/2*$a);
        }else{
            $nghiem = "Phuong trinh vo nghiem";
        }
    }
?>
<style>
    input#textfield2 {
        width: 600px;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" >
        <table width="806" border="1">
            <tr>
                <td colspan="4" bgcolor="#336699"><strong>Giải phương trình bậc 2</strong></td>
            </tr>
            <tr>
                <td width="83">Phương trình </td>
                <td width="236">
                    <input name="a" type="text" /> X^2 + 
                </td>
                <td width="218">
                    <label for="textfield3"></label>
                    <input type="text" name="b" id="textfield3" /> X +
                </td>
                <td width="241">
                    <label for="textfield"></label>
                    <input type="text" name="c" id="textfield" /> = 0
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Nghiệm
                    <label for="textfield2"></label>
                    <input name="textfield" type="text" id="textfield2" value="<?php if(isset($nghiem)) echo $nghiem?>" />
            </tr>
            <tr>
                <td colspan="4" align="center" valign="middle"><input type="submit" name="submit" id="chao" value="Xuất" /></td>
            </tr>
        </table>
    </form>
</body>
</html>