<?
require_once 'system/header.php';

switch($users['pvp_rang']){
    case 1: $end_raiting = 1749;break;
    case 2: $end_raiting = 1999;break;
    case 3: $end_raiting = 2249;break;
    case 4: $end_raiting = 2499;break;
    case 5: $end_raiting = 2749;break;
    case 6: $end_raiting = 2999;break;
    case 7: $end_raiting = 3249;break;
}
echo '<div class="medium bold mb0 cntr green1"><img src="img/ico/victory.png"> Битва мастеров <img src="img/ico/victory.png"></div>';
echo '<div class="mt0 mb5 small gray1 cntr">Танкисты с рейтингом до 2500</div>';
echo '<img width="100%" w:id="logo" src="images/war2.jpg">';
echo '<div class="white small bold sh_b mt5 mb5 cntr">
Мой рейтинг: '.$users['pvp_raiting'].' из '.$end_raiting.'
<br>
<img class="vb" w:id="pDivImg" src="images/pvp/'.$users['pvp_rang'].'.png"> Лига лейтенантов
</div>';
echo '<a w:id="joinLink" href="pvp?5-1.ILinkListener-joinLink" class="simple-but border"><span><span>Участвовать в битве</span></span></a>';

require_once 'system/footer.php';
?>