<?  
require "../../connect.php"; //соединение БД // login


?>
<title>Редактировать ФИО</title>
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
					<table>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>ФИО</td> 
							<td style='width:100%;'><input value='<?echo $_SESSION['user'];?>' type='text' name='name' style='width:100%;' /></td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Пароль</td> 
							<td style='width:100%;'><input value='' type='password' name='pass' style='width:100%;' /></td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Сохранить</td>
							<td style='width:100%;'><input type='submit' name='submit' value='Сохранить' style='width:49%;' />
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
					
					if($_POST["submit"]!=NULL){

						$mysqli->query("
						UPDATE `users`
						SET `name` = '".$_POST["name"]."'
						WHERE `id`=".$_SESSION['id'].";
						");
						$_POST["submit"]=NULL;
						$_SESSION['user']=$_POST["name"];
						echo "<script>window.close();</script>";
	
					}
				}
				else
				{
				echo "Не правильный пароль";	
				
				}
}
?>