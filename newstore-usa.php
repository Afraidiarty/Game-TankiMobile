<?
require_once 'system/header.php';

switch($users['tankLevel']){
    case 1: $AddStatsForTank = 0; break;
    case 2: $AddStatsForTank = 200; break;
    case 3: $AddStatsForTank = 700; break;
}

if (($users['tankLevel'] != 2 || $users['tankLevel'] != 3) && $nation['Country'] != 'ussr' && $users['tankLevel'] != 1) {
    switch($users['tankLevel']){
        case 1: $AddStatsForTank = 0; break;
        case 2: $AddStatsForTank = 200; break;
        case 3: $AddStatsForTank = 700; break;
    }
}


if (isset($_GET['buy-standart'])) {
    if ($nation['Country'] != 'usa') {
        if ($users['gold'] >= 400) {
            if ($users['tankLevel'] > 1) {
                $query = "UPDATE `users` 
                          SET `gold` = `gold` - 400, 
                              `img` = 'img/countr/tanks/usa-sred.png', 
                              `attach` = `attach` - ?, 
                              `armor` = `armor` - ?, 
                              `accuracy` = `accuracy` - ?, 
                              `health` = `health` - ?, `tankLevel` = 1
                          WHERE id = ?";
            } else {
                $query = "UPDATE `users` 
                          SET `gold` = `gold` - 400, 
                              `img` = 'img/countr/tanks/usa-sred.png', 
                              `attach` = `attach` + ?, 
                              `armor` = `armor` + ?, 
                              `accuracy` = `accuracy` + ?, 
                              `health` = `health` + ?
                          WHERE id = ?";
            }

            $stmt = $connect->prepare($query);

            $stmt->bind_param("iiiii", $AddStatsForTank, $AddStatsForTank, $AddStatsForTank, $AddStatsForTank, $myID);
            $stmt->execute();   
            $_SESSION['msg'] = '<div class="green1 pb5">Вы купили "Средний Танк"!</div>';
        } else {

            $NeXvataet = abs($users['gold'] - 400);
            $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
            <img class="ico vm" src="img/ico/gold.png?2" alt="Золота" title="Золота"> ' . $NeXvataet . '
             золота</div></div>';
        }
    }
    header("Location: newstore-usa");
}

if(isset($_GET['buy-st'])){
    if($nation['Country'] == 'usa'){
        if($users['gold'] >= 700){
            $query = "UPDATE `users` SET `attach` = `attach` + 200 , `armor` = `armor` + 200 , `accuracy` = `accuracy` + 200 ,
            `health` = `health` + 200 , `gold` = `gold` - 700, `img` = 'img/countr/tanks/st-buy-usa.png',`tankLevel` = 2 WHERE id = ?";
            $stmt = $connect->prepare($query);
            $stmt->bind_param("i", $myID);
            $stmt->execute();
            $_SESSION['msg'] = '<div class="green1 pb5">Вы купили "Средний Танк"!</div>';
 
    }else{
        $NeXvataet = abs($users['gold']-700);   
        $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
        <img class="ico vm" src="img/ico/gold.png?2" alt="Золота" title="Золота"> '. $NeXvataet .'
         золота</div></div>'; 
    }
    }else{
        $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> Вы не можете приобрести этот танк,купите предыдущий</div>';  
    }  
    header("Location: newstore-usa");
}

if(isset($_GET['pt-buy'])){
    if($nation['Country'] == 'usa'){
        if($users['gold'] >= 2000){
            if($users['img'] == 'img/countr/tanks/st-buy-usa.png'){
                $query = "UPDATE `users` SET `attach` = `attach` + 500 , `armor` = `armor` + 500 , `accuracy` = `accuracy` + 500 ,
                `health` = `health` + 500 , `gold` = `gold` - 2000, `img` = 'img/countr/tanks/pt-buy-usa.png',`tankLevel` = 3 WHERE id = ?";
                $stmt = $connect->prepare($query);

                $stmt->bind_param("i", $myID);
                $stmt->execute();
                $_SESSION['msg'] = '<div class="green1 pb5">Вы купили "Истрибитель"!</div>';
            }else{
                $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> Купите предыдущий танк</div>';   
            }
        }else{
            $NeXvataet = abs($users['gold']-2000);   
            $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
            <img class="ico vm" src="img/ico/gold.png?2" alt="Золота" title="Золота"> '. $NeXvataet .'
            золота</div></div>'; 
        }
    }else{
        $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> Вы не можете приобрести этот танк,купите предыдущий</div>';  
    }
    header("Location: newstore-usa");
}

echo '<table>
<tbody><tr>
<td style="width:50%;padding:0 3px;">
<span class="simple-but border gray"><em><span><span>Танки</span></span></em></span>
</td>
<td style="width:50%;padding:0 3px;">
<a class="simple-but border" href="../magazine"><span><span>Амуниция</span></span></a>
</td>
</tr>
</tbody></table>';

echo '<div class="small sh_b bold cntr mb5">
<div class="white"><img src="img/ico/victory.png"> Страна: <span class="green2" w:id="country">США</span> <img src="img/ico/victory.png"></div>
</div>';

echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<table class="cntr small bold">
<tbody><tr>
<td style="width:33%;">
<a class="white" w:id="selectusa" href="newstore-germany">
Германия<br>
<img src="img/countr/germany.png" width="70" height="47" w:id="flagImg" style="opacity:0.4;">
</a>
</td>
<td style="width:33%;">
<a class="white" w:id="selectusa" href="newstore-ussr">
СССР<br>
<img src="img/countr/ussr.png" width="70" height="47" w:id="flagImg" style="opacity: 0.4;">
</a>
</td>
<td style="width:33%;">
<a class="white" w:id="selectUsa" href="newstore-usa">
США<br>
<img src="img/countr/usa.png" width="70" height="47" w:id="flagImg" style="opacity:1;">
</a>
</td>
</tr>
</tbody></table>
</div>
</div></div></div></div></div></div></div></div>
</div>';

echo '<div class="trnt-block mb5" w:id="root">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content cntr custombg bg_usa flag_short" w:id="bgDiv">
<div class="small sh_b bold">

<div class="white mb5 mt5">Выбранный танк</div>

<div>
<div class="small bold va_m"><img width="16" height="11" src="img/country/usa16x11.png"> <span class="white">'.($nation['Country'] == 'usa' ? $nation['Type'] : 'Средний танк') .'</span></div>
</div>

<table>
<tbody><tr>';

if($nation['Country'] != 'usa'){
echo '<td class="cntr"><img class="tank-img tankimgposfix" alt="tank" src="img/countr/tanks/usa-sred.png"></td>';
}else{
    echo '<td class="cntr"><img class="tank-img tankimgposfix" alt="tank" src="'.$users['img'].'"></td>';
}
echo '<td class="esmall bold green2 pl5 sh_b va_m w60px"  style = "white-space:nowrap;">


<img width="14" height="14" src="img/ico/attack.png?1" alt="Атака" title="Атака"> <span class="green2">' . $users['attach'] . (($users['tankLevel'] != 2 or $users['tankLevel'] != 3) && $nation['Country'] != 'usa' && $users['tankLevel'] != 1 ? '<span class="red1"> -' . $AddStatsForTank . '</span>' : '') . '<br>
<img width="14" height="14" src="img/ico/armor.png?1" alt="Броня" title="Броня"> <span class="green2">'.$users['armor']. (($users['tankLevel'] != 2 or $users['tankLevel'] != 3) && $nation['Country'] != 'usa' && $users['tankLevel'] != 1 ? '<span class="red1"> -' . $AddStatsForTank . '</span>' : '') . '<br>

<img width="14" height="14" src="img/ico/accuracy.png?1" alt="Точность" title="Точность"> <span class="green2">'.$users['accuracy']. (($users['tankLevel'] != 2 or $users['tankLevel'] != 3) && $nation['Country'] != 'usa' && $users['tankLevel'] != 1 ? '<span class="red1"> -' . $AddStatsForTank . '</span>' : '') . '<br>

<img width="14" height="14" src="img/ico/durability.png?1" alt="Прочность" title="Прочность"> <span class="green2">'.$users['health']. (($users['tankLevel'] != 2 or $users['tankLevel'] != 3) && $nation['Country'] != 'usa' && $users['tankLevel'] != 1 ? '<span class="red1"> -' . $AddStatsForTank . '</span>' : '') . '<br>


</td>

</tr>
</tbody></table>
<div class="mb2 pb0">
<img src="img/ico/power.png?2" height="14" width="14"> <span class="green2">Танковая мощь: '.$MySumStats. (($users['tankLevel'] != 2 or $users['tankLevel'] != 3) && $nation['Country'] != 'usa' && $users['tankLevel'] != 1 ? '<span class="red1"> -' . $AddStatsForTank * 4 . '</span>' : '') . '<br>
</div>
</div>
</div>';
if($nation['Country'] == 'usa'){
echo '<div class="bot"><span class="simple-but gray border"><span><span>Танк в наличии</span></span></span></div>';
}else{
    echo '<div class="bot">

<a class="simple-but border mb5" href="?buy-standart">
<span><span>
Купить за

<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 400
</span></span></a>
</div>';
}
echo '</div></div></div></div></div></div></div></div>
</div>';

echo '<div class="trnt-block" w:id="root">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content cntr custombg bg_usa" w:id="bgDiv">
<div class="small sh_b bold">

<div>
<div class="small bold va_m"><img width="16" height="11" src="img/country/usa16x11.png"> <span class="white">Средний танк</span></div>
</div>

<table>
<tbody><tr>
<td class="cntr"><img class="tank-img tankimgposfix" alt="tank" src="img/countr/tanks/st-buy-usa.png"></td>

<td class="esmall bold green2 pl5 sh_b va_m w60px" style = "white-space: nowrap;">


<img width="14" height="14" src="img/ico/attack.png?1" alt="Атака" title="Атака"> <span class="green2">'.$users['attach']. ($users['tankLevel'] > 2 ? '<span class="red1"> -500</span>' : ($users['tankLevel'] != 2 ? '<span class="green1"> +200</span>' : ''))  . '<br>

<img width="14" height="14" src="img/ico/armor.png?1" alt="Броня" title="Броня"> <span class="green2">'.$users['armor']. ($users['tankLevel'] > 2 ? '<span class="red1"> -500</span>' : ($users['tankLevel'] != 2 ? '<span class="green1"> +200</span>' : ''))  . '<br>

<img width="14" height="14" src="img/ico/accuracy.png?1" alt="Точность" title="Точность"> <span class="green2">'.$users['accuracy']. ($users['tankLevel'] > 2 ? '<span class="red1"> -500</span>' : ($users['tankLevel'] != 2 ? '<span class="green1"> +200</span>' : ''))  . '<br>

<img width="14" height="14" src="img/ico/durability.png?1" alt="Прочность" title="Прочность"> <span class="green2">'.$users['health']. ($users['tankLevel'] > 2 ? '<span class="red1"> -500</span>' : ($users['tankLevel'] != 2 ? '<span class="green1"> +200</span>' : ''))  . '<br>


</td>

</tr>
</tbody></table>

<div class="mb2 pb0">
<img src="img/ico/power.png?2" height="14" width="14"> <span class="green2">Танковая мощь: '.$MySumStats. ($users['tankLevel'] == 3 && $users['Country'] != 'usa' ? '<span class="red1"> -' . 500 * 4 . '</span>' : ($users['tankLevel'] != 2? '<span class="green1"> +1200</span></span>' : '')) . '</span>
</div>
</div>';

if($users['img'] == 'img/countr/tanks/st-buy-usa.png' or $users['img'] == 'img/countr/tanks/pt-buy-usa.png')
echo '<div class="bot"><span class="simple-but gray border"><span><span>Танк в наличии</span></span></span></div>';
else{
echo '<div class="bot">

<a class="simple-but border mb5" href="?buy-st">
<span><span>
Купить за

<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 700
</span></span></a>
</div>';
}


echo '</div>
</div></div></div></div></div></div></div></div>
</div>';


echo '<div class="trnt-block" w:id="root">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content cntr custombg bg_usa" w:id="bgDiv">
<div class="small sh_b bold">

<div>
<div class="small bold va_m"><img width="16" height="11" src="img/country/usa16x11.png"> <span class="white">Истрибитель</span></div>
</div>

<table>
<tbody><tr>
<td class="cntr"><img class="tank-img tankimgposfix" alt="tank" src="img/countr/tanks/pt-buy-usa.png"></td>

<td class="esmall bold green2 pl5 sh_b va_m w60px" style = "white-space: nowrap;">


<img width="14" height="14" src="img/ico/attack.png?1" alt="Атака" title="Атака"> <span class="green2">'.$users['attach']. ($users['tankLevel'] > 3 ? '<span class="red1"> -' . $AddStatsForTank . '</span>' : ($users['tankLevel'] != 3 ? '<span class="green1"> +500</span>' : ''))  . '<br>

<img width="14" height="14" src="img/ico/armor.png?1" alt="Броня" title="Броня"> <span class="green2">'.$users['armor']. ($users['tankLevel'] > 3 ? '<span class="red1"> -' . $AddStatsForTank . '</span>' : ($users['tankLevel'] != 3 ? '<span class="green1"> +500</span>' : ''))  . '<br>

<img width="14" height="14" src="img/ico/accuracy.png?1" alt="Точность" title="Точность"> <span class="green2">'.$users['accuracy']. ($users['tankLevel'] > 3 ? '<span class="red1"> -' . $AddStatsForTank . '</span>' : ($users['tankLevel'] != 3 ? '<span class="green1"> +500</span>' : ''))  . '<br>

<img width="14" height="14" src="img/ico/durability.png?1" alt="Прочность" title="Прочность"> <span class="green2">'.$users['health']. ($users['tankLevel'] > 3 ? '<span class="red1"> -' . $AddStatsForTank . '</span>' : ($users['tankLevel'] != 3 ? '<span class="green1"> +500</span>' : ''))  . '<br>
</td>
</tr>
</tbody></table>

<div class="mb2 pb0">
<img src="img/ico/power.png?2" height="14" width="14"> <span class="green2">Танковая мощь: '.$MySumStats. ($users['tankLevel'] == 3 && $users['Country'] != 'germany' ? '<span class="red1"></span>' : ($users['tankLevel'] != 3? '<span class="green1"> +2000</span></span>' : '')) . '</span>
</div>
</div>';

if($users['img'] == 'img/countr/tanks/pt-buy-usa.png')
echo '<div class="bot"><span class="simple-but gray border"><span><span>Танк в наличии</span></span></span></div>';
else{
echo '<div class="bot">

<a class="simple-but border mb5" href="?pt-buy">
<span><span>
Купить за

<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 2000
</span></span></a>
</div>';
}

echo '</div>
</div></div></div></div></div></div></div></div>
</div>';

require_once 'system/footer.php';
?>