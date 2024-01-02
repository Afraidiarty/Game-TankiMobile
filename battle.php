<?
require_once 'system/header.php';


$players = array();


$_str_My = 0;
$_str_enemies = 0;

while ($row = mysqli_fetch_assoc($resForUs)) {
    if ($row['attach'] + $row['armor'] + $row['accuracy'] + $row['health'] < $MySumStats + 100) {
        $players[] = $row;
    }
}



if (!isset($_SESSION['RoundBattle'])) {
    $_SESSION['RoundBattle'] = 0;
}

if (!empty($players) and $_SESSION['RoundBattle'] == 0) { 
    $playersEnemies = $players[array_rand($players)];
    $_SESSION['currentEnemy'] = $playersEnemies;
} elseif (!empty($_SESSION['currentEnemy'])) {
    $playersEnemies = $_SESSION['currentEnemy'];
} else {
    echo "No suitable players available.";
}

if($lastOnl > 60){
    $_SESSION['RoundBattle'] = 0; 
}

if($users['fuel'] < 30){
    echo  '<div class="cntr mb5">
    <div class="white small">
    У вас не хватает <img src="img/ico/fuel.png?1">'. $LacksFuel .' топлива.<br>
    Топливо восстановится через '. $minutesOverFuel .' м '. $secondsOverFuel . ' с
    </div>
    </div>'.'<div class="trnt-block">' .
    '<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">' .
    '<div class="wrap-content cntr">' .
    '<div class="green1 small"><div>Получить <img src="img/ico/fuel.png">' . $users['maximumFuel'] . '</div><div class="thumb inbl m3"><img width="50" height="50" src="img/fuel.png"></div><div>и провести все бои</div></div>' .
    '<div class="bot">' .
    '<a class="simple-but border" href="buyFuell"><span><span>Купить за <img class="ico vm" src="img/ico/gold.png" alt="Золото" title="Золото"> 60</span></span></a>' .
    '</div>' .
    '</div>' .
    '</div></div></div></div></div></div></div></div>' .
    '</div>';
}

session();


if (isset($_GET['attack'])) {
    if($users['fuel'] >= 30){
        $expBattle = 0;
        $silver = 0;
        $_SESSION['RoundBattle']++;
        if ($_SESSION['RoundBattle'] > 3) {
            $_SESSION['RoundBattle'] = 0;
            unset($_SESSION['currentEnemy']);
        } else { 
            $_str_enemies = 0;
            $_str_My = 0;
            
            if ($MySumStats < 900) {
                $_str_enemies = rand(round($playersEnemies['attach'] / 6), round($playersEnemies['attach'] / 4));
                $_str_My = rand(round($users['attach'] / 6), round($users['attach'] / 4)) * 1.05;
            } else {
                $_str_enemies = rand(round($playersEnemies['attach'] / 6), round($playersEnemies['attach'] / 4));
                $_str_My = rand(round($users['attach'] / 6), round($users['attach'] / 4));
            }
            
            if ($_str_My > $_str_enemies) {
                $_SESSION['win'] = true; 
                $expBattle = round(rand(1, 1) * $users['level'] + $expirience + rand(1, 3));
                $silver = round(rand(1, 5) * $users['level'] + $bonusrang );
                $clan_exp_battle = round(($expBattle / 3) + $expirience_company);
                if($_SESSION['RoundBattle'] == 1){
                    $_SESSION['msg'] = '<div class="trnt-block mb2">
                    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
                    <div class="wrap-content">
                    
                    <div class="medium bold pb5 cntr green1"><img height="14" width="14" src="img/ico/victory.png"> <span style = "color:#0CBA07 !important;" " >Есть попадание!</span> <img height="14" width="14" src="img/ico/victory.png"></div>
                    
                    
                    <div class="small white cntr sh_b bold">
                    <span class="nwr">
                    <img class="ico vm" src="img/ico/exp.png" alt="опыт" title="опыт"> '.  $expBattle .'
                    опыта</span><span class="nwr">
                    <img class="ico vm" src="img/ico/silver.png" alt="Серебро" title="Серебро"> '.  $silver .'
                    серебра</span>
                    </div>
                    
                    </div>
                    </div></div></div></div></div></div></div></div>
                    </div>';
                }else if($_SESSION['RoundBattle'] == 2){
                    $_SESSION['msg'] = '<div class="trnt-block mb2">
                    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
                    <div class="wrap-content">
                    
                    <div class="medium bold pb5 cntr green1"><img height="14" width="14" src="img/ico/victory.png"> <span style = "color:#0CBA07 !important;" " >Точно в цель!</span> <img height="14" width="14" src="img/ico/victory.png"></div>
                    
                    
                    <div class="small white cntr sh_b bold">
                    <span class="nwr">
                    <img class="ico vm" src="img/ico/exp.png" alt="опыт" title="опыт"> '.  $expBattle .'
                    опыта</span><span class="nwr">
                    <img class="ico vm" src="img/ico/silver.png" alt="Серебро" title="Серебро"> '.  $silver .'
                    серебра</span>
                    </div>
                    
                    </div>
                    </div></div></div></div></div></div></div></div>
                    </div>';
                }else {
                    $_SESSION['msg'] = '<div class="trnt-block mb2">
                    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
                    <div class="wrap-content">
                    
                    <div class="medium bold pb5 cntr green1"><img height="14" width="14" src="img/ico/victory.png"> <span style = "color:#0CBA07 !important;" " >Враг уничтожен!</span> <img height="14" width="14" src="img/ico/victory.png"></div>
                    
                    
                    <div class="small white cntr sh_b bold">
                    <span class="nwr">
                    <img class="ico vm" src="img/ico/exp.png" alt="опыт" title="опыт"> '.  $expBattle .'
                    опыта</span><span class="nwr">
                    <img class="ico vm" src="img/ico/silver.png" alt="Серебро" title="Серебро"> '.  $silver .'
                    серебра</span>
                    </div>
                    <div class="small gray1 cntr sh_b bold">Уничтожено танков: '. $users['DestroedTanks'] .'</div>
                    </div>
                    </div></div></div></div></div></div></div></div>
                    </div>';
                    $CounterDestroyTanks++;

                   # Личные задания УНИЧТОЖЕНИЕ ТАНКОВ
                   $query = "SELECT * FROM `quest_user` WHERE `id_user` = ? AND (`id_quest` = 3 OR `id_quest` = 4)";
                   $stmt = $connect->prepare($query);
                    
                   $query_user_quest = "SELECT * FROM `quest_user` WHERE `id_user` = '$myID' AND (`id_quest` = 3 OR `id_quest` = 4)";
                   $quest_user_result = mysqli_query($connect, $query_user_quest);

                   $quest_user = mysqli_fetch_assoc($quest_user_result);
        
                            $stmt->bind_param("i", $myID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                                while ($q = $result->fetch_assoc()) {
                            
                                    if (time() - $q['last'] >= 24 * 3600) {
                            
                                        $countQuest = $q['koll'] + 1;
                            
                                        $updateQuery = "UPDATE `quest_user` SET `koll` = ? WHERE `id` = ?";
                                        $updateStmt = $connect->prepare($updateQuery);
                            
                                        if ($updateStmt) {
                                            $updateStmt->bind_param("ii", $countQuest, $q['id']);
                                            $updateStmt->execute();
                                        } else {
                                            echo "Ошибка при подготовке запроса на обновление: " . $connect->error;
                                        }
                                    }
                                }               
                   # Клановые задания УНИЧТОЖЕНИЕ ТАНКОВ
                   $query = "SELECT * FROM `company_missions_clan` WHERE `id_clan` = ? AND (`id_missions` = 1)";
                   $stmt = $connect->prepare($query);
                    
                   $query_user_quest = "SELECT * FROM `company_missions_clan` WHERE `id_clan` = '{$users['id_clan']}' AND (`id_missions` = 1)";
                   $company_missions_clan_result = mysqli_query($connect, $query_user_quest);

                   $company_missions_clan = mysqli_fetch_assoc($company_missions_clan_result);
                   
                        if ($stmt) {
                            $stmt->bind_param("i", $users['id_clan']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                                while ($q = $result->fetch_assoc()) {
                            
                                    if (time() - $q['time'] >= 24 * 3600) {
                            
                                        $countQuest = $q['koll'] + 1;
                                        
                                        $updateQuery = "UPDATE `company_missions_clan` SET `koll` = ? WHERE `id` = ?";
                                        $updateStmt = $connect->prepare($updateQuery);
                            
                                        if ($updateStmt) {
                                            $updateStmt->bind_param("ii", $countQuest,$q['id']);
                                            $updateStmt->execute();
                                        } else {
                                            echo "Ошибка при подготовке запроса на обновление: " . $connect->error;
                                        }
                                    }
                                }               
                   }
                }
            }else{
                $_SESSION['win'] = false;
                $expBattle = round($users['level'] * 0.65 + $expirience + rand(1, 3) + $expirience_company);
                $silver = round(rand(1, 5) * $users['level'] * 0.65) + $bonusrang;
                $clan_exp_battle = round($expBattle / 3);

                $_SESSION['msg'] = '<div class="trnt-block mb2">
                <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
                <div class="wrap-content">
                
                
                <div class="medium bold pb5 cntr red1"><img height="14" width="14" src="img/ico/defeat.png"> <span style = "color:red !important;" >' . ($_SESSION['RoundBattle'] == 3 ? 'Противник отступил' : 'Поражение') . '</span> <img height="14" width="14" src="img/ico/defeat.png"></div>            
                <div class="small white cntr sh_b bold">
                <span class="nwr">
                <img class="ico vm" src="img/ico/exp.png" alt="опыт" title="опыт">'. $expBattle .'
                опыта</span><span class="nwr">
                <img class="ico vm" src="img/ico/silver.png" alt="Серебро" title="Серебро"> '.  $silver .'
                серебра</span>
                </div>
                
                </div>
                </div></div></div></div></div></div></div></div>
                </div>';
            }
            
            $user_clan_exp_battle = $users['clan_exp'] + $clan_exp_battle;

            $query = "UPDATE `users` SET `exp` = ?, `silver` = ?, `fuel` = ?, `fuel_change` = ?,`DestroedTanks` = ?,`clan_exp` = ? WHERE `id` = ?";
            $stmt = $connect->prepare($query);
            
            if ($stmt) {
                $expBattle_set = $users['exp'] + $expBattle;
                $silver = $users['silver'] + $silver;
                $fuel = $users['fuel'] - 30;
                $fuel_change = time();
                $AllDestroyTanks = $users['DestroedTanks'] + $CounterDestroyTanks;
                // Проверка на успешность связывания параметров.
                if ($stmt->bind_param("iiiiiii", $expBattle_set, $silver, $fuel, $fuel_change,$AllDestroyTanks,$user_clan_exp_battle,$myID)) {
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "Ошибка связывания параметров: " . $stmt->error;
                }
            } else {
                echo "Ошибка подготовки запроса: " . $connect->error;
            }
            
            $query = "UPDATE `clan` SET `exp` = ? WHERE `id` = ?";
            $stmt = $connect->prepare($query);
            $clan_exp_battle_set = $clan['exp'] + $clan_exp_battle;
            if ($stmt) {
                
                // Проверка на успешность связывания параметров.
                if ($stmt->bind_param("ii", $clan_exp_battle_set, $users['id_clan'])) {
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "Ошибка связывания параметров: " . $stmt->error;
                }
            } else {
                echo "Ошибка подготовки запроса: " . $connect->error;
            }
            # Личный опыт клановые задания
            $query = "SELECT * FROM `company_missions_clan` WHERE `id_clan` = ? AND (`id_missions` = 2)";
            $stmt = $connect->prepare($query);
             
            $query_user_quest = "SELECT * FROM `company_missions_clan` WHERE `id_clan` = '{$users['id_clan']}' AND (`id_missions` = 2)";
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
                                     $updateStmt->bind_param("ii", $expBattle,$q['id']);
                                     $updateStmt->execute();
                                 } else {
                                     echo "Ошибка при подготовке запроса на обновление: " . $connect->error;
                                 }
                             }
                         }               
                    }

            # Дивизионный опыт клановые задания
            $query = "SELECT * FROM `company_missions_clan` WHERE `id_clan` = ? AND (`id_missions` = 4)";
            $stmt = $connect->prepare($query);
             
            $query_user_quest = "SELECT * FROM `company_missions_clan` WHERE `id_clan` = '{$users['id_clan']}' AND (`id_missions` = 4)";
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
                                     $updateStmt->bind_param("ii", $clan_exp_battle,$q['id']);
                                     $updateStmt->execute();
                                 } else {
                                     echo "Ошибка при подготовке запроса на обновление: " . $connect->error;
                                 }
                             }
                         }               
                    }
            
        }
        header("Location: battle");
}


}


$SumStatsEnemies = $playersEnemies['attach'] + $playersEnemies['armor'] + $playersEnemies['accuracy'] + $playersEnemies['health'];




echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content custombg farm_1">
<div class="small bold cD2 cntr sh_b pb2">
    <img class="vb" height="14" width="14" src="img/rankets/' . $playersEnemies['side'] . '/' . $playersEnemies['rang'] . '.png">
    ' . $playersEnemies['nick'] . '
</div><table><tbody><tr><td class="cntr"><a href="?attack"><img class="tank-img" alt="tank" src="' . $playersEnemies['img'] . '"></a></td></tr></tbody></table>
<div class="cntr small bold mb2 pb0"><img src="img/ico/power.png?2" height="14" width="14"> <span class="green2">Танковая мощь: ' . $SumStatsEnemies . '</span></div><div class="bot">
    '; 
    if($_SESSION['RoundBattle'] == 0 ){
        echo '<a class="simple-but border" href="?attack"><span><span>Стрелять</span></span></a>';
    } 
     if ($_SESSION['win'] == 1 and $_SESSION['RoundBattle'] <= 3 and $_SESSION['RoundBattle'] != 0){
        if($_SESSION['RoundBattle'] == 1){
            echo '<a class="simple-but border" href="?attack"><span><span>Добить</span></span></a>';
        }  
        if($_SESSION['RoundBattle'] == 2){
            echo '<a class="simple-but border" href="?attack"><span><span>Уничтожить</span></span></a>';
        } 
        if($_SESSION['RoundBattle'] == 3){
            echo '<a class="simple-but border" href="?attack"><span><span>Другие противники</span></span></a>';
        }
     }else{
        if( $_SESSION['RoundBattle'] != 0){
            if($_SESSION['RoundBattle']!=3){
                echo '<a class="simple-but border" href="?attack"><span><span>Взять Реванш</span></span></a>';
            }else {
                echo '<a class="simple-but border" href="?attack"><span><span>Другие противники</span></span></a>';
            }
        }
     }
    echo '</div></div></div></div></div></div></div></div></div></div></div>';

require_once 'system/footer.php';
?>