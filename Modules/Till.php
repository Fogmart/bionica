<?php if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
if($_SESSION['admin']!=1)
exit;
//SELECT * FROM `shopping` GROUP BY `email`;
if(!( isset($_SESSION['admin']) && isset($_SESSION['store']) && isset($_SESSION['direct']) && isset($_SESSION['call'])))
						{

							$_SESSION['user']="Доступ закрыт";
							unset($_SESSION['pass']);
							unset($_SESSION['id']);
							unset($_SESSION['email']);
									unset($_SESSION['admin']);
									unset($_SESSION['store']);
									unset($_SESSION['direct']);
									unset($_SESSION['call']);
									unset($_SESSION['tel']);
									unset($_SESSION['full_adres']);
									exit;
						}
if($_POST['sum'])
if($_POST['pm'])
if($_POST['name'])
if($_POST['email'])
if($_POST['becose'])
if($_POST['email_admin']==$_SESSION['email'])
if($_SESSION['admin']=="1" || $_SESSION['store']=="1" || $_SESSION['direct']=="1" )//проверка админа
{
	if(!(isset($_POST['from']))){$_POST['from']="Внутренние расходы";}


				
/// внос в базу
if($_POST['pm']=="p"){$_POST['pm']="+";}
if($_POST['pm']=="m"){$_POST['pm']="-";}

$mysqli->query("
INSERT INTO `kassa`
( `sum`, `pm`, `from`, `name`, `email`, `becose`,`email_admin`) 
VALUES 
('".$_POST['sum']."','".$_POST['pm']."','".$_POST['from']."','".$_POST['name']."','".$_POST['email']."','".$_POST['becose']."','".$_SESSION['email']."');
");	

echo "<script> window.location.href='/admin.php?m=7'; </script>";
exit();
}	

if(!($_GET["m"])){echo "<script> window.location.href='/admin.php?m=7'; </script>";}



$sql = 'SELECT * FROM `kassa` WHERE `id`=1';
$kassa = $mysqli->query($sql);
if($kassa_row = $kassa->num_rows)$kassa_res = $kassa->fetch_assoc();
?>

<div class="title_bar" id="title_bar">
	<div id="titlebar_left">
		<h2 id="page_title">Касса (не являеться кассой официально)</h2>
	</div>
</div>
	 
<div class="flashes"></div> 

<div id="active_admin_content" class="without_sidebar">
	<div id="main_content_wrapper">
		<div id="main_content">
			<div class="comments user panel" id="active_admin_comments_for_user_11">
				<h3>Добавить запись</h3>
				<div class="panel_contents">
					<div id="active_admin_comment_138" class="active_admin_comment">
<form method="POST" action="Modules/Till.php">
	<table border="0" cellspacing="0" cellpadding="0">
		<tbody>
			<tr class="row row-email">
				<th><input maxlength="255" id="order_amount" placeholder="Имя" type="text" name="name"></th>
				<th><input maxlength="255" id="order_amount" placeholder="Сумма" step="any" type="number" value="" name="sum"></th>
				<th>
							<select name="pm" id="order_book_id" style="height:34px;">
								<option value=""></option>
								<option value="p">Доход</option>
								<option value="p">Внести</option>
								<option value="m">Расход</option>
								<option value="m">Аванс выдача</option>
							</select>
				</th>
				<th><input maxlength="255" id="order_amount" placeholder="Причина" type="text" name="becose"></th>
			</tr>
		</tbody>
	</table>
	<input id="order_amount" type="text" name="email" value="<? echo $_SESSION['email'];?>"  style="display:none;">
	<input id="order_amount" type="text" name="email_admin" value="<? echo $_SESSION['email'];?>" style="display:none;">
	<input id="order_amount" type="submit" name="submit" value="Внести" style="height:34px;">
</form>
					</div>
				</div>
			</div>
			<div class="panel">
			<h3>Всего: <?echo $kassa_res['sum'];?> р</h3>
			<h3>Доход: +<?echo $kassa_res['from'];?> р</h3>
			<h3>Расход: -<?echo $kassa_res['name'];?> р</h3>
				<div class="panel_contents">
					<div class="attributes_table user" id="attributes_table_user_11">
						<table border="0" cellspacing="0" cellpadding="0">
							<tbody>
								<tr class="row row-email">
									<th>№</th>
									<th>Сумма</th>
									<th>Откуда</th>
									<th>Имя</th>
									<th>Почта</th>
									<th>Оператор</th>
									<th>Причина</th>
								</tr>

<?
$sql = 'SELECT * FROM `kassa` WHERE `id`>1 ORDER BY `id` DESC';
$kassa = $mysqli->query($sql);
$kassa_row = $kassa->num_rows;
while($kassa_res = $kassa->fetch_assoc())
{

if($kassa_res['pm']=="+"){$dohod+=$kassa_res['sum'];$sum_all+=$kassa_res['sum'];}
if($kassa_res['pm']=="-"){$rashod+=$kassa_res['sum'];$sum_all-=$kassa_res['sum'];}


/////////////////////////////////////////////////////	
echo '								<tr>
									<td>'.$kassa_res['id'].'</td>
									<td>'.$kassa_res['pm'].$kassa_res['sum'].'</td>
									<td>'.$kassa_res['from'].'</td>
									<td>'.$kassa_res['name'].'</td>
									<td>'.$kassa_res['email'].'</td>
									<td>'.$kassa_res['email_admin'].'</td>
									<td>'.$kassa_res['becose'].'</td>
									</tr>
';
/////////////////////////////////////////////////////
}
?>

							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<?
$mysqli->query("
UPDATE `kassa` 
SET 
	`sum`='".$sum_all."',
	`pm`='+',
	`from`='".$dohod."',
	`name`='".$rashod."'
WHERE `id`=1
");
?>