<?
require_once 'system/core.php';

if(isset($_GET['id_top'])){
    $id = $id = $_GET['id_top'];
}
$query = "SELECT * FROM `forum` WHERE id = '$id'";
$result = mysqli_query($connect,$query);
$currForum = mysqli_fetch_assoc($result);

echo '<div class="medium white bold cntr mt5 mb10">Редактирование топика</div>';



echo '<div class="mb5" style ="text-align:left;">
<img width="16" height="16" src="images/forum_main.png"> <a class="medium white" href="forum">Форум</a> / <a class="white" href="forum?id='. $currForum['id']  .'">'. $currForum['name'] .'</a>
</div>';

echo '<div class="dhr mt10 mb5"></div>';

echo '<div class="p5 cntr medium white">
<form w:id="newTopicForm" id="id1" method="post" action="ProcessCreate?id='. $currForum['id'] .'"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id1_hf_0" id="id1_hf_0"></div>
Заголовок<br>
<input w:id="subject" type="text" name="subject" value="" class="fld-chng w98" size="20" maxlength="50" id="id3"><br>
Сообщение<br>
<textarea class="w98 mb5 wfield" rows="5" name="message" w:id="message"></textarea><br>
<span class="input-but border w50 mXa mb5"><span><input class="w100" type="submit" w:message="value:CreateTopicPage.form.submit" value="Создать"></span></span>
</form>
</div>';

require_once 'system/footer.php';
?>