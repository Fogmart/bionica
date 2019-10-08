
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
				$sql = 'SELECT * FROM `banners` ';
				$Banners = $mysqli->query($sql);
                $Banners_row = $Banners->num_rows;
				
				echo "<table style='height: 0%; vertical-align: top;'> <caption>Баннеры</caption>";
				
				
				echo "<tr> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>№</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFF7A'>Название</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Картинка</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>URL</td> 
					<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>
					    <a onclick='red(0)'>Добавить</a></td> 
					</tr>";
				
				$color="FE";
				
					
					while($Banners_res = $Banners->fetch_assoc()){
						$n++;
						echo "<tr style='height: 20px; vertical-align: top; border:1px solid black;'>";	
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."FFFF'>";
							
							echo $td . "" . $n ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."EEEE'>";
							
							echo $td . "" . $Banners_res["name"] ."</td>";

							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."EEEE'>";

							echo $td . "" . $Banners_res["img"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."FFFF'>";
							
							echo $td . "" . $Banners_res["url"] ."</td>";
							
							$td="<td style='height: 20px; vertical-align: top; border:1px solid black; background:#".$color."FFFF'>";
							$r='red("'.$Banners_res["id"].'");';
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
     id="Modules/Banners/red.php?id="+id;
	 newWin = window.open(id, "Banners_red", "width=800,height=400,left=200,top=200,menubar=no,toolbar=no,location=no");
	}
</script>