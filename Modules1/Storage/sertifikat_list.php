<?
require "../../connect.php"; //соединение БД // login
if($_SESSION['store']!="1")	exit();
							
				?>
				
<title>Сертификаты</title>
<meta charset="utf-8">
<script src="dist/excellentexport.js"></script>
<script>
            function newApi(format) {
                return ExcellentExport.convert({
                    anchor: 'anchorNewApi-' + format,
                    filename: 'firm_<?php echo date( "d.m.y H:i" );?>.' + format,
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
<form method='POST'>	
<table id="seach">	
	<tr style='height: 20px;'>
		<td style='height: 20px; vertical-align: top; width:2%;'>Поиск</td>
		<td style='height: 20px; vertical-align: top; width:95%;'><input style="width:100%;" name="name" placeholder="Поиск (название, описание)" value="<?echo $_POST["name"];?>"></td> 
		
		<td style='height: 20px; vertical-align: top; width:2%;'><input type="submit" name="submit" value="Поиск"></td> 
	</tr>
</table>	
<form>
<table style='height: 20px;'>
	<tr style='height: 20px;'>
		<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Сертификаты</td>
		<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>O фирме</td> 
	</tr>
</table>
<?
if($_POST['name']!=NULL){

	$sql = 'SELECT * FROM `sertifikat` WHERE `sertifikat` LIKE "%'. $_POST['name'] .'%" or `about` LIKE "%'. $_POST['name'] .'%";';
	$_POST["name"]=NULL;
}
else{

	$sql = 'SELECT * FROM `sertifikat` WHERE `id`;';
	$_POST["name"]=NULL;
}

	$data = $mysqli->query($sql);
	$row = $data->num_rows;
	echo "<table id='datatable'>";
		echo "<tr>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo "№"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo "Название";
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo "Описание";
			echo "</td>";
		echo "</tr>";
	
	while($res = $data->fetch_assoc())
	{
		echo "<tr>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo $res['id']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo $res['sertifikat']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo '
				<a  href="../../../../../'.$res['about'].'">
				<img style="height:100px;" src="../../../../../'.$res['about'].'"/>
				</a>
				'; 
			echo "</td>";
		echo "</tr>";
	}
	echo "</table>";


?>
<table id="download">	
	<tr style='height: 20px;'>
		<td style='height: 20px; vertical-align: top; width:10%;'>
		
		<button><a download="data_1243.xls" href="#" id="anchorNewApi-xls" onclick="return newApi('xls');">Export to Excel: XLS format</a></button>
        
        <button><a download="data_123.xlsx" href="#" id="anchorNewApi-xlsx" onclick="return newApi('xlsx');">Export to Excel: XLSX format</a></button>
        
		
		
		</td> 
	</tr>
</table>


	
