<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 

/*$_POST['name'];
$_POST['email'];
$_POST['subject'];
$_POST['message'];*/

$sms = 'Имя: Интересен сайт</br>Почта: '.$_POST['email'].'</br>Тема: Интересен сайт</br>Сообщение: </br>'.$_POST['email'].'</br>Интересен сайт';

smtpmail('bionika-market@mail.ru',$sms);

function smtpmail($from,$body){

//require_once '/PHPMailer/PHPMailerAutoload.php';	
	
$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';

// Настройки SMTP
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;

$mail->Host = 'ssl://smtp.mail.ru';
$mail->Port = 465;
$mail->Username = 'bionika-market@mail.ru';
$mail->Password = '2015club!!!';

// От кого
$mail->setFrom($from, 'Бионика Маркет');        

// Кому
$mail->addAddress('adideas@mail.ru', 'Пользователь');

// Тема письма
$subject = "Бионика Маркет"; // Заголовок письма
$mail->Subject = $subject;

// Тело письма
//$body = '<p><strong>«Hello, world!» </strong></p>';

$mail->msgHTML($body);

// Приложение
//$mail->addAttachment(__DIR__ . '/image.jpg');

$mail->send();
}
echo "<script>location.href=location.origin;</script>";