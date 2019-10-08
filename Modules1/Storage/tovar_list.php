<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 

							
				?>
				
<title>Список товаров</title>
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
*{
	font-family: YS Text,sans-serif;
    font-weight: 400;
    font-style: normal;
    font-stretch: normal;
    font-size: 14px;
    line-height: 20px;
	border-collapse: collapse;
	cursor:pointer;

}
   table#datatable tr:hover {
	   transition: 0.3s;
	   transform: scale(1.012);
    background: #fffff;
    /*border:1px solid #e6e6e6;*/
	box-shadow:0px 0px 23px 1px rgba(0,0,0,0.29);
	-webkit-box-shadow:0px 0px 23px 1px rgba(0,0,0,0.29);
	-moz-box-shadow:0px 0px 23px 1px rgba(0,0,0,0.29);
	
   }

table,tr,td{
	background: #ffffff00;
border-collapse: collapse;
text-align:center;
}
#seach{background:green;
	
		z-index: 9999; 
		position: fixed;
		width: 100%;
		top:0px;
		left:0px;
		}
#download{background:green;
		
		z-index: 9999; 
		position: fixed;
		width: 100%;
		bottom:0px;
		left:0px;
		}
</style>
<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>
<script>
$(window).focus(function() {

// Здесь что угодно после возвращения во вкладку
location.href=location.href;
});

</script>
<body style="zoom: 0.9;">
<form method='POST' id="form">	
<table id="seach">	
	<tr style='height: 20px;'>
		<td style='height: 20px; vertical-align: top; width:2%;'>Поиск</td>
		<td style='height: 20px; vertical-align: top; width:93%;'>
			<input style="width:100%;" id="name" name="name" list="seachnn" placeholder="Поиск (название, описание и тд.)" value="<?echo $_POST["name"];?>">
		</td> 
		<td style='height: 20px; vertical-align: top; width:2%;'>
			<input type="submit" id="submit" name="submit" value="Поиск"></td> 
		<td style='height: 20px; vertical-align: top; width:2%;'>
			<button onclick="document.getElementById('name').value=''; document.getElementById('form').submit.click();">
				Сброс
			</button>
		</td> 
	</tr>
</table>	
<form>
<table style='height: 20px;'>
	<tr style='height: 20px;'>
		<td style='height: 20px; vertical-align: top;  '>Название фирмы</td>
		<td style='height: 20px; vertical-align: top;  '>O фирме</td> 
	</tr>
</table>
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
	

	echo "<table id='datatable' style='width:100%; margin-bottom:200px;'>";
		//echo "<tr>";
		//	echo "<td style='height: 20px; vertical-align: top;  '>";
		//		echo "№"; 
		//	echo "</td>";
			
		//echo "</tr>";
		echo "<tr>";
		
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "№"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "id"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "Артикул"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "Наименование"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "Ед. изм."; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  background:#CCFFCB88;'>";
				echo "Факт."; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  background:#CCFFCB88;'>";
				echo "Доступ."; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  background:#CCFFCB88;'>";
				echo "Куплено"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "РРС"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "Закупка(1шт)"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "Продажа(1шт)"; 
			echo "</td>";
			/*echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "ОПТ мал."; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "ОПТ круп."; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "Контрагент"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "Производитель"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "Склад"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "Код (склад)"; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "Штрих код"; 
			echo "</td>";*/
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "Активно"; 
			echo "</td>";
			/*echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "Скидка"; 
			echo "</td>";*/

		
		echo "</tr>";
				
			
	//(`id`, `art`, `name`, `unit`, `fact`, `dost`, 
	//`bron`, `kup`, `rrc`, `sum_z`, `sum_p`, `opt_l`, 
	//`opt_b`, `kagent`, `firma`, `group`, `2group`, 
	//`name_print`, `nds`, `kod_s`, `shtrih`, `comment`, `personal`,
	//`sclad`, `active`, `photo_1`, `photo_2`, `photo_3`, `photo_4`, 
	//`video`, `seo`, `sertifikat`, `skidka`, `width`, `height`, 
	//`length`, `massa`, `prosmo`, `OrderDate`)
			
	
function russian_date($terr){
	

$date=explode(".", date('d.m.Y', strtotime(date($terr))));
switch ($date[1]){
case 1: $m='января'; break;
case 2: $m='февраля'; break;
case 3: $m='марта'; break;
case 4: $m='апреля'; break;
case 5: $m='мая'; break;
case 6: $m='июня'; break;
case 7: $m='июля'; break;
case 8: $m='августа'; break;
case 9: $m='сентября'; break;
case 10: $m='октября'; break;
case 11: $m='ноября'; break;
case 12: $m='декабря'; break;
}
echo $date[0].'&nbsp;'.$m.'&nbsp;'.$date[2].' г.';
}


	
	$dateold=0;
	$datenew='2018-05-13 11:26:10';
	while($res = $data->fetch_assoc())
	{
		
			$dateday = date_diff(new DateTime($datenew), new DateTime($res['OrderDate']))->days;
			
			if($dateold==0 || $dateday!=0){
				
				$datenew=$res['OrderDate'];
				
				$ddaattaa = date_diff(new DateTime(), new DateTime($notifications['OrderDate']))->days;
				
				echo "<tr><td style='height: 20px; vertical-align: top; background:#d5d5d5;margin-top:4px;'  colspan='13' >";
				
				$fdfdffd=date('d.m.Y', strtotime(date($res['OrderDate'])));
				
				echo russian_date($fdfdffd);
				
				echo "</td></tr>";
				
				$dateold=10000;
			}
		
		
		$newWin= 'newWin = window.open("tovar_red.php?id='.$res['id'].'" ,"", "width=1200,height=700,left=200,top=200,menubar=no,toolbar=no,location=no");';
		echo "<tr onclick='".$newWin."'>";
		
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo "".(++$i); 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['id']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['art']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['name']; 
				$seachnn.='<option value="'.$res['name'].'">'.$res['id'].'</option>';
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['unit']; 
			echo "</td>";
			if(((int)$res['dost'])=="0") echo "<td style='height: 20px; vertical-align: top;  background:#FF0000'>";
			else echo "<td style='height: 20px; vertical-align: top;  background:#CCFFCB88;'>";
				echo (int)$res['dost']+(int)$res['bron']; 
			echo "</td>";
			if($res['dost']=="0") echo "<td style='height: 20px; vertical-align: top;  background:#FF0000'>";
			else echo "<td style='height: 20px; vertical-align: top;  background:#CCFFCB88;'>";
				echo $res['dost']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  background:#CCFFCB88;'>";
				echo $res['kup']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['rrc']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['sum_z']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['sum_p']; 
			echo "</td>";
			/*echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['opt_l']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['opt_b']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['kagent']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['firma']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['sclad']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['kod_s']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['shtrih']; 
			echo "</td>";*/
			if($res['active']=="yes") {echo "<td style='height: 20px; vertical-align: top;  background:#50DA50'>"; echo "Да";}
			else{ echo "<td style='height: 20px; vertical-align: top;  background:#FF0000'>"; echo "Нет";}
				 
			echo "</td>";
			/*echo "<td style='height: 20px; vertical-align: top;  '>";
				echo $res['skidka']; 
			echo "</td>";*/

		
		echo "</tr>";
	}
	echo "</table>";
	if($row<1){echo "<table><tr><td>НЕТ ТОВАРОВ</td></tr></table>";}

?>
<table id="download">	
	<tr style='height: 20px;'>
		<td style='height: 20px; vertical-align: top; width:10%;'>
		
		<button><a download="data_1243.xls" href="#" id="anchorNewApi-xls" onclick="return newApi('xls');">Export to Excel: XLS format</a></button>
        
        <button><a download="data_123.xlsx" href="#" id="anchorNewApi-xlsx" onclick="return newApi('xlsx');">Export to Excel: XLSX format</a></button>
        
		
		
		</td> 
	</tr>
</table>

<datalist id="seachnn">
<?echo $seachnn;?>
</datalist>