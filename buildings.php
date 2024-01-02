<?
require_once 'system/header.php';

echo '<div class="trnt-block mb5">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="white small bold sh_b mb5 cntr">
Мои ресурсы
<span class="gray1 cntr blck pt5">

<span class="nwr"><img class="rico vm" src="img/buildings/material/ore.png?2" alt="Руда" title="Руда"> '.$users['ore'].' &nbsp;&nbsp;</span>

<span class="nwr"><img class="rico vm" src="img/buildings/material/iron.png?2" alt="Железо" title="Железо"> '.$users['iron'].' &nbsp;&nbsp;</span>

<span class="nwr"><img class="rico vm" src="img/buildings/material/steel.png?2" alt="Сталь" title="Сталь"> '.$users['steel'].' &nbsp;&nbsp;</span>

<span class="nwr"><img class="rico vm" src="img/buildings/material/plumbum.png?2" alt="Свинец" title="Свинец"> '.$users['plumbum'].' &nbsp;&nbsp;</span>
</span>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';

$query = "SELECT * FROM `buildings`";
$result_buildings = mysqli_query($connect, $query);

$insert_query = "INSERT INTO `buildings_user` (`id`, `buildings_level`, `id_user`, `id_buildings`) VALUES (?, ?, ?, ?)";
$insert_statement = mysqli_prepare($connect, $insert_query);

$ProtectedID_query = "SELECT `id_user` FROM `buildings_user` WHERE `id_user` = ?";
$stmt_protected = mysqli_prepare($connect, $ProtectedID_query);
mysqli_stmt_bind_param($stmt_protected, 'i', $myID);
mysqli_stmt_execute($stmt_protected);
mysqli_stmt_store_result($stmt_protected);
$protected_rows = mysqli_stmt_num_rows($stmt_protected);
mysqli_stmt_close($stmt_protected);

if ($insert_statement) {
    if ($protected_rows === 0) {
        while ($row = mysqli_fetch_assoc($result_buildings)) {
            $level = 1;
            $id_user = $myID;
            $id_buildings = $row['id'];
            
            mysqli_stmt_bind_param($insert_statement, 'iiii', $id, $level, $id_user, $id_buildings);
            mysqli_stmt_execute($insert_statement);
            
        }
    }

    mysqli_stmt_close($insert_statement);
}

mysqli_free_result($result_buildings);




$query_user_builds = "SELECT * FROM `buildings_user` WHERE id_user = '$myID'";
$result_user_buidls = mysqli_query($connect,$query_user_builds);

$result_buildings = mysqli_query($connect, $query);


$query = "SELECT * FROM `mine` WHERE id_user = '$myID'";
$count = mysqli_query($connect,$query);
$materialInfo = mysqli_fetch_assoc($count);

switch($materialInfo['material']){
    case 1: $material = 'ore';$timer = '3600';break;
    case 2: $material = 'iron';$timer = '7200';break;
    case 3: $material = 'steel';$timer = '14400 ';break;
    case 4: $material = 'plumbum';$timer = '28800';break;
}


$material_diff_time = $materialInfo['time'] - $current_time;

if(mysqli_num_rows($count) > 0){
$progress_percent = 100 - (($material_diff_time / $timer) * 100);
$progress_percent = max(0, min(100, $progress_percent));
}


$query = "SELECT * FROM `buildings_user` WHERE id_user = '$myID' AND id_buildings = 1";
$result = mysqli_query($connect,$query);
$Mine = mysqli_fetch_assoc($result);

$currentLevel = $Mine['buildings_level'];





$MineMaterial = array(
    1 => array('ore' => 1 , 'iron' => 0 , 'steel' => 0 , 'plumbum' => 0 ),
    2 => array('ore' => 1, 'iron' => 0 , 'steel' => 0 , 'plumbum' => 0),
    3 => array('ore' => 2, 'iron' => 0 , 'steel' => 0 , 'plumbum' => 0),
    4 => array('ore' => 2, 'iron' => 1 , 'steel' => 0 , 'plumbum' => 0),
    5 => array('ore' => 3 , 'iron' => 1 , 'steel' => 0 , 'plumbum' => 0),
    6 => array('ore' => 3 , 'iron' => 2 , 'steel' => 0 , 'plumbum' => 0),
    7 => array('ore' => 4 , 'iron' => 2 , 'steel' => 1 , 'plumbum' => 0),
    8 => array('ore' => 5 , 'iron' => 3 , 'steel' => 1 , 'plumbum' => 0),
    9 => array('ore' => 5 , 'iron' => 3 , 'steel' => 2 , 'plumbum' => 0),
    10 => array('ore' => 6  , 'iron' => 3 , 'steel' => 2 , 'plumbum' => 0),
    11 => array('ore' => 6  , 'iron' => 5 , 'steel' => 2 , 'plumbum' => 1),
    12 => array('ore' => 6 , 'iron' =>  5 , 'steel' => 3 , 'plumbum' => 1),
    13 => array('ore' => 7  , 'iron' => 6 , 'steel' => 4 , 'plumbum' => 1),
    14 => array('ore' => 7 , 'iron' => 6 , 'steel' => 4 , 'plumbum' => 2),
    15 => array('ore' => 10 , 'iron' => 7 , 'steel' => 5 , 'plumbum' => 3),
    16 => array('ore' => 10 , 'iron' => 7 , 'steel' => 5 , 'plumbum' => 4),
);

if(isset($_GET['take']) && $material_diff_time <= 0){
    $query = "UPDATE `users` SET `$material` = `$material` + ? WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ii",$MineMaterial[$currentLevel][$material],$myID);
    $stmt->execute();

    $query_user_quest = "SELECT * FROM `quest_user` WHERE `id_user` = '$myID' AND (`id_quest` = 5)";
    $quest_user_result = mysqli_query($connect, $query_user_quest);
    $q = mysqli_fetch_assoc($quest_user_result);
        if (time() - $q['last'] >= 24 * 3600) {
            $query = "DELETE FROM `mine` WHERE id_user = '$myID'";
            $result = mysqli_query($connect, $query);

            $query = "UPDATE `quest_user` SET `koll` = `koll` + ? WHERE id_user = ? AND id_quest = 5";
            $stmt = $connect->prepare($query);
            
            $stmt->bind_param("ii", $MineMaterial[$currentLevel][$material], $myID);
            
            $stmt->execute();
            $stmt->close();
        }
            # Дивизионный опыт клановые задания
            $query = "SELECT * FROM `company_missions_clan` WHERE `id_clan` = ? AND (`id_missions` = 3)";
            $stmt = $connect->prepare($query);
             
            $query_user_quest = "SELECT * FROM `company_missions_clan` WHERE `id_clan` = '{$users['id_clan']}' AND (`id_missions` = 3)";
            $company_missions_clan_result = mysqli_query($connect, $query_user_quest);

            $company_missions_clan = mysqli_fetch_assoc($company_missions_clan_result);

                 if ($stmt) {
                     $stmt->bind_param("i", $users['id_clan']);
                     $stmt->execute();
                     $result = $stmt->get_result();
                     
                         while ($q = $result->fetch_assoc()) {
                             if ((time() - $q['time'] >= 24 * 3600) && ($q['first_user'] == $myID || $q['support_user'])) {
                     
                                 $updateQuery = "UPDATE `company_missions_clan` SET `koll` = `koll` + ? WHERE `id` = ?";
                                 $updateStmt = $connect->prepare($updateQuery);
                     
                                 if ($updateStmt) {
                                     $updateStmt->bind_param("ii", $MineMaterial[$currentLevel][$material] ,$q['id']);
                                     $updateStmt->execute();
                                 } else {
                                     echo "Ошибка при подготовке запроса на обновление: " . $connect->error;
                                 }
                             }
                         }               
                    }
    
    header("Location: Mine");  
}


$i = 0;
while($builds = mysqli_fetch_assoc($result_buildings)){
    $i++;
    switch($i){
        case 1: $FirstLink = "Mine";$SecondLink = "up-mine";break;
        case 2: $FirstLink = "polygon";$SecondLink = "up-polygon";break;
        case 3: $FirstLink = "fuel";$SecondLink = "up-fuel";break;
    }

    $currBuilds = mysqli_fetch_assoc($result_user_buidls);

    
    echo '<div class="trnt-block">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    <div class="mb5 inbl w100" style="text-align:left;">
    <div class="thumb fl"><img src="'.$builds['img'].'" alt=""><span class="mask2">&nbsp;</span></div>
    <div class="ml58 small white sh_b bold">
    <span class="green2">'.$builds['name'].' - '.$currBuilds['buildings_level'].'</span><br>
    '.$builds['text'].'<br>
    </div>
    <div class="clrb"></div>
    </div>';
    if(mysqli_num_rows($count) > 0 and $currBuilds['id_buildings'] == 1){
        if($material_diff_time >= 0){
        echo '<table class="rblock mt5 esmall">
        <tbody><tr>
        
        <td class="vam"><div class="nwr pr5 gray1"><img class="rico vm" src="img/buildings/material/'.$material.'.png?2" alt="ore">&nbsp;'.$MineMaterial[$currentLevel][$material].'</div></td>
        
        <td class="progr"><div class="scale-block"><div class="scale" style="width:' . $progress_percent . '%;">&nbsp;</div><div class="mask">&nbsp;</div></div></td>
        <td><div class="value-block lh1"><span><span>'.date('H:i:s', $material_diff_time).'</span></span></div></td>
        </tr>
        </tbody></table>';
        }else{
            echo '<div class="bot"><table><tbody><tr><td style="width:50%;padding-right:1px;"><div style="position:relative;">
            <a class="simple-but border" href="buildings?take"><span><span>Забрать</span></span></a>
            <span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div></td></tr></tbody></table></div>';
        }
}else{
    echo '<div class="bot">
    <table>
    <tbody><tr>
    <td style="width:50%;padding-right:1px;">
    <a class="simple-but border" href="'.$FirstLink.'"><span><span>Производство</span></span></a>
    <div style="position:relative;">
    <span class="digit2 esmall">
    <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
    </span>
    </div>
    </td>
    <td style="width:50%;padding-left:1px;"><a class="simple-but border mb5" href="'.$SecondLink.'"><span><span>Улучшить</span></span></a></td>
    </tr>
    </tbody></table>
    </div>';
}
    
    echo '</div></div></div></div></div></div></div></div></div></div>';
}


if (!isset($_SESSION['message_state'])) {
    $_SESSION['message_state'] = 0;
}

$messages = array(
    '<div class="trnt-block mb2">
        <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
        <div class="wrap-content-mini">
        <div class="mt5 mb5 small green1 cntr">Хорошо прокачанный полигон залог будущих побед. Полигон дает мощный бонус к параметрам танка</div>
        </div>
        </div></div></div></div></div></div></div></div>
    </div>',
    '<div class="trnt-block mb2">
        <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
        <div class="wrap-content-mini">
        <div class="mt5 mb5 small green1 cntr">Ресурсы нужны для постройки зданий</div>
        </div>
        </div></div></div></div></div></div></div></div>
    </div>'
);

echo $messages[$_SESSION['message_state']];

$_SESSION['message_state'] = ($_SESSION['message_state'] + 1) % count($messages);   
require_once 'system/footer.php';
?>
