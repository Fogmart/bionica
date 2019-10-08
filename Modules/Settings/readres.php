<?  
require "../../connect.php"; //соединение БД // login
if($_SESSION['admin']!=1)
if($_SESSION['store']!=1)
if($_SESSION['direct']!=1)		
exit;
$sql = 'SELECT * FROM `adres` WHERE `id`;';
				$data = $mysqli->query($sql);
				$row = $data->num_rows;
				$res = $data->fetch_assoc(); 	

?>
<title>Редактировать адрес организации</title>
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
td{border:1px solid black;}
table{width:100%;}
input{width:100%;}
</style>
        <script src="js/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="../jquery.kladr.min.js" type="text/javascript"></script>
        <script src="js/form_with_map.js" type="text/javascript"></script>
		<link href="../jquery.kladr.min.css" rel="stylesheet">
        <script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script>
var timerId = setInterval(func, 2000);
function func() {
	if(document.getElementById("type_region_from").innerHTML!=""){
  document.getElementById("type_region").innerHTML=document.getElementById("type_region_from").innerHTML;
  document.getElementById("region_type").value=document.getElementById("type_region").innerHTML;

	}
	if(document.getElementById("index_from").innerHTML!="")
	document.getElementById("index").value=	document.getElementById("index_from").innerHTML;

	if(document.getElementById("apartment").value!=""){
	document.getElementById("full_adres").value=document.getElementById("address").innerHTML+", кв. "+document.getElementById("apartment").value;
	document.getElementById("office").value=""; 
	}
	
	if(document.getElementById("office").value!=""){
	document.getElementById("full_adres").value=document.getElementById("address").innerHTML+", оф. "+document.getElementById("office").value;
	document.getElementById("apartment").value="";
	}

	if((document.getElementById("office").value=="")&&(document.getElementById("apartment").value==""))
		document.getElementById("full_adres").value=document.getElementById("address").innerHTML;
	
	if(document.getElementById("pass_admin").value!="")document.getElementById("send").type="submit"; 
}

</script>



<div class="address">
<form method='POST' class="js-form-address" name="myForm" id="myForm">
					<table>
					<tr style='height: 20px;'>
						<td style=' width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Полный адрес</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><p id="address" class="value" style="display:none;"></p><input onclick="func();" name="full_adres" type="text" id="full_adres" value="<?echo $res['full_adres'];?>"/></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>Индекс</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>
							<div class="addition">
								<div class="js-log">
									<div id="zip" style="display: none;">
										<span style="display:none;" class="name"></span> 
										<span style="display:none;" class="value" id="index_from"></span>
										<input onclick="func();" name="index" type="text" id="index" value="<?echo $res['index'];?>"/>
									</div>
								</div>
							</div>
						</td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Страна</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Россия</td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><label id="type_region">Регион</label><input id="region_type" name="region_type" type="text" value="<?echo $res['type_region'];?>" style="display:none;"></td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><div class="field"><label style="display:none;" id="type_region_from"></label><input name="region" type="text" value="<?echo $res['region'];?>"></div></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Город</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><div class="field"><input onclick="func();" name="city" type="text" value="<?echo $res['city'];?>"></div></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>Улица</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><div class="field"><input onclick="func();" name="street" type="text" value="<?echo $res['street'];?>"></div></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Дом</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><div class="field"><input onclick="func();" name="building" type="text" value="<?echo $res['building'];?>"></div></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>Квартира</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><input onclick="func();" name="apartment" type="text" id="apartment" value="<?echo $res['apartment'];?>"></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Офис</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><input onclick="func();" name="office" type="text" id="office" value="<?echo $res['office'];?>"></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>Телефон 1</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><input name="tel1" type="text" id="tel1" value="<?echo $res['tel1'];?>"></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Телефон 2</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><input name="tel2" type="text" id="tel2" value="<?echo $res['tel2'];?>"></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>viber (тел)</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><input name="viber" type="text" id="viber" value="<?echo $res['viber'];?>"></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>whatsapp (тел)</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><input name="whatsapp" type="text" id="whatsapp" value="<?echo $res['whatsapp'];?>"></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>telegram (имя польз.)</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><input name="telegram" type="text" id="telegram" value="<?echo $res['telegram'];?>"></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>vk (ссылка)</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><input name="vk" type="text" id="vk" value="<?echo $res['vk'];?>"></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>ok (ссылка)</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><input name="ok" type="text" id="ok" value="<?echo $res['ok'];?>"></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>twitter (ссылка)</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><input name="twitter" type="text" id="twitter" value="<?echo $res['twitter'];?>"></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>email организации</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><input name="email" type="text" id="email" value="<?echo $res['email'];?>"></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>facebook (ссылка)</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><input name="fb" type="text" id="fb" value="<?echo $res['fb'];?>"></td> 
					</tr>
					<tr>
						<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>Пароль администратора</td> 
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><input value='' type='password' name='pass_admin' id="pass_admin" style='width:100%;' /></td>
					</tr>
					<tr>
					<td style='width:150px; height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>Сохранить</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>
							<input type='button' name='submit' value='Сохранить' style='width:49%;' id="send" />
							<input type='button' name='' onclick='window.close();' value='Отменить'  style='width:49%;' />
						</td>
					</tr>
					</table>

</form>
</div>

<?
if($_POST["submit"]!=NULL){
$sql = 'SELECT * FROM `users` WHERE `id`="'. $_SESSION['id'] .'" and `pass`="'. $_POST['pass_admin'] .'";';
				$data = $mysqli->query($sql);
				$row = $data->num_rows;
				if($row==1)
				{
					$res = $data->fetch_assoc();
					
					if($_POST["submit"]!=NULL)
					if($_SESSION['admin']=="1")	
					{
						if($_POST["region_type"]=="")$_POST["region_type"]=" ";
						if($_POST["office"]=="")$_POST["office"]=" ";
						if($_POST["apartment"]=="")$_POST["apartment"]=" ";
						

						function telefon($enter)
						{
							//вырежет всё, кроме цифр
							$enter= preg_replace("#[^\d]#", "", $enter);
							if($enter[0]=='7' || $enter[0]=='8')
							if($enter[1]=='9'){
								//удалит код страны
								$enter = substr($enter, 1);
							}
							return $enter;
						}
						
						
						$_POST['tel1'] = telefon($_POST['tel1']);
						$_POST['tel2'] = telefon($_POST['tel2']);
						$_POST['whatsapp'] = telefon($_POST['whatsapp']);
						$_POST['viber'] = telefon($_POST['viber']);
						
						$mysqli->query("
						UPDATE `adres`
						SET `full_adres` = '".$_POST["full_adres"]."',   
							`index` = '".$_POST["index"]."',
							`country` = 'Россия',
							`region` = '".$_POST["region"]."',
							`type_region` = '".$_POST["region_type"]."',
							`city` = '".$_POST["city"]."',
							`street` = '".$_POST["street"]."',
							`house` = '".$_POST["building"]."',
							`office` = '".$_POST["office"]."',
							`tel1` = '".$_POST["tel1"]."',
							`tel2` = '".$_POST["tel2"]."',
							`viber` = '".$_POST["viber"]."',
							`whatsapp` = '".$_POST["whatsapp"]."',
							`telegram` = '".$_POST["telegram"]."',
							`vk` = '".$_POST["vk"]."',
							`ok` = '".$_POST["ok"]."',
							`twitter` = '".$_POST["twitter"]."',
							`email` = '".$_POST["email"]."',
							`fb` = '".$_POST["fb"]."',
							`apartment` = '".$_POST["apartment"]."'
						WHERE `id`=1;
						");
						printf("Сообщение ошибки: %s\n", $mysqli->error);
						
						$_POST["submit"]=NULL;
						
						echo "<script>window.close();</script>";
	
					}
				}
				else
				{
				echo "Не правильный пароль";	
				echo "".$_POST["full_adres"]."".$_POST["index"]."".$_POST["region"]."".$_POST["region_type"]."".$_POST["city"]."".$_POST["street"]."".$_POST["building"]."".$_POST["office"]."".$_POST["apartment"]."";
				}
}
?>