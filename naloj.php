<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 


							
$sum_all=0;
$sql2 = 'SELECT * FROM `shopping` WHERE `email` ="'. $_SESSION['email'] .'" and `check`="no";';	
		$data = $mysqli->query($sql2);
		$row = $data->num_rows;
		while($res = $data->fetch_assoc())
		{
		$sum_prom= (int)$res['kolvo']*(int)$res['sum_p'];
		$sum_all+=$sum_prom;
		
		}							
				

$sql = 'SELECT * FROM `orders` WHERE  `label` LIKE  "%'.$_SESSION['email'].'%" and `user_check`="no"';
$bank = $mysqli->query($sql);
$bank_row = $bank->num_rows;
if($bank_row>0){ 
echo "<script>alert('Ваша предидущая заявка еще не рассмотрена!!'); location.href=location.origin;</script>";
exit();}

	$mysqli->query('
	INSERT INTO `orders`(`label`, `notification_type`, `amount`, `withdraw_amount`,`test_notification`, `check`,`user_check`) 
	VALUES ("'.$_SESSION['email'].'","Наложенный платеж","0","'.$sum_all.'","Наложенный платеж","Failed","no")
	');
							
							$dede='"color:#e91e63;"';
							
							$mysqli->query("
							INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`) 
							VALUES ('<font style=".$dede.">Наложенный платеж [".$_SESSION['email']."]</font>','no','1','0','0','1');
							"); 
							$mysqli->query("
							INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`) 
							VALUES ('<font style=".$dede.">Новый заказ [".$_SESSION['email']."]</font>','Modules/checkcall.php?email=".$_SESSION['email']."','0','0','0','1');
							");
	SMSuser();
	SMSadmin();

function SMSadmin()
{
$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';

// Настройки SMTP
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;

$mail->Host = 'ssl://server38.hosting.reg.ru';
$mail->Port = 465;
$mail->Username = 'info@bionika-market.com';
$mail->Password = '2015club!!!';

// От кого
$mail->setFrom('info@bionika-market.com', 'Бионика Маркет');        

// Кому
$mail->addAddress('info@bionika-market.com', 'Пользователь');

// Тема письма
$subject = "Бионика Маркет"; // Заголовок письма
$mail->Subject = $subject;

// Тело письма
//$body = '<p><strong>«Hello, world!» </strong></p>';
$body = 'Новая оплата на сумму '.$sum_all.' рублей.</br>ОТ: '.$label.'</br>Проверте заявки.';

$mail->msgHTML($body);

// Приложение
//$mail->addAttachment(__DIR__ . '/image.jpg');

$mail->send();
}

//////////////////////////////////////////////////////////////////////////////

function SMSuser()
{
$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';

// Настройки SMTP
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;

$mail->Host = 'ssl://server38.hosting.reg.ru';
$mail->Port = 465;
$mail->Username = 'info@bionika-market.com';
$mail->Password = '2015club!!!';

// От кого
$mail->setFrom('info@bionika-market.com', 'Бионика Маркет');        

// Кому
$mail->addAddress($_SESSION['email'], 'Пользователь');

// Тема письма
$subject = "Бионика Маркет"; // Заголовок письма
$mail->Subject = $subject;

// Тело письма
//$body = '<p><strong>«Hello, world!» </strong></p>';
$body = 'С вами свяжеться наш специалист.</br>Или Вы можете связаться с нами на сайте.</br><a href="https://bionika-market.com">Бионика Маркет</a>';

$mail->msgHTML($body);

// Приложение
//$mail->addAttachment(__DIR__ . '/image.jpg');

$mail->send();	
}	
echo "<script>alert('Ваша заявка принята'); location.href=location.origin;</script>";
?>