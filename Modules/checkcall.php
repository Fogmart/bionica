<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
if($_SESSION['admin']!=1)
if($_SESSION['store']!=1)
if($_SESSION['direct']!=1)	
if($_SESSION['call']!=1)	
exit;


$_GET['email'];
$_GET['noty'];

	$sql = 'SELECT * FROM `shopping` 
		WHERE 
		`email` ="'. $_GET['email'] .'" 
		;';
		$data = $mysqli->query($sql);
		if($row = $data->num_rows)$res = $data->fetch_assoc();

if(!(isset($_GET['q']))){$_GET['q']='1';}
if($_GET['q']==''){$_GET['q']='1';}

//foreach ($_GET as $key => $value) {$add[$key] = $value;  echo "<p>GET ".$key." = ".$value."</p>";} 
//foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>POST ".$key." = ".$value."</p>";} 

if(isset($_GET['rename']))
{
$mysqli->query(" UPDATE `shopping` SET `fio` = '".$_GET['rename']."' WHERE `email`='".$_GET['email']."'");	
//echo " UPDATE `shopping` SET `fio` = '".$_GET['rename']."' WHERE `email`=".$_GET['email']."";
}

if(isset($_GET['readres']))
{
$mysqli->query(" UPDATE `shopping` SET `full_adres` = '".$_GET['readres']."' WHERE `email`='".$_GET['email']."'");	
//echo " UPDATE `shopping` SET `full_adres` = '".$_GET['readres']."' WHERE `email`=".$_GET['email']."";
}

if($_GET['q']=="100")
{
$mysqli->query(" UPDATE `shopping` SET `checkcall` = 'yes' WHERE `email`='".$_GET['email']."'");
		
//echo " UPDATE `shopping` SET `checkcall` = 'yes' WHERE `email`=".$_GET['email']."";

							$mysqli->query("DELETE FROM `notifications` WHERE `url` LIKE '%".$_GET['email']."%' AND `admin`='0' AND `store`='0' AND `direct`='0' AND `call`='1';");

							$mysqli->query("
							INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`) 
							VALUES ('Специолистом колл центра подтверджен заказ [".$res['fio']." -> ".$res['tel']."]','no','0','0','1','0');
							"); 

							$mysqli->query("
							INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`,`OrderDate`) 
							VALUES ('Проверить доставку [".$res['fio']." -> ".$res['tel']."]','no','0','0','1','0','".date('Y-m-d H:i:s', strtotime(date("Y-m-d  H:i:s").' +60 day'))."');
							"); 
//echo "<script>window.close();</script>";
}

$q[100]='Конец! Положить трубку!';
$q[101]='Конец! Положить трубку!';

$q[0]="Можете его позвать?";

$yes[0]='1';
$no[0]='9';

$q[1]='<h1>Номер телефона: '.$res['tel'].'</h1></br></br></br></br><b>Здравствуйте)!</b></br></br> Я оператор интернет магазина «Бионика Маркет». </br></br>
<b>Вам удобно сейчас разговаривать?</b>';

$yes[1]='2';
$no[1]='8';

$q[2]='Знаете… На нашем сайте был оформлен заказ на имя </br></br> <b>«'.$res['fio'].'».</b> </br></br> Это вы?';

$yes[2]='3';
$no[2]='0';

$q[3]='Я звоню вам, что бы проверить правильность заказа.</br>
</br> Мною будут заданы <b>2(два)</b> простых, <b>НО</b> конфиденциальных вопроса.</br>
</br> Это необходимо, что бы ваш заказ был правильно доставлен.))</br>
</br><b>Вы готовы?</b>';

$yes[3]='4';
$no[3]='8';

$q[4]='1) Вас зовут <b>«'.$res['fio'].'»?</b>';

$yes[4]='5';
$no[4]='10';


$q[5]='2) Вами был указан следующий адрес доставки:</br></br>
<b>«'.$res['full_adres'].'» </b></br></br><b>верно?</b>';

$yes[5]='7';
$no[5]='11';


$q[7]='<b>Благодарим вас за содействие.</b></br></br><b> Ваш заказ в скором времени будет отправлен. </br></br>С наилудшими пожеланиями «Бионика маркет»</b>';

$yes[7]='100';
$no[7]='1';

$q[8]='<b>Понял(а).. </b></br></br>мы перезвоним <b>вам</b> позже</br></br> или вы можете сделать это самостоятельно </br></br>через <b>наш</b> сайт.  </br></br>С наилудшими пожеланиями «Бионика маркет»';

$yes[8]='101';
$no[8]='1';

$q[9]='<b>Понял(а).. </b></br></br> <b>Извините..</b></br></br> Если ошибка была на нашей стороне мы обязательно с ней разберемся.</br></br> А вам <b>всего хорошего и досвидания).</b>';

$yes[9]='101';
$no[9]='1';

$q[10]='<b>Пожалуйста</b></br></br> продиктуйте правильно <u>Фамилию Имя Отчество</u> ). </br></br>Это необходимо для того, что бы вы смогли забрать посылку.</br></br><input type="text" name="rename" value="'.$res['fio'].'">';

$yes[10]='5';
$no[10]='8';

$q[11]='<b>Пожалуйста</b></br></br> продиктуйте правильно Адрес). </br></br>Это необходимо для того, что бы посылка пришла по вашему адресу.</br></br> <input type="text" name="readres" value="'.$res['full_adres'].'">';

$yes[11]='7';
$no[11]='8';


if($_GET['q']=="100"){exit;}
if($_GET['q']=="101"){exit;}
echo '<form method="GET" style="text-align:center;">';
echo $q[$_GET['q']];

echo "</br><input style='display:none;' type='email' name='email' value='".$_GET['email']."'/>";
echo '</br><label style="border:1px solid black; margin:4px; background:#83ff81;padding: 4px;" for="yes"><input id="yes" style="display:none;" type="submit" name="q" value="'.$yes[$_GET['q']].'">ДА</label>';
echo '<label style="border:1px solid black; margin:4px; background:#ff81ac; padding: 4px;" for="no"><input id="no" style="display:none;" type="submit" name="q" value="'.$no[$_GET['q']].'">НЕТ</label>';
echo '</form>';

?>