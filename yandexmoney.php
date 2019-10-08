<?
require "connect.php";

				$sql = 'SELECT * FROM `bankyd` ORDER BY `id`';
							$bank = $mysqli->query($sql);
							if($bank_row = $bank->num_rows)$bank_res = $bank->fetch_assoc();
							
				

//$notification_secret = "".$bank_res["notification_secret"].""; //СЮДА ВСТАВИТЬ Секретный код выданый ВАМ ЯД
$notification_secret = "M6r+x+UD2Z52Y24OY3qPlBjE";

$notification_type = $_POST["notification_type"];
$operation_id = $_POST["operation_id"];
$amount = $_POST["amount"];
$withdraw_amount = $_POST["withdraw_amount"];
$currency = $_POST["currency"];
$datetime = $_POST["datetime"];
$sender = $_POST["sender"];
$codepro = $_POST["codepro"];
$label = $_POST["label"];
$sha1_hash = $_POST["sha1_hash"];
$test_notification = $_POST["test_notification"];

$hash = $notification_type . '&' . $operation_id . '&' . $amount . '&' . $currency . '&' . $datetime . '&' . $sender . '&' . $codepro . '&' . $notification_secret . '&' . $label; //формируем хеш

$sha1 = hash("sha1", $hash); //кодируем в SHA1


if($operation_id!=NULL && $operation_id!="" && $operation_id!=" ")
{
	//yandex money
	//Ниже - проверка на валидность
	if ( $sha1 == $sha1_hash ) {
	echo 'Completed'; $check="Completed";
	} else {
	echo 'Failed'; $check="Failed";
	}

	// Ниже - отладка - запись в файл testlog.txt переданых данных с ЯД.
	if ( $sha1_hash!="" && $sha1_hash!=" " ) {	
	$mysqli->query('
	INSERT INTO `orders`(`label`, `notification_type`, `operation_id`, `amount`, `withdraw_amount`, `currency`, `datetime`, `sender`, `codepro`, `test_notification`, `sha1`, `sha1_hash`, `check`) 
	VALUES ("'.$label.'","'.$notification_type.'","'.$operation_id.'","'.$amount.'","'.$withdraw_amount.'","'.$currency.'","'.$datetime.'","'.$sender.'","'.$codepro.'","'.$test_notification.'","'.$sha1.'","'.$sha1_hash.'","'.$check.'")
	');
	$test_wr = fopen ('testlog.html', 'a+');
	fwrite ($test_wr, "<br><br>\r\n\r\n***YANDEX***<br>\r\n$check - проверка<br>\r\n$notification_type - тип нотификации<br>\r\n$operation_id - ид операции<br>\r\n$amount - зачислено<br>\r\n$withdraw_amount - сумма<br>\r\n$currency -Код валюты<br>\r\n$datetime - дата+время<br>\r\n$sender -отправитель<br>\r\n$codepro - наличие кода протекции<br>\r\n$label - метка платежа<br>\r\n$sha1_hash - переданый проверочный хеш<br>\r\n$sha1 - расчитаный хэш<br>\r\n$test_notification - тестовая нотификация\r\n");
	fclose ($test_wr);
	}
}
else
{
	
	
// payment_success.php 
  $paypalemail = "oswindows-facilitator@bk.ru";     // e-mail продавца 
  $adminemail  = "admin@email.com";  // e-mail  администратора 
  //$currency    = "USD";              // валюта 

  /******** 
  запрашиваем подтверждение транзакции 
  ********/ 
 $postdata=""; 
  foreach ($_POST as $key=>$value) $postdata.=$key."=".urlencode($value)."&"; 
  $postdata .= "cmd=_notify-validate"; 
  //$curl = curl_init("https://www.paypal.com/cgi-bin/webscr"); 
  $curl = curl_init("https://ipnpb.sandbox.paypal.com/cgi-bin/webscr"); 
  curl_setopt ($curl, CURLOPT_HEADER, 0); 
  curl_setopt ($curl, CURLOPT_POST, 1); 
  curl_setopt ($curl, CURLOPT_POSTFIELDS, $postdata); 
  curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0); 
  curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 1); 
  $response = curl_exec ($curl); 
  curl_close ($curl); 
  if ($response != "VERIFIED") die("You should not do that ..."); 

  /******** 
  проверяем получателя платежа и тип транзакции, и выходим, если не наш аккаунт 
  в $paypalemail - наш  primary e-mail, поэтому проверяем receiver_email 
  ********/ 
 /* if ($_POST['receiver_email'] != $paypalemail 
    || $_POST["txn_type"] != "web_accept") 
      die("You should not be here ..."); 
*/
  /* 
    здесь код, подключающийся к базе данных 
  */ 

  /******** 
    убедимся в том, что эта транзакция не 
    была обработана ранее  http://www.php.su/articles/?cat=others&page=005
  ********/ 
/*  $r = mysql_query("SELECT order_id FROM orders WHERE txn_id='".$_POST["txn_id"]."'"); 
  list($duplicate) = mysql_fetch_row($r); 
  mysql_free_result($r); 
  if ($duplicate) die ("I feel like I met you before ..."); */

	
/////////////////////////////////////////////////////////////////////////////////////////
$notification_type = $_POST["payment_type"];		
$operation_id = $_POST['txn_id'];
$datetime = $_POST['payment_date'];
$label = $_POST["item_number"];
$sender = $_POST["payer_email"];
if ($response == "VERIFIED"){$check = $_POST['payment_status'];}
$amount = $_POST['mc_gross']-$_POST['mc_fee'];
$withdraw_amount = $_POST['mc_gross'];
$currency = $_POST['mc_currency'];
$sha1_hash = $_POST["verify_sign"];
$sha1 = $_POST["verify_sign"];
$mysqli->query('
INSERT INTO `orders`(`label`, `notification_type`, `operation_id`, `amount`, `withdraw_amount`, `currency`, `datetime`, `sender`, `codepro`, `test_notification`, `sha1`, `sha1_hash`, `check`) 
VALUES ("'.$label.'","'.$notification_type.'","'.$operation_id.'","'.$amount.'","'.$withdraw_amount.'","'.$currency.'","'.$datetime.'","'.$sender.'","'.$codepro.'","'.$test_notification.'","'.$sha1.'","'.$sha1_hash.'","'.$check.'")
');
$test_wr = fopen ('testlog.html', 'a+');
	fwrite ($test_wr, "<br><br>\r\n\r\n***Paypal***$response<br>\r\n$check - проверка<br>\r\n$notification_type - тип нотификации<br>\r\n$operation_id - ид операции<br>\r\n$amount - зачислено<br>\r\n$withdraw_amount - сумма<br>\r\n$currency -Код валюты<br>\r\n$datetime - дата+время<br>\r\n$sender -отправитель<br>\r\n$codepro - наличие кода протекции<br>\r\n$label - метка платежа<br>\r\n$sha1_hash - переданый проверочный хеш<br>\r\n$sha1 - расчитаный хэш<br>\r\n$test_notification - тестовая нотификация\r\n");
	fclose ($test_wr);
}


?>
