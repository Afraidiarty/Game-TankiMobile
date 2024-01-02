<br>    
<?php
require_once 'system/core.php';
session_start();

echo '<p style = "color:red;font-size: 12px; font-weight: 900;">'.$_SESSION['errormessage'].'</p>';
unset($_SESSION['errormessage']);
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tankImage = $_POST["myImage"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Your Title Here</title>
</head>
<body>  
    <form action="regsucc" method="post">
        <span style="color:#0CBA07 !important;"><b>Зарегистрируйтесь и получите 250 <img src="img/ico/gold.png" alt=""></b></span><br><br>
        <span><b>Введите никнейм</b></span><br>
        <input name="nickname" requiredtype="text"><br>
        <span><b>Введите пароль</b></span><br>
        <input name="password" required type="password"><br><br>
        <input value="<?php echo $tankImage; ?>" type="hidden" name="myImage" id="tankImageField">
        <button  type="submit" style ="padding: 6px 139px;" class="simple-but border mb5 btn1">Зарегестрироваться</button>

    </form>
</body>
</html>
<?php
echo '<link rel="stylesheet" type="text/css" href="http://wartank.ru/images/style.css"/>';
include_once '../tanks/foots.php';
exit();
?>