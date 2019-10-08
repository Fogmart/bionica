<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";

if(isset($_POST['callout'])){
	echo "<script>close_all();alert('Мы вам перезвоним');</script>";

$dede='"color:#e91e63;"';
							$mysqli->query("
							INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`) 
							VALUES ('<font style=".$dede.">Просьба перезвонить [".$_POST['callout']."]</font>','no','0','0','0','1');
							");
SMSadmin();
}

function SMSadmin()
{
$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';

// Настройки SMTP
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;

$mail->Host = 'ssl://server38.hosting.reg.ru';
$mail->Port = 465;
$mail->Username = 'info@bionika-market.com';
$mail->Password = '2015club!!!';

// От кого
$mail->setFrom('info@bionika-market.com', 'Бионика Маркет');

// Кому
$mail->addAddress('info@bionika-market.com', 'Пользователь');

// Тема письма
$subject = "Бионика Маркет"; // Заголовок письма
$mail->Subject = $subject;

// Тело письма
//$body = '<p><strong>«Hello, world!» </strong></p>';
$body = 'Просьба перезвонить [  '.$_POST['callout'].'  ].';

$mail->msgHTML($body);

// Приложение
//$mail->addAttachment(__DIR__ . '/image.jpg');

$mail->send();
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
                <!-- Start Login Register Content -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="htc__login__register__wrap" style="background:#fff0; text-align:center;">
                            <!-- Start Single Content -->
							<h2>Мы перезвоним вам</h2><h2>если вы оставите нам номер телефона.</h2>
                            <div id="login1" style="display:block;" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                                <form class="login" method="post" id="login11111">
                                    <input id="maill" type="tel" placeholder="Телефон*">
                                </form>
                                <div class="htc__login__btn mt--30">
                                    <a onclick="log();" style="width: 100%;">Перезвонить</a>
                                </div>

                            </div>

									<script>
										function log(){
												maill = document.getElementById("maill").value;
												maill = maill.length;

													if(maill==0)
													{
														alert("Забыли что то указать, проверте данные");
													}
													else
													{

															var text2 = $('#maill').val();

															var post1={callout:text2};
															var url="callout.php";
															var metod="POST";

															$.ajax({
																type: metod,
																url: url,
																data: post1
															}).done(function( result )
																{
																	$("#auth2").html( result );
																});

													}
										}

									</script>
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
