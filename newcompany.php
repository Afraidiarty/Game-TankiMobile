<?
require_once 'system/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" and $users['id_clan'] == 0 and !empty($_POST["company"])){
    if($users['gold'] >= 1){
        $companyCreate = $_POST["company"];
        $query = "INSERT INTO `clan` SET `name` = ? , `side` = ?, `info` = ?";
        $stmt = $connect->prepare($query);
        $side = $users['side'];
        
        if ($stmt) {
            $stmt->bind_param("sss", $companyCreate, $side, $info);
            $info = "";
        
            if ($stmt->execute()) {
                $id_clan = $stmt->insert_id;
                $stmt->close();
                // header("Location: company");
            } else {
                echo $stmt->error;
            }
        }
        $query = "UPDATE `users` SET `id_clan` = ? , `clan_rang` = ?, `gold` = `gold` - 2500 WHERE id = '$myID'";
        $stmt = $connect->prepare($query);
        if ($stmt) {
            $stmt->bind_param("ii", $id_clan, $clan_rang);
            $clan_rang = 6;
            if(!$stmt->execute()){
                echo $stmt->error;
            }
            $stmt->close();
          header("Location: company");
        }
    }
}

echo '<div class="trnt-block" style="margin-bottom:25px;">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="cntr white sh_b bold small pb10">
Введите название дивизии:<br>
<form w:id="company" id="id1" method="post" action="">
<input id="name" type="text" name="company" value="" class="fld-chng" size="20" maxlength="32"><br><br>
Цена: <span class="nwr">
<img class="ico vm" src="img/ico/gold.png?2" alt="Золото" title="Золото"> 2500
 золота</span>
</div>
<div class="bot">
<span class="input-but border"><span><input class="w100" type="submit" w:message="company" value="Создать"></span></span>
</form>
</div>  
</div>
</div></div></div></div></div></div></div></div>
</div>';

require_once 'system/footer.php';
?>