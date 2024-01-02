<?
require_once 'system/header.php';





if (isset($_GET['vip_1'])) {
    if($remaining_time < 0){
        $query = "INSERT INTO `vip` SET `id_vip` = ?, `id_user` = ?, `time` = ?";
        $stmt = $connect->prepare($query);

        if ($stmt) {
            echo 'Statement prepared successfully';
            $stmt->bind_param("iii", $id_vip, $id_user, $t);
            $id_vip = 1;
            $id_user = $myID;
            $t = time() + 460*3600;
            $stmt->execute();
            $stmt->close();
         }
    }else{
        $query = "UPDATE `vip` SET `id_vip` = ?, `id_user` = ?, `time` = ? WHERE id_vip = 1 AND id_user = '$myID'";
        $stmt = $connect->prepare($query);

        if ($stmt) {
            echo 'Statement prepared successfully';
            $stmt->bind_param("iii", $id_vip, $id_user, $t);
            $id_vip = 1;
            $id_user = $myID;
            $t = $vip_1['time'] + 460*3600;
            $stmt->execute();
            $stmt->close();
         }
    }
    header("Location: vip");
}

if (isset($_GET['vip_2'])) {
    if($remaining_time_2 < 0){
        $query = "INSERT INTO `vip` SET `id_vip` = ?, `id_user` = ?, `time` = ?";
        $stmt = $connect->prepare($query);

            $stmt->bind_param("iii", $id_vip, $id_user, $t);
            $id_vip = 2;
            $id_user = $myID;
            $t = time() + 72*3600;
            if(!$stmt->execute()){
                echo $stmt->error;
            }
            $stmt->close();
         
    }else{
        $query = "UPDATE `vip` SET `id_vip` = ?, `id_user` = ?, `time` = ? WHERE id_vip = 2 AND id_user = '$myID'";
        $stmt = $connect->prepare($query);

            echo 'Statement prepared successfully';
            $stmt->bind_param("iii", $id_vip, $id_user, $t);
            $id_vip = 2;
            $id_user = $myID;
            $t = $vip_2['time'] + 72*3600;
            $stmt->execute();
            $stmt->close();
    }
    header("Location: vip");
}


if (isset($_GET['vip_3'])) {
    if($remaining_time_3 < 0){
        $query = "INSERT INTO `vip` SET `id_vip` = ?, `id_user` = ?, `time` = ?";
        $stmt = $connect->prepare($query);

            $stmt->bind_param("iii", $id_vip, $id_user, $t);
            $id_vip = 3;
            $id_user = $myID;
            $t = time() + 72*3600;
            if(!$stmt->execute()){
                echo $stmt->error;
            }
            $stmt->close();
         
    }else{
        $query = "UPDATE `vip` SET `id_vip` = ?, `id_user` = ?, `time` = ? WHERE id_vip = 3 AND id_user = '$myID'";
        $stmt = $connect->prepare($query);

            $stmt->bind_param("iii", $id_vip, $id_user, $t);
            $id_vip = 3;
            $id_user = $myID;
            $t = $vip_3['time'] + 72*3600;
            $stmt->execute();
            $stmt->close();
    }
    header("Location: vip");
}


if (isset($_GET['vip_4'])) {
    if($remaining_time_4 < 0){
        $query = "INSERT INTO `vip` SET `id_vip` = ?, `id_user` = ?, `time` = ?";
        $stmt = $connect->prepare($query);

            $stmt->bind_param("iii", $id_vip, $id_user, $t);
            $id_vip = 4;
            $id_user = $myID;
            $t = time() + 72*3600;
            if(!$stmt->execute()){
                echo $stmt->error;
            }
            $stmt->close();
         
    }else{
        $query = "UPDATE `vip` SET `id_vip` = ?, `id_user` = ?, `time` = ? WHERE id_vip = 4 AND id_user = '$myID'";
        $stmt = $connect->prepare($query);

            $stmt->bind_param("iii", $id_vip, $id_user, $t);
            $id_vip = 4;
            $id_user = $myID;
            $t = $vip_4['time'] + 72*3600;
            $stmt->execute();
            $stmt->close();
    }
    header("Location: vip");
}




$hours = floor($remaining_time / 3600);
$minutes = floor(($remaining_time % 3600) / 60);
$seconds = $remaining_time % 60;


$hours_2 = floor($remaining_time_2 / 3600);
$minutes_2 = floor(($remaining_time_2 % 3600) / 60);
$seconds_2 = $remaining_time_2 % 60;

$hours_3 = floor($remaining_time_3 / 3600);
$minutes_3 = floor(($remaining_time_3 % 3600) / 60);
$seconds_3 = $remaining_time_3 % 60;


$hours_4 = floor($remaining_time_4 / 3600);
$minutes_4 = floor(($remaining_time_4 % 3600) / 60);
$seconds_4 = $remaining_time_4 % 60;

echo'<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small cntr white bold sh_b">
<img src="img/ico/exp.png"> <span class="green2">Вера в победу</span> <img src="img/ico/exp.png"><br>
<span class="green1">+100</span> к параметрам<br>
<span class="green1">+50%</span> к опыту экипажа<br>
<span class="green1">+25%</span> к навыку снарядов<br>
<div class="pt5 pb5">Длительность: 480 часа</div>';

if ($remaining_time > 0) {
    // Таймер активен
    echo '<div class="pt5 pb5">Истекает через <span class="green1">';
    echo sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    echo '</span></div>';
} else {
    // Таймер не активен
    echo '<div class="pt5 pb5">Усиление <span class="red1">не активно</span></div>';
}


echo '</div>
<div class="bot">';
if($remaining_time < 0){
echo '<a class="simple-but border mb5" href="vip?vip_1">
<span><span>
Активировать за 
<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 500
</span></span></a>';
}else{
    echo '<a class="simple-but border mb5" href="vip?vip_1">
<span><span>
Продлить за 
<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 500
</span></span></a>';
}
echo '</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';


echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small cntr white bold sh_b">
<img src="img/ico/exp.png"> <span class="green2">Передовое снабжение</span> <img src="img/ico/exp.png"><br>
<span class="green1">+50%</span> к опыту<br>
<span class="green1">+50%</span> к серебру<br>
<div class="pt5 pb5">Длительность: 72 часа</div>';
if ($remaining_time_2 > 0) {
    // Таймер активен
    echo '<div class="pt5 pb5">Истекает через <span class="green1">';
    echo sprintf("%02d:%02d:%02d", $hours_2, $minutes_2, $seconds_2);
    echo '</span></div>';
} else {
    // Таймер не активен
    echo '<div class="pt5 pb5">Усиление <span class="red1">не активно</span></div>';
}
echo '</div>
<div class="bot">';
if($remaining_time_2 < 0){
echo '<a class="simple-but border mb5" href="vip?vip_2">
<span><span>
Активировать за 
<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 50
</span></span></a>';
}else{
    echo '<a class="simple-but border mb5" href="vip?vip_2">
    <span><span>
    Продлить за 
    <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 50
    </span></span></a>';
}
echo '</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';

echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small cntr white bold sh_b">
<img src="img/ico/exp.png"> <span class="green2">Армейское братство</span> <img src="img/ico/exp.png"><br>
<span class="green1">+100%</span> к опыту экипажа<br>
<span class="green1">+50%</span> к навыку снарядов<br>
<div class="pt5 pb5">Длительность: 72 часа</div>';
if ($remaining_time_3 > 0) {
    // Таймер активен
    echo '<div class="pt5 pb5">Истекает через <span class="green1">';
    echo sprintf("%02d:%02d:%02d", $hours_3, $minutes_3, $seconds_3);
    echo '</span></div>';
} else {
    // Таймер не активен
    echo '<div class="pt5 pb5">Усиление <span class="red1">не активно</span></div>';
}
echo '</div>
<div class="bot">';
if($remaining_time_3 < 0){
echo '<a class="simple-but border mb5" href="vip?vip_3">
<span><span>
Активировать за 
<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 50
</span></span></a>';
}else{
    echo '<a class="simple-but border mb5" href="vip?vip_3">
    <span><span>
    Продлить за 
    <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 50
    </span></span></a>';
}
echo '</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';

echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small cntr white bold sh_b">
<img src="img/ico/exp.png"><span class="green2">Экспериментальное оборудование</span><img src="img/ico/exp.png"><br>
<span class="green1">+50%</span> к опыту<br>
<span class="green1">+50%</span> к навыку снарядов<br>
Повышает усиления полигона на 1 пункт<br>
<div class="pt5 pb5">Длительность: 72 часа</div> ';
if ($remaining_time_4 > 0) {
    // Таймер активен
    echo '<div class="pt5 pb5">Истекает через <span class="green1">';
    echo sprintf("%02d:%02d:%02d", $hours_4, $minutes_4, $seconds_4);
    echo '</span></div>';
} else {
    // Таймер не активен
    echo '<div class="pt5 pb5">Усиление <span class="red1">не активно</span></div>';
}
echo '</div>
<div class="bot">';
if($remaining_time_4 < 0){
echo '<a class="simple-but border mb5" href="vip?vip_4">
<span><span>
Активировать за 
<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 50
</span></span></a>';
}else{
    echo '<a class="simple-but border mb5" href="vip?vip_4">
    <span><span>
    Продлить за 
    <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 50
    </span></span></a>';
}
echo '</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';

echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small cntr white bold sh_b">
<img src="img/ico/exp.png"> <span class="green2">Бонус подарка</span> <img src="img/ico/exp.png"><br>
<span class="green1">+10</span> к параметрам<br>
<div class="pt5 pb5">Истекает через <span class="green1">
23:59:50
</span></div>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';
require_once 'system/footer.php';
?>