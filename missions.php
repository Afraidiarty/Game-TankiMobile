<?
require_once 'system/header.php';
echo '<table>';
echo '<tbody><tr>';
echo '<td style="width:50%;padding:0 3px;">';
echo '<span class="simple-but border gray" w:id="simpleKlassLink"><em><span><span>Простые</span></span></em></span>';
echo '<div style="position:relative;">';
echo '<span class="digit2 esmall">';
$q_u_q = "SELECT * FROM `quest_user` WHERE `id_user` = '$myID'";
$q_u_r = mysqli_query($connect, $q_u_q);
while($q_t = mysqli_fetch_assoc($q_u_r)){
    
    if($q_t['koll'] >= $q_t['max_koll']){
        echo '<span class="l">&nbsp;</span>';
        echo '<span class="m">+</span>';
        echo '<span class="r">&nbsp;</span>';
        break;
    }
}
echo '</span>';
echo '</div>';
echo '</td>';
echo '<td style="width:50%;padding:0 3px;">';
echo '<a class="simple-but border" w:id="advancedKlassLink" href="Advanced"><span><span>Сложные</span></span></a>';
echo '</td>';
echo '</tr>';
echo '</tbody></table>';







$query = "SELECT * FROM `quest`";
$result = mysqli_query($connect,$query);

$query_user_quest = "SELECT * FROM `quest_user` WHERE `id_user` = '$myID'";
$quest_user_result = mysqli_query($connect, $query_user_quest);

 
if(isset($_GET['take']) and $_SESSION['remTime'] <= 0){
    
    $id = intval($_GET['take']);

    $query = "SELECT * FROM `quest` WHERE `id` = '$id'";
    $result = mysqli_query($connect,$query);
    $currTask = mysqli_fetch_assoc($result);

    $query = "UPDATE `users` SET `gold` = ?, `silver` = ?, `exp` = ? WHERE `id` = ?";
    $stmt = $connect->prepare($query);

    // выдача наград 
    $qGold = $users['gold'] + $currTask['gold'];
    $qSilver = $users['silver'] + $currTask['silver'];
    $qExp = $users['exp'] + $currTask['exp'];

    $_SESSION['qGold'] = $currTask['gold'];
    $_SESSION['qSilver'] = $currTask['silver'];
    $_SESSION['qExp'] = $currTask['exp'];
    $_SESSION['qName'] = $currTask['name'];

    if($stmt){
       $stmt->bind_param("iiii",$qGold,$qSilver,$qExp,$myID);
       $stmt->execute();
       $stmt->close();
    }

    // Обнуление
    $sql = "UPDATE `quest_user` SET `koll` = 0, `last` = UNIX_TIMESTAMP() WHERE `id_user` = ? AND `id_quest` = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $myID, $id);
    $stmt->execute();


    

  header("Location: missions?message=reward_claimed");


}
if (isset($_GET['message']) && $_GET['message'] === 'reward_claimed') {

    $qName = $_SESSION['qName'];
    $qGold = $_SESSION['qGold'];
    $qSilver = $_SESSION['qSilver'];
    $qExp = $_SESSION['qExp'];

    echo'<div class="trnt-block mb6 cntr bold small">
    <div class="green1 pb5">Выполнена миссия "'. $qName .'"!</div>
    
    <div class="white"><span class="nwr">
    <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $qGold .'
     золото</span><span class="nwr">
    <img class="ico vm" src="img/ico/exp.png" alt="опыт" title="опыт"> '. $qExp .'
     опыта</span><span class="nwr">
    <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> '. $qSilver .'
     серебра</span></div></div>';
}

    while($quest = mysqli_fetch_assoc($result)){
        $quest_user = mysqli_fetch_assoc($quest_user_result);

        if(time() - $quest_user['last'] >= 24 *3600){
        echo '<div class="trnt-block mb5">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="white cntr bold sh_b small pb2">
<div class="small orange pb2">'. $quest['name'].'</div>
'. $quest['text'].'<br>';


// progressbar
    $TaskProgress = round($quest_user['koll'] / $quest['koll'] * 100, 1);
    if ($TaskProgress > 100) $TaskProgress = 100;   
// progressbar

// когда игрок начал выполнять 
if ($quest_user['koll'] > 0) {
    echo '<table class="rblock esmall mb0">';
    echo '<tbody><tr>';
    echo '<td><div class="value-block lh1"><span><span>' . $quest_user['koll'] . '</span></span></div></td>';
    echo '<td class="progr"><div class="scale-block"><div class="scale" style="width:' . $TaskProgress . '%;">&nbsp;</div></div></td>';
    echo '<td><div class="value-block lh1"><span><span>' . $quest['koll'] . '</span></span></div></td>';
}
echo '</tr>
</tbody></table>
<span class="gray1">награда:</span> <span class="green2"><span class="nwr">
<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $quest['gold'] .'
</span><span class="nwr">
<img class="ico vm" src="img/ico/exp.png" alt="опыт" title="опыт"> '. $quest['exp'] .'
</span><span class="nwr">
<img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> '. $quest['silver'] .'
</span></span><br>

</div>';
if($TaskProgress<100){
    echo '<div class="cntr"><a class="simple-but mt5 mb2 a_w50" href="'. $quest['link'].'"><span><span>Перейти к выполнению</span></span></a></div>';
}else{
    $_SESSION['remTime'] = 0;
    echo '<div class="cntr"><a class="simple-but mt5 mb2 a_w50" href="?take=' . $quest['id'] . '"><span><span>Забрать награду</span></span></a></div>';
}
echo '</div>';
echo '</div></div></div></div></div></div></div></div>
</div>';
}else{
    $remainingTime = 24 * 3600 - (time() - $quest_user['last']);
    $hours = floor($remainingTime / 3600);
    $minutes = floor(($remainingTime % 3600) / 60);
    $seconds = $remainingTime % 60;

    $formattedTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    $_SESSION['remTime'] = $remainingTime;
    
    echo '<div class="trnt-block mb2">

    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    <div class="cntr sh_b small gray1">
    <div class="bold pb2">'. $quest['name'] .'</div>
    <div class="bold">'. $quest['text'] .'</div>
    Обновление через: '. $formattedTime .'
    </div>
    </div>
    </div></div></div></div></div></div></div></div>
    
    </div>';
}
}

echo'<div class="trnt-block mb10">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Чем выше звание, тем больше награда за выполнение миссии. Повысить звание можно в тренировке</div>

<div class="bot">
<a class="simple-but border" href="training"><span><span>Тренироваться</span></span></a>
</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';
require_once 'system/footer.php'
?>
