<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="../css/another.css">
<link rel="stylesheet" type="text/css" href="css/another.css"/>
<?php
session_start();
$servername = "localhost";
$database = "wartank";
$username = "root";
$password = "root";



$connect = mysqli_connect($servername, $username, $password, $database);

// Проверяем соединение
if (!$connect) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

$query = "SELECT * FROM `users` WHERE `nick` = '$nickname'";
    
$result = mysqli_query($connect, $query);
if ($result) {
    $usersMyID = mysqli_fetch_assoc($result);

} else {
    echo "Query failed: " . mysqli_error($connect);
}

function ProtectedAuth(){
    if (isset($_SESSION['nickname'])) {
        $nickname = $_SESSION['nickname'];
        
    if (!empty($nickname) && strlen($nickname) > 0) {
        header("Location: angar");
    } else {
        header("Location: index");
    }
    }

}

?>
