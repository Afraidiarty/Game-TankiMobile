<?
require_once 'system/header.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$query = "SELECT * FROM `forum` WHERE id = '$id'";
$result = mysqli_query($connect,$query);
$access = mysqli_fetch_assoc($result);
if ($_SERVER["REQUEST_METHOD"] == "POST" && $users['access'] >= $access['access'] ){

    echo $id;
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    if (empty($subject) || empty($message)) {
        echo "Please fill out all the fields.";
    } else {



        $query = "INSERT INTO `topic` SET `id_forum` = ?, `id_user` = ?, `name` = ?, `text` = ?, `time` = ?,`onclick` = ?";
        $stmt = $connect->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param("iissii", $id_forum, $id_user, $name, $text, $t,$t);

            $id_forum = $id;
            $id_user = $myID;
            $name = $subject;
            $text = $message;
            $t = time();
            $stmt->execute();
            $stmt->close();
        } 
        
        header("Location: forum?id=" . $id);

    }
    if($id_forum == 1){
        $query = "UPDATE `users` SET `news_read` = 1";
        $stmt = $connect->prepare($query);
        $stmt->execute();
    }
}
?>