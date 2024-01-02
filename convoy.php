<?
require_once 'system/header.php';


$time_convoy = $users['convoy_time'] - $current_time;

$timer_convoy = gmdate("i:s", $time_convoy);

if($users['convoy_count'] >= 2){
    $query = "UPDATE `users` SET `convoy_count` = 0 , `convoy_time` = ?, `convoy_status` = 'stop'  WHERE id = '$myID'";
    $stmt = $connect->prepare($query);
    $convoy_time = time() + 40 * 60;
    $stmt->bind_param("i",$convoy_time);
    $stmt->execute();
}

if((isset($_GET['findEnemy']) and $users['convoy_status'] == 'stop' AND $time_convoy <= 0)){
    $_SESSION['log'] = null;

    $query = "DELETE FROM `convoy_battle` WHERE id_users = '$myID'";
    $result = mysqli_query($connect, $query);

    $stmt = "UPDATE `users` SET `convoy_status` = 'waiting' WHERE id = '$myID'";
    $stmt = $connect->prepare($stmt);
    $stmt->execute();
    header("Location: convoy");
}

if(isset($_GET['findNewEnemy']) AND $time_convoy <= 0 ){
    if($users['convoy_count'] == 1){
        $query = "DELETE FROM `convoy_battle` WHERE id_users = '$myID'";
        $result = mysqli_query($connect, $query);

        $_SESSION['log'] = null;
        $stmt = "UPDATE `users` SET `convoy_status` = 'waiting' WHERE id = '$myID'";
        $stmt = $connect->prepare($stmt);
        $stmt->execute();
    }
    header("Location: convoy");
}

if(isset($_GET['startFight']) and $users['convoy_status'] == 'waiting' AND $time_convoy <= 0){

    $_SESSION['convoy_updated'] = null;
    $_SESSION['log'] = null;
    $_SESSION['glory'] = null;

    $query = "SELECT * FROM `convoy` ORDER BY ABS(stats - {$users['attach']}) LIMIT 1";
    $result = mysqli_query($connect,$query);
    $convoy = mysqli_fetch_assoc($result);

    $stmt = "UPDATE `users` SET `convoy_status` = 'active' WHERE id = '$myID'";
    $stmt = $connect->prepare($stmt);
    $stmt->execute();

    $query = "INSERT INTO `convoy_battle` (`id_users`, `id_convoy`, `str`, `hp`, `max_hp`, `myHP` , `max_myHP`) VALUES (?,?,?,?,?,?,?)";
    $stmt = $connect->prepare($query);
    
    $halfStats = $convoy['stats'] / 2;
    
    $stmt->bind_param("iiiiiii", $myID, $convoy['id'], $halfStats, $convoy['stats'], $convoy['stats'],$users['health'],$users['health']);
    
    $stmt->execute();
    

    header("Location: convoy");
}


if($users['convoy_status'] == 'stop' OR ($users['convoy_status'] == 'active' AND $users['convoy_count'] == 2)){
    

echo '<div class="trnt-block" w:id="root">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">

<div class="small white cntr sh_b bold mb2">
Слава — 
<img class="ico vm" src="img/convoy/glory.png?2" alt="Слава" title="Слава"> '.$users['glory'].'
</div>
<div class="small white cntr sh_b bold mb5" w:id="nop">
На горизонте замечен конвой врага!
</div>
<div class="cntr">
<a w:id="actLink" href="convoy?findEnemy"><img w:id="pic" src="img/convoy/logo.png"></a>
</div>


<div class="bot"><a class="simple-but border" w:id="findEnemy" href="convoy?findEnemy"><span><span>Начать разведку</span></span></a></div>

</div>
</div></div></div></div></div></div></div></div>
</div>';
if($time_convoy > 0)echo '<div class="small white cntr sh_b bold p5">Полная маскировка через '.$timer_convoy.'</div>';

echo '<div class="bot"><a class="simple-but border gray" w:id="refresh" href="convoy"><span><span>Обновить</span></span></a></div>';
} elseif ($users['convoy_status'] == 'waiting'){

$query = "SELECT * FROM `convoy` ORDER BY ABS(stats - {$users['attach']}) LIMIT 1";
$result = mysqli_query($connect,$query);
$convoy = mysqli_fetch_assoc($result);

switch($convoy['id']){
    case 1: $nameConvoy = 'Пехота';break;
    case 2: $nameConvoy = 'Минометный';break;
    case 3: $nameConvoy = 'Тягач ';break;
    case 4: $nameConvoy = 'РЛУ ';break;
    case 5: $nameConvoy = 'Мотоцикл ';break;
    case 6: $nameConvoy = 'Противотанковая установка';break;
    case 7: $nameConvoy = 'Военный джип';break;
    case 8: $nameConvoy = 'Мобильная зенитка';break;
    case 9: $nameConvoy = 'БТР ';break;
    case 10: $nameConvoy = 'Химический танк';break;
    case 11: $nameConvoy = 'Реактивные миномёты';break;
    case 12: $nameConvoy = 'САУ ';break;
    case 13: $nameConvoy = 'Танк';break;
    case 14: $nameConvoy = 'Бронепоезд ';break;
    }

echo '<div w:id="event">
<div class="small white cntr sh_b bold">
Вы обнаружили <span class="medium orange">'.$nameConvoy.'</span> врага<br>
</div>
<div class="dhr mt5 mb5"></div>
</div>';

echo '<div class="small white cntr sh_b bold mb2">
Слава — 
<img class="ico vm" src="img/convoy/glory.png" alt="Слава" title="Слава"> '.$users['glory'].'
</div>';

echo '<div class="cntr">
<a w:id="actLink" href="convoy?startFight"><img w:id="pic" src="img/convoy/'.$convoy['img'].'"></a>
</div>';

echo '<div class="bot"><a class="simple-but border red" w:id="startFight" href="convoy?startFight"><span><span>В БОЙ!</span></span></a></div>';

echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Чем сильнее враг, тем выше награда за его уничтожение</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';

} elseif($users['convoy_count'] != 2) {
    
    $query = "SELECT * FROM `convoy_battle` WHERE id_users = '$myID'";
    $result = mysqli_query($connect,$query);
    $convoy_battle = mysqli_fetch_assoc($result);


    $query = "SELECT * FROM `convoy` WHERE id  = '{$convoy_battle['id_convoy']}'";
    $result = mysqli_query($connect,$query);
    $convoy = mysqli_fetch_assoc($result);

    switch($convoy['id']){
        case 1: $nameConvoy = 'Пехота';break;
        case 2: $nameConvoy = 'Минометный';break;
        case 3: $nameConvoy = 'Тягач ';break;
        case 4: $nameConvoy = 'РЛУ ';break;
        case 5: $nameConvoy = 'Мотоцикл ';break;
        case 6: $nameConvoy = 'Противотанковая установка';break;
        case 7: $nameConvoy = 'Военный джип';break;
        case 8: $nameConvoy = 'Мобильная зенитка';break;
        case 9: $nameConvoy = 'БТР ';break;
        case 10: $nameConvoy = 'Химический танк';break;
        case 11: $nameConvoy = 'Реактивные миномёты';break;
        case 12: $nameConvoy = 'САУ ';break;
        case 13: $nameConvoy = 'Танк';break;
        case 14: $nameConvoy = 'Бронепоезд ';break;
        }

    $hpEnemies = ($convoy_battle['hp'] / $convoy_battle['max_hp']) * 100;
    
    $hp = ($convoy_battle['myHP'] / $convoy_battle['max_myHP']) * 100;
    
    # Атака боту
    if(isset($_GET['attackRegular']) and $convoy_battle['myHP'] > 0){


        $randomNumber = rand(1, 200);

        $ricochetChance = $users['skills_ricochet'];


        
        if($convoy['stats'] <= 500)
            $OverStrideWithArmor_Enemies = abs(round($Y*(1000-$convoy['stats'])/1000)); // Основной урон с учетом защиты противника
        elseif($convoy['stats'] > 500)
            $OverStrideWithArmor_Enemies = abs(round($Y*(2500-$convoy['stats'])/4000)); // Основной урон с учетом защиты противника
    
        if($randomNumber > $ricochetChance){
            if($users['armor'] <= 500)
                $OverStrideWithArmor_Me = abs(round($convoy_battle['str']*(1000-$users['armor'])/1000)); // Основной урон с учетом защиты противника
            elseif($users['armor'] > 500)
                $OverStrideWithArmor_Me = abs(round($convoy_battle['str']*(2500-$users['armor'])/4000));  // Основной урон с учетом защиты противника
            }else{
                $OverStrideWithArmor_Me = 0;
            }
    
         $_SESSION['str'] = $OverStrideWithArmor_Me;




        if (!isset($_SESSION['log'])) {
            $_SESSION['log'] = array();
        }

        $query = "UPDATE `convoy_battle` SET `hp` = `hp` - ? , `myHP` = `myHP` - ? WHERE id_users = '$myID'";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ii", $OverStrideWithArmor_Enemies , $OverStrideWithArmor_Me);
        $stmt->execute();
    
        if($randomNumber > $ricochetChance){
        $_SESSION['log'][] = '<span class="yellow1 td_u">'.$nameConvoy.'</span> <span class="red1">нанёс вам</span>
        <img src="img/shells/Regular.png"> <span class="red1">'.$OverStrideWithArmor_Me.'</span>
        урона
        
        </div><div>';
        }else{
            $_SESSION['log'][] = '<span class="blue1">РИКОШЕТ: </span>
            <span class="td_u green1">'.$nameConvoy.'</span> <img src="img/shells/Regular.png">
             выстрелил в  <span class="yellow1 td_u yellow1">'.$users['nick'].'</span>
             на  <span class="red1">0
             урона
            </span>';
        }

        
        $_SESSION['log'][] = '<span class="green1">Вы нанесли</span>
        <img src="img/shells/Regular.png"> <span class="red1">'.$OverStrideWithArmor_Enemies.'</span>
        урона <span class="yellow1 td_u">'.$nameConvoy.'</span>';

        
       header("Location: convoy");
    }
   
    if(isset($_GET['attackSpecial']) and $convoy_battle['myHP'] > 0){
        if($users['caliber'] > 0){
            if($convoy['stats'] <= 500)
            $OverStrideWithArmor_Enemies = round(abs(round($Y*(1000-$convoy['stats'])/1000) * 1.25));
        elseif($convoy['stats'] > 500)
            $OverStrideWithArmor_Enemies = round(abs(round($Y*(2500-$convoy['stats'])/4000) * 1.25)); 
            


        if($users['armor'] <= 500)
            $OverStrideWithArmor_Me = abs(round($convoy_battle['str']*(1000-$users['armor'])/1000)); 
        elseif($users['armor'] > 500)
            $OverStrideWithArmor_Me = abs(round($convoy_battle['str'] * (2500 - $users['armor']) / 4000));
            
        $_SESSION['str'] = $OverStrideWithArmor_Me;

        if (!isset($_SESSION['log'])) {
            $_SESSION['log'] = array();
        }

        $query = "UPDATE `users` SET `caliber` = `caliber` - 1 WHERE id = '$myID'";
        $stmt = $connect->prepare($query);
        $stmt->execute();

        $query = "UPDATE `convoy_battle` SET `hp` = `hp` - ? , `myHP` = `myHP` - ? WHERE id_users = '$myID'";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ii", $OverStrideWithArmor_Enemies , $OverStrideWithArmor_Me);
        $stmt->execute();
    

        $_SESSION['log'][] = '<span class="yellow1 td_u">'.$nameConvoy.'</span> <span class="red1">нанёс вам</span>
        <img src="img/shells/Regular.png"> <span class="red1">'.$OverStrideWithArmor_Me.'</span>
        урона
        
        </div><div>';
        

        $_SESSION['log'][] = '<span class="green1">Вы нанесли</span>
        <img src="img/shells/Regular.png"> <span class="red1">'.$OverStrideWithArmor_Enemies.'</span>
        урона <span class="yellow1 td_u">'.$nameConvoy.'</span>';
        }
        header("Location: convoy"); 
    }



    if ($convoy_battle['hp'] <= 0 || $convoy_battle['myHP'] <= 0) {
        if (!isset($_SESSION['convoy_updated'])) {
            $query = "UPDATE `users` SET `convoy_count` = `convoy_count` + 1 WHERE id = '$myID'";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $_SESSION['convoy_updated'] = true;
        }
    }
    
    if ($convoy_battle['hp'] <= 0) {
        if (!isset($_SESSION['glory'])) {
            $glory = rand(1, $convoy['id']);

            $_SESSION['glory'] = $glory;
        
            $query = "UPDATE `users` SET `convoy_kills` = `convoy_kills` + 1, `glory` = `glory` + '$glory' WHERE id = '$myID'";
            $stmt = $connect->prepare($query);
            $stmt->execute();        
        }
    }




    if($convoy_battle['hp'] < 0){
        $hpEnemies = 0;
        $convoy_battle['hp'] = 0;
    }

    if($convoy_battle['myHP'] < 0){
        $hp = 0;
        $convoy_battle['myHP'] = 0;
    }
    
    if($users['convoy_count'] >= 2){

        $query = "UPDATE `users` SET `convoy_count` = 0 , `convoy_time` = ?, `convoy_status` = 'stop'  WHERE id = '$myID'";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("i",$current_time);
        $stmt->execute();
    }

    echo '<div class="trnt-block mb2" w:id="root">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content">
    
    
    
    
    
    <div class="cntr">';
    
    if($convoy_battle['hp'] > 0){
        if($convoy_battle['myHP'] > 0){
            echo '<div class="small bold orange mb5">'.$nameConvoy.'</div>';
            
            echo '<a href="convoy?4-1.ILinkListener-root-fightView-smartAttack"><img src="img/convoy/'.$convoy['img'].'"></a>';
            
            echo '<div class="small white mt2">Выбери тип снаряда и атакуй</div>
    
        </div>';
        }else{
            echo '<div class="small white cntr sh_b bold">
            <div class="medium">
            <img src="img/ico/victory.png"> <span class="red1">Вы уничтлжены!</span> <img src="img/ico/victory.png">
            </div>
            Награда: 
            <img class="ico vm" src="img/convoy/glory.png?2" alt="Слава" title="Слава"> 0
             славы
            <br>
            <div class="small gray1 cntr sh_b bold">Врагов уничтожено '.$users['convoy_kills'].'</div>
            </div>';
            echo '<a href="convoy?4-1.ILinkListener-root-fightView-smartAttack"><img src="img/convoy/'.$convoy['img'].'"></a>'; 
        }
    }else{
        
        echo '<div class="small white cntr sh_b bold">
        <div class="medium">
        <img src="img/ico/victory.png"> <span class="green1">Боевая техника уничтожена!</span> <img src="img/ico/victory.png">
        </div>
        Награда: 
        <img class="ico vm" src="img/convoy/glory.png?2" alt="Слава" title="Слава"> '.$_SESSION['glory'].'
         славы
        <br>
        <div class="small gray1 cntr sh_b bold">Врагов уничтожено '.$users['convoy_kills'].'</div>
        </div>';
        echo '<a href="convoy?4-1.ILinkListener-root-fightView-smartAttack"><img src="img/d-convoy/'.$convoy['img'].'"></a>'; 
    }

    echo '<table class="rblock esmall mb0">
    <tbody><tr>
    <td><div class="value-block lh1"><span><span>'.$convoy_battle['hp'].'</span></span></div></td>
    <td class="progr"><div class="scale-block"><div class="scale" style="width:'.$hpEnemies.'%;">&nbsp;</div></div></td>
    <td><div class="value-block lh1"><span><span>'.$convoy_battle['max_hp'].'</span></span></div></td>
    </tr>
    </tbody></table>
    
    
    <table>
    <tbody><tr>';
    if($convoy_battle['hp'] > 0){
    echo '<td class="w50 pr5">
    <a href="convoy?attackRegular" class="simple-but gray"><span><span>Обычные</span></span></a>
    </td>
    
    
    <td class="w50 pl5">
    <a href="convoy?attackSpecial" class="simple-but"><span><span>Кумулятивные(КС) (',$users['caliber'].')</span></span></a>
    </td>';
    }
    echo '</tr>
    </tbody></table>';

    if(isset($_SESSION['log']))
    echo '<div class="small white cntr">Моя прочность <span class="red1">(-'.$_SESSION['str'].')</span></div>';
    
    echo '<table class="rblock esmall mb0">
    <tbody><tr>
    <td><div class="value-block lh1"><span><span>'.$convoy_battle['myHP'].'</span></span></div></td>
    <td class="progr"><div class="scale-block"><div class="scale" style="width:'.$hp.'%;">&nbsp;</div></div></td>
    <td><div class="value-block lh1"><span><span>'.$convoy_battle['max_myHP'].'</span></span></div></td>
    </tr>
    </tbody></table>
    
    
    
    <div class="small p5" style = "text-align:left;">
    <div>';

    

    if(isset($_SESSION['log']))
    $reversedLog = array_reverse($_SESSION['log']);

    

    foreach ($reversedLog as $log) {
        echo '<div class="log" style="text-align:left;">' . $log . '</div>';
    }
    

    echo '
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';

    if ($convoy_battle['hp'] <= 0 || $convoy_battle['myHP'] <= 0){
    echo '<div class="bot"><a class="simple-but border" w:id="findNewEnemy" href="convoy?findNewEnemy"><span><span>Новый противник</span></span></a></div>';
    }
    echo '<div class="trnt-block mb2">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content-mini">
    <div class="mt5 mb5 small green1 cntr">Специальные (зеленые) снаряды наносят на 25% больше урона чем обычные</div>
    </div>
    </div></div></div></div></div></div></div></div>
    </div>';
    echo '<div class="bot">
    <a class="simple-but border gray mb2" href="angar"><span><span>Вернуться в ангар</span></span></a>
    </div>';

}




require_once 'system/footer.php';
?>
