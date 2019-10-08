<?
require "../../connect.php"; //соединение БД // login

if($_SESSION['admin']!=1)
exit;

				$sql = 'SELECT * FROM `bankpp` ORDER BY `id`';
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
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>PayPal mail</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="paypalemail" id="paypalemail" value="'.$bank_res["paypalemail"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Вернуть после оплаты на</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="return" id="return" value="'.$bank_res["return"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>В случае отмены оплаты</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="cancel_return" id="cancel_return" value="'.$bank_res["cancel_return"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Куда отправить уведомление об оплате</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="notify_url" id="notify_url" value="'.$bank_res["notify_url"].'">'; ?></td> 
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
					$sql = 'SELECT * FROM `users` WHERE `id`="'. $_SESSION['id'] .'" and `pass`="'. $_POST['pass_admin'] .'";';
					$data = $mysqli->query($sql);
					$row = $data->num_rows;
					if($row==1)
					{
						$res = $data->fetch_assoc();
						
						if($_SESSION['admin']=="1"){

							$mysqli->query("
							UPDATE `bankpp`
							SET 
								`notify_url` = '".$_POST["notify_url"]."'
							WHERE 1
							");	
							$mysqli->query("
							UPDATE `bankpp`
							SET 
								`return` = '".$_POST["return"]."'
							WHERE 1
							");	
							$mysqli->query("
							UPDATE `bankpp`
							SET 
								`cancel_return` = '".$_POST["cancel_return"]."'
							WHERE 1
							");	
							$mysqli->query("
							UPDATE `bankpp`
							SET 
								`paypalemail` = '".$_POST["paypalemail"]."'
							WHERE 1
							");							
							
							$_POST["submit"]=NULL;

							echo "<script>location.href+='';</script>";
						}
					}
					else
					{
					echo "Не правильный пароль администратора";	
					}
				}
				
						

				
				
				
				
				
				?>
				
				
				
				
				
				
				
				
				
				