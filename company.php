<?
require_once 'system/header.php';



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if($id != $users['id_clan']){
        $query = "SELECT * FROM `clan` WHERE id = '$id'";
        $result = mysqli_query($connect,$query);
        $clan = mysqli_fetch_assoc($result);
    }else{
        header("Location: company");
    }
} else {
    $CheckedClan = true;
    $query = "SELECT * FROM `clan` WHERE id = '{$users['id_clan']}'";
    $result = mysqli_query($connect,$query);
    $clan = mysqli_fetch_assoc($result);
    
}

function updateUserRank($userId, $newRank, $connect) {
    $query = "UPDATE users SET clan_rang = '$newRank' WHERE id = '$userId'";
    $result = mysqli_query($connect, $query);

    return $result;
}

function demoteUser($userId, $newRank , $connect){
    $query = "UPDATE users SET clan_rang = '$newRank' WHERE id = '$userId'";
    $result = mysqli_query($connect, $query);

    return $result;
}

function deleteUser($userId,$newRank,$connect){
    $query = "UPDATE users SET clan_rang = '$newRank', id_clan = 0, clan_exp = 0 WHERE id = '$userId'";
    $result = mysqli_query($connect, $query);

    return $result;
}

if(isset($_GET['id_user'])){
    require_once 'system/header.php';
    $id_user = $_GET['id_user'];

    $query_EditRang = "SELECT * FROM `users` WHERE id = '$id_user'";;
    $result_EditRang = mysqli_query($connect,$query_EditRang);
    $EditRang = mysqli_fetch_assoc($result_EditRang);

    switch($EditRang['clan_rang']){
        case 1: $clan_rang = ""; $name_rang = "новичок"; break;
        case 2: $clan_rang = ""; $name_rang = "рядовой"; break;
        case 3: $clan_rang = "officer"; $name_rang = "офицер"; break;
        case 4: $clan_rang = "general"; $name_rang = "генерал"; break;
        case 5: $clan_rang = "leader"; $name_rang = "замкомдив";break;
        case 6: $clan_rang = "leader"; $name_rang = "комдив";break;
    }

    if($users['clan_rang'] > $EditRang['clan_rang'] && $users['id_clan'] == $EditRang['id_clan'] ){


        if (isset($_GET['promote'])) {
            $newRank = $EditRang['clan_rang'] + 1;
            $success = updateUserRank($EditRang['id'], $newRank, $connect);
    
            if ($success) {
                $_SESSION['msg'] = '<div class="buy-place-block">
                <div class="feedbackPanelSUCCESS">
                <div class="line1">
                <span class="feedbackPanelSUCCESS">Звание повышено</span>
                </div>
                </div>
                </div>';
                header("Location: company?id_user=" . urlencode((int)$EditRang['id']));
            }
        }
    
        if (isset($_GET['demote'])) {
            $newRank = $EditRang['clan_rang']- 1;
            $success = updateUserRank($EditRang['id'], $newRank, $connect);
    
            if ($success) {
                $_SESSION['msg'] = '<div class="buy-place-block">
                <div class="feedbackPanelSUCCESS">
                <div class="line1">
                <span class="red1">Звание понижено</span>
                </div>
                </div>
                </div>';
                header("Location: company");
            }
        }

        if (isset($_GET['delete'])) {
            $newRank = 1;
            $success = deleteUser($EditRang['id'], $newRank, $connect);
            if ($success) {
                $_SESSION['msg'] = '<div class="buy-place-block">
                <div class="feedbackPanelSUCCESS">
                <div class="line1">
                <span class="red1">Игрок иссключен</span>
                </div>
                </div>
                </div>';
                header("Location: company?id_user=" . urlencode((int)$EditRang['id']));
            }
        }

        echo '<div class="buy-place-block pt2 mb10">

        <div class="medium bold white cntr sh_b mt5 mb5">Клановый ранг</div>

        <div class="line1">
        Игрок:<br>
        <span class="nwr">
        <a class="white" w:id="profileLink" href="profile?id='.$EditRang['id'].'">
                <img class="vb" height="14" width="14" src="img/rankets/' . $EditRang['side'] . '/' . $EditRang['rang'] . '.png?1">
        ' . $EditRang['nick'] . ', <span class="'.$clan_rang.'" w:id="rank">'. $name_rang .'</span></a>
        </span>
        </div>';
        if($EditRang['clan_rang']!=5)
            echo '<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?id_user='.$id_user.'&promote"><span><span>Повысить</span></span></a>';
        if($EditRang['clan_rang']!=1)
            echo '<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?id_user='.$id_user.'&demote"><span><span>Понизить</span></span></a>';
        else 
            echo '<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?id_user='.$id_user.'&delete"><span><span>Иссключить</span></span></a>';
        echo '</div>';
    }else{
        header("Location: company");
    }
    require_once 'system/footer.php';
    exit;
}

# Если миссий не сущетвует,создаем
$q = "SELECT * FROM `company_missions` ORDER BY `id` ASC";
$result = mysqli_query($connect, $q);


if ($result) {
    
    $insert_query = "INSERT INTO `company_missions_clan` (`id`, `id_missions`, `id_clan`, `max_koll` ,`gold` ,`silver`,`exp`) VALUES (?, ?, ?, ?,?,?,?)";
    $insert_statement = mysqli_prepare($connect, $insert_query);
    $ProtectedID_query = "SELECT `id_clan` FROM `company_missions_clan` WHERE `id_clan` = '{$users['id_clan']}'";
    $ProtectedResult = mysqli_query($connect, $ProtectedID_query);
    
    if ($insert_statement) {
        while ($p = mysqli_fetch_assoc($result)) {
            if(!mysqli_num_rows($ProtectedResult) > 0){
                $id_missions = $p['id'];
                $id_clan = $users['id_clan'];
                $max_koll = $p['koll'];
                $gold = $p['gold'];
                $silver = $p['silver'];
                $exp = $p['exp'];
                mysqli_stmt_bind_param($insert_statement, 'iiiiiii', $id, $id_missions, $id_clan, $max_koll,$gold,$silver,$exp);
                
                mysqli_stmt_execute($insert_statement);
            }
        }
        

        mysqli_stmt_close($insert_statement);
    } else {
        echo "Failed to prepare INSERT statement: " . mysqli_error($connect);
    }

    mysqli_free_result($result);
} else {
    echo "Failed to execute SELECT query: " . mysqli_error($connect);
}

# Если зданий не существует - создаем 
$query = "INSERT INTO `buildings_company` (`id_clan`) VALUES (?)";
$stmt = mysqli_prepare($connect,$query);
$ProtectedID_query = "SELECT `id_clan` FROM `buildings_company` WHERE `id_clan` = '{$users['id_clan']}'";
$ProtectedResult = mysqli_query($connect, $ProtectedID_query);
if(!mysqli_num_rows($ProtectedResult) > 0){
    mysqli_stmt_bind_param($stmt,"i",$users['id_clan']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

switch($clan['level']){
    case 0: $clan_exp = 100; break;
    case 1: $clan_exp = 360; break;
    case 2: $clan_exp = 600; break;
    case 3: $clan_exp = 1400; break;
    case 4: $clan_exp = 2500; break;
    case 5: $clan_exp = 4000; break;
    case 6: $clan_exp = 6000; break;
    case 7: $clan_exp = 10000; break;
    case 8: $clan_exp = 16000; break;
    case 9: $clan_exp = 32000; break;
    case 10: $clan_exp = 72000; break;
    case 11: $clan_exp = 96000; break;
    case 12: $clan_exp = 120000; break;
    case 13: $clan_exp = 160000; break;
    case 14: $clan_exp = 240000; break;
    case 15: $clan_exp = 360000; break;
    case 16: $clan_exp = 500000; break;
    case 17: $clan_exp = 660000; break;
    case 18: $clan_exp = 860000; break;
    case 19: $clan_exp = 1000000; break;
    case 20: $clan_exp = 1250000; break;
    case 21: $clan_exp = 1750000; break;
    case 22: $clan_exp = 2500000; break;
    case 23: $clan_exp = 4000000; break;
    case 24: $clan_exp = 6000000; break;
    case 25: $clan_exp = 9000000; break;
    case 26: $clan_exp = 13000000; break;
    case 27: $clan_exp = 20000000; break;
    case 28: $clan_exp = 50000000; break;
    case 29: $clan_exp = 80000000; break;
    case 30: $clan_exp = 120000000;break;
    case 31: $clan_exp = 170000000;break;
    case 32: $clan_exp = 230000000;break;
    case 33: $clan_exp = 300000000;break;
}

    $progressClan = round($clan['exp'] / $clan_exp * 100, 1);
    if ($progressClan > 100) $progressClan = 100;


    if($clan['level'] <= 10 ){
        $clan_avatar = 1;
    }else if($clan['level'] <= 20){
        $clan_avatar = 3;
    }else if($clan['level'] <= 30 ){
        $clan_avatar = 30; 
    }else if($clan['level'] <= 40 ){
        $clan_avatar = 31; 
    }


if($users['id_clan']==0 and !isset($_GET['id'])){
echo '<div class="green2 cntr bold sh_b small pb10 pt10">Дивизия - армейское соединение для ведения боевых действий.</div>';
echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="white cntr bold sh_b small pb10">Золото, потраченное на создание дивизии, будет переведено на счет дивизии</div>
<div class="bot">
<a class="simple-but border gray" href="newcompany"><span><span>Создать дивизию</span></span></a>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';
}



    if($clan['id'] > 0){
    echo '<div class="medium white bold cntr mb2 mt5">Дивизия 
    <img class="vb" src="img/clan/side/'. $clan['side'] .'/side.png?1">
     <span class="green2" w:id="name">'. $clan['name'] .'</span></div>';

    echo '<div class="cntr mb5">';


    $totalStars = 7;

    
    $currentUpgradeCost = $company_buildings['hq_level'];
    
    $filledStars = min(round($currentUpgradeCost / 23), $totalStars);
    
    $emptyStars = max(0, $totalStars - $filledStars);
    
    for ($i = 0; $i < $filledStars; $i++) {
        echo '<img class="mlr3" height="14" width="14" src="img/stars/starFull.png">';
    }
    
    for ($i = 0; $i < $emptyStars; $i++) {
        echo '<img class="mlr3" height="14" width="14" src="img/stars/starEmpty.png">';
    }
    echo '</div>';


     echo '<div class="trnt-block mb2" style ="text-align:left;" >
     <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
     <div class="wrap-content">
     <div class="thumb fl"><span w:id="avatarStoreLink"><em><img w:id="avatar" src="img/clan/avatar/'. $clan_avatar .'.png"><span class="mask2">&nbsp;</span></em></span></div>
     <div class="ml58 small white sh_b bold">
     Опыт: '. $clan['exp'] .' / из '. $clan_exp .' <br>';
    //  Экипаж: 1661 из 1680<br>
    //  Медали: 498 из 576
     echo'</div>
     <table class="rblock blue esmall">
     <tbody><tr>
     <td><div class="value-block lh1"><span><span><img height="14" width="14" src="img/ico/level.png?2"> '. $clan['level'] .'</span></span></div></td>
     <td class="progr"><div class="scale-block"><div class="scale" id="percentDiv" style="width: ' . $progressClan . '%;">&nbsp;</div></div></td>     <td><div class="value-block lh1"><span><span w:id="percent">'. round($progressClan) .'%</span></span></div></td>
     </tr>
     </tbody></table>
     <div class="clrb"></div>
     
     
     </div>
     </div></div></div></div></div></div></div></div>
     </div>';


     if($id!=$clan['id']){   
     echo '<div style="position:relative;">
     <a class="simple-but border mb2" w:id="bitvaLink" href="../bitva"><span><span>Битва дивизий</span></span></a>
     
     </div>';

     echo '<table>
     <tbody><tr>
     <td class="w50 p1">
     <div class="prel">
     <a class="simple-but border mb2" w:id="missionsLink" href="company_missions"><span><span>Миссии</span></span></a>
     
     <span class="digit esmall">
     <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
     </span>
     
     </div>
     </td>
     <td class="w50 p1">
     <div class="prel">
     <a class="simple-but border mb2" w:id="assaultLink" href="assault"><span><span>Спецзадание</span></span></a>
     </div>
     </td>
     </tr>
     </tbody></table>';

     echo '<div class="trnt-block mb2">
     <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
     <div class="wrap-content-mini">
     <div class="mt5 mb5 small green1 cntr">В штабе доступно пополнение.</div>
     </div>
     </div></div></div></div></div></div></div></div>
     </div>';

     echo '<div class="cntr fs0 mb0">
     <a w:id="hqLink" class="thumb inbl m3" href="hq"><img width="50" height="50" src="img/clan/hq.png"><span class="mask1">&nbsp;</span></a>
     <div class="inbl prel medium">
     <a w:id="barracksLink" class="thumb inbl m3" href="barracks"><img width="50" height="50" src="img/clan/barracks.png"><span class="mask1">&nbsp;</span></a>
     
     </div>
     <div class="inbl prel medium">
     <a w:id="fuelDepotLink" class="thumb inbl m3" href="fuelDepot"><img width="50" height="50" src="img/clan/fuelDepot.png"><span class="mask1">&nbsp;</span></a>
     
     <span class="digit tr5 esmall">
     <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
     </span>
     
     </div>
     <a w:id="polygonLink" class="thumb inbl m3" href="company_polygon"><img width="50" height="50" src="img/clan/polygon.png"><span class="mask1">&nbsp;</span></a>
     </div>';

     echo '<table>
     <tbody><tr>
     
     <td class="w50 p1">
     <div class="prel">
     <a class="simple-but border" w:id="clanBoard" href="../forum/23842"><span><span>Форум</span></span></a>
     
     </div>
     </td>
     
     
     <td class="w50 p1">
     <div class="prel">
     <a class="simple-but border" w:id="clanChat" href="../cchat/23842"><span><span>Чат</span></span></a>
     
     </div>
     </td>
     
     </tr>
     </tbody></table>';
        
    }else{
        echo '<table>
        <tbody><tr>
        
        <td class="w50 p1">
        <div class="prel">
        <a class="simple-but border" w:id="clanBoard" href="../forum/19542/s/39466"><span><span>Форум</span></span></a>
        
        </div>
        </td>
        
        
        </tr>
        </tbody></table>';

        
    }
    $query = "SELECT * FROM `users` WHERE id_clan = '{$clan['id']}'";
    $result = mysqli_query($connect, $query);
    
    $row_count = mysqli_num_rows($result);
    
    $playersPerPage = 12;
    
    $totalPages = ceil($row_count / $playersPerPage);
    
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    
    $offset = ($currentPage - 1) * $playersPerPage;
    
    $query = "SELECT * FROM `users` WHERE id_clan = '{$clan['id']}' ORDER BY clan_rang DESC, clan_exp DESC LIMIT $playersPerPage OFFSET $offset";
    $result = mysqli_query($connect, $query);
    
    echo '<div class="white medium cntr bold mb5">
    <div class="mb0"><img height="14" width="14" src="img/ico/online.png"> Танкистов: ' . $row_count . ' из 24<span class="green1"></span></div>
    </div>';
    
    while ($members = mysqli_fetch_assoc($result)) {
        switch($members['clan_rang']){
            case 1: $clan_rang = ""; $name_rang = "новичок"; break;
            case 2: $clan_rang = ""; $name_rang = "рядовой"; break;
            case 3: $clan_rang = "officer"; $name_rang = "офицер"; break;
            case 4: $clan_rang = "general"; $name_rang = "генерал"; break;
            case 5: $clan_rang = "leader"; $name_rang = "замкомдив";break;
            case 6: $clan_rang = "leader"; $name_rang = "комдив";break;
        }

        echo '<table class="tlist white sh_b bold small mb10" style="margin-bottom: 0px !important;">
        <tbody><tr w:id="members">
        <td class="usr w100" style = "display:flex;" >
        <a class="white" w:id="profileLink" href="profile?id='.$members['id'].'">
        
        <img class="vb" height="14" width="14" src="img/rankets/' . $members['side'] . '/' . $members['rang'] . '.png?1">
         ' . $members['nick'] . ', <span class="'.$clan_rang.'" w:id="rank">'. $name_rang .'</span>, 
        <img class="ico vm" src="img/ico/exp.png" alt="опыт" title="опыт"> ' . $members['clan_exp'] . '
        
        
        </a>';
        if($users['clan_rang'] > $members['clan_rang'] and $users['clan_rang'] != 1 and $users['clan_rang'] != 2
        && $users['id_clan'] == $members['id_clan'])
           echo '<span style="float: right;margin-left: auto;padding: 1px 11px;"><a href="company?id_user='.$members['id'].'"><img style = "width:95%;" src="img/clan/settings.png" class="icon"></a></span>';
        echo '</td>
        </tr>';
    }
    

    
    
   echo '</tbody></table><br>';
   echo '<div class="pgn">';

   for ($page = 1; $page <= $totalPages; $page++) {
       if ($page == $currentPage) {
           echo '<span class="simple-but gray current" title="Go to page ' . $page . '"><em><span><span>' . $page . '</span></span></em></span>';
       } else { 
           echo '<a class="simple-but gray" href="company?id=' . $clan['id'] . '&page=' . $page . '" title="Go to page ' . $page . '"><span><span>' . $page . '</span></span></a>';
       }
   }
   
   echo '</div>';
}

if(isset($_GET['exitDiv'])){
    $query = "UPDATE `users` SET `attach` = `attach` - ?, `armor` = `armor` - ?, `accuracy` = `accuracy` - ?, `health` = `health` - ? WHERE `id` = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("iiiii", $clan['bonus_stats'], $clan['bonus_stats'], $clan['bonus_stats'], $clan['bonus_stats'], $myID);
    $stmt->execute();
    $stmt->close();    

    $query = "UPDATE `users` SET `id_clan` = 0, `clan_rang` = 1, `clan_exp` = 0 WHERE `id` = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("s", $myID);
    $stmt->execute();
    $stmt->close();
    


    header('Location:angar');
}

if($id!=$clan['id']){
echo '<a class="simple-but gray mb5" w:id="dzLink" href="../dzview/1878"><span><span>Соревнование</span></span></a>';
echo '<a class="simple-but gray mb5" w:id="statsLink" href="../companystats/1878"><span><span>Статистика</span></span></a>';
echo '<a class="simple-but gray mb5" w:id="eventsLink" href="../companyevents/1878"><span><span>Журнал</span></span></a>';
echo '<div class="mb5">
<a class="simple-but gray" w:id="leaveClanLink" href="company?exitDiv"><span><span>Покинуть дивизию</span></span></a></div>';

echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Звания в дивизии выдает комдив</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';
}
require_once 'system/footer.php';
?>