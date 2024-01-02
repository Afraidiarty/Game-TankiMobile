<?
require_once 'system/header.php';

echo '<div class="medium white bold cntr mb5">Умения </div>';


$skills_prices = array(
    0 => 100,
    1 => 150,
    2 => 250,
    3 => 500,
    4 => 1000,
    5 => 30,
    6 => 50,
    7 => 60,
    8 => 70,
    9 => 60,
    10 => 80,
    11 => 100,
    12 => 120,
    13 => 140,
    14 => 300,
    15 => 400,
    16 => 500,
    17 => 600,
    18 => 700,
    19 => 1500,
    20 => 2000,
    21 => 3000,
    22 => 3500,
    23 => 3000,
    24 => 4000,
    25 => 6000,
    26 => 7000,
    27 => 3000,
    28 => 4000,
    29 => 5000,
    30 => 5500,
    31 => 6000,
    32 => 6500,
    33 => 7000,
    34 => 7500,
    35 => 2500,
    36 => 3000,
    37 => 3500,
    38 => 4000,
    39 => 5000,
    40 => 5500,
    41 => 5750,
    42 => 6000,
    43 => 6200,
    44 => 6400,
    45 => 6600,
    46 => 6680,
    47 => 7000,
    48 => 7500,
    49 => 8000,
);



if($users['skills_spots'] <= 5 ){
    $skills_spots_img = '0';
}elseif($users['skills_spots'] <= 10 ){
    $skills_spots_img = '1';
}elseif($users['skills_spots'] <= 15 ){
    $skills_spots_img = '2';
}elseif($users['skills_spots'] <= 20 ){
    $skills_spots_img = '3';
}elseif($users['skills_spots'] <= 25 ){
    $skills_spots_img = '4';
}elseif($users['skills_spots'] <= 30 ){
    $skills_spots_img = '5';
}elseif($users['skills_spots'] <= 35 ){
    $skills_spots_img = '6';
}elseif($users['skills_spots'] <= 40 ){
    $skills_spots_img = '7';
}elseif($users['skills_spots'] <= 45 ){
    $skills_spots_img = '8';
}elseif($users['skills_spots'] < 50){
    $skills_spots_img = '9';
}
elseif($users['skills_spots'] == 50 ){
    $skills_spots_img = '10';
}

$skills_spots = $users['skills_spots'];
if(array_key_exists($skills_spots,$skills_prices)){
    $price = $skills_prices[$skills_spots];
}

if(isset($_GET['upgrade_spots']) and $users['skills_spots'] != 50 ){
    if($users['skills_spots'] <= 5 ){
        if($users['silver'] >= $price){
            $query = "UPDATE `users` SET `silver` = `silver` - '$price', `skills_spots` = `skills_spots` + 1 WHERE id = '$myID'";
            $stmt = $connect->prepare($query);
            $stmt->execute();
        }else{
            $NeXvataet = abs($users['silver'] - $price); 
            $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
            <img class="ico vm" src="img/ico/silver.png?2" alt="silver" title="silver"> '. $NeXvataet .'
             золота
            
            </div></div>';
            header("Location: skills");
            exit;
        }
    }elseif($users['skills_spots'] < 50){
        if($users['gold'] >= $price){
            $query = "UPDATE `users` SET `gold` = `gold` - '$price', `skills_spots` = `skills_spots` + 1 WHERE id = '$myID'";
            $stmt = $connect->prepare($query);
            $stmt->execute();  
        }else{
            $NeXvataet = abs($users['gold'] - $price); 
            $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
            <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
             золота
            
            </div></div>';
            header("Location: skills");
            exit;
        }
    }

    header("Location: skills");
}


echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl">
<div class="thumb fl"><img src="images/skills/weaknessdetection/'.$skills_spots_img.'.png?10"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style = "text-align: left;" >
<span class="green2">Слабые места</span><br>
Текущий бонус: <span class="yellow1">'.$users['skills_spots'].'%</span><br>

Цена: <span class="yellow1"><span class="nwr">';

if($users['skills_spots'] <= 5){
    echo '<img class="ico vm" src="img/ico/silver.png?2" alt="silver" title="silver"> '.$price.'
    серебра</span></span>';
}elseif($users['skills_spots'] < 50){
echo '<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '.$price.'
 золота</span></span>';
}else{
    
}

echo '</div>
<div class="clrb"></div>
<div class="small gray1 sh_b mt5">Знание слабых мест танка противника даёт возможность наносить больший урон.</div>
</div>

<div class="bot">

<a class="simple-but border mb5" href="?upgrade_spots">
<span><span>
Улучшить +1%

</span></span></a>

</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';





if($users['skills_ricochet'] <= 5 ){
    $skills_ricochet_img = '0';
}elseif($users['skills_ricochet'] <= 10 ){
    
    $skills_ricochet_img = '1';
}elseif($users['skills_ricochet'] <= 15 ){
    $skills_ricochet_img = '2';
}elseif($users['skills_ricochet'] <= 20 ){
    $skills_ricochet_img = '3';
}elseif($users['skills_ricochet'] <= 25 ){
    $skills_ricochet_img = '4';
}elseif($users['skills_ricochet'] <= 30 ){
    $skills_ricochet_img = '5';
}elseif($users['skills_ricochet'] <= 35 ){
    $skills_ricochet_img = '6';
}elseif($users['skills_ricochet'] <= 40 ){
    $skills_ricochet_img = '7';
}elseif($users['skills_ricochet'] <= 45 ){
    $skills_ricochet_img = '8';
}elseif($users['skills_ricochet'] < 50){
    $skills_ricochet_img = '9';
}
elseif($users['skills_ricochet'] == 50 ){
    $skills_ricochet_img = '10';
}

$skills_ricochet = $users['skills_ricochet'];
if(array_key_exists($skills_ricochet,$skills_prices)){
    $price = $skills_prices[$skills_ricochet];
}

if(isset($_GET['upgrade_spots_ric']) and $users['skills_ricochet'] != 50){
    if($users['skills_ricochet'] <= 5 ){
        if($users['silver'] >= $price){
            $query = "UPDATE `users` SET `silver` = `silver` - '$price', `skills_ricochet` = `skills_ricochet` + 1 WHERE id = '$myID'";
            $stmt = $connect->prepare($query);
            $stmt->execute();
        }else{
            $NeXvataet = abs($users['silver'] - $price); 
            $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
            <img class="ico vm" src="img/ico/silver.png?2" alt="silver" title="silver"> '. $NeXvataet .'
             золота
            
            </div></div>';
            header("Location: skills");
            exit;
        }
    }elseif($users['skills_ricochet'] < 50){
        if($users['gold'] >= $price){
            $query = "UPDATE `users` SET `gold` = `gold` - '$price', `skills_ricochet` = `skills_ricochet` + 1 WHERE id = '$myID'";
            $stmt = $connect->prepare($query);
            $stmt->execute();  
        }else{
            $NeXvataet = abs($users['gold'] - $price); 
            $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
            <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
             золота
            
            </div></div>';
            header("Location: skills");
            exit;
        }
    }

    header("Location: skills");
}



echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl">
<div class="thumb fl"><img src="images/skills/ricochet/'.$skills_ricochet_img.'.png?10"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style = "text-align: left;" >
<span class="green2">Рикошет</span><br>
Текущий бонус: <span class="yellow1">'.($users['skills_ricochet'] * 0.5).'%</span><br>

Цена: <span class="yellow1"><span class="nwr">';

if($users['skills_ricochet'] <= 5 ){
    echo '<img class="ico vm" src="img/ico/silver.png?2" alt="silver" title="silver"> '.$price.'
    серебра</span></span>';
}elseif($users['skills_ricochet'] < 50){
echo '<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '.$price.'
 золота</span></span>';
}else{
    
}

echo '</div>
<div class="clrb"></div>
<div class="small gray1 sh_b mt5">Умение правильно подставить броню, тем самым увеличивая шанс рикошета снарядов от брони вашего танка.</div>
</div>';

if($users['skills_ricochet'] != 50){
echo '<div class="bot">

<a class="simple-but border mb5" href="?upgrade_spots_ric">
<span><span>
Улучшить +0.5%

</span></span></a>

</div>';
}
echo '</div>
</div></div></div></div></div></div></div></div>
</div>';

if($users['skills_instruktor'] <= 5 ){
    $skills_instruktor_img = '0';
}elseif($users['skills_instruktor'] <= 10 ){
    
    $skills_instruktor_img = '1';
}elseif($users['skills_instruktor'] <= 15 ){
    $skills_instruktor_img = '2';
}elseif($users['skills_instruktor'] <= 20 ){
    $skills_instruktor_img = '3';
}elseif($users['skills_instruktor'] <= 25 ){
    $skills_instruktor_img = '4';
}elseif($users['skills_instruktor'] <= 30 ){
    $skills_instruktor_img = '5';
}elseif($users['skills_instruktor'] <= 35 ){
    $skills_instruktor_img = '6';
}elseif($users['skills_instruktor'] <= 40 ){
    $skills_instruktor_img = '7';
}elseif($users['skills_instruktor'] <= 45 ){
    $skills_instruktor_img = '8';
}elseif($users['skills_instruktor'] < 50){
    $skills_instruktor_img = '9';
}
elseif($users['skills_instruktor'] == 50 ){
    $skills_instruktor_img = '10';
}

$skills_instruktor = $users['skills_instruktor'];
if(array_key_exists($skills_instruktor,$skills_prices)){
    $price = $skills_prices[$skills_instruktor];
}

if(isset($_GET['upgrade_spots_ins']) and $users['skills_instruktor'] != 50){
    if($users['skills_instruktor'] <= 5 ){
        if($users['silver'] >= $price){
            $query = "UPDATE `users` SET `silver` = `silver` - '$price', `skills_instruktor` = `skills_instruktor` + 1 WHERE id = '$myID'";
            $stmt = $connect->prepare($query);
            $stmt->execute();
        }else{
            $NeXvataet = abs($users['silver'] - $price); 
            $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
            <img class="ico vm" src="img/ico/silver.png?2" alt="silver" title="silver"> '. $NeXvataet .'
             золота
            
            </div></div>';
            header("Location: skills");
            exit;
        }
    }elseif($users['skills_instruktor'] < 50){
        if($users['gold'] >= $price){
            $query = "UPDATE `users` SET `gold` = `gold` - '$price', `skills_instruktor` = `skills_instruktor` + 1 WHERE id = '$myID'";
            $stmt = $connect->prepare($query);
            $stmt->execute();  
        }else{
            $NeXvataet = abs($users['gold'] - $price); 
            $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
            <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
             золота
            
            </div></div>';
            header("Location: skills");
            exit;
        }
    }

    header("Location: skills");
}



echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl">
<div class="thumb fl"><img src="images/skills/instructor/'.$skills_instruktor_img.'.png?10"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style = "text-align: left;" >
<span class="green2">Инструктор</span><br>
Текущий бонус: <span class="yellow1">'.($users['skills_instruktor'] * 0.9).'%</span><br>

Цена: <span class="yellow1"><span class="nwr">';

if($users['skills_instruktor'] <= 5 ){
    echo '<img class="ico vm" src="img/ico/silver.png?2" alt="silver" title="silver"> '.$price.'
    серебра</span></span>';
}elseif($users['skills_instruktor'] < 50){
echo '<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '.$price.'
 золота</span></span>';
}else{
    
}

echo '</div>
<div class="clrb"></div>
<div class="small gray1 sh_b mt5">Данное умение повышает личный заработанный опыт,тем самым помогая увеличивать быстрее свой уровень</div>
</div>';

if($users['skills_instruktor'] != 50){
echo '<div class="bot">

<a class="simple-but border mb5" href="?upgrade_spots_ins">
<span><span>
Улучшить +0.9%

</span></span></a>

</div>';
}
echo '</div>
</div></div></div></div></div></div></div></div>
</div>';


if($users['skills_officer'] <= 5 ){
    $skills_officer_img = '0';
}elseif($users['skills_officer'] <= 10 ){
    
    $skills_officer_img = '1';
}elseif($users['skills_officer'] <= 15 ){
    $skills_officer_img = '2';
}elseif($users['skills_officer'] <= 20 ){
    $skills_officer_img = '3';
}elseif($users['skills_officer'] <= 25 ){
    $skills_officer_img = '4';
}elseif($users['skills_officer'] <= 30 ){
    $skills_officer_img = '5';
}elseif($users['skills_officer'] <= 35 ){
    $skills_officer_img = '6';
}elseif($users['skills_officer'] <= 40 ){
    $skills_officer_img = '7';
}elseif($users['skills_officer'] <= 45 ){
    $skills_officer_img = '8';
}elseif($users['skills_officer'] < 50){
    $skills_officer_img = '9';
}
elseif($users['skills_officer'] == 50 ){
    $skills_officer_img = '10';
}

$skills_officer = $users['skills_officer'];
if(array_key_exists($skills_officer,$skills_prices)){
    $price = $skills_prices[$skills_officer];
}

if(isset($_GET['upgrade_spots_ofc']) and $users['skills_officer'] != 50){
    if($users['skills_officer'] <= 5 ){
        if($users['silver'] >= $price){
            $query = "UPDATE `users` SET `silver` = `silver` - '$price', `skills_officer` = `skills_officer` + 1 WHERE id = '$myID'";
            $stmt = $connect->prepare($query);
            $stmt->execute();
        }else{
            $NeXvataet = abs($users['silver'] - $price); 
            $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
            <img class="ico vm" src="img/ico/silver.png?2" alt="silver" title="silver"> '. $NeXvataet .'
             золота
            
            </div></div>';
            header("Location: skills");
            exit;
        }
    }elseif($users['skills_officer'] < 50){
        if($users['gold'] >= $price){
            $query = "UPDATE `users` SET `gold` = `gold` - '$price', `skills_officer` = `skills_officer` + 1 WHERE id = '$myID'";
            $stmt = $connect->prepare($query);
            $stmt->execute();  
        }else{
            $NeXvataet = abs($users['gold'] - $price); 
            $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
            <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '. $NeXvataet .'
             золота
            
            </div></div>';
            header("Location: skills");
            exit;
        }
    }

    header("Location: skills");
}



echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl">
<div class="thumb fl"><img src="images/skills/officer/'.$skills_officer_img.'.png?10"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style = "text-align: left;" >
<span class="green2">Курсы инструктора</span><br>
Текущий бонус: <span class="yellow1">'.($users['skills_officer'] * 0.5).'%</span><br>

Цена: <span class="yellow1"><span class="nwr">';

if($users['skills_officer'] <= 5 ){
    echo '<img class="ico vm" src="img/ico/silver.png?2" alt="silver" title="silver"> '.$price.'
    серебра</span></span>';
}elseif($users['skills_officer'] < 50){
echo '<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '.$price.'
 золота</span></span>';
}else{
    
}

echo '</div>
<div class="clrb"></div>
<div class="small gray1 sh_b mt5">Повышает вами заработанный опыт и увеличивает его в вашу дивизию.</div>
</div>';

if($users['skills_officer'] != 50){
echo '<div class="bot">

<a class="simple-but border mb5" href="?upgrade_spots_ofc">
<span><span>
Улучшить +0.5%

</span></span></a>

</div>';
}
echo '</div>
</div></div></div></div></div></div></div></div>
</div>';

require_once 'system/footer.php';
?>