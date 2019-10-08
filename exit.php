<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 

unset($_SESSION['user']);
unset($_SESSION['pass']);
unset($_SESSION['id']);
unset($_SESSION['email']);
unset($_SESSION['admin']);
unset($_SESSION['store']);
unset($_SESSION['direct']);
unset($_SESSION['call']);
unset($_SESSION['tel']);
session_unset(); //удалит все переменные сессии
session_destroy(); //удалит файл сессии на сервере
setcookie('PHPSESSID','0',1); //удалит куки в браузере 	
//header("Location: " . $_SERVER['HTTP_REFERER']); // перенаправление на нужную страницу
	echo "<script>close_all();</script>";
exit(); 	   // прерываем работу скрипта, чтобы забыл о прошлом
?>