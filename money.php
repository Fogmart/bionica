<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";

$sql = 'SELECT * FROM `bankyd` WHERE `id`=1';
$bank = $mysqli->query($sql);
if($bank_row = $bank->num_rows)$bank_res = $bank->fetch_assoc();


$sum_all=0;
if(isset($_SESSION['email'])){
if($_SESSION['email']!='')
    if($_SESSION['email']!=' ')
    $sql2 = 'SELECT * FROM `shopping` WHERE (`email` ="'. $_SESSION['email'] .'" OR `session_id` ="'. session_id() .'") and `check`="no";';
}
else{
    $sql2 = 'SELECT * FROM `shopping` WHERE `session_id` ="'. session_id() .'" and `check`="no";';
}
		$data = $mysqli->query($sql2);
		$row = $data->num_rows;
		while($res = $data->fetch_assoc())
		{
		$sum_prom= (int)$res['kolvo']*(int)$res['sum_p'];
		$sum_all+=$sum_prom;

		}
?>

<form method="POST" style="display:none;" id="go" action="https://money.yandex.ru/quickpay/confirm.xml">
    <input type="hidden" name="receiver" value="<?echo "".$bank_res["receiver"].""; ?>"> <!--номер кошелька-->

	<input type="hidden" name="quickpay-form" value="<?echo "".$bank_res["quickpay-form"].""; ?>">
		<!--shop — для универсальной формы;-->
		<!--small — для кнопки;-->
		<!--donate — для «благотворительной» формы.-->
	<input type="hidden" name="targets" value="<?echo "".$bank_res["targets"]." ".$_SESSION['email'].""; ?>">
		<!-- название платежа-->

	<label><input style="" type="radio" checked name="paymentType" value="AC">Банковской картой</label>

		<!--PC — оплата из кошелька в Яндекс.Деньгах;-->
		<!--AC — с банковской карты;-->
		<!--MC — с баланса мобильного.-->
	<input type="hidden" name="sum" value="<?echo number_format($sum_all, 2, '.','');?>" data-type="number">
		<!--Сумма перевода-->
	<input type="hidden" name="formcomment" value="<?echo "".$bank_res["formcomment"].""; ?>">
		<!--Название перевода в истории отправителя-->
	<input type="hidden" name="short-dest" value="<?echo "".$bank_res["formcomment"].""; ?>">
		<!--Название перевода на странице подтверждения-->
	<input type="hidden" name="label" value="<?echo "".$_SESSION['email'].""; ?>">
		<!--Метка, которую сайт или приложение присваивает конкретному переводу До 64 символов-->
    <input type="hidden" name="comment" value="<?echo "".$bank_res["formcomment"].""; ?>">
		<!--комментарий отправителя (пляжные носки заказ в кратце) До 200 символов-->

	<input type="hidden" name="successURL" value="<?echo "".$_SERVER['HTTP_HOST'].""; ?>">

		<!--URL-адрес для редиректа после совершения перевода.-->
    <input type="hidden" name="need-fio" value="<?//echo "".$bank_res["need-fio"].""; ?>">
		<!--Нужны ФИО отправителя. Передаются только по HTTPS-->
    <input type="hidden" name="need-email" value="<?//echo "".$bank_res["need-email"].""; ?>">
		<!--Нужна электронная почты отправителя. Передаются только по HTTPS-->
    <input type="hidden" name="need-phone" value="<?//echo "".$bank_res["need-phone"].""; ?>">
		<!--Нужен телефон отправителя Передаются только по HTTPS-->
    <input type="hidden" name="need-address" value="<?//echo "".$bank_res["need-address"].""; ?>">
		<!--Нужен адрес отправителя. Передаются только по HTTPS-->

    <input type="submit" value="Перевести">
</form>


<script>document.getElementById('go').submit();</script>
