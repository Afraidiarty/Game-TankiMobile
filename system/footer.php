<?

$servername = "localhost";
$database = "wartank";
$username = "root";
$password = "root";



// Create a database connection
$connect = mysqli_connect($servername, $username, $password, $database);

// Проверяем соединение
if (!$connect) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

$nickname = "";
   
if (isset($_SESSION['nickname'])) {
    $nickname = $_SESSION['nickname'];
}
$query = "SELECT * FROM `users` WHERE `nick` = '$nickname'";
    
$result = mysqli_query($connect, $query);
if ($result) {
    $users = mysqli_fetch_assoc($result);

} else {
    echo "Query failed: " . mysqli_error($connect);
}


$countOnlineUsers = 0;
$currentTime = time();
$formattedTimeCurrent = date("H:i:s", $currentTime);

$res = mysqli_query($connect, "SELECT `lastOnline` FROM `users`");
while ($lastOnl = mysqli_fetch_assoc($res)) {
  $timeDifference = $currentTime - $lastOnl['lastOnline'];
  if ($timeDifference <= 3600) {
    $countOnlineUsers++;
  }
}


if(!empty($nickname)){
?>
<div class="footer">
  <table>
    <tbody>
      <tr>
        <td class="pr4 w33">
          <div style="position:relative;">
            <a class="simple-but gray border mb1" href="angar">
              <span><span>Ангар</span></span>
            </a>
            <span class="digit esmall">
              <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
            </span>
          </div>
        </td>
        <td class="pr4 w33">
          <div style="position:relative;">
            <a class="simple-but gray border mb1" href="profile">
              <span><span>Профиль</span></span>
            </a>
            <span class="digit esmall">
              <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
            </span>
          </div>
        </td>
        <td class="pr4 w33">
          <div style="position:relative;">
            <a class="simple-but gray border mb1" href="company">
              <span><span>Дивизия</span></span>
            </a>
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="medium cntr mb2 mt2">
    <a class="bia" href="marathon2">Бронетанковый марафон</a>
  </div>

  <div class="medium cntr mt2 mb2">
    <a class="magenta" href="xpromo/BooleanPromoType_Dep50ToBonus75AndClan_OR_Dep500ToBonus375AndClan">Акция - бонус золота!</a>
  </div>

  <div class="medium cntr mb2">
    <a class="yellow1" href="forum">Форум</a> | <a class="yellow1" href="chat">Чат</a>
  </div>
  <?
}
  ?>
  <div class="esmall cntr mb2">
    <a class="yellow1" href="online">Онлайн</a>: <span class="yellow1"><? echo $countOnlineUsers; ?></span>
  </div>
  <div class="esmall cntr mb2 mt2 gray1">
    <span>
      <span><? echo $formattedTimeCurrent; ?></span>
    </span>
  </div>
  <div class="esmall cntr mb5">
    <a class="gray1" href="about">Об игре</a> | <a class="gray1" href="settings">Настройки</a>
  </div>
  <div class="esmall cntr mb5 gray1">
    <a class="gray1" href="/">https://ссылка</a> @ Overmobile 2023, 16+
  </div>

  <div class="esmall cntr mb5 gray1">ООО «</div>

  <div class="esmall cntr mb5">
    <a class="gray1" href="NEW  LINK">Другие игры</a>
  </div>



  <div class="esmall cntr">
    <a class="gray1" href="support">Помощь</a> | <a class="gray1" href="?exit">Выход</a>
  </div>
</div>
<?php
/*echo '<link rel="stylesheet" type="text/css" href="http://wartank.ru/images/style.css"/>';
include_once '../tanks/foots';
exit();*/


//ФАЙЛЫ


?>