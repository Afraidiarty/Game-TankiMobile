<style>

.ml58.small.white.sh_b.bold {
    text-align: left;
}    
</style>
<?
require_once 'system/header.php';
if (isset($_GET['id'])){
$id = $_GET['id'];
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

echo '<div class="medium bold white cntr sh_b mb5" w:id="header">Повышай параметры танка</div>';

// АПГРЕД 1
$query = "SELECT * FROM `up_tank` WHERE `id_user` = '$id'";
$result = mysqli_query($connect,$query);
$up_tank = mysqli_fetch_assoc($result);

$TotalUp = $up_tank['attack_up'] + $up_tank['armor_up'] + $up_tank['accuracy_up'] + $up_tank['health_up']
+ $up_tank['attack_up_2'] + $up_tank['armor_up_2'] + $up_tank['accuracy_up_2'] + $up_tank['health_up_2'] ;

    $progressBar = round($TotalUp / $up_tank['max_up'] * 100, 1);
    if ($progressBar > 100) $progressBar = 100;  
// АПГРЕЙД 1

// УЛУЧШЕНИЕ //

$query = "SELECT * FROM `improvement` WHERE `id_user` = '$id'";
$result = mysqli_query($connect,$query);
$improvement = mysqli_fetch_assoc($result);

$TotalUpImprovement = $improvement['attack_up'] + $improvement['armor_up'] + $improvement['accuracy_up'] + $improvement['health_up']
+ $improvement['attack_up_2'] + $improvement['armor_up_2'] + $improvement['accuracy_up_2'] + $improvement['health_up_2'] ;

    $progressBarImprovement = round($TotalUpImprovement / $improvement['max_up'] * 100, 1);
    if ($progressBarImprovement > 100) $progressBarImprovement = 100; 

// УЛУЧШЕНИЕ //




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

echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="inbl">
<div class="thumb fl"><img width="14" height="14" w:id="img" src="img/modif/Improvement.jpg"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Улучшение танка</span><br>
Прогресс: '. $TotalUpImprovement.' из 800
</div>
<div class="clrb"></div>
<table class="rblock esmall">
<tbody><tr>
<td><div class="value-block lh1"><span><span> '. $TotalUpImprovement.' </span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$progressBarImprovement.'%;" w:id="widthPercent">&nbsp;</div><div class="mask">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'. round($progressBarImprovement) .'%</span></span></div></td>
</tr>
</tbody></table>
</div>
<div class="bot a_w50">
<a class="simple-but border" w:id="link" href="uprage?id=' . $users['id'] . '"><span><span>Улучшить</span></span></a></div>
</div>
</div></div></div></div></div></div></div></div>
</div>';


echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="inbl">
<div class="thumb fl"><img width="14" height="14" w:id="img" src="img/modif/Upgrade.jpg"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Апгрейд танка</span><br>
Прогресс: '. $TotalUp.' из 400  
</div>
<div class="clrb"></div>
<table class="rblock esmall">
<tbody><tr>
<td><div class="value-block lh1"><span><span> '. $TotalUp.' </span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$progressBar.'%;" w:id="widthPercent">&nbsp;</div><div class="mask">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'. round($progressBar) .'%</span></span></div></td>
</tr>
</tbody></table>
</div>
<div class="bot a_w50">
<a class="simple-but border" w:id="link" href="pimp?id=' . $users['id'] . '"><span><span>Улучшить</span></span></a></div>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';

// ПОТОМ ВЕРНУСЬ

/*echo'<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="inbl">
<div class="thumb fl"><img width="14" height="14" w:id="img" src="img/modif/Modification.jpg"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Модификация танка</span><br>
Прогресс: 105 из 210
</div>
<div class="clrb"></div>
<table class="rblock esmall">
<tbody><tr>
<td><div class="value-block lh1"><span><span>105</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:0%;" w:id="widthPercent">&nbsp;</div><div class="mask">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>50%</span></span></div></td>
</tr>
</tbody></table>
</div>
<div class="bot a_w50">
<a class="simple-but border" w:id="link" href="../modification/26439504"><span><span>Улучшить</span></span></a>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';*/

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr"><img class="vb pb2" height="14" width="14" src="images/upgrades/starFull.png"> Танковая мощь: сумма всех параметров танка</div></div>
</div></div></div></div></div></div></div></div></div>';

require_once 'system/footer.php';
?>