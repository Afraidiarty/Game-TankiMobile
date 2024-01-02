<!-- ИЗМЕНЕННЫЕ СТИЛИ  -->

<style>
.imgtxt.bshd.wht.btxt.left {
    text-align: left;
}

</style>
 
<!-- ИЗМЕНЕННЫЕ СТИЛИ  -->


 <!-- HEADER -->
 <?
require_once 'system/header.php';
?>

<!-- HEADER -->

<?
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if($id != $myID){
        $query = "SELECT * FROM `users` WHERE `id` = '$id'";
        $result = $connect->query($query);
        if ($result) {
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $result->free();
            } else {
                echo "User not found.";
            }
        } else {
            echo "Query failed: " . $connect->error;
        }
    }else{
        header("Location: profile");
    }
} else {
    $CheckedProfile = true;
    $query = "SELECT * FROM `users` WHERE `nick` = '$nickname'";
    $result = $connect->query($query);
   if($result){
        if($result->num_rows>0){
            $user = $result->fetch_assoc();
            $result->free();
        }
   }
}



$query_user_builds = "SELECT * FROM `buildings_user` WHERE id_user = '{$user['id']}' AND id_buildings = 2";
$result_user_buidls = mysqli_query($connect,$query_user_builds);
$polygon = mysqli_fetch_assoc($result_user_buidls);

switch ($polygon['buildings_level']) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        $polygonLevel = 1;
        break;
    case 6:
    case 7:
    case 8:
    case 9:
    case 10:
        $polygonLevel = 2;
        break;
    case 11:
    case 12:
    case 13:
    case 14:
    case 15:
        $polygonLevel = 3;
        break;
    case 16:
        $polygonLevel = 4;
    case 17:
        $polygonLevel = 5;
        break;
}

    // VIP 1
    $query = "SELECT * FROM `vip` WHERE id_user = '{$user['id']}' AND id_vip = 1";
    $result = mysqli_query($connect, $query);
    $vip_1_user = mysqli_fetch_assoc($result);


    $remaining_time_user = $vip_1_user['time'] - $current_time;

    if ($remaining_time_user < 0) {
        $query = "DELETE FROM `vip` WHERE id_user = '{$user['id']}' AND id_vip = 1";
        $result = mysqli_query($connect, $query);
    }
    // VIP 1

    // POLYGON 1
    $query = "SELECT * FROM `polygon` WHERE id_user = '{$user['id']}' AND id_effect = 1";
    $result = mysqli_query($connect, $query);
    $effect_1 = mysqli_fetch_assoc($result);
    
    $time_user_pol_1 = $effect_1['time'] - $current_time;

// POLYGOM 1


// POLYGON 2
    $query = "SELECT * FROM `polygon` WHERE id_user = '{$user['id']}' AND id_effect = 2";
    $result = mysqli_query($connect, $query);
    $effect_2 = mysqli_fetch_assoc($result);
    
    $time_user_pol_2 = $effect_2['time'] - $current_time;


// POLYGOM 2

// POLYGON 3
$query = "SELECT * FROM `polygon` WHERE id_user = '{$user['id']}' AND id_effect = 3";
$result = mysqli_query($connect, $query);
$effect_3 = mysqli_fetch_assoc($result);

$time_user_pol_3 = $effect_3['time'] - $current_time;


// POLYGOM 3

// POLYGON 4
$query = "SELECT * FROM `polygon` WHERE id_user = '$myID' AND id_effect = 4";
$result = mysqli_query($connect, $query);
$effect_4 = mysqli_fetch_assoc($result);

$time_user_pol_4 = $effect_4['time'] - $current_time;

if ($time_user_pol_4 < 0) {
    $query = "DELETE FROM `polygon` WHERE id_user = '$myID' AND id_effect = 4";
    $result = mysqli_query($connect, $query);
}
// POLYGOM 4



// ЗВАНИЯ

switch($user['rang']){
    case 0: $rang = "img/rankets/" . $user['side'] . "/0.png";$textRang = "Кадет"; break;
    case 1: $rang = "img/rankets/" . $user['side'] . "/1.png";$textRang = "Рядовой"; break;
    case 2: $rang = "img/rankets/" . $user['side'] . "/2.png";$textRang = "Сержант"; break;
    case 3: $rang = "img/rankets/" . $user['side'] . "/3.png";$textRang = "Лейтенант"; break;
    case 4: $rang = "img/rankets/" . $user['side'] . "/4.png";$textRang = "Капитан"; break;
    case 5: $rang = "img/rankets/" . $user['side'] . "/5.png";$textRang = "Майор"; break;
    case 6: $rang = "img/rankets/" . $user['side'] . "/6.png";$textRang = "Подполковник"; break;
    case 7: $rang = "img/rankets/" . $user['side'] . "/7.png";$textRang = "Полковник"; break;
}

$query = "SELECT * FROM `clan` WHERE id = '{$user['id_clan']}'";
$result = mysqli_query($connect,$query);
$clan = mysqli_fetch_assoc($result);
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="trnt-block mb2">
    <div class="wrap1">
        <div class="wrap2">
            <div class="wrap3">
                <div class="wrap4">
                    <div class="wrap5">
                        <div class="wrap6">
                            <div class="wrap7">
                                <div class="wrap8">
                                    <div class="wrap-content">
                                        <div class="imgtxt bshd wht btxt left">
                                            <div class="thumb fl">
                                                <img alt="avatar" src="<? echo  $user['prifle-photo']; ?>">
                                                <span class="mask1">&nbsp;</span>
                                            </div>
                                            <div class="ml58 small white sh_b bold">
                                                <img class="vb" height="14" width="14" src="<? echo $rang; ?>">
                                                <span class="green2"><? echo $user['nick']; ?></span>
                                                <? if($user['id_clan']!=0){ ?>
                                                (Дивизия <a href="company?id=<? echo $clan['id'] ?>"><span class="green2"><? echo $clan['name'] ?></span></a>)
                                                <?
                                                }
                                                ?>
                                                <br>
                                                <img src="img/ico/victory.png" class="fixed-rang-text"> Звание: <span><? echo $textRang; ?></span><br>
                                                <img src="img/ico/level.png "  > Уровень <?  echo  $user['level']; ?><br>
                                            
                                            </div>
                                            <div class="clrb">
                                            <? if($CheckedProfile){
                                                echo '<div class="small white sh_b bold red-exp"><img class="vb" src="img/ico/exp.png?2"> Опыт: ' . $user['exp'] . ' из ' . $exp . '</div>';
                                            }
                                            ?>
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
    </div>
</div>

<?
if (isset($_GET['invite']) && isset($_GET['id'])) {

  if($user['id_clan'] == 0 ){
    if($users['clan_rang']>=5){
        $id = $_GET['id'];
        $query = "SELECT * FROM `clan_invite` WHERE id_user = '$id' AND id_clan = '{$users['id_clan']}'";
        $result = mysqli_query($connect, $query);
        if(mysqli_num_rows($result) == 0){
        
        $id_clan = $users['id_clan'];
        $id_user = $id;

        $query = "INSERT INTO `clan_invite` (`id_clan`, `id_user`) VALUES (?, ?)";
        $stmt = $connect->prepare($query);

        if ($stmt) {
          $stmt->bind_param("ii", $id_clan, $id_user);

          if (!$stmt->execute()) {
            echo $stmt->error;
          }

          $stmt->close();
        }
      }else{
        $_SESSION['msg'] = "Недостаточно прав для приглашения";
      }
    $_SESSION['msg'] = "Игроку отправлено приглашение";
  }else{
    $_SESSION['msg'] = "Вы уже отправляли игроку приглашение";
  }
}else{
  $_SESSION['msg'] = "Игрок уже в клане";
}
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if(!$CheckedProfile){
?>
<a class="simple-but border mb2" w:id="sendMessageLink" href="dialog?id=<? echo $user['id'] ?>"><span><span>Отправить почту</span></span></a>
<?if($user['side'] == $users['side'] and $users['clan_rang'] >= 5 and $user['id_clan'] == 0){?>
  <a class="simple-but border mb2" w:id="sendMessageLink"  href="profile?id=<?php echo $user['id']; ?>&invite=1"><span><span>Пригласить в дивизию</span></span></a>
<?}?>
<div class="wrap-content custombg angar_1" w:id="bgDiv">
  <div class="cntr mb20 mt20">
    <div class="small bold va_m">
      <img width="16" height="11" src="/images/flags/ussr16x11.png">
      <span class="white">Тяжелый танк</span>
    </div>
  </div>
  <table>
    <tbody>
      <tr>
        <td class="cntr">
          <img class="tank-img tankimgposfix" alt="tank" w:id="tankImage" src="<? echo $user['img'] ?>">
        </td>
        <td class="esmall bold green2 pl5 sh_b va_m w60px">
          <img width="14" height="14" src="img/ico/attack.png" alt="Атака" title="Атака"> 
          <span class="green2"> <? echo  $user['attach']; ?></span><br>
          <img width="14" height="14" src="img/ico/armor.png" alt="Броня" title="Броня">
          <span class="green2"><? echo  $user['armor']; ?></span><br>
          <img width="14" height="14" src="img/ico/accuracy.png" alt="Точность" title="Точность">
          <span class="green2"><? echo  $user['accuracy']; ?></span><br>
          <img width="14" height="14" src="img/ico/durability.png" alt="Прочность" title="Прочность">
          <span class="green2"><? echo  $user['health']; ?></span><br>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="cntr small bold mb2 pb0">
    <a w:id="powerLink" href="../power/8890914">
      <img src="img/ico/power.png" height="14" width="14">
      <span class="green2">Танковая мощь: <? echo $user['attach']+$user['armor']+$user['accuracy']+$user['health']?></span>
    </a>
    <br>
    <a class="gray1 td_u" w:id="powerLink2" href="power?id=<?php echo $user['id']; ?>">посмотреть</a>
  </div>
</div>
<div class="weapon-panel">
    <div class="wrp1">
        <div class="wrp2">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div class="image">
                                <div class="in">
                                    <?
                                        if ($time_user_pol_1 > 0){echo '<img src="img/polygon_level/attack'.$polygonLevel.'.png" title="attack" alt="attack">';}else{
                                            echo '<img src="img/ico/empty.png" title="attack" alt="attack">';
                                        }
                                    ?>
                                </div>
                                <div class="mask" title="Атака">&nbsp;</div>
                            </div>
                        </td>
                        <td>
                            <div class="image">
                                <div class="in">
                                    <?
                                        if ($time_user_pol_2 > 0){echo '<img src="img/polygon_level/armor'.$polygonLevel.'.png" title="armor" alt="armor">';}else{
                                            echo '<img src="img/ico/empty.png" title="armor" alt="armor">';
                                        }
                                    ?>
                                </div>
                                <div class="mask" title="Броня">&nbsp;</div>
                            </div>
                        </td>
                        <td>
                            <div class="image">
                                <div class="in">
                                    <?
                                        if ($time_user_pol_3 > 0){echo '<img src="img/polygon_level/accuracy'.$polygonLevel.'.png" title="accuracy" alt="accuracy">';}else{
                                            echo '<img src="img/ico/empty.png" title="accuracy" alt="accuracy">';
                                        }
                                    ?>
                              </div>
                                <div class="mask" title="Точность">&nbsp;</div>
                            </div>
                        </td>
                        <td>
                            <div class="image">
                                <div class="in">
                                <?
                                    if ($time_user_pol_4 > 0){echo '<img src="img/polygon_level/durability'.$polygonLevel.'.png" title="health" alt="health">';}else{
                                        echo '<img src="img/ico/empty.png" title="health" alt="health">';
                                    }
                                ?>
                               </div>
                                <div class="mask" title="Прочность">&nbsp;</div>
                            </div>
                        </td>
                        <td>
                            <div class="image">
                                <div class="in">
                                  <?
                                    if ($remaining_time_user > 0){echo '<img src="img/polygon_level/vip.png" title="vip" alt="vip">';}else{
                                        echo '<img src="img/ico/empty.png" title="vip" alt="vip">';
                                    }
                                  ?>
                                </div>
                                <div class="mask" title="VIP">&nbsp;</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="trnt-block mb2">
  <div class="wrap1">
    <div class="wrap2">
      <div class="wrap3">
        <div class="wrap4">
          <div class="wrap5">
            <div class="wrap6">
              <div class="wrap7">
                <div class="wrap8">
                  <div class="wrap-content-mini">
                    <div class="mt5 mb5 small green1 cntr">
                      <img class="vb pb2" height="14" width="14" src="img/ico/starFull.png"> Танковая мощь: сумма всех параметров танка
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
</div>

<? }else{ ?>
    <table>
  <tbody>
    <tr>
      <td class="w50 p1">
        <div style="position:relative;">
          <a class="simple-but border mb5" w:id="mailLink" href="pm"><span><span>Почта</span></span></a>
        </div>
      </td>
      <td class="w50 p1">
        <div style="position:relative;">
          <a class="simple-but border mb5" w:id="trofiesLink" href="../trofies"><span><span>Трофеи</span></span></a>
        </div>
      </td>
    </tr>
  </tbody>
</table>

<table class="prf-btns esmall bold">
  <tbody>
    <tr>
      <td>
        <a class="white" w:id="trainingLink" href="training">
            <img class="thumb" src="img/PMain/training.jpg">Тренировка
        </a>
      </td>
      <td>
        <a class="white" w:id="skillsLink" href="skills">
            <img class="thumb" src="img/PMain/abilities.png">Умения
        </a>
        <div style="position:relative;">
          <span class="digit3">
            <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
          </span>
        </div>
      </td>
      <td>
        <a class="white" w:id="crewLink" href="../crew/">
            <img class="thumb" src="img/PMain/crew.png">Экипаж
        </a>
      </td>
    </tr>
    <tr>
      <td>
        <a class="white" w:id="coinsLink" href="../coins/">
          <img class="thumb" src="img/PMain/collections.png">Коллекции
        </a>
      </td>
      <td>
        <a class = "white" w:id="premiumLink" href="vip">
          <img class="thumb" src="img/PMain/premium.jpg">Усиления
        </a>
      </td>
      <td>
        <a class="white" w:id="shellSkillsLink" href="../shellskills/">
          <img class="thumb" src="img/PMain/shellSkills.jpg">Навыки
        </a>
      </td>
    </tr>
    <tr>
      <td>
        <a class="white" w:id="achLink" href="../achs/">
          <img class="thumb" src="img/PMain/ach.png">Подвиги
        </a>
      </td>
      <td>
        <a class="white" w:id="honorsLink" href="../honors/">
          <img class="thumb" src="img/PMain/honors.png">Ордена
        </a>
      </td>
      <td>
        <a class="white" w:id="abilitiesLink" href="../abilities/">
          <img class="thumb" src="img/PMain/abilities.png">Способности
        </a>
        <div style="position:relative;">
          <span class="digit3">
            <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
          </span>
        </div>
      </td>
    </tr>
  </tbody>
</table>


<? } 
require_once 'system/footer.php';
?>