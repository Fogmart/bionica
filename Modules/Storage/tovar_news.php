<?  
require "../../connect.php"; //соединение БД // login
if($_SESSION['admin']!="1"){session_destroy(); exit();}

//foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>POST ".$key." = ".$value."</p>";} //все POST запросы

if(isset($_POST['submit']))
{
    $news1 = $_POST['news1'];

    if (strpos($news1, "Баннер:") !== false ){
        $news1_ = str_replace("Баннер:", "", $news1);
        $sql = 'SELECT * FROM `banners` WHERE `name` LIKE "%' . $news1_ . '%" LIMIT 1;';
        $news_d = $mysqli->query($sql);
        if ($row = $news_d->num_rows) {
            $res = $news_d->fetch_assoc();
            $mysqli->query("UPDATE `news` SET `name` = '" . $news1 . "', `id_tovar` = 'b', `srcid` = '".$res["id"]."'  WHERE `id`=1;");
        }
    } else {

        $sql = 'SELECT * FROM `tovar` WHERE `name` LIKE "%' . $_POST['news1'] . '%" LIMIT 1;';
        $news_d = $mysqli->query($sql);
        if ($row = $news_d->num_rows) {
            $res = $news_d->fetch_assoc();

            $mysqli->query("
                            UPDATE `news`
                            SET `name` = '" . $res["name"] . "',
                                `id_tovar` = '" . $res["id"] . "'
                            WHERE `id`=1;
                            ");
        } else {
            if ($_POST['news1'] == "Не показывать") {
                $mysqli->query("UPDATE `news` SET `name` = 'Не показывать', `id_tovar` = '0' WHERE `id`=1;");
            }
            if ($_POST['news1'] == "Случайный товар") {
                $mysqli->query("UPDATE `news` SET `name` = 'Случайный товар', `id_tovar` = 'r' WHERE `id`=1;");
            }
            if ($_POST['news1'] == "Лидер продаж") {
                $mysqli->query("UPDATE `news` SET `name` = 'Лидер продаж', `id_tovar` = 't' WHERE `id`=1;");
            }
            if ($_POST['news1'] == "Новый товар") {
                $mysqli->query("UPDATE `news` SET `name` = 'Новый товар', `id_tovar` = 'n' WHERE `id`=1;");
            }
        }
    }

	$sql = 'SELECT * FROM `tovar` WHERE `name` LIKE "%'.$_POST['news2'].'%" LIMIT 1;';
	$news_d = $mysqli->query($sql);
	if($row = $news_d->num_rows)
	{
	$res = $news_d->fetch_assoc();

						$mysqli->query("
						UPDATE `news`
						SET `name` = '".$res["name"]."',
							`id_tovar` = '".$res["id"]."'
						WHERE `id`=2;
						");
	}
	else
	{
		if($_POST['news2']=="Не показывать")
		{
		$mysqli->query("UPDATE `news` SET `name` = 'Не показывать', `id_tovar` = '0' WHERE `id`=2;");
		}
		if($_POST['news2']=="Случайный товар")
		{
		$mysqli->query("UPDATE `news` SET `name` = 'Случайный товар', `id_tovar` = 'r' WHERE `id`=2;");	
		}
		if($_POST['news2']=="Лидер продаж")
		{
		$mysqli->query("UPDATE `news` SET `name` = 'Лидер продаж', `id_tovar` = 't' WHERE `id`=2;");	
		}
		if($_POST['news2']=="Новый товар")
		{
		$mysqli->query("UPDATE `news` SET `name` = 'Новый товар', `id_tovar` = 'n' WHERE `id`=2;");	
		}	
	}
}


	$sql = 'SELECT * FROM `news` WHERE `id` LIMIT 2;';
	$news_d = $mysqli->query($sql);
	$row = $news_d->num_rows;
	
	for($i=1;$res = $news_d->fetch_assoc();$i++)
	{
		$news[$i]=$res['name'];
		
		//id == 1-2
	}

	$sql = 'SELECT * FROM `tovar` ORDER BY `id` DESC';
	$news_d = $mysqli->query($sql);
	$row = $news_d->num_rows;
	echo '<datalist id="news1">';
	echo '<option value="Не показывать"></option>';
	echo '<option value="Случайный товар"></option>';
	echo '<option value="Лидер продаж"></option>';
	echo '<option value="Новый товар"></option>';
	
	while($res = $news_d->fetch_assoc())
	{
		echo '<option value="'.$res['name'].'">'.$res['id'].'</option>';
	}
	echo '</datalist>';

	$sql = 'SELECT * FROM `tovar` ORDER BY `id` DESC';
	$news_d = $mysqli->query($sql);
	$row = $news_d->num_rows;
	echo '<datalist id="news2">';
	echo '<option value="Не показывать"></option>';
	echo '<option value="Случайный товар"></option>';
	echo '<option value="Лидер продаж"></option>';
	echo '<option value="Новый товар"></option>';
	while($res = $news_d->fetch_assoc())
	{
		echo '<option value="'.$res['name'].'">'.$res['id'].'</option>';
	}
	echo '</datalist>';
?>

<style>
*{width:100%; }
td{border:1px solid black;}
input{height:40px; text-align:center;}
.center{
	text-align:center;
}
.yellow{background:#FFFFCB;}
.red{background:#FFCBCB;}
.blue{background: #CCCCFF;}
</style>


<form method="post">
<table>
    <tr>
        <td class="center blue" ><h1>Выбор верхних блоков на главной</h1></td>
    </tr>
    <tr>
        <td class="yellow">
		<h3>Что бы удалить => сотрите все введенное в поле</h3>
		</td>
    </tr>
    <tr>
        <td class="yellow">
		<p>Возможные позиции:</p>
		<p>"Не показывать" - Означает что блок ничего показывать не будет!</p>
		<p>"Случайный товар" - Означает что будет показан случайный товар!</p>
		<p>"Лидер продаж" - Означает что будет показан самый продаваемый товар!</p>
		<p>"Новый товар" - Означает что будет показан самый новый товар!</p>
		<p>"Вами введенный товар" - Означает что Будет показан товар который ВЫ выбрали!</p>
		</td>
    </tr>
    <tr>
        <td class="center red" >
		<p>Левый верхний блок (Начните вводить название товара)</p>
		</td>
    </tr>
    <tr>
        <td>
		<input list="news1" name="news1" value="<?echo $news[1];?>">
		</td>
    </tr>
    <tr>
        <td class="center red" >
		<p>Правный верхний блок (Начните вводить название товара)</p>
		</td>
    </tr>
	<tr>
        <td>
		<input list="news2" name="news2" value="<?echo $news[2];?>">
		</td>
    </tr>
	<tr>
        <td>
		<input type="submit" name="submit" value="Сохранить" />
		</td>
    </tr>
</table>
</form>