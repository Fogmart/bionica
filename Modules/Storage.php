Склад
<?php if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
if($_SESSION['admin']!=1)
if($_SESSION['store']!=1)
if($_SESSION['direct']!=1)	
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

							
				?>

<table style='height: 20px;'>
	<tr style='height: 20px;'>
        <td colspan="5" style='height: 20px; text-align:center; vertical-align: top; border:1px solid black; background:#CCCCFF'>Краткая статистика</td>
    </tr>
	<? 
	$sql = 'SELECT * FROM `tovar` WHERE `id`;'; 
		$data = $mysqli->query($sql);
		$row_1 = $data->num_rows;
	
	$sql = 'SELECT * FROM `tovar` WHERE (`dost`="0" and `zakaz`="no") or `active`="no";'; 
		$data = $mysqli->query($sql);
		$row_2 = $data->num_rows;
	?>
    <tr style='height: 20px;'>
		<td style='height: 20px; width:32%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><u onclick="tovar_list();">Всего товаров</u></td>
        <script>function tovar_list(){
				newWin = window.open("Modules/Storage/tovar_list.php" ,"", "width=1200,height=700,left=200,top=200,menubar=no,toolbar=no,location=no");
				}	
			</script>
		<td style='height: 20px; width:1%;'></td>
        <td style='height: 20px; width:32%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><u onclick="tovar_zak();">Закончилось</td>
		<script>function tovar_zak(){
				newWin = window.open("Modules/Storage/tovar_zak.php" ,"", "width=1200,height=700,left=200,top=200,menubar=no,toolbar=no,location=no");
				}	
			</script>
		<td style='height: 20px; width:1%;'></td>
		<td style='height: 20px; width:32%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><u onclick="tovar_top();">ТОП продоваемых</td>
    </tr>
	<tr style='height: 20px;'>
		<td style='height: 20px; width:32%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo $row_1." (наименований)";?></td>
        <td style='height: 20px; width:1%;'></td>
        <td style='height: 20px; width:32%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB; <?if($row_2>0)echo "background:#FFCBCB;";?>'><?echo $row_2." (товаров)";?></td>
		<td style='height: 20px; width:1%;'></td>
		<td style='height: 20px; width:32%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><u onclick="tovar_top();">Открыть</td>
		<script>function tovar_top(){
				newWin = window.open("Modules/Storage/tovar_top.php" ,"", "width=1200,height=700,left=200,top=200,menubar=no,toolbar=no,location=no");
				}	
			</script>
	</tr>
	<tr style='height: 20px;'>
        <td colspan="3" style='height: 20px;'></td>
    </tr>
</table>

<table style='height: 20px;'>
	<tr style='height: 20px;'>
        <td colspan="3" style='height: 20px; text-align:center; vertical-align: top; border:1px solid black; background:#CCCCFF'>Наши склады</td>
    </tr>
    <tr style='height: 20px;'>
		<td style='height: 20px; width:49%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><u onclick="sclad_list();">Список</u></td>
        <td style='height: 20px; width:1%;'></td>
        <td style='height: 20px; width:49%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><u onclick="sclad_red();">Редактировать</u></td>
			<script>
			function sclad_list(){
				newWin = window.open("Modules/Storage/sclad_list.php" ,"", "width=1200,height=700,left=200,top=200,menubar=no,toolbar=no,location=no");
				}	
				function sclad_red(){
				newWin = window.open("Modules/Storage/sclad_red.php" ,"", "width=1200,height=700,left=200,top=200,menubar=no,toolbar=no,location=no");
				}
			</script>
	</tr>
	<tr style='height: 20px;'>
        <td colspan="3" style='height: 20px;'></td>
    </tr>
</table>

<table style='height: 20px;'>
	<tr style='height: 20px;'>
        <td colspan="3" style='height: 20px; text-align:center; vertical-align: top; border:1px solid black; background:#CCCCFF'>Группы товаров</td>
    </tr>
    <tr style='height: 20px;'>
		<td style='height: 20px; width:49%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><u onclick="group_list();">Список</u></td>
			<script>function group_list(){
				newWin = window.open("Modules/Storage/group_list.php" ,"", "width=1200,height=700,left=2,top=2,menubar=no,toolbar=no,location=no");
				}	
			</script>
        <td style='height: 20px; width:1%;'></td>
        <td style='height: 20px; width:49%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><u onclick="group_red();">Редактировать</u></td>
			<script>function group_red(){
				newWin = window.open("Modules/Storage/group_red.php" ,"", "width=1200,height=700,left=20,top=20,menubar=no,toolbar=no,location=no");
				}	
			</script>
    </tr>
	<tr style='height: 20px;'>
        <td colspan="3" style='height: 20px;'></td>
    </tr>
</table>

<table style='height: 20px;'>
	<tr style='height: 20px;'>
        <td colspan="3" style='height: 20px; text-align:center; vertical-align: top; border:1px solid black; background:#CCCCFF'>Производители (фирмы)</td>
    </tr>
    <tr style='height: 20px;'>
		<td style='height: 20px; width:49%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><u onclick="firma_list();"> Список</u></td>
			<script>function firma_list(){
				newWin = window.open("Modules/Storage/firma_list.php" ,"", "width=1200,height=700,left=200,top=200,menubar=no,toolbar=no,location=no");
				}	
			</script>
        <td style='height: 20px; width:1%;'></td>
        <td style='height: 20px; width:49%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><u onclick="firma_red();">Редактировать</u></td>
		<script>function firma_red(){
				newWin = window.open("Modules/Storage/firma_red.php" ,"", "width=1200,height=700,left=200,top=200,menubar=no,toolbar=no,location=no");
				}	
			</script>
    </tr>
	<tr style='height: 20px;'>
        <td colspan="3" style='height: 20px;'></td>
    </tr>
</table>

<!--<table style='height: 20px;'>
	<tr style='height: 20px;'>
        <td colspan="3" style='height: 20px; text-align:center; vertical-align: top; border:1px solid black; background:#CCCCFF'>Сертификаты</td>
    </tr>
    <tr style='height: 20px;'>
		<td style='height: 20px; width:49%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><u onclick="sertifikat_list();">Список</u></td>
			<script>function sertifikat_list(){
				newWin = window.open("Modules/Storage/sertifikat_list.php" ,"", "width=1200,height=700,left=200,top=200,menubar=no,toolbar=no,location=no");
				}	
			</script>
        <td style='height: 20px; width:1%;'></td>
        <td style='height: 20px; width:49%; text-align:center; vertical-align: top; border:1px solid black; background:#FFFFCB'><u onclick="sertifikat_red();">Редактировать</u></td>
		<script>function sertifikat_red(){
				newWin = window.open("Modules/Storage/sertifikat_red.php" ,"", "width=1200,height=700,left=200,top=200,menubar=no,toolbar=no,location=no");
				}	
			</script>
    </tr>
	<tr style='height: 20px;'>
        <td colspan="3" style='height: 20px;'></td>
    </tr>
</table>-->
