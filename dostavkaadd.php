<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";

//{city1:city1 ,city2:city2 ,massa:massa ,sum:sum};
$_POST['city1'];
$_POST['city2'];
$_POST['massa'];
$_POST['sum'];

echo 'work' ;


$sql = 'SELECT * FROM `shopping` WHERE `session_id` ="'. session_id() .'" and `art`="0";';

if(isset($_SESSION['email'])){
if($_SESSION['email']!='')
    if($_SESSION['email']!=' ')
		
		$sql = 'SELECT * FROM `shopping` WHERE `email` ="'. $_SESSION['email'] .'" and `art`="0";';
	}



$data = $mysqli->query($sql);
$row = $data->num_rows;
if($row<1){

if(isset($_SESSION['email'])){
if($_SESSION['email']!='')
    if($_SESSION['email']!=' ')
		
		$mysqli->query('

				INSERT INTO `shopping`
				(`session_id`,`email`,`tel`,`fio`,`art`,`name`,`kolvo`,`massa`,`massa_all`,`sum_p`,`img`)
				VALUES
				("'.session_id().'",
				"'.$_SESSION['email'].'",
				"'.$_SESSION['tel'].'",
				"'.$_SESSION['user'].'",
				"0",
				"Доставка ('.$_POST['city1'].' - '.$_POST['city2'].')",
				"1",
				"'.$_POST['massa'].'",
				"'.$_POST['massa'].'",
				"'.$_POST['sum'].'",
				"images/payment/dost.png"
				);

				');
				
				echo '

				INSERT INTO `shopping`
				(`session_id`,`email`,`tel`,`fio`,`art`,`name`,`kolvo`,`massa`,`massa_all`,`sum_p`,`img`)
				VALUES
				("'.session_id().'",
				"'.$_SESSION['email'].'",
				"'.$_SESSION['tel'].'",
				"'.$_SESSION['user'].'",
				"0",
				"Доставка ('.$_POST['city1'].' - '.$_POST['city2'].')",
				"1",
				"'.$_POST['massa'].'",
				"'.$_POST['massa'].'",
				"'.$_POST['sum'].'",
				"images/payment/dost.png"
				);

				';

	}
	else
	{
				$mysqli->query('

				INSERT INTO `shopping`
				(`session_id`,`art`,`name`,`kolvo`,`massa`,`massa_all`,`sum_p`,`img`)
				VALUES
				("'.session_id().'",
				"0",
				"Доставка ('.$_POST['city1'].' - '.$_POST['city2'].')",
				"1",
				"'.$_POST['massa'].'",
				"'.$_POST['massa'].'",
				"'.$_POST['sum'].'",
				"images/payment/dost.png"
				);

				');
				
				echo '

				INSERT INTO `shopping`
				(`session_id`,`art`,`name`,`kolvo`,`massa`,`massa_all`,`sum_p`,`img`)
				VALUES
				("'.session_id().'",
				"0",
				"Доставка ('.$_POST['city1'].' - '.$_POST['city2'].')",
				"1",
				"'.$_POST['massa'].'",
				"'.$_POST['massa'].'",
				"'.$_POST['sum'].'",
				"images/payment/dost.png"
				);

				';
	}

}
else{
if(isset($_SESSION['email'])){
if($_SESSION['email']!='')
    if($_SESSION['email']!=' ')	
$mysqli->query('UPDATE `shopping` SET `img`="images/payment/dost.png", `name` = "Доставка ('.$_POST['city1'].' - '.$_POST['city2'].')", `sum_p`="'.$_POST['sum'].'"
WHERE `email` ="'. $_SESSION['email'] .'" and `art`="0";');

echo 'UPDATE `shopping` SET `img`="images/payment/dost.png", `name` = "Доставка ('.$_POST['city1'].' - '.$_POST['city2'].')", `sum_p`="'.$_POST['sum'].'"
WHERE `email` ="'. $_SESSION['email'] .'" and `art`="0";';
}
else 
{
	$mysqli->query('UPDATE `shopping` SET `img`="images/payment/dost.png", `name` = "Доставка ('.$_POST['city1'].' - '.$_POST['city2'].')", `sum_p`="'.$_POST['sum'].'"
WHERE `session_id` ="'. session_id() .'" and `art`="0";');

echo 'UPDATE `shopping` SET `img`="images/payment/dost.png", `name` = "Доставка ('.$_POST['city1'].' - '.$_POST['city2'].')", `sum_p`="'.$_POST['sum'].'"
WHERE `session_id` ="'. session_id() .'" and `art`="0";';
}

}


?>
