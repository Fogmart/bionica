<?php if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 

if($_SESSION['admin']!=1)
if($_SESSION['store']!=1)
exit;

if(isset($_POST['fio']))
if(isset($_POST['full_adres']))
{
	$mysqli->query(" UPDATE `shopping` SET `full_adres` = '".$_POST['full_adres']."' , `fio` = '".$_POST['fio']."' WHERE `email`= '".$_GET['email']."';");
}


$_GET['email']; // -> почта и тд)

$sity_sql ="SELECT * FROM `shopping` WHERE `email`= '".$_GET['email']."';";
$sity_data = $mysqli->query($sity_sql);
if($sity_row = $sity_data->num_rows)
$sity_res  = $sity_data ->fetch_assoc();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Admin</title>
<link rel="stylesheet" media="screen" href="theme/active_admin.css">
<link rel="stylesheet" media="print" href="theme/print.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="theme/active_admin.js"></script>
</head>

<body class="index dashboard active_admin logged_in root_namespace">
<div class="title_bar" id="title_bar">
	<div id="titlebar_left">
		<span class="breadcrumb">
			<a>Пользователь</a>
			<span class="breadcrumb_sep">/</span>
		</span>
		<h2 id="page_title">Редактировать заказ</h2>
	</div>
	<div id="titlebar_right">
		<div class="action_items"></div>
	</div>
</div>

<div class="flashes"></div>

<div id="active_admin_content" class="without_sidebar">
	<div id="main_content_wrapper">
		<div id="main_content">
			<form novalidate="novalidate" class="formtastic order" id="edit_order" action="" accept-charset="UTF-8" method="post">
				<fieldset class="inputs">
					<ol>
						<li class="string input optional stringish" id="order_customer_address_input">
							<label for="order_customer_address" class="label">Адрес доставки</label>
							<input maxlength="255" id="order_customer_address" type="text" value="<?echo $sity_res['full_adres'];?>" name="full_adres">
						</li>
						<li class="string input optional stringish" id="order_customer_name_input">
							<label for="order_customer_name" class="label">ФИО</label>
							<input maxlength="255" id="order_customer_name" type="text" value="<?echo $sity_res['fio'];?>" name="fio">
						</li>

					</ol>
				</fieldset>
				<fieldset class="actions">
					<ol>
						<li class="action input_action " id="order_submit_action">
							<input type="submit" name="commit" value="Сохранить">
						</li>
						<li class="cancel">
							<a onclick='window.close();' >Отменить</a>
						</li>
					</ol>
				</fieldset>
			</form>
		</div>
	</div>
</div>
</body>
</html>
