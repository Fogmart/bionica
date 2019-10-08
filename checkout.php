<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";
	require "header.php";

	if(isset($_POST['email']))
	{
        $mysqli->query("UPDATE `shopping` SET `email`='".$_POST['email']."' WHERE `session_id`='".session_id()."';");
        $_SESSION['email'] = $_POST['email'];
	}
	if(isset($_POST['tel']))
	{
        $mysqli->query("UPDATE `shopping` SET `tel`='".$_POST['tel']."' WHERE `session_id`='".session_id()."';");
	}
	if(isset($_POST['fio']))
	{
	    $mysqli->query("UPDATE `shopping` SET `fio`='".$_POST['fio']."' WHERE `session_id`='".session_id()."';");
	}
    if(isset($_POST['full_adres']))
    {
        $mysqli->query("UPDATE `shopping` SET `full_adres`='".$_POST['full_adres']."' WHERE `session_id`='".session_id()."';");
    }


$sum_all=0;
$massa_all=0;
$sum_dos=0;
if(isset($_SESSION['email'])){
    if($_SESSION['email']!='')
    if($_SESSION['email']!=' ')
$sql222 = 'SELECT * FROM `shopping` WHERE (`email` ="'. $_SESSION['email'] .'" OR `session_id` ="'. session_id() .'") and `check`="no";';
}
else{
    $sql222 = 'SELECT * FROM `shopping` WHERE `session_id` ="'. session_id() .'" and `check`="no";';
}
		$data222 = $mysqli->query($sql222);
		$row222 = $data222->num_rows;
		while($res222 = $data222->fetch_assoc())
		{

		$massa_prom= (int)$res222['kolvo']*(double)$res222['massa'];
		$massa_all+=$massa_prom;

		if($res222['art']!="0")
		{
		$sum_prom= (int)$res222['kolvo']*(double)$res222['sum_p'];
		$sum_all+=$sum_prom;
		}
		else
			{
				$sum_dos+=(double)$res222['sum_p'];
			}
		}

?>



<!--
форма оформления заказа и редиректа на оплату

по сиссии определить что в корзине и стоимость
+ создать в кассе заявку на оплату
+ получить номер этой заявки
+ создать редирект для оплаты
+ редирект занести в кассу
+ доставка

-->
        <script src="js/vendor/jquery-1.12.0.min.js"></script>
<!--        <script src="Modules/jquery.kladr.min.js" type="text/javascript"></script>-->
        <script src="Modules/kladr/js/core.js" type="text/javascript"></script>
        <script src="Modules/kladr/js/kladr.js" type="text/javascript"></script>
        <script src="Modules/kladr/js/kladr_zip.js" type="text/javascript"></script>
        <script src="Modules/Settings/js/form_with_map.js" type="text/javascript"></script>
		<link href="Modules/jquery.kladr.min.css" rel="stylesheet">


<!-- Start Checkout Area -->
<main>
<section class="our-checkout-area ptb--0 bg__white">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8">
			<div class="ckeckout-left-sidebar">
			<!-- Start Checkbox Area -->
				<div class="checkout-form" id="point1" style="display:block;">
					<h2 class="section-title-3">ПЛАТЕЖНЫЕ РЕКВИЗИТЫ</h2>
					<div class="checkout-form-inner">
						<div class="single-checkout-box">
							<input id="fio" type="text" placeholder="Фамилия Имя*" value="<?if($_SESSION['user']!='anonymous')echo $_SESSION['user'];?>">
						</div>
						<div class="single-checkout-box">
							<input id="email" type="email" placeholder="Эл.Почта* (info@mail.ru)" value="<?echo $_SESSION['email'];?>">
                        <div class="single-checkout-box">
                        </div>
							<input id="tel22" type="text" placeholder="Телефон* (+7928...)"  value="<?echo $_SESSION['tel'];?>">
						</div>
						<div class="single-checkout-box checkbox">
						<button onclick="next1();">Далее</button>
						</div>
					</div>
				</div>

			<script>
            function validator(text1,text2,text3)
            {
                return true;
                var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
                if(!(pattern.test(text2)))
                {
                    document.getElementById('email').style.border='2px dashed red';
                    return false;
                }

                var patterntel = /^(\+7|8)(\(\d{3}\)|\d{3})\d{7}$/;
                if(!(patterntel.test(text3)))
                {
                    document.getElementById('tel22').style.border='2px dashed red';
                    return false;
                }

                var patternname = /^[A-ZА-ЯЁ\s-]+$/i;
                if(!(patternname.test(text1)))
                {
                    document.getElementById('fio').style.border='2px dashed red';
                    return false;
                }

                    if(!(text1))
                    {
                        document.getElementById('fio').style.border='2px dashed red';
                        return false;
                    }
                    if(!(text2))
                    {
                        document.getElementById('email').style.border='2px dashed red';
                        return false;
                    }
                    if(!(text3))
                    {
                        document.getElementById('tel22').style.border='2px dashed red';
                        return false;
                    }
                document.getElementById('fio').style.border='1px solid green';
                document.getElementById('email').style.border='1px solid green';
                document.getElementById('tel22').style.border='1px solid green';
                return true;
            }

			function next1(){
				var text1 = $('#fio').val();
				var text2 = $('#email').val();
				var text3 = $('#tel22').val();
				var post={fio:text1, email:text2, tel:text3};
				var url=location.href;
				var metod="POST";


                if(validator(text1,text2,text3))
				if(text1)
				if(text2)
				if(text3) {
                    $.ajax({
                        type: metod,
                        url: url,
                        data: post
                    }).done(function (result) {

                        document.getElementById('point2').style.display = 'block';
                        document.getElementById('point1').style.display = 'none';
                    }).fail(function(xhr, status, error){
                        alert('сервис времено не работает');
                    });
                }
			}
			</script>
			<!-- End Checkbox Area -->
			<!-- Start Checkbox Area -->
				<div class="checkout-form" id="point2" style="display:none;">
				<div class="address">
				<div class="js-form-address" name="myForm">
					<h2 class="section-title-3">Адрес доставки</h2>
					<div class="checkout-form-inner">

						<div class="single-checkout-box">
							<input type="text" id="city" style="width: 100%;" name="city" placeholder="1 - Город*">
						</div>
						<div class="single-checkout-box">
							<input type="text" id="street" name="street" placeholder="2 - Улица*">
							<input type="text" id="building" name="building" placeholder="3 - Дом*">
						</div>
						<div class="single-checkout-box">
							<input type="text" id="apartment" name="apartment" placeholder="4 - Квартира*">
							<input type="text" id="office" name="office" placeholder="4 - Офис*">
						</div>
							<div class="addition"><div class="js-log"><div id="zip" >
								<span style="" class="value" id="index_from"></span>
							</div></div></div>
						<div class="single-checkout-box">
							<input name="index" id="index" type="text" placeholder="5 - Индекс"/>
						</div>

						<div class="single-checkout-box checkbox">
						<button onclick="document.getElementById('point1').style.display='block';document.getElementById('point2').style.display='none';">Назад</button>
						<button onclick="next2();">Завершить</button>
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
			<script>
                function validator2(text2,text3,text4,kv,indx)
                {
                    if(!(text2))
                    {
                        document.getElementById('city').style.border='2px dashed red';
                        return false;
                    }
                    document.getElementById('city').style.border='1px solid green';
                    if(!(text3))
                    {
                        document.getElementById('street').style.border='2px dashed red';
                        return false;
                    }
                    document.getElementById('street').style.border='1px solid green';
                    if(!(text4))
                    {
                        document.getElementById('building').style.border='2px dashed red';
                        return false;
                    }
                    document.getElementById('building').style.border='1px solid green';
                    // if(!(kv))
                    // {
                    //     document.getElementById('apartment').style.border='2px dashed red';
                    //     document.getElementById('office').style.border='2px dashed red';
                    //     return false;
                    // }
                    document.getElementById('apartment').style.border='1px solid green';
                    document.getElementById('office').style.border='1px solid green';

                    if(!(indx))
                    {
                        document.getElementById('index').style.border='2px dashed red';
                        return false;
                    }
                    if(indx.length!=6)
                    {
                        document.getElementById('index').style.border='2px dashed red';
                        return false;
                    }

                    document.getElementById('index').style.border='1px solid green';

                    return true;
                }
			function next2(){
				var text2 = $('#city').val();
				var text3 = $('#street').val();
				var text4 = $('#building').val();
				var text5 = $('#apartment').val();
				var text6 = $('#office').val();
				var text7 = $('#index_from').text();
				var text8 = $('#index').val();

                indx=text8;

				if(text5)kv="кв. "+text5;
				else kv="оф. "+text6;

				kv2=text5+''+text6;

				var full_adr=indx+", г. "+text2+", ул."+text3+", "+text4+", "+kv;

				var post={full_adres:full_adr};
                var url=location.href;
				var metod="POST";

				if(validator2(text2,text3,text4,kv2,text8))
				if(text2)
				if(text3)
				if(text4)
				if(kv)
				if(indx)
				$.ajax({
					type: metod,
					url: url,
					data: post
				}).done(function( result )
				{
				    document.getElementById('point3').style.display='block';
				    document.getElementById('point2').style.display='none';
				    next3();
				});




			}
			function next3(){
				var text7 = $('#index_from').text();
				var text8 = $('#index').val();

				if(text8)
					indx=text8;
				else
					indx=text7;

				var massa="<?echo $massa_all;?>";
				var stoim="<?echo $sum_all;?>";

				var url="dostavka.php";
				var metod="POST";
				var index1="<? echo $Adres_res['index'];?>";

				var post={index1:index1 ,index2:indx ,massa:massa ,sum_p:stoim};

				$.ajax({
					type: metod,
					url: url,
					data: post
				}).done(function( result )
						{
							$("#dostavkahtml").html( result );
						});

			}
			</script>
			<!-- End Checkbox Area -->


            <div id="point3" style="display:none;">
			<!-- Start Checkbox Area -->
				<div class="checkout-form">
                    <div class="single-checkout-box checkbox">
                        <button onclick="document.getElementById('point2').style.display='block';document.getElementById('point3').style.display='none';">Назад</button>
                    </div>
					<h2 class="section-title-3" style="font-size: 20px;">
					Итог (за товары) : <?echo $sum_all;//$_SESSION['summ_all'];?> р</br>

					<p style="color:red;" >Внимание выберете способ доставки!!</p>
					</h2>
					<div class="checkout-form-inner">


						<div class="single-checkout-box checkbox">
						<p style="border:1px dotted red;">
						<label>
							<input type="radio" name="dostavka" onclick="dostavkaadd('Без доставки',' ',' ','0.00');" id="dostavka" value="0">
                            <img src="images/icons/point.png" style="height: 40px;"/>Забрать из пункта выдачи (<? echo $Adres_res['full_adres'];?>)
						</label>
						</p>
						</br>

						<div id="dostavkahtml">
<!---доставка-->
						</div>
						<div id="dostavkahtml1">
<!---доставка-->
						</div>


						</div>
					</div>
                    <div class="single-checkout-box checkbox">
                        <button onclick="document.getElementById('point4').style.display='block';document.getElementById('point3').style.display='none';">Далее</button>
                    </div>
				</div>

			<!-- End Checkbox Area -->
</div>
<div id="point4" style="display:none;">
    <style>
        .typeplayment * {
            transition: .5s ease-in-out;
        }
        .typeplayment{
            width: 100%; height: 110px; border-radius: 4px;
            border:1px solid #dbdbdd;
            color: #969496;
            padding: 20px;
            line-height: 32px;
            transition: 0.5s ease;
        }
        .inplayment{display:none;}
        .keyplayment{
            float: right;
            padding: 6px;
            border-radius: 100px;
            box-shadow: 0px 0px 12px 0px #c0c0c0;
        }
        .inplayment:checked + label {
            border:1px solid #39b25a;
        }
        .inplayment:checked + label > div > div {
            background: #39b25a;
        }
        .buttonsplayment{
            width: 100%;
            border:1px solid #fff;
            color: #ffffff;
            background: #ec1b23;
            padding: 20px;
            line-height: 32px;
            transition: 0.5s ease;
            text-align: center;
            font-weight: 500;
            display: none;
        }


    </style>
    <div class="our-payment-sestem">
        <div class="single-checkout-box checkbox">
            <button onclick="document.getElementById('point3').style.display='block';document.getElementById('point4').style.display='none';">Назад</button>
        </div>
        <h2 class="section-title-3" style="font-size: 20px;">Cпособ оплаты :</h2>
        <ul class="payment-menu">
            <li style="width: 49%; max-width:340px;height: 150px;">

                <input type="radio" class="inplayment" name="typeplayment" id="typeplayment1"/>
                <label class="typeplayment" for="typeplayment1" onclick="$('.buttonsplayment').hide();$('#buttonsplayment1').show();">

                    <div style="font-size: 18px;">При получении
                        <div class="keyplayment">
                            <div style="background: white;padding: 6px;border-radius: 100px;"></div>
                        </div>
                    </div>
                    <div style="font-weight: 500;">Наложенный платеж</div>
                </label>

            </li>
            <?
            $sql1 = 'SELECT * FROM `bankyd` ORDER BY `id`';
            $bank1 = $mysqli->query($sql1);
            $sql2 = 'SELECT * FROM `bankpp` ORDER BY `id`';
            $bank2 = $mysqli->query($sql2);

            if($bank_row1 = $bank1->num_rows)$bank_res1 = $bank1->fetch_assoc();
            if($bank_row2 = $bank2->num_rows)$bank_res2 = $bank2->fetch_assoc();

            if((($bank_res1["receiver"]!='' && $bank_res1["receiver"]!=' ')||($bank_res2["paypalemail"]!='' && $bank_res2["paypalemail"]!=' ')))
            {
                echo '
               <li style="width: 49%; max-width:340px;height: 150px;">

                <input type="radio" class="inplayment" name="typeplayment" id="typeplayment2"/>
                <label class="typeplayment" for="typeplayment2" onclick="$(\'.buttonsplayment\').hide();$(\'#buttonsplayment2\').show();">

                    <div style="font-size: 18px;">Онлаин
                        <div class="keyplayment">
                            <div style="background: white;padding: 6px;border-radius: 100px;"></div>
                        </div>
                    </div>
                    <div style="font-weight: 500;">Картами Visa, MasterCard, Мир</div>
                </label>

            </li>             
                ';
            }

            ?>


        </ul>
    </div>
    <div class="our-payment-sestem">
        <ul class="payment-menu">
            <li style="width: 49%; max-width:340px;height: 150px;transform: translateX(50%);">

                <label class="buttonsplayment" id="buttonsplayment1"  onclick="$('#buttonsplayment1').css('background','#39b25a');location.href='naloj.php';">
                    <div style="font-size: 18px;">Оформить заказ</div>
                </label>

                <label class="buttonsplayment" id="buttonsplayment2"  onclick="$('#buttonsplayment2').css('background','#39b25a'); document.getElementById('point5').style.display='block';
				document.getElementById('point4').style.display='none';">
                    <div style="font-size: 18px;">Оформить заказ</div>
                </label>

            </li>

        </ul>
    </div>
    <!-- End Payment Way -->
</div>
                <div id="point5" style="display:none;">
                    <!-- Start Checkbox Area -->
                    <div class="checkout-form">
                        <!-- Start Payment Way -->
                        <div class="single-checkout-box checkbox">
                            <button onclick="document.getElementById('point4').style.display='block';document.getElementById('point5').style.display='none';">Назад</button>
                        </div>
                        <div class="our-payment-sestem">
                            <h2 class="section-title-3">Через что хотите оплатить? :</h2>
                            <ul class="payment-menu">
                                <?

                                if($bank_res1["receiver"]!='' && $bank_res1["receiver"]!=' '){
                                    echo '
                                    <li style="width: 49%; max-width:200px;"><a title="Yandex Money" href="money.php"><img src="images/payment/4.jpg" alt="payment-img" style="width: 100%; border: 1px solid #32ee0f;"></a></li>
                                    ';
                                }

                                if($bank_res2["paypalemail"]!='' && $bank_res2["paypalemail"]!=' '){
                                    echo '
                                    <li style="width: 49%; max-width:200px;"><a title="PayPal" href="paypal.php"><img src="images/payment/3.jpg" alt="payment-img" style="width: 100%; border: 1px solid #32ee0f;"></a></li>
                                    ';
                                }

                                if($bank_res1["receiver"]!='' && $bank_res1["receiver"]!=' '){
                                    echo '
                                    <li style="width: 49%; max-width:200px;">
                                        <a title="картой" href="cardpay.php">
                                            <img src="images/payment/1.jpg" alt="payment-img" style="width: 100%; border: 1px solid #32ee0f;"></a></li>
                                    ';
                                }


                                /*<!--<li style="width: 49%; max-width:200px;"><a title="Yandex Money" href="money.php"><img src="images/payment/4.jpg" alt="payment-img" style="width: 100%; border: 1px solid #32ee0f;"></a></li>-->
                                <!--<li style="width: 49%; max-width:200px;"><a title="PayPal" href="paypal.php"><img src="images/payment/3.jpg" alt="payment-img" style="width: 100%; border: 1px solid #32ee0f;"></a></li>-->*/
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>



			</div>
        </div>

        <div class="col-md-4 col-lg-4">
			<div class="checkout-right-sidebar">
				<div class="puick-contact-area mt--60">
					<h2 class="section-title-3">Связаться с оператором</h2>

					<a href="tel:+7<? echo $Adres_res['tel1'];?>">+7<? echo $Adres_res['tel1'];?></a>
				</div>
				<div class="our-important-note">
					</br>
					<p class="note-desc">Пожалуйста проверьте правильность ввода контактных и других данных. В случае ошибки необходимо связаться с оператором для уточнения заказа.</p>
					<ul class="important-note">
					
						<li><a target="_blank" href="helpers.php#Договор-оферта"><i class="zmdi zmdi-caret-right-circle"></i>Договор-оферта</a></li>
						<li><a target="_blank" href="helpers.php#Контактные данные организации"><i class="zmdi zmdi-caret-right-circle"></i>Контактные данные организации</a></li>
						<li><a target="_blank" href="helpers.php#Сферы деятельности организации"><i class="zmdi zmdi-caret-right-circle"></i>Сферы деятельности организации</a></li>
						<li><a target="_blank" href="helpers.php#Политика конфиденциальности"><i class="zmdi zmdi-caret-right-circle"></i>Политика конфиденциальности</a></li>
						<li><a target="_blank" href="helpers.php#Пользовательское соглашение"><i class="zmdi zmdi-caret-right-circle"></i>Пользовательское соглашение</a></li>
						<li><a target="_blank" href="helpers.php#Способы оплаты"><i class="zmdi zmdi-caret-right-circle"></i>Способы оплаты</a></li>
						<li><a target="_blank" href="helpers.php#Описание возврата товара/услуги"><i class="zmdi zmdi-caret-right-circle"></i>Описание возврата товара/услуги</a></li>
						<li><a target="_blank" href="helpers.php#Условия доставки товара"><i class="zmdi zmdi-caret-right-circle"></i>Условия доставки товара</a></li>
						<li><a target="_blank" href="helpers.php#Описание процесса передачи данных"><i class="zmdi zmdi-caret-right-circle"></i>Описание процесса передачи данных</a></li>
					</ul>
					</br>
					</br>
					</br>
				</div>
			</div>
        </div>
    </div>
</div>
</section>
<!-- End Checkout Area -->
</main>





