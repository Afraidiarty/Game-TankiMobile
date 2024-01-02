<?
require_once 'system/header.php';

$query_user_builds = "SELECT * FROM `buildings_user` WHERE id_user = '$myID' AND id_buildings = 3";
$result_user_buidls = mysqli_query($connect,$query_user_builds);
$fuel = mysqli_fetch_assoc($result_user_buidls);

switch($fuel['buildings_level']){
    case 1:$maximimFuel = 300;$nextLevelFuel = 330;break;
    case 2:$maximimFuel = 330;$nextLevelFuel = 340;break;
    case 3:$maximimFuel = 345;$nextLevelFuel = 400;break;
    case 4:$maximimFuel = 405;$nextLevelFuel = 4200;break;
    case 5:$maximimFuel = 420;$nextLevelFuel = 435;break;
    case 6:$maximimFuel = 435;$nextLevelFuel = 465;break;
    case 7:$maximimFuel = 465;$nextLevelFuel = 510;break;
    case 8:$maximimFuel = 510;$nextLevelFuel = 555;break;
    case 9:$maximimFuel = 555;$nextLevelFuel = 615;break;
    case 10:$maximimFuel = 615;$nextLevelFuel = 630;break;
    case 11:$maximimFuel = 630;$nextLevelFuel = 645;break;
    case 12:$maximimFuel = 645;$nextLevelFuel = 660;break;
    case 13:$maximimFuel = 660;$nextLevelFuel = 675;break;
    case 14:$maximimFuel = 675;$nextLevelFuel = 700;break;
    case 15:$maximimFuel = 700;$nextLevelFuel = 720;break;
    case 16:$maximimFuel = 720;$nextLevelFuel = 'Максимум';break;
}


echo '<div class="trnt-block mb6">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small bold sh_b mb5 cntr white">
Объём топливного бака: <span class="green2"><span class="nwr">
<img class="ico vm" src="img/ico/fuel.png?2" alt="Топливо" title="Топливо">'.$maximimFuel.'
 топлива</span></span>
<br>
Объём на следующем уровне здания: <span class="green2"><span class="nwr">
<img class="ico vm" src="img/ico/fuel.png?2" alt="Топливо" title="Топливо">'.$nextLevelFuel.'
 топлива</span></span><br>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';

require_once 'system/footer.php';
?>