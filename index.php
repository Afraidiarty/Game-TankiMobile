<?
    require_once 'system/core.php';
    session_start();
    ProtectedAuth();
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div id="page-content">
        <img src="img/logo1.jpg" alt="">
        <div class="block-ind">
            <a class="simple-but border" style="max-width:300px;width:100%;margin-left:auto;margin-right:auto;" w:id="startLink" href="tutor/1"><span><span>Начать игру</span></span></a>
        </div>
        <a class="simple-but gray border btn2" style="max-width:300px;width:100%;margin-left:auto;margin-right:auto;" w:id="showSigninLink" href=""><span><span>Я уже играл</span></span></a>
        
        <form class="auth-f" id="auth" style="display: none;" action="login" method="post">
            <div class="blc">
                <br>
                <div class="trnt-block">
                <div class="wrap1">
                <div class="wrap2">
                    <div class="wrap3">
                    <div class="wrap4">
                        <div class="wrap5">
                        <div class="wrap6">
                            <div class="wrap7">
                            <div class="wrap8">
                                <div class="wrap-content">
                                <div class="cntr white small sh_b bold mb10">
                                    Вход для зарегистрированных<br><br>
                                    Имя танка:<br>
                                    <input type="text" name="login" value="" class="fld-chng" size="20" maxlength="32" w:id="login"><br>
                                    Пароль:<br>
                                    <input type="password" name="password" value="" class="fld-chng" size="20" maxlength="32" w:id="password">
                                </div>
                                <div class="bot mXa w200px">
                                    <span class="input-but border"><span><input class="w100" type="submit"  value="Войти"></span></span>
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
            </div>
            </div>
        </form>
    </div>
    <script src="ajax/scripts.js"></script>
</body>
</html>
<?php



?>

<?php
include 'template.html'; 
?>

<?php
echo '<link rel="stylesheet" type="text/css" href="http://wartank.ru/images/style.css"/>';
include_once '../tanks/foots';
require_once 'system/footer.php';
exit();
?>
