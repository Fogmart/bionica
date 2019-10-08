<?
require "../../connect.php"; //соединение БД // login

//foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>".$key." = ".$value."</p>";} //все запросы


if($_SESSION['store']!="1")exit();
					if($_SESSION['store']=="1")
					if($_POST["id_post"]!=NULL)
					if($_POST["sclad_post"]!=NULL)
					if($_POST["about_post"]!=NULL)
					{

						$mysqli->query("
						UPDATE `sclad`
						SET `sclad` = '".$_POST["sclad_post"]."',`about` = '".$_POST["about_post"]."'
						WHERE `id`=".$_POST["id_post"].";
						");
						$_POST["submit"]=NULL;
						echo "<script>save=1; window.location = window.location.origin + window.location.pathname;</script>";
					}
					if($_SESSION['store']=="1")
					if($_POST["new_id"]!=NULL)
					if($_POST["new_sclad"]!=NULL)
					if($_POST["new_about"]!=NULL)
					{

						$mysqli->query('
		
						INSERT INTO `sclad` 
						(`sclad`,`about`) 
						VALUES
						("'.$_POST["new_sclad"].'","'.$_POST["new_about"].'");
						');
						$_POST["submit"]=NULL;
						$_POST["new_id"]=NULL;
						$_POST["new_sclad"]=NULL;
						$_POST["new_about"]=NULL;
						echo "<script>save=1; window.location = window.location.origin + window.location.pathname;</script>";
					}
					if($_SESSION['store']=="1")
					if($_POST["id_del"]!=NULL)
					{
					$mysqli->query("DELETE FROM `bionica-market`.`sclad` WHERE `sclad`.`id` = ".$_POST["id_del"].";");

					echo "<script>save=1; window.location = window.location.origin + window.location.pathname;</script>";
					}
?>		
<title>Список складов РЕДАКТИРОВАНИЕ</title>
<meta charset="utf-8">
<script src="dist/excellentexport.js"></script>
<script>
            function newApi(format) {
                return ExcellentExport.convert({
                    anchor: 'anchorNewApi-' + format,
                    filename: 'tovar_<?php echo date( "d.m.y H:i" );?>.' + format,
                    format: format
                }, [{
                    name: 'Sheet Name Here 1',
                    from: {
                        table: 'datatable'
                    }
                }]);
            }




        </script>
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
input{width:100%;}
table{width:100%;}
#seach{background:green;
		border: 0px solid red;
		z-index: 9999; 
		position: fixed;
		width: 100%;
		top:0px;
		left:0px;
		}
#download{background:yellow;
		border: 0px solid red;
		z-index: 9999; 
		position: fixed;
		width: 100%;
		bottom:0px;
		left:0px;
		}
</style>	
<form method='POST' id="form">	
<table id="seach">	
	<tr style='height: 20px;'>
		<td style='height: 20px; vertical-align: top; width:2%;'>Поиск</td>
		<td style='height: 20px; vertical-align: top; width:93%;'><input style="width:100%;" id="name" name="name" placeholder="Поиск (название, описание и тд.)" value="<?echo $_POST["name"];?>"></td> 
		
		<td style='height: 20px; vertical-align: top; width:2%;'><input type="submit" id="submit" name="submit" value="Поиск"></td> 
		<td style='height: 20px; vertical-align: top; width:2%;'><button onclick="document.getElementById('name').value=''; document.getElementById('form').submit.click();">Сброс</button></td> 
	</tr>
</table>	
</form>
<table style='height: 20px;'>
	<tr style='height: 20px;'>
		<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Название фирмы</td>
		<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>O фирме</td> 
	</tr>
</table>
<?
if($_POST['name']!=NULL){

	$sql = 'SELECT * FROM `sclad` 
	WHERE 
		`id` LIKE "%'. $_POST['name'] .'%" or 
		`sclad` LIKE "%'. $_POST['name'] .'%" or 
		`about` LIKE "%'. $_POST['name'] .'%" 
	;';
	$_POST["name"]=NULL;
	
}
else{

	$sql = 'SELECT * FROM `sclad` WHERE `id`;';
	$_POST["name"]=NULL;
}

	$data = $mysqli->query($sql);
	$row = $data->num_rows;
	
	echo "<table id='datatable'>";
		//echo "<tr>";
		//	echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
		//		echo "№"; 
		//	echo "</td>";
			
		//echo "</tr>";
		echo "<tr>";
		
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo "№"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo "id"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo "Наименование"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo "О складе"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo "OrderDate"; 
			echo "</td>";
			echo "<td style='width:0.5%; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo ""; 
			echo "</td>";
			echo "<td style='width:2%; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo ""; 
			echo "</td>";
		echo "</tr>";
			
			
	
	while($res = $data->fetch_assoc())
	{
		echo "<tr>";
		
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo "".(++$i); 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo '<input id="id" name="id" value="'.$res['id'].'">'; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo '<input id="sclad'.$res['id'].'" name="sclad" value="'.$res['sclad'].'">'; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo '<input id="about'.$res['id'].'" name="about" value="'.$res['about'].'">'; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo '<input readonly value="'.$res['OrderDate'].'">'; 
			echo "</td>";
			echo "<td style='width:0.5%; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo "<button onclick='del(".$res['id'].");'>-</button>"; 
			echo "</td>";
			echo "<td style='width:2%; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo "<button onclick='go(".$res['id'].");'>Сохранить</button>"; 
			echo "</td>";
		
		echo "</tr>";
	}
	echo "</table>";
	if($row<1){echo "<table><tr><td>Нет складов</td></tr></table>";}

?>
<div id="news" style="width:100%;"> <button style="width:100%;" onclick="addin();">Добавить</button></div>
<script>

function addin(){
	var n=<?echo "".(++$i);?>;
	document.getElementById("news").innerHTML="";
	
	document.getElementById("datatable").innerHTML+="<tr id='in1'></tr>";
	document.getElementById("in1").innerHTML+="<td id='in2'></td><td id='in3'></td><td id='in4'></td><td id='in5'></td><td id='in6'></td><td id='in7'></td><td id='in8'></td>";
	document.getElementById("in2").innerHTML+=n;
	document.getElementById("in3").innerHTML+="<input readonly style='border: 1px solid black;' id='new_id' value='"+n+"'>";
	document.getElementById("in4").innerHTML+="<input style='border: 1px solid black;' id='new_sclad'  value=''>";
	document.getElementById("in5").innerHTML+="<input style='border: 1px solid black;' id='new_about'  value=''>";
	document.getElementById("in6").innerHTML+="";
	document.getElementById("in7").innerHTML+="";
	document.getElementById("in8").innerHTML+="<button onclick='gonew();'>Сохранить</button>";
	
	alert("1");	
}
</script>
<form method='POST' id='del' style="display:none;">
	<input id="id_del" name="id_del" value="">
</form>

<form method='POST' id='add' style="display:none;">
	<input id="new_id1"  name='new_id' value="">
	<input id="new_sclad1" name='new_sclad' value="">
	<input id="new_about1" name='new_about' value="">
</form>

<form method='POST' id='formsclad' style="display:none;">
	<input id="id_post" name="id_post" value="">
	<input id="sclad_post" name="sclad_post" value="">
	<input id="about_post" name="about_post" value="">
</form>
<table id="download" style="text-align:left;">	
	<tr style='height: 20px;text-align:left;'>
		<td style='height: 20px; vertical-align: top; width:10%; text-align:left;'>
        
        <button onclick='window.close();'>Закрыть</button>
        
		<font style="color:#F00;  font-weight: 900;">Внимание! Все изменения будут сохранены.</font>
		
		</td> 
	</tr>
</table>

<script>
		function gonew()
		{
			document.getElementById("new_id1").value=document.getElementById("new_id").value;
			document.getElementById("new_sclad1").value=document.getElementById("new_sclad").value;
			document.getElementById("new_about1").value=document.getElementById("new_about").value;
			
			document.getElementById("add").submit();
		}



		function go(x)
		{
		var sclad = "sclad"+x;
		var about = "about"+x;
		
			document.getElementById("id_post").value=x;
			document.getElementById("sclad_post").value=document.getElementById(sclad).value;
			document.getElementById("about_post").value=document.getElementById(about).value;
			
			document.getElementById("formsclad").submit();
		}	
		function del(x)
		{
			document.getElementById("id_del").value=x;
			document.getElementById("del").submit();
		}	
</script>
<??>
