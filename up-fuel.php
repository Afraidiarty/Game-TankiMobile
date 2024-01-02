<?
require_once 'system/header.php';

$query = "SELECT * FROM `buildings_user` WHERE id_user = '$myID' AND id_buildings = 3";
$result = mysqli_query($connect,$query);
$fuelB = mysqli_fetch_assoc($result);

$currentLevel = $fuelB['buildings_level'];


switch($fuelB['buildings_level']){
    case 1:$nextLevelFuel = 330;break;
    case 2:$nextLevelFuel = 340;break;
    case 3:$nextLevelFuel = 400;break;
    case 4:$nextLevelFuel = 420;break;
    case 5:$nextLevelFuel = 435;break;
    case 6:$nextLevelFuel = 465;break;
    case 7:$nextLevelFuel = 510;break;
    case 8:$nextLevelFuel = 555;break;
    case 9:$nextLevelFuel = 615;break;
    case 10:$nextLevelFuel = 630;break;
    case 11:$nextLevelFuel = 645;break;
    case 12:$nextLevelFuel = 660;break;
    case 13:$nextLevelFuel = 675;break;
    case 14:$nextLevelFuel = 700;break;
    case 15:$nextLevelFuel = 720;break;
    case 16:$nextLevelFuel = 'Максимум';break;
}


$upgradePrices = array(
    1 => array('silver' => 100 , 'ore' => 0 , 'gold' => 0 , 'iron' => 0 , 'steel' => 0 , 'plumbum' => 0 ),
    2 => array('silver' => 100 , 'ore' => 2, 'gold' => 0 , 'iron' => 0 , 'steel' => 0 , 'plumbum' => 0),
    3 => array('silver' => 300 , 'ore' => 6, 'gold' => 0 , 'iron' => 0 , 'steel' => 0 , 'plumbum' => 0),
    4 => array('silver' => 500 , 'ore' => 12, 'gold' => 0 , 'iron' => 0 , 'steel' => 0 , 'plumbum' => 0),
    5 => array('silver' => 1400 , 'ore' => 15 , 'gold' => 40 , 'iron' => 1 , 'steel' => 0 , 'plumbum' => 0),
    6 => array('silver' => 1800 , 'ore' => 30 , 'gold' => 0 , 'iron' => 3 , 'steel' => 0 , 'plumbum' => 0),
    7 => array('silver' => 2000 , 'ore' => 40 , 'gold' => 0 , 'iron' => 7 , 'steel' => 0 , 'plumbum' => 0),
    8 => array('silver' => 2400 , 'ore' => 45 , 'gold' => 0 , 'iron' => 15 , 'steel' => 0 , 'plumbum' => 0),
    9 => array('silver' => 0 , 'ore' => 40 , 'gold' => 0 , 'iron' => 20 , 'steel' => 0 , 'plumbum' => 0),
    10 => array('silver' => 2000 , 'ore' => 25 , 'gold' => 200 , 'iron' => 30 , 'steel' => 1 , 'plumbum' => 0),
    11 => array('silver' => 2500 , 'ore' => 35 , 'gold' => 0 , 'iron' => 5 , 'steel' => 2 , 'plumbum' => 0),
    12 => array('silver' => 3000 , 'ore' => 45 , 'gold' => 0 , 'iron' => 10 , 'steel' => 5 , 'plumbum' => 0),
    13 => array('silver' => 3500 , 'ore' => 55 , 'gold' => 0 , 'iron' => 15 , 'steel' => 10 , 'plumbum' => 1),
    14 => array('silver' => 4000 , 'ore' => 25 , 'gold' => 0 , 'iron' => 20 , 'steel' => 15 , 'plumbum' => 3),
    15 => array('silver' => 5000 , 'ore' => 40 , 'gold' => 600 , 'iron' => 25 , 'steel' => 20 , 'plumbum' => 5),

);




if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['level'])) {
    $newLevel = intval($_GET['level']);

    if ($newLevel > 0 && $newLevel <= 16) {
        $query = "SELECT * FROM `buildings_user` WHERE id_user = '$myID' AND id_buildings = 3";
        $result = mysqli_query($connect, $query);

        if ($result) {
            $fuelB = mysqli_fetch_assoc($result);
            $currentLevel = $fuelB['buildings_level'];

            $upgradeCost = $upgradePrices[$newLevel];
            if (
                $users['silver'] >= $upgradeCost['silver'] &&
                $users['ore'] >= $upgradeCost['ore'] &&
                $users['gold'] >= $upgradeCost['gold'] &&
                $users['iron'] >= $upgradeCost['iron'] &&
                $users['steel'] >= $upgradeCost['steel'] &&
                $users['plumbum'] >= $upgradeCost['plumbum']
            ) {
                // Ресурсы
                $users['silver'] -= $upgradeCost['silver'];
                $users['ore'] -= $upgradeCost['ore'];
                $users['gold'] -= $upgradeCost['gold'];
                $users['iron'] -= $upgradeCost['iron'];
                $users['steel'] -= $upgradeCost['steel'];
                $users['plumbum'] -= $upgradeCost['plumbum'];

                // Обновление здания и баланса
                $query = "UPDATE `buildings_user` SET buildings_level = $newLevel+1 WHERE id_user = '$myID' AND id_buildings = 3";
                $updateResult = mysqli_query($connect, $query);

                $query_us = "UPDATE `users` SET maximumFuel = $nextLevelFuel ,silver = {$users['silver']}, ore = {$users['ore']}, gold = {$users['gold']}, iron = {$users['iron']}, steel = {$users['steel']}, plumbum = {$users['plumbum']} WHERE id = '$myID'";
                $updateResult_us = mysqli_query($connect, $query_us);

                $_SESSION['msg'] = '<div class="buy-place-block"><div class="feedbackPanelSUCCESS"><div class="line1"><span class="feedbackPanelSUCCESS">Уровень увеличен</span> </div></div></div>';
            } else {
                $_SESSION['msg'] = "Недостаточно ресурсов";
            }
        }
    } else {
        $_SESSION['msg'] = "Ошибка уровня";
    }
    header("Location: up-fuel");
}



if ($currentLevel < 16) {
echo '<div class="medium white bold cntr mb5">Улучшение здания: полигон</div>';
echo '<div class="cntr white mb5">Цена: ';
}
if ($upgradePrices[$currentLevel]['gold'] > 0) {
    echo '<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> ' . number_format($upgradePrices[$currentLevel]['gold'], 0 , '', ' ') . ' ';
}

if ($upgradePrices[$currentLevel]['silver'] > 0) {
    echo '<img class="ico vm" src="img/ico/silver.png" alt="Серебро" title="Серебро"> ' . number_format($upgradePrices[$currentLevel]['silver'], 0 , '', ' ') . ' ';
}

if ($upgradePrices[$currentLevel]['ore'] > 0) {
    echo '<img class="ico vm" src="img/buildings/material/ore.png" alt="Руда" title="Руда"> ' . number_format($upgradePrices[$currentLevel]['ore'], 0 , '', ' ') . ' ';
}


if ($upgradePrices[$currentLevel]['iron'] > 0) {
    echo '<img class="ico vm" src="img/buildings/material/iron.png?2" alt="Железо" title="Железо"> ' . number_format($upgradePrices[$currentLevel]['iron'], 0 , '', ' ') . ' ';
}

if ($upgradePrices[$currentLevel]['steel'] > 0) {
    echo '<img class="ico vm" src="img/buildings/material/steel.png?2" alt="Железо" title="Железо"> ' . number_format($upgradePrices[$currentLevel]['steel'], 0 , '', ' ') . ' ';
}

if ($upgradePrices[$currentLevel]['plumbum'] > 0) {
    echo '<img class="ico vm" src="img/buildings/material/plumbum.png?2" alt="Железо" title="Железо"> ' . number_format($upgradePrices[$currentLevel]['plumbum'], 0 , '', ' ') . ' ';
}

echo '</div>';





echo '<div class="a_w50">';
if ($currentLevel < 16) {
    echo '<a class="simple-but border mb5" href="up-fuel?level=' . ($currentLevel) . '">';
    echo '<span><span>Улучшить</span></span></a>';    
} else {
    echo '<div class="mb5">Здание уже на максимальном уровне</div>';
}
echo '</div>';

echo '<a class="simple-but gray mb5" w:id="backLink" href="buildings"><span><span>Вернуться на базу</span></span></a>';

require_once 'system/footer.php';
?>