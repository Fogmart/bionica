				<? require "connect2.php";
				$sql = 'SELECT * FROM `adres` ORDER BY `id`';
							$Adres = $mysqli->query($sql);
							if($Adres_row = $Adres->num_rows)$Adres_res = $Adres->fetch_assoc();
							
				?>		


<div class="offsetmenu__close__btn" onclick="close_all();">
						<font style="font-size: 36px;"><i class="zmdi zmdi-close"></i></font>
                    </div>
                    <div class="off__contact">
                        <div class="logo">
                            <a>
                                <img src="images/logo/logo.png" alt="логотип">
                            </a>
                        </div>
                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Связь с нами</font></font></p>
                    </div>
					<ul style="width:100%; text-align:center;">

                    <ul class="sidebar__thumd" style="margin:auto; width: 230px;">
						
						<li><a href="tel:+7<? echo $Adres_res['tel1'];?>"><i style="font-size:40px;" class="zmdi zmdi-phone-in-talk"></i></a></li>
						<li><a href="https://api.whatsapp.com/send?phone=+7<? echo $Adres_res['whatsapp'];?>"><i style="font-size:40px;" class="zmdi zmdi-whatsapp"></i></a></li>
						<li style="width: 44px;margin: 0px;"><a href="viber://chat?number=+7<? echo $Adres_res['viber'];?>"><img src="/images/logo/viber.png"></a></li>
						<li style="width: 44px;margin: 0px;"><a href="tg://resolve?domain=<? echo $Adres_res['telegram'];?>"><img src="/images/logo/telegram-app.png"></a></li>
						<li><a href="sms://+7<? echo $Adres_res['tel1'];?>"><i style="font-size:40px;" class="zmdi zmdi-phone-msg"></i></a></li>
					
					</ul>
					<ul class="sidebar__thumd" style="margin:auto; width: 230px;">
						
						<li><a ><i style="font-size:40px;" class="zmdi zmdi-vk"></i></a></li>
						<li><a ><i style="font-size:40px;" class="zmdi zmdi-odnoklassniki"></i></a></li>
						<li><a ><i style="font-size:40px;" class="zmdi zmdi-twitter"></i></a></li>
                        <li><a href="mailto:<? echo $Adres_res['email'];?>"><i style="font-size:40px;" class="zmdi zmdi-email"></i></a></li>
                        <li><a><i style="font-size:40px;" class="zmdi zmdi-facebook-box"></i></a></li>
					
                    </ul>
					</ul>
        
						<?
				$sql = 'SELECT * FROM `adres` ORDER BY `id`';
							$Adres = $mysqli->query($sql);
							if($Adres_row = $Adres->num_rows)$Adres_res = $Adres->fetch_assoc();
							
				?>	
		
		
		<div class="htc__contact__address" style="text-align:center;">
                                <h2 class="contact__title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Контактная информация</font></font></h2>
                                <div class="contact__address__inner">
                                    <!-- Start Single Adress -->
                                    <div class="single__contact__address" style="text-align:left;">
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
                                    <div class="single__contact__address" style="text-align:left;">
                                        <div class="contact__icon">
                                            <span class="ti-mobile"></span>
                                        </div>
                                        <div class="contact__details">
                                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Телефон: </font></font><br><a href="tel:+7<?echo $Adres_res['tel1']?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">+7<?echo $Adres_res['tel1']; if($Adres_res['tel2']!="")echo "+7".$Adres_res['tel2'];?></font></font></a></p>
                                        </div>
                                    </div>
                                    <!-- End Single Adress -->
								</div>
                                <div class="contact__address__inner">	
                                    <!-- Start Single Adress -->
                                    <div class="single__contact__address" style="text-align:left;">
                                        <div class="contact__icon">
                                            <span class="ti-email"></span>
                                        </div>
                                        <div class="contact__details">
                                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Почта: </font></font><br><a href="mailto:<? echo $Adres_res['email'];?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?echo $Adres_res['email'];?></font></font></a></p>
                                        </div>
                                    </div>
                                    <!-- End Single Adress -->
                                </div>
                            </div>
<br></br>
<br></br>
<br></br>
<br></br>