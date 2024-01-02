<?
require_once 'system/header.php';

echo '<div class="buy-place-block pt2 mb10">

<div class="medium bold white cntr sh_b mt5 mb5">Купить топливо?</div>

<div class="line1">
Цена:<br>
<span class="nwr">
<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 60
 золота</span>
</div>


<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?buyFuell"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="angar"><span><span>нет, отмена</span></span></a>
</div>';

if(isset($_GET['buyFuell'])){
    if($users['gold'] >= 60 ){
        $query = "UPDATE `users` SET `fuel` = ? , `gold` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        $fuel = $users['maximumFuel'];
        $g = $users['gold'] - 60;
        if ($stmt) { // успешно
            $stmt->bind_param("iii", $fuel, $g, $myID);
            $stmt->execute();
            $stmt->close();
            header("Location: battle");
        }
    }else{
        $NeXvataet = abs($users['gold'] -60);
        $_SESSION['msg'] = '<div class="small cntr mb10"><div class="red1"> У вас не хватает 
        <img class="ico vm" src="img/ico/gold.png?2" alt="Золота" title="Золота"> '. $NeXvataet .'
         золота</div></div>'; 
    }
}

require_once 'system/footer.php';
?>