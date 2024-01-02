<?
require_once 'system/header.php';
if(isset($_GET['id'])){
    $id_clan = $_GET['id'];
}


$myID = mysqli_real_escape_string($connect, $myID);

$query = "DELETE FROM `clan_invite` WHERE id_clan = '$id_clan'";
$result = mysqli_query($connect, $query);

header('Location: ' . $_SERVER['HTTP_REFERER']);
require_once 'system/footer.php';
?>