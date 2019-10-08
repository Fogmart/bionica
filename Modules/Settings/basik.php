<?
require "../../connect.php"; //соединение БД // login
if($_SESSION['admin']!=1)
exit;
$sql = 'SELECT * FROM `basik` ORDER BY `id`';
							$basik_data = $mysqli->query($sql);
							if($basik_row = $basik_data->num_rows)$basik = $basik_data->fetch_assoc();
							
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
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Титульник</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="title" id="title" value="'.$basik["title"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Выдача сниплета</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="description" id="description" value="'.$basik["description"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Ключевые слова</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="keywords" id="keywords" value="'.$basik["keywords"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Автор</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="author" id="author" value="'.$basik["author"].'">'; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Фирма</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo '<input name="copyright" id="copyright" value="'.$basik["copyright"].'">'; ?></td> 
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
							UPDATE `basik`
							SET 
								`title` = '".$_POST["title"]."'
							WHERE 1
							");	
							$mysqli->query("
							UPDATE `basik`
							SET 
								`description` = '".$_POST["description"]."'
							WHERE 1
							");	
							$mysqli->query("
							UPDATE `basik`
							SET 
								`keywords` = '".$_POST["keywords"]."'
							WHERE 1
							");	
							$mysqli->query("
							UPDATE `basik`
							SET 
								`author` = '".$_POST["author"]."'
							WHERE 1
							");	
							$mysqli->query("
							UPDATE `basik`
							SET 
								`copyright` = '".$_POST["copyright"]."'
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
				
				
				
				
				
				
				
				
				
				