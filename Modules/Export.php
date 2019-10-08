<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
//foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>POST ".$key." = ".$value."</p>";} 

if(!(isset($_POST['submit'])))
{
	for($i=1; $i<=15; $i++)
	{
	$j=1;	
		
	$select[$i]='<select name="o'.$i.'">';
	$select[$i].='	<option></option>';
	
	if($i==($j++))
	$select[$i].='	<option selected>Проведен</option>';
	else
	$select[$i].='	<option>Проведен</option>';
	
	$select[$i].='	<option value="data1">01.01.2000</option>';

	if($i==($j++))
	$select[$i].='	<option value="data2" selected>01.01.2000  00:00:00</option>';
	else
	$select[$i].='	<option value="data2" >01.01.2000  00:00:00</option>';	

	$select[$i].='	<option value="data3" >01.01.2000 00:00:00 MSK</option>';

	if($i==($j++))
	$select[$i].='	<option value="fio" selected>ФИО(покупателя)</option>';
	else
	$select[$i].='	<option value="fio" >ФИО(покупателя)</option>';

	if($i==($j++))
	$select[$i].='	<option value="tel"  selected>Телефон</option>';
	else
	$select[$i].='	<option value="tel" >Телефон</option>';

	if($i==($j++))
	$select[$i].='	<option value="kolvo" selected>Количество</option>';
	else
	$select[$i].='	<option value="kolvo" >Количество</option>';

	if($i==($j++))
	$select[$i].='	<option value="sum_all" selected>Оплачено</option>';
	else
	$select[$i].='	<option value="sum_all" >Оплачено</option>';

	if($i==($j++))
	$select[$i].='	<option value="sum_all" selected>Отгружено</option>';
	else
	$select[$i].='	<option value="sum_all" >Отгружено</option>';

	if($i==($j++))
	$select[$i].='	<option value="sum_all" selected>Итого</option>';
	else
	$select[$i].='	<option value="sum_all" >Итого</option>';

	if($i==($j++))
	$select[$i].='	<option selected>Владелец</option>';
	else
	$select[$i].='	<option>Владелец</option>';

	if($i==($j++))
	$select[$i].='	<option value="art" selected>Артикул</option>';
	else
	$select[$i].='	<option value="art" >Артикул</option>';

	if($i==($j++))
	$select[$i].='	<option value="name" selected>Товар и услуга</option>';
	else
	$select[$i].='	<option value="name" >Товар и услуга</option>';

	if($i==($j++))
	$select[$i].='	<option value="full_adres" selected>Регион</option>';
	else
	$select[$i].='	<option value="full_adres">Регион</option>';

	if($i==($j++))
	$select[$i].='	<option value="email" selected>Почта</option>';
	else
	$select[$i].='	<option value="email" >Почта</option>';

	if($i==($j++))
	$select[$i].='	<option value="razm" selected>Размер</option>';
	else
	$select[$i].='	<option value="razm">Размер</option>';

	if($i==($j++))
	$select[$i].='	<option selected>Вид</option>';
	else
	$select[$i].='	<option>Вид</option>';


	$select[$i].='</select>';

	}


	echo '
	<form method="POST">
	<table>
		<tr>
			<td>
			Параметр
			</td>
			<td>
			Название столбца
			</td>
		</tr>';
		
	for($i=1; $i<=15; $i++)
	{
		echo '
		<tr>
			<td>
			'.$select[$i].'
			</td>
			<td>
			<input type="text" name="n'.$i.'" list="basik" value="">
			</td>
		</tr>
		';
	}


	echo '
		<tr>
			<td style="font-size:14px;">
			С (дата время)
			</td>
			<td>
			<input name="sdate" type="date" value=""> <input name="stime" type="time" value="12:00">
			</td>
		</tr>
		<tr>
			<td style="font-size:14px;">
			По (дата время)
			</td>
			<td>
			<input name="podate" type="date" value="'.date( "Y-m-d" ).'"> <input name="potime" type="time" value="12:00">
			</td>
		</tr>
	</table>
	<datalist id="basik">
	<option value="Дата и время">
	<option value="Дата создания">
	<option value="Дата последнего заказа">
	<option value="Контрагент">
	<option value="Наименование">
	<option value="Телефон для связи">
	<option value="Телефоны (только цифры)">
	<option value="Общий доступ">
	<option value="Статус">
	<option value="Оплачено">
	<option value="Отгружено">
	<option value="Итого">
	<option value="Владелец">
	<option value="Артикул">
	<option value="Товары и услуги">
	<option value="Регион">
	<option value="Проведен">
	<option value="Почта">
	<option value="Электронная почта">
	<option value="Размер">
	<option value="Вид">
	<option value="Количество">
	</datalist>

	<input type="submit" name="submit" value="Выгрузить">
	</form> ';

}
else
{
	?>
	<script src="Storage/dist/excellentexport.js"></script>
<script>
            function newApi(format) {
                return ExcellentExport.convert({
                    anchor: 'anchorNewApi-' + format,
                    filename: 'заказы_(<?php echo date('d.m.Y', strtotime(date($_POST['sdate'])))." ".date('d.m.Y', strtotime(date($_POST['podate'])));?>).' + format,
                    format: format
                }, [{
                    name: 'Sheet Name Here 1',
                    from: {
                        table: 'datatable'
                    }
                }]);
            }



        </script>
		<table id="download">	
	<tr style='height: 20px;'>
		<td style='height: 20px; vertical-align: top; width:10%;'>
		
		<button><a download="data_1243.xls" href="#" id="anchorNewApi-xls" onclick="return newApi('xls');">Export to Excel: XLS format</a></button>
        
        <button><a download="data_123.xlsx" href="#" id="anchorNewApi-xlsx" onclick="return newApi('xlsx');">Export to Excel: XLSX format</a></button>
        
		<font> * Не включая доставку</font>
		
		
		</td>
		
		
		
	</tr>
</table>
</br>
<font>период : ( <?php echo date('d.m.Y', strtotime(date($_POST['sdate'])))." - ".date('d.m.Y', strtotime(date($_POST['podate'])));?> )</font>
	<?
	$export_sql ="SELECT * FROM  `shopping` WHERE  `check` =  'ok' and `OrderDate` <=  '".$_POST['podate']." ".$_POST['potime'].":00' and `OrderDate` >=  '".$_POST['sdate']." ".$_POST['stime'].":00'  ";
	$export_data = $mysqli->query($export_sql);
	$export_row = $export_data->num_rows;

	echo '
	<style>
	*.nono td{border:1px solid black;
	font-size:14px;}
	</style>
	';

	echo '<table class="nono" id="datatable">';

	echo '<tr>';
	for($i=1; $i<=15; $i++)
	{
				if($i==1)
				{
					echo '<td>';
					echo '№';
					echo '</td>';	
				}	
		echo '<td>';
		echo $_POST['n'.$i];
		echo '</td>';	
	}
	echo '</tr>';

	while($export_res  = $export_data ->fetch_assoc())
	{
		if($export_res['art']==0) continue;
		
		$export_res['tel']=str_replace("+", "", $export_res['tel']);
		$export_res['tel']=str_replace("-", "", $export_res['tel']);
		$export_res['tel']=str_replace("(", "", $export_res['tel']);
		$export_res['tel']=str_replace(")", "", $export_res['tel']);
		
		echo '<tr>';
		for($i=1; $i<=15; $i++)
		{
				if($_POST['o'.$i]=="data2")
				{
					echo '<td>';
					echo date('d.m.Y H:i:s', strtotime(date($export_res['OrderDate'])));
					echo '</td>';
					continue;
				}
				if($_POST['o'.$i]=="data1")
				{
					echo '<td>';
					echo date('d.m.Y', strtotime(date($export_res['OrderDate'])));
					echo '</td>';
					continue;
				}
				if($_POST['o'.$i]=="data3")
				{
					echo '<td>';
					echo date('d.m.Y H:i:s', strtotime(date($export_res['OrderDate']))).' MSK';
					echo '</td>';
					continue;
				}
				if($i==1)
				{
					echo '<td>';
					echo $export_res['id'];
					echo '</td>';	
				}
				if($i==10)
				{
					echo '<td>';
					echo 'Вокзальная 4';
					echo '</td>';
					continue;				
				}				
			
			echo '<td>';
			echo $export_res[$_POST['o'.$i]];
			echo '</td>';	
		}
		echo '</tr>';
	}

	echo '</table>';
	
}

