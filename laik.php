<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 

$_POST['id'] = (int)$_POST['id'];


$sql = 'SELECT * FROM `tovar` 
	WHERE 
		`id` = '. $_POST['id'] .' 
	;';
	$data = $mysqli->query($sql);
	if($row = $data->num_rows)$res = $data->fetch_assoc();

$res['laik']=(int)$res['laik']+1;

$mysqli->query("
							UPDATE `tovar`
							SET `laik` = '".$res['laik']."'
							WHERE `id`=".$res['id'].";
							");
?>