<?
require "../../connect.php"; //соединение БД // login?>
				
<title>Карточка товара</title>
<meta charset="utf-8">

<?
if($_SESSION['store']!="1")	exit();



if($_GET['id']!=NULL){

	$sql = 'SELECT * FROM `tovar` WHERE `id`="'.$_GET['id'].'";'; 
	
	$data = $mysqli->query($sql);
	$row = $data->num_rows;
	
}

if($row<1){echo "<table><tr><td>НЕТ ТОВАРОВ</td></tr></table>";}

if($row==0)exit();

$res = $data->fetch_assoc();
				

?>



<style>
*{
	margin:0;
	padding:0;
	text-align:center;
	font-size:14px;
	
}
h2{
	font-size:18px;
	padding-top:4px;
	margin-bottom:4px;
}
body{
	background: #fff;
	
}
#download{background:green;
		border: 0px solid red;
		z-index: 9999; 
		position: fixed;
		width: 100%;
		bottom:0px;
		left:0px;
		text-align:left;
		}
table{width:100%;}
td{border-right:0px solid black;}
input{width:100%; height:100%; opacity:1;}
select{width:100%;}
</style>
<table>
	<tr><td colspan="12" style="height:30px;"></td></tr>
	<tr><td colspan="12" style="border-bottom:1px solid black;"><h2>Номера</h2></td></tr>
	<tr>
		<td colspan="3">Номер в системе
		</td>
		<td colspan="3"><input readonly  style="display:none;" type="none" id="id" name="id" value="<?echo $res['id'];?>"><?echo $res['id'];?>
		</td>
		<td colspan="3">Склад
		</td>
		<td colspan="3"><input readonly  value="<?echo $res['sclad'];?>">
		</td>
	</tr>
	<tr>
		<td colspan="3">Артикул
		</td>
		<td colspan="3"><input readonly  value="<?echo $res['art'];?>">
		</td>
		<td colspan="3">Код на складе
		</td>
		<td colspan="3"><input readonly  id="kod_s" name="kod_s" value="<?echo $res['kod_s'];?>">
		</td>
	</tr>
	<tr>
		<td colspan="3">Активно
		</td>
		<td colspan="3"><input readonly  id="active" name="active" value="<?if($res['active']!="yes") echo "Нет"; else echo "Да"; ?>">
		</td>
		<td colspan="3">Штрих-код
		</td>
		<td colspan="3"><input readonly  value="<?echo $res['shtrih'];?>">
		</td>
	</tr>
	<tr><td colspan="12" style="border-bottom:1px solid black;"><h2>Название (номенклатура)</h2></td></tr>
	<tr>
		<td colspan="3">Наименование
		</td>
		<td colspan="9"><input readonly  id="name" name="name" value="<?echo $res['name'];?>">
		</td>
	</tr>
	<tr><td colspan="12" style="height:10px;"></td></tr>
	<tr>
		<td colspan="3">Наименование (печать)
		</td>
		<td colspan="9"><input readonly  id="name_p" name="name_p" value="<?echo $res['name_print'];?>">
		</td>
	</tr>
	<tr><td colspan="12" style="height:10px;"></td></tr>
	<tr>
		<td colspan="3">Производитель
		</td>
		<td colspan="9"><input readonly  value="<?echo $res['firma'];?>">
		</td>
	</tr>
	<tr><td colspan="12" style="height:10px;"></td></tr>
	<tr>
		<td colspan="3">Контрагент
		</td>
		<td colspan="9"><input readonly  value="<?echo $res['kagent'];?>">
		</td>
	</tr>
	<tr><td colspan="12" style="border-bottom:1px solid black;"><h2>Категории и качества</h2></td></tr>
	<tr>
		<td colspan="2">Сертификат
		</td>
		<td colspan="2"><input readonly  value="<?echo $res['sertifikat'];?>">
		</td>
		<td colspan="2">Группа 1
		</td>
		<td colspan="2"><input readonly  value="<?echo $res['group'];?>">
		</td>
		<td colspan="2">Группа 2
		</td>
		<td colspan="2"><input readonly  value="<?echo $res['2group'];?>">
		</td>
	</tr>
	<tr><td colspan="12" style="border-bottom:1px solid black;"><h2>Количество</h2></td></tr>
	<tr>
		<td colspan="2">Ед. изм.
		</td>
		<td colspan="2"><input readonly  value="<?echo $res['unit'];?>">
		</td>
		<td colspan="2" id="fact_enter">Фактическое
		</td>
		<td colspan="2"><input readonly  id="fact" name="fact" value="<?echo $res['fact'];?>">
		</td>
		<td colspan="2">Доступное
		</td>
		<td colspan="2"><input readonly  id="dost" name="dost" value="<?echo $res['dost'];?>">
		</td>
	</tr>
	<tr>
		<td colspan="4">
		</td>
		<td colspan="2">Забронировано
		</td>
		<td colspan="2"><?echo $res['bron'];?>
		</td>
		<td colspan="2">Куплено
		</td>
		<td colspan="2"><?echo $res['kup'];?>
		</td>
	</tr>
	<tr><td colspan="12" style="border-bottom:1px solid black;"><h2>Размеры и вес</h2></td></tr>
	<tr>
		<td colspan="2">Ширина (см) (x)
		</td>
		<td colspan="2"><input readonly  value="<?echo $res['width'];?>">
		</td>
		<td colspan="2">Длина (см) (y)
		</td>
		<td colspan="2"><input readonly  value="<?echo $res['height'];?>">
		</td>
		<td colspan="2">Высота (см) (z)
		</td>
		<td colspan="2"><input readonly  value="<?echo $res['length'];?>">
		</td>
	</tr>
	<tr>
		<td colspan="2">Вес (гр.)
		</td>
		<td colspan="2"><input readonly  value="<?echo $res['massa'];?>">
		</td>
		<td colspan="8">
		</td>
	</tr>
	<tr><td colspan="12" style="border-bottom:1px solid black;"><h2>Цена закупка</h2></td></tr>
	<tr>
		<td colspan="2">Цена (зак.)
		</td>
		<td colspan="2"><input readonly  id="sum_z" name="sum_z"  value="<?echo $res['sum_z'];?>">
		</td>
		<td colspan="2">НДС
		</td>
		<td colspan="2"><input readonly  id="nds" name="nds"  value="<?echo $res['nds'];?>">
		</td>
		<td colspan="2">Наценка
		</td>
		<td colspan="2"><input readonly  id="proc" name="proc"  value="0">
		</td>
	</tr>
	<tr>
		<td colspan="4">
		</td>
		<td colspan="2">Скидка
		</td>
		<td colspan="2"><input readonly  id="skidka"  name="skidka" value="<?echo $res['skidka'];?>">
		</td>
		<td colspan="4">
		</td>
	</tr>
	<tr><td colspan="12" style="border-bottom:1px solid black;"><h2>Цена продажи</h2></td></tr>
	<tr>
		<td colspan="3" id="name_sum_p">Цена (прод.)
		</td>
		<td colspan="3"><input readonly  id="sum_p" name="sum_p"  value="<?echo $res['sum_p'];?>">
		
		</td>
		<td colspan="3">Реком. цена
		</td>
		<td colspan="3"><input readonly  id="rrc"    name="rrc" value="<?echo $res['rrc'];?>">
		</td>
	</tr>
	<tr>
		<td colspan="3">ОПТ (мал.)
		</td>
		<td colspan="3"><input readonly  value="<?echo $res['opt_l'];?>">
		</td>
		<td colspan="3">ОПТ (круп.)
		</td>
		<td colspan="3"><input readonly  value="<?echo $res['opt_b'];?>">
		</td>
	</tr>
	<tr><td colspan="12" style="border-bottom:1px solid black;"><h2>Фото</h2></td></tr>
		<td colspan="12">
			<div style="width:100%; position:relelative;" id="areaimg">
			<?

			for($i=1; $i<=12; $i++)
			{
				if(isset($res['photo_'.$i]))
					if($res['photo_'.$i]!='')
						if($res['photo_'.$i]!=' ')
						{
							$max=$i;
							echo '<div style="background-image: url('.$res['photo_'.$i].'); background-size: contain; background-position: center; border:1px solid black; background-repeat: no-repeat; float:left; width:200px; height:209px;">';

							echo '<div style="vertical-align:bottom; background-color:#ebebeb;height:37px;">';

							echo '</div></div>';
							
							
						}

			}
			echo '<script>max='.++$max.';</script>';
			?>

			</div>
	</td>
	<tr><td colspan="12" style="border-bottom:1px solid black;"><h2>Видео</h2></td></tr>
	<tr>
		<td colspan="3">Видео
		</td>
		<td colspan="7"><input readonly  id="video" name="video" value="<?echo $res['video'];?>">
		</td>
		<td colspan="2"><u onclick="window.open(document.getElementById('video').value,'', '');">Просмотр</u>
	</tr>
	<tr><td colspan="12" style="border-bottom:1px solid black;"><h2>О товаре</h2></td></tr>
	<tr>
		<td colspan="12" id="comment_enter">Описание (коментарий верхний).
		</td>
	</tr>
	<tr>
		<td colspan="12" style="height:150px;">
		<textarea id="comment" name="comment" style="height:150px; width:100%; text-align:left; padding:4px;"><?echo $res['comment'];?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="12" id="comment_enter">Полное описание (нижний).
		</td>
	</tr>
	<tr>
		<td colspan="12" style="height:150px;">
		<textarea id="comment" name="comment" style="height:150px; width:100%; text-align:left; padding:4px;"><?echo $res['text'];?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="12">SEO (возможные запросы по товару) (через пробел.)
		</td>
	</tr>
	<tr>
		<td colspan="12" style="height:150px;">
		<textarea style="height:150px; width:100%; text-align:left; padding:4px;"><?echo $res['seo'];?></textarea>
		</td>
	</tr>
	<tr><td colspan="12" style="height:10px;"></td></tr>
	<tr>
		<td colspan="2">Редактировал:
		</td>
		<td colspan="2" style="text-align:left;"><?echo $res['personal'];?>
		</td>
		<td colspan="2">Создано:
		</td>
		<td colspan="2" style="text-align:left;"><?echo $res['OrderDate'];?>
		</td>
		<td colspan="2">Просмотрено:
		</td>
		<td colspan="2" style="text-align:left;"><?echo $res['prosmo'];?>
		</td>
	<tr>
	<tr><td colspan="12" style="height:150px;"></td></tr>
	
</table>
<table id="download" style="text-align:left;">	
	<tr style='height: 20px;text-align:left;'>
		<td style='height: 20px; vertical-align: top; width:10%; text-align:left;'>
		<button onclick='newWin = window.open("tovar_red.php?id=<?echo $_GET["id"];$_GET["id"]=NULL;?>" ,"", "width=1020,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");window.close();'>Редактировать</button>
        
        <button onclick='window.close();'>Закрыть</button>
        
		
		
		</td> 
	</tr>
</table>


	

	
	
?>