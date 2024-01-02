<?
require_once 'system/header.php';

$query = "SELECT * FROM `mine` WHERE id_user = '$myID'";
$res = mysqli_query($connect,$query);

if(mysqli_num_rows($res) > 0){
    header("Location: buildings");
}


echo '<a class="simple-but border mb5" w:id="upgradeLink" href="up-mine"><span><span>Улучшить шахту</span></span></a>';





echo '<div class="trnt-block mb5">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="white small bold sh_b mb5 cntr">
Мои ресурсы
<span class="gray1 cntr blck pt5">

<span class="nwr"><img class="rico vm" src="img/buildings/material/ore.png?2" alt="Руда" title="Руда"> '.$users['ore'].' &nbsp;&nbsp;</span>

<span class="nwr"><img class="rico vm" src="img/buildings/material/iron.png?2" alt="Железо" title="Железо"> '.$users['iron'].' &nbsp;&nbsp;</span>

<span class="nwr"><img class="rico vm" src="img/buildings/material/steel.png?2" alt="Сталь" title="Сталь"> '.$users['steel'].' &nbsp;&nbsp;</span>

<span class="nwr"><img class="rico vm" src="img/buildings/material/plumbum.png?2" alt="Свинец" title="Свинец"> '.$users['plumbum'].' &nbsp;&nbsp;</span>

</span>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';


$query = "SELECT * FROM `buildings_user` WHERE id_user = '$myID' AND id_buildings = 1";
$result = mysqli_query($connect,$query);
$Mine = mysqli_fetch_assoc($result);

$currentLevel = $Mine['buildings_level'];





$MineMaterial = array(
    1 => array('ore' => 1 , 'iron' => 0 , 'steel' => 0 , 'plumbum' => 0 ),
    2 => array('ore' => 1, 'iron' => 0 , 'steel' => 0 , 'plumbum' => 0),
    3 => array('ore' => 2, 'iron' => 0 , 'steel' => 0 , 'plumbum' => 0),
    4 => array('ore' => 2, 'iron' => 1 , 'steel' => 0 , 'plumbum' => 0),
    5 => array('ore' => 3 , 'iron' => 1 , 'steel' => 0 , 'plumbum' => 0),
    6 => array('ore' => 3 , 'iron' => 2 , 'steel' => 0 , 'plumbum' => 0),
    7 => array('ore' => 4 , 'iron' => 2 , 'steel' => 1 , 'plumbum' => 0),
    8 => array('ore' => 5 , 'iron' => 3 , 'steel' => 1 , 'plumbum' => 0),
    9 => array('ore' => 5 , 'iron' => 3 , 'steel' => 2 , 'plumbum' => 0),
    10 => array('ore' => 6  , 'iron' => 3 , 'steel' => 2 , 'plumbum' => 0),
    11 => array('ore' => 6  , 'iron' => 5 , 'steel' => 2 , 'plumbum' => 1),
    12 => array('ore' => 6 , 'iron' =>  5 , 'steel' => 3 , 'plumbum' => 1),
    13 => array('ore' => 7  , 'iron' => 6 , 'steel' => 4 , 'plumbum' => 1),
    14 => array('ore' => 7 , 'iron' => 6 , 'steel' => 4 , 'plumbum' => 2),
    15 => array('ore' => 10 , 'iron' => 7 , 'steel' => 5 , 'plumbum' => 3),
    16 => array('ore' => 10 , 'iron' => 7 , 'steel' => 5 , 'plumbum' => 4),
);



if(isset($_GET['ore']) &&  mysqli_num_rows($res) == 0 && $currentLevel >= 1){
    $query = "INSERT INTO `mine` SET `id_user` = ? , `time` = ?, `material` = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("iis", $myID, $t, $material);
    $material = 1;
    $t = time() + 1 * 3600;
    $stmt->execute();

    header("Location: buildings");
}


if(isset($_GET['iron']) &&  mysqli_num_rows($res) == 0 && $currentLevel >= 5 ){
    $query = "INSERT INTO `mine` SET `id_user` = ? , `time` = ?, `material` = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("iis", $myID, $t, $material);
    $material = 2;
    $t = time() + 2 * 3600;
    $stmt->execute();

    header("Location: buildings");
}

if(isset($_GET['steel']) &&  mysqli_num_rows($res) == 0 && $currentLevel >= 7){
    $query = "INSERT INTO `mine` SET `id_user` = ? , `time` = ?, `material` = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("iis", $myID, $t, $material);
    $material = 3;
    $t = time() + 4 * 3600;
    $stmt->execute();

    header("Location: buildings");
}

if(isset($_GET['plumbum']) &&  mysqli_num_rows($res) == 0 && $currentLevel >= 11){
    $query = "INSERT INTO `mine` SET `id_user` = ? , `time` = ?, `material` = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("iis", $myID, $t, $material);
    $material = 4;
    $t = time() + 8 * 3600;
    $stmt->execute();

    header("Location: buildings");
}

if($currentLevel >= 1){
    $materialInfo = $MineMaterial[$currentLevel];
echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl" style = "display:flex;" >
<div class="thumb fl"><img src="images/ore.jpg" alt="Руда" title="Руда"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style = "text-align: left;margin-left: 7px;">
<span class="green2">Руда</span><br>
Кол-во: <span class="green2">'.$materialInfo['ore'].'</span><br>
Время <span class="green2">
01:00:00
</span>
</div>
<div class="clrb"></div>
</div>
<div class="bot">
<a class="simple-but border" href="Mine?ore"><span><span>Начать производство</span></span></a>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';
}

if($currentLevel >= 5){
    $materialInfo = $MineMaterial[$currentLevel];
echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl" style = "display:flex;" >
<div class="thumb fl"><img src="images/iron.jpg" alt="Железо" title="Железо"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style = "text-align: left;margin-left: 7px;">
<span class="green2">Железо</span><br>
Кол-во: <span class="green2">'.$materialInfo['iron'].'</span><br>
Время <span class="green2">
02:00:00
</span>
</div>
<div class="clrb"></div>
</div>

<div class="bot">
<a class="simple-but border" href="Mine?iron"><span><span>Начать производство</span></span></a>
</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';
}


if($currentLevel >= 7){
    $materialInfo = $MineMaterial[$currentLevel];
echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl" style = "display:flex;" >
<div class="thumb fl"><img src="images/steel.jpg" alt="Сталь" title="Сталь"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style = "text-align: left;margin-left: 7px;">
<span class="green2">Сталь</span><br>
Кол-во: <span class="green2">'.$materialInfo['steel'].'</span><br>
Время <span class="green2">
04:00:00
</span>
</div>
<div class="clrb"></div>
</div>

<div class="bot">
<a class="simple-but border" href="Mine?steel"><span><span>Начать производство</span></span></a>
</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';
}

if($currentLevel >= 11){
    $materialInfo = $MineMaterial[$currentLevel];
    echo '<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="mb5 inbl" style = "display:flex;" >
<div class="thumb fl"><img src="images/plumbum.jpg" alt="Сталь" title="Сталь"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style = "text-align: left;margin-left: 7px;">
<span class="green2">Сталь</span><br>
Кол-во: <span class="green2">'.$materialInfo['plumbum'].'</span><br>
Время <span class="green2">
08:00:00
</span>
</div>
<div class="clrb"></div>
</div>

<div class="bot">
<a class="simple-but border" href="Mine?plumbum"><span><span>Начать производство</span></span></a>
</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';
}
require_once 'system/footer.php';
?>