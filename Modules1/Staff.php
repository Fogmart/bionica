
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
if($_SESSION['admin']=="1"){
				$sql = 'SELECT * FROM `users` WHERE `admin`="1" OR `store`="1" OR `direct`="1" OR `call`="1"';
				$Staff = $mysqli->query($sql);
				$Staff_row = $Staff->num_rows;
				
				
			
				
				echo "<table style='height: 0%; vertical-align: top;'> <caption>Персонал</caption>";
				
				
				echo "<tr> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>№</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFF7A'>ФИО</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Телефон</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFF7A'>Пароль</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Почта</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFF7A'>А</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>ТП</td>
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFF7A'>ТР</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>С</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFF7A'>Дата регистрации</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Редактировать</td> 
					</tr>";
				
				$color="FE";
				
					
					while($Staff_res = $Staff->fetch_assoc()){
						$n++;
						echo "<tr style='height: 20px; vertical-align: top; border:1px solid black;'>";	
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."FFFF'>";
							
							echo $td . "" . $n ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."EEEE'>";
							
							echo $td . "" . $Staff_res["name"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."FFFF'>";
							
							echo $td . "" . $Staff_res["tel"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."EEEE'>";
							
							echo $td . "******</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."FFFF'>";
							
							echo $td . "" . $Staff_res["email"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."EEEE'>";
							
							echo $td . "" . $Staff_res["admin"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."FFFF'>";
							
							echo $td . "" . $Staff_res["store"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."EEEE'>";
							
							echo $td . "" .$Staff_res["direct"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."FFFF'>";
							
							echo $td . "" .$Staff_res["call"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."EEEE'>";
							
							echo $td . "" .$Staff_res["OrderDate"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."FFFF'>";
							$r='red("'.$Staff_res["id"].'");';
							echo $td . "<a onclick='".$r."'>Редактировать</a> </td>";
						
						echo "</tr>";
						if($color=="FE")$color="FE";
						else $color="FE";
					}
				echo "</table>";
}
else
					echo "<h1>ДОСТУП ЗАПРЕЩЕН</h1>";				
?>

<script>
var newWin;
function red(id){
	id="Modules/Staff/red.php?id="+id;
	 newWin = window.open(id, "Staff_red", "width=800,height=400,left=200,top=200,menubar=no,toolbar=no,location=no");
	
	}
</script>