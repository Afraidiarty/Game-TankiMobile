<?
require_once 'system/header.php';



if(isset($_GET['up'])){
    if($users['clan_rang'] >= 5){
        if($clan['gold_b'] <= $upgradeCost){
            $query = "UPDATE `buildings_company` SET `hq_level` = `hq_level` + 1 WHERE id_clan = {$users['id_clan']}";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $stmt->close();

            $query = "UPDATE `clan` SET `gold_b` = `gold_b` - '{$upgradeCost}', `bonus_stats` = `bonus_stats` + 1 WHERE id = {$users['id_clan']}";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $stmt->close();

            $query = "UPDATE `users` SET `attach` = `attach` + 1, `armor` = `armor` + 1,
            `accuracy` = `accuracy` + 1,`health` = `health` + 1 
            WHERE id_clan = {$users['id_clan']}";

            $stmt = $connect->prepare($query);
            $stmt->execute();
            $stmt->close();      
        }else{
            $NeXvataet = abs($upgradeCost - $clan['gold_b']);
            $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У дивизии  не хватает:
            <img class="ico vm" src="img/ico/gold.png?2" alt="Золота" title="Золота"> '. $NeXvataet .'
             золота</div></div>';
        }
    }
    header("Location: hq");
}

if(isset($_GET['cazna'])){
    $query = "UPDATE `clan` SET `gold_b` = `gold_b` + 10 * 0.5, `gold_up` = `gold_up` + 10 * 0.5 WHERE id = {$users['id_clan']}";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $stmt->close();

    $query = "UPDATE `users` SET `gold` = `gold` - 10 WHERE id = {$myID}";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $stmt->close();
    header("Location: hq");
}

echo '<div class="medium white bold cntr mb2">Штаб дивизии</div>';

echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="thumb fl"><img width="50" height="50" src="img/clan/hq.png"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold" style = "text-align: left;" >
<span class="green2">Военное управление</span><br>
Бонус дивизии: <span class="green1">+'.$clan['bonus_stats'].'</span> к параметрам
<div class="">Прогресс: '.$hqLevel.' из 160</div>
</div>
<div class="clrb"></div>
</div>
</div></div></div></div></div></div></div></div>
</div>';


echo '<div class="trnt-block" w:id="hq">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="white cntr bold sh_b small">
<div class="medium yellow1 pb5">Золотой запас дивизии:</div>
<table>
<tbody><tr>
<td style="width: 50%;color: white;border-right: 1px solid #D2D2D2;text-align: center;font-weight: bold;font-size: 13px;">
На улучшения<br>
<img src="img/ico/gold.png?2"> '.$clan['gold_b'].'
</td>
<td style="width: 50%;color: white;text-align: center;font-weight: bold;font-size: 13px;">
На усиления<br>
<img src="img/ico/gold.png?2"> '.$clan['gold_up'].'
</td>
</tr>
</tbody></table>
</div>
<div class="bot">';


echo '<a class="simple-but border" w:id="link" href="?cazna"><span><span>Пополнить на
<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 10
</span></span></a>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';
if($users['clan_rang'] >= 5 ){
    echo '<a class="simple-but border" w:id="link" href="?up"><span><span>Улучшить за    
    <img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> '.$upgradeCost.'
    </span></span></a>';
    }
echo '<a class="simple-but gray mb5" w:id="donateStatsLink" href="../hqstats/1878"><span><span>Статистика</span></span></a>';

echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Пополняя свой счет, вы помогаете дивизии становиться сильнее</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';

require_once 'system/footer.php';
?>