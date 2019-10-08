<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 

/*$_POST['name'];
$_POST['email'];
$_POST['subject'];
$_POST['message'];*/

$sms = 'Имя: '.$_POST['name'].'</br>Почта: '.$_POST['email'].'</br>Тема: '.$_POST['subject'].'</br>Сообщение: </br>'.$_POST['message'].'</br>Форма обратной связи';

smtpmail('info@bionika-market.com',$sms);

function smtpmail($from,$body){

//require_once '/PHPMailer/PHPMailerAutoload.php';	
	
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
$mail->setFrom($from, 'Бионика Маркет');        

// Кому
$mail->addAddress($from, 'Пользователь');

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
