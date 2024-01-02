<?
require_once 'system/header.php';



if(isset($_GET['id'])) {
    $battle_id = $_GET['id'];
    $query = "SELECT * FROM `players` WHERE player_id = '$myID'";
    $result = mysqli_query($connect,$query);

    if(mysqli_num_rows($result) == 0){
        $query = "INSERT INTO `players` SET `player_id`=?, `battle_id`=?,`hp` = ?";
        $stmt = mysqli_prepare($connect, $query);

        mysqli_stmt_bind_param($stmt, "iii", $users['id'], $battle_id,$users['health']);

        mysqli_stmt_execute($stmt);
    }
    
    
    $names = [
        "Radiant", "Equinox", "Cascade", "Sapphire", "Inferno",
        "Astral", "Zenith", "Vortex", "Ethereal", "Genesis",
        "Tempest", "Stellar", "Eon", "Nebula", "Pinnacle",
        "Blizzard", "Paragon", "Crusader", "Tranquil", "Quasar",
        "Serenade", "Epoch", "Sylvan", "Eclipse", "Abyss",
        "Zephyr", "Aether", "Harmony", "Radiance", "Petal",
        "Ignition", "Echo", "Veritas", "Oracle", "Tempest",
        "Borealis", "Mystic", "Vivid", "Ecliptic", "Aurora",
        "Zion", "Aegis", "Viper", "Pandora", "Helios",
        "Elysium", "Majestic", "Chronos", "Atlantis", "Titanium",
        "Ragnarok", "Nemesis", "Infinity", "Serenity", "Quintessence",
        "Celestial", "Sapphire", "Mystique", "Valiant", "Onyx",
        "Quicksilver", "Renegade", "Thunderbolt", "Zephyr", "Cerulean",
        "Cynosure", "Pinnacle", "Quantum", "Epiphany", "Luminary",
        "Frostbite", "Sovereign", "Crystalline", "Phantom", "Radiant",
        "Empyrean", "Vivid", "Ecliptic", "Peregrine", "Nocturne",
        "Everest", "Rogue", "Elysian", "Apex", "Obsidian",
        "Typhoon", "Harbinger", "Solitude", "Sable", "Galactic",
        "Epic", "Polaris", "Cinder", "Eon", "Sapphire",
        "Quintessence", "Nimbus", "Halcyon", "Astral", "Luminous",
        "Oblivion", "Ephemeral", "Vanguard", "Ethereal", "Nether",
        "Radiant", "Inferno", "Abyss", "Celestial", "Apex"
    ];
    $tanks = [
        "img/countr/tanks/ger-istr.png",
        "img/countr/tanks/ger-sred.png",
        "img/countr/tanks/ger-tt.png",
        "img/countr/tanks/pt-buy-usa.png",
        "img/countr/tanks/ssr-ist.png",
        "img/countr/tanks/ssr-sredniy.png",
        "img/countr/tanks/ssr-tt.png",
        "img/countr/tanks/st-buy-germ.png",
        "img/countr/tanks/st-buy-usa.png",
        "img/countr/tanks/st-buy-ussr.png",
        "img/countr/tanks/tankimg-usa-ist.png",
        "img/countr/tanks/usa-sred.png",
        "img/countr/tanks/tt-buy-ussr.png"
    ];
    for ($i = 0; $i < 3; $i++) {
        $name = $names[array_rand($names)];
        $tank = $tanks[array_rand($tanks)];
        $stats = rand(200, 3000);
        $status = "active";
    
        $query = "INSERT INTO `battle_bots` SET `name` = ?, `attack` = ?, `armor` = ?, `health` = ?,`max_health` = ?, `status` = ?, `img` = ?";
        $stmt = $connect->prepare($query);
    
        $stmt->bind_param("siiiiss", $name, $stats, $stats, $stats, $stats,$status,$tank);
    
        if (!$stmt->execute()) {
            echo $stmt->error;
        }
    }

    $_SESSION['log'] = null;
    $_SESSION['msg'] = '<div class="buy-place-block">
    <div class="feedbackPanelINFO">
    <div class="line1">
    <span class="feedbackPanelINFO">Вы зарегистрированы. Готовьтесь к бою.</span>
    </div>
    </div>
    </div>';
    header("Location: pve");
}

$query = "SELECT * FROM `players` WHERE player_id = '$myID'";
$result = mysqli_query($connect,$query);
$c = mysqli_fetch_assoc($result);
$current_time = time();

$sql = "SELECT * FROM battles";
$result = $connect->query($sql);

$maxUnixTimestamp = 0;
$closest_battle = null;

$previous_battle = null;

while ($battle = mysqli_fetch_assoc($result)) {
    $start_time_unix = strtotime($battle['start_time']);


    $query_prev = "SELECT * FROM `battles` WHERE battle_id = {$battle['battle_id']}-1";
    $result_prev = mysqli_query($connect,$query_prev);
    $prev = mysqli_fetch_assoc($result_prev);
    
    
    
    if ($start_time_unix > $current_time) {
        // Проверяем, является ли это ближайшей битвой
        if ($start_time_unix < $maxUnixTimestamp || $maxUnixTimestamp == 0  and $battle['status'] != 'active' and $c['status'] != 'active' ) {
            $maxUnixTimestamp = $start_time_unix;
            $closest_battle = $battle;
        }
    }
}


    $query_player_battle = "SELECT * FROM `players` WHERE player_id = '$myID'";
    $result_player_battle = mysqli_query($connect,$query_player_battle);
    

    $query_curr_battle = "SELECT * FROM `curr_battle` LIMIT 1";
    $result_curr_battle = mysqli_query($connect,$query_curr_battle);
    $curr = mysqli_fetch_assoc($result_curr_battle);
    
    if(isset($curr) && !isset($closest_battle)) {
        if(mysqli_num_rows($result_player_battle) > 0) {
            $query_closes_battle = "SELECT * FROM `battles` WHERE battle_id = {$curr['battle_id']}";
            $result_closes_battle = mysqli_query($connect, $query_closes_battle);
            $closest_battle = mysqli_fetch_assoc($result_closes_battle);
        } else {
            $current_time = strtotime(date("H:i:s"));
            
            $query_closest_battle = "SELECT * FROM `battles` WHERE start_time < '{$current_time}' ORDER BY start_time ASC LIMIT 1";
            $result_closest_battle = mysqli_query($connect, $query_closest_battle);
            $closest_battle = mysqli_fetch_assoc($result_closest_battle);
        }
    }
    
    $battle_start_time = strtotime($closest_battle['start_time']);
    
    $time_difference = $battle_start_time - $current_time;
    
    $timer = gmdate("H:i:s", $time_difference - 5 );
    





$query_pl = "SELECT * FROM `players` WHERE battle_id = {$closest_battle['battle_id']}";
$result_pl = mysqli_query($connect,$query_pl);


echo $closest_battle['battle_id'];

echo $curr['battle_id'];


//and $closest_battle['battle_id'] == $curr['battle_id']

if($time_difference <= 5 and $closest_battle['status'] == 'waiting'){ // изменить !
    $query = "UPDATE `battles` SET `status` = 'active' WHERE battle_id = {$closest_battle['battle_id']}";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    
    $query = "UPDATE `players` SET `status` = 'active' WHERE battle_id = {$closest_battle['battle_id']}";
    $stmt = $connect->prepare($query);
    $stmt->execute();

    $deleteQuery = "DELETE FROM `curr_battle`";
    $deleteStmt = $connect->prepare($deleteQuery);
    $deleteStmt->execute();

    $query = "INSERT INTO `curr_battle` (`battle_id`) VALUES ({$closest_battle['battle_id']})";
    $stmt = $connect->prepare($query);
    $stmt->execute();    
}




$query_count = "SELECT * FROM `players` WHERE player_id = '$myID' AND battle_id = {$closest_battle['battle_id']}";
$result_count = mysqli_query($connect,$query_count);




if ($closest_battle['status'] == 'active' && mysqli_num_rows($result_count) > 0) {

    # Враг
    if (!isset($_SESSION['current_enemy'])) {

        $query_random = "SELECT * FROM `battle_bots` WHERE `status` = 'active' ORDER BY RAND() LIMIT 1";
        $result_random = mysqli_query($connect, $query_random);
        $enemies_Tank = mysqli_fetch_assoc($result_random);
        $_SESSION['current_enemy'] = $enemies_Tank;
    } else {
        $enemies_Tank = $_SESSION['current_enemy'];

        $query_random = "SELECT * FROM `battle_bots` WHERE name = '{$enemies_Tank['name']}'";
        $result_random = mysqli_query($connect, $query_random);
        $enemies_Tank = mysqli_fetch_assoc($result_random);
    }


    if(isset($_GET['changeTargetLink'])){
        $query_random = "SELECT * FROM `battle_bots` WHERE `status` = 'active' ORDER BY RAND() LIMIT 1";
        $result_random = mysqli_query($connect, $query_random);
        $enemies_Tank = mysqli_fetch_assoc($result_random);
        $_SESSION['current_enemy'] = $enemies_Tank;
        
        header("Location: pve");
    }


    if($enemies_Tank['health'] <= 0){
       $_SESSION['current_enemy'] = null;
    }

    
        # Я
        $query_me = "SELECT * FROM `players` WHERE player_id = '$myID'";
        $result_me = mysqli_query($connect,$query_me);
        $MyTank = mysqli_fetch_assoc($result_me);
        # Я


    if (isset($_GET['attackRegular'])) {

        $lastClickTimestamp = isset($_SESSION['last_click']) ? $_SESSION['last_click'] : 0;
        $currentTimestamp = time();
    
        if ($currentTimestamp - $lastClickTimestamp >= 2) {
            $_SESSION['last_click'] = $currentTimestamp;
    
            $timeDifference = $currentTimestamp - $lastClickTimestamp;
            $baseDamage = round($users['attach'] / 4) + rand(1, 5);
    
            $str = ($timeDifference <= 5) ? round($baseDamage * (1 - ($timeDifference / 5))) : $baseDamage;

            if($enemies_Tank['armor'] <= 500)
                $OverStrideWithArmor =  abs(round($str*(1000-$enemies_Tank['armor'])/1000)); // Основной урон с учетом защиты противника

            if($enemies_Tank['armor'] > 500)
                $OverStrideWithArmor =  abs(round($str*(2500-$enemies_Tank['armor'])/4000)); // Основной урон с учетом защиты противника

            if (!isset($_SESSION['log'])) {
                $_SESSION['log'] = array();
            }

            $query = "UPDATE `battle_wins` SET `uron` = `uron` + ? WHERE id_user = '$myID'";
            $stmt = $connect->prepare($query);
            $stmt->bind_param("i", $OverStrideWithArmor);
            $stmt->execute();

            $query = "UPDATE `battle_bots` SET `health` = `health` - ? WHERE id = '{$enemies_Tank['id']}'";
            $stmt = $connect->prepare($query);
            $stmt->bind_param("i", $OverStrideWithArmor);
            
            if ($stmt->execute()) {
    
                if ($enemies_Tank['health'] <= $OverStrideWithArmor) {
                    $query_ubit = "UPDATE `battle_bots` SET `status` = 'finished' WHERE id = ?";
                    $stmt_ubit = $connect->prepare($query_ubit);
                    $stmt_ubit->bind_param("i", $enemies_Tank['id']);
                    $stmt_ubit->execute();

                    $query_kill = "UPDATE `players` SET `kills` = `kills` + 1 WHERE player_id = ?";
                    $stmt_kill = $connect->prepare($query_kill);
                    $stmt_kill->bind_param("i", $myID);
                    $stmt_kill->execute();
                    
                    $query_kill = "UPDATE `battle_wins` SET `kills` = `kills` + 1 WHERE id_user = '$myID'"; 
                    $stmt_kill = $connect->prepare($query);
                    $stmt_kill->execute();

                    $logMessage = "<span class='td_u green1'>{$users['nick']} </span> Уничтожил <span class='yellow1 td_u yellow1'>{$enemies_Tank['name']}</span>";
                } else {
                    $logMessage = "<span class='td_u green1'>{$users['nick']} </span> выстрелил на <span class='yellow1 td_u yellow1'>{$enemies_Tank['name']}</span> на <span class='red1'>$OverStrideWithArmor урона</span>";
                }
                $query_uron = "UPDATE `players` SET `uron` = `uron` + ? WHERE player_id = ?";
                $stmt_uron = $connect->prepare($query_uron);
                $stmt_uron->bind_param("ii",$OverStrideWithArmor,$myID);
                $stmt_uron->execute();
                $_SESSION['log'][] = $logMessage;
            }
            // Урон по игроку
            $timeDifference = $currentTimestamp - $lastClickTimestamp;
            $baseDamage = round($enemies_Tank['attack'] / 4) + rand(1, 5);
            $str = ($timeDifference <= 5) ? round($baseDamage * (1 - ($timeDifference / 5))) : $baseDamage;
            
            if($users['armor'] <= 500)
                $OverStrideWithArmor =  abs(round($str*(1000-$users['armor'])/1000)); // Основной урон с учетом защиты противника

            if($users['armor'] > 500)
                $OverStrideWithArmor =  abs(round($str*(2500-$users['armor'])/4000)); // Основной урон с учетом защиты противника

                
                $query = "UPDATE `players` SET `hp` = `hp` - ? WHERE player_id = '$myID'";
                
                $stmt = $connect->prepare($query);

                $stmt->bind_param("i", $OverStrideWithArmor);
        
                if ($stmt->execute()) {
        
                    if ($MyTank['hp'] <= $OverStrideWithArmor) {             
                        $logMessage = "<span class='orange'><span class='yellow1 td_u'>{$enemies_Tank['name']}</span> уничтожил <span class='yellow1 td_u'>{$users['nick']}</span></span>;";
                    } else {
                        $logMessage = "<span class='yellow1 td_u yellow1'>{$enemies_Tank['name']}</span> выстрелил на <span class='td_u green1'>{$users['nick']}</span> на <span class='red1'>$OverStrideWithArmor урона</span>";
                    }
        
                    $_SESSION['log'][] = $logMessage;
                }

            header("Location: pve");
            exit();
        } else {
            $_SESSION['log'][] =  "<span class='gray1'>Снаряд ещё не заряжен</span>";
            header("Location: pve");
        }
    }
    
    # Враг

    // СТАТУС ЕСЛИ ИГРОКИ УМЕРЛИ
    $query = "SELECT * FROM `players` WHERE hp <= 0";
    $result = $connect->query($query);
    
    while ($row = $result->fetch_assoc()) {
        $myID = $row['player_id'];
        
        $query_ubit = "UPDATE `players` SET `status` = 'finished' WHERE player_id = ?";
        $stmt_ubit = $connect->prepare($query_ubit);
        $stmt_ubit->bind_param("i", $myID);
        $stmt_ubit->execute();
    }
    # СТАТУС ЕСЛИ ИГРОКИ УМЕРЛИ

    # ХП ВРАГА
    $progressHP = ($enemies_Tank['health'] / $enemies_Tank['max_health']) * 100;

    if($progressHP <= 0){
        $progressHP = 0;
        $enemies_Tank['health'] = 0;
    }
    # ХП ВРАГА

    # ХП МОЕ
    $progressHP_My = ($MyTank['hp'] / $users['health']) * 100;
    # ХП МОЕ
    echo '5'.'<br>';
    # Подсчет живых союзников
    $query = "SELECT * FROM `players` WHERE `status` = 'active'";
    $result = mysqli_query($connect,$query);
    $teams = mysqli_num_rows($result);
    $teams_for_bd = mysqli_fetch_assoc($result);
    # Подсчет живых ботов

    echo '6'.'<br>';

    $query = "SELECT * FROM `battle_bots` WHERE `status` = 'active'";
    $result = mysqli_query($connect,$query);
    $AnotherSide = mysqli_num_rows($result);

    # Подсчет всех ботов и игроков для результата
    $query = "SELECT * FROM `players`";
    $result = mysqli_query($connect,$query);
    $teamsBefore = mysqli_num_rows($result);

    $query = "SELECT * FROM `battle_bots`";
    $result = mysqli_query($connect,$query);
    $AnotherSideBefore = mysqli_num_rows($result);

    if($MyTank['hp'] > 0){
    echo '<div class="p5">
    <table>
    <tbody><tr>
    <td class="w50 pr1">
    <div class="trnt-block mb10">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="p5 cntr custombg boi_1" w:id="heroDiv">
    <div class="small bold green1 sh_b mb10 mt5">'.$users['nick'].'</div>
    <img class="tank-img" w:id="heroTankImg" src="'.$users['img'].'" alt="'.$users['nick'].'">
    <table class="rblock esmall">
    <tbody><tr>
    <td class="progr rate-block">
    
    <div class="scale-block">
    <div class="scale-next" style="width:'.$progressHP_My.'%;">
    <div class="scale" style="width:100%;"><div class="in">&nbsp;</div></div>
    </div>
    <div class="mask"><div class="in">&nbsp;</div></div>
    </div>
    
    </td>
    <td>
    <div class="value-block lh1"><span><span>'.$MyTank['hp'].'</span></span></div>
    </td>
    </tr>
    </tbody></table>
    </div>
    </div></div></div></div></div></div></div></div>
    </div>
    </td>
    <td class="w50 pl1">
    <div class="trnt-block mb10">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="p5 cntr custombg boi_1" w:id="targetDiv">
    <div class="small bold red1 sh_b mb10 mt5">'.$enemies_Tank['name'].'</div>
    <img class="tank-img" w:id="heroTankImg" src="' . ($enemies_Tank['health'] <= 0 ? 'images/podbit.png' : $enemies_Tank['img']) . '" alt="'.$enemies_Tank['name'].'">
    <table class="rblock esmall">
    <tbody><tr>
    <td class="progr rate-block">
    
    <div class="scale-block">
    <div class="scale-next" style="width:'.$progressHP.'%;">
    <div class="scale" style="width:100%;"><div class="in">&nbsp;</div></div>
    </div>
    <div class="mask"><div class="in">&nbsp;</div></div>
    </div>
    
    </td>
    <td>
    <div class="value-block lh1"><span><span>'.$enemies_Tank['health'].'</span></span></div>
    </td>
    </tr>
    </tbody></table>
    </div>
    </div></div></div></div></div></div></div></div>
    </div>
    </td>
    </tr>
    </tbody></table>
    <table>
    <tbody><tr>
    <td class="w50 pr5">
    <a w:id="attackRegularShellLink" href="?attackRegular" class="simple-but gray"><span><span>ОБЫЧНЫЕ</span></span></a>
    </td>
    <td class="w50 pl5">
    <a w:id="attackSpecialShellLink" href="pvp?28-25.ILinkListener-attackSpecialShellLink" class="simple-but"><span><span>БРОНЕБОЙНЫЕ&nbsp;(357)</span></span></a>
    </td>
    </tr>
    </tbody></table>
    <table>
    <tbody><tr>
    <td style="width:33%;padding-right:6px;">
    <a w:id="repairLink" href="pvp?28-25.ILinkListener-repairLink" class="simple-but blue"><span><span>Ремкомплект</span></span></a>
    
    </td>
    <td style="width:33%;padding:0 2px;">
    <a w:id="maneuverLink" href="pvp?28-25.ILinkListener-maneuverLink" class="simple-but blue"><span><span>Маневр</span></span></a>
    
    </td>
    <td style="width:33%;padding-left:6px;">
    <a w:id="changeTargetLink" href="?changeTargetLink" class="simple-but blue"><span><span>Сменить цель</span></span></a>
    </td>
    </tr>
    </tbody></table>';
    



}
else{
    echo '<div class="buy-place-block"><div class="line1">Ваш танк подбит. Ожидайте окончания сражения.</div> </div>';
    echo '<a href="pve" class="simple-but"><span><span>Обновить</span></span></a>';
}

    echo '<div class="medium bold white cntr mb6">
    Союзников: '.$teams.'
    Врагов: '.$AnotherSide.'
    </div>';

    echo '<div class="trnt-block mb6">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content small white">';
    foreach ($_SESSION['log'] as $log) {
        echo '<div class="log" style = "text-align:left;" >' . $log . '</div>';
    }
   echo '</div>
    </div></div></div></div></div></div></div></div>
    </div>
    <a w:id="escapeLink" href="pvp?28-25.ILinkListener-escapeLink" class="simple-but gray"><span><span>Покинуть бой</span></span></a>
    <div class="footer">
    
    </div>
    
    </div>';



    if(isset($teams) && isset($AnotherSide) && ($teams <= 0 || $AnotherSide <= 0)){
        $_SESSION['hide'] = false;
        
        $query = "INSERT INTO `info_pve` (`battle_id` , `TeamsWas` , `EnemiesWas` , `TeamsLive` , `EnemiesLive`) VALUES 
        ({$closest_battle['battle_id']}, '$teamsBefore' , '$AnotherSideBefore' , '$teams' , '$AnotherSide') ";
        $stmt = $connect->prepare($query);
        $stmt->execute();    

        $query = "UPDATE `battles` SET `status` = 'waiting' WHERE battle_id = {$closest_battle['battle_id']}";
        $stmt = $connect->prepare($query);
        $stmt->execute();
        $stmt->close();


        $query_Insert = "SELECT * FROM `players` ORDER BY `uron` DESC, `kills` DESC";
        $result_Insert = mysqli_query($connect,$query_Insert);
    
        while($teams_for_bd = mysqli_fetch_assoc($result_Insert)){
            $query_winners = "INSERT INTO `battle_wins` SET 
            `id_user` = '{$teams_for_bd['player_id']}',
            `uron` = '{$teams_for_bd['uron']}',
            `kills` = '{$teams_for_bd['kills']}',
            `battle_id` = '{$teams_for_bd['battle_id']}'";        
            $stmt_winners = $connect->prepare($query_winners);
            $stmt_winners->execute();
        
        }
        
        /*$query = "DELETE FROM battle_bots";
        $connect->query($query);
    
        $query = "DELETE FROM players";
        $connect->query($query);*/
    }
}



if($closest_battle['status'] == 'waiting'){
    
    if(!$_SESSION['hide']){
        # Условия конца сражения и вывод наград:

    
        $query_uron = "SELECT * FROM `battle_wins` ORDER BY `uron` DESC";
        $result_uron = mysqli_query($connect,$query_uron);
    
        $query_kills = "SELECT * FROM `battle_wins` ORDER BY `kills` DESC";
        $result_kills = mysqli_query($connect,$query_kills);
    
        echo '<div class="trnt-block mb5">
        <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
        <div class="wrap-content">
        
        <div class="mb5 inbl" style="text-align: left;margin-right: 30%;">
        <div class="thumb fl"><img src="img/battles/'.$closest_battle['img'].'"><span class="mask2">&nbsp;</span></div>
        <div class="ml58 small white sh_b bold">
        <span class="green2">'.$closest_battle['name'].'</span><br>
        <span>
        <span>закончилась 01:33:48 назад</span>
        </span><br>
        <span class="gray1">'.$closest_battle['type'].'</span>
        </div>
        <div class="clrb"></div>
        </div>
        
        <div class="small bold cntr gray1 sh_b mt2">';
        
        
        if($teams > 0){
           echo '<span class="green1">Победу одержали союзники!</span><br><span class="gray1">Все враги убиты</span>';
        }else{
            echo '<span class="red1">Победу одержали враги!</span><br><span class="gray1">Все союзники убиты</span>';
        }
        
        echo '<div class="white">
        <br>
        <span class="green2">Лучшие по убийствам</span><br>';
       
        $count = 0;
    
        while ($uron = mysqli_fetch_assoc($result_uron)) {
            $query_users_winners = "SELECT * FROM `users` WHERE id = '{$uron['id_user']}'";
            $result_users_winners = mysqli_query($connect,$query_users_winners);
            $users_winners = mysqli_fetch_assoc($result_users_winners);
    
            echo '<a href="profile?id='.$users_winners['id'].'">
                <img class="vb" height="14" width="14" src="img/rankets/'.$users_winners['side'].'/'.$users_winners['rang'].'.png?1">
                <span class="yellow1">' . $users_winners['nick'] . '</span></a>: ' . $uron['kills'] . ' врагов<br>';
        
            $count++;
        
            if ($count == 3) {
                break;
            }
        }
        
        echo '<br>
        <span class="green2">Лучшие по урону</span><br>';
        
        $count = 0;
    
        while ($kills = mysqli_fetch_assoc($result_kills)) {
            $query_users_winners = "SELECT * FROM `users` WHERE id = '{$kills['id_user']}'";
            $result_users_winners = mysqli_query($connect,$query_users_winners);
            $users_winners = mysqli_fetch_assoc($result_users_winners);
    
            echo '<a href="profile?id='.$users_winners['id'].'">
                <img class="vb" height="14" width="14" src="img/rankets/'.$users_winners['side'].'/'.$users_winners['rang'].'.png?1">
                <span class="yellow1">' . $users_winners['nick'] . '</span></a>: ' . $kills['uron'] . ' Урона<br>';
        
            $count++;
        
            if ($count == 3) {
                break;
            }
        }
        $query_info_pve = "SELECT * FROM `info_pve` WHERE battle_id = {$closest_battle['battle_id']} - 1";
        $result_info_pve = mysqli_query($connect,$query_info_pve);
        $info_pve = mysqli_fetch_assoc($result_info_pve);

        echo '</div>
        <br>
        В битве сражались:<br>
        Танки: <span class="green1">'.$info_pve['TeamsWas'].'</span> | Враги: <span class="red1">'.$info_pve['EnemiesWas'].'</span><br>
        Выжили:<br>
        Танки: <span class="green1">'.$info_pve['TeamsLive'].'</span> | Враги: <span class="red1">'.$info_pve['EnemiesLive'].'</span><br>
        </div>
        </div>
        </div></div></div></div></div></div></div></div>
        </div>';

        $_SESSION['hide'] = true;
    }

}


if(isset($teams) && isset($AnotherSide) && ($teams <= 0 || $AnotherSide <= 0)){

    $query = "DELETE FROM battle_bots";
    $connect->query($query);

    $query = "DELETE FROM players";
    $connect->query($query);
}
$Protected_Battles = mysqli_fetch_assoc($result_count);
if($Protected_Battles['status'] == 'waiting' or mysqli_num_rows($result_count) == 0){
echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">

<div class="white medium cntr bold mb5">Ближайшее сражение</div>

<div class="mb5 inbl" style = "text-align: left;position: relative;right: 13%;">
<div class="thumb fl"><img src="img/battles/'.$closest_battle['img'].'"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">'.$closest_battle['name'].'</span><br>
<span>
<span>до начала '.$timer.' ('.mysqli_num_rows($result_pl).' заявок)</span>
</span><br>
<span class="gray1">'.$closest_battle['type'].'</span>
</div>
<div class="clrb"></div>
</div>';


if(mysqli_num_rows($result_count) == 0){
echo '<div class="bot"><a class="simple-but border" href="pve?id='.$closest_battle['battle_id'].'"><span><span>Взвод, подъем! В атаку!</span></span></a>';
echo '<div style="position:relative;">
<span class="digit2 esmall">
<span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
</span>
</div>
</div>';
}
else echo '<div class="white medium cntr bold mb5">Вы в рядах участников</div>'; 





echo '</div>
</div></div></div></div></div></div></div></div>
</div>';



echo '<a w:id="refresh" href="pve" class="simple-but gray"><span><span>Обновить</span></span></a>';


echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="white medium cntr bold mb5">Все сражения</div>
';

$sql = "SELECT * FROM `battles` ORDER BY start_time ASC";
$result = mysqli_query($connect,$sql);

while ($row = $result->fetch_assoc()) {
    if($row['battle_id'] != $closest_battle['battle_id'] ){
        $battle_time = strtotime($row['start_time']);

        $time_difference = $battle_time - $current_time;

        $timer = gmdate("H:i:s", $time_difference - 5);

echo'
<div class="mb5 inbl" style = "text-align: left;position: relative;right: 14%;">
<div class="thumb fl"><img src="img/battles/'.$row['img'].'"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">'.$row['name'].'</span><br>
<span>
<span>до начала '.$timer.'</span>
</span><br>
<span class="gray1">'.$row['type'].'</span>
</div>
<div class="clrb"></div>
</div>';
    }
}
echo '<div class="bot">
<a w:id="past" class="simple-but gray border" href="pvepast"><span><span>Прошедшие сражения</span></span></a>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';
}   
require_once 'system/footer.php';
?>