<?php if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 

if(($_SESSION['admin']=="0")&&($_SESSION['store']=="0")&&($_SESSION['direct']=="0")&&($_SESSION['call']=="0"))
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
						}
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
						}


	if(isset($_POST['submit']))
	{
			if(isset($_POST['pass']) && isset($_POST['user']))
			{
				$sql = 'SELECT * FROM `users` WHERE `email`="'. $_POST['user'] .'" and `pass`="'. $_POST['pass'] .'";';
				$data = $mysqli->query($sql);
				if(($row = $data->num_rows)){
				$res = $data->fetch_assoc();}
					
					if($row>0 && $rov<2)
					{
						$_SESSION['user']=$res['name']; //сюда забить логин
						$_SESSION['pass']=md5($res['pass']); //сюда забить пароль
						$_SESSION['id']=$res['id'];
						$_SESSION['admin']=$res['admin'];
						$_SESSION['store']=$res['store'];
						$_SESSION['direct']=$res['direct'];
						$_SESSION['call']=$res['call'];
						$_SESSION['email']=$res['email'];
						$_SESSION['tel']=$res['tel'];
						$_SESSION['full_adres']=$res['full_adres'];
						
						if(($res['admin']=="0")&&($res['store']=="0")&&($res['direct']=="0")&&($res['call']=="0"))
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
								//setcookie('PHPSESSID','0',1); //удалит куки в браузере 
								session_unset(); //удалит все переменные сессии
								session_destroy(); //удалит файл сессии на сервере
								
								//header("Location: " . $_SERVER['HTTP_REFERER']); // перенаправление на нужную страницу
								echo "ВАМ НЕ НАЗНАЧЕНА ДОЛЖНОСТЬ";
								exit(); 	   // прерываем работу скрипта, чтобы забыл о прошлом
						}
						//header("Location: admin.php");// перенаправление на нужную страницу
						//header("Location: " . $_SERVER['HTTP_REFERER']);
						//exit(); // прерываем работу скрипта, чтобы забыл о прошлом
					}

			}
			else
			{

				unset($_SESSION['user']);
				unset($_SESSION['pass']);
				unset($_SESSION['id']);
				unset($_SESSION['email']);
						unset($_SESSION['admin']);
						unset($_SESSION['store']);
						unset($_SESSION['direct']);
						unset($_SESSION['call']);
						unset($_SESSION['tel']);
						unset($_SESSION['full_adres']);
						//setcookie('PHPSESSID','0',1); //удалит куки в браузере 
						session_unset(); //удалит все переменные сессии
						session_destroy(); //удалит файл сессии на сервере
						
	
					//header("Location: " . $_SERVER['HTTP_REFERER']); // перенаправление на нужную страницу
						   // прерываем работу скрипта, чтобы забыл о прошлом
			}
	}
$_POST = NULL;?>

  <title>Login</title>

    <link rel="stylesheet" media="screen" href="theme/active_admin.css">
    <link rel="stylesheet" media="print" href="theme/print.css">
    <script src="theme/active_admin.js"></script>

<table style="width:100%;">

<tr>

	<td>
					<?php
					if ($_SESSION['user'])
					if ($_SESSION['user']!='anonymous')
					{
					echo '<form method="post" style="text-align: center;" action="">
					<p>'.$_SESSION["user"].'</p>
					<input type="submit" name="submit" value="Выйти" style="height:30px;"/>
					<p></p>
					</form>
					<a href="admin.php"><input type="submit" value="В админ панель" href="admin.php" style="height:30px;"></a>
					';
					exit;
					}
					else
					{
					/*echo '<form method="post" style="text-align: center;" action="">
								<p>ВХОД</p>
								<input value="" type="text" name="user" />
								<input value="" type="text" name="pass" />
								<input type="submit" name="submit" value="Войти" />
						</form>';	*/
					}
			?>
	</td>

</tr>
</table>


<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  



  

    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="active_admin logged_out new">
<div id="wrapper">

  <div id="content_wrapper">
      <div class="flash flash_alert">Необходимо войти что бы продолжить.</div>
    <div id="active_admin_content">
      <div id="login">
  <h2>Вход</h2>

<form id="session_new" novalidate="novalidate" class="formtastic user" action="" accept-charset="UTF-8" method="post">
	<input name="utf8" type="hidden" value="✓">
	<fieldset class="inputs">
	<ol>
		<li class="email input required autofocus stringish" id="user_email_input">
			<label for="user_email" class="label">
			Почта
			<abbr title="required">*</abbr>
			</label>
		<input maxlength="255" id="user_email" autofocus="autofocus" value="" type="email" name="user">
		</li>
		<li class="password input required stringish" id="user_password_input">
			<label for="user_password" class="label">
			Пароль
			<abbr title="required">*</abbr>
			</label><input value="" maxlength="128" id="user_password" type="password" name="pass">
		</li>

	</ol>
	</fieldset>
	<fieldset class="actions">
		<ol>
			<li class="action input_action " id="user_submit_action">
			<input type="submit" name="submit" value="Войти">
			</li>
		</ol>
	</fieldset>
</form>

<br>
</div>
    </div>
  </div>
  <div id="footer">
    
  </div>
</div>


</body></html>

