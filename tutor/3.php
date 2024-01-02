<?
include_once '../system/core.php';
ProtectedAuth();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/main.css">
    <title>Document</title>
</head>

<body>
    <br>
    <center>
        <div class="congr">
            <span style="color: #0CBA07 !important;" ><b>Потрясающе</b></span><br>
            <span style="color: #0CBA07 !important;font-size:13px;" ><b>Ты прирожденный танковый ас!</b></span>
        </div>
        <br>
        <div class="congr">

        <div class="trnt-block">
    <div class="wrap1" >
    <div class="wrap2">
        <div class="wrap3">
            <div class="wrap4">
                <div class="wrap5">
                    <div class="wrap6">
                        <div class="wrap7">
                            <div class="wrap8">
                                <div class="wrap-content cntr white bold">
                                <div class="first-bb">
                <img src="img/ico/victory.png" alt="">
                <span style="color: #0CBA07 !important;" ><b>Противник уничтожен!</b></span>
                <img src="img/ico/victory.png" alt="">
            </div>
            <div class="two-bb">
                <img src="img/ico/fuel.png" alt="">
                <span><b>300 топлива</b></span>
                <img src="img/ico/silver.png" alt="">
                <span><b>50 серебра</b></span>
            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        </div>
        <div class="tutor-arena">
            <div class="fight"><br>
                <img class="fight-bot-tutor" src="img/fight/podbit.png" alt="">
            </div>
            <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tankImage = $_POST["myImage"];
}
?>

<form action="../reg" method="post">
    <input value="<?php echo $tankImage; ?>" type="hidden" name="myImage" id="tankImageField">
                <button style ="padding: 6px 139px;white-space:nowrap" class="simple-but border mb5 btn1">Войти в ангар</button>
            </form>
        </div>
    </center>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tankImage = $_POST["myImage"];
}
?>
<?php
echo '<link rel="stylesheet" type="text/css" href="http://wartank.ru/images/style.css"/>';
include_once '../tanks/foots.php';
exit();
?>