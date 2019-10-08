<?
require "../../connect.php"; //соединение БД // login
if ($_SESSION['admin'] != "1") {
    session_destroy();
    exit();
} else {

    $sql = 'SELECT * FROM `banners` WHERE `id`=' . $_GET["id"] . ';';
    $B = $mysqli->query($sql);
    $B_row = $B->num_rows;
    if ($B->num_rows > 0) {
        $B_res = $B->fetch_assoc();
        $name = $B_res["name"];
        $url = $B_res["url"];
        $img = $B_res["img"];
    }

    echo "
				<form method='POST'>
				    <input value='" . $_GET["id"] . "' type='hidden' name='id' />
					<table>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Название</td> 
							<td>
							    <input value='" . $name . "' type='text' name='name' />
							</td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Картинка</td>
							<td><input value='" . $img . "' type='text' name='img' /></td>
						</tr>
						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Урл</td>
							<td><input value='" . $url . "' type='text' name='url' /></td>
						</tr>

						<tr>
							<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Сохранить</td>
							<td><input type='submit' name='submit' value='Сохранить' style='width:49%;' />
								<input type='submit' name='' onclick='window.close();' value='Отменить'  style='width:49%;' />
							</td>
						</tr>						
					</table>
					</form>";


}
if ($_POST["submit"] != NULL) {

    if ($_POST["id"] == 0) {
        $mysqli->query("
						insert into `banners`
						(`name`, `img`, `url`) values ( '" . $_POST["name"] . "', '" . $_POST["img"] . "' , '" . $_POST["url"] . "')");
    } else {
        $mysqli->query("
						UPDATE `banners`
						SET `name` = '" . $_POST["name"] . "',
							`img` = '" . $_POST["img"] . "',
							`url` = '" . $_POST["url"] . "'
						WHERE `id`=" . $_POST["id"] . ";
						");
    }
    $_POST["submit"] = NULL;

    echo "<script>window.close();</script>";

}


?>
<title>Редактировать карточку</title>
<style>
    * {
        border: 0px solid red;
        margin: 0px;
        font-family: YS Text, sans-serif;
        font-weight: 400;
        font-style: normal;
        font-stretch: normal;
        font-size: 14px;
        line-height: 20px;
    }

    td {
        border: 1px solid black;
    }

    table {
        width: 100%;
    }

    input {
        width: 100%;
    }
</style>