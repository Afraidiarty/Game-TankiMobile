<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?
require_once 'system/core.php';
$nickname = "";
   
if (isset($_SESSION['nickname'])) {
    $nickname = $_SESSION['nickname'];
} else {
    echo "Вы не авторизованы.";
    exit; 
}




$query = "SELECT * FROM `users` WHERE `nick` = '$nickname'";

$result = mysqli_query($connect, $query);
if ($result) {
    $users = mysqli_fetch_assoc($result);

} else {
    echo "Query failed: " . mysqli_error($connect);
}





$myID = $users['id'];

if(isset($_GET['id'])){
    $idTop = $_GET['id'];
}

$query = "SELECT  * FROM `topic` WHERE id = '$idTop'";
$result = mysqli_query($connect,$query);
$currTop = mysqli_fetch_assoc($result);

$srCH = $currTop['id_user'];

$query = "SELECT * FROM `users` WHERE id = '$srCH'";
$result = mysqli_query($connect,$query);
$usCreate = mysqli_fetch_assoc($result);




$month = date('n', $currTop['time']);
$day = date('j', $currTop['time']); // Извлекаем день (1-31)
$hours = date('G', $currTop['time']); // Извлекаем часы (0-23)
$minutes = date('i', $currTop['time']); // Извлекаем минуты (00-59)
switch ($month) {
    case 1:
        $monthName = "Января";
        break;
    case 2:
        $monthName = "Февраля";
        break;
    case 3:
        $monthName = "Мара";
        break;
    case 4:
        $monthName = "Апреля";
        break;
    case 5:
        $monthName = "Мая";
        break;
    case 6:
        $monthName = "Июня";
        break;
    case 7:
        $monthName = "Июль";
        break;
    case 8:
        $monthName = "Август";
        break;
    case 9:
        $monthName = "Сентября";
        break;
    case 10:
        $monthName = "Октября";
        break;
    case 11:
        $monthName = "Ноября";
        break;
    case 12:
        $monthName = "Декабря";
        break;
    default:
        $monthName = "Недопустимый номер месяца";
        break;
}


$query = "SELECT * FROM `forum` WHERE id = '{$currTop['id_forum']}'";
$result = mysqli_query($connect,$query);
$path = mysqli_fetch_assoc($result);

echo '<div class="medium white bold cntr mt5 mb10" >'. $currTop['name'] .'</div>';

echo '<div class="mb5" style = "text-align:left;" >
<img width="16" height="16" src="images/forum_main.png"> <a class="medium white" href="../../../../0">Форум</a> / <a class="white" href="../../4">'. $path['name'] .'</a>
</div>';

if($usCreate['access'] == 0) $colorText = 'users';
elseif($usCreate['access'] == 1) $colorText = 'moderator';
elseif($usCreate['access'] == 2) $colorText = 'admin';

echo '<a class="yellow1 sndr blck" w:id="authorLink" href="profile?id='.$usCreate['id'].'" style ="text-align: left;">
<img class="vb" height="14" width="14" src="img/rankets/'. $usCreate['side'] .'/'. $usCreate['rang'] .'.png?1">
'. $usCreate['nick'] .'<span class="small fr pt2 green1" w:id="time">'.$day .' '.$monthName .' '. $hours.':'. $minutes .'</span></a>';

echo '<div class="medium ovh m5 white '.$colorText.'" w:id="message"><p style ="text-align: left;" >' . nl2br($currTop['text']) . '</p></div>';
echo '<div class="small gray1 m5" style ="text-align: left;">Комментариев: '. $currTop['count'] .'</div>';
echo '<div class="pb5"></div>';



    if(isset($_GET['otvet'])){
        echo $f;
        $getIdOtvet = $_GET['otvet'];
        $_SESSION['msg'] = $getIdOtvet;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $messagesPerPage = 10; 

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    
    $offset = ($page - 1) * $messagesPerPage;
    
    $query = "SELECT * FROM `topic_msg` WHERE id_topic = '{$currTop['id']}' LIMIT $messagesPerPage OFFSET $offset";
    $res = mysqli_query($connect, $query);
    
while($top_msg = mysqli_fetch_assoc($res)){

    $month = date('n', $top_msg['time']);
$day = date('j', $top_msg['time']); // Извлекаем день (1-31)
$hours = date('G', $top_msg['time']); // Извлекаем часы (0-23)
$minutes = date('i', $top_msg['time']); // Извлекаем минуты (00-59)
switch ($month) {
    case 1:
        $monthName = "Января";
        break;
    case 2:
        $monthName = "Февраля";
        break;
    case 3:
        $monthName = "Мара";
        break;
    case 4:
        $monthName = "Апреля";
        break;
    case 5:
        $monthName = "Мая";
        break;
    case 6:
        $monthName = "Июня";
        break;
    case 7:
        $monthName = "Июль";
        break;
    case 8:
        $monthName = "Август";
        break;
    case 9:
        $monthName = "Сентября";
        break;
    case 10:
        $monthName = "Октября";
        break;
    case 11:
        $monthName = "Ноября";
        break;
    case 12:
        $monthName = "Декабря";
        break;
    default:
        $monthName = "Недопустимый номер месяца";
        break;
}

    $srCH = $top_msg['id_user'];

    $query = "SELECT * FROM `users` WHERE id = '$srCH'";
    $result = mysqli_query($connect,$query);
    $usCreateTop = mysqli_fetch_assoc($result);


    if($usCreateTop['access'] == 0) $colorText = 'users';
    elseif($usCreateTop['access'] == 1) $colorText = 'moderator';
    elseif($usCreateTop['access'] == 2) $colorText = 'admin';


    echo '<a class="yellow1 sndr blck" w:id="authorLink" href="profile?id='.$usCreateTop['id'].'" style ="text-align: left;">
    <img class="vb" height="14" width="14" src="img/rankets/'. $usCreateTop['side'] .'/'. $usCreateTop['rang'] .'.png?1">
    '. $usCreateTop['nick'] .'<span class="small fr pt2 green1" w:id="time">'.$day .' '.$monthName .' '. $hours.':'. $minutes .'</span></a>';
    echo '<div class="medium ovh m5 white">
    <div class = "'.$colorText.'" w:id="message"><p style = "text-align:left;" >'. nl2br($top_msg['text']) .'</p></div>
    <div class="pb5">
    
    <div class="pb5" style = "text-align:left;" >';
    if($myID != $usCreateTop['id']){
    echo '<a class="small gray1" w:id="replyLink" href="topic?otvet='. $usCreateTop['nick'] .'">[ответить]</a>';
    }
    echo'</div>
    
    
    </div>
    </div>';
}
$query = "SELECT COUNT(*) as total_messages FROM `topic_msg` WHERE id_topic = '{$currTop['id']}'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$totalMessages = $row['total_messages'];

$totalPages = ceil($totalMessages / $messagesPerPage);

echo '<div class="pgn">';
for ($i = 1; $i <= $totalPages; $i++) {
    if ($i === $page) {
        echo '<span class="simple-but gray" title="Go to page ' . $i . '"><em><span><span>' . $i . '</span></span></em></span>';
    } else {
        echo '<a class="simple-but gray" href="topic?id=' . $currTop['id'] . '&page=' . $i . '" title="Go to page ' . $i . '"><span><span>' . $i . '</span></span></a>';
    }
}
if($totalMessages > 10)echo '<a class="simple-but gray" href="topic?id=' . $currTop['id'] . '&page=' . $totalPages . '" title="Go to the last page"><span><span>»</span></span></a>';
echo '</div>';
echo '<div class="dhr mt5 mb5"></div>';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $comm = $_POST['message'];
    if (empty($comm)) {
      $_SESSION['msgOutH'] = "Введите сообщение";
    } else {

        $query = "INSERT INTO `topic_msg` SET `id_topic` = ?, `id_user` = ?,  `time` = ?, `text` = ?";
        $stmt = $connect->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param("iiis",$id_topic,$id_user,$t,$text);
        
            $id_topic = $currTop['id'];
            $id_user = $myID;
            $t = time();
            $text = $comm;
            
        
            if($stmt->execute()){
                $q = "UPDATE `topic` SET `count` = `count` + 1 , `onclick` = ? WHERE id = ?";
                $stmt1 = $connect->prepare($q);
                $onclick = time();
                if($stmt1){
                    $stmt1->bind_param("ii",$onclick,$currTop['id']);
                    $stmt1->execute();
                }
            }
            $stmt->close();
        } else {
            echo 'Statement preparation failed';
        }
        
        
       header("Location: topic?id=" . $currTop['id']);

    }
}



echo '<div class="p5 cntr medium white">
<form w:id="commentForm" id="id2" method="post" action="">
    <div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden">
        <input type="hidden" name="id2_hf_0" id="id2_hf_0">
    </div>
    Комментарий<br>
    <textarea class="w98 mb5 wfield" rows="5" w:id="message" name="message">'. (isset($_SESSION['msg']) ? $_SESSION['msg'].',' : '') .'</textarea><br>
    <span class="input-but border w50 mXa mb10">
        <span><input class="w100" type="submit" w:message="value:TopicPage.doComment.submit" value="Отправить"></span>
    </span>
</form>
</div>';
unset($_SESSION['msg']);
echo '<a class="simple-but gray mb5" href="../../../../../moderators/"><span><span>Помощь модераторов</span></span></a>';
echo '<a class="simple-but gray mb5" w:id="forumRulesLink" href="/forum/0/s/4/t/299188"><span><span>Правила форума</span></span></a>';
require_once 'system/footer.php';

?>
