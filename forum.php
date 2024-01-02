<?
echo '    <meta name="viewport" content="width=device-width, initial-scale=1.0">';
require_once 'system/core.php';
$nickname = "";
   
if (isset($_SESSION['nickname'])) {
    $nickname = $_SESSION['nickname'];
} else {
    echo "Вы не авторизованы.";
    exit; 
}

$qForUs = "SELECT * FROM `users`";
$resForUs = mysqli_query($connect,$qForUs);
if($resForUs){
  $allUs = mysqli_fetch_assoc($resForUs);
}


$query = "SELECT * FROM `users` WHERE `nick` = '$nickname'";

$result = mysqli_query($connect, $query);
if ($result) {
    $users = mysqli_fetch_assoc($result);

} else {
    echo "Query failed: " . mysqli_error($connect);
}


$query = "SELECT * FROM `forum`";
$result = mysqli_query($connect,$query);

if (!isset($_GET['id'])) {
    echo '<div class="medium white bold cntr mt5 mb10 ">Форум</div>';
    while ($forum = mysqli_fetch_assoc($result)) {
        if ($forum['id'] % 2 != 0) {
            echo '<div w:id="forum" style ="text-align:left;">
            <a class="blck p5 forum left"  w:id="forumLink" href="forum?id=' . $forum['id'] . '">
            <span class="medium bold yellow1 left"><img src="images/forum.png" width="16" height="16" alt=""> ' . $forum['name'] . '</span><br>
            <span class="small white">' . $forum['text'] . '</span>
            </a>
            </div>'; 
        } else {
            echo '<div w:id="forum left" class="odd" style ="text-align:left;">
            <a class="blck p5 forum" w:id="forumLink" href="forum?id='. $forum['id'] .'">
            <span class="medium bold yellow1"><img src="images/forum.png" width="16" height="16" alt=""> '.  $forum['name'] .'</span><br>
            <span class="small white">' . $forum['text'] . '</span>
            </a>
            </div>';
        }
    }
}




if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM forum WHERE id = ?";
    $stmt = mysqli_prepare($connect, $query);
    


    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $currentForum = mysqli_fetch_assoc($result);
        
        mysqli_stmt_close($stmt);
    }

    $query = "SELECT COUNT(*) as totalTopics FROM `topic` WHERE id_forum = '{$currentForum['id']}'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    $totalTopics = $row['totalTopics'];
    
    $topicsPerPage = 20;
    
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    
    $forumId = $currentForum['id'];
    
    $offset = ($page - 1) * $topicsPerPage;
    
    $query = "SELECT * FROM `topic` WHERE id_forum = '{$forumId}' ORDER BY onclick DESC LIMIT $offset, $topicsPerPage";
    $result = mysqli_query($connect, $query);
    
    echo '<div class="medium white bold cntr mt5 mb10">' . $currentForum['name'] . '</div>';
    echo '<div class="mb5" style="text-align: left;"><img width="16" height="16" src="images/forum.png"> <a class="medium white" w:id="boardLink" href="forum">Форум</a></div>';
    
    $i = 0;
    while ($Topic = mysqli_fetch_assoc($result)) {
        $i++;
        if ($i % 2 != 0) {
            echo '<div w:id="topic" style="text-align: left;">
            <a class="blck p5 forum left" w:id="topicLink" href="topic?id=' . $Topic['id'] . '">
            <span class="medium yellow1 medium" w:id="topicContainer"><img w:id="topicImage" width="16" height="16" src="images/topic_new.png"> ' . $Topic['name'] . '</span>
            </a>
            </div>';
        } else {
            echo '<div w:id="topic" class="odd" style="text-align: left;">
            <a class="blck p5 forum left" w:id="topicLink" href="topic?id=' . $Topic['id'] . '">
            <span class="medium yellow1 medium" w:id="topicContainer"><img w:id="topicImage" width="16" height="16" src="images/topic_new.png"> ' . $Topic['name'] . '</span>
            </a>
            </div>';
        }
    }
        $totalPages = ceil($totalTopics / $topicsPerPage);
    if ($totalPages > 1) {
        echo '<div class="pgn">';
        for ($p = 1; $p <= $totalPages; $p++) {
            if ($p == $page) {
                echo '<span class="simple-but gray" title="Go to page ' . $p . '"><em><span><span>' . $p . '</span></span></em></span>';
            } else {
                echo '<a class="simple-but gray" href="forum?id=' . $forumId . '&page=' . $p . '" title="Go to page ' . $p . '"><span><span>' . $p . '</span></span></a>';
            }
        }
        echo '</div>';
        
        echo '</div>';
    }
        //echo '<a href="forum?id=2&page=2">ff</a>';
    echo '<div class="dhr mt5 mb5"></div>';
    echo '<div class="mt5 mb5"></div>';
    if($currentForum['access'] <= $users['access']){
        echo '<a class="blck white small" w:id="createTopic" href="createtopic?id_top=' . $currentForum['id'] . '" style = "text-align:left;"><img alt="+" src="images/topic_create.png" width="16" height="16"> Создать новый топик</a>';
    }
        echo '<div class="mt5 mb5"></div>';


    
}



    echo '<a class="simple-but gray mb5" href="../moderators/"><span><span>Помощь модераторов</span></span></a>';
   echo '<a class="simple-but gray mb5" w:id="forumRulesLink" href="/forum/0/s/4/t/299188"><span><span>Правила форума</span></span></a>';
require_once 'system/footer.php'
?>
