<?
require_once 'system/header.php';

$query = "SELECT * FROM `clan` WHERE id = '{$users['id_clan']}'";
$result = mysqli_query($connect,$query);
$clan = mysqli_fetch_assoc($result);

if(!$clan){
    header("Location: angar");
    exit;
}

if(isset($_GET['take'])){
    $query = "SELECT * FROM `take_missions` WHERE id_user = '$myID'";
    $result = mysqli_query($connect,$query);
    $missions_take = mysqli_fetch_assoc($result);

    $query = "UPDATE `users` SET  `gold` = `gold` + ?, `silver` = `silver` + ?, `exp` = `exp` + ?, `count_company_missions` = `count_company_missions` + 1 WHERE `id` = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("iiii", $missions_take['gold'], $missions_take['silver'], $missions_take['exp'] ,$myID);
    $stmt->execute();
    $stmt->close();

    $query = "UPDATE `take_missions` SET `id_user` = 0 WHERE `id_user` = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $myID);
    $stmt->execute();
    $stmt->close();
    header("Location: company_missions");
}

$query = "SELECT * FROM `take_missions` WHERE id_user = '$myID'";
$result = mysqli_query($connect,$query);
$missions_take = mysqli_fetch_assoc($result);

if($missions_take['id_user'] == $myID){


$query = "SELECT * FROM `company_missions` WHERE id = {$missions_take['id_missions']}";
$result = mysqli_query($connect,$query);
$missions_info = mysqli_fetch_assoc($result);

    echo '<div class="trnt-block">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content small bold cntr">
    <div class="green1 mb5">Выполнена миссия "'.$missions_info['name'].'"!</div>
    <div class="white sh_b mb5"><span class="nwr">
    <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '.$missions_take['gold'].'
    золото</span><span class="nwr">
    <img class="ico vm" src="img/ico/exp.png" alt="опыт" title="опыт"> '.$missions_take['exp'].'
    опыта</span><span class="nwr">
    <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> '.$missions_take['silver'].'
    серебро</span></div>';
    echo '<div class="gray1 sh_b mb5">Cпециальных миссий выполнено: '.$users['count_company_missions'].'</div>';
    echo '<div class="bot">
    <a class="simple-but border medium" href="?take"><span><span>Получить награду</span></span></a>
    <div style="position:relative;">
    <span class="digit2 esmall">
    <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
    </span>
    </div>
    </div>
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
}

echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small bold white cntr mb5">
<div class="medium green1">Специальные миссии</div>
Выполняй миссии за звезды!<br>
Собрано звезд: <img height="14" width="14" src="img/ico/star.png"> '.$clan['stars'].'
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $company_clan_query = "SELECT * FROM `company_missions_clan` WHERE id_missions = '$id' AND `id_clan` = {$users['id_clan']}";
    $company_clan_result = mysqli_query($connect,$company_clan_query);
    $company_clan = mysqli_fetch_assoc($company_clan_result);

    $protected_query = "SELECT * FROM `company_missions_clan` WHERE first_user = '$myID' OR support_user = '$myID' AND `id_clan` = {$users['id_clan']}";
    $protected_result = mysqli_query($connect,$protected_query);
    if(mysqli_num_rows($protected_result) == 0){
        if($company_clan['first_user'] == 0){
            $query = "UPDATE `company_missions_clan` SET `first_user` = ?, `over` = ?  WHERE `id_missions` = ? AND `id_clan` = ? ";
            $stmt = $connect->prepare($query);
            $t = time() + 40*3600;
            $stmt->bind_param("iisi", $myID, $t, $id, $users['id_clan']);
            $stmt->execute();
        }

        if($company_clan['first_user'] > 0 && $company_clan['support_user'] == 0 && $myID != $company_clan['first_user']){
        
            $query = "UPDATE `company_missions_clan` SET `support_user` = ? WHERE `id_missions` = ? AND `id_clan` = ? ";
            $stmt = $connect->prepare($query);

            $stmt->bind_param("iii",$myID,$id,$users['id_clan']);
            $stmt->execute();
        }
    }else{
        $_SESSION['msg'] = "<span class='red1'>Вы уже выполняете миссию</span>";
        header("Location: company_missions");
        exit;
    }
    $_SESSION['msg'] = '<div class="trnt-block mb2">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content small green1 cntr sh_b bold mb5">
    <img height="14" width="14" src="img/ico/victory.png"> Миссия принята! <img height="14" width="14" src="img/ico/victory.png">
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
    header("Location: company_missions");
}

$query = "SELECT * FROM `company_missions`";
$result = mysqli_query($connect,$query);

$company_clan_query = "SELECT * FROM `company_missions_clan` WHERE `id_clan` = {$users['id_clan']}";
$company_clan_result = mysqli_query($connect,$company_clan_query);



while($company_missions = mysqli_fetch_assoc($result)){

$company_clan = mysqli_fetch_assoc($company_clan_result);

$query = "SELECT * FROM `users` WHERE id = {$company_clan['first_user']}";
$user_result = mysqli_query($connect, $query);
$first_user = mysqli_fetch_assoc($user_result);

$query = "SELECT * FROM `users` WHERE id = {$company_clan['support_user']}";
$user_result = mysqli_query($connect, $query);
$support_user = mysqli_fetch_assoc($user_result);

if(time() - $company_clan['time'] >= 24 * 3600){


    // progressbar
    $TaskProgress = round($company_clan['koll'] / $company_missions['koll'] * 100, 1);
    if ($TaskProgress > 100) $TaskProgress = 100;   
    // progressbar

    $time_diff = $company_clan['over'] - $current_time;

    $hours = floor($time_diff / 3600);
    $minutes = floor(($time_diff % 3600) / 60);
    $seconds = $time_diff % 60;



    echo '<div class="trnt-block mb5">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    <div class="white cntr bold sh_b small pb2">
    <div class="small orange pb2">'.$company_missions['name'].'</div>
    '.$company_missions['text'].'<br></span></div>';

if($company_clan['first_user'] == 0)echo '<div class="cntr"><a class="simple-but mt5 mb2 a_w50" href="?id='.$company_clan['id_missions'].'"><span><span>Начать выполнять</span></span></a></div>';
else{


echo '<div class="mt2">
<table class="rblock esmall mb0">
<tbody><tr>
<td><div class="value-block lh1"><span><span>'.$company_clan['koll'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:' . $TaskProgress . '%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$company_missions['koll'].'</span></span></div></td>
</tr>
</tbody></table>

</div>';

echo '<span class="gray1" style = "font-size: 13px;" >награда:</span>';
echo '<span class="green2" style = "font-size: 13px;" ><span class="nwr">
<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '.$company_missions['gold'].'
</span><span class="nwr">
<img class="ico vm" src="img/ico/exp.png" alt="опыт" title="опыт"> '.$company_missions['exp'].'
</span><span class="nwr">
<img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> '.$company_missions['silver'].'
</span></span>';
    echo '<div class="small white">
    Выполняют:
    <a href="profile?id='.$first_user['id'].'">
    <img class="vb" height="14" width="14" src="img/rankets/'.$first_user['side'].'/'.$first_user['rang'].'.png?1">
     <span class="yellow1">'.$first_user['nick'].'</span></a>';
     if($support_user['id']!=0){
     echo '<a href="profile?id='.$support_user['id'].'">
     <img class="vb" height="14" width="14" src="img/rankets/'.$support_user['side'].'/'.$support_user['rang'].'.png?1">
     <span class="yellow1">'.$support_user['nick'].'</span></a>';
     }
    echo ' (осталось: '.sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds).')<br></div>';
    if($company_clan['support_user'] == 0 and $company_clan['first_user'] !=$myID)echo '<div class="cntr"><a class="simple-but mt5 mb2 a_w50" href="?id='.$company_clan['id_missions'].'"><span><span>Помочь с миссией</span></span></a></div>';
    else echo '<div class="cntr"><a class="simple-but mt5 mb2 a_w50" href="'.$company_missions['link'].'"><span><span>Перейти к выполнению</span></span></a></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>';
}else{
    $remainingTime =  3600 - (time() - $company_clan['time']);
    $hours = floor($remainingTime / 3600);
    $minutes = floor(($remainingTime % 3600) / 60);
    $seconds = $remainingTime % 60;

    $formattedTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    echo '<div class="trnt-block mb5">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content cntr">
    <div class="white bold sh_b small">
    <div class="small pb2"><span class="gray1" w:id="name">'.$company_missions['name'].'</span></div>
    <span class="gray1" w:id="directions">'.$company_missions['text'].'</span></div><div>
    <div class="small gray1">Обновление через '.$formattedTime.'</div></div></div></div></div></div></div></div></div></div></div></div>';
}
}

echo '<a class="simple-but mt5 mb5" w:id="clanMissionsRulesLink" href="mrules"><span><span>Турнир по звездам</span></span></a>';

echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr"> За каждую выполненную миссию дивизия получает от <img class="vb" width="14" height="14" src="img/ico/star.png"> 1 до <img class="vb" width="14" height="14" src="img/ico/star.png"> 5 звезд (случайно).</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';

require_once 'system/footer.php';
?>