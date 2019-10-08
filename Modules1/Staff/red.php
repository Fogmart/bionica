<?  
require "../../connect.php"; //соединение БД // login
if($_SESSION['admin']!="1"){session_destroy(); exit();}
else
{
	
	$sql = 'SELECT * FROM `users` WHERE `id`='.$_GET["id"].';';
				$Staff = $mysqli->query($sql);
				$Staff_row = $Staff->num_rows;
				if($Staff_res = $Staff->fetch_assoc())
				{
					if($Staff_res["call"]=="1"){$call= "<select name='call'>
														<option name='call' value='1' selected>Да</option>
														<option name='call' value='0'>Нет</option>
														</select>";
												}
												else
												{
												$call= "<select name='call'>
														<option name='call' value='1'>Да</option>
														<option name='call' value='0' selected>Нет</option>
														</select>";	
												}
					if($Staff_res["direct"]=="1"){$direct= "<select name='direct'>
														<option name='direct' value='1' selected>Да</option>
														<option name='direct' value='0'>Нет</option>
														</select>";
												}
												else
												{
												$direct= "<select name='direct'>
														<option name='direct' value='1'>Да</option>
														<option name='direct' value='0' selected>Нет</option>
														</select>";	
												}							
					if($Staff_res["store"]=="1"){$store= "<select name='store'>
														<option name='store' value='1' selected>Да</option>
														<option name='store' value='0'>Нет</option>
														</select>";
												}
												else
												{
												$store= "<select name='store'>
														<option name='store' value='1'>Да</option>
														<option name='store' value='0' selected>Нет</option>
														</select>";	
												}	
					if($Staff_res["admin"]=="1"){
							if($Staff_res["name"]==$_SESSION['user']){$admin= "<select name='admin'>
														<option name='admin' value='1' selected>Да</option>
														
														</select>";
												}
												
					
							if($Staff_res["name"]!=$_SESSION['user']){$admin= "<select name='admin'>
														<option name='admin' value='1' selected>Да</option>
														<option name='admin' value='0'>Нет</option>
														</select>";
												}
					}							
					else
												{
												$admin= "<select  name='admin'>
														<option value='1'>Да</option>
														<option value='0' selected>Нет</option>
														</select>";	
												}							
					
				echo "
				<form method='POST'>
					<table>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>ФИО</td> 
							<td><input value='" . $Staff_res["name"] ."' type='text' name='name' /></td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Телефон</td>
							<td><input value='" . $Staff_res["tel"] ."' type='text' name='tel' /></td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Пароль</td>
							<td><input value='***************' type='text' name='pass' /></td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Почта</td>
							<td><input value='" . $Staff_res["email"] ."' type='text' name='email' /></td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Админ</td>
							<td>" . $admin."</td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Товаровед поступление</td>
							<td>".$store."</td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Товаровед реализации</td>
							<td>".$direct."</td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Специалист call-центра</td>
							<td>".$call."</td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Пароль администратора</td>
							<td>
							<input value='' type='password' name='pass_admin' />
							</td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Сохранить</td>
							<td><input type='submit' name='submit' value='Сохранить' style='width:49%;' />
								<input type='submit' name='' onclick='window.close();' value='Отменить'  style='width:49%;' />
							</td>
						</tr>						
					</table>
					</form>";	
					
					
				}	
				if($_POST["submit"]!=NULL){
				$sql = 'SELECT * FROM `users` WHERE `id`="'. $_SESSION['id'] .'" and `pass`="'. $_POST['pass_admin'] .'";';
				$data = $mysqli->query($sql);
				$row = $data->num_rows;
				if($row==1)
				{
					$res = $data->fetch_assoc();
					
					if($_POST["submit"]!=NULL){

						$mysqli->query("
						UPDATE `users`
						SET `name` = '".$_POST["name"]."',
							`tel` = '".$_POST["tel"]."',
							`email` = '".$_POST["email"]."',
							`admin` = '".$_POST["admin"]."',
							`store` = '".$_POST["store"]."',
							`direct` = '".$_POST["direct"]."',
							`call` = '".$_POST["call"]."'
						WHERE `id`=".$_GET["id"].";
						");
						
						
						if($_POST["email"]==$_SESSION['email'])
						{
						$_SESSION['admin']=$_POST["admin"];
						$_SESSION['store']=$_POST['store'];
						$_SESSION['direct']=$_POST['direct'];
						$_SESSION['call']=$_POST['call'];
						}
						
						$_POST["submit"]=NULL;

						echo "<script>window.close();</script>";
					}
				}
				else
				{
				echo "Не правильный пароль администратора";	
				}
}
				
						
	
}
?>
<title>Редактировать карточку</title>
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