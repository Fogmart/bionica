<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
if($_SESSION['admin']!=1)
if($_SESSION['store']!=1)
exit;

if($_POST['sum']=="0"){$_POST['sum']=$_POST['wa'];}
foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>POST ".$key." = ".$value."</p>";} //все POST запросы

//echo $_POST['treck'];
//$_POST['id']; //банковской операции
//$_POST['email'];// емайл для корзины



/// 1- отправка трекера +2
/// 2- отправка письма +1
/// 3- запись в кассу+
/// 4- стереть банк+
/// 4-1 - Вычесть товар 
/// 5- маскировка корзины if($user_res['check']!="ok")+



//MAILLL
smtpmail($_POST['email'],$_POST['sum'],$_POST['treck']);
/////////////////////////////////////////////////////////////////////

//// Запись в кассу /////////////////////////////////////////////	

if($_POST['sum'])
if($_POST['pm'])
if($_POST['name'])
if($_POST['email'])
if($_POST['becose'])
if($_POST['email_admin']==$_SESSION['email'])
if($_SESSION['admin']=="1" || $_SESSION['store']=="1" || $_SESSION['direct']=="1" )//проверка админа
{
	if(!(isset($_POST['from']))){$_POST['from']="Покупка";}


		
/// внос в базу кассы
if($_POST['pm']=="p"){$_POST['pm']="+";}
if($_POST['pm']=="m"){$_POST['pm']="-";}

$mysqli->query("
INSERT INTO `kassa`
( `sum`, `pm`, `from`, `name`, `email`, `becose`,`email_admin`) 
VALUES 
('".$_POST['sum']."','".$_POST['pm']."','".$_POST['from']."','".$_POST['name']."','".$_POST['email']."','".$_POST['becose']."','".$_SESSION['email']."');
");	

}
else exit;	

/////////////////////////////////////////////////////////////////////
//// стереть банк ордер /////////////////////////////////////////////

				$sql = 'SELECT * FROM `orders` WHERE `label`="'.$_POST['email'].'";'; 

				$data = $mysqli->query($sql);
				
				
					if($row = $data->num_rows)
					{
					while($res  = $data ->fetch_assoc()){
						$mysqli->query("
										UPDATE `orders` 
										SET 
											`user_check`='ok'
										WHERE `id`=".$res['id'].";
						");
					}
					}


				
				
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

							$mysqli->query(" UPDATE `tovar` SET `bron`=`bron`-".$res['kolvo']." WHERE `art`=".$res['art']."; 	");
							

							}
						}	

								
									
								
								
										
					}
					}
			
		
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////	
//// маскировка карзины /////////////////////////////////////////////

				$sql = 'SELECT * FROM `shopping` WHERE `email`="'.$_POST['email'].'" and `check`="no";'; 

				$data = $mysqli->query($sql);
				
				
					if($row = $data->num_rows)
					{
					while($res  = $data ->fetch_assoc()){
						$mysqli->query("
						UPDATE `shopping` 
						SET 
							`check`='ok'
						WHERE `id`=".$res['id'].";");
					}
					}


function smtpmail($from,$sum_all,$track){


	
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
        <td style="width:65px;">1</td>
        <td style="width:41px;">1</td>
        <td style="width:120px;"> Покупка </td>
        <td style="width:52px;">|'.$sum_all.'</td>
    </tr>

	
	

	<tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="font-size:18px;">итог : '.$sum_all.'</td>
    </tr>

</tbody></table></div>';









$mail->msgHTML($body);

// Приложение
//$mail->addAttachment(__DIR__ . '/image.jpg');

$mail->send();
}

echo "<script>alert('Уведомление на почту отправлено');</script>";
echo "<script>window.location.href=window.location.href;</script>";