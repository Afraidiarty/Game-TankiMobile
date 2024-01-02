<?
require_once 'system/header.php';


echo '<div class="medium white bold cntr mb5">Тренировка </div>';   

echo'<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="white small bold sh_b mb2 cntr">
Текущее звание: <img class="vb" src="img/rankets/'. $users['side'] .'/'. $users['rang'] .'.png?1"> <span class="green2">'. $rangName .'</span><br>';

if($users['rang'] > 0){
    echo '<div class="white small bold sh_b mb5 cntr">
    Бонус звания:<br>
    <span class="nwr">
    <img class="ico vm" src="img/ico/exp.png" alt="опыт" title="опыт"> '. $bonusrang .'
     опыта</span><span class="nwr">
    <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> '. $bonusrang .'
     серебра</span>
    </div>';
}

echo'<img class="vb" src="img/rankets/'. $users['side'] .'/0.png?1">

<img class="vb" src="img/rankets/'. $users['side'] .'/1.png?1">

<img class="vb" src="img/rankets/'. $users['side'] .'/2.png?1">

<img class="vb" src="img/rankets/'. $users['side'] .'/3.png?1">

<img class="vb" src="img/rankets/'. $users['side'] .'/4.png?1">

<img class="vb" src="img/rankets/'. $users['side'] .'/5.png?1">

<img class="vb" src="img/rankets/'. $users['side'] .'/6.png?1">

<img class="vb" src="img/rankets/'. $users['side'] .'/7.png?1">

</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';






$levelPrices = array(
    0 => 2,     // 0 уровень = 2 серебра
    1 => 5,     // 1 уровень = 5 серебра
    2 => 10,    // 2 уровень = 10 серебра
    3 => 15,    // 3 уровень = 15 серебра
    4 => 10,    // 4 уровень = 20 серебра
    6 => 10,    // 6 уровень = 10 золота
    7 => 25,    // 7 уровень = 25 серебра
    8 => 30,    // 8 уровень = 30 серебра
    9 => 35,    // 9 уровень = 35 серебра
    10 => 40,   // 10 уровень = 40 серебра
    12 => 20,   // 12 уровень = 20 золота
    13 => 50,   // 13 уровень = 50 серебра
    14 => 60,   // 14 уровень = 60 серебра
    15 => 70,   // 15 уровень = 70 серебра
    16 => 80,   // 16 уровень = 80 серебра
    18 => 40,   // 18 уровень = 40 золота
    19 => 100,  // 19 уровень = 100 серебра
    20 => 120,  // 20 уровень = 120 серебра
    21 => 140,  // 21 уровень = 140 серебра
    22 => 160,  // 22 уровень = 160 серебра
    24 => 80,   // 24 уровень = 80 золота
    25 => 200,  // 25 уровень = 200 серебра
    26 => 250,  // 26 уровень = 250 серебра
    27 => 300,  // 27 уровень = 300 серебра
    28 => 350,  // 28 уровень = 350 серебра
    30 => 150,  // 30 уровень = 150 золота
    31 => 400,  // 31 уровень = 400 серебра
    32 => 450,  // 32 уровень = 450 серебра
    33 => 500,  // 33 уровень = 500 серебра
    34 => 550,  // 34 уровень = 550 серебра
    36 => 300,  // 36 уровень = 300 золота
    37 => 600,  // 37 уровень = 600 серебра
    38 => 700,  // 38 уровень = 700 серебра
    39 => 800,  // 39 уровень = 800 серебра
    40 => 900,  // 40 уровень = 900 серебра
    42 => 500,  // 42 уровень = 500 золота
    43 => 1000, // 43 уровень = 1000 серебра
    44 => 1100, // 44 уровень = 1100 серебра
    45 => 1200, // 45 уровень = 1200 серебра
    46 => 1300, // 46 уровень = 1300 серебра
    48 => 800,  // 48 уровень = 800 золота
    49 => 1500, // 49 уровень = 1500 серебра
    50 => 1600, // 50 уровень = 1600 серебра
    51 => 1700, // 51 уровень = 1700 серебра
    52 => 1800, // 52 уровень = 1800 серебра
    54 => 1000, // 54 уровень = 1000 золота
    55 => 2000, // 55 уровень = 2000 серебра
    56 => 2100, // 56 уровень = 2100 серебра
    57 => 2200, // 57 уровень = 2200 серебра
    58 => 2300, // 58 уровень = 2300 серебра
    60 => 1500, // 60 уровень = 1500 золота
    61 => 3000, // 61 уровень = 3000 серебра
    62 => 3500, // 62 уровень = 3500 серебра
    63 => 4000, // 63 уровень = 4000 серебра
    64 => 4500, // 64 уровень = 4500 серебра
    66 => 3000, // 66 уровень = 3000 золота
    67 => 10000, // 67 уровень = 10000 серебра
    68 => 10500, // 68 уровень = 10500 серебра
    69 => 11000, // 69 уровень = 11000 серебра
    70 => 11500, // 70 уровень = 11500 серебра
    72 => 6000,  // 72 уровень = 6000 золота
    73 => 20000, // 73 уровень = 20000 серебра
    74 => 22000, // 74 уровень = 22000 серебра
    75 => 24000, // 75 уровень = 24000 серебра
    76 => 26000, // 76 уровень = 26000 серебра
    78 => 12000, // 78 уровень = 12000 золота
    79 => 50000, // 79 уровень = 50000 серебра
    80 => 100000, // 80 уровень = 100000 серебра
    81 => 150000, // 81 уровень = 150000 серебра
    82 => 200000, // 82 уровень = 200000 серебра
    84 => 20000, // 84 уровень = 20000 золота
);





switch($users['rang']){
    case 0: $MaxPoint = 12; break;
    case 1: $MaxPoint = 24; break;
    case 2: $MaxPoint = 36; break;
    case 3: $MaxPoint = 48; break;
    case 4: $MaxPoint = 60; break;
    case 5: $MaxPoint = 72; break;
    case 6: $MaxPoint = 84; break;
    case 7: $MaxPoint = 96; break;
}



if($users['attack_train'] >= $MaxPoint && $users['armor_train'] >= $MaxPoint && $users['accuracy_train'] >= $MaxPoint
 && $users['health_train'] >= $MaxPoint){
    echo '<div class="mt5">
    <a class="simple-but inbl mb1" href="?AppRang"><span><span>Получить звание</span></span></a>
    </div>';
 }

 if (isset($_GET['AppRang']) && 
 ($users['attack_train'] >= $MaxPoint && $users['armor_train'] >= $MaxPoint && 
 $users['accuracy_train'] >= $MaxPoint && $users['health_train'] >= $MaxPoint) && $users['rang'] < 7  ) {
        $query = "UPDATE `users` SET `rang` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        $AppRang = intval($users['rang']) + 1;
        if($stmt){
            $stmt->bind_param("ii", $AppRang, $myID);
            if ($stmt->execute()) {
                echo "suc";
            } else {
                echo "not suc: " . $stmt->error;
            }
        } else {
            echo "not suc: " . $connect->error;
        }
        header("Location: training");
}



 $desiredLevelAttack = $users['attack_train'];
 if (array_key_exists($desiredLevelAttack, $levelPrices)) {

    $price = $levelPrices[$desiredLevelAttack];

    if(isset($_GET['uprage_attack'])){
            $query = "UPDATE `users` SET `attack_train` = ? , `gold` = ? , `silver` = ? , `attach` = ? WHERE `id` = ?";
            $stmt = $connect->prepare($query);
            
        
            if ($users['attack_train'] != 4 && $users['attack_train'] != 10 && $users['attack_train'] != 16 && $users['attack_train'] != 22 
            &&$users['attack_train'] != 28 && $users['attack_train'] != 34 && $users['attack_train'] != 40 &&  $users['attack_train'] != 46 &&
            $users['attack_train'] != 52 && $users['attack_train'] != 58 && $users['attack_train'] != 64 && $users['attack_train'] != 64 && 
            $users['attack_train'] != 70  && $users['attack_train'] != 76 && $users['attack_train'] != 82) {
                
                if($users['silver'] >= $price){
                    $attackTrain = $users['attack_train'] + 1;
                    $attach = $users['attach'] + 1; 
                    $silverDiff = $users['silver'] - $price;
                    $goldDiff = $users['gold'];
                }else{
                    $NeXvataet = abs($users['silver'] - $price); 
                    $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                    <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> '. $NeXvataet .'
                     Серебра
                    </div></div>';
                    header("Location: training");
                    exit; 
                }
            } else {
                if($users['gold'] >= $price ){
                $attackTrain = $users['attack_train'] + 2;
                $attach = $users['attach'] + 2;
                $goldDiff = $users['gold'] - $price;
                $silverDiff = $users['silver'];
                }
                else{
                    $NeXvataet = abs($users['gold'] - $price); 
                    $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                    <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
                     золота
                    
                    </div></div>';
                    header("Location: training");
                    exit; 
                }
            }
        
            if ($stmt) {
                $stmt->bind_param("iiiii", $attackTrain, $goldDiff, $silverDiff, $attach, $myID);
                $stmt->execute();
                
                header("Location: training");
            } else {
                echo "Failed to prepare the statement.";
            }
    }
    

    
     $progressTrain = round(($users['attack_train'] / $MaxPoint) * 100, 1);
     if ($progressTrain > 100) $progressTrain = 100;
    echo'<div class="trnt-block">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    <div class="white cntr bold sh_b small pb0">
    <div class="medium green2 pb5"><img height="14" width="14" src="img/ico/attack.png?1" alt="Атака" title="Атака"> Атака: ' . $users['attack_train'] . ' из ' . $MaxPoint . '
    
    </div>
    <div class="rate-block mb0">
    
    <div class="scale-block">
    <div class="scale-next" style="width: ' . $progressTrain . '%;">
    <div class="scale" style="width:100%;"><div class="in">&nbsp;</div></div>
    </div>
    <div class="mask"><div class="in">&nbsp;</div></div>
    </div>
    
    </div>
    </div>
    
    <div class="bot">
    
    <a class="simple-but border mb5" href="?uprage_attack">
    <span><span>
    Улучшить за ';
    
    
    if ($users['attack_train'] != 4 && $users['attack_train'] != 10 && $users['attack_train'] != 16 && $users['attack_train'] != 22 
    &&$users['attack_train'] != 28 && $users['attack_train'] != 34 && $users['attack_train'] != 40 &&  $users['attack_train'] != 46 &&
     $users['attack_train'] != 52 && $users['attack_train'] != 58 && $users['attack_train'] != 64 && $users['attack_train'] != 64 && 
     $users['attack_train'] != 70  && $users['attack_train'] != 76 && $users['attack_train'] != 82) {
        echo '<img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> ' . $price . '';
    }else{
        echo '<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> ' . $price . '';

    }
    
    
    
    
    
    
    
    
   echo ' </span></span></a>
    
    </div>
    
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
  } else {
    echo '<div class="trnt-block mb5">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    <div class="white cntr bold sh_b small pb0">
    <div class="medium green2 pb5"><img height="14" width="14" src="img/ico/attack.png?1" alt="Атака" title="Атака"> Атака: 84 из 84
    <br>(прокачана по максимуму)
    </div>
    <div class="rate-block mb0">
    
    <div class="scale-block">
    <div class="scale-next" style="width:100%;">
    <div class="scale" style="width:100%;"><div class="in">&nbsp;</div></div>
    </div>
    <div class="mask"><div class="in">&nbsp;</div></div>
    </div>
    
    </div>
    </div>
    
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
 }  

 $desiredLevelArmor = $users['armor_train'];
 if (array_key_exists($desiredLevelArmor, $levelPrices)) {

    $price = $levelPrices[$desiredLevelArmor];

    if(isset($_GET['uprage'])){
        $query = "UPDATE `users` SET `armor_train` = ? , `gold` = ? , `silver` = ? , `armor` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        
    
        if ($users['armor_train'] != 4 && $users['armor_train'] != 10 && $users['armor_train'] != 16 && $users['armor_train'] != 22 
        &&$users['armor_train'] != 28 && $users['armor_train'] != 34 && $users['armor_train'] != 40 &&  $users['armor_train'] != 46 &&
         $users['armor_train'] != 52 && $users['armor_train'] != 58 && $users['armor_train'] != 64 && $users['armor_train'] != 64 && 
         $users['armor_train'] != 70  && $users['armor_train'] != 76 && $users['armor_train'] != 82) {
            
            if($users['silver'] >= $price){
            $attackTrain = $users['armor_train'] + 1;
            $armor = $users['armor'] + 1; 
            $silverDiff = $users['silver'] - $price;
            $goldDiff = $users['gold'];
            }else{
                $NeXvataet = abs($users['silver'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> '. $NeXvataet .'
                 Золото
                
                </div></div>';
                header("Location: training");
                exit;  
            }
        } else {
            if($users['gold'] >= $price ){
            $attackTrain = $users['armor_train'] + 2;
            $armor = $users['armor'] + 2;
            $goldDiff = $users['gold'] - $price;
            $silverDiff = $users['silver'];
            }else{
                $NeXvataet = abs($users['gold'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
                 Серебра
                </div></div>';
                header("Location: training");
                exit;  
            }
        }
    
        if ($stmt) {
            $stmt->bind_param("iiiii", $attackTrain, $goldDiff, $silverDiff, $armor, $myID);
            $stmt->execute();
            
            header("Location: training");
        } else {
            echo "Failed to prepare the statement.";
        }
    }
    


    
     $progressTrain = round(($users['armor_train'] / $MaxPoint) * 100, 1);
     if ($progressTrain > 100) $progressTrain = 100;
    echo'<div class="trnt-block">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    <div class="white cntr bold sh_b small pb0">
    <div class="medium green2 pb5"><img height="14" width="14" src="img/ico/armor.png?1" alt="Атака" title="Атака"> Защита: ' . $users['armor_train'] . ' из ' . $MaxPoint . '
    
    </div>
    <div class="rate-block mb0">
    
    <div class="scale-block">
    <div class="scale-next" style="width: ' . $progressTrain . '%;">
    <div class="scale" style="width:100%;"><div class="in">&nbsp;</div></div>
    </div>
    <div class="mask"><div class="in">&nbsp;</div></div>
    </div>
    
    </div>
    </div>
    
    <div class="bot">
    
    <a class="simple-but border mb5" href="?uprage">
    <span><span>
    Улучшить за ';
    
    
    if ($users['armor_train'] != 4 && $users['armor_train'] != 10 && $users['armor_train'] != 16 && $users['armor_train'] != 22 
    &&$users['armor_train'] != 28 && $users['armor_train'] != 34 && $users['armor_train'] != 40 &&  $users['armor_train'] != 46 &&
     $users['armor_train'] != 52 && $users['armor_train'] != 58 && $users['armor_train'] != 64 && $users['armor_train'] != 64 && 
     $users['armor_train'] != 70  && $users['armor_train'] != 76 && $users['armor_train'] != 82) {
        echo '<img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> ' . $price . '';
    }else{
        echo '<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> ' . $price . '';

    }
    
    echo ' </span></span></a>
    
    </div>
    
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
  } else {
    echo '<div class="trnt-block mb5">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    <div class="white cntr bold sh_b small pb0">
    <div class="medium green2 pb5"><img height="14" width="14" src="img/ico/attack.png?1" alt="Атака" title="Атака"> Защита: 84 из 84
    <br>(прокачана по максимуму)
    </div>
    <div class="rate-block mb0">
    
    <div class="scale-block">
    <div class="scale-next" style="width:100%;">
    <div class="scale" style="width:100%;"><div class="in">&nbsp;</div></div>
    </div>
    <div class="mask"><div class="in">&nbsp;</div></div>
    </div>
    
    </div>
    </div>
    
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
 }  
    
 $desiredLevelAccuracy = $users['accuracy_train'];
 if (array_key_exists($desiredLevelAccuracy, $levelPrices)) {

    $price = $levelPrices[$desiredLevelAccuracy];

    if(isset($_GET['uprage_accuracy'])){
        $query = "UPDATE `users` SET `accuracy_train` = ? , `gold` = ? , `silver` = ? , `accuracy` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        
    
        if ($users['accuracy_train'] != 4 && $users['accuracy_train'] != 10 && $users['accuracy_train'] != 16 && $users['accuracy_train'] != 22 
        &&$users['accuracy_train'] != 28 && $users['accuracy_train'] != 34 && $users['accuracy_train'] != 40 &&  $users['accuracy_train'] != 46 &&
         $users['accuracy_train'] != 52 && $users['accuracy_train'] != 58 && $users['accuracy_train'] != 64 && $users['accuracy_train'] != 64 && 
         $users['accuracy_train'] != 70  && $users['accuracy_train'] != 76 && $users['accuracy_train'] != 82) {
            
            if($users['silver'] >= $price){
            $attackTrain = $users['accuracy_train'] + 1;
            $accuracy = $users['accuracy'] + 1; 
            $silverDiff = $users['silver'] - $price;
            $goldDiff = $users['gold'];
            }else{
                $NeXvataet = abs($users['silver'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> '. $NeXvataet .'
                 Золото
                
                </div></div>';
                header("Location: training");
                exit;  
            }
        } else {
            if($users['gold'] >= $price ){
            $attackTrain = $users['accuracy_train'] + 2;
            $accuracy = $users['accuracy'] + 2;
            $goldDiff = $users['gold'] - $price;
            $silverDiff = $users['silver'];
            }else{
                $NeXvataet = abs($users['gold'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
                 Серебра
                </div></div>';
                header("Location: training");
                exit;  
            }
        }
    
        if ($stmt) {
            $stmt->bind_param("iiiii", $attackTrain, $goldDiff, $silverDiff, $accuracy, $myID);
            $stmt->execute();
            
            header("Location: training");
        } else {
            echo "Failed to prepare the statement.";
        }
    }
    


    

    
     $progressTrain = round(($users['accuracy_train'] / $MaxPoint) * 100, 1);
     if ($progressTrain > 100) $progressTrain = 100;
    echo'<div class="trnt-block">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    <div class="white cntr bold sh_b small pb0">
    <div class="medium green2 pb5"><img height="14" width="14" src="img/ico/accuracy.png?1" alt="Атака" title="Атака"> Точность: ' . $users['accuracy_train'] . ' из ' . $MaxPoint . '
    
    </div>
    <div class="rate-block mb0">
    
    <div class="scale-block">
    <div class="scale-next" style="width: ' . $progressTrain . '%;">
    <div class="scale" style="width:100%;"><div class="in">&nbsp;</div></div>
    </div>
    <div class="mask"><div class="in">&nbsp;</div></div>
    </div>
    
    </div>
    </div>
    
    <div class="bot">
    
    <a class="simple-but border mb5" href="?uprage_accuracy">
    <span><span>
    Улучшить за ';
    
    
    if ($users['accuracy_train'] != 4 && $users['accuracy_train'] != 10 && $users['accuracy_train'] != 16 && $users['accuracy_train'] != 22 
    &&$users['accuracy_train'] != 28 && $users['accuracy_train'] != 34 && $users['accuracy_train'] != 40 &&  $users['accuracy_train'] != 46 &&
     $users['accuracy_train'] != 52 && $users['accuracy_train'] != 58 && $users['accuracy_train'] != 64 && $users['accuracy_train'] != 64 && 
     $users['accuracy_train'] != 70  && $users['accuracy_train'] != 76 && $users['accuracy_train'] != 82) {
        echo '<img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> ' . $price . '';
    }else{
        echo '<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> ' . $price . '';

    }
    
    echo ' </span></span></a>
    
    </div>
    
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
  } else {
    echo '<div class="trnt-block mb5">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    <div class="white cntr bold sh_b small pb0">
    <div class="medium green2 pb5"><img height="14" width="14" src="img/ico/accuracy.png?1" alt="Атака" title="Атака"> Точность: 84 из 84
    <br>(прокачана по максимуму)
    </div>
    <div class="rate-block mb0">
    
    <div class="scale-block">
    <div class="scale-next" style="width:100%;">
    <div class="scale" style="width:100%;"><div class="in">&nbsp;</div></div>
    </div>
    <div class="mask"><div class="in">&nbsp;</div></div>
    </div>
    
    </div>
    </div>
    
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
 }  
    
 $desiredLevelHealth = $users['health_train'];
 if (array_key_exists($desiredLevelHealth, $levelPrices)) {

    $price = $levelPrices[$desiredLevelHealth];

    if(isset($_GET['uprage_health'])){
        $query = "UPDATE `users` SET `health_train` = ? , `gold` = ? , `silver` = ? , `health` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        
    
        if ($users['health_train'] != 4 && $users['health_train'] != 10 && $users['health_train'] != 16 && $users['health_train'] != 22 
        &&$users['health_train'] != 28 && $users['health_train'] != 34 && $users['health_train'] != 40 &&  $users['health_train'] != 46 &&
         $users['health_train'] != 52 && $users['health_train'] != 58 && $users['health_train'] != 64 && $users['health_train'] != 64 && 
         $users['health_train'] != 70  && $users['health_train'] != 76 && $users['health_train'] != 82) {
            if($users['silver'] >= $price){
            $attackTrain = $users['health_train'] + 1;
            $health = $users['health'] + 1; 
            $silverDiff = $users['silver'] - $price;
            $goldDiff = $users['gold'];
            }else{
                $NeXvataet = abs($users['silver'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> '. $NeXvataet .'
                 Золото
                
                </div></div>'; 
                header("Location: training");
                exit; 
            }
        } else {
            if($users['gold'] >= $price ){
            $attackTrain = $users['health_train'] + 2;
            $health = $users['health'] + 2;
            $goldDiff = $users['gold'] - $price;
            $silverDiff = $users['silver'];
            }else{
                $NeXvataet = abs($users['gold'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
                 Серебра
                </div></div>';
                header("Location: training");
                exit; 
                
            }
        }
    
        if ($stmt) {
            $stmt->bind_param("iiiii", $attackTrain, $goldDiff, $silverDiff, $health, $myID);
            $stmt->execute();
            
            header("Location: training");
        } else {
            echo "Failed to prepare the statement.";
        }
    }
    

   


    
     $progressTrain = round(($users['health_train'] / $MaxPoint) * 100, 1);
     if ($progressTrain > 100) $progressTrain = 100;
    echo'<div class="trnt-block">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    <div class="white cntr bold sh_b small pb0">
    <div class="medium green2 pb5"><img height="14" width="14" src="img/ico/durability.png" alt="Атака" title="Атака"> Прочность: ' . $users['health_train'] . ' из ' . $MaxPoint . '
    
    </div>
    <div class="rate-block mb0">
    
    <div class="scale-block">
    <div class="scale-next" style="width: ' . $progressTrain . '%;">
    <div class="scale" style="width:100%;"><div class="in">&nbsp;</div></div>
    </div>
    <div class="mask"><div class="in">&nbsp;</div></div>
    </div>
    
    </div>
    </div>
    
    <div class="bot">
    
    <a class="simple-but border mb5" href="?uprage_health">
    <span><span>
    Улучшить за ';
    
    
    if ($users['health_train'] != 4 && $users['health_train'] != 10 && $users['health_train'] != 16 && $users['health_train'] != 22 
    &&$users['health_train'] != 28 && $users['health_train'] != 34 && $users['health_train'] != 40 &&  $users['health_train'] != 46 &&
     $users['health_train'] != 52 && $users['health_train'] != 58 && $users['health_train'] != 64 && $users['health_train'] != 64 && 
     $users['health_train'] != 70  && $users['health_train'] != 76 && $users['health_train'] != 82) {
        echo '<img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро"> ' . $price . '';
    }else{
        echo '<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> ' . $price . '';

    }
    
    echo ' </span></span></a>
    
    </div>
    
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
  } else {
    echo '<div class="trnt-block mb5">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    <div class="white cntr bold sh_b small pb0">
    <div class="medium green2 pb5"><img height="14" width="14" src="img/ico/durability.png" alt="Атака" title="Атака"> Прочность: 84 из 84
    <br>(прокачана по максимуму)
    </div>
    <div class="rate-block mb0">
    
    <div class="scale-block">
    <div class="scale-next" style="width:100%;">
    <div class="scale" style="width:100%;"><div class="in">&nbsp;</div></div>
    </div>
    <div class="mask"><div class="in">&nbsp;</div></div>
    </div>
    
    </div>
    </div>
    
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
 }  
    

 echo'<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini"><div class="mt5 mb5 small green1 cntr">Чем выше звание, тем больше бонус к награде. Каждое улучшение увеличивает параметры на 1.</div></div></div></div></div></div></div></div></div></div>';



 require_once 'system/footer.php';

?>