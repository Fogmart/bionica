<?
require "../../connect.php"; //соединение БД // login
if($_SESSION['store']!=1)	exit();
							
				?>
				
<title>Список складов</title>
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

table{width:100%;}
#seach{background:green;
		border: 0px solid red;
		z-index: 9999; 
		position: fixed;
		width: 100%;
		top:0px;
		left:0px;
		}
#download{background:green;
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
<form>
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
		
		echo "</tr>";
			
			
	
	while($res = $data->fetch_assoc())
	{
		echo "<tr>";
		
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo "".(++$i); 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo $res['id']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo $res['sclad']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo $res['about']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo $res['OrderDate']; 
			echo "</td>";

		
		echo "</tr>";
	}
	echo "</table>";
	if($row<1){echo "<table><tr><td>Нет складов</td></tr></table>";}

?>
<table id="download">	
	<tr style='height: 20px;'>
		<td style='height: 20px; vertical-align: top; width:10%;'>
		
		<button><a download="data_1243.xls" href="#" id="anchorNewApi-xls" onclick="return newApi('xls');">Export to Excel: XLS format</a></button>
        
        <button><a download="data_123.xlsx" href="#" id="anchorNewApi-xlsx" onclick="return newApi('xlsx');">Export to Excel: XLSX format</a></button>
        
		
		
		</td> 
	</tr>
</table>


	
