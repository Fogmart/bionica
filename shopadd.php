<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";

foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>POST ".$key." = ".$value."</p>";} //все POST запросы


if(isset($_POST['del']))
{
	$sql = 'SELECT * FROM `shopping` 
		WHERE 
		`id` ="'. $_POST['del'] .'" 
		;';
		$data = $mysqli->query($sql);
		if($row = $data->num_rows)$res = $data->fetch_assoc();

	if(($res['session_id']==session_id()) || ($res['email']==$_SESSION['email']))
	{
		$mysqli->query('
			DELETE FROM `shopping` WHERE `id` = '.(int)$_POST['del'].';
		');
	}

exit();
}


$sql = 'SELECT * FROM `tovar` 
	WHERE 
		`art` = '. $_POST['art'] .' 
	;';
	$data = $mysqli->query($sql);
	if($row = $data->num_rows)$res = $data->fetch_assoc();



	$sum_all=(int)$_POST['kolvo']*(int)$res['sum_p'];

	if(!(isset($res['photo_1'])))
		if(!(isset($res['photo_2'])))
			if(!(isset($res['photo_3'])))
				if(!(isset($res['photo_4'])))
					if(!(isset($res['photo_5'])))
						if(!(isset($res['photo_6'])))
							if(!(isset($res['photo_7'])))
								if(!(isset($res['photo_8'])))
									if(!(isset($res['photo_9'])))
										if(!(isset($res['photo_10'])))
											if(!(isset($res['photo_11'])))
												if(!(isset($res['photo_12'])))
													if(!(isset($res['photo_13'])))
														if(!(isset($res['photo_14'])))
															if(!(isset($res['photo_15']))){}
															else  $photo=$res['photo_15'];
														else $photo=$res['photo_14'];
													else $photo=$res['photo_13'];
												else $photo=$res['photo_12'];
											else $photo=$res['photo_11'];
										else $photo=$res['photo_10'];
									else $photo=$res['photo_9'];
								else $photo=$res['photo_8'];
							else $photo=$res['photo_7'];
						else $photo=$res['photo_6'];
					else $photo=$res['photo_5'];
				else $photo=$res['photo_4'];
			else $photo=$res['photo_3'];
		else  $photo=$res['photo_2'];
	else $photo=$res['photo_1'];

    if($res['skidkakol4']=='')$res['skidkakol4']=99999999;
    if($res['skidkakol4']=='0')$res['skidkakol4']=99999999;

    if($res['skidkakol3']=='')$res['skidkakol3']=99999999;
    if($res['skidkakol3']=='0')$res['skidkakol3']=99999999;

    if($res['skidkakol2']=='')$res['skidkakol2']=99999999;
    if($res['skidkakol2']=='0')$res['skidkakol2']=99999999;

    if($res['skidkakol1']=='')$res['skidkakol1']=99999999;
    if($res['skidkakol1']=='0')$res['skidkakol1']=99999999;


	if($_POST['kolvo']>=$res['skidkakol1'] && $_POST['kolvo']<$res['skidkakol2'])
	{
	$res['sum_p']=$res['sum_p']-($res['sum_p']*$res['skidka1']);
	}

	if($_POST['kolvo']>=$res['skidkakol2'] && $_POST['kolvo']<$res['skidkakol3'])
	{
	$res['sum_p']=$res['sum_p']-($res['sum_p']*$res['skidka2']);
	}

	if($_POST['kolvo']>=$res['skidkakol3'] && $_POST['kolvo']<$res['skidkakol4'])
	{
	$res['sum_p']=$res['sum_p']-($res['sum_p']*$res['skidka3']);
	}

	if($_POST['kolvo']>=$res['skidkakol4'])
	{
	$res['sum_p']=$res['sum_p']-($res['sum_p']*$res['skidka4']);
	}




	$massa_all=$res['massa']*$_POST['kolvo'];

if(isset($_POST['zakaz']))	{

$mysqli->query('
		
		INSERT INTO `shopping` 
		(`session_id`,`email`,`tel`,`fio`,`art`,`name`,`img`,`url`,`color`,`razm`,`kolvo`,`zakaz`,`massa`,`massa_all`,`sum_p`,`sum_all`) 
		VALUES
		("'.session_id().'",
		"'.$_SESSION['email'].'",
		"'.$_SESSION['tel'].'",
		"'.$_SESSION['user'].'",
		"'.$res['art'].'",
		"'.$res['name'].' </br> Размер: '.$_POST['razms'].' </br> Цвет: <i style=\'color:  '.$_POST['colors'].';\' class=\'zmdi zmdi-circle\'></i>",
		"'.$photo.'",
		"'.$res['url'].'",
		"<div style=\'width: 10px;background: '.$_POST['colors'].';height: 10px;\'></div>",
		"'.$_POST['razms'].'",
		"'.$_POST['kolvo'].'",
		"yes",
		"'.$res['massa'].'",
		"'.$massa_all.'",
		"'.$res['sum_p'].'",
		"'.$sum_all.'");
		
		');
}
else{
$mysqli->query('
		
		INSERT INTO `shopping` 
		(`session_id`,`email`,`tel`,`fio`,`art`,`name`,`img`,`url`,`color`,`razm`,`kolvo`,`massa`,`massa_all`,`sum_p`,`sum_all`) 
		VALUES
		("'.session_id().'",
		"'.$_SESSION['email'].'",
		"'.$_SESSION['tel'].'",
		"'.$_SESSION['user'].'",
		"'.$res['art'].'",
		"'.$res['name'].' </br> Размер: '.$_POST['razms'].' </br> Цвет: <i style=\'color:  '.$_POST['colors'].';\' class=\'zmdi zmdi-circle\'></i>",
		"'.$photo.'",
		"'.$res['url'].'",
		"<div style=\'width: 10px;background: '.$_POST['colors'].';height: 10px;\'></div>",
		"'.$_POST['razms'].'",
		"'.$_POST['kolvo'].'",
		"'.$res['massa'].'",
		"'.$massa_all.'",
		"'.$res['sum_p'].'",
		"'.$sum_all.'");
		
		');
}
?>
