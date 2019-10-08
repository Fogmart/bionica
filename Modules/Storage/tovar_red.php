<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";
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

<title>Карточка товара РЕДАКТИРОВАНИЕ</title>
<meta charset="utf-8">
<meta id="meta" name="viewport" content="width=device-width; initial-scale=0.8; maximum-scale=0.8; user-scalable=0;">



<?
$set_in_db_color = '';
for($i=0; $i<100; $i++)
{
	if(isset($_POST['color'.$i])){
		$set_in_db_color = $set_in_db_color . $_POST['color'.$i].', ';
		unset($_POST['color'.$i]);}	
}
if($set_in_db_color!=''){
	//echo $set_in_db_color;
	$id_int = (int) $_GET['id'];
	$mysqli->query("UPDATE `tovar` SET `color` = '".$set_in_db_color."' WHERE `id`=".$id_int.";");
}



$_POST['comment']=str_replace('"', "'", $_POST['comment']);
$_POST['text']=str_replace('"', "'", $_POST['text']);

$_POST['name_p']=$_POST['name'];

if($_POST['skidka1']!="" && $_POST['skidka1']!=" ")
    $_POST['skidka1']=$_POST['skidka1']/100;
if($_POST['skidka2']!="" && $_POST['skidka2']!=" ")
    $_POST['skidka2']=$_POST['skidka2']/100;
if($_POST['skidka3']!="" && $_POST['skidka3']!=" ")
    $_POST['skidka3']=$_POST['skidka3']/100;
if($_POST['skidka4']!="" && $_POST['skidka4']!=" ")
    $_POST['skidka4']=$_POST['skidka4']/100;

$_POST['sum_p']=str_replace(",", ".", $_POST['sum_p']);
$_POST['sum_p']=(float)$_POST['sum_p'];


//foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>".$key." = ".$value."</p>";} //все запросы
//foreach ($_GET as $key => $value) {$add[$key] = $value;  echo "<p>".$key." = ".$value."</p>";} //все запросы



$_POST['video'] = str_replace("https://youtu.be/", "https://www.youtube.com/embed/", $_POST['video']);
$_POST['video'] = str_replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/", $_POST['video']);
$_POST['video'] = str_replace("http://youtu.be/", "https://www.youtube.com/embed/", $_POST['video']);
$_POST['video'] = str_replace("http://www.youtube.com/watch?v=", "https://www.youtube.com/embed/", $_POST['video']);

$_POST['name_p'] = str_replace("( ", "(", $_POST['name_p']);
$_POST['name_p'] = str_replace(" )", ")", $_POST['name_p']);

$_POST['name'] = str_replace("( ", "(", $_POST['name']);
$_POST['name'] = str_replace(" )", ")", $_POST['name']);


// Функция транслитерации
function translit($string) {
	 $string = trim($string); // убираем пробелы в начале и конце строки
    $string = preg_replace('/[^ a-zа-яё\d]/ui', '',$string ); //убираем спец символы

    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'j',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',  'ц' => 'ts',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',    'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        '’' => '',    '.' => '',    ' ' => '-',
		')' => '',    '(' => '',    '!' => '',
		'+' => '',    '~' => '',    '?' => '',
		'%' => '',    ']' => '',    '[' => '',
		'@' => '',    '#' => '',    '№' => '',
		'<' => '',    '>' => '',    '/' => '',
		'\\' => '',    '|' => '',    ':' => '',
		';' => '',    '&' => '',    '`' => '',

        'А' => 'a',   'Б' => 'b',   'В' => 'v',
        'Г' => 'g',   'Д' => 'd',   'Е' => 'e',
        'Ё' => 'e',   'Ж' => 'zh',  'З' => 'z',
        'И' => 'i',   'Й' => 'j',   'К' => 'k',
        'Л' => 'l',   'М' => 'm',   'Н' => 'n',
        'О' => 'o',   'П' => 'p',   'Р' => 'r',
        'С' => 's',   'Т' => 't',   'У' => 'u',
        'Ф' => 'f',   'Х' => 'h',  'Ц' => 'ts',
        'Ч' => 'ch',  'Ш' => 'sh',  'Щ' => 'sch',
        'Ь' => '',    'Ы' => 'y',   'Ъ' => '',
        'Э' => 'e',   'Ю' => 'yu',  'Я' => 'ya',
    );
    return strtr($string, $converter);
}

if($_POST['submit']=='Сохранить')
{
		if($_GET['id']==NULL)
		{

			$sqlid = 'SELECT MAX(id) as maxid FROM `tovar`;';

			$dataid = $mysqli->query($sqlid);
			$resid = $dataid->fetch_assoc();
			$id_int = $resid['maxid']+1;

		$mysqli->query(" INSERT INTO `tovar` (`id`,`art`) VALUES (".$id_int.",'".$_POST['art']."');");
				foreach ($_POST as $key => $value) {
				++$iii;
				$namePOST[$iii]=$key;
				$valuePOST[$iii]=$value;
				}



				$supdate="UPDATE `tovar` SET ";
				for($i=1;$i<=$iii; $i++)
				{
					if( $valuePOST[$i]!='' )
					{

						if($namePOST[$i]=="group2"){$namePOST[$i]="2group";}
						if($namePOST[$i]=="group2_id"){$namePOST[$i]="2group_id";}
						if($namePOST[$i]=="name_p"){$namePOST[$i]="name_print";}
						if($namePOST[$i]=="submit"){continue;}
						if($namePOST[$i]=="new"){continue;}

					$supdate=$supdate."`".$namePOST[$i]."` = '".$valuePOST[$i]."'";
						if($i<($iii-1))
						{
						$supdate=$supdate.",";
						}
					}

				}
				$supdate=chop($supdate, ',');
				$supdate=$supdate." WHERE `id`='".$id_int."';";

				$mysqli->query($supdate);


			//echo "<script>save=1; window.location = window.location.origin + window.location.pathname + '?id=".$id_int."';</script>";
			//die;
		}
	else
		{
			$id_int = (int) $_GET['id'];

		foreach ($_POST as $key => $value) {
		++$iii;
		$namePOST[$iii]=$key;
		$valuePOST[$iii]=$value;
		}

		$supdate="UPDATE `tovar` SET ";
		for($i=1;$i<=$iii; $i++)
		{
			if( $valuePOST[$i]!='' )
			{

				if($namePOST[$i]=="group2"){$namePOST[$i]="2group";}
				if($namePOST[$i]=="group2_id"){$namePOST[$i]="2group_id";}
				if($namePOST[$i]=="name_p"){$namePOST[$i]="name_print";				}

				if($namePOST[$i]=="submit"){continue;}

			$supdate=$supdate."`".$namePOST[$i]."` = '".$valuePOST[$i]."'";
				if($i<$iii)
				{
				$supdate=$supdate.",";
				}
			}

		}
		$supdate=chop($supdate, ',');
		$supdate=$supdate." WHERE `id`=".$id_int.";";
		
		$mysqli->query($supdate);

		$mysqli->query("UPDATE `tovar`
		SET 
		`url` = '".(translit($_POST['name']))."',
		`fact` = '".(int)$_POST['dost']."',
		`personal` = '".$_SESSION['user']."'
		WHERE `id`=".$id_int.";
						");

		
		
		//echo "<script>save=1; window.location = window.location.origin + window.location.pathname + '?id=".$_GET['id']."';</script>";
		//die;
		}
}
else
{
	if($_POST['drop']=='Удалить')
	{
		$id_int = (int) $_GET['id'];
			$mysqli->query("DELETE FROM `tovar` WHERE `id` = ".$_GET['id'].";");


				//echo "<script>save=1; alert('Удалено'); window.close(); window.location = window.location.origin; </script>";
				//die;
	}
}


$id_int = (int) $_GET['id'];


if($_GET['id']!=NULL){

	$sql = 'SELECT * FROM `tovar` WHERE `id`="'.$_GET['id'].'";';

	$data = $mysqli->query($sql);
	$row = $data->num_rows;
	if($row!=0)$res = $data->fetch_assoc();
}
else{
	$sql2 = 'SELECT * FROM  `tovar` ORDER BY  `tovar`.`id` DESC; ';
	$data2 = $mysqli->query($sql2);
	$row2 = $data2->num_rows;
	if($row2!=0)$res2 = $data2->fetch_assoc();
	$res['id']=$res2['id']+1;

	while($i<1)
	{
	$art=rand(100000,999999);
	$sql3 = 'SELECT * FROM  `tovar` WHERE `id`="'.$art.'";';
	$data3 = $mysqli->query($sql3);
	$row3 = $data3->num_rows;
	if($row3<1){$i=10;}
	}
	$res['art']=$art;
	$new="yes";
}




$sql_sclad = 'SELECT * FROM `sclad` WHERE `id`;';
	$data_sclad = $mysqli->query($sql_sclad);
	$row_sclad = $data_sclad->num_rows;

	$sclad="<select  style='width:100%;' name='sclad'>";
	while($res_sclad = $data_sclad->fetch_assoc())
	{


				$sclad=$sclad."<option name='sclad' value='".$res_sclad['sclad']."' ";
				if($res['sclad']==$res_sclad['sclad']) $sclad=$sclad."selected";
				$sclad=$sclad.">".$res_sclad['sclad']."</option>";
	}
	$sclad=$sclad."</select>";







$sql_sertifikat = 'SELECT * FROM `sertifikat` WHERE `id`;';
	$data_sertifikat = $mysqli->query($sql_sertifikat);
	$row_sertifikat = $data_sertifikat->num_rows;

	$sertifikat="<select  style='width:100%;' name='sertifikat_id' id='sertifikat_id'>";
	while($res_sertifikat = $data_sertifikat->fetch_assoc())
	{


				$sertifikat=$sertifikat."<option name='sertifikat_id' value='".$res_sertifikat['id']."' ";
				if($res['sertifikat_id']==$res_sertifikat['id']) $sertifikat=$sertifikat."selected";
				$sertifikat=$sertifikat.">".$res_sertifikat['sertifikat']."</option>";
	}
	$sertifikat=$sertifikat."</select>";




$sql_firma = 'SELECT * FROM `tovar` GROUP BY `firma`;';
	$data_firma = $mysqli->query($sql_firma);
	$row_firma = $data_firma->num_rows;

	$firma="<input  style='width:100%;' name='firma' value='".$res['firma']."' list='firms' id='firma'> <datalist id='firms'>";
	if($row_firma)
	while($res_firma = $data_firma->fetch_assoc())
	{


				$firma=$firma."<option name='firma_id' value='".$res_firma['firma']."' ";
				if($res['firma']==$res_firma['firma']) $firma=$firma."selected";
				$firma=$firma.">".$res_firma['firma']."</option>";
	}
	$firma='</datalist>'.$firma;


$sql_group = 'SELECT * FROM `group` WHERE `parent`=0;';
	$data_group = $mysqli->query($sql_group);
	$row_group = $data_group->num_rows;

	$group="<select  style='width:100%;' name='group_id' id='group_id'>";
	$group=$group."<option name='group_id' value='0'>Не выбрано</option>";
	while($res_group = $data_group->fetch_assoc())
	{
				$group=$group."<option name='group_id' value='".$res_group['id']."' ";
				if($res['group_id']==$res_group['id']) $group=$group."selected";
				$group=$group.">".$res_group['title']."</option>";
	}
	$group=$group."</select>";





$sql_2group = 'SELECT * FROM `group` WHERE `parent`>0;';
	$data_2group = $mysqli->query($sql_2group);
	$row_2group = $data_2group->num_rows;

	$group2="<select  style='width:100%;' name='group2_id' id='group2_id'>";
	$group2=$group2."<option name='group2_id' value='0'>Не выбрано</option>";
	while($res_2group = $data_2group->fetch_assoc())
	{

				$group2=$group2."<option name='group2_id' value='".$res_2group['id']."' ";
				if($res['2group_id']==$res_2group['id']) $group2=$group2."selected";
				$group2=$group2.">".$res_2group['title']."</option>";
	}
	$group2=$group2."</select>";

?>

<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>

<!-------------------------------------------------->
<!-------------------------------------------------->
<!-------------------------------------------------->
<script>
			window.onload=function e(){
				setInterval(sump(), 500);
				//sump();
			}
			function sump()
			{
				if(location.hash=="")location.hash="#0";
				if(location.hash=="#0"){$('#0')[0].style.display="block";$('#s0')[0].classList.add('tab-selected');}
				if(location.hash=="#1"){$('#1')[0].style.display="block";$('#s1')[0].classList.add('tab-selected');}
				if(location.hash=="#12"){$('#12')[0].style.display="block";$('#s12')[0].classList.add('tab-selected');}
				if(location.hash=="#11"){$('#11')[0].style.display="block";$('#s11')[0].classList.add('tab-selected');}
				if(location.hash=="#2"){$('#2')[0].style.display="block";$('#s2')[0].classList.add('tab-selected');}
				if(location.hash=="#3"){$('#3')[0].style.display="block";$('#s3')[0].classList.add('tab-selected');}
				if(location.hash=="#4"){$('#4')[0].style.display="block";$('#s4')[0].classList.add('tab-selected');}
				if(location.hash=="#5"){$('#5')[0].style.display="block";$('#s5')[0].classList.add('tab-selected');}
				if(location.hash=="#6"){$('#6')[0].style.display="block";$('#s6')[0].classList.add('tab-selected');}

				if(location.hash!="#0"){$('#0')[0].style.display="none";$('#s0')[0].classList.remove('tab-selected');}
				if(location.hash!="#1"){$('#1')[0].style.display="none";$('#s1')[0].classList.remove('tab-selected');}
				if(location.hash!="#2"){$('#2')[0].style.display="none";$('#s2')[0].classList.remove('tab-selected');}
				if(location.hash!="#3"){$('#3')[0].style.display="none";$('#s3')[0].classList.remove('tab-selected');}
				if(location.hash!="#4"){$('#4')[0].style.display="none";$('#s4')[0].classList.remove('tab-selected');}
				if(location.hash!="#5"){$('#5')[0].style.display="none";$('#s5')[0].classList.remove('tab-selected');}
				if(location.hash!="#6"){$('#6')[0].style.display="none";$('#s6')[0].classList.remove('tab-selected');}
				if(location.hash!="#11"){$('#11')[0].style.display="none";$('#s11')[0].classList.remove('tab-selected');}
				if(location.hash!="#12"){$('#12')[0].style.display="none";$('#s12')[0].classList.remove('tab-selected');}


			}
			function hashgo(x){
			location.hash=='#'+x;
			sump();
			}
function gonewtovar()
{

		var nj = prompt('Вы уверены?', '');
		if (nj === null) {
			return; //break out of the function early
		}
	location.href='tovar_red.php';
}
function goform(x){
if(x==1) //save
{
//CKupdate();
keysave=1;
	<?if($_GET['id']==NULL) goto next1;?>
	if(!(document.getElementsByClassName('dz-details')[0]))
	{
		keysave=0;
		sump();location.hash='#0';sump();
		document.getElementById('preview').style.border="3px dashed red";

	}
	<?next1:?>
	if(document.getElementsByName('name')[0].value=="")
	{
		keysave=0;
		sump();location.hash='#0';sump();
		document.getElementsByName('name')[0].style.border="3px dashed red";


	}
	if(document.getElementsByName('dost')[0].value=="")
	{
		keysave=0;
		sump();location.hash='#1';sump();
		document.getElementsByName('dost')[0].style.border="3px dashed red";

	}
	if(document.getElementsByName('massa')[0].value=="")
	{
		keysave=0;
		sump();location.hash='#2';sump();
		document.getElementsByName('massa')[0].style.border="3px dashed red";

	}
	if(document.getElementsByName('width')[0].value=="")
	{
		keysave=0;
		sump();location.hash='#2';sump();
		document.getElementsByName('width')[0].style.border="3px dashed red";

	}
	if(document.getElementsByName('height')[0].value=="")
	{
		keysave=0;
		sump();location.hash='#2';sump();
		document.getElementsByName('height')[0].style.border="3px dashed red";

	}
	if(document.getElementsByName('length')[0].value=="")
	{
		keysave=0;
		sump();location.hash='#2';sump();
		document.getElementsByName('length')[0].style.border="3px dashed red";

	}
	if(document.getElementsByName('sum_p')[0].value=="")
	{
		keysave=0;
		sump();location.hash='#5';sump();
		document.getElementsByName('sum_p')[0].style.border="3px dashed red";

	}
	if(document.getElementsByName('rrc')[0].value=="")
	{
		keysave=0;
		sump();location.hash='#5';sump();
		document.getElementsByName('rrc')[0].style.border="3px dashed red";

	}

	if(document.getElementsByName('group_id')[0].value=="0")
	{
		keysave=0;
		sump();location.hash='#1';sump();
		document.getElementsByName('group_id')[0].style.border="3px dashed red";

	}
	if(document.getElementsByName('group2_id')[0].value=="0")
	{
		keysave=0;
		sump();location.hash='#1';sump();
		document.getElementsByName('group2_id')[0].style.border="3px dashed red";

	}

	if(keysave==1)document.getElementById('form').action='';
}
if(x==2)//del
{
	randnj=Math.floor(Math.random() * (9999 - 1000 + 1)) + 1000;
		var nj = prompt('Ввести пин код: '+randnj, '');
		if (nj === null) {
			alert('Не верно');
			return; //break out of the function early
		}
		if(nj!=randnj) {
			alert('Не верно');
			return; //break out of the function early
		}
		if(nj==randnj) {
			document.getElementById('form').action='';
		}
}
}
		</script>




<?//$_GET["id"]=NULL;?>

<link rel="stylesheet" href="bootstrap.min.css" />
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <link rel="stylesheet" href="dropzone.css" />
  <script src="dropzone.js"></script>
	<script src="ckeditor.js"></script>
	<script src="js/sample.js"></script>
	<meta charset="utf-8">


<link rel="stylesheet" href="styles-default.min.css">
<link rel="stylesheet" type="text/css" href="calendar.css">
<link rel="stylesheet" type="text/css" href="colorbox.css">
<style>
select{
	width: 100%;
    max-width: 100%;
    border: none;
    margin: 0;
    padding: 0 10px;
    height: 2.5em;
    font-size: 1em;
    font-family: "Roboto",sans-serif;
    background: #fff;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    vertical-align: baseline !important;
	border:1px solid #dddddd;
}
input{
	border:1px solid #dddddd;
}

ul.tab-switcher li.tab-selected span.onclick span.caption >a{
color: #ffa700;
}
*{cursor:pointer;}
.row {

    margin-left: -0px;
}
</style>
<body style="zoom: 0.9;">
<form method='POST' id="form" action="javascript:void(0);">

<input readonly id="new" style="height:20px; display:none;" name="new" value="<?echo $new;?>">
<input readonly id="group" style="height:20px; display:none;" name="group" value="0">
<input readonly id="group2" style="height:20px; display:none;" name="group2" value="0">
<input readonly id="firma" style="height:20px; display:none;" name="firma" value="0">
<input readonly id="sertifikat" style="height:20px; display:none;" name="sertifikat" value="0">

<link rel="stylesheet" href="styles-default.min.css">
<link rel="stylesheet" type="text/css" href="calendar.css">
<link rel="stylesheet" type="text/css" href="colorbox.css">


<div id="goods-Popup1" class="goods-Popup1 popUp" style="opacity: 1; margin-top:0px; width: 100%;">

<div class="popup-actions-wrapper">

	<div class="area area-PopupActionsRight ">
		<div id="goods-Popup1-AdvancedShare" class="ui-popuphint-new AdvancedShare state-hide">
			<div class="caption">
				<label for="goods-Popup1-AdvancedShare-field">
					<span class="caption-text">Редактировал:</span>
					<div><?echo $res['personal'];?></div>
				</label>
			</div>
		</div>
	 </div>

</div>




	<ul class="tab-switcher">
		<li id="s0" class="ui-input tab tab-selected">
			<span data-map="goods-Popup1-Tabs" data-val="tabCommon" value="tabCommon" class="atomic button onclick">
				<span class="caption">
				<a onclick="sump();location.hash='#0';sump();">Главная</a>
				</span>
			</span>
		</li>
		<li id="s1" class="ui-input tab ">
			<span data-map="goods-Popup1-Tabs" data-val="tabCommon" value="tabCommon" class="atomic button onclick">
				<span class="caption">
				<a  onclick="sump();location.hash='#1';sump();">Общая информация</a>
				</span>
			</span>
		</li>
		<li id="s11" class="ui-input tab ">
			<span data-map="goods-Popup1-Tabs" data-val="tabCommon" value="tabCommon" class="atomic button onclick">
				<span class="caption">
				<a  onclick="sump();location.hash='#11';sump();">Описание верх</a>
				</span>
			</span>
		</li>
		<li id="s12" class="ui-input tab ">
			<span data-map="goods-Popup1-Tabs" data-val="tabCommon" value="tabCommon" class="atomic button onclick">
				<span class="caption">
				<a  onclick="sump();location.hash='#12';sump();">Описание низ</a>
				</span>
			</span>
		</li>
		<li id="s2" class="ui-input tab ">
			<span data-map="goods-Popup1-Tabs" data-val="tabAdditional" value="tabAdditional" class="atomic button onclick">
				<span class="caption">
					<a  onclick="sump();location.hash='#2';sump();">Дополнительно</a>
				</span>
			</span>
		</li>
		<li id="s3" class="ui-input tab ">
			<span data-map="goods-Popup1-Tabs" data-val="tab2" value="tab2" class="atomic button onclick">
				<span class="caption">
					<a  onclick="sump();location.hash='#3';sump();">Характеристики</a>
				</span>
			</span>
		</li>

		<li id="s4" class="ui-input tab ">
			<span data-map="goods-Popup1-Tabs" data-val="tab4" value="tab4" class="atomic button onclick">
				<span class="caption">
				<a  onclick="sump();location.hash='#4';sump();">Штрихкод</a>
				</span>
			</span>
		</li>

		<li id="s5" class="ui-input tab ">
		<span data-map="goods-Popup1-Tabs" data-val="tabPrices" value="tabPrices" class="atomic button onclick">
			<span class="caption">
				<a  onclick="sump();location.hash='#5';sump();"> Цены</a>
			</span>
		</span>
		</li>

		<li id="s6" class="ui-input tab ">
		<span data-map="goods-Popup1-Tabs" data-val="tabPrices" value="tabPrices" class="atomic button onclick">
			<span class="caption">
				<a  onclick="sump();location.hash='#6';sump();">SЕО</a>
			</span>
		</span>
		</li>

	</ul>



<div class="popup-top-wrapper">
	<div class="area area-top-left ">
		<div class="no-caption no-value enabled visible no-cap-context multibutton ui-input ui-select Actions value- imitation_menu" id="goods-Popup1-Actions">
			<div class="input">
				<div class="input-inner">
					<div id="goods-Popup1-Actions-field" class="select-field" data-map="goods-Popup1-Actions">
						<div class="select-box">
							<div class="select-input-table">
								<span class="color-circle-wrapper">
								<span class="color-circle select-color-circle">
								</span>
								</span>
								<div class="atomic select-input-div">
									<label onclick="goform(2);"  for="drop">Удалить</label>
									<input id="drop" type="submit" name="drop" style="display:none;" value="Удалить">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?if($_GET['id']==NULL) goto next15;?>
		<div class="area area-top-right">
		<div class="has-caption no-value enabled visible hightlight green ui-input native button Save ui-button" id="goods-Popup1-Save" >
			<div id="goods-Popup1-Save-Cleaner" class="hidden">
			</div>
			<div class="input">
				<div class="input-inner">
					<button onclick="gonewtovar();"  id="goods-Popup1-Save-button" class="atomic select-input-div" style="color:#fff; border-radius:7px; padding: 5px; background:#a3185b;">
						<span>Новый товар</span>
					</button>
				</div>
			</div>
		</div>
	 </div>
	 <?next15:?>
	<div class="area area-top-right ">
		<div class="has-caption no-value enabled visible hightlight green ui-input native button Save ui-button" id="goods-Popup1-Save" >
			<div id="goods-Popup1-Save-Cleaner" class="hidden">
			</div>
			<div class="input">
				<div class="input-inner">
					<button onclick="goform(1);"  id="goods-Popup1-Save-button" class="native" type="submit" name="submit" class="native" value="Сохранить">
						<span>Cохранить</span>
					</button>
				</div>
			</div>
		</div>
	 </div>
</div>







<div id="0" style="display:none;">



<div class="area area-HeaderLeft ">
	<div class="no-caption no-value enabled visible fullWidth no-cap-context ui-input ui-input-text c_name" id="goods-Popup1-c_name" >
		<div class="input">
			<div class="input-inner">
				<input type="text" id="goods-Popup1-c_name-field" name="name" value="<?echo $res['name'];?>" placeholder="Наименование товара">
			</div>
		</div>
	</div>
</div>
<div class="area area-Body area-table-fields">





	<div class="has-caption no-value enabled visible fullWidth ui-input ui-input-text print_name" id="goods-Popup1-print_name" data-mapedit="goods-Popup1-print_name" style="display:none;">
		<div class="caption">
			<label for="goods-Popup1-print_name-field">
				<span class="caption-text">
					Наименование для печати
				</span>	<span class="required">*</span>
			</label>
		</div>

		<div class="input">
			<div class="input-inner">
				<input type="text" id="goods-Popup1-print_name-field" name="name_p" value="<?echo $res['name_print'];?>" placeholder="">
			</div>
		</div>
	</div>

	<div class="has-caption has-value enabled visible  ui-input ui-buttonset c_type" id="goods-Popup1-c_type" data-mapedit="goods-Popup1-c_type" style="display:none;">
		<div class="caption">
			<label for="goods-Popup1-c_type-field">
				<span class="caption-text">
					Вид позиции
				</span>
			</label>
		</div>
		<div class="input">
			<div class="input-inner">
				<div class="ui-buttonset-field">
					<div id="goods-Popup1-c_type-field" class="has-caption has-value enabled visible  ui-input ui-buttonset c_type ui-radio-field">
						<label class="ui-state-active ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left" role="button">
							<span class="ui-button-text">
								Товар
							</span>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="has-caption has-value disabled visible nocover no-cap-context ui-input ui-input-text code" id="goods-Popup1-code" data-mapedit="goods-Popup1-code" style="display:none;">
		<div class="caption">
			<label for="goods-Popup1-code-field">
				<span class="caption-text">
					Код
				</span>
			</label>
		</div>

		<div class="input">
			<div class="input-inner">
				<span class="disabled-content">
					<input name="id" value="<?echo $res['id'];?>" readonly/>
				</span>
			</div>
		</div>
	</div>

	<div id="goods-Popup1-measure" class="goods-Popup1-measure ui-goods-measure measure ui-input ui-input-group-inline caption-on-top">
		<div class="caption">
			Единицы измерения
		</div>
	<div class="input">
	<div id="goods-Popup1-measure-item0" class="ui-goods-measure-item ui-input-group">
		<div class="no-caption has-value enabled visible no-cap-context no-cap-errors ui-input ui-select measure0 value-1 combobox" id="goods-Popup1-measure-measure0">
			<div class="input">
				<div class="input-inner">
					<input type="text" list="browsers" name="unit" value="<?echo $res['unit'];?>">
					<datalist id="browsers">
					   <option>шт.</option>
					   <option>упак.</option>
					   <option>ч.</option>
					   <option>т.</option>
					   <option>к.</option>
					   <option>кв.м.</option>
					   <option>кг.</option>
					   <option>М3</option>
					   <option>м.п.</option>
					</datalist>
				</div>
			</div>
		</div>
		<span class="hint">
			Основная единица измерения
		</span>
	</div>
		<div class="ui-goods-measure-actions" style="display:none;">
			<div class="has-caption no-value enabled visible atomic pseudo-link line ui-input require-caption nocover width200 button add ui-button" id="goods-Popup1-measure-add" data-mapedit="goods-Popup1-measure-add">
			<div class="caption">
			</div>
			<div id="goods-Popup1-measure-add-Cleaner" class="hidden">
			</div>
				<div class="input">
					<div class="input-inner">
						<button id="goods-Popup1-measure-add-button" data-map="goods-Popup1-measure-add" class="button logBtn native ">
						<span>
							Добавить единицу измерения
						</span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>


	<div id="goods-Popup1-measure" class="goods-Popup1-measure ui-goods-measure measure ui-input ui-input-group-inline caption-on-top">
		<div class="caption">
		Активно
		</div>
		<div class="input">
			<div id="goods-Popup1-measure-item0" class="ui-goods-measure-item ui-input-group">
				<div class="no-caption has-value enabled visible no-cap-context no-cap-errors ui-input ui-select measure0 value-1 combobox" id="goods-Popup1-measure-measure0" data-mapedit="goods-Popup1-measure-measure0">
					<div class="input">
						<div class="input-inner">
							<select name='active'>
								<option name='active' value='yes' <?if($res['active']=="yes") echo "selected"; ?>>Да</option>
								<option name='active' value='no' <?if($res['active']!="yes") echo "selected"; ?> >Нет</option>
							</select>
						</div>
					</div>
				</div>
				<span class="hint">
					Видно ли покупателям
				</span>
			</div>
		</div>
	</div>

	<div id="goods-Popup1-measure" class="goods-Popup1-measure ui-goods-measure measure ui-input ui-input-group-inline caption-on-top">
		<div class="caption">
		Под заказ
		</div>
		<div class="input">
			<div id="goods-Popup1-measure-item0" class="ui-goods-measure-item ui-input-group">
				<div class="no-caption has-value enabled visible no-cap-context no-cap-errors ui-input ui-select measure0 value-1 combobox" id="goods-Popup1-measure-measure0" data-mapedit="goods-Popup1-measure-measure0">
					<div class="input">
						<div class="input-inner">
							<select name='zakaz'>
								<option name='zakaz' value='yes' <?if($res['zakaz']=="yes") echo "selected"; ?>>Да</option>
								<option name='zakaz' value='no' <?if($res['zakaz']!="yes") echo "selected"; ?> >Нет</option>
							</select>
						</div>
					</div>
				</div>
				<span class="hint">
					Можно ли заказать товар
				</span>
			</div>
		</div>
	</div>




	<div class="has-caption no-value enabled visible ui-input ui-file photos" id="goods-Popup1-photos" data-mapedit="goods-Popup1-photos">
		<div class="caption">
		<label for="goods-Popup1-photos-field">
		<span class="caption-text">Фотографии товара</span>
		<span id="goods-Popup1-photos_help" rel="tooltip" title="" data-map="goods-Popup1-photos" class="question hover-event"></span>
		</label>
		</div>
		<div id="goods-Popup1-photos-Cleaner" class="hidden"></div>
		<div class="input">
			<div class="input-inner">
			<div id="goods-Popup1-photos-Input" class="InputFileInput" style="position: relative;">
					<div class="has-caption no-value enabled visible pseudo-link nocover attach ui-input native button OpenFileButton ui-button" id="goods-Popup1-photos-OpenFileButton" data-mapedit="goods-Popup1-photos-OpenFileButton">
						<div id="goods-Popup1-photos-OpenFileButton-Cleaner" class="hidden">
						</div>
						<div class="input">
							<div class="input-inner">

							</div>
						</div>
					</div>
			</div>
				<div id="goods-Popup1-photos-Container" class="InputFileContainer" onload="">
				<?if($_GET['id']==NULL) goto next2;?>
				<div class="container" style="padding:0px; width:95%;" >
				   <div style="padding: 0% 0%; width:100%; text-align: left;" id="preview" action="/upload.php?id=<?echo $res['id'];?>"  class="dropzone" id="dropzoneFrom">

				   </div>
				</div>
				<?next2:?>
				<?if($_GET['id']!=NULL) goto next3;?>
				<div class="container" style="padding:0px; width:95%;" >
					<p></p>
					<p><strong>Внимание!</strong></p>
					<p>Сейчас Вы&nbsp;создаете <strong>новую&nbsp;карточку</strong>. И сразу вопрос &quot;<em>Какого ... нельзя добавить фотографию</em>&quot;.</p>
					<p>Все очень просто!&nbsp;Этой карточки еще нет на сервере. И сервер не знает к чему привязать фотографию.</p>
					<p>Как только произойдет <strong>первое сохранение</strong> на сервере появиться карточка.</p>
					<p>И тогда <strong>можно (нужно)</strong> будет добавить фотографию. ☺</p>
					<p>(Тех. поддержка ♥)</p>
				</div>
				<?next3:?>
<script>

function delimg(e,nphoto)
{
	var name=e.id;

	var id="<?echo $res['id'];?>";

	var sms={id:id,name:name,nphoto:nphoto};
	var url="/upload.php";
	var metod="POST";

	$.ajax({
	type: metod,
	url: url,
	data: sms
	}).done(function( result )
		{
		$('#preview').html(result);
		});
}



window.addEventListener('load',
  function() {
    list_image();
  }, false);


function list_image(){
var id="<?echo $res['id'];?>";

var sms={id:id};
var url="/upload.php";
var metod="POST";

	$.ajax({
	type: metod,
	url: url,
	data: sms
	}).done(function( result )
		{
		$('#preview').html(result);
		});
}


$(document).ready(function(){

 Dropzone.options.dropzoneFrom = {
  autoProcessQueue: true,
  maxFilesize: 80000000,
  acceptedFiles: 'image/*',
  init: function(){
   var submitButton = document.querySelector('#submit-all');
   myDropzone = this;
   submitButton.addEventListener("click", function(){
    myDropzone.processQueue();
   });
this.on("complete", function(){
		if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
		{
		 var _this = this;
		 _this.removeAllFiles();
		}
   });
  },
 };

 $(document).on('click', '.remove_image', function(){
  var name = $(this).attr('id');
  $.ajax({
   url:"/upload.php",
   method:"POST",
   data:{name:name},
   success:function(data)
   {
    list_image();
   }
  })
 });

});
</script>

				</div>
			</div>
		</div>
	</div>

		<div class="has-caption no-value enabled visible fullWidth ui-input ui-input-text print_name" id="goods-Popup1-print_name" data-mapedit="goods-Popup1-print_name">
		<div class="caption">
			<label for="goods-Popup1-print_name-field">
				<span class="caption-text">
					Видео
				</span>	<span class="required">*</span>
			</label>
		</div>

		<div class="input">
			<div class="input-inner">
				<input type="text" id="goods-Popup1-print_name-field" value="<?echo $res['video'];?>" name="video" placeholder="youtube">
			</div>
		</div>
	</div>



</div>
</div>
<div class="area area-Tabs ">
	<div class="form-tabs tabs Tabs" id="goods-Popup1-Tabs">

	<!----------тут было меню----------->

	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->

		<div class="tab-content" id="1" style="display:none;">
		<div id="goods-Popup1-Tabs-tabCommon" class="goods-Popup1-Tabs-tabCommon area-table-fields  tabCommon simple-container">
		<div>
		</div>
		<div class="div-table col2">
		<div class="row double">
			<div class="cell">
				<div class="tab-Body">
					<div class="has-caption has-value enabled visible ui-input ui-select group_goods_ref value-1 combobox" id="goods-Popup1-Tabs-tabCommon-group_goods_ref" data-mapedit="goods-Popup1-Tabs-tabCommon-group_goods_ref">
						<div class="caption">
							<label for="goods-Popup1-Tabs-tabCommon-group_goods_ref-field">
								<span class="caption-text">
									Группа (<u onclick="group_red();">Редактировать группы</u>)
								</span>
							</label>
						</div>
						<div class="input">
							<div class="input-inner">
								<div id="goods-Popup1-Tabs-tabCommon-group_goods_ref-field" class="select-field" data-map="goods-Popup1-Tabs-tabCommon-group_goods_ref">
									<div class="select-box">
										<div class="select-input-table">
											<div>
											<?echo $group;?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<div class="has-caption has-value enabled visible ui-input ui-select group_goods_ref value-1 combobox" id="goods-Popup1-Tabs-tabCommon-group_goods_ref" data-mapedit="goods-Popup1-Tabs-tabCommon-group_goods_ref">
					<div class="caption">
						<label for="goods-Popup1-Tabs-tabCommon-group_goods_ref-field">
							<span class="caption-text">
								Группа 2
							</span>
						</label>
					</div>

					<div class="input">
						<div class="input-inner">
							<div id="goods-Popup1-Tabs-tabCommon-group_goods_ref-field" class="select-field" data-map="goods-Popup1-Tabs-tabCommon-group_goods_ref">
								<div class="select-box">
									<div class="select-input-table">
										<div>
										<?echo $group2;?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>




				<div class="has-caption has-value enabled visible width100 ui-input ui-select nds_ref value-5 combobox" id="goods-Popup1-Tabs-tabCommon-nds_ref" data-mapedit="goods-Popup1-Tabs-tabCommon-nds_ref">
					<div class="caption">
						<label for="goods-Popup1-Tabs-tabCommon-nds_ref-field">
							<span class="caption-text">
								Ставка НДС
							</span>
						</label>
					</div>
					<div class="input">
						<div class="input-inner">
								<input type="text" id="nds" name="nds" list="NDS" value="<?echo $res['nds'];?>">
								<datalist id="NDS" size="4">
								   <option value="0">%</option>
								   <option value="10">%</option>
								   <option value="12">%</option>
								   <option value="13">%</option>
								   <option value="16">%</option>
								   <option value="18">%</option>
								   <option value="20">%</option>
								   <option value="21">%</option>
								   <option value="24">%</option>
								</datalist>
						</div>
					</div>
				</div>


				<div class="has-caption no-value enabled visible ui-input ui-input-text part" id="goods-Popup1-Tabs-tabCommon-part" data-mapedit="goods-Popup1-Tabs-tabCommon-part">
				<div class="caption">
					<label for="goods-Popup1-Tabs-tabCommon-part-field">
						<span class="caption-text">
							Артикул
						</span>
					</label>
				</div>
					<div class="input">
						<div class="input-inner">
							<input type="text" id="goods-Popup1-Tabs-tabCommon-part-field" name="art" value="<?echo $res['art'];?>" placeholder="0000000000">
						</div>
					</div>
				</div>

				<div class="has-caption no-value enabled visible ui-input ui-input-text part" id="goods-Popup1-Tabs-tabCommon-part" data-mapedit="goods-Popup1-Tabs-tabCommon-part">
				<div class="caption">
					<label for="goods-Popup1-Tabs-tabCommon-part-field">
						<span class="caption-text">
							Количество
						</span>
					</label>
				</div>
					<div class="input">
						<div class="input-inner">
							<input type="text" id="goods-Popup1-Tabs-tabCommon-part-field" name="dost" value="<?echo $res['dost'];?>" placeholder="???">
						</div>
					</div>
				</div>


				</div>

			</div>

			<div class="cell">
				<div class="tab-Right">
					<div class="has-caption no-value enabled visible ui-input ui-htmlarea c_desc" id="goods-Popup1-Tabs-tabCommon-c_desc" data-mapedit="goods-Popup1-Tabs-tabCommon-c_desc">



					</div>
				</div>
			</div>
		</div>
		</div>
		</div>
		</div>
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
		<div class="tab-content" id="2" style="display:none;">
		<div id="goods-Popup1-Tabs-tabAdditional" class="goods-Popup1-Tabs-tabAdditional area-table-fields  tabAdditional simple-container">
		<div>
		</div>
		<div class="div-table col2">
		<div class="row double">
		<div class="cell">
		<div class="tab-Body">

			<div class="has-caption no-value enabled visible ui-input ui-price weight" id="goods-Popup1-Tabs-tabAdditional-weight" data-mapedit="goods-Popup1-Tabs-tabAdditional-weight">
				<div class="caption">
					<label for="goods-Popup1-Tabs-tabAdditional-weight-field">
						<span class="caption-text">
							Вес (Объем)
						</span>
					</label>
				</div>
				<div class="input">
					<div class="input-inner">
						<input type="text" id="goods-Popup1-Tabs-tabAdditional-weight-field" name="massa" value="<?echo $res['massa'];?>" placeholder="гр.">
					</div>
				</div>
			</div>

			<div class="has-caption no-value enabled visible ui-input ui-price weight" id="goods-Popup1-Tabs-tabAdditional-weight" data-mapedit="goods-Popup1-Tabs-tabAdditional-weight">
				<div class="caption">
					<label for="goods-Popup1-Tabs-tabAdditional-weight-field">
						<span class="caption-text">
							Ширина (см)
						</span>
					</label>
				</div>
				<div class="input">
					<div class="input-inner">
						<input type="text" id="goods-Popup1-Tabs-tabAdditional-weight-field" name="width" value="<?echo $res['width'];?>" placeholder="">
					</div>
				</div>
			</div>

			<div class="has-caption no-value enabled visible ui-input ui-price weight" id="goods-Popup1-Tabs-tabAdditional-weight" data-mapedit="goods-Popup1-Tabs-tabAdditional-weight">
				<div class="caption">
					<label for="goods-Popup1-Tabs-tabAdditional-weight-field">
						<span class="caption-text">
							Длина (см)
						</span>
					</label>
				</div>
				<div class="input">
					<div class="input-inner">
						<input type="text" id="goods-Popup1-Tabs-tabAdditional-weight-field" name="height" value="<?echo $res['height'];?>" placeholder="">
					</div>
				</div>
			</div>

			<div class="has-caption no-value enabled visible ui-input ui-price weight" id="goods-Popup1-Tabs-tabAdditional-weight" data-mapedit="goods-Popup1-Tabs-tabAdditional-weight">
				<div class="caption">
					<label for="goods-Popup1-Tabs-tabAdditional-weight-field">
						<span class="caption-text">
							Высота (см)
						</span>
					</label>
				</div>
				<div class="input">
					<div class="input-inner">
						<input type="text" id="goods-Popup1-Tabs-tabAdditional-weight-field" name="length" value="<?echo $res['length'];?>" placeholder="">
					</div>
				</div>
			</div>

		<div class="has-caption no-value enabled visible ui-input cursor-text ui-select partner_ref value- combobox" id="goods-Popup1-Tabs-tabAdditional-partner_ref" data-mapedit="goods-Popup1-Tabs-tabAdditional-partner_ref">
			<div class="caption">
				<label for="goods-Popup1-Tabs-tabAdditional-partner_ref-field">
					<span class="caption-text">
						Основной поставщик
					</span>
				</label>
			</div>
			<div class="input">
				<div class="input-inner">
					<?echo $firma;?>
				</div>
			</div>
		</div>
		</div>
		</div>

		<div class="cell">
		<div class="tab-Right">
					<div class="has-caption no-value enabled visible ui-input ui-htmlarea c_desc" id="goods-Popup1-Tabs-tabCommon-c_desc" data-mapedit="goods-Popup1-Tabs-tabCommon-c_desc">



					</div>


		</div>
		</div>

		</div>
		</div>
		</div>
		</div>
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
		<div class="tab-content" id="3" style="display:none;">
		<div id="goods-Popup1-Tabs-tabAdditional" class="goods-Popup1-Tabs-tabAdditional area-table-fields  tabAdditional simple-container">
		<div>
		</div>
		<div class="div-table col2">
		<div class="row double">

		<div class="cell">
		<div class="tab-Body">
			<p style="margin-left: 20px;">Размеры</p>
		<style>
		input[type="checkbox"], input[type="radio"] {
		display: inline-block;
		}
		</style>

        <label style="margin-left: 20px;"><input type="text" name="razm" id="razm" onkeyup="newrazm(this);" value="<?if($res['razm']!=null) echo $res['razm'];?>"/></label>
        <style>
            .vvv{
                float:left;
                margin:2px;
                padding:4px;
                border:1px solid black;
                border-radius: 4px;
            }
        </style>
        <div id="newrazm" style="margin-left: 20px;">

        </div>
            <script>
                var array1=[
                    <?
                    $searchaa = $mysqli->query('SELECT `razm` FROM `tovar` WHERE `razm` IS NOT NULL');

                    if($searchaa_row = $searchaa->num_rows)
                        while($searchaa_res = $searchaa->fetch_assoc())
                            $searchend.=$searchaa_res['razm'].",";


                    foreach ( explode(",", chop($searchend, ',')) as $element)
                        if($element!="" && $element!=" ")
                            $end.="'".$element."',";

                    echo chop($end, ',');
                    ?>
                ];

				window.onload = function () 
				{
					var e = document.getElementById('razm');
					newrazm(e);
				}

                function newrazm(e)
                {
                    var div=document.getElementById('newrazm');
                    div.innerHTML='';
                    input = e.value.toString();
                    all_value = input.split(/\s*,\s*/);
                    razmenter = all_value[all_value.length-1];

                    array1.forEach(function(element) {
                        element = element.toString();
                            if(element.search( razmenter )!=(-1)){
                                    div.innerHTML+='<div class="vvv" onclick="razmadd('+"'"+element+"'"+');">'+element+'</div>';
                            }

                    });

                }
                function razmadd(enter)
                {
                    var razm=document.getElementById('razm');
                    razm.value += enter+',';
                }
            </script>

		</div>
		</div>

		<div class="cell">
		<div class="tab-Right">
			<p style="margin-left: 20px;">Цвета</p>
			<div id="allcolors">
			<?
			$colors = explode(",", str_replace(" ", "", $res['color']));
			for($i=0; $i<count($colors); $i++)
			{
				if(strlen(chop(chop($colors[$i], ','), ' '))>5)
				echo '<input type="color" id="palette" name="color'.$i.'" value="'.chop(chop($colors[$i], ','), ' ').'" onchange="this.value" oncontextmenu="delcolors(this);return false;">';
			}
			?>
			</div>
			<button onclick="addcolors();">Добавить цвет</button>
			<script>
			function delcolors(e)
			{
				var confDialog = window.confirm("Удалить цвет?")
				 if (confDialog)
				  e.remove();
			  
			  return false;
			}
			function addcolors(){
				var e = document.getElementById('allcolors');
				var e1 = document.getElementById('allcolors').children;
				var kol = e1.length;
				e.insertAdjacentHTML('beforeEnd', '<input type="color" id="palette" name=\'color'+kol+'\' oncontextmenu="delcolors(this); return false;">');
			}
			</script>
		</div>
		</div>

		</div>
		</div>
		</div>
		</div>
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
		<div class="tab-content" id="4" style="display:none;">
		<div id="goods-Popup1-Tabs-tabAdditional" class="goods-Popup1-Tabs-tabAdditional area-table-fields  tabAdditional simple-container">
		<div>
		</div>
		<div class="div-table col2">
		<div class="row double">
		<div class="cell">
		<div class="tab-Body">
		<div class="has-caption no-value enabled visible ui-input cursor-text ui-select partner_ref value- combobox" id="goods-Popup1-Tabs-tabAdditional-partner_ref" data-mapedit="goods-Popup1-Tabs-tabAdditional-partner_ref">
			<div class="caption">
				<label for="goods-Popup1-Tabs-tabAdditional-partner_ref-field">
					<span class="caption-text">
						Штрих-код
					</span>
				</label>
			</div>
			<div class="input">
				<div class="input-inner">
					<input type="text" id="goods-Popup1-Tabs-tabCommon-part-field" name="shtrih" value="<?echo $res['shtrih'];?>" placeholder="000000">
				</div>
			</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
		<!----------------------------------------------------------->
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
		<div class="tab-content" id="11" style="display:none;">
		<div id="goods-Popup1-Tabs-tabAdditional" class="goods-Popup1-Tabs-tabAdditional area-table-fields  tabAdditional simple-container">
		<div>
		</div>
		<div class="div-table col2">
		<div class="row double">
		<div class="cell">
		<div class="tab-Body">
		<div class="has-caption no-value enabled visible ui-input cursor-text ui-select partner_ref value- combobox" id="goods-Popup1-Tabs-tabAdditional-partner_ref" data-mapedit="goods-Popup1-Tabs-tabAdditional-partner_ref">

			<div class="input">
				<div class="input-inner">
					<p><i>ВНИМАНИЕ есть кнопка на ВЕСЬ ЭКРАН!</i>
					<img style="width: 196px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJQAAAAYCAYAAAAcTtR3AAAACXBIWXMAAA7DAAAOwwHHb6hkAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAR9SURBVHja7JpbaFxVGIU/GAgEAgOBEAhUihARnwSpUSkIIVhEsSCBPggiPhT0oSB5qApKEVEwUIpURRCDoggJihYvaDFUpVVrrLcajW21TZOY2qRpUttkkkyXL+vI9jiTTKYzzW0/LBKSM3vm7P/b6197n0ESkhBELa5MSjWC2kB1iygrqBc0CBr9e7bIteG4NcF7Xp17TbhYoohA/QeUmhQcWUGToEVwr2C7YJdgj+A1QY/gA8EBwZeCbwU/CfoFvwqOC/4QnBIMCk4HGvLPU77mhGDAr/3e4/UK3he8Idgt6BDcI2g2jCFwEahlgiUNyv2G5GVBt2C/i/mzgRgWjAsuCKYFOcGcIC+4HEhVUDJ23u85I5gSnBH8JvhK8LbgGcFWwcbAzSJQFQAngSYr2CC4XfCw4DnBW17xfYJf7BBjgr8NyXwASalFnnehZ13sSx5vUnBOcFYwGrjRaTvVYOBYw77mrF8zKbjo8WZL+FyX/RkuCE76HjsFrW6tmQhU6dBc6xbQYYfZZ3fpd7HOucizJRQldIJpF2jM4xwTHDWMn7vNdQu6BHvtEDvdEtvtFq2CG92eGqwwMyV5aoPgel+7WXCXXbND8JTgeS+G/YLDwb2d90LIF7ifOd97n+G6zXO2boEKwWkQbBI86MnpERz0xA55Ymc8icXaTwjLJcGEYMSg/BBA0iV41sVs9/s2FgnK6bCcqeIGIJ3tGgVtgsed5b5wBpuyo6XhGnVrbDfEaxaocLLqXcDtXvX7BN+46GfcBoo5TQLSvOGaNDADHqPXq7zTLbDVzpAG5ervpiqXD5vsjHsM2KjnK5mrvB23xzDWrnagwlZ1g2Cbs807DpfHBH8ZnGJuk0CT82ocsVMdssO8JHgs2AllC8Cy1nesNV4km9yK+5zrQrAGBTt83YoHKt2uWtxCXhV86iwy7IyykOMkWWbcYfM7v75L8KTtuzl1jrNeoFlKLRoED/hoIwRrSvCCd4YrBqgQnka3kifcXg562z1mMOYXcJwZh8iTgiOCDx2yd3jMpqA1RWjKq1OT2/1AEORzgldcu2UBKoRncwDP14LfDUVuAdeZ9SoZ8TlPrx1np+AO55psBKeqarHT51yXacHT/zscrQJQifsku6xHBK87rxxPwZPeVeX9vwm7zmHBuw7F25yh6iM4y6aNDudzrte4A32mGkAlu4Xdgk98CDjmtrQYPCd8DtRt92pLtasIzspRsztLsvn5zOZRUaC2OvxOBTutQm3rvJ3nkOBNn4e0uRVG11k9avMJvbxJuq+SQNUK3isQmC96V3bEW/xdgjvtPBGe1aFawU0FdIudKW997L+lr6sr16Ha7VD9Dm57TW2yPY/wrF49WuYD6gOCTLlA1bhtNVTtaxFRy6l2P3oqFaahf3NV/PpKVBHdLPizBJhygluXmqkiUOtT1wh+XASoh8o5l4pArV/VCT4qAlNXuSfnEaj4SObFFExHC34TYclARa1dLQ5Wp4+JJgTXXcnD4jjZEahEdwu2XOnXWeJkR1VU/wwApVFGqqeFojoAAAAASUVORK5CYII="/>
				</p>
					<textarea id="comment" maxlength="200" placeholder="Описание верхнее" name="comment" class="mceedit" style="height: 500px;"><?echo $res['comment'];?></textarea>
				</div>
			</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
		<!----------------------------------------------------------->
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
		<div class="tab-content" id="12" style="display:none;">
		<div id="goods-Popup1-Tabs-tabAdditional" class="goods-Popup1-Tabs-tabAdditional area-table-fields  tabAdditional simple-container">
		<div>
		</div>
		<div class="div-table col2">
		<div class="row double">
		<div class="cell">
		<div class="tab-Body">
		<div class="has-caption no-value enabled visible ui-input cursor-text ui-select partner_ref value- combobox" id="goods-Popup1-Tabs-tabAdditional-partner_ref" data-mapedit="goods-Popup1-Tabs-tabAdditional-partner_ref">

			<div class="input">
				<div class="input-inner">
				<p><i>ВНИМАНИЕ есть кнопка на ВЕСЬ ЭКРАН!</i>
				<img style="width: 196px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJQAAAAYCAYAAAAcTtR3AAAACXBIWXMAAA7DAAAOwwHHb6hkAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAR9SURBVHja7JpbaFxVGIU/GAgEAgOBEAhUihARnwSpUSkIIVhEsSCBPggiPhT0oSB5qApKEVEwUIpURRCDoggJihYvaDFUpVVrrLcajW21TZOY2qRpUttkkkyXL+vI9jiTTKYzzW0/LBKSM3vm7P/b6197n0ESkhBELa5MSjWC2kB1iygrqBc0CBr9e7bIteG4NcF7Xp17TbhYoohA/QeUmhQcWUGToEVwr2C7YJdgj+A1QY/gA8EBwZeCbwU/CfoFvwqOC/4QnBIMCk4HGvLPU77mhGDAr/3e4/UK3he8Idgt6BDcI2g2jCFwEahlgiUNyv2G5GVBt2C/i/mzgRgWjAsuCKYFOcGcIC+4HEhVUDJ23u85I5gSnBH8JvhK8LbgGcFWwcbAzSJQFQAngSYr2CC4XfCw4DnBW17xfYJf7BBjgr8NyXwASalFnnehZ13sSx5vUnBOcFYwGrjRaTvVYOBYw77mrF8zKbjo8WZL+FyX/RkuCE76HjsFrW6tmQhU6dBc6xbQYYfZZ3fpd7HOucizJRQldIJpF2jM4xwTHDWMn7vNdQu6BHvtEDvdEtvtFq2CG92eGqwwMyV5aoPgel+7WXCXXbND8JTgeS+G/YLDwb2d90LIF7ifOd97n+G6zXO2boEKwWkQbBI86MnpERz0xA55Ymc8icXaTwjLJcGEYMSg/BBA0iV41sVs9/s2FgnK6bCcqeIGIJ3tGgVtgsed5b5wBpuyo6XhGnVrbDfEaxaocLLqXcDtXvX7BN+46GfcBoo5TQLSvOGaNDADHqPXq7zTLbDVzpAG5ervpiqXD5vsjHsM2KjnK5mrvB23xzDWrnagwlZ1g2Cbs807DpfHBH8ZnGJuk0CT82ocsVMdssO8JHgs2AllC8Cy1nesNV4km9yK+5zrQrAGBTt83YoHKt2uWtxCXhV86iwy7IyykOMkWWbcYfM7v75L8KTtuzl1jrNeoFlKLRoED/hoIwRrSvCCd4YrBqgQnka3kifcXg562z1mMOYXcJwZh8iTgiOCDx2yd3jMpqA1RWjKq1OT2/1AEORzgldcu2UBKoRncwDP14LfDUVuAdeZ9SoZ8TlPrx1np+AO55psBKeqarHT51yXacHT/zscrQJQifsku6xHBK87rxxPwZPeVeX9vwm7zmHBuw7F25yh6iM4y6aNDudzrte4A32mGkAlu4Xdgk98CDjmtrQYPCd8DtRt92pLtasIzspRsztLsvn5zOZRUaC2OvxOBTutQm3rvJ3nkOBNn4e0uRVG11k9avMJvbxJuq+SQNUK3isQmC96V3bEW/xdgjvtPBGe1aFawU0FdIudKW997L+lr6sr16Ha7VD9Dm57TW2yPY/wrF49WuYD6gOCTLlA1bhtNVTtaxFRy6l2P3oqFaahf3NV/PpKVBHdLPizBJhygluXmqkiUOtT1wh+XASoh8o5l4pArV/VCT4qAlNXuSfnEaj4SObFFExHC34TYclARa1dLQ5Wp4+JJgTXXcnD4jjZEahEdwu2XOnXWeJkR1VU/wwApVFGqqeFojoAAAAASUVORK5CYII="/>
				</p>
					<textarea id="text" name="text" id="editor1" placeholder="Описание нижнее" class="mceedit" style="height:500px; width:100%; text-align:left; padding:4px;"><?echo $res['text'];?></textarea>
				</div>
			</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
		<div class="tab-content" id="5" style="display:none;">
		<div id="goods-Popup1-Tabs-tabPrices" class="goods-Popup1-Tabs-tabPrices disabled-edit  tabPrices simple-container">
		<div class="tab-Body ">
		<div id="goods-Popup1-Tabs-tabPrices-prices" class="goods-Popup1-Tabs-tabPrices-prices disabled-edit ui-goods-price prices simple-container">
			<div class="sale">
			<h2>
			Продажа
			</h2>
				<div class="price">
					<div class="value">
						<input type="text" id="sum_p" name="sum_p"  value="<?echo number_format((float)$res['sum_p'], 2, '.', '');?>" placeholder="" style="width: 60%;">
					</div>
				</div>
				<div class="has-caption no-value enabled visible b_add ui-input native button PriceSaleAdd disabled-edit ui-button" id="goods-Popup1-Tabs-tabPrices-prices-PriceSaleAdd">
					<div class="input">
						<div class="input-inner">
						</div>
					</div>
				</div>
			</div>
			<div class="buy">
			<h2>
			Закупка
			</h2>
				<div class="price">
					<div class="value">
						<input type="text" id="sum_z" name="sum_z"  value="<?echo $res['sum_z'];?>" placeholder="" style="width: 60%;">
					</div>
				</div>
				<div class="has-caption no-value enabled visible b_add ui-input native button PriceSaleAdd disabled-edit ui-button" id="goods-Popup1-Tabs-tabPrices-prices-PriceSaleAdd">
					<div class="input">
						<div class="input-inner">
						</div>
					</div>
				</div>
			</div>
			<div class="buy">
			<h2>
			Зачеркнутая цена
			</h2>
				<div class="price">
					<div class="value">
						<input type="text" id="rrc1"    name="rrc" value="<?echo $res['rrc'];?>" placeholder="" style="width: 60%;">
					</div>
				</div>
				<div class="has-caption no-value enabled visible b_add ui-input native button PriceSaleAdd disabled-edit ui-button" id="goods-Popup1-Tabs-tabPrices-prices-PriceSaleAdd">
					<div class="input">
						<div class="input-inner">
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		</div>


		<div id="goods-Popup1-Tabs-tabPrices" class="goods-Popup1-Tabs-tabPrices disabled-edit  tabPrices simple-container">
		<div class="tab-Body ">
		<div id="goods-Popup1-Tabs-tabPrices-prices" class="goods-Popup1-Tabs-tabPrices-prices disabled-edit ui-goods-price prices simple-container">
<table>
	<tr style="width:400px;">
		<td style="width:170px;">
		Количество </br>(пример. 12)
		</td>
		<td title="В %" style="width:170px;">
		Скидка </br>(пример. 10%)
		</td>
		<td title="" style="width:170px;">
		Цена за шт.
		</td>
	</tr>
	<tr>
		<td>
		<input type="number" name="skidkakol1" step="1" placeholder="при кол-ве" value="<?echo $res['skidkakol1'];?>">
		</td>
		<td title="В %">
		<input type="number" style="width:90%;" name="skidka1" step="1" max="100" min="0" placeholder="скидка" value="<?echo $res['skidka1']*100;?>">
		</td>
		<td title="">
		<input type="number" style="width:170px;" onclick="
		x=document.getElementsByName('sum_p')[0].value;y=document.getElementsByName('skidkakol1')[0].value;z=document.getElementsByName('skidka1')[0].value;c=	(( x*y ) * ( ( 100-z )/100 ))/y;document.getElementById('skidka1').value=c;
		" placeholder="нажми" readonly id="skidka1">
		</td>
	</tr>
	<tr>
		<td>
		<input type="number" name="skidkakol2" step="1" placeholder="при кол-ве" value="<?echo $res['skidkakol2'];?>">
		</td>
		<td title="В %">
		<input type="number" style="width:90%;" name="skidka2" step="1" max="100" min="0" placeholder="скидка" value="<?echo $res['skidka2']*100;?>">
		</td>
		<td title="">
		<input type="number" style="width:170px;"  onclick="
		x=document.getElementsByName('sum_p')[0].value;y=document.getElementsByName('skidkakol2')[0].value;z=document.getElementsByName('skidka2')[0].value;c=	(( x*y ) * ( ( 100-z )/100 ))/y;document.getElementById('skidka2').value=c;
		" placeholder="нажми" readonly id="skidka2">
		</td>
	</tr>
	<tr>
		<td>
		<input type="number" name="skidkakol3" step="1" placeholder="при кол-ве" value="<?echo $res['skidkakol3'];?>">
		</td>
		<td title="В %">
		<input type="number" style="width:90%;" name="skidka3" step="1" max="100" min="0" placeholder="скидка" value="<?echo $res['skidka3']*100;?>">
		</td>
		<td title="">
		<input type="number" style="width:170px;"  onclick="
		x=document.getElementsByName('sum_p')[0].value;y=document.getElementsByName('skidkakol3')[0].value;z=document.getElementsByName('skidka3')[0].value;c=	(( x*y ) * ( ( 100-z )/100 ))/y;document.getElementById('skidka3').value=c;
		" placeholder="нажми" readonly id="skidka3">
		</td>
	</tr>
	<tr>
		<td>
		<input type="number" name="skidkakol4" step="1" placeholder="при кол-ве" value="<?echo $res['skidkakol4'];?>">
		</td>
		<td title="В %">
		<input type="number" style="width:90%;" name="skidka4" step="1" max="100" min="0" placeholder="скидка" value="<?echo $res['skidka4']*100;?>">
		</td>
		<td title="">
		<input type="number" style="width:170px;"  onclick="
		x=document.getElementsByName('sum_p')[0].value;y=document.getElementsByName('skidkakol4')[0].value;z=document.getElementsByName('skidka4')[0].value;c=	(( x*y ) * ( ( 100-z )/100 ))/y;document.getElementById('skidka4').value=c;
		" placeholder="нажми" readonly id="skidka4">
		</td>
	</tr>

</table>

		</div>
		</div>
		</div>


		</div>
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
			<div class="tab-content" id="6" style="display:none;">
		<div id="goods-Popup1-Tabs-tab2" class="goods-Popup1-Tabs-tab2  tab2 simple-container">
		<div class="tab-Body ">
					<div class="has-caption no-value enabled visible ui-input ui-htmlarea c_desc" id="goods-Popup1-Tabs-tabCommon-c_desc" data-mapedit="goods-Popup1-Tabs-tabCommon-c_desc">
						<div class="caption">
							<label for="goods-Popup1-Tabs-tabCommon-c_desc-field">
								<span class="caption-text">
								Для поисковиков (200 символов)</span>
							</label>
						</div>

						<div class="input">
							<div class="input-inner">
								<textarea id="seo" name="seo" class="mceedit"  maxlength="200" style="height:200px; width:100%; text-align:left; padding:4px;"><?echo $res['seo'];?></textarea>
								<div id="counter"></div>
							</div>
						</div>
					</div>
					<script>
					$(function() {
						$(document).ready(function() {
							$('#seo').on('blur, keyup', function() {
								var $max = 200;


								var $val = $(this).val();

								$(this).attr('maxlength', $max);

								if( $val.length <= 0 ) {
									$('#counter').html(0);
								} else {
									if( $max < parseInt( $val.length ) ) {
										$this.val( $val.substring(0, $max) );
									}

									$('#counter').html( $(this).val().length );
								}
							});
						});
					});
					</script>
		</div>
		</div>
		</div>
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
	<!----------------------------------------------------------->
	</div>
</div>
</div>

</form>

<script>function group_red(){
				newWin = window.open("group_red.php" ,"", "width=800,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");
				newWin.onbeforeunload = function(){save=10;location.reload();}
				}
			</script>

<script src="scripts/jquery-1.9.1.min.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/jHtmlArea.js"></script>
<script src="scripts/jHtmlAreaColor.js"></script>
<script>
	initSample();
</script>
