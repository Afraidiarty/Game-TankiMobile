<?
require_once 'system/header.php';

$q = "SELECT * FROM `quest` ORDER BY `id` ASC";
$result = mysqli_query($connect, $q);


$query_user_builds = "SELECT * FROM `buildings_user` WHERE id_user = '$myID' AND id_buildings = 2";
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

if ($result) {
    $insert_query = "INSERT INTO `quest_user` (`id`, `id_quest`, `id_user`, `koll`, `last`, `max_koll`) VALUES (?, ?, ?, ?, ?, ?)";
    $insert_statement = mysqli_prepare($connect, $insert_query);
    $ProtectedID_query = "SELECT `id_user` FROM `quest_user` WHERE `id_user` = '$myID'";
    $ProtectedResult = mysqli_query($connect, $ProtectedID_query);
    
    if ($insert_statement) {
        while ($p = mysqli_fetch_assoc($result)) {
            if(!mysqli_num_rows($ProtectedResult) > 0){
                $id_quest = $p['id'];
                $id_user = $myID;
                $koll = 0;
                $last = 0;
                $max_koll = $p['koll'];
                mysqli_stmt_bind_param($insert_statement, 'iiiiii', $id, $id_quest, $id_user, $koll, $last, $max_koll);
                
                mysqli_stmt_execute($insert_statement);
            }
        }
        

        mysqli_stmt_close($insert_statement);
    } else {
        echo "Failed to prepare INSERT statement: " . mysqli_error($connect);
    }

    mysqli_free_result($result);
} else {
    echo "Failed to execute SELECT query: " . mysqli_error($connect);
}

$query = "SELECT * FROM `up_tank`";
$result = mysqli_query($connect, $query);
if ($result) {
    $insert_query = "INSERT INTO `up_tank` (`id`, `id_user`, `attack_up`, `armor_up`, `accuracy_up`, `health_up`, `max_up`) VALUES (?,?,?,?,?,?,?)"; // Fix the INSERT query
    $insert_statement = mysqli_prepare($connect, $insert_query);

    $protectedID_query = "SELECT `id_user` FROM `up_tank` WHERE `id_user` = ?";
    $protected_statement = mysqli_prepare($connect, $protectedID_query);
    mysqli_stmt_bind_param($protected_statement, 'i', $myID);
    mysqli_stmt_execute($protected_statement);
    mysqli_stmt_store_result($protected_statement);

    if ($insert_statement) {
        if (mysqli_stmt_num_rows($protected_statement) == 0) { 
            $id_user = $myID;
            $attack_up = 0;
            $armor_up = 0;
            $accuracy_up = 0;
            $health_up = 0;
            $max_up = 400;
            mysqli_stmt_bind_param($insert_statement, 'iiiiiii', $id, $id_user, $attack_up, $armor_up, $accuracy_up, $health_up, $max_up);
            mysqli_stmt_execute($insert_statement);
        }
    }

    mysqli_stmt_close($protected_statement);
}

$query = "SELECT * FROM `improvement`";
$result = mysqli_query($connect, $query);
if ($result) {
    $insert_query = "INSERT INTO `improvement` (`id`, `id_user`, `attack_up`, `armor_up`, `accuracy_up`, `health_up`, `max_up`) VALUES (?,?,?,?,?,?,?)"; // Fix the INSERT query
    $insert_statement = mysqli_prepare($connect, $insert_query);

    $protectedID_query = "SELECT `id_user` FROM `improvement` WHERE `id_user` = ?";
    $protected_statement = mysqli_prepare($connect, $protectedID_query);
    mysqli_stmt_bind_param($protected_statement, 'i', $myID);
    mysqli_stmt_execute($protected_statement);
    mysqli_stmt_store_result($protected_statement);

    if ($insert_statement) {
        if (mysqli_stmt_num_rows($protected_statement) == 0) { 
            $id_user = $myID;
            $attack_up = 0;
            $armor_up = 0;
            $accuracy_up = 0;
            $health_up = 0;
            $max_up = 800;
            mysqli_stmt_bind_param($insert_statement, 'iiiiiii', $id, $id_user, $attack_up, $armor_up, $accuracy_up, $health_up, $max_up);
            mysqli_stmt_execute($insert_statement);
        }
    }

    mysqli_stmt_close($protected_statement);
}




$query = "SELECT * FROM `mail` WHERE id_recipient = '$myID' and mail_read = 1";
$result = mysqli_query($connect,$query);

if(mysqli_num_rows($result) > 0){    
echo '<div class="small white sh_b bold cntr mb5 pt5">
<img class="vb" src="img/ico/viewTimeline.png"> <a w:id="mailLink" href="pm"><span class="yellow1 td_u">Новая почта</span></a><br>
</div>';
}

?>
<div class="trnt-block">
    <div class="wrap1">
        <div class="wrap2">
            <div class="wrap3">
                <div class="wrap4">
                    <div class="wrap5">
                        <div class="wrap6">
                            <div class="wrap7">
                                <div class="wrap8">
                                    <div class="wrap-content custombg angar_1">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="small white bold sh_b w100">
                                                        <img width="14" height="14" src="img/ico/attack.png" alt="Атака" title="Атака"> Атака <span class="green2"><? echo $users['attach'] ?></span><br>
                                                        <img width="14" height="14" src="img/ico/armor.png" alt="Броня" title="Броня"> Броня <span class="green2"><? echo $users['armor'] ?></span><br>
                                                        <img width="14" height="14" src="img/ico/accuracy.png" alt="Точность" title="Точность"> Точность <span class="green2"><? echo $users['accuracy'] ?></span><br>
                                                        <img width="14" height="14" src="img/ico/durability.png" alt="Прочность" title="Прочность"> Прочность <span class="green2"><? echo $users['health'] ?></span><br>
                                                    </td>
                                                    <td class="ta_r cntr">
                                                        <a class="inbl thumb" href="profile">
                                                            <img alt="avatar" src="<? echo $users['prifle-photo'] ?>">
                                                            <span class="mask1">&nbsp;</span>
                                                            <span class="digit esmall">
                                                                <span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span>
                                                            </span>
                                                        </a>
                                                        <div class="clrb"></div>
                                                        <a class="lh1 blck small sh_b" href="profile">Профиль</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="cntr">
                                            <img src="<?php echo $users['img']; ?>" alt="">
                                        </div>
                                        <div class="cntr small bold mb2 pb0">
                                            <img src="img/ico/power.png" height="14" width="14">
                                            <span class="green2">Танковая мощь: <? echo $users['attach']+$users['armor']+$users['accuracy']+$users['health']?></span>
                                        </div>
                                        <div class="bot a_w200px">
                                            <a class="simple-but border" href="power?id=<?php echo $users['id']; ?>">
                                                <span><span>Повысить параметры</span></span>
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
                                        if ($time_pol_1 > 0){echo '<img src="img/polygon_level/attack'.$polygonLevel.'.png" title="attack" alt="attack">';}else{
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
                                    if ($time_pol_2 > 0){echo '<img src="img/polygon_level/armor'.$polygonLevel.'.png" title="armor" alt="armor">';}else{
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
                                    if ($time_pol_3 > 0){echo '<img src="img/polygon_level/accuracy'.$polygonLevel.'.png" title="accuracy" alt="accuracy">';}else{
                                        echo '<img src="img/ico/empty.png" title="accuracy" alt="accuracy">';
                                    }
                                ?>                                </div>
                                <div class="mask" title="Точность">&nbsp;</div>
                            </div>
                        </td>
                        <td>
                            <div class="image">
                                <div class="in">                                
                                <?
                                    if ($time_pol_4 > 0){echo '<img src="img/polygon_level/durability'.$polygonLevel.'.png" title="health" alt="health">';}else{
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
                                    if ($remaining_time > 0){echo '<img src="img/polygon_level/vip.png" title="vip" alt="vip">';}else{
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
<div class="brunches-block">
    <table>
        <tbody>
            <tr>
                <td>
                    <a href="payments">
                        <span class="image">
                            <img src="img/for-ang/payment.png">
                            <span class="mask">&nbsp;</span>
                        </span>
                        Золото
                    </a>
                </td>
                <td>
                    <a href="missions">
                        <span class="image">
                            <img src="img/for-ang/missions.png">
                            <span class="mask">&nbsp;</span>
                            <span class="digit">
                                <?
                                    $query_user_quest = "SELECT * FROM `quest_user` WHERE `id_user` = '$myID'";
                                    $quest_user_result = mysqli_query($connect, $query_user_quest);
                                    while($quest = mysqli_fetch_assoc($quest_user_result)){
                                        if($quest['koll'] >= $quest['max_koll']){
                                            echo '<span class="l">&nbsp;</span>';
                                            echo '<span class="m">+</span>';
                                            echo '<span class="r">&nbsp;</span>';
                                            break;
                                        }
                                    } 
                                ?>
                               
                            </span>
                        </span>
                        Миссии
                    </a>
                </td>
                <td>
                    <a href="pvp">
                        <span class="image">
                                <img src="img/for-ang/pvp.png">
                            <span class="mask">&nbsp;</span>
                        </span>
                        Битвы
                    </a>
                </td>
                <td>
                    <a href="pve">
                        <span class="image">
                            <img src="img/for-ang/pve.png">
                            <span class="mask">&nbsp;</span>
                        </span>
                        Сражения
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="newstore-<?echo $nation['Country']?>">
                        <span class="image">
                            <img src="img/for-ang/tanksmagazine.png">
                            <span class="mask">&nbsp;</span>
                        </span>
                        Танки
                    </a>
                </td>
                <td>
                    <a href="rating">
                        <span class="image">
                            <img src="img/for-ang/rating.png">
                            <span class="mask">&nbsp;</span>
                        </span>
                        Рейтинг
                    </a>
                </td>
                <td>
                    <a href="cw">
                        <span class="image">
                            <img src="img/for-ang/cw.png">
                            <span class="mask">&nbsp;</span>
                        </span>
                        Война
                    </a>
                </td>
                <td>
                    <a href="dm">
                        <span class="image">
                            <img src="img/for-ang/dm.png">
                            <span class="mask">&nbsp;</span>
                        </span>
                        Схватка
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
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
                      Снаряды и ремкомплекты используются во время боя в битве и сражении
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




<?require_once 'system/footer.php';?>