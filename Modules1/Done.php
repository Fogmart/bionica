<?php if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
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
						}?>
<meta charset="utf-8">
<table id="tabl1">
	<tr>
		<td style="width:49%; vertical-align: top;">
<!---------------------------------------------------------------------------->
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
		#datatable{height: 47%; }
		#tovardiv{width:100px; height: 215px;float:left; background:#FFFFCB;
			margin: 1px; border:1px solid black;}
		</style>
<form method='POST' id="form" style='height: 20px;'>	
<table id="seach" style='height: 20px;'>	
	<tr style='height: 20px;'>
		<td style='height: 20px; vertical-align: top; width:2%;'>Поиск</td>
		<td style='height: 20px; vertical-align: top; width:93%;'>
			<input style="width:100%;" id="name" name="name" placeholder="Поиск (название, описание и тд.)" value="<?echo $_POST["name"];?>">
		</td> 
		<td style='height: 20px; vertical-align: top; width:2%;'>
			<input type="submit" id="submit" name="submit" value="Поиск"></td> 
		
	</tr>
</table>	
<form>
<?
if($_POST['name']!=NULL){

	$sql = 'SELECT * FROM `tovar` 
	WHERE 
		`art` LIKE "%'. $_POST['name'] .'%" or 
		`name` LIKE "%'. $_POST['name'] .'%" or 
		`rrc` LIKE "%'. $_POST['name'] .'%" or 
		`sum_z` LIKE "%'. $_POST['name'] .'%" or 
		`sum_p` LIKE "%'. $_POST['name'] .'%" or 
		`opt_l` LIKE "%'. $_POST['name'] .'%" or 
		`opt_b` LIKE "%'. $_POST['name'] .'%" or 
		`firma` LIKE "%'. $_POST['name'] .'%" or 
		`group` LIKE "%'. $_POST['name'] .'%" or 
		`2group` LIKE "%'. $_POST['name'] .'%" or 
		`name_print` LIKE "%'. $_POST['name'] .'%" or 
		`kod_s` LIKE "%'. $_POST['name'] .'%" or 
		`shtrih` LIKE "%'. $_POST['name'] .'%" or 
		`comment` LIKE "%'. $_POST['name'] .'%" or 
		`sclad` LIKE "%'. $_POST['name'] .'%" or 
		`seo` LIKE "%'. $_POST['name'] .'%" 
	;';
	$_POST["name"]=NULL;
	
}
else{

	$sql = 'SELECT * FROM `tovar` WHERE `id`;';
	$_POST["name"]=NULL;
}

	$data = $mysqli->query($sql);
	$row = $data->num_rows;
	
	echo "<div id='datatable'>";
		
	while($res = $data->fetch_assoc())
	{
		//$newWin= 'newWin = window.open("tovar_card.php?id='.$res['id'].'" ,"", "width=1020,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");';
		echo "<div id='tovardiv' onclick='".$newWin."'>";
			$sas='"'.$res['photo_1'].'"';
			echo "<div style='height: 100px; width:100px; vertical-align: top; background: url(".$sas.") no-repeat #000; -moz-background-size: 100%; -webkit-background-size: 100%; -o-background-size: 100%; background-size: 100%; background-size: cover;'>";
				//echo $res['photo_1']; 
			echo "</div>";
			echo "<div style='height: 20px; vertical-align: top; '>";
				echo "Арт: ".$res['art']; 
			echo "</div>";
			echo "<div style='height: 50px; vertical-align: top; '>";
				echo $res['name']; 
			echo "</div>";
			echo "<div style='height: 20px; vertical-align: top; '>";
				echo "Кол-во: ".$res['dost']; 
			echo "</div>";
			echo "<div style='height: 20px; vertical-align: top; '>";
				echo "Цена: ".$res['sum_p']; 
			echo "</div>";
	
		echo "</div>";
	}
	echo "</div>";
	if($row<1){echo "НЕТ ТОВАРОВ";}

?>


<!---------------------------------------------------------------------------->
		</td>
	</tr>
	<tr>
		<td style="width:49%;">
<!---------------------------------------------------------------------------->
		2
<!---------------------------------------------------------------------------->
		</td>	
	</tr>	
</table>