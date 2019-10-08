<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
if($_SESSION['admin']!=1)
if($_SESSION['store']!=1)
exit;
//foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>POST ".$key." = ".$value."</p>";} //все POST запросы

//echo $_POST['treck'];
//$_POST['id']; //банковской операции
//$_POST['email'];// емайл для корзины



/// 1- отправка трекера +2
/// 2- отправка письма +1
/// 3- запись в кассу+
/// 4- стереть банк+
/// 4-1 - Вычесть товар 
/// 5- маскировка корзины if($user_res['check']!="ok")+

//// трекер почта /////////////////////////////////////////////
$mysqli->query("
				UPDATE `users` 
				SET 
					`N_session`='".$_POST['treck']."'
				WHERE `email`=".$_POST['email'].";
");

//MAILLL
smtpmail($_POST['email'],$_POST['treck']);
/////////////////////////////////////////////////////////////////////

				
/////////////////////////////////////////////////////////////////////	
//// Вычесть товар /////////////////////////////////////////////			
			
				$sql = 'SELECT * FROM `shopping` WHERE `email`="'.$_POST['email'].'" and `check`="no";'; 

				$data = $mysqli->query($sql);
				
				
					if($row = $data->num_rows)
					{
					while($res  = $data ->fetch_assoc()){
					
						$res['kolvo'];
						$res['art'];
						
						if($res['art']!=0)
						{
							if($res['zakaz']=="no"){	

							$mysqli->query(" UPDATE `tovar` SET `bron`=`bron`+".$res['kolvo'].",`dost`=`dost`-".$res['kolvo']." WHERE `art`=".$res['art']."; 	");
							

							}
						}	

								
									
								
								
										
					}
					}

/////////////////////////////////////////////////////////////////////



function smtpmail($from,$track){


	
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
$mail->addAddress($from, 'Пользователь');

// Тема письма
$subject = "Бионика Маркет"; // Заголовок письма
$mail->Subject = $subject;

// Тело письма
//$body = '<p><strong>«Hello, world!» </strong></p>';
$body = '
<div style="max-width: 415px;position: relative;float: left;">
<table style="margin: 20px;box-shadow:7px 11px 21px 0px rgba(0,0,0,0.03);min-width:375px; max-width:376px; border: 0px solid red;font-family: \'Courier New\', arial;font-size: 12px;text-transform: uppercase;vertical-align: top; border-collapse:separate;border-spacing: 0;background:#fff;padding: 10px;">

    <tbody><tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="font-size:18px; text-align:center;">бионика маркет</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">почта : info@bionika-market.com</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">почта : '.$from.'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td style="width:65px;">АРТИК.|</td>
        <td style="width:41px;">КОЛ |</td>
        <td style="width:120px;">НАИМЕНОВАНИЕ</td>
        <td style="width:52px;">|</td>
    </tr>

	<tr style="word-break: break-all;color:#0f0d72;">
        <td style="width:65px;">2</td>
        <td style="width:41px;"> Трек </td>
        <td style="width:120px;">'.$_POST['treck'].'</td>
        <td style="width:52px;">|</td>
    </tr>
	
	

	<tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>

</tbody></table></div>';









$mail->msgHTML($body);

// Приложение
//$mail->addAttachment(__DIR__ . '/image.jpg');

$mail->send();
}

echo "<script>alert('Уведомление на почту отправлено');</script>";
echo "<script>window.location.href=window.location.href;</script>";