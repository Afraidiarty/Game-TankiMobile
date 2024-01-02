 <!-- HEADER -->
 <?
require_once 'system/header.php';
?>

<!-- HEADER -->

<table>
  <tbody>
    <tr>
      <td class="tab4 active" w:id="td">
        <a class="simple-but blue selected" w:id="link" href="All">
          <span>
            <span>
              <img w:id="image" src="img/ico/online.png">
              <b> Онлайн</b>
            </span>
          </span>
        </a>
      </td>

      <td class="tab4" w:id="td">
        <a class="simple-but blue" w:id="link" href="NotInClan">
          <span>
            <span>
              <img w:id="image" src="img/ico/offline.png">
              <b> Без дивизии</b>
            </span>
          </span>
        </a>
      </td>

      <td class="tab4" w:id="td">
        <a class="simple-but blue" w:id="link" href="Search">
          <span>
            <span>
              <img w:id="image" src="img/ico/accuracy.jpg">
              <b> Поиск</b>
            </span>
          </span>
        </a>
      </td>
    </tr>
  </tbody>
</table>



<table class="tlist white sh_b bold small mb10">

<?
$timeDiff;
$currentTime = time();
$i = 0;
$allUs = array();
while ($row = mysqli_fetch_assoc($resForUs)) {
    $allUs[] = $row;
}

// Сортировка по убыванию level
usort($allUs, function ($a, $b) {
    return $b['level'] - $a['level'];
});




$currentTime = time();

$counterUs = count($allUs);
$i = 0; 

for ($index = 0; $index < $counterUs; $index++) {
    switch($allUs[$index]['rang']){
        case 0: $rang = "img/rankets/" . $allUs[$index]['side'] . "/0.png";break;
        case 1: $rang = "img/rankets/" . $allUs[$index]['side'] . "/1.png";break;
        case 2: $rang = "img/rankets/" . $allUs[$index]['side'] . "/2.png";break;
        case 3: $rang = "img/rankets/" . $allUs[$index]['side'] . "/3.png";break;
        case 4: $rang = "img/rankets/" . $allUs[$index]['side'] . "/4.png";break;
        case 5: $rang = "img/rankets/" . $allUs[$index]['side'] . "/5.png";break;
        case 6: $rang = "img/rankets/" . $allUs[$index]['side'] . "/6.png";break;
        case 7: $rang = "img/rankets/" . $allUs[$index]['side'] . "/7.png";break;
    }
    $timeDiff = $currentTime - $allUs[$index]['lastOnline'];
    if ($timeDiff <= 3600) {
        $i++;
        if ($i % 2 == 0) {
?>

  <tbody>
    <tr w:id="users" class="even">
      <td class="num"><? echo $i; ?></td>
      <td class="va_m usr w100">
        <a class="white" w:id="profileLink" href="profile?id=<?php echo $allUs[$index]['id']; ?>">
          <img class="vb" height="14" width="14" src="<? echo $rang; ?>">
          <span class="green2" w:id="login"><?  echo $allUs[$index]['nick']; ?></span><br>
        </a>
      </td>
      <td class="va_m nwr p5 ta_r">
        <img class="vb" height="14" width="14" src="img/ico/level.png?2"> <?  echo $allUs[$index]['level']; ?>
      </td>
    </tr>
    <?
        }else{
    ?>
    <tr w:id="users" class="odd">
      <td class="num"><? echo $i; ?></td>
      <td class="va_m usr w100">
        <a class="white" w:id="profileLink" href="profile?id=<?php echo $allUs[$index]['id']; ?>">
          <img class="vb" height="14" width="14" src="<? echo $rang; ?>">
          <span class="green2" w:id="login"><?  echo $allUs[$index]['nick']; ?></span><br>
        </a>
      </td>
      <td class="va_m nwr p5 ta_r">
        <img class="vb" height="14" width="14" src="img/ico/level.png?2"> <?  echo $allUs[$index]['level']; ?>
      </td>
    </tr>
  </tbody>
  <?
        }
  }
}
  ?>
</table>


<?
require_once 'system/footer.php';
?>