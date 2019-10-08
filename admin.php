<?php if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";
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
									echo "<script>location.href='login.php';</script>";
									exit;
						}

$sql = 'SELECT * FROM `users` WHERE `id`='.$_SESSION['id'].' AND `admin`="'.$_SESSION['admin'].'" AND `store`="'.$_SESSION['store'].'" AND `direct`="'.$_SESSION['direct'].'" AND `call`="'.$_SESSION['call'].'" ;';
$Staff = $mysqli->query($sql);
$Staff_row = $Staff->num_rows;
if($Staff_row<1)
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
									echo "<script>location.href='login.php';</script>";
									exit;
						}
?>

<?
// orders количество
$corzina_sql ='SELECT DISTINCT `email` FROM `shopping`;';
$corzina_data = $mysqli->query($corzina_sql);
$corzina_row = $corzina_data->num_rows;
$corzina; //[1]-номер [2]-сумма всего должен [3]-полученная сумма
	for($i=1;$corzina_res  = $corzina_data ->fetch_assoc();$i++)
	{
		$corzina[$i][1]=$corzina_res['email'];
		$user_sql ="SELECT * FROM  `shopping` WHERE  `email` LIKE  '%".$corzina[$i][1]."%';";
		$user_data = $mysqli->query($user_sql);
		$user_row = $user_data->num_rows;
		while($user_res  = $user_data ->fetch_assoc())
		{
			if($user_res['check']!="ok"){$corzina[$i][2]=$corzina[$i][2]+(int)$user_res['sum_p'];}
			
			if($user_res['art']=="0")$corzina[$i][13]+=(int)$user_res['sum_p']; //доставка
			$corzina[$i][14]=$user_res['fio'];
			$corzina[$i][15]=$user_res['tel'];
			if($user_res['checkcall']=="yes")$corzina[$i][20]="Проверен колл центром";
			
		}
	}
for($i=1;$i<=$corzina_row;$i++)	{
$order_sql ="SELECT * FROM `orders` WHERE `label`= '".$corzina[$i][1]."' and `user_check`!='ok' ORDER BY `id` DESC;";
$order_data = $mysqli->query($order_sql);
$order_row = $order_data->num_rows;
if($order_row>0)
{
$short=10;
$order_res  = $order_data ->fetch_assoc();
$corzina[$i][3]=$order_res['id'];
$corzina[$i][4]=$order_res['withdraw_amount'];
$corzina[$i][5]=$order_res['amount'];
$corzina[$i][6]=$order_res['user_check'];
$corzina[$i][7]=$order_res['sha1'];
$corzina[$i][8]=$order_res['sha1_hash'];
$corzina[$i][17]=$order_res['verification'];
if($order_res['notification_type']=="Наложенный платеж"){$corzina[$i][18]="</br><font style='color:red; font-size:15px;'>Наложенный платеж</font>";}
else{$corzina[$i][18]="";}

if($corzina[$i][7]==$corzina[$i][8])$corzina[$i][9]="ok"; //ключи сошлись
else $corzina[$i][9]="no";

if($corzina[$i][4]>=$corzina[$i][2])$corzina[$i][10]="ok"; //сумма сошлась
else $corzina[$i][10]="no";

for($j=1;$j <= 10;$j++)	if(isset($corzina[$i][$j]))$short--;
if($short==0)$corzina[$i][11]="ok"; //все значения на местах вывод заказа 
else $corzina[$i][11]="no";

if($corzina[$i][11]=="ok")
	if($corzina[$i][9]=="ok")
		if($corzina[$i][10]=="ok") {$corzina[$i][12]="complete"; $com++;}
		else {$corzina[$i][12]="Error";$err++;} //Ошибка в цене
	else {$corzina[$i][12]="Error";$err++;} //Ошибка в верификации платежа (ключи)
else {$corzina[$i][12]="Error";$err++;} //не все значения
if($corzina[$i][17]=="ok"){$corzina[$i][12]="complete"; $com++;$err--;}
}

}
?>
<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Admin</title>
<link rel="stylesheet" media="screen" href="theme/active_admin.css">
<link rel="stylesheet" media="print" href="theme/print.css">
<style>
*{cursor:pointer;}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="theme/active_admin.js"></script>
</head>

<body class="index dashboard active_admin logged_in root_namespace" style="zoom: 0.9;">
    <div id="wrapper">
      <div class="header" id="header">
        <h1 class="site_title" id="site_title">Бионика</h1>
        <ul class="header-item tabs" id="tabs">

          <li class="menu_item">
		  <a href="?m=1">
		  <?
		  $sqlss="";
if($_SESSION['call']=="1")	{$sqlss.='(`call`="'.$_SESSION['call'].'")';}
if($_SESSION['direct']=="1")	{if($sqlss!=""){$sqlss.="OR";}$sqlss.='(`direct`="'.$_SESSION['direct'].'")';}
if($_SESSION['store']=="1")	{if($sqlss!=""){$sqlss.="OR";}$sqlss.='(`store`="'.$_SESSION['store'].'")';}
if($_SESSION['admin']=="1")	{if($sqlss!=""){$sqlss.="OR";}$sqlss.='(`admin`="'.$_SESSION['admin'].'")';}
$notifications_sql = '
SELECT * FROM `notifications`
WHERE '.$sqlss.' AND ( title NOT LIKE "%Индексирование сайта%")
ORDER BY `id` DESC;
';
$data_n = $mysqli->query($notifications_sql);
$row_n = $data_n->num_rows;?>

		  <span class="iconify" data-icon="fa-solid:bell" data-inline="false"></span>
		  Уведомления
  		  <span style="
		  border: 0px solid black; 
		  border-radius:99px; 
		  padding:1px 10px 1px 10px;
		  background-color: #f14040;
		  color: #ffffff;">
		  <?echo ($row_n>99)?('+99'):($row_n);?>
		  </span>
		  </a>
		  </li>
<?
if($_SESSION['call']==1){$lvl=1;}
if($_SESSION['direct']==1){$lvl=2;}
if($_SESSION['store']==1){$lvl=3;}
if($_SESSION['admin']==1){$lvl=4;}

m11:
if($lvl<2){goto m2;}
?>
		  <li class="menu_item">
		  <a href="?m=11">
		  <?
$sqlnote = 'SELECT * FROM `todolist` ORDER BY `id` DESC;'; 	
$data_note = $mysqli->query($sqlnote);
$row_note = $data_note->num_rows
		  ?>
		  <span class="iconify" data-icon="fa-solid:book-open" data-inline="false"></span>
		  Записная книжка
		  <span style="
		  border: 0px solid black; 
		  border-radius:99px; 
		  padding:1px 10px 1px 10px;
		  background-color: #f14040;
		  color: #ffffff;">
		  <?echo ($row_note>99)?('+99'):($row_note);?>
		  </span>
		  </a></li>
<?
m2:
if($lvl!=4){goto m3;}
?>
          <li class="menu_item">
		  <a href="?m=2">
<?
		  $sqlss="";
if($_SESSION['call']=="1")	{$sqlss.='(`call`="'.$_SESSION['call'].'")';}
if($_SESSION['direct']=="1")	{if($sqlss!=""){$sqlss.="OR";}$sqlss.='(`direct`="'.$_SESSION['direct'].'")';}
if($_SESSION['store']=="1")	{if($sqlss!=""){$sqlss.="OR";}$sqlss.='(`store`="'.$_SESSION['store'].'")';}
if($_SESSION['admin']=="1")	{if($sqlss!=""){$sqlss.="OR";}$sqlss.='(`admin`="'.$_SESSION['admin'].'")';}
$notifications_sql = '
SELECT * FROM `notifications`
WHERE ( title LIKE "%Индексирование сайта%") AND ('.$sqlss.')
ORDER BY `id` DESC;
';
$data_n = $mysqli->query($notifications_sql);
$row_n = $data_n->num_rows;?>
		  <span class="iconify" data-icon="fa-solid:globe" data-inline="false"></span>
		  Поисковики
		   <span style="
		  border: 0px solid black; 
		  border-radius:99px; 
		  padding:1px 10px 1px 10px;
		  background-color: #f14040;
		  color: #ffffff;">
		  <?echo ($row_n>99)?('+99'):($row_n);?>
		  </span>
		  </a></li>
<?
m3:
if($lvl<3){goto m4;}
?>
          <li class="menu_item">
		  <a href="?m=3">
		  <span class="iconify" data-icon="fa-solid:dolly" data-inline="false"></span>
		  Заказы
		  <span style="
		  border: 0px solid black; 
		  border-radius:99px; 
		  padding:1px 10px 1px 10px;
		  background-color: #f14040;
		  color: #ffffff;">
		  <?echo (($com)>99)?('+99'):(($com));?>
		  <?echo " : ";?>
		  <?echo (($err)>99)?('+99'):(($err));?>
		  </span>
		  </a></li>
<?
m4:
?>
          <li class="menu_item">
		  <a href="?m=4">
		  <span class="iconify" data-icon="fa-solid:tools" data-inline="false"></span>
		  Настройки</a></li>
<?
m5:
if($lvl<2){goto m6;}
?>
		  <li class="menu_item">
		  <a href="?m=5">
		  <?
		  $sql = 'SELECT * FROM `tovar` WHERE `dost`="0" or `active`="no";'; 
		  $data = $mysqli->query($sql);
		$row = $data->num_rows;
		  ?>
		  <span class="iconify" data-icon="fa-solid:th" data-inline="false"></span>
		  Склад
		  <span style="
		  border: 0px solid black; 
		  border-radius:99px; 
		  padding:1px 10px 1px 10px;
		  background-color: #f14040;
		  color: #ffffff;">
		  <?echo ($row>99)?('+99'):($row);?>
		  </span>
		  </a></li>
<?
m6:
if($lvl<2){goto m7;}
?>
		  <li class="menu_item">
		  <a href="#" onclick="adddddd();">
		  <span class="iconify" data-icon="fa-solid:people-carry" data-inline="false"></span>
		  Добавить товар</a></li>
<?
m14:
if($lvl<2){goto m7;}
?>
		  <li class="menu_item">
          <a href="?m=12">
		  <span class="iconify" data-icon="fa-solid:people-carry" data-inline="false"></span>
		  Баннеры</a></li>

<?
m7:
if($lvl!=4){goto m8;}
?>
		  <li class="menu_item">
		  <a href="?m=7">
		  <span class="iconify" data-icon="fa-solid:donate" data-inline="false"></span>
		  Касса</a></li>
<?
m8:
if($lvl!=4){goto m9;}
?>
		  <li class="menu_item">
		  <a href="?m=8">
		  <span class="iconify" data-icon="fa-solid:user-tie" data-inline="false"></span>
		  Персонал</a></li>
<?
m9:
if($lvl!=4){goto m10;}
?>
		  <li class="menu_item">
		  <a href="?m=9">
		  <span class="iconify" data-icon="fa-solid:users" data-inline="false"></span>
		  Люди</a></li>
<?
m10:
/*if($lvl<3){goto m12;}
?>
		  <li class="menu_item">
		  <a href="?m=10">
		  <span class="iconify" data-icon="fa-solid:shopping-cart" data-inline="false"></span>
		  Корзина</a></li>
<?*/
m12:
if($lvl!=4){goto m13;}
?>
		  <li class="menu_item">
		  <a href="#" onclick="xxxxxxx();">
		  <span class="iconify" data-icon="fa-solid:haykal" data-inline="false"></span>
		  Верхнии блоки</a></li>
<?
m13:
?>
		  <li class="menu_item"><a href="login.php">
		  <span class="iconify" data-icon="fa-solid:door-open" data-inline="false"></span>
		  Выход</a></li>
<?

$people_row = $mysqli->query('SELECT * FROM `users` WHERE `admin`="0" AND `store`="0" AND `direct`="0" AND `call`="0"')->num_rows;
$people_row_mes = $mysqli->query('select id from users where date_format(OrderDate, \'%Y%m\') = date_format(now(), \'%Y%m\')')->num_rows;
$visit_row_sut = $mysqli->query('select id from visit where day(OrderDate) = day(now())')->num_rows;
$visit_row_ned = $mysqli->query('select id from visit where year(OrderDate) = year(now()) and week(OrderDate, 1) = week(now(), 1)')->num_rows;
$visit_row_mes = $mysqli->query('select id from visit where date_format(OrderDate, \'%Y%m\') = date_format(now(), \'%Y%m\')')->num_rows;


?>
            <li class="menu_item" 
			style="
			padding-left: 18px;
			border: 1px solid black;">
                Просмотры(сут.):<?echo $visit_row_sut;?></br>
                Просмотры(нед.):<?echo $visit_row_ned;?></br>
                Просмотры(мес.):<?echo $visit_row_mes;?></br>
                Пользователи(мес.):<?echo $people_row_mes;?></br>
                Пользователи(всего.):<?echo $people_row;?></br>
            </li>

        </ul>
        <ul class="header-item tabs" id="utility_nav">

        </ul>
      </div>

      <div class="flashes">
		<?

					if($_SESSION['call']=="1") $s="Специалист call-центра";
					if($_SESSION['direct']=="1") $s="Товаровед реализации";
					if($_SESSION['store']=="1")	$s="Товаровед поступление";
					if($_SESSION['admin']=="1") $s="Директор";


		?>

        <div class="flash flash_notice"><?echo $_SESSION['user'];?> : <?echo $s;?></div>
      </div>





				<?

						if($_GET["m"]=="2")include "Modules/Analytics.php";
						if($_GET["m"]=="3")include "Modules/Orders.php";
						//if($_GET["m"]=="Выход")echo "<script>window.location.href='login.php';</script>";
						//if($_GET["m"]=="Поиск")include "Modules/Done.php";
						if($_GET["m"]=="4")include "Modules/Settings.php";
						if($_GET["m"]=="5")include "Modules/Storage.php";
						if($_GET["m"]=="1212")include "Modules/Add_product.php";
						if($_GET["m"]=="7")include "Modules/Till.php";
						if($_GET["m"]=="8")include "Modules/Staff.php";
						if($_GET["m"]=="9")include "Modules/People.php";
						if($_GET["m"]=="10")include "Modules/Basket.php";
						if($_GET["m"]=="11")include "Modules/Todolist.php";
						if($_GET["m"]=="12")include "Modules/Banners.php";
						if($_GET["m"]=="Уведомления")include "Modules/Notifications.php";
						if(!($_GET["m"])){include "Modules/Notifications.php";}
						if($_GET["m"]=="1"){include "Modules/Notifications.php";}



				?>





      <div class="footer" id="footer">
        Бионика маркет Inc.

      </div>
    </div>

<script src="theme/iconify.min.js"></script>
<script>
function adddddd(){
newWin = window.open("../../../../../Modules/Storage/tovar_red.php" ,"", "width=1020,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");}
function xxxxxxx(){
newWin = window.open("../../../../../Modules/Storage/tovar_news.php" ,"", "width=1020,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");}
</script>
</body></html>
<?exit();?>



