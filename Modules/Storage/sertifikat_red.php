<?
require "../../connect.php"; //соединение БД // login

//foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>".$key." = ".$value."</p>";} //все запросы


if($_SESSION['store']!="1")exit();
					if($_SESSION['store']=="1")
					if($_POST["id_post"]!=NULL)
					if($_POST["sclad_post"]!=NULL)
					if($_POST["about_post"]!=NULL)
					{
					$_POST["about_post"] = str_replace(array('<br>', '</br>'), array('', ''), $_POST["about_post"]);
						$mysqli->query("
						UPDATE `sertifikat`
						SET `sertifikat` = '".$_POST["sclad_post"]."',`about` = '".$_POST["about_post"]."'
						WHERE `id`=".$_POST["id_post"].";
						");
						$_POST["submit"]=NULL;
						echo "<script>save=1; window.location = window.location.origin + window.location.pathname;</script>";
						//foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>".$key." = ".$value."</p>";} //все запросы
					}
					if($_SESSION['store']=="1")
					if($_POST["new_id"]!=NULL)
					if($_POST["new_sclad"]!=NULL)
					{
					$_POST["new_sclad"] = str_replace(array('<br>', '</br>'), array('', ''), $_POST["new_sclad"]);
						$mysqli->query('
		
						INSERT INTO `sertifikat` 
						(`sertifikat`,`about`) 
						VALUES
						("'.$_POST["new_id"].'","'.$_POST["new_sclad"].'");
						');
						$_POST["submit"]=NULL;
						$_POST["new_id"]=NULL;
						
						echo "<script>save=1; window.location = window.location.origin + window.location.pathname;</script>";
						
					}
					if($_SESSION['store']=="1")
					if($_POST["id_del"]!=NULL)
					{
					$mysqli->query("DELETE FROM `bionica-market`.`sertifikat` WHERE `sertifikat`.`id` = ".$_POST["id_del"].";");

					echo "<script>save=1; window.location = window.location.origin + window.location.pathname;</script>";
					}
?>		
<title>Список сертификатов РЕДАКТИРОВАНИЕ</title>
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
		<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>
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

	$sql = 'SELECT * FROM `sertifikat` 
	WHERE 
		`id` LIKE "%'. $_POST['name'] .'%" or 
		`sertifikat` LIKE "%'. $_POST['name'] .'%" or 
		`about` LIKE "%'. $_POST['name'] .'%" 
	;';
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
				echo "Изображение";
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
				echo $res['id']; 
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo '<input style="height:100%;" id="sclad'.$res['id'].'" name="sclad" value="'.$res['sertifikat'].'">';
			echo "</td>";
			echo "<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>";
				echo '<input type="file" accept=".txt,image/*">
					<a href="#" onclick="s='.$res['id'].';" class="upload_files button">Загрузить файлы</a>
					<div class="ajax-reply'.$res['id'].'" id="about'.$res['id'].'">'.$res['about'].'</div>';
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


?>

<div id="news" style="width:100%;"> <button style="width:100%;" onclick="addin();">Добавить</button></div>
<script>

function addin(){
	var n="";
	document.getElementById("news").innerHTML="";
	
	document.getElementById("datatable").innerHTML+="<tr id='in1'></tr>";
	document.getElementById("in1").innerHTML+="<td id='in2'></td><td id='in3'></td><td id='in4'></td><td id='in5'></td><td id='in8'></td>";
	document.getElementById("in2").innerHTML+=n;
	document.getElementById("in3").innerHTML+="<input style='border: 1px solid black;' id='new_id' value=''>";
	document.getElementById("in4").innerHTML+="<input readonly style='border: 1px solid black;' id='new_sclad'  value='НЕТ ФАЙЛА'>";
	document.getElementById("in5").innerHTML+="";
	
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
			
			
			document.getElementById("add").submit();
		}



		function go(x)
		{
		var sclad = "sclad"+x;
		var about = "about"+x;
		
			document.getElementById("id_post").value=x;
			document.getElementById("sclad_post").value=document.getElementById(sclad).value;
			document.getElementById("about_post").value=document.getElementById(about).innerHTML;
			
			document.getElementById("formsclad").submit();
		}	
		function del(x)
		{
			document.getElementById("id_del").value=x;
			document.getElementById("del").submit();
		}	
</script>
<script>
var s=0;
var re='.ajax-reply'+s;

(function($){

var files; // переменная. будет содержать данные файлов

// заполняем переменную данными файлов, при изменении значения file поля
$('input[type=file]').on('change', function(){
	files = this.files;
});


// обработка и отправка AJAX запроса при клике на кнопку upload_files
$('.upload_files').on( 'click', function( event ){

	event.stopPropagation(); // остановка всех текущих JS событий
	event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

	// ничего не делаем если files пустой
	if( typeof files == 'undefined' ) return;

	// создадим данные файлов в подходящем для отправки формате
	var data = new FormData();
	$.each( files, function( key, value ){
		data.append( key, value );
	});

	// добавим переменную идентификатор запроса
	data.append( 'my_file_upload', 1 );
	
	// AJAX запрос
	$.ajax({
		url         : './submit.php',
		type        : 'POST',
		data        : data,
		cache       : false,
		dataType    : 'json',
		// отключаем обработку передаваемых данных, пусть передаются как есть
		processData : false,
		// отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
		contentType : false,
		// функция успешного ответа сервера
		success     : function( respond, status, jqXHR ){

			// ОК
			if( typeof respond.error === 'undefined' ){
				// файлы загружены, делаем что-нибудь

				// покажем пути к загруженным файлам в блок '.ajax-reply'

				var files_path = respond.files;
				var html = '';
				$.each( files_path, function( key, val ){
					 html += val +'<br>';
				} )

				$('.ajax-reply'+s).html( "img/"+html );
			}
			// error
			else {
				console.log('ОШИБКА: ' + respond.error );
			}
		},
		// функция ошибки ответа сервера
		error: function( jqXHR, status, errorThrown ){
			console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
		}

	});

});


})(jQuery)
</script>

<??>
