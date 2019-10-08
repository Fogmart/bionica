<?
require "../../connect.php"; //соединение БД // login

if($_SESSION['admin']!=1)
exit;

				$sql = 'SELECT * FROM `bank` ORDER BY `id`';
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
</style>				
				<form method='POST'>
				<table style='height: 20px;'>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>ИП</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="ip" id="ip" value="'.$bank_res["ip"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>ИНН</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="inn" id="inn" value="'.$bank_res["inn"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Счет №</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="Rnumber" id="Rnumber" value="'.$bank_res["Rnumber"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Тип счета</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="Rnumber_type" id="Rnumber_type" value="'.$bank_res["Rnumber_type"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Банк</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="bank" id="bank" value="'.$bank_res["bank"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>БИК</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="bik" id="bik" value="'.$bank_res["bik"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Город</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="city" id="city" value="'.$bank_res["city"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Коррю счет</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="Knumber" id="Knumber" value="'.$bank_res["Knumber"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>КПП</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="kpp" id="kpp" value="'.$bank_res["kpp"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>ОКТМО</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="oktmo" id="oktmo" value="'.$bank_res["oktmo"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Л/счет</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="Lnumber" id="Lnumber" value="'.$bank_res["Lnumber"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Код дохода</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="Dnumber" id="Dnumber" value="'.$bank_res["Dnumber"].'">'; ?></td> 
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
							UPDATE `bank`
							SET `ip` = '".$_POST["ip"]."',
								`inn` = '".$_POST["inn"]."',
								`Rnumber` = '".$_POST["Rnumber"]."',
								`Rnumber_type` = '".$_POST["Rnumber_type"]."',
								`bank` = '".$_POST["bank"]."',
								`bik` = '".$_POST["bik"]."',
								`city` = '".$_POST["city"]."',
								`Knumber` = '".$_POST["Knumber"]."',
								`kpp` = '".$_POST["kpp"]."',
								`oktmo` = '".$_POST["oktmo"]."',
								`Lnumber` = '".$_POST["Lnumber"]."',
								`Dnumber` = '".$_POST["Dnumber"]."'
							WHERE `id`=1;
							");
							$_POST["submit"]=NULL;

							echo "<script>window.close();</script>";
						}
					}
					else
					{
					echo "Не правильный пароль администратора";	
					}
				}
				
						

				
				
				
				
				
				?>
				
				
				
				
				
				
				
				
				
				