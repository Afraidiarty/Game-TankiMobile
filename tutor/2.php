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
                                <div class="title-kom">
            <div class="ram">
                <img src="img/tutor/komandir.jpg" alt="">
            </div>
            <div class="row-2">
                <span style="color: #01aeb9 !important;font-size: 13px;position: relative;right: 31%;" ><b>Командир</b></span>
                <div class="bl2">
                    <span style="position:relative; left:3%;font-size: 13px;"><b>Враг на горизонте! Атакуй его!</b></span>
                </div>
            </div>
        </div><br> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <br>
        <div class="tutor-arena">
            <div class="fight">
                <b><span style="color: #D2D2D2;font-size:13px;position:relative; top: 11px" >Деймос Хаос</span></b><br>
                <img class="fight-bot-tutor" src="img/tutor/bot.png" alt="">
            </div>
            <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tankImage = $_POST["myImage"];
}
?>

<form action="3" method="post">
    <input value="<?php echo $tankImage; ?>" type="hidden" name="myImage" id="tankImageField">
    <button style ="padding: 6px 139px;white-space:nowrap" class="simple-but border mb5 btn1">Выбрать этот танк</button>
</form>

        </div>
    </center>
</body>
</html>

<?php
echo '<link rel="stylesheet" type="text/css" href="http://wartank.ru/images/style.css"/>';
include_once '../tanks/foots.php';
exit();
?>