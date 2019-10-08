<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 


$sql = 'SELECT * FROM `bankpp` ORDER BY `id`';
$bank = $mysqli->query($sql);
if($bank_row = $bank->num_rows)$bank_res = $bank->fetch_assoc();
							
$sum_all=0;
$sql2 = 'SELECT * FROM `shopping` WHERE `email` ="'. $_SESSION['email'] .'" and `check`="no" ;';	
		$data = $mysqli->query($sql2);
		$row = $data->num_rows;
		while($res = $data->fetch_assoc())
		{
		$sum_prom= (int)$res['kolvo']*(int)$res['sum_p'];
		$sum_all+=$sum_prom;
		}							
				
if($sum_all<2){$sum_all=1000;}
///получаем протокол
if (isset($_SERVER['HTTPS']))	$scheme = $_SERVER['HTTPS'];
else	$scheme = '';
if (($scheme) && ($scheme != 'off')) $scheme = 'https';
else $scheme = 'http';

$homeurl2=$scheme.'://'.$_SERVER['HTTP_HOST']."/";
$homeurl=$scheme.'://'.$_SERVER['HTTP_HOST']."/ipn.php";	
?>




<form method="post" id="go" action= "https://www.sandbox.paypal.com/cgi-bin/webscr"> <!--https://www.sandbox.paypal.com/cgi-bin/webscr-->
<input type="hidden" name="cmd" value="_xclick"> 
<input type="hidden" name="business" value="<?echo $bank_res['paypalemail'];?>"> <!--oswindows-facilitator@bk.ru-->
<input type="hidden" name="item_name" value="Заказ Бионика маркет"> 
<input type="hidden" name="item_number" value="<?echo $_SESSION['email'];?>"> <!--oswindows@bk.ru-->
<input type="hidden" name="amount" value="<?echo $sum_all?>"> <!--100-->
<input type="hidden" name="no_shipping" value="1"> 
<input type="hidden" name="return" value="<?echo $homeurl2;?>"> 
<input type="hidden" name="rm" value="2"> 
<input type="hidden" name="cancel_return" value="<?echo $homeurl2;?>"> 
<input type="hidden" name="notify_url" value="<?echo $homeurl;?>">
<input type="hidden" name="currency_code" value="RUB"> 
<input type="submit" value="Checkout"> 
</form> 
<script>//document.getElementById('go').submit();</script>