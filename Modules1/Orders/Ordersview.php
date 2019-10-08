<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
if($_SESSION['admin']!=1)
if($_SESSION['store']!=1)
exit;

$_GET['email']; // -> почта и тд)

//SELECT * FROM `shopping` GROUP BY `email`;

$sity_sql ="SELECT * FROM `shopping` WHERE `email`= '".$_GET['email']."';";
$sity_data = $mysqli->query($sity_sql);
$sity_row = $sity_data->num_rows;

echo '<link href="http://allfont.ru/allfont.css?fonts=courier-new" rel="stylesheet" type="text/css" />
<style>
body{background: #cecece;padding-top: 40px;}
</style>
<div     style="position: relative; width: 100%;">';

if($sity_res  = $sity_data ->fetch_assoc())
	{
$txt= '<div style="max-width: 415px;position: relative;float: left;">
<table style="margin: 20px;box-shadow:7px 11px 21px 0px rgba(0,0,0,0.3);min-width:375px; max-width:376px; border: 0px solid red;font-family: \'Courier New\', arial;font-size: 12px;text-transform: uppercase;vertical-align: top; border-collapse:separate;border-spacing: 0;background:#fff;padding: 10px;">

    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="font-size:18px; text-align:center;">бионика маркет</td>
    </tr>
	<tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="font-size:18px; text-align:center;">№ '.$sity_res['id'].'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">имя : '.$sity_res['fio'].'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">тел. : '.$sity_res['tel'].'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">почта : '.$sity_res['email'].'</td>
    </tr>
	<tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">адрес : '.$sity_res['full_adres'].'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td style="width:65px;">АРТИК.|</td>
        <td style="width:41px;">КОЛ |</td>
        <td style="width:120px;">НАИМЕНОВАНИЕ</td>
        <td style="width:52px;">|ЦЕНА</td>
    </tr>
';		
		

		$sum_all=0;

		$user_sql ="SELECT * FROM `shopping` WHERE `email`= '".$_GET['email']."';";
		$user_data = $mysqli->query($user_sql);
		$user_row = $user_data->num_rows;
		
		while($user_res  = $user_data ->fetch_assoc())
		{
if($user_res['check']!="ok"){
	if($user_res['zakaz']!="no")$user_res['name']="<font style='color:red;'>(Заказ)</font>".$user_res['name'];
$txt=$txt. '
    <tr style="word-break: break-all;color:#0f0d72;">
        <td style="width:65px;">'.$user_res['art'].'</td>
        <td style="width:41px;">'.$user_res['kolvo'].'</td>
        <td style="width:120px;">'.$user_res['name'].' 
		'.((($user_res['art']=='0')||($user_res['art']=='1'))?'':'<a target="_blank" href="/'.$user_res['url'].'">Open</a>').'
		
        <td style="width:52px;">|'.$user_res['sum_p']*$user_res['kolvo'].'</td>
    </tr>
';
		$sum_all+=$user_res['sum_p']*$user_res['kolvo'];
		}
		}

$txt=$txt. '
	<tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="font-size:18px;">итог : '.$sum_all.' руб.</td>
    </tr>

</table></div>
';		
$upsum=$sum_all;
echo $txt;
	
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
$corzina; //[1]-номер [2]-сумма всего должен [3]-полученная сумма

	
		$corzina[1][1]=$_GET['email'];
		$user_sql ="SELECT * FROM  `shopping` WHERE  `email` LIKE  '%".$corzina[1][1]."%';";
		$user_data = $mysqli->query($user_sql);
		$user_row = $user_data->num_rows;
		while($user_res  = $user_data ->fetch_assoc())
		{
			$corzina[1][2]=$corzina[1][2]+(int)$user_res['sum_p'];
			
			if($user_res['art']=="0")$corzina[1][13]+=(int)$user_res['sum_p']; //доставка
			if($user_res['art']=="1")$corzina[1][16]+=(int)$user_res['sum_p']; //скидка
			$corzina[1][14]=$user_res['fio'];
			$corzina[1][15]=$user_res['tel'];
		}
	

$order_sql ="SELECT * FROM `orders` WHERE `label`= '".$corzina[1][1]."' and `user_check`='no' ORDER BY `id` DESC;";
$order_data = $mysqli->query($order_sql);
$order_row = $order_data->num_rows;
if($order_row>0)
{
$short=10;
$order_res  = $order_data ->fetch_assoc();
$corzina[1][3]=$order_res['id'];
$corzina[1][4]=$order_res['withdraw_amount'];
$corzina[1][5]=$order_res['amount'];
$corzina[1][6]=$order_res['user_check'];
$corzina[1][7]=$order_res['sha1'];
$corzina[1][8]=$order_res['sha1_hash'];
$corzina[1][17]=$order_res['verification'];

if($corzina[1][7]==$corzina[1][8])$corzina[1][9]="ok"; //ключи сошлись
else $corzina[1][9]="no";

if($corzina[1][4]==$corzina[1][2])$corzina[1][10]="ok"; //сумма сошлась
else $corzina[1][10]="no";

for($j=1;$j <= 10;$j++)	if(isset($corzina[1][$j]))$short--;
if($short==0)$corzina[1][11]="ok"; //все значения на местах вывод заказа 
else $corzina[1][11]="no";

if($corzina[1][11]=="ok")
	if($corzina[1][9]=="ok")
		if($corzina[1][10]=="ok") {$corzina[1][12]="Пройдена"; $com++;}
		else {$corzina[1][12]="<font style='background:red;'>Разница цен</font>";$err++;} //Ошибка в цене
	else {$corzina[1][12]="<font style='background:red;'>Не пройдена</font>";$err++;} //Ошибка в верификации платежа (ключи)
else {$corzina[1][12]="<font style='background:red;'>Ошибка сервера</font>";$err++;} //не все значения
if($corzina[1][17]=="ok"){$corzina[1][12]="Ручная проверка"; $com++;$err--;}
}

// 1- почта
// 2- сумма заказа
// 3- ид в оплате
// 4- сумма выставленая
// 5- зачисленая 
// 6- закрыта ли сделка
// 7- ключь 1
// 8- ключь 2
// 9- ключи сошлись
// 10- сумма сошлась
// 11- являеться заказом
// 12- ошибки или отсутствие
// 13- доставка
// 14- ФИО
// 15- телефон
// 16- Скидка
// $com- всего полож
// $err- всего отриц
	

if(isset($corzina[1][12]))
	{
$txt= '<div style="max-width: 415px;position: relative;float: left;">
<table style="margin: 20px;box-shadow:7px 11px 21px 0px rgba(0,0,0,0.3);min-width:375px; max-width:376px; border: 0px solid red;font-family: \'Courier New\', arial;font-size: 12px;text-transform: uppercase;vertical-align: top; border-collapse:separate;border-spacing: 0;background:#fff;padding: 10px;">

    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="font-size:18px; text-align:center;">БАНК</td>
    </tr>
	<tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="font-size:18px; text-align:center;">№ '.$corzina[1][3].'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">имя : '.$corzina[1][14].'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">тел. : '.$corzina[1][15].'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">почта : '.$corzina[1][1].'</td>
    </tr>
	<tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">адрес : '.$sity_res['full_adres'].'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td style="width:145px;">НАИМЕНОВАНИЕ</td>
        <td style="width:133px;">|ЦЕНА</td>
    </tr>
';		
		

$txt=$txt. '
    <tr style="word-break: break-all;color:#0f0d72;">
        <td style="width:145px;">Общая за товар</td>
        <td style="width:133px;">|'.($corzina[1][4]-$corzina[1][13]).' руб.</td>
    </tr>
';

$txt=$txt. '
    <tr style="word-break: break-all;color:#0f0d72;">
        <td style="width:145px;">Стоимость доставки</td>
        <td style="width:133px;">|'.$corzina[1][13].' руб.</td>
    </tr>
';


$txt=$txt. '
    <tr style="word-break: break-all;color:#0f0d72;">
        <td style="width:145px;">Верификация платежа</td>
        <td style="width:133px;">|'.$corzina[1][12].'</td>
    </tr>
';

$txt=$txt. '
    <tr style="word-break: break-all;color:#0f0d72;">
        <td style="width:145px;">Сделка закрыта</td>
        <td style="width:133px;">|'.$corzina[1][6].'</td>
    </tr>
';

$txt=$txt. '
	<tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="font-size:18px;">итог : '.$corzina[1][4].' руб. из ('.$sum_all.' руб.)</td>
    </tr>
	<tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="font-size:18px;">зачислено : '.$corzina[1][5].' руб.</td>
    </tr>

</table></div>
';		
echo $txt;
	}	
	
	
?>
</div>