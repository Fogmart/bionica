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
				$sql = 'SELECT * FROM `users` WHERE `admin`="0" AND `store`="0" AND `direct`="0" AND `call`="0"';
				$Staff = $mysqli->query($sql);
				$Staff_row = $Staff->num_rows;
				
				
			
				
				echo "<table style='height: 0%; vertical-align: top; font-color:#fff;'> <caption>Люди</caption>";
				
				
				echo "<tr> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>№</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFF7A'>ФИО</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Телефон</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFF7A'>Пароль</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Почта</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFF7A'>Дата регистрации</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Редактировать</td> 
					</tr>";
				
				$color[1][2]="#ffffff";
				$color[1][1]="#ffffff";
				$color[2][2]="#dcdbdb";
				$color[2][1]="#eaeaea";
				$ci=1;
				$textcolor="#000";
					
					while($Staff_res = $Staff->fetch_assoc()){
						echo "<tr style='height: 20px; vertical-align: top; border:1px solid black;'>";	
						$n++;	
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black;  color:".$textcolor." ;background:".$color[$ci][1].";'>";
							
							echo $td . "" . $n ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black;  color:".$textcolor." ;background:".$color[$ci][2].";'>";
							
							echo $td . "" . $Staff_res["name"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black;  color:".$textcolor." ;background:".$color[$ci][1].";'>";
							
							echo $td . "" . $Staff_res["tel"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black;  color:".$textcolor." ;background:".$color[$ci][2].";'>";
							
							echo $td . "******</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black;  color:".$textcolor." ;background:".$color[$ci][1].";'>";
							
							echo $td . "" . $Staff_res["email"] ."</td>";
							
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black;  color:".$textcolor." ;background:".$color[$ci][2].";'>";
							
							echo $td . "" .$Staff_res["OrderDate"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black;  color:".$textcolor." ;background:".$color[$ci][1].";'>";
							$r='red("'.$Staff_res["id"].'");';
							echo $td . "<u><a style='color:#000;' onclick='".$r."'>Редактировать</a></u></td>";
						
						echo "</tr>";
						if($ci==1) $ci=2;
							else $ci=1;
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