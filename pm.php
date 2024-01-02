<?
require_once 'system/header.php';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 7; 


$offset = ($page - 1) * $perPage;


$query = "SELECT * FROM `mail` WHERE (id_sender = '$myID' OR id_recipient = '$myID') AND `time` IN (SELECT MAX(`time`) FROM `mail` WHERE id_sender = '$myID' OR id_recipient = '$myID' GROUP BY IF(id_sender > id_recipient, CONCAT(id_sender, id_recipient), CONCAT(id_recipient, id_sender))) ORDER BY `time` DESC LIMIT $offset, $perPage";

$result = mysqli_query($connect, $query);

echo '<div class="medium white bold cntr mb5">Личная почта</div>';

echo '<table class="tlist small bold white sh_b mb5"><tbody><tr>';

while ($mail = mysqli_fetch_assoc($result)) {





    $query_read = "SELECT * FROM `mail` WHERE id_sender = '{$mail['id_sender']}' AND id_sender != '$myID' ORDER BY `time` DESC";
    $result_read = mysqli_query($connect,$query_read);
    $read = mysqli_fetch_assoc($result_read);

    $formattedTime = date('F, j, H:i', $mail['time']);

    echo '<td class="usr w100">
        <a href="dialog?id=' . (($mail['id_sender'] != $myID) ? $mail['id_sender'] : $mail['id_recipient']) . '" class="white">';
            if($read['mail_read'] == 1)echo '<span class="green1">(+)</span> ';
        elseif($mail['id_sender'] == $myID ) echo '<img src="img/ico/out.png" title="Отправленное" alt="Отправленное"> ';
        else echo '<img src="img/ico/in.png" title="Входящее" alt="Входящее"> ';
        
        $idToFetch = ($mail['id_recipient'] != $myID) ? $mail['id_recipient'] : $mail['id_sender'];

        $query_users = "SELECT * FROM `users` WHERE id = ?";
        $stmt = mysqli_prepare($connect, $query_users);
        mysqli_stmt_bind_param($stmt, 'i', $idToFetch);
        mysqli_stmt_execute($stmt);
        $result_users = mysqli_stmt_get_result($stmt);
        $sender = mysqli_fetch_assoc($result_users);
        

        if($sender['access'] == 0) $colorText = 'users';
        elseif($sender['access'] == 1) $colorText = 'moderator';
        elseif($sender['access'] == 2) $colorText = 'admin';

        echo '<img class="vb" height="14" width="14" src="img/rankets/' . $sender['side'] . '/' . $sender['rang'] . '.png?1">
        ' . $sender['nick'] . '
        <span class="gray1">' . $formattedTime . '</span><br>
        <span class="'.$colorText.'">' . $mail['text'] . '</span>';
        
        mysqli_stmt_close($stmt);
        echo '</a></td></tr>';
}

$queryCount = "SELECT COUNT(*) as total FROM `mail` WHERE (id_sender = '$myID' OR id_recipient = '$myID') AND `time` IN (SELECT MAX(`time`) FROM `mail` WHERE id_sender = '$myID' OR id_recipient = '$myID' GROUP BY IF(id_sender > id_recipient, CONCAT(id_sender, id_recipient), CONCAT(id_recipient, id_sender))) ORDER BY `time`";
$resultCount = mysqli_query($connect, $queryCount);
$count = mysqli_fetch_assoc($resultCount)['total'];
$totalPages = ceil($count / $perPage);

echo '</tbody></table>';

echo '<div class="pgn">';
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<a class="simple-but gray" href="?id=' . $id . '&page=' . $i . '" title="Go to page ' . $i . '"><span><span>' . $i . '</span></span></a>';
}

echo '</div>';

echo '</tbody></table>';

require_once 'system/footer.php';
?>