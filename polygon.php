<style>
    .ml58 {
    margin-left: 9px;
    text-align: left;
}
</style>
<?
require_once 'system/header.php';

$query = "SELECT * FROM `polygon` WHERE id_user = '$myID'";
$result = mysqli_query($connect,$query);
$count_effect = mysqli_num_rows($result);



if (isset($_GET['attack'])) {
    $checkQuery = "SELECT COUNT(*) FROM `polygon` WHERE `id_effect` = ? AND `id_user` = ?";
    $checkStmt = $connect->prepare($checkQuery);

    if ($checkStmt) {
        $checkStmt->bind_param("ii", $id_effect, $id_user);
        $id_effect = 1;
        $id_user = $myID;
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo 'Вы уже взяли данное усиление';
            exit;
        }
    }
    $query = "INSERT INTO `polygon` SET `id_effect` = ?, `id_user` = ?, `time` = ?";
    $stmt = $connect->prepare($query);

        if ($stmt) {
            $stmt->bind_param("iii", $id_effect, $id_user, $t);
            $id_effect = 1;
            $id_user = $myID;
            $t = time() + 2.5*3600;
            if (!$stmt->execute()) {
                echo $stmt->error;
            }
            $stmt->close();
        }
        if ($count_effect > 0) {
            if ($users['gold'] >= 10) {

                $query = "UPDATE `users` SET  `gold` = ? WHERE `id` = ?";
                $stmt_1 = $connect->prepare($query);
                $g = $users['gold'] - 10;
    
                if ($stmt_1) {
                    $stmt_1->bind_param("ii", $g, $myID);
                    $stmt_1->execute();
                    $stmt_1->close();
                }
            } else {
                $NeXvataet = abs($users['gold'] - 60);
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                    <img class="ico vm" src="img/ico/gold.png?2" alt="Золота" title="Золота"> ' . $NeXvataet . '
                    золота</div></div>';
                    header("Location: polygon");
                    exit;
            }
        }
        $query = "UPDATE `users` SET `attach` = `attach` + ? WHERE id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ii",$statsEffect,$myID);
        $stmt->execute();
    header("Location: polygon");
}

if (isset($_GET['armor'])) {
    $checkQuery = "SELECT COUNT(*) FROM `polygon` WHERE `id_effect` = ? AND `id_user` = ?";
    $checkStmt = $connect->prepare($checkQuery);

    if ($checkStmt) {
        $checkStmt->bind_param("ii", $id_effect, $id_user);
        $id_effect = 2;
        $id_user = $myID;
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo 'Вы уже взяли данное усиление';
            exit;
        }
    }
    $query = "INSERT INTO `polygon` SET `id_effect` = ?, `id_user` = ?, `time` = ?";
    $stmt = $connect->prepare($query);

        if ($stmt) {
            $stmt->bind_param("iii", $id_effect, $id_user, $t);
            $id_effect = 2;
            $id_user = $myID;
            $t = time() + 2.5*3600;
            if (!$stmt->execute()) {
                echo $stmt->error;
            }
            $stmt->close();
        }
        if ($count_effect > 0) {
            if ($users['gold'] >= 10) {

                $query = "UPDATE `users` SET  `gold` = ? WHERE `id` = ?";
                $stmt_1 = $connect->prepare($query);
                $g = $users['gold'] - 10;
    
                if ($stmt_1) {
                    $stmt_1->bind_param("ii", $g, $myID);
                    $stmt_1->execute();
                    $stmt_1->close();
                }
            } else {
                $NeXvataet = abs($users['gold'] - 60);
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                    <img class="ico vm" src="img/ico/gold.png?2" alt="Золота" title="Золота"> ' . $NeXvataet . '
                    золота</div></div>';
                header("Location: polygon");
                exit;
            }
        }
    $query = "UPDATE `users` SET `armor` = `armor` + ? WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ii",$statsEffect,$myID);
    $stmt->execute();

    header("Location: polygon");
}

if (isset($_GET['accuracy'])) {
    $checkQuery = "SELECT COUNT(*) FROM `polygon` WHERE `id_effect` = ? AND `id_user` = ?";
    $checkStmt = $connect->prepare($checkQuery);

    if ($checkStmt) {
        $checkStmt->bind_param("ii", $id_effect, $id_user);
        $id_effect = 3;
        $id_user = $myID;
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo 'Вы уже взяли данное усиление';
            exit;
        }
    }
    $query = "INSERT INTO `polygon` SET `id_effect` = ?, `id_user` = ?, `time` = ?";
    $stmt = $connect->prepare($query);

        if ($stmt) {
            $stmt->bind_param("iii", $id_effect, $id_user, $t);
            $id_effect = 3;
            $id_user = $myID;
            $t = time() + 2.5*3600;
            if (!$stmt->execute()) {
                echo $stmt->error;
            }
            $stmt->close();
        }
        if ($count_effect > 0) {
            if ($users['gold'] >= 10) {

                $query = "UPDATE `users` SET  `gold` = ? WHERE `id` = ?";
                $stmt_1 = $connect->prepare($query);
                $g = $users['gold'] - 10;
    
                if ($stmt_1) {
                    $stmt_1->bind_param("ii", $g, $myID);
                    $stmt_1->execute();
                    $stmt_1->close();
                }
            } else {
                $NeXvataet = abs($users['gold'] - 60);
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                    <img class="ico vm" src="img/ico/gold.png?2" alt="Золота" title="Золота"> ' . $NeXvataet . '
                    золота</div></div>';
                    header("Location: polygon");
                    exit;
            }
        }
    $query = "UPDATE `users` SET `accuracy` = `accuracy` + ? WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ii",$statsEffect,$myID);
    $stmt->execute();   
    header("Location: polygon");
}


if (isset($_GET['health'])) {
    $checkQuery = "SELECT COUNT(*) FROM `polygon` WHERE `id_effect` = ? AND `id_user` = ?";
    $checkStmt = $connect->prepare($checkQuery);

    if ($checkStmt) {
        $checkStmt->bind_param("ii", $id_effect, $id_user);
        $id_effect = 4;
        $id_user = $myID;
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo 'Вы уже взяли данное усиление';
            exit;
        }
    }
    $query = "INSERT INTO `polygon` SET `id_effect` = ?, `id_user` = ?, `time` = ?";
    $stmt = $connect->prepare($query);

        if ($stmt) {
            $stmt->bind_param("iii", $id_effect, $id_user, $t);
            $id_effect = 4;
            $id_user = $myID;
            $t = time() + 2.5*3600;
            if (!$stmt->execute()) {
                echo $stmt->error;
            }
            $stmt->close();
        }
        if ($count_effect > 0) {
            if ($users['gold'] >= 10) {

                $query = "UPDATE `users` SET  `gold` = ? WHERE `id` = ?";
                $stmt_1 = $connect->prepare($query);
                $g = $users['gold'] - 10;
    
                if ($stmt_1) {
                    $stmt_1->bind_param("ii", $g, $myID); 
                    $stmt_1->execute();
                    $stmt_1->close();
                }
            } else {
                $NeXvataet = abs($users['gold'] - 60);
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                    <img class="ico vm" src="img/ico/gold.png?2" alt="Золота" title="Золота"> ' . $NeXvataet . '
                    золота</div></div>';
                    header("Location: polygon");
                    exit;
            }
        }
    $query = "UPDATE `users` SET `health` = `health` + ? WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ii",$statsEffect,$myID); 
    $stmt->execute();

    header("Location: polygon");
}

echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl" style ="display:flex;" >
<div class="thumb fl"><img src="images/attack.png?1" alt="Атака" title="Атака"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style ="margin-left: 10px;" >
<span class="green2">усиление атаки</span><br>
<span class="green2">+'.$statsEffect.' на 140 мин.</span><br>';

if($time_pol_1 > 0){
echo '<span class="green2">Осталось: '.date('H:i:s', $time_pol_1).'</span>';
}
echo '</div>
<div class="clrb"></div>
</div>
<div class="bot">';

if($time_pol_1 < 0){
if($count_effect == 0){
echo '<a class="simple-but border" href="?attack"><span><span>Получить бесплатно</span></span></a>
<div style="position:relative;">
<span class="digit2 esmall">
<span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
</span>
</div>';
}else{
echo '<a class="simple-but border" href="?attack"><span><span>Активировать за
<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 10 </span></span></a>';
}
}else{
echo '<span class="simple-but gray border"><span><span>Активно</span></span></span></div>';
}


echo '</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';


echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl" style ="display:flex;" >
<div class="thumb fl"><img src="images/armor.png?1" alt="Броня" title="Броня"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style ="margin-left: 10px;" >
<span class="green2">усиление брони</span><br>
<span class="green2">+'.$statsEffect.' на 140 мин.</span><br>';

if($time_pol_2 > 0){
    echo '<span class="green2">Осталось: '.date('H:i:s', $time_pol_2).'</span>';
}

echo '</div>
<div class="clrb"></div>
</div>
<div class="bot">';

if($time_pol_2 < 0){
    if($count_effect == 0){
    echo '<a class="simple-but border" href="?armor"><span><span>Получить бесплатно</span></span></a>
    <div style="position:relative;">
    <span class="digit2 esmall">
    <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
    </span>
    </div>';
    }else{
        echo '<a class="simple-but border" href="?armor"><span><span>Активировать за
        <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 10 </span></span></a>';
    }
    }else{
    echo '<span class="simple-but gray border"><span><span>Активно</span></span></span></div>';
    }

echo '</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';


echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl" style ="display:flex;" >
<div class="thumb fl"><img src="images/accuracy.png?1" alt="Точность" title="Точность"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style ="margin-left: 10px;" >
<span class="green2">усиление точности</span><br>
<span class="green2">+'.$statsEffect.' на 140 мин.</span><br>';

if($time_pol_3 > 0){
    echo '<span class="green2">Осталось: '.date('H:i:s', $time_pol_3).'</span>';
}


echo '</div>
<div class="clrb"></div>
</div>
<div class="bot">';

if($time_pol_3 < 0){
    if($count_effect == 0){
    echo '<a class="simple-but border" href="?accuracy"><span><span>Получить бесплатно</span></span></a>
    <div style="position:relative;">
    <span class="digit2 esmall">
    <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
    </span>
    </div>';
    }else{
    echo '<a class="simple-but border" href="?accuracy"><span><span>Активировать за
    <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 10 </span></span></a>';
    }
    }else{
    echo '<span class="simple-but gray border"><span><span>Активно</span></span></span></div>';
    }

echo '</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';


echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl" style ="display:flex;" >
<div class="thumb fl"><img src="images/durability.png?1" alt="Здоровье" title="Здоровье"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style ="margin-left: 10px;" >
<span class="green2">усиление здоровья</span><br>
<span class="green2">+'.$statsEffect.' на 140 мин.</span><br>';

if($time_pol_4 > 0){
    echo '<span class="green2">Осталось: '.date('H:i:s', $time_pol_4).'</span>';
}


echo '</div>
<div class="clrb"></div>
</div>
<div class="bot">';

if($time_pol_4 < 0){
    if($count_effect == 0){
    echo '<a class="simple-but border" href="?health"><span><span>Получить бесплатно</span></span></a>
    <div style="position:relative;">
    <span class="digit2 esmall">
    <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
    </span>
    </div>';
    }else{
    echo '<a class="simple-but border" href="?health"><span><span>Активировать за
    <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 10 </span></span></a>';
    }
    }else{
    echo '<span class="simple-but gray border"><span><span>Активно</span></span></span></div>';
    }

echo '</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';

require_once 'system/footer.php';
?>