<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";
require "header.php";

?>
<style>
	ifarme{scrolling="no";}
</style>
<main>
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Помощь</h2>
                                <nav class="bradcaump-inner">
<style>
.mybutton{
	border:1px solid #bbbbbb;
	padding: 4px;
	border-radius:7px;
	    line-height: 3;
		    font-size: 12px;
			    margin: 0px 2px;
    white-space: nowrap;
}
</style>
                                  <a class="breadcrumb-item mybutton" style="text-transform: inherit;" target="_blank" href="helpers.php#договор-оферта">
									Договор-оферта
								  </a>
                                  <a class="breadcrumb-item mybutton" style="text-transform: inherit;" target="_blank" href="helpers.php#Контактные данные организации">
									Контактные данные организации
								  </a>
                                  <a class="breadcrumb-item mybutton" style="text-transform: inherit;" target="_blank" href="helpers.php#Сферы деятельности организации">
									Сферы деятельности организации
								  </a>
								  <a class="breadcrumb-item mybutton" style="text-transform: inherit;" target="_blank" href="helpers.php#Политика конфиденциальности">
									Политика конфиденциальности
								  </a>
                                  <a class="breadcrumb-item mybutton" style="text-transform: inherit;" target="_blank" href="helpers.php#Пользовательское соглашение">
									Пользовательское соглашение
								  </a>
                                  <a class="breadcrumb-item mybutton" style="text-transform: inherit;" target="_blank" href="helpers.php#Способы оплаты">
									Способы оплаты
								  </a>
								  <a class="breadcrumb-item mybutton" style="text-transform: inherit;" target="_blank" href="helpers.php#Описание возврата товара/услуги">
									Описание возврата товара/услуги
								  </a>
                                  <a class="breadcrumb-item mybutton" style="text-transform: inherit;" target="_blank" href="helpers.php#Условия доставки товара">
									Условия доставки товара
								  </a>
                                  <a class="breadcrumb-item mybutton" style="text-transform: inherit;" target="_blank" href="helpers.php#Описание процесса передачи данных">
									Описание процесса передачи данных
								  </a>
								  
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


				<?
				$sql = 'SELECT * FROM `adres` ORDER BY `id`';
							$Adres = $mysqli->query($sql);
							if($Adres_row = $Adres->num_rows)$Adres_res = $Adres->fetch_assoc();

				?>


<section class="htc__contact__area ptb--120 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="htc__contact__container">
                            <div class="htc__contact__address">
                                <h2 class="contact__title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Контактная информация</font></font></h2>
                                <div class="contact__address__inner">
                                    <!-- Start Single Adress -->
                                    <div class="single__contact__address">
                                        <div class="contact__icon">
                                            <span class="ti-location-pin"></span>
                                        </div>
                                        <div class="contact__details">
                                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Расположение: </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?echo $Adres_res['full_adres'];?></font></font></p>
                                        </div>
                                    </div>
                                    <!-- End Single Adress -->
                                </div>
                                <div class="contact__address__inner">
                                    <!-- Start Single Adress -->
                                    <div class="single__contact__address">
                                        <div class="contact__icon">
                                            <span class="ti-mobile"></span>
                                        </div>
                                        <div class="contact__details">
                                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Телефон: </font></font><br><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">+7<?echo $Adres_res['tel1']." ".$Adres_res['tel2'];?></font></font></a></p>
                                        </div>
                                    </div>
                                    <!-- End Single Adress -->
                                    <!-- Start Single Adress -->
                                    <div class="single__contact__address">
                                        <div class="contact__icon">
                                            <span class="ti-email"></span>
                                        </div>
                                        <div class="contact__details">
                                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Почта: </font></font><br><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?echo $Adres_res['email'];?></font></font></a></p>
                                        </div>
                                    </div>
                                    <!-- End Single Adress -->
                                </div>
                            </div>
                            <div class="contact-form-wrap">
                            <div class="contact-title">
                                <h2 class="contact__title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Связаться</font></font></h2>
                            </div>

                            <form id="contact-form" action="/mail.php" method="post">
                                <div class="single-contact-form">
                                    <div class="contact-box name">
                                        <input type="text" name="name" placeholder="Имя*">
                                        <input type="email" name="email" placeholder="Почта*">
                                    </div>
                                </div>
                                <div class="single-contact-form">
                                    <div class="contact-box subject">
                                        <input type="text" name="subject" placeholder="Тема*">
                                    </div>
                                </div>
                                <div class="single-contact-form">
                                    <div class="contact-box message">
                                        <textarea name="message" placeholder="Сообщение*"></textarea>
                                    </div>
                                </div>
                                <div class="contact-btn">
                                    <button type="submit" class="fv-btn"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ОТПРАВИТЬ</font></font></button>
                                </div>
                            </form>

                        </div>
                        <div class="form-output">
                            <p class="form-messege"></p>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
                        <div class="map-contacts">
                            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Abd69ca157bb5f817bd6765b8834297497a7e615144bfdd40c09475d35cf0ca9f&amp;source=constructor" width="497" height="400" frameborder="0">
							</iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

</main>
<?
require "footer.php";
?>
