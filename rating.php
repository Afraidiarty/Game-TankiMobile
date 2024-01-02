<style>
  .height{
    margin-bottom: 1px !important;
  }
</style>
  <!-- HEADER -->
  <?
    require_once 'system/header.php';
  ?>
      

<div class="white medium cntr bold mb2">Лучшие танкисты</div>

 <?
 

// Создаем массив для хранения данных
$usersData = array();

// Заполняем массив данными из результата запроса
while ($allUsers = mysqli_fetch_assoc($result1)) {

   echo $$allUsers['rang'];
    $TotalStats = $allUsers['attach'] + $allUsers['armor'] + $allUsers['accuracy'] + $allUsers['health'];
    $usersData[] = array(
        'nick' => $allUsers['nick'],
        'TotalStats' => $TotalStats,
        'attach' => $allUsers['attach'],
        'img' => $allUsers['img'],
        'id' => $allUsers['id'],
        'rang'=> $allUsers['rang'],
        'side' => $allUsers['side']
    );
}

// Пузырьковая сортировка по TotalStats по убыванию
$length = count($usersData);
for ($i = 0; $i < $length - 1; $i++) {
    for ($j = 0; $j < $length - $i - 1; $j++) {
        if ($usersData[$j]['TotalStats'] < $usersData[$j + 1]['TotalStats']) {
            // Обмен элементов
            $temp = $usersData[$j];
            $usersData[$j] = $usersData[$j + 1];
            $usersData[$j + 1] = $temp;
        }
    }
}


// несколько страниц 
$perPage = 11;
$totalUsers = count($usersData);
$totalPages = ceil($totalUsers / $perPage);


if (isset($_GET['page']) && is_numeric($_GET['page'])) {
  $currentPage = max(1, min($_GET['page'], $totalPages));
} else {
  $currentPage = 1;
}

$startIndex = ($currentPage - 1) * $perPage;
$endIndex = min($startIndex + $perPage, $totalUsers);

// Выводим отсортированные результаты

for ($i = $startIndex; $i < $endIndex; $i++) {
   $userData = $usersData[$i];
    switch($userData['rang']){
      case 0: $rang = "img/rankets/" . $userData['side'] . "/0.png";break;
      case 1: $rang = "img/rankets/" . $userData['side'] . "/1.png";break;
      case 2: $rang = "img/rankets/" . $userData['side'] . "/2.png";break;
      case 3: $rang = "img/rankets/" . $userData['side'] . "/3.png";break;
      case 4: $rang = "img/rankets/" . $userData['side'] . "/4.png";break;
      case 5: $rang = "img/rankets/" . $userData['side'] . "/5.png";break;
      case 6: $rang = "img/rankets/" . $userData['side'] . "/6.png";break;
      case 7: $rang = "img/rankets/" . $userData['side'] . "/7.png";break;
   }
    // на одной странице может быть только 11 игроков
    if($i < 3){
        ?>
            <div class="trnt-block mb2">
    <div class="wrap1">
        <div class="wrap2">
            <div class="wrap3">
                <div class="wrap4">
                    <div class="wrap5">
                        <div class="wrap6">
                            <div class="wrap7">
                                <div class="wrap8">
                                    <div class="wrap-content cntr white bold custombg angar_1">
                                        <a href="profile?id=<?php echo $userData['id']; ?>">
                                            <span class="blck small green2 sh_b mb5">
                                                <img class="vb" height="14" width="14" src="<?echo $rang?> ">  <? echo $userData['nick'] ?>
                                            </span>
                                            <div class="small bold va_m">
                                                <img width="16" height="11" src="/images/flags/ussr16x11.png">
                                                <span class="gray2">Тяжелый танк</span>
                                            </div>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="cntr">
                                                            <img class="tank-img" alt="tank" src="<?php echo $userData['img']; ?>">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <span class="blck cntr small bold mb2 pb0">
                                                <img src="img/ico/power.png" height="14" width="14">
                                                <span class="green2">Танковая мощь: <? echo $userData['TotalStats'] ?></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <?
    }else{
        ?>
        <table class="tlist white sh_b bold small  height">
  <tbody>
    <tr w:id="users" class="even">
      <td class="num"><? echo $i ?></td>
      <td class="va_m usr w100">
      <a class="white" id="profileLink" href="profile?id=<?php echo $userData['id']; ?>">
          <img class="vb" height="14" width="14" src="<?echo $rang?> "> 
          <span class="green2" w:id="login"><? echo $userData['nick'] ?></span><br>
        </a>
      </td>
      <td class="va_m nwr p5 ta_r">
        <img class="vb" height="14" width="14" src="img/ico/power.png"> <? echo $userData['TotalStats'] ?>
      </td>
    </tr>
  </tbody>
</table>
        <?
    }
    
}
echo '<div class="pgn">';
for ($page = 1; $page <= $totalPages; $page++) {
  if($page == $currentPage){
    echo '<span class="simple-but gray" title="Go to page 1"><em><span><span>'.$page.'</span></span></em></span>';
  }else{
    echo '<a class="simple-but gray" href="rating?page=' . $page . '" title="Go to page ' . $page . '"><span><span>' . $page . '</span></span></a>';
  }
  
  }
echo '</div>';
?>

<?
require_once 'system/footer.php';
 ?>



