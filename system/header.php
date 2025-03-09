<?php
    include 'system/core.php';
    session_start();

    $nickname = "";
   
    if (isset($_SESSION['nickname'])) {
        $nickname = $_SESSION['nickname'];
    } else {
        echo "Вы не авторизованы.";
        header("Location: index");
        exit; 
    }
    
    $qForUs = "SELECT * FROM `users`";
    $resForUs = mysqli_query($connect,$qForUs);
    if($resForUs){
      $allUs = mysqli_fetch_assoc($resForUs);
    }



    $query = "SELECT * FROM `users` WHERE `nick` = '$nickname'";
    
    $result = mysqli_query($connect, $query);
    if ($result) {
        $users = mysqli_fetch_assoc($result);

    } else {
        echo "Query failed: " . mysqli_error($connect);
    }


    
    $MySumStats = $users['attach']+$users['armor']+$users['accuracy']+$users['health'];
    // id, nick, attach, armor, accuracy, health, img,rang,side
    $ratus = "SELECT * FROM users ORDER BY id DESC";

    $result1 = mysqli_query($connect, $ratus);
    
    $myID = $users['id'];
  
    $myIMG = "../" . $users['img'];


    # Окно с тестом "Миссия выполнена"
    $company_missions_query = "SELECT * FROM `company_missions`";
    $result = mysqli_query($connect, $company_missions_query);
    
    $company_missions_clan_query = "SELECT * FROM `company_missions_clan` WHERE id_clan = {$users['id_clan']} AND (first_user = '$myID' OR support_user = '$myID')";
    $company_missions_clan_result = mysqli_query($connect, $company_missions_clan_query);

    while ($q = mysqli_fetch_assoc($result)) {
        
        $company_missions_clan = mysqli_fetch_assoc($company_missions_clan_result);
        
        $q['koll'] = $company_missions_clan['max_koll'];
        

        
        if ($company_missions_clan) {

            if ($company_missions_clan['koll'] >= $q['koll']) {
                
                echo '<div class="trnt-block">
                <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
                <div class="wrap-content cntr">
                <div class="mb10">
                <img height="14" width="14" src="img/ico/victory.png"> <a class="green1 small bold td_u" href="company/missions">Миссия выполнена</a> <img height="14" width="14" src="img/ico/victory.png">
                </div>
                <div class="bot">
                <a class="simple-but border" href="company_missions"><span><span>За наградой</span></span></a>
                </div>
                </div>
                </div></div></div></div></div></div></div></div>
                </div>';
                $check_existing_query = "SELECT COUNT(*) as count FROM `take_missions` WHERE `id_user` = ?";
                $check_stmt = $connect->prepare($check_existing_query);
                $check_stmt->bind_param("i", $myID);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();
                $count_row = $check_result->fetch_assoc();
                
                if ($count_row['count'] == 0) {
                    $query_stmt = "INSERT INTO `take_missions` (`gold`, `silver`, `exp`, `id_user`, `id_missions`) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $connect->prepare($query_stmt);
                
                    $stmt->bind_param("iiiii", $company_missions_clan['gold'], $company_missions_clan['silver'], $company_missions_clan['exp'], $company_missions_clan['first_user'], $company_missions_clan['id_missions']);
                    $stmt->execute();
                
                    if($company_missions_clan['support_user'] != 0){
                    $stmt->bind_param("iiiii", $company_missions_clan['gold'], $company_missions_clan['silver'], $company_missions_clan['exp'], $company_missions_clan['support_user'], $company_missions_clan['id_missions']);
                    $stmt->execute();
                    }
                }
                
                $stmt->close();
                $check_stmt->close();
                
                $query = "UPDATE `company_missions_clan` SET `first_user` = 0, `support_user` = 0, `time` = ?, `koll` = `koll` = 0, `over` = `over` = 0 WHERE id_missions = ?";
                $stmt = $connect->prepare($query);
                $time = time() + 23 * 3600;
                $stmt->bind_param("ii",$time,$company_missions_clan['id_missions']);
                $stmt->execute();
                
                $updateStarsQuery = "UPDATE `clan` SET `stars` = `stars` + ? WHERE `id` = ?";
                $updateStarsStmt = $connect->prepare($updateStarsQuery);
                $randStars = rand(1, 5);
                $idClan = $users['id_clan'];
                $updateStarsStmt->bind_param("ii", $randStars, $idClan);
                $updateStarsStmt->execute();


            }
        }


    }


        # Истекает миссия
        $company_missions_query = "SELECT * FROM `company_missions`";
        $result = mysqli_query($connect, $company_missions_query);
        
        $company_missions_clan_query = "SELECT * FROM `company_missions_clan` WHERE id_clan = {$users['id_clan']}";
        $company_missions_clan_result = mysqli_query($connect, $company_missions_clan_query);
    
        while ($q = mysqli_fetch_assoc($result)) {
            
            $company_missions_clan = mysqli_fetch_assoc($company_missions_clan_result);
    
            $time_diff = $company_missions_clan['over'] - time();
    
            if($time_diff <= 0){
                $query = "UPDATE `company_missions_clan` SET `first_user` = 0, `support_user` = 0, `time` = ?, `koll` = 0, `over` = 0 WHERE id_missions = ?";
                $stmt = $connect->prepare($query);
                $time = 0;
                $stmt->bind_param("ii",$time,$company_missions_clan['id_missions']);
                $stmt->execute();
            }
        }

    switch($users['rang']){
        case 0: $bonusrang = 0; break;
        case 1: $bonusrang = 3; break;
        case 2: $bonusrang = 5; break;
        case 3: $bonusrang = 7; break;
        case 4: $bonusrang = 11; break;
        case 5: $bonusrang = 15; break;
        case 6: $bonusrang = 20; break;
        case 7: $bonusrang = 25; break;
    }

    switch($users['rang']){
        case 0: $rangName = "Кадет"; break;
        case 1: $rangName = "Рядовой"; break;
        case 2: $rangName = "Сержант"; break;
        case 3: $rangName = "Лейтенант"; break;
        case 4: $rangName = "Капитан"; break;
        case 5: $rangName = "Майор"; break;
        case 6: $rangName = "Подполковник"; break;
        case 7: $rangName = "Полковник"; break;
    }

    
    switch($users['level']){
        case 1: $exp = 1; break;
        case 2: $exp = 9; break;
        case 3: $exp = 15; break;
        case 4: $exp = 35; break;
        case 5: $exp = 60; break;
        case 6: $exp = 95; break;
        case 7: $exp = 150; break;
        case 8: $exp = 250; break;
        case 9: $exp = 400; break;
        case 10: $exp = 600; break;
        case 11: $exp = 700; break;
        case 12: $exp = 800; break;
        case 13: $exp = 1000; break;
        case 14: $exp = 1500; break;
        case 15: $exp = 2000; break;
        case 16: $exp = 3000; break;
        case 17: $exp = 4000; break;
        case 18: $exp = 5000; break;
        case 19: $exp = 7000; break;
        case 20: $exp = 8000; break;
        case 21: $exp = 9000; break;
        case 22: $exp = 10000; break;
        case 23: $exp = 12500; break;
        case 24: $exp = 17500; break;
        case 25: $exp = 25000; break;
        case 26: $exp = 50000; break;
        case 27: $exp = 80000; break;
        case 28: $exp = 110000; break;
        case 29: $exp = 125000; break;
        case 30: $exp = 175000; break;
        case 31: $exp = 200000; break;
        case 32: $exp = 250000; break;
        case 33: $exp = 400000; break;
        case 34: $exp = 500000; break;
        case 35: $exp = 600000; break;
        case 36: $exp = 700000; break;
        case 37: $exp = 800000; break;
        case 38: $exp = 1250000; break;
        case 39: $exp = 1750000; break;
        case 40: $exp = 2250000; break;
        case 41: $exp = 4500000; break;
        case 42: $exp = 6000000; break;
        case 43: $exp = 8000000; break;
        case 44: $exp = 10000000; break;
        case 45: $exp = 12500000; break;
        case 46: $exp = 15000000; break;
        case 47: $exp = 20000000; break;
        case 48: $exp = 30000000; break;
        case 49: $exp = 40000000; break;
        case 50: $exp = 50000000; break;
        case 51: $exp = 75000000; break;
        case 52: $exp = 110000000; break;
        case 53: $exp = 150000000; break;
        case 54: $exp = 200000000; break;
        case 55: $exp = 250000000; break;
        case 56: $exp = 300000000; break;
        case 57: $exp = 350000000; break;
        case 58: $exp = 425000000; break;
        case 59: $exp = 500000000; break;
        case 60: $exp = 600000000; break;
    }

    $query = "SELECT * FROM `clan` WHERE id = '{$users['id_clan']}'";
    $result = mysqli_query($connect,$query);
    $clan = mysqli_fetch_assoc($result);

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


    switch ($users['level']) {
        case 1:
            $goldReward = 5;
            $silverReward = 50;
            break;
        case 2:
            $goldReward = 10;
            $silverReward = 50;
            break;
        case 3:
            $goldReward = 25;
            $silverReward = 50;
            break;
        case 4:
            $goldReward = 50;
            $silverReward = 50;
            break;
        case 5:
            $goldReward = 75;
            $silverReward = 50;
            break;
        case 6:
            $goldReward = 90;
            $silverReward = 50;
            break;
        case 7:
            $goldReward = 125;
            $silverReward = 50;
            break;
        case 8:
            $goldReward = 145;
            $silverReward = 50;
            break;
        case 9:
            $goldReward = 250;
            $silverReward = 50;
            break;
        case 10:
            $goldReward = 350;
            $silverReward = 500;
            break;
        case 11:
            $goldReward = 450;
            $silverReward = 50;
            break;
        case 12:
            $goldReward = 550;
            $silverReward = 50;
            break;
        case 13:
            $goldReward = 700;
            $silverReward = 50;
            break;
        case 14:
            $goldReward = 850;
            $silverReward = 50;
            break;
        case 15:
            $goldReward = 950;
            $silverReward = 50;
            break;
        case 16:
            $goldReward = 1100;
            $silverReward = 50;
            break;
        case 17:
            $goldReward = 1200;
            $silverReward = 50;
            break;
        case 18:
            $goldReward = 1300;
            $silverReward = 50;
            break;
        case 19:
            $goldReward = 1400;
            $silverReward = 50;
            break;
        case 20:
            $goldReward = 1500;
            $silverReward = 50;
            break;
        case 21:
            $goldReward = 1600;
            $silverReward = 50;
            break;
        case 22:
            $goldReward = 1700;
            $silverReward = 50;
            break;
        case 23:
            $goldReward = 1800;
            break;
        case 24:
            $goldReward = 1900;
            break;
        case 25:
            $goldReward = 2000;
            break;
        case 26:
            $goldReward = 2100;
            break;
        case 27:
            $goldReward = 2200;
            break;
        case 28:
            $goldReward = 2300;
            break;
        case 29:
            $goldReward = 2400;
            break;
        case 30:
            $goldReward = 2500;
            break;
        case 31:
            $goldReward = 2600;
            break;
        case 32:
            $goldReward = 2700;
            break;
        case 33:
            $goldReward = 2800;
            break;
        case 34:
            $goldReward = 2900;
            break;
        case 35:
            $goldReward = 3000;
            break;
        case 36:
            $goldReward = 3100;
            break;
        case 37:
            $goldReward = 3200;
            break;
        case 38:
            $goldReward = 3300;
            break;
        case 39:
            $goldReward = 3400;
            break;
        case 40:
            $goldReward = 3500;
            break;
        case 41:
            $goldReward = 3600;
            break;
        case 42:
            $goldReward = 3700;
            break;
        case 43:
            $goldReward = 3800;
            break;
        case 44:
            $goldReward = 3900;
            break;
        case 45:
            $goldReward = 4000;
            break;
        case 46:
            $goldReward = 4100;
            break;
        case 47:
            $goldReward = 4200;
            break;
        case 48:
            $goldReward = 4300;
            break;
        case 49:
            $goldReward = 4400;
            break;
        case 50:
            $goldReward = 4500;
            break;
        case 51:
            $goldReward = 4600;
            break;
        case 52:
            $goldReward = 4700;
            break;
        case 53:
            $goldReward = 4800;
            break;
        case 54:
            $goldReward = 4900;
            break;
        case 55:
            $goldReward = 5000;
            break;
        case 56:
            $goldReward = 5100;
            break;
        case 57:
            $goldReward = 5200;
            break;
        case 58:
            $goldReward = 5300;
            break;
        case 59:
            $goldReward = 5400;
            break;
        case 60:
            $goldReward = 5500;
        }

    // последний онлайн игрока
    $lastOnline = time();
    $query = "UPDATE `users` SET `lastOnline` = ? WHERE `id` = ?";
    $stmt = $connect->prepare($query);
    
    if ($stmt) { // успешно
        $stmt->bind_param("si", $lastOnline, $myID);
        $stmt->execute();
        $stmt->close();
    }
    // Сколько не было в сети
    $lOnline = $lastOnline - $users['lastOnline']; 
    
        
    $currentDate = time();
    $dateDiff = $currentDate - $users['fuel_change'];
    $newFuel = $users['fuel'];
        while ($dateDiff > 464 && $newFuel < $users['maximumFuel']){
            $newFuel += 30;
            if ($newFuel >= $users['maximumFuel']) {
                break;
            }
            $dateDiff = $dateDiff - 464; // 464 сек == 7 мин
        }
        $ForOverFuel = 464 - $dateDiff;

        $minutesOverFuel = floor($ForOverFuel / 60); // Получаем количество минут
        $secondsOverFuel = $ForOverFuel % 60; // Получаем количество секунд
        
    
    if ($newFuel != $users['fuel']) {;
        $query = "UPDATE `users` SET `fuel` = ? , `fuel_change` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        
        if ($stmt) { // успешно
            $stmt->bind_param("iii", $newFuel,$currentDate,$myID);
            $stmt->execute();
            $stmt->close();
        }
    }
    # Нация танка
    $IMG = "../" . $users['img'];

    $query = "SELECT * FROM `tanks` WHERE img = '$IMG'";
    $result = mysqli_query($connect,$query);
    $nation = mysqli_fetch_assoc($result);

    # Нация танка

    // выход из аккаунта
    if (isset($_GET['exit'])) {
        $_SESSION = array();
        session_destroy();
        header('Location: index');
        exit;
    }



    # цвета текста взависимости от прав
    if($users['access'] == 0) $colorText = 'users';
    elseif($users['access'] == 1) $colorText = 'moderator';
    elseif($users['access'] == 2) $colorText = 'admin';


    // VIP 1
    $query = "SELECT * FROM `vip` WHERE id_user = '$myID' AND id_vip = 1";
    $result = mysqli_query($connect, $query);
    $vip_1 = mysqli_fetch_assoc($result);

    $current_time = time();
    $remaining_time = $vip_1['time'] - $current_time;

    if ($remaining_time < 0) {
        $query = "DELETE FROM `vip` WHERE id_user = '$myID' AND id_vip = 1";
        $result = mysqli_query($connect, $query);
    }
    // VIP 1


    // VIP 2
    $query = "SELECT * FROM `vip` WHERE id_user = '$myID' AND id_vip = 2";
    $result = mysqli_query($connect, $query);
    $vip_2 = mysqli_fetch_assoc($result);

    $remaining_time_2 = $vip_2['time'] - $current_time;

    if ($remaining_time_2 < 0) {
        $query = "DELETE FROM `vip` WHERE id_user = '$myID' AND id_vip = 2";
        $result = mysqli_query($connect, $query);
    }
    // VIP 2

    // VIP 3
    $query = "SELECT * FROM `vip` WHERE id_user = '$myID' AND id_vip = 3";
    $result = mysqli_query($connect, $query);
    $vip_3 = mysqli_fetch_assoc($result);

    $remaining_time_3 = $vip_3['time'] - $current_time;

    if ($remaining_time_3 < 0) {
        $query = "DELETE FROM `vip` WHERE id_user = '$myID' AND id_vip = 3";
        $result = mysqli_query($connect, $query);
    }
    // VIP 3

    // VIP 4
    $query = "SELECT * FROM `vip` WHERE id_user = '$myID' AND id_vip = 4";
    $result = mysqli_query($connect, $query);
    $vip_4 = mysqli_fetch_assoc($result);

    $remaining_time_4 = $vip_4['time'] - $current_time;

    if ($remaining_time_4 < 0) {
        $query = "DELETE FROM `vip` WHERE id_user = '$myID' AND id_vip = 4";
        $result = mysqli_query($connect, $query);
    }
    // VIP 4

$query_user_builds = "SELECT * FROM `buildings_user` WHERE id_user = '$myID' AND id_buildings = 2";
$result_user_buidls = mysqli_query($connect,$query_user_builds);
$polygon = mysqli_fetch_assoc($result_user_buidls);


switch ($polygon['buildings_level']) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        $statsEffect = 10;
        break;
    case 6:
    case 7:
    case 8:
    case 9:
    case 10:
        $statsEffect = 20;
        break;
    case 11:
    case 12:
    case 13:
    case 14:
    case 15:
        $statsEffect = 30;
        break;
    case 16:
        $statsEffect = 50;
        break;
    case 17:
        $statsEffect = 70;
        break;
}

    // POLYGON 1
        $query = "SELECT * FROM `polygon` WHERE id_user = '$myID' AND id_effect = 1";
        $result = mysqli_query($connect, $query);
        $effect_1 = mysqli_fetch_assoc($result);
        
        $time_pol_1 = $effect_1['time'] - $current_time;

        if ($time_pol_1 < 0 && $effect_1['processed']) {
            
            $query = "UPDATE `polygon` SET `processed` = 0 WHERE id_user = '$myID' AND id_effect = 1";
            $result = mysqli_query($connect, $query);

            $query = "DELETE FROM `polygon` WHERE id_user = '$myID' AND id_effect = 1";
            $result = mysqli_query($connect, $query);

            $query = "UPDATE `users` SET `attach` = `attach` - ? WHERE id = ?";
            $stmt = $connect->prepare($query);
            $stmt->bind_param("ii",$statsEffect,$myID); 
            $stmt->execute();
        }
    // POLYGOM 1


    // POLYGON 2
        $query = "SELECT * FROM `polygon` WHERE id_user = '$myID' AND id_effect = 2";
        $result = mysqli_query($connect, $query);
        $effect_2 = mysqli_fetch_assoc($result);
        
        $time_pol_2 = $effect_2['time'] - $current_time;

        if ($time_pol_2 < 0 && $effect_2['processed']) {
            $query = "UPDATE `polygon` SET `processed` = 0 WHERE id_user = '$myID' AND id_effect = 2";
            $result = mysqli_query($connect, $query);

            $query = "DELETE FROM `polygon` WHERE id_user = '$myID' AND id_effect = 2";
            $result = mysqli_query($connect, $query);

            $query = "UPDATE `users` SET `armor` = `armor` - ? WHERE id = ?";
            $stmt = $connect->prepare($query);
            $stmt->bind_param("ii",$statsEffect,$myID); 
            $stmt->execute();
        }
    // POLYGOM 2

    // POLYGON 3
    $query = "SELECT * FROM `polygon` WHERE id_user = '$myID' AND id_effect = 3";
    $result = mysqli_query($connect, $query);
    $effect_3 = mysqli_fetch_assoc($result);
    
    $time_pol_3 = $effect_3['time'] - $current_time;

    if ($time_pol_3 < 0 && $effect_3['processed']) {
        $query = "UPDATE `polygon` SET `processed` = 0 WHERE id_user = '$myID' AND id_effect = 3";
        $result = mysqli_query($connect, $query);

        $query = "DELETE FROM `polygon` WHERE id_user = '$myID' AND id_effect = 3";
        $result = mysqli_query($connect, $query);

        $query = "UPDATE `users` SET `accuracy` = `accuracy` - ? WHERE id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ii",$statsEffect,$myID); 
        $stmt->execute();
    }
    // POLYGOM 3

    // POLYGON 4
    $query = "SELECT * FROM `polygon` WHERE id_user = '$myID' AND id_effect = 4";
    $result = mysqli_query($connect, $query);
    $effect_4 = mysqli_fetch_assoc($result);

    $time_pol_4 = $effect_4['time'] - $current_time;

    if ($time_pol_4 < 0 && $effect_4['processed']) {
        $query = "UPDATE `polygon` SET `processed` = 0 WHERE id_user = '$myID' AND id_effect = 4";
        $result = mysqli_query($connect, $query);

        $query = "DELETE FROM `polygon` WHERE id_user = '$myID' AND id_effect = 4";
        $result = mysqli_query($connect, $query);

        $query = "UPDATE `users` SET `health` = `health` - ? WHERE id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ii",$statsEffect,$myID); 
        $stmt->execute();
    
    }
    // POLYGOM 4



    # Бонусы с учетом всего
    $S_Regular = $users['skills_spots'] * 10;
    //$S_Special = 

    # Урон 
    $Y = round(($users['attach'] + $S_Regular) / 4);


    # Бонус опыта личеый
    $expirience = $bonusrang + $users['skills_instruktor'] * 0.9;


    # Бонус опыта дивы
    $expirience_company = $users['skills_officer'] * 0.5;

    ?>

<div class="round-panel">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <div class="wrp1">
            <div class="wrp2">
                <table class="count bold">
                    <tbody>
                        <tr>
                            <td class="small lh1 bgn">
                                <img src="img/ico/fuel.png" alt=""><? echo $users['fuel']?>
                            </td>
                            <td class="small lh1 pl12">
                                <img src="img/ico/gold.png" alt=""> <? echo $users['gold']?> 
                            </td>
                            <td class="small lh1 pl12">
                                <img src="img/ico/silver.png" alt=""> <? echo $users['silver']?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <table class="rblock blue esmall">
      <tbody>
        <tr>
          <td>
            <div class="value-block lh1">
              <span>
                <span>
                  <img height="14" width="14" src="img/ico/level.png"> <? echo $users['level']?>
                </span>
              </span>
            </div>
          </td>
          <td class="progr">
            <div class="scale-block">
              <?
                if ($users['level'] != 30) {
                    $progress = round($users['exp'] / $exp * 100, 1);
                    if ($progress > 100) $progress = 100;
                    echo '<div class="scale" style="width:' . $progress . '%;">&nbsp;</div>';
                }
              ?>
            </div>
          </td>
          <td>
            <div class="value-block lh1">
              <span>
                <span><?php echo round($progress); ?> %</span>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <?
        if(isset($_GET['acceptLink'])){
            echo $clan_invite['id_clan'];
            /*$query = "UPDATE `users` SET `id_clan` = ? , `gold` = ? WHERE `id` = ?";
            $stmt = $connect->prepare($query);
            $fuel = $users['maximumFuel'];
            $g = $users['gold'] - 60;
            if ($stmt) { // успешно
                $stmt->bind_param("iii", $fuel, $g, $myID);
                $stmt->execute();
                $stmt->close();
                header("Location: battle");
            }*/
        }


    $query = "SELECT * FROM `buildings_company` WHERE id_clan = {$users['id_clan']}";
    $result = mysqli_query($connect,$query);
    $company_buildings = mysqli_fetch_assoc($result);

    $hqLevel = $company_buildings['hq_level'];
    $upgradeCosts = [30, 60, 90, 120, 150, 160];
    $upgradePrices = [800, 2400, 4800, 8000, 16000, 32000];


    $nextLevel = $hqLevel + 1;

    if ($nextLevel <= $upgradeCosts[0]) {
        $upgradeCost = $upgradePrices[0];
        $stats = $upgradeCosts[0];
    } elseif ($nextLevel <= $upgradeCosts[1]) {
        $upgradeCost = $upgradePrices[1];
    } elseif ($nextLevel <= $upgradeCosts[2]) {
        $upgradeCost = $upgradePrices[2];
    } elseif ($nextLevel <= $upgradeCosts[3]) {
        $upgradeCost = $upgradePrices[3];
    } elseif ($nextLevel <= $upgradeCosts[4]) {
        $upgradeCost = $upgradePrices[4];
    } elseif ($nextLevel <= $upgradeCosts[5]) {
        $upgradeCost = $upgradePrices[5];
    }

    $query = "SELECT * FROM `clan_invite` WHERE id_user = '$myID'";
    $result = mysqli_query($connect,$query);
    $count_invite = mysqli_num_rows($result);
    

    
    if($count_invite > 0)echo '<div class="green1 bold"><img src="img/ico/victory.png"> Вас пригласили в дивизию! <img src="img/ico/victory.png"></div>';
    while ($clan_invite = mysqli_fetch_assoc($result)) {
        
        if ($clan_invite['level'] <= 10) {
            $clan_avatar = 1;
        } else if ($clan_invite['level'] <= 20) {
            $clan_avatar = 3;
        } else if ($clan_invite['level'] <= 30) {
            $clan_avatar = 30;
        } else if ($clan_invite['level'] <= 40) {
            $clan_avatar = 31;
        }
    
        $query = "SELECT * FROM `clan` WHERE id = '{$clan_invite['id_clan']}'";
        $clanResult = mysqli_query($connect, $query); 
        $clanWhoInvite = mysqli_fetch_assoc($clanResult);


    echo '<div class="trnt-block">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    <div class="mb5 inbl">
    <div class="thumb fl"><img src="img/clan/avatar/'. $clan_avatar .'.png"><span class="mask2">&nbsp;</span></div>
    <div class="ml58 small white sh_b bold" style ="text-align: left;">
    Дивизия: <a href="company?id='.$clanWhoInvite['id'].'">
    <img class="vb" src="img/clan/side/'. $clanWhoInvite['side'] .'/side.png?1">
    <span class="green2">'. $clanWhoInvite['name'] .'</span></a><br>
    Уровень: <span class="green2">'. $clanWhoInvite['level'] .'</span>
    </div>
    <div class="clrb"></div>
    </div>
    <div class="bot">
    <table>
    <tbody><tr>
        <td class="w50 pr1"><a class="simple-but border" href="acceptlink?id='.$clanWhoInvite['id'].'"><span><span>Принять</span></span></a></td>
    <td class="w50 pl1"><a class="simple-but border gray" href="rejectLink?id='.$clanWhoInvite['id'].'"><span><span>Отказаться</span></span></a></td>
    </tr>
    </tbody></table>
    </div>
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
    
}

    if (isset($_GET['hide_news'])) {
        $query = "UPDATE `users` SET `news_read` = 0 WHERE id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $myID);
        $stmt->execute();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    $query = "SELECT * FROM `topic` WHERE `id_forum` = '1' ORDER BY `id` DESC LIMIT 1";
    $result = mysqli_query($connect, $query);
    if($users['news_read']){
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="trnt-block mb5">
        <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
        <div class="wrap-content cntr">
        <div class="orange bold"><img src="img/ico/victory.png"> Горячие новости! <img src="img/ico/victory.png"></div>
        <div class="dhr a_w50 mt5 mb5"></div>
        <span class="yellow2 small bold" style="width: 50%;">☆ ' . $row['name'] . ' ☆</span>
        <div class="mt5" style="display: flex;justify-content: center;">
        <a class="simple-but inbl mb1" href="topic?id=' . $row['id'] . '"><span><span>Посмотреть</span></span></a>
        </div>
        <a class="gray1 small td_u" href="angar?hide_news">cкрыть</a>
        </div>
        </div></div></div></div></div></div></div></div>
        </div>';
    }
    }
    ?>
    <table>
    <?php









if ($_SERVER['REQUEST_URI'] !== '/wartank/online' && $_SERVER['REQUEST_URI'] !== '/wartank/missions' && $_SERVER['REQUEST_URI'] !== '/wartank/missions?message=reward_claimed' 
&& $_SERVER['REQUEST_URI'] !== '/wartank/training' && $_SERVER['REQUEST_URI'] !== '/wartank/Mine'
&& $_SERVER['REQUEST_URI'] !== '/wartank/newstore-ussr' && $_SERVER['REQUEST_URI'] !== '/wartank/newstore-germany' 
&& $_SERVER['REQUEST_URI'] !== '/wartank/newstore-usa' && $_SERVER['REQUEST_URI'] !== '/wartank/company_missions'
) { // заменить на свой URL
?>
    <tbody>
        <tr>
            <td style="width:33%; padding-right:4px;">
                <div style="position:relative;">
                    <a class="simple-but border gray mb1" href="convoy">
                        <span><span>Конвой</span></span>
                    </a>
                    <span class="digit esmall">
                        <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
                    </span>
                </div>
            </td>
            <td style="width:33%; padding:0 4px;">
                <div style="position:relative;">
                    <a class="simple-but border mb1" href="battle">
                        <span><span>В бой!</span></span>
                    </a>
                </div>
            </td>
            <td style="width:33%; padding-left:4px;">
                <div style="position.relative;">
                    <a class="simple-but gray border mb1" href="buildings">
                        <span><span>База</span></span>
                        
                    </a>
                    <span class="digit esmall" style = "display:none";>
                        <span style = "position:absolute;" class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
                    </span>
                </div>
            </td>
        </tr>
    </tbody>



</table>
<?php
}

 

if($_SERVER['REQUEST_URI'] == '/wartank/battle' or $_SERVER['REQUEST_URI'] == '/wartank/battle?attack'){ // заменить ссылку
function session(){
if(isset($_SESSION['msg'])){
    echo ($_SESSION['msg']);
    unset($_SESSION['msg']);
    }
}

}else{
    if(isset($_SESSION['msg'])){
        echo ($_SESSION['msg']);
        unset($_SESSION['msg']);
        }
}
if ($users['exp'] >= $exp) {
    $query = "UPDATE `users` SET `level` = ?, `gold` = ?, `attach` = ?, `armor` = ?, `accuracy` = ?, `health` = ? WHERE `id` = ?";
    $stmt = $connect->prepare($query);

    if ($stmt) {
        $newLevel = $users['level'] + 1;
        $PrizeGold = $users['gold'] + $goldReward;
        $silverGold = $users['silver'] + $silverReward;
        $newAttach = $users['attach'] + 1;
        $newArmor = $users['armor'] + 1;
        $newAccuracy = $users['accuracy'] + 1;
        $newHealth = $users['health'] + 1;

        $stmt->bind_param("iiiiiii", $newLevel, $PrizeGold, $newAttach, $newArmor, $newAccuracy, $newHealth, $myID);

        $stmt->execute();

        $stmt->close();
        

        echo '<div class="trnt-block mb2">';
        echo '<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">';
        echo '<div class="wrap-content cntr bold">';
        echo '<div class="medium pb5 orange">';
        echo 'Вы получили <img height="14" width="14" src="img/ico/exp.png"> '. $users['level'] .' Уровень';
        echo '</div>';
        echo '<div class="small white sh_b">';
        echo '<span class="green2">Награда:</span><br>';
        echo '<span class="nwr">';
        echo '<img class="ico vm" src="img/ico/gold.png" alt="Золото" title="Золото"> '. $goldReward .' золота </span><span class="nwr">';
        echo '<img class="ico vm" src="img/ico/silver.png" alt="Серебро" title="Серебро"> ' . $silverReward .' серебра</span><br>';
        echo '<img class="vb pb2" src="img/ico/power.png" height="14" width="14"> Танковая мощь: +4';
        echo '</div>';
        echo '</div></div></div></div></div></div></div></div></div>';

    } else {
        echo "Не успешно";
    }
}

if ($clan['exp'] >= $clan_exp) {
    $query = "UPDATE `clan` SET `level` = ?, `gold` = ? WHERE `id` = ?";
    $stmt = $connect->prepare($query);

    if ($stmt) {
        $newLevel = $clan['level'] + 1;
        $PrizeGold = 100 + 10 * $clan['level'];

        $stmt->bind_param("iii", $newLevel, $PrizeGold,$users['id_clan']);

        $stmt->execute();

        $stmt->close();

    }
}
$requested_page = $_SERVER['SCRIPT_FILENAME']; // Получаем абсолютный путь к текущему скрипту
$file_path = $requested_page;

if (!file_exists($file_path)) {
    header("Location: angar");
}
?>



<!-- HEADER -->
