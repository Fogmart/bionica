<?
require "../../connect.php"; //соединение БД // login

if($_SESSION['admin']!=1)
exit;

				$sql = 'SELECT * FROM `bankyd` ORDER BY `id`';
							$bank = $mysqli->query($sql);
							if($bank_row = $bank->num_rows)$bank_res = $bank->fetch_assoc();
							
				?>
				
<title>Банковские реквизиты</title>
<style>
*{border: 0px solid red; 
	margin:0px;
	font-family: YS Text,sans-serif;
    font-weight: 400;
    font-style: normal;
    font-stretch: normal;
    font-size: 14px;
    line-height: 20px;
}
td{border:1px solid black;}
table{width:100%;}
input{width:100%;}
select{width:100%; height:100%;}
option{width:100%; height:100%;}
</style>				
				<form method='POST'>
				<table style='height: 20px;'>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Открыть яндекс</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><a target="_blank" href="https://money.yandex.ru/myservices/online.xml">yandex.money</a></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>№ кошелька</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="receiver" id="receiver" value="'.$bank_res["receiver"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Тип формы</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>
							<select name='quickpay-form'>
								<option name='quickpay-form' value='donate' <? if($bank_res["quickpay-form"]=="donate") echo "selected"; ?> >donate — для универсальной формы;</option>
								<option name='quickpay-form' value='small' <? if($bank_res["quickpay-form"]=="small") echo "selected"; ?> >small — для кнопки;</option>
								<option name='quickpay-form' value='shop' <? if($bank_res["quickpay-form"]=="shop") echo "selected"; ?> >shop — для универсальной формы;</option>
							</select>
						</td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Название платежа</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="targets" id="targets" value="'.$bank_res["targets"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Название магазина</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="formcomment" id="formcomment" value="'.$bank_res["formcomment"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Секретный ключ (яндекс)</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="notification_secret" id="notification_secret" value="'.$bank_res["notification_secret"].'">'; ?></td> 
					</tr>
					<tr>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Пароль администратора</td>
						<td>
						<input value='' type='password' name='pass_admin' />
						</td>
					</tr>
					<tr>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Сохранить</td>
						<td>
							<input type='submit' name='submit' value='Сохранить' style='width:49%;' />
							<input type='submit' name='' onclick='window.close();' value='Отменить'  style='width:49%;' />
						</td>
					</tr>	
				</table>
				</form>
				<?
				
				if($_POST["submit"]!=NULL){
					//echo '<script>alert("write");</script>';
					$sql = 'SELECT * FROM `users` WHERE `id`="'. $_SESSION['id'] .'" and `pass`="'. $_POST['pass_admin'] .'";';
					$data = $mysqli->query($sql);
					$row = $data->num_rows;
					if($row==1)
					{
						//echo '<script>alert("admin");</script>';
						$res = $data->fetch_assoc();
						
						if($_SESSION['admin']=="1"){

							$mysqli->query("
							UPDATE `bankyd`
							SET 
								`notification_secret` = '".$_POST["notification_secret"]."', 
								`receiver` = '".$_POST["receiver"]."',
								`quickpay-form` = '".$_POST["quickpay-form"]."',
								`targets` = '".$_POST["targets"]."',
								`formcomment` = '".$_POST["formcomment"]."'
								
							WHERE 1;
							");
							$_POST["submit"]=NULL;
							//echo '<script>alert("on");</script>';
							echo "<script>location.href+='';</script>";

						}
					}
					else
					{
					echo "Не правильный пароль администратора";	
					}
				}
				
						

				
				
				
				
				
				?>
				
				
				
				
				
				
				
				
				
				