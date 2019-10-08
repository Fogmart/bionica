<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 


	if (isset($_POST['fior']) )
		if (isset($_POST['mailr']) )
			if (isset($_POST['passr']) )
			{
			/*echo $_POST['fior'];
			echo $_POST['mailr'];
			echo $_POST['passr'];
			echo $_POST['tel'];*/
			
			if((isset($_POST['tel']))){
				$sql = 'SELECT * FROM `users` WHERE `email`="'. $_POST['mailr'] .'";';
				$data = $mysqli->query($sql);
				$row = $data->num_rows;
				//$res = $data->fetch_assoc();
				//echo "<script>alert('".$row."');</script>";
					if($row==0)
					{
						
						$mysqli->query('
						
						INSERT INTO `users` 
						(`name`,`tel`,`pass`,`email`,`admin`,`store`,`direct`,`call`,`new_pass`,`full_adres`) 
						VALUES
						("'.$_POST['fior'].'", "'.$_POST['tel'].'", "'.$_POST['passr'].'", "'.$_POST['mailr'].'", "0", "0","0","0","0","'.$_POST['full_adres'].'");
						');
						
							$sqlt = 'SELECT * FROM `users`  WHERE `email`="'.$_POST['mailr'].'" LIMIT 1;';
							$datat = $mysqli->query($sqlt);
							if($rowt = $datat->num_rows)$rest = $datat->fetch_assoc();
							
							$mysqli->query("
							INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`) 
							VALUES ('Новый пользователь [".$_POST['fior']."]','Modules/Staff/red.php?id=".$rest['id']."','1','0','0','0');
							"); 

									unset($_SESSION['pass']);
									unset($_SESSION['id']);
									unset($_SESSION['email']);
									unset($_SESSION['admin']);
									unset($_SESSION['store']);
									unset($_SESSION['direct']);
									unset($_SESSION['call']);
									unset($_SESSION['tel']);
									unset($_SESSION['full_adres']);
		
		
						  $_SESSION['user']=$_POST['fior']; //сюда забить логин
						  $_SESSION['pass']=md5($_POST['passr']); //сюда забить пароль
						 $_SESSION['admin']="0";
						 $_SESSION['store']="0";
						$_SESSION['direct']="0";
						  $_SESSION['call']="0";
						 $_SESSION['email']=$_POST['mailr'];
						   $_SESSION['tel']=$_POST['tel'];
					$_SESSION['full_adres']=$_POST['full_adres'];
					
					$sql2 = 'SELECT * FROM `shopping` WHERE `session_id` ="' .session_id() .'" ;';
					$data2 = $mysqli->query($sql2);	
					$row2 = $data2->num_rows;
					while($res2 = $data2->fetch_assoc())
					{
						if($_SESSION['tel']!=$res['tel'])$mysqli->query(" UPDATE `shopping` SET `tel` = '".$_SESSION['tel']."' WHERE `id`=".$res2["id"].";");
						if($_SESSION['email']!=$res['email'])if(isset($_SESSION['email']))	$mysqli->query(" UPDATE `shopping` SET `email` = '".$_SESSION['email']."' WHERE `id`=".$res2["id"].";");
						if($_SESSION['tel']!=$res['tel'])if(isset($_SESSION['tel']))	$mysqli->query(" UPDATE `shopping` SET `tel` = '".$_SESSION['tel']."' WHERE `id`=".$res2["id"].";");
						if($_SESSION['fio']!=$res['fio'])if(isset($_SESSION['fio']))	$mysqli->query(" UPDATE `shopping` SET `fio` = '".$_SESSION['fio']."' WHERE `id`=".$res2["id"].";");
						if($_SESSION['full_adres']!=$res['full_adres'])if(isset($_SESSION['full_adres']))	$mysqli->query(" UPDATE `shopping` SET `full_adres` = '".$_SESSION['full_adres']."' WHERE `id`=".$res["id"].";");
					}
			
						echo "<script>alert('Добро пожаловать');close_all();</script>";	
						exit();	
					}
			}
			echo "<script>alert('Такой пользователь есть');close_all();</script>";	
			exit();	
			}
	if (isset($_POST['maill']) )
		if (isset($_POST['passl']) )
			{
			$sql = 'SELECT * FROM `users` WHERE `email`="'. $_POST['maill'] .'" and `pass`="'. $_POST['passl'] .'";';
				$data = $mysqli->query($sql);
				$row = $data->num_rows;
				$res = $data->fetch_assoc();
					
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
						$_SESSION['full_adres']=$_POST['full_adres'];
						
					echo "<script>alert('Добро пожаловать');close_all();</script>";
					}
					else
					{
					$_SESSION['user']="anonymous";
							unset($_SESSION['pass']);
							unset($_SESSION['id']);
							unset($_SESSION['email']);
									unset($_SESSION['admin']);
									unset($_SESSION['store']);
									unset($_SESSION['direct']);
									unset($_SESSION['call']);
									unset($_SESSION['tel']);
									unset($_SESSION['full_adres']);
					echo "<script>alert('не верный логин или пароль');close_all();</script>";
					}
			//$_SESSION['user']=$_POST['maill'];
			
			
			exit();	
			}
	if (isset($_POST['remail']) )
			{
			echo $_POST['maill'];
			echo $_POST['passl'];
			
			echo "<script>alert('re');close_all();</script>";
			exit();	
			}
	
?>
<div class="modal-content">
                    <div class="modal-header">
                        <button onclick="close_all();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <!-- Start Login Register Area -->
        <div class="htc__login__register bg__white ptb--0">
            <div class="container" style="background:rbga(0,0,0,0);">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <ul class="login__register__menu" role="tablist">
                            <li role="presentation"  id="login_btn" class="login active"><a href="#" onclick="login1();" role="tab" data-toggle="tab">Войти</a></li>
                            <li role="presentation"  id="register_btn" class="register"><a href="#" onclick="register1();" role="tab" data-toggle="tab">Регистрация</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Start Login Register Content -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="htc__login__register__wrap" style="background:#fff0;">
                            <!-- Start Single Content -->
							
							<script>
							function login1(){
								document.getElementById("register1").style.display="none";
								document.getElementById("login1").style.display="block";
								document.getElementById("relogin1").style.display="none";
								document.getElementById("register_btn").classList.remove("active");
								document.getElementById("login_btn").classList.add("active");
								
							}
							function register1(){
								document.getElementById("login1").style.display="none";
								document.getElementById("register1").style.display="block";
								document.getElementById("relogin1").style.display="none";
								document.getElementById("login_btn").classList.remove("active");
								document.getElementById("register_btn").classList.add("active");
							}
							</script>
							
                            <div id="login1" style="display:block;" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                                <form class="login" method="post" id="login11111">
                                    <input id="maill" type="email" placeholder="Эл. почта*">
                                    <input id="passl" type="password" placeholder="Пароль*">
                                </form>
                                <div class="tabs__checkbox">
                                    <input type="checkbox">
                                    <span> Запомнить меня</span>
                                    <span class="forget"><a onclick='document.getElementById("login1").style.display="none";
								document.getElementById("relogin1").style.display="block";'>Забыл пароль?</a></span>
                                </div>
                                <div class="htc__login__btn mt--30">
                                    <a onclick="log();">Войти</a>
                                </div>
                                
                            </div>
							
							<div id="relogin1" style="display:none;" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                                <form class="login" method="post" id="relogin">
                                    <input id="remail" type="email" placeholder="Эл. почта*">
                                </form>
                                <div class="tabs__checkbox">
                                    <input id="re" type="checkbox">
                                    <span> Выслать на почту</span>
                                
                                </div>
                                <div class="htc__login__btn mt--30">
                                    <a onclick="relog();">Войти</a>
                                </div>
                                
                            </div>
							
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
                            <div id="register1" style="display:none;" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                                <form class="login" method="post" id="register">
                                    <input id="fior" type="text" placeholder="ФИО*">
									<input id="adresr" type="text" placeholder="Адрес (доставка)">
                                    <input id="mailr" type="email" placeholder="Эл. почта*">
									<input id="telr" type="email" placeholder="Телефон*">
                                    <input id="passr" type="password" placeholder="Пароль*">
                                </form>
                                <div class="tabs__checkbox">
                                    <input id="konf" type="checkbox">
                                    <span style="text-transform: none;"> Согласен с <a class="active"><u>политикой конфиденциальности</u></a></span>
                                </div>
                                <div class="htc__login__btn">
                                    <a onclick="reg();">Регистрация</a>
									<script>
										function reg(){
											if(!document.getElementById("konf").checked)
												alert("Регистрация возможна только если Вы согласны с политикой конфиденциальности!");
											else{
												fior = document.getElementById("fior").value;
												fior = fior.length;
												mailr = document.getElementById("mailr").value;
												mailr = mailr.length;
												passr = document.getElementById("passr").value;
												passr = passr.length;
												telr = document.getElementById("telr").value;
												telr = telr.length;
													if((fior*mailr*passr*telr)==0)
													{
														alert("Забыли что то указать, проверте данные");
													}
													if(telr<10)
													{
														alert("Неверный номер телефона");
													}
													else 
													{
															var text1 = $('#fior').val();
															var text2 = $('#mailr').val();
															var text3 = $('#passr').val();
															var text4 = $('#telr').val();
															var text5 = $('#adresr').val();
															
															var post1={fior:text1, mailr:text2, passr:text3, tel:text4, full_adres:text5};
															var url="auth2.php";
															var metod="POST";
															
															$.ajax({
																type: metod,
																url: url,
																data: post1
															}).done(function( result )
																{
																	$("#auth2").html( result );
																});
														//document.getElementById("register").submit();
													}
											}
										}
										function log(){
												maill = document.getElementById("maill").value;
												maill = maill.length;
												passl = document.getElementById("passl").value;
												passl = passl.length;
													if((maill*passl)==0)
													{
														alert("Забыли что то указать, проверте данные");
													}
													else 
													{
														
															var text2 = $('#maill').val();
															var text3 = $('#passl').val();
															
															var post1={maill:text2, passl:text3};
															var url="auth2.php";
															var metod="POST";
															
															$.ajax({
																type: metod,
																url: url,
																data: post1
															}).done(function( result )
																{
																	$("#auth2").html( result );
																});
														//document.getElementById("login11111").submit();
													}
										}
										function relog(){
												remail = document.getElementById("remail").value;
												remail = remail.length;
													if(!document.getElementById("re").checked)
														alert("Забыли что то указать, проверте данные");
													else{
													
														if(remail==0)
														{
															alert("Забыли что то указать, проверте данные");
														}
														else 
														{
															var text2 = $('#remail').val();

															var post1={remail:text2};
															var url="auth2.php";
															var metod="POST";
															
															$.ajax({
																type: metod,
																url: url,
																data: post1
															}).done(function( result )
																{
																	$("#auth2").html( result );
																});
																
															//document.getElementById("relogin").submit();
														}
													}
										}
									</script>
                                </div>
                          
                            </div>
                            <!-- End Single Content -->
                        </div>
                    </div>
                </div>
                <!-- End Login Register Content -->
            </div>
        </div>
        <!-- End Login Register Area -->
                        </div><!-- .modal-product -->
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->