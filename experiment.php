<?php
$que_num = 0;
if(isset($_POST['next'])){
    $que_num = $_POST['que_num'];
    $que_num ++;



}

if(isset($_POST['reset'])){
    $que_num = $_POST['que_num'];
    $que_num = 0 ;



}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>experiment on quenumber</title>
</head>
<body>
    <form method="POST" action="">
    <input type="submit" name="next" value="next">
    <input type="text" name="que_num" value="<?php echo $que_num ?>" size="1" >
    <input type="submit" name="reset" value="reset">
    </form>
</body>
</html>
