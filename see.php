<?php
session_start();

if (isset($_SESSION['successMessage'], $_SESSION['nickname'], $_SESSION['password'])) {
    $successMessage = $_SESSION['successMessage'];
    $nickname = $_SESSION['nickname'];
    $password = $_SESSION['password'];

    unset($_SESSION['successMessage'], $_SESSION['nickname'], $_SESSION['password']);
} else {

    header('Location: angar');
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Your Page Title</title>
</head>
<body>
    <div class="block">
        <?php if (isset($successMessage)) { ?>
            <span style="color:#0CBA07 !important;font-size:13px;"><b><?= $successMessage ?></b></span><br>
            <span style="font-size:13px;"><b>Ваш логин: <?= $nickname ?> </b></span><br>
            <span style="font-size:13px;"><b>Ваш пароль: <?= $password ?> </b></span><br><br>
            <a class="simple-but border mb2"  href="angar"><span><span>В ангар</span></span></a>

        <?php $_SESSION['nickname'] = $nickname; } ?>
    </div>
</body>
</html>
<?php
echo '<link rel="stylesheet" type="text/css" href="http://wartank.ru/images/style.css"/>';
include_once '../tanks/foots.php';
exit();
?>