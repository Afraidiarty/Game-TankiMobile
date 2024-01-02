<?
require_once 'system/header.php';
if(isset($_GET['id'])){
    $id_clan = $_GET['id'];
}
 

$myID = mysqli_real_escape_string($connect, $myID);

$query = "DELETE FROM `clan_invite` WHERE id_user = '$myID'";
$result = mysqli_query($connect, $query);



$query = "UPDATE `users` SET `id_clan` = ?,  `attach` = `attach` + '{$clanWhoInvite['bonus_stats']}', `armor` = `armor` + '{$clanWhoInvite['bonus_stats']}',
`accuracy` = `accuracy` + '{$clanWhoInvite['bonus_stats']}',`health` = `health` + '{$clanWhoInvite['bonus_stats']}' WHERE `id` = ?";
$stmt = $connect->prepare($query);
if ($stmt) { // успешно
    $stmt->bind_param("ii", $id_clan,$myID);
    $stmt->execute();
    $stmt->close();
    header("Location: company");
}

require_once 'system/footer.php';
?>