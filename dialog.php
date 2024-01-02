<?
require_once 'system/header.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$query = "UPDATE `mail` SET `mail_read` = 0 WHERE `id_sender` = ? AND `id_recipient` = ?";
$stmt = $connect->prepare($query);
$stmt->bind_param("ss",  $id,$myID);
$stmt->execute();
    
$stmt->close();

$query = "SELECT * FROM `users` WHERE id = '$id'";
$result = mysqli_query($connect,$query);
$recepient = mysqli_fetch_assoc($result);

# Send Messages
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    echo $message;

    $query = "INSERT INTO `mail` (`id_sender`, `id_recipient`, `text` , `time`) VALUES (?,?,?,?)";
    $stmt = $connect->prepare($query);
    $time = time();
    $stmt->bind_param("ssss", $myID, $id, $message,$time);
    $stmt->execute();
    $stmt->close();
    
    $_SESSION['msg'] = '<div class="buy-place-block"><div class="feedbackPanelSUCCESS"><div class="line1"><span class="feedbackPanelSUCCESS">Сообщение отправлено</span></div></div></div>';

    header("Location: dialog?id=$id");
}


echo '<div class="small white bold cntr mb5">Диалог с <a class="yellow1" w:id="targetLink" href="../profile/32817090">
<img class="vb" height="14" width="14" src="img/rankets/'.$recepient['side'].'/'.$recepient['rang'].'.png?1">
 '.$recepient['nick'].'</a></div>';


 $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
 $messagesPerPage = 10;
 $offset = ($currentPage - 1) * $messagesPerPage;

 $query = "SELECT * FROM `mail` WHERE (id_sender = ? AND id_recipient = ?) OR (id_sender = ? AND id_recipient = ?) ORDER BY time DESC LIMIT ? OFFSET ?";
 $stmt = mysqli_prepare($connect, $query);
 
 mysqli_stmt_bind_param($stmt, "ssssii", $myID, $id, $id, $myID, $messagesPerPage, $offset);
 
 mysqli_stmt_execute($stmt);
 



    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0 ){
    echo '<div class="trnt-block mb6">
    <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
    <div class="wrap-content white bold small sh_b">';
    }


    while ($mail = mysqli_fetch_assoc($result)) {

        if($users['access'] == 0) $colorText = 'users';
        elseif($users['access'] == 1) $colorText = 'moderator';
        elseif($users['access'] == 2) $colorText = 'admin';

        if ($mail['id_sender'] == $myID) {
            // Format the timestamp
            $formattedTime = gmdate("H:i:s", $mail['time']);
    
            echo '<div class="" style="text-align:left;">
                  <span class="yellow1 td_u">' . $users['nick'] . '</span>,
                  <span class="esmall gray1">' . $formattedTime . '</span>
                  <span class="'.$colorText.'"><p>' . $mail['text'] . '</p></span></div>';
        }else{

            if($recepient['access'] == 0) $colorText = 'users';
            elseif($recepient['access'] == 1) $colorText = 'moderator';
            elseif($recepient['access'] == 2) $colorText = 'admin';

            $formattedTime = gmdate("H:i:s", $mail['time']);
            echo '<div class="" style="text-align:left;">
            <span class="yellow1 td_u">' . $recepient['nick'] . '</span>,
            <span class="esmall gray1">' . $formattedTime . '</span>
            <span class="' . ($recepient['access'] == 0 ? 'green1' : $colorText) . '"><p>' . $mail['text'] . '</p></span></div>';
    
        }
    }
    $totalMessagesQuery = "SELECT COUNT(*) as total FROM `mail` WHERE (id_sender = ? AND id_recipient = ?) OR (id_sender = ? AND id_recipient = ?)";
    $totalStmt = mysqli_prepare($connect, $totalMessagesQuery);
    mysqli_stmt_bind_param($totalStmt, "ssss", $myID, $id, $id, $myID);
    mysqli_stmt_execute($totalStmt);
    $totalResult = mysqli_stmt_get_result($totalStmt);
    $totalMessages = mysqli_fetch_assoc($totalResult)['total'];
    
    $totalPages = ceil($totalMessages / $messagesPerPage);
    
    // Display pagination links
    echo '<div class="pgn">';
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a class="simple-but gray" href="?id=' . $id . '&page=' . $i . '" title="Go to page ' . $i . '"><span><span>' . $i . '</span></span></a>';

    }
    echo '</div>';

echo '</div>


</div>
</div></div></div></div></div></div></></div>
</div>';


echo '<form class="pb10" w:id="newPmForm" id="id4" method="post" action=""><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id4_hf_0" id="id4_hf_0"></div>
<div class="cntr mb5"><textarea w:id="message" rows="3" name="message" class="w90 p0 m0 wfield"></textarea></div>
<div class="input-but border w50 m0a"><span><input class="w100" type="submit" w:message="value:MessagePage.send" value="Отправить"></span></div>
</form>';

require_once 'system/footer.php';
?>