
<link rel="stylesheet" href="/css/another.css   ">
<style>

    .white {
    text-align: left;
    color: white !important;
}
.inbl-copy {
    display: flex;
}
.ml58 {
    margin-left: 10px;
}
</style>
<?
require_once 'system/header.php';
if (isset($_GET['id'])){
$id = $_GET['id'];
}else{
    $id = $myID;
}



$query = "SELECT img FROM `users` WHERE id = '$id'";
$result = mysqli_query($connect,$query);
$usersIMG = mysqli_fetch_assoc($result);

$AllIMG = "../" . $usersIMG['img'];


$query = "SELECT * FROM `users` WHERE id = '$id'";
$result = mysqli_query($connect,$query);
$users = mysqli_fetch_assoc($result);


$query = "SELECT * FROM `tanks` WHERE img = '$AllIMG'";
$result = mysqli_query($connect,$query);
$tanksINFO = mysqli_fetch_assoc($result);

$MySumStats = $users['attach'] + $users['armor'] + $users['accuracy'] + $users['health'];

echo '<div class="medium bold white cntr sh_b mb5" w:id="header">Улучшения танка</div>';

$query = "SELECT * FROM `up_tank` WHERE `id_user` = '$id'";
$result = mysqli_query($connect,$query);
$up_tank = mysqli_fetch_assoc($result);

$TotalUp = $up_tank['attack_up'] + $up_tank['armor_up'] + $up_tank['accuracy_up'] + $up_tank['health_up'];


// АПГРЕЙД 1




if($tanksINFO['Country'] == 'ussr'){


echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content cntr white bold custombg bg_ussr flag_short" w:id="bgDiv">
<div>
<div class="small bold va_m"><img width="16" height="11" src="img/country/ussr16x11.png"> <span class="white">'. $tanksINFO['Type'] .'</span></div>
</div>

<table>
<tbody><tr>
<td class="cntr"><img class="tank-img tankimgposfix" alt="tank" src="'.$users['img'] .'"></td>

<td class="esmall bold green2 pl5 sh_b va_m w60px">


<img width="14" height="14" src="img/ico/attack.png?1" alt="Атака" title="Атака"> <span class="green2">'.$users['attach'] .'</span><br>

<img width="14" height="14" src="img/ico/armor.png?1" alt="Броня" title="Броня"> <span class="green2">'.$users['armor'] .'</span><br>

<img width="14" height="14" src="img/ico/accuracy.png?1" alt="Точность" title="Точность"> <span class="green2">'.$users['accuracy'] .'</span><br>

<img width="14" height="14" src="img/ico/durability.png?1" alt="Прочность" title="Прочность"> <span class="green2">'.$users['health'] .'</span><br>


</td>

</tr>
</tbody></table>

<div class="cntr small bold green2 pb5">
<img src="img/ico/power.png?2" height="14" width="14"> Танковая мощь: '.$MySumStats .'
<br>

</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';
}

if($tanksINFO['Country'] == 'germany'){
    echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content cntr white bold custombg bg_germany flag_short" w:id="bgDiv">
<div>
<div class="small bold va_m"><img width="16" height="11" src="img/country/germany16x11.png"> <span class="white">'. $tanksINFO['Type'] .'</span></div>
</div>

<table>
<tbody><tr>
<td class="cntr"><img class="tank-img tankimgposfix" alt="tank" src="'.$users['img'] .'"></td>

<td class="esmall bold green2 pl5 sh_b va_m w60px">


<img width="14" height="14" src="img/ico/attack.png?1" alt="Атака" title="Атака"> <span class="green2">'.$users['attach'] .'</span><br>

<img width="14" height="14" src="img/ico/armor.png?1" alt="Броня" title="Броня"> <span class="green2">'.$users['armor'] .'</span><br>

<img width="14" height="14" src="img/ico/accuracy.png?1" alt="Точность" title="Точность"> <span class="green2">'.$users['accuracy'] .'</span><br>

<img width="14" height="14" src="img/ico/durability.png?1" alt="Прочность" title="Прочность"> <span class="green2">'.$users['health'] .'</span><br>


</td>

</tr>
</tbody></table>

<div class="cntr small bold green2 pb5">
<img src="img/ico/power.png?2" height="14" width="14"> Танковая мощь: '.$MySumStats .'
<br>

</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';
}
if($tanksINFO['Country'] == 'usa'){
    echo '<div class="trnt-block mb2">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content cntr white bold custombg bg_usa flag_short" w:id="bgDiv">
    <div>
    <div class="small bold va_m"><img width="16" height="11" src="img/country/usa16x11.png"> <span class="white">'. $tanksINFO['Type'] .'</span></div>
    </div>
    
    <table>
    <tbody><tr>
    <td class="cntr"><img class="tank-img tankimgposfix" alt="tank" src="'.$users['img'] .'"></td>
    
    <td class="esmall bold green2 pl5 sh_b va_m w60px">
    
    
    <img width="14" height="14" src="img/ico/attack.png?1" alt="Атака" title="Атака"> <span class="green2">'.$users['attach'] .'</span><br>
    
    <img width="14" height="14" src="img/ico/armor.png?1" alt="Броня" title="Броня"> <span class="green2">'.$users['armor'] .'</span><br>
    
    <img width="14" height="14" src="img/ico/accuracy.png?1" alt="Точность" title="Точность"> <span class="green2">'.$users['accuracy'] .'</span><br>
    
    <img width="14" height="14" src="img/ico/durability.png?1" alt="Прочность" title="Прочность"> <span class="green2">'.$users['health'] .'</span><br>
    
    
    </td>
    
    </tr>
    </tbody></table>
    
    <div class="cntr small bold green2 pb5">
    <img src="img/ico/power.png?2" height="14" width="14"> Танковая мощь: '.$MySumStats .'
    <br>
    
    </div>
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
}



$levelPrices = array(
    0 => 100,
    1 => 50,  // zol
    2 => 200,
    3 => 100, // zol
    4 => 400,
    5 => 200, // zol
    6 => 800,
    7 => 400, // zol
    8 => 1600,
    9 => 800,   // zol
    10 => 1000
);

$desiredLevelAttack = $up_tank['attack_level'];

if (array_key_exists($desiredLevelAttack, $levelPrices)) {
    $price = $levelPrices[$desiredLevelAttack];

    // Определим количество полных звезд, наполовину и пустых
    $fullStars = floor($desiredLevelAttack / 2);
    $halfStar = $desiredLevelAttack % 2;
    $emptyStars = 5 - $fullStars - $halfStar;

    if(isset($_GET['up_attack'])) {
        $query = "SELECT * FROM `users` WHERE id = '$myID'";
        $result = mysqli_query($connect, $query);
        $users = mysqli_fetch_assoc($result);
    
        $query = "SELECT * FROM `up_tank` WHERE `id_user` = '$myID'";
        $result = mysqli_query($connect, $query);
        $up_tank = mysqli_fetch_assoc($result);
    
        $attack = $users['attach'] + 5;

        $query = "UPDATE `users` SET `attach` = ?, `gold` = ?, `silver` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        
        if ($desiredLevelAttack % 2 == 0 && $desiredLevelAttack != 0) {
            if($users['gold'] >= $price){
                $g = $users['gold'] - $price;
                $s = $users['silver'];

                $attack_up = $up_tank['attack_up'] + 5;
                $attack_level = $up_tank['attack_level'] + 1;

            }else{
                $NeXvataet = abs($users['gold'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        } else {
            if($users['silver'] >= $price){
                $s = $users['silver'] - $price;
                $g = $users['gold'];

                $attack_up = $up_tank['attack_up'] + 5;
                $attack_level = $up_tank['attack_level'] + 1;

            }else{
                $NeXvataet = abs($users['silver'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро "> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        }
        
        if ($stmt) {
            $stmt->bind_param("iiii", $attack, $g, $s, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for users.';
        }

    
        $query = "UPDATE `up_tank` SET `attack_up` = ?, `attack_level` = ? WHERE `id_user` = ?";
        $stmt = $connect->prepare($query);
    
    
        if($stmt) {
            $stmt->bind_param("iii", $attack_up, $attack_level, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for up_tank.';
        }
       header("Location: pimp?id=$myID");
    }
}



echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl-copy orydie ">
<div class="thumb fl"><img src="img/modif/Gun.png" alt="Орудие" title="Орудие"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold left">
<span class="green2">Орудие</span><br>
<img width="14" height="14" src="img/ico/attack.png?1" alt="Броня" title="Броня"> Атака:  '. $up_tank['attack_up'] .' <span class="green1">+5</span><br>';
for ($i = 0; $i < $fullStars; $i++) {
    echo '<img src="img/stars/starFull.png" height="14" width="14"> ';
}
if ($halfStar == 1) {
    echo '<img src="img/stars/starHalf.png" height="14" width="14"> ';
}
for ($i = 0; $i < $emptyStars; $i++) {
    echo '<img src="img/stars/starEmpty.png" height="14" width="14"> ';
}
echo '
</div>
<div class="clrb"></div>
</div>';

if($desiredLevelAttack < 10 and $myID == $id){
    if($desiredLevelAttack % 2 == 0 and $desiredLevelAttack != 0){
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_attack">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $price .'';
    }else{
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_attack">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/silver.png?2" alt="Золото" title="Золото"> '. $price .'';
    }
}

echo '</span></span></a>

</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';

$desiredLevelAccuracy = $up_tank['accuracy_level'];

if (array_key_exists($desiredLevelAccuracy, $levelPrices)) {
    $price = $levelPrices[$desiredLevelAccuracy];

    // Определим количество полных звезд, наполовину и пустых
    $fullStars = floor($desiredLevelAccuracy / 2);
    $halfStar = $desiredLevelAccuracy % 2;
    $emptyStars = 5 - $fullStars - $halfStar;

    if(isset($_GET['up_optica'])) {
        $query = "SELECT * FROM `users` WHERE id = '$myID'";
        $result = mysqli_query($connect, $query);
        $users = mysqli_fetch_assoc($result);
    
        $query = "SELECT * FROM `up_tank` WHERE `id_user` = '$myID'";
        $result = mysqli_query($connect, $query);
        $up_tank = mysqli_fetch_assoc($result);
    
        $accuracy = $users['accuracy'] + 5;

        $query = "UPDATE `users` SET `accuracy` = ?, `gold` = ?, `silver` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        
        if ($desiredLevelAccuracy % 2 == 0 && $desiredLevelAccuracy != 0) {
            if($users['gold'] >= $price){
                $g = $users['gold'] - $price;
                $s = $users['silver'];

                $accuracy_up = $up_tank['accuracy_up'] + 5;
                $accuracy_level = $up_tank['accuracy_level'] + 1;

            }else{
                $NeXvataet = abs($users['gold'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        } else {
            if($users['silver'] >= $price){
                $s = $users['silver'] - $price;
                $g = $users['gold'];

                $accuracy_up = $up_tank['accuracy_up'] + 5;
                $accuracy_level = $up_tank['accuracy_level'] + 1;

            }else{
                $NeXvataet = abs($users['silver'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро "> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        }
        
        if ($stmt) {
            $stmt->bind_param("iiii", $accuracy, $g, $s, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for users.';
        }

    
        $query = "UPDATE `up_tank` SET `accuracy_up` = ?, `accuracy_level` = ? WHERE `id_user` = ?";
        $stmt = $connect->prepare($query);
    
    
        if($stmt) {
            $stmt->bind_param("iii", $accuracy_up, $accuracy_level, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for up_tank.';
        }
       header("Location: pimp?id=$myID");
    }
}



echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl-copy  optika">
<div class="thumb fl"><img src="img/modif/Optronics.png" alt="Оптика" title="Оптика"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold left">
<span class="green2">Оптика</span><br>
<img width="14" height="14" src="img/ico/accuracy.png?1" alt="Точность" title="Точность"> Точность:  '. $up_tank['accuracy_up'] .' <span class="green1">+5</span><br>';
for ($i = 0; $i < $fullStars; $i++) {
    echo '<img src="img/stars/starFull.png" height="14" width="14"> ';
}
if ($halfStar == 1) {
    echo '<img src="img/stars/starHalf.png" height="14" width="14"> ';
}
for ($i = 0; $i < $emptyStars; $i++) {
    echo '<img src="img/stars/starEmpty.png" height="14" width="14"> ';
}
echo '
</div>
<div class="clrb"></div>
</div>';

if($desiredLevelAccuracy < 10 and $myID == $id){
    if($desiredLevelAccuracy % 2 == 0 and $desiredLevelAccuracy != 0){
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_optica">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $price .'';
    }else{
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_optica">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/silver.png?2" alt="Золото" title="Золото"> '. $price .'';
    }
}

echo '</span></span></a>

</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';

$desiredLevelHealth = $up_tank['health_level'];

if (array_key_exists($desiredLevelHealth, $levelPrices)) {
    $price = $levelPrices[$desiredLevelHealth];

    // Определим количество полных звезд, наполовину и пустых
    $fullStars = floor($desiredLevelHealth / 2);
    $halfStar = $desiredLevelHealth % 2;
    $emptyStars = 5 - $fullStars - $halfStar;

    if(isset($_GET['up_health'])) {
        $query = "SELECT * FROM `users` WHERE id = '$myID'";
        $result = mysqli_query($connect, $query);
        $users = mysqli_fetch_assoc($result);
    
        $query = "SELECT * FROM `up_tank` WHERE `id_user` = '$myID'";
        $result = mysqli_query($connect, $query);
        $up_tank = mysqli_fetch_assoc($result);
    
        $health = $users['health'] + 5;

        $query = "UPDATE `users` SET `health` = ?, `gold` = ?, `silver` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        
        if ($desiredLevelHealth % 2 == 0 && $desiredLevelHealth != 0) {
            if($users['gold'] >= $price){
                $g = $users['gold'] - $price;
                $s = $users['silver'];

                $health_up = $up_tank['health_up'] + 5;
                $health_level = $up_tank['health_level'] + 1;

            }else{
                $NeXvataet = abs($users['gold'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        } else {
            if($users['silver'] >= $price){
                $s = $users['silver'] - $price;
                $g = $users['gold'];

                $health_up = $up_tank['health_up'] + 5;
                $health_level = $up_tank['health_level'] + 1;

            }else{
                $NeXvataet = abs($users['silver'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро "> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        }
        
        if ($stmt) {
            $stmt->bind_param("iiii", $health, $g, $s, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for users.';
        }

    
        $query = "UPDATE `up_tank` SET `health_up` = ?, `health_level` = ? WHERE `id_user` = ?";
        $stmt = $connect->prepare($query);
    
    
        if($stmt) {
            $stmt->bind_param("iii", $health_up, $health_level, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for up_tank.';
        }
       header("Location: pimp?id=$myID");
    }
}




echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl-copy corpus">
<div class="thumb fl"><img src="img/modif/Frame.png" alt="Корпус" title="Корпус"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold left">
<span class="green2">Корпус</span><br>
<img width="14" height="14" src="img/ico/durability.png" alt="Здоровье" title="Здоровье"> Прочность:  '. $up_tank['health_up'] .' <span class="green1">+5</span><br>';
for ($i = 0; $i < $fullStars; $i++) {
    echo '<img src="img/stars/starFull.png" height="14" width="14"> ';
}
if ($halfStar == 1) {
    echo '<img src="img/stars/starHalf.png" height="14" width="14"> ';
}
for ($i = 0; $i < $emptyStars; $i++) {
    echo '<img src="img/stars/starEmpty.png" height="14" width="14"> ';
}
echo '
</div>
<div class="clrb"></div>
</div>';

if($desiredLevelHealth < 10 and $myID == $id){
    if($desiredLevelHealth % 2 == 0 and $desiredLevelHealth != 0){
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_health">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $price .'';
    }else{
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_health">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/silver.png?2" alt="Золото" title="Золото"> '. $price .'';
    }
}

echo '</span></span></a>

</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';


$desiredLevelArmor = $up_tank['armor_level'];

if (array_key_exists($desiredLevelArmor, $levelPrices)) {
    $price = $levelPrices[$desiredLevelArmor];

    // Определим количество полных звезд, наполовину и пустых
    $fullStars = floor($desiredLevelArmor / 2);
    $halfStar = $desiredLevelArmor % 2;
    $emptyStars = 5 - $fullStars - $halfStar;

    if(isset($_GET['up_podboy'])) {
        $query = "SELECT * FROM `users` WHERE id = '$myID'";
        $result = mysqli_query($connect, $query);
        $users = mysqli_fetch_assoc($result);
    
        $query = "SELECT * FROM `up_tank` WHERE `id_user` = '$myID'";
        $result = mysqli_query($connect, $query);
        $up_tank = mysqli_fetch_assoc($result);
    
        $armor = $users['armor'] + 5;

        $query = "UPDATE `users` SET `armor` = ?, `gold` = ?, `silver` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        
        if ($desiredLevelArmor % 2 == 0 && $desiredLevelArmor != 0) {
            if($users['gold'] >= $price){
                $g = $users['gold'] - $price;
                $s = $users['silver'];

                $armor_up = $up_tank['armor_up'] + 5;
                $armor_level = $up_tank['armor_level'] + 1;

            }else{
                $NeXvataet = abs($users['gold'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        } else {
            if($users['silver'] >= $price){
                $s = $users['silver'] - $price;
                $g = $users['gold'];

                $armor_up = $up_tank['armor_up'] + 5;
                $armor_level = $up_tank['armor_level'] + 1;

            }else{
                $NeXvataet = abs($users['silver'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро "> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        }
        
        if ($stmt) {
            $stmt->bind_param("iiii", $armor, $g, $s, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for users.';
        }

    
        $query = "UPDATE `up_tank` SET `armor_up` = ?, `armor_level` = ? WHERE `id_user` = ?";
        $stmt = $connect->prepare($query);
    
    
        if($stmt) {
            $stmt->bind_param("iii", $armor_up, $armor_level, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for up_tank.';
        }
       header("Location: pimp?id=$myID");
    }
}



echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl-copy podboy">
<div class="thumb fl"><img src="img/modif/FragShield.png" alt="Противоосколочный подбой" title="Противоосколочный подбой"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold left">
<span class="green2">Противоосколочный подбой</span><br>
<img width="14" height="14" src="img/ico/armor.png?1" alt="Броня" title="Броня"> Броня:  '. $up_tank['armor_up'] .' <span class="green1">+5</span><br>';
for ($i = 0; $i < $fullStars; $i++) {
    echo '<img src="img/stars/starFull.png" height="14" width="14"> ';
}
if ($halfStar == 1) {
    echo '<img src="img/stars/starHalf.png" height="14" width="14"> ';
}
for ($i = 0; $i < $emptyStars; $i++) {
    echo '<img src="img/stars/starEmpty.png" height="14" width="14"> ';
}
echo '
</div>
<div class="clrb"></div>
</div>';

if($desiredLevelArmor < 10 and $myID == $id){
    if($desiredLevelArmor % 2 == 0 and $desiredLevelArmor != 0){
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_podboy">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $price .'';
    }else{
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_podboy">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/silver.png?2" alt="Золото" title="Золото"> '. $price .'';
    }
}

echo '</span></span></a>

</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';



// повторение 

$desiredLevelAttack_2 = $up_tank['attack_level_2'];

if (array_key_exists($desiredLevelAttack_2, $levelPrices)) {
    $price = $levelPrices[$desiredLevelAttack_2];

    // Определим количество полных звезд, наполовину и пустых
    $fullStars = floor($desiredLevelAttack_2 / 2);
    $halfStar = $desiredLevelAttack_2 % 2;
    $emptyStars = 5 - $fullStars - $halfStar;

    if(isset($_GET['up_attack_2'])) {
        $query = "SELECT * FROM `users` WHERE id = '$myID'";
        $result = mysqli_query($connect, $query);
        $users = mysqli_fetch_assoc($result);
    
        $query = "SELECT * FROM `up_tank` WHERE `id_user` = '$myID'";
        $result = mysqli_query($connect, $query);
        $up_tank = mysqli_fetch_assoc($result);
    
        $attack = $users['attach'] + 5;

        $query = "UPDATE `users` SET `attach` = ?, `gold` = ?, `silver` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        
        if ($desiredLevelAttack_2 % 2 == 0 && $desiredLevelAttack_2 != 0) {
            if($users['gold'] >= $price){
                $g = $users['gold'] - $price;
                $s = $users['silver'];

                $attack_up_2 = $up_tank['attack_up_2'] + 5;
                $attack_level_2 = $up_tank['attack_level_2'] + 1;

            }else{
                $NeXvataet = abs($users['gold'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        } else {
            if($users['silver'] >= $price){
                $s = $users['silver'] - $price;
                $g = $users['gold'];

                $attack_up_2 = $up_tank['attack_up_2'] + 5;
                $attack_level_2 = $up_tank['attack_level_2'] + 1;

            }else{
                $NeXvataet = abs($users['silver'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро "> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        }
        
        if ($stmt) {
            $stmt->bind_param("iiii", $attack, $g, $s, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for users.';
        }

    
        $query = "UPDATE `up_tank` SET `attack_up_2` = ?, `attack_level_2` = ? WHERE `id_user` = ?";
        $stmt = $connect->prepare($query);
    
    
        if($stmt) {
            $stmt->bind_param("iii", $attack_up_2, $attack_level_2, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for up_tank.';
        }
       header("Location: pimp?id=$myID");
    }
}



echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl-copy dosilatel ">
<div class="thumb fl"><img src="img/modif/GunRammer.png" alt="Орудийный досылатель" title="Орудийный досылатель"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold left">
<span class="green2">Орудийный досылатель</span><br>
<img width="14" height="14" src="img/ico/attack.png?1" alt="Броня" title="Броня"> Атака:  '. $up_tank['attack_up_2'] .' <span class="green1">+5</span><br>';
for ($i = 0; $i < $fullStars; $i++) {
    echo '<img src="img/stars/starFull.png" height="14" width="14"> ';
}
if ($halfStar == 1) {
    echo '<img src="img/stars/starHalf.png" height="14" width="14"> ';
}
for ($i = 0; $i < $emptyStars; $i++) {
    echo '<img src="img/stars/starEmpty.png" height="14" width="14"> ';
}
echo '
</div>
<div class="clrb"></div>
</div>';

if($desiredLevelAttack_2 < 10 and $myID == $id){
    if($desiredLevelAttack_2 % 2 == 0 and $desiredLevelAttack_2 != 0){
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_attack_2">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $price .'';
    }else{
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_attack_2">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/silver.png?2" alt="Золото" title="Золото"> '. $price .'';
    }
}

echo '</span></span></a>

</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';

$desiredLevelAccuracy_2 = $up_tank['accuracy_level_2'];

if (array_key_exists($desiredLevelAccuracy_2, $levelPrices)) {
    $price = $levelPrices[$desiredLevelAccuracy_2];

    // Определим количество полных звезд, наполовину и пустых
    $fullStars = floor($desiredLevelAccuracy_2 / 2);
    $halfStar = $desiredLevelAccuracy_2 % 2;
    $emptyStars = 5 - $fullStars - $halfStar;

    if(isset($_GET['up_optica_2'])) {
        $query = "SELECT * FROM `users` WHERE id = '$myID'";
        $result = mysqli_query($connect, $query);
        $users = mysqli_fetch_assoc($result);
    
        $query = "SELECT * FROM `up_tank` WHERE `id_user` = '$myID'";
        $result = mysqli_query($connect, $query);
        $up_tank = mysqli_fetch_assoc($result);
    
        $accuracy = $users['accuracy'] + 5;

        $query = "UPDATE `users` SET `accuracy` = ?, `gold` = ?, `silver` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        
        if ($desiredLevelAccuracy_2 % 2 == 0 && $desiredLevelAccuracy_2 != 0) {
            if($users['gold'] >= $price){
                $g = $users['gold'] - $price;
                $s = $users['silver'];

                $accuracy_up_2 = $up_tank['accuracy_up_2'] + 5;
                $accuracy_level_2 = $up_tank['accuracy_level_2'] + 1;

            }else{
                $NeXvataet = abs($users['gold'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        } else {
            if($users['silver'] >= $price){
                $s = $users['silver'] - $price;
                $g = $users['gold'];

                $accuracy_up_2 = $up_tank['accuracy_up_2'] + 5;
                $accuracy_level_2 = $up_tank['accuracy_level_2'] + 1;

            }else{
                $NeXvataet = abs($users['silver'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро "> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        }
        
        if ($stmt) {
            $stmt->bind_param("iiii", $accuracy, $g, $s, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for users.';
        }

    
        $query = "UPDATE `up_tank` SET `accuracy_up_2` = ?, `accuracy_level_2` = ? WHERE `id_user` = ?";
        $stmt = $connect->prepare($query);
    
    
        if($stmt) {
            $stmt->bind_param("iii", $accuracy_up_2, $accuracy_level_2, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for up_tank.';
        }
       header("Location: pimp?id=$myID");
    }
}



echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl-copy stereo">
<div class="thumb fl"><img src="img/modif/Stereoscope.png" alt="Стереотруба" title="Стереотруба"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold left">
<span class="green2">Стереотруба</span><br>
<img width="14" height="14" src="img/ico/accuracy.png?1" alt="Точность" title="Точность"> Точность:  '. $up_tank['accuracy_up_2'] .' <span class="green1">+5</span><br>';
for ($i = 0; $i < $fullStars; $i++) {
    echo '<img src="img/stars/starFull.png" height="14" width="14"> ';
}
if ($halfStar == 1) {
    echo '<img src="img/stars/starHalf.png" height="14" width="14"> ';
}
for ($i = 0; $i < $emptyStars; $i++) {
    echo '<img src="img/stars/starEmpty.png" height="14" width="14"> ';
}
echo '
</div>
<div class="clrb"></div>
</div>';

if($desiredLevelAccuracy_2 < 10 and $myID == $id){
    if($desiredLevelAccuracy_2 % 2 == 0 and $desiredLevelAccuracy_2 != 0){
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_optica_2">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $price .'';
    }else{
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_optica_2">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/silver.png?2" alt="Золото" title="Золото"> '. $price .'';
    }
}

echo '</span></span></a>

</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';

$desiredLevelHealth_2 = $up_tank['health_level_2'];

if (array_key_exists($desiredLevelHealth_2, $levelPrices)) {
    $price = $levelPrices[$desiredLevelHealth_2];

    // Определим количество полных звезд, наполовину и пустых
    $fullStars = floor($desiredLevelHealth_2 / 2);
    $halfStar = $desiredLevelHealth_2 % 2;
    $emptyStars = 5 - $fullStars - $halfStar;

    if(isset($_GET['up_health_2'])) {
        $query = "SELECT * FROM `users` WHERE id = '$myID'";
        $result = mysqli_query($connect, $query);
        $users = mysqli_fetch_assoc($result);
    
        $query = "SELECT * FROM `up_tank` WHERE `id_user` = '$myID'";
        $result = mysqli_query($connect, $query);
        $up_tank = mysqli_fetch_assoc($result);
    
        $health = $users['health'] + 5;

        $query = "UPDATE `users` SET `health` = ?, `gold` = ?, `silver` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        
        if ($desiredLevelHealth_2 % 2 == 0 && $desiredLevelHealth_2 != 0) {
            if($users['gold'] >= $price){
                $g = $users['gold'] - $price;
                $s = $users['silver'];

                $health_up_2 = $up_tank['health_up_2'] + 5;
                $health_level_2 = $up_tank['health_level_2'] + 1;

            }else{
                $NeXvataet = abs($users['gold'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        } else {
            if($users['silver'] >= $price){
                $s = $users['silver'] - $price;
                $g = $users['gold'];

                $health_up_2 = $up_tank['health_up_2'] + 5;
                $health_level_2 = $up_tank['health_level_2'] + 1;

            }else{
                $NeXvataet = abs($users['silver'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро "> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        }
        
        if ($stmt) {
            $stmt->bind_param("iiii", $health, $g, $s, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for users.';
        }

    
        $query = "UPDATE `up_tank` SET `health_up_2` = ?, `health_level_2` = ? WHERE `id_user` = ?";
        $stmt = $connect->prepare($query);
    
    
        if($stmt) {
            $stmt->bind_param("iii", $health_up_2, $health_level_2, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for up_tank.';
        }
       header("Location: pimp?id=$myID");
    }
}




echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl-copy boyekladka">
<div class="thumb fl"><img src="img/modif/ShellBoxCover.png" alt="Защита боеукладки" title="Защита боеукладки"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold left">
<span class="green2">Защита боеукладки</span><br>
<img width="14" height="14" src="img/ico/durability.png" alt="Здоровье" title="Здоровье"> Прочность:  '. $up_tank['health_up_2'] .' <span class="green1">+5</span><br>';
for ($i = 0; $i < $fullStars; $i++) {
    echo '<img src="img/stars/starFull.png" height="14" width="14"> ';
}
if ($halfStar == 1) {
    echo '<img src="img/stars/starHalf.png" height="14" width="14"> ';
}
for ($i = 0; $i < $emptyStars; $i++) {
    echo '<img src="img/stars/starEmpty.png" height="14" width="14"> ';
}
echo '
</div>
<div class="clrb"></div>
</div>';

if($desiredLevelHealth_2 < 10 and $myID == $id){
    if($desiredLevelHealth_2 % 2 == 0 and $desiredLevelHealth_2 != 0){
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_health_2">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $price .'';
    }else{
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_health_2">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/silver.png?2" alt="Золото" title="Золото"> '. $price .'';
    }
}

echo '</span></span></a>

</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';


$desiredLevelArmor_2 = $up_tank['armor_level_2'];

if (array_key_exists($desiredLevelArmor_2, $levelPrices)) {
    $price = $levelPrices[$desiredLevelArmor_2];

    // Определим количество полных звезд, наполовину и пустых
    $fullStars = floor($desiredLevelArmor_2 / 2);
    $halfStar = $desiredLevelArmor_2 % 2;
    $emptyStars = 5 - $fullStars - $halfStar;

    if(isset($_GET['up_armor_2'])) {
        $query = "SELECT * FROM `users` WHERE id = '$myID'";
        $result = mysqli_query($connect, $query);
        $users = mysqli_fetch_assoc($result);
    
        $query = "SELECT * FROM `up_tank` WHERE `id_user` = '$myID'";
        $result = mysqli_query($connect, $query);
        $up_tank = mysqli_fetch_assoc($result);
    
        $armor = $users['armor'] + 5;

        $query = "UPDATE `users` SET `armor` = ?, `gold` = ?, `silver` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        
        if ($desiredLevelArmor_2 % 2 == 0 && $desiredLevelArmor_2 != 0) {
            if($users['gold'] >= $price){
                $g = $users['gold'] - $price;
                $s = $users['silver'];

                $armor_up_2 = $up_tank['armor_up_2'] + 5;
                $armor_level_2 = $up_tank['armor_level_2'] + 1;

            }else{
                $NeXvataet = abs($users['gold'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        } else {
            if($users['silver'] >= $price){
                $s = $users['silver'] - $price;
                $g = $users['gold'];

                $armor_up_2 = $up_tank['armor_up_2'] + 5;
                $armor_level_2 = $up_tank['armor_level_2'] + 1;

            }else{
                $NeXvataet = abs($users['silver'] - $price); 
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
                <img class="ico vm" src="img/ico/silver.png?2" alt="Серебро" title="Серебро "> '. $NeXvataet .'
                 золота
                </div></div>';
            }
        }
        
        if ($stmt) {
            $stmt->bind_param("iiii", $armor, $g, $s, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for users.';
        }

    
        $query = "UPDATE `up_tank` SET `armor_up_2` = ?, `armor_level_2` = ? WHERE `id_user` = ?";
        $stmt = $connect->prepare($query);
    
    
        if($stmt) {
            $stmt->bind_param("iii", $armor_up_2, $armor_level_2, $myID);
            $stmt->execute();
            $stmt->close();
        } else {
            echo 'Failed to prepare statement for up_tank.';
        }
       header("Location: pimp?id=$myID");
    }
}



echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl-copy naklon">
<div class="thumb fl"><img src="img/modif/SlopedArmour.png" alt="Наклонная броня" title="Наклонная броня"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold left">
<span class="green2">Наклонная броня</span><br>
<img width="14" height="14" src="img/ico/armor.png?1" alt="Броня" title="Броня"> Броня:  '. $up_tank['armor_up_2'] .' <span class="green1">+5</span><br>';
for ($i = 0; $i < $fullStars; $i++) {
    echo '<img src="img/stars/starFull.png" height="14" width="14"> ';
}
if ($halfStar == 1) {
    echo '<img src="img/stars/starHalf.png" height="14" width="14"> ';
}
for ($i = 0; $i < $emptyStars; $i++) {
    echo '<img src="img/stars/starEmpty.png" height="14" width="14"> ';
}
echo '
</div>
<div class="clrb"></div>
</div>';

if($desiredLevelArmor_2 < 10 and $myID == $id){
    if($desiredLevelArmor_2 % 2 == 0 and $desiredLevelArmor_2 != 0){
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_armor_2">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $price .'';
    }else{
        echo '<div class="bot">
        <a class="simple-but border mb5" href="?up_armor_2">
        <span><span>
        Улучшить за
        <img class="ico vm" src="img/ico/silver.png?2" alt="Золото" title="Золото"> '. $price .'';
    }
}

echo '</span></span></a>

</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Улучшай параметры танка, чтобы повысить танковую мощь!</div></div></div></div></div></div></div></div></div></div></div>';

echo '<a class="simple-but border mb2" w:id="powerLink" href="power?id='. $users['id'] .'"><span><span>Назад</span></span></a>';


require_once 'system/footer.php';
?>