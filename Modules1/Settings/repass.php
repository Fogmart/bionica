<?  
require "../../connect.php"; //соединение БД // login


?>
<title>Редактировать пароль</title>
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

</style>
<form method='POST'>
					<table>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Старый пароль</td> 
							<td style='width:60%;'><input value='' type='password' name='pass' style='width:100%;' /></td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Новый пароль</td> 
							<td style='width:60%;'><input value='' type='password' name='newpass1' style='width:100%;' /></td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Еще раз новый пароль</td> 
							<td style='width:60%;'><input value='' type='password' name='newpass2' style='width:100%;' /></td>
						</tr>						
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Сохранить</td>
							<td style='width:60%;'><input type='submit' name='submit' value='Сохранить' style='width:49%;' />
								<input type='submit' name='' onclick='window.close();' value='Отменить'  style='width:49%;' />
							</td>
						</tr>
					</table>
</form>

<?
if($_POST["submit"]!=NULL){
$sql = 'SELECT * FROM `users` WHERE `id`="'. $_SESSION['id'] .'" and `pass`="'. $_POST['pass'] .'";';
				$data = $mysqli->query($sql);
				$row = $data->num_rows;
				if($row==1)
				{
					$res = $data->fetch_assoc();
					
					if($_POST["newpass1"]==$_POST["newpass2"]){

						$mysqli->query("
						UPDATE `users`
						SET `pass` = '".$_POST["newpass2"]."'
						WHERE `id`=".$_SESSION['id'].";
						");
						$_POST["submit"]=NULL;

						echo "<script>window.close();</script>";
	
					}
					else
					{echo "Пароли не совпадают";}
				}
				else
				{
				echo "Не правильный пароль";	
				
				}
}
?>