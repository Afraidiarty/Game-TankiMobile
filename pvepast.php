<?
require_once 'system/header.php';

        # Условия конца сражения и вывод наград:
        
        $query_combined = "SELECT * FROM `battle_wins` ORDER BY `uron` DESC, `kills` DESC";
        $result_combined = mysqli_query($connect, $query_combined);
        

        $query = "SELECT * FROM `battle_wins` LIMIT 1";
        $result = mysqli_query($connect,$query);
        $curr = mysqli_fetch_assoc($result);

        $query_closes_battle = "SELECT * FROM `battles` WHERE battle_id = {$curr['battle_id']}";
        $result_closes_battle = mysqli_query($connect,$query_closes_battle);
        $closest_battle = mysqli_fetch_assoc($result_closes_battle);


       $query_info_pve = "SELECT * FROM `info_pve` WHERE battle_id = {$closest_battle['battle_id']}";
       $result_info_pve = mysqli_query($connect,$query_info_pve);
       $info_pve = mysqli_fetch_assoc($result_info_pve);

        echo '<div class="trnt-block mb5">
        <div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
        <div class="wrap-content">
        
        <div class="mb5 inbl" style="text-align: left;margin-right: 30%;">
        <div class="thumb fl"><img src="img/battles/'.$closest_battle['img'].'"><span class="mask2">&nbsp;</span></div>
        <div class="ml58 small white sh_b bold">
        <span class="green2">'.$closest_battle['name'].'</span><br>
        <span>
        <span>закончилась 01:33:48 назад</span>
        </span><br>
        <span class="gray1">'.$closest_battle['type'].'</span>
        </div>
        <div class="clrb"></div>
        </div>
        
        <div class="small bold cntr gray1 sh_b mt2">';
        
        
        if($teams > 0){
           echo '<span class="green1">Победу одержали союзники!</span><br><span class="gray1">Все враги убиты</span>';
        }else{
            echo '<span class="red1">Победу одержали враги!</span><br><span class="gray1">Все союзники убиты</span>';
        }
        
        echo '<div class="white">
        <br>
        <span class="green2">Лучшие по убийствам</span><br>';
       
        $count = 0;
    
        while ($uron = mysqli_fetch_assoc($result_combined)) {
            $query_users_winners = "SELECT * FROM `users` WHERE id = '{$uron['id_user']}'";
            $result_users_winners = mysqli_query($connect, $query_users_winners);
            $users_winners = mysqli_fetch_assoc($result_users_winners);
        
            echo '<a href="profile?id=' . $users_winners['id'] . '">
                    <img class="vb" height="14" width="14" src="img/rankets/' . $users_winners['side'] . '/' . $users_winners['rang'] . '.png?1">
                    <span class="yellow1">' . $users_winners['nick'] . '</span></a>: ' . $uron['kills'] . ' врагов<br>';
        
            $count++;
        
            if ($count == 3) {
                break;
            }
        }
        
        // Reset the pointer to the beginning of the result set
        mysqli_data_seek($result_combined, 0);
        
        echo '<br>
        <span class="green2">Лучшие по урону</span><br>';
        
        $count = 0;
    
        while ($kills = mysqli_fetch_assoc($result_combined)) {
            $query_users_winners = "SELECT * FROM `users` WHERE id = '{$kills['id_user']}'";
            $result_users_winners = mysqli_query($connect,$query_users_winners);
            $users_winners = mysqli_fetch_assoc($result_users_winners);
    
            echo '<a href="profile?id='.$users_winners['id'].'">
                <img class="vb" height="14" width="14" src="img/rankets/'.$users_winners['side'].'/'.$users_winners['rang'].'.png?1">
                <span class="yellow1">' . $users_winners['nick'] . '</span></a>: ' . $kills['uron'] . ' Урона<br>';
        
            $count++;
        
            if ($count == 3) {
                break;
            }
        }
        
        
        echo '</div>
        <br>
        В битве сражались:<br>
        Танки: <span class="green1">'.$info_pve['TeamsWas'].'</span> | Враги: <span class="red1">'.$info_pve['EnemiesWas'].'</span><br>
        Выжили:<br>
        Танки: <span class="green1">'.$info_pve['TeamsLive'].'</span> | Враги: <span class="red1">'.$info_pve['EnemiesLive'].'</span><br>
        </div>
        </div>
        </div></div></div></div></div></div></div></div>
        </div>';



require_once 'system/footer.php';
?>