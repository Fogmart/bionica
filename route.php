<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";

$sql = 'SELECT * FROM `tovar` 
	WHERE 
		`url` LIKE "%'. $_GET['route'] .'%" 
	;';
	$data = $mysqli->query($sql);
	if($row = $data->num_rows)$res = $data->fetch_assoc();


	//echo $res['laik'];

	//для соц сетей
	for($i=1;$i<=15;$i++){
		if(strlen($res['photo_'.$i]))
		{
			$img=$res['photo_'.$i];
			break;
		}
	}

	$res['prosmo']=(int)$res['prosmo']+1;


	//$_SESSION['idtov']=$res['id'];


	$mysqli->query("
							UPDATE `tovar`
							SET `prosmo` = '".$res['prosmo']."'
							WHERE `id`=".$res['id'].";
							");


?>

<!doctype html>
<html class="no-js" lang="ru">
<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1">
	<?$res['name1'] = mb_substr($res['name'], 0, 38, 'UTF-8');?>
    <title><?echo $res['name1']." Бионика-маркет Ставрополь край";?></title>
    <meta name="description" content="<? echo mb_substr($res['seo'], 0, 149, 'UTF-8'); ?>">

	<meta name="keywords" content="<? echo $res['seo']; ?>">

	<meta name="robots" content="index, follow" />
	<meta name="yandex" content="index, follow" />
	<meta name="google" content="index, follow" />
	<meta name="googlebot" content="index, follow" />
	<meta name="slurp" content="index, follow" />
	<meta name="bingbot" content="index, follow" />

	<meta property="og:url"                content="<?echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="<?echo $res['name1']." Бионика-маркет";?>" />
	<meta property="og:description"        content="<?echo $res['name1']."";?>" />
	<meta property="og:image"              content="<?echo $img."";?>" />

	<!--
	<meta name="author" content="<?//echo $basik_res['author'];?>" />
	<meta name="copyright" lang="ru" content="<?//echo $basik_res['copyright'];?>" />
	-->
	<!--<meta name="Document-state" content ="Dynamic"> -->
	<!--Dynamic - динамическая страница, которую нужно периодически пере индексировать-->

	<!--<meta http-equiv="Pragma" content ="no-cache">-->
	<!--запрещает(no-cache) кеширование страницы браузерами-->

	<!-- Дата последнего обновления содержимого страницы-->
	<!--<meta name="revisit" content="10">-->

	<meta name="language" content="ru">
	<!--<meta http-equiv="Content-Language" content="ru">-->



	<!-- Название веб-приложения-->
<meta name="apple-mobile-web-app-title" content="<?echo $basik_res['title'];?>">

<!-- Полноэкранный режим (минимизация верхнего бара браузера)-->
<meta name="apple-mobile-web-app-capable" content="yes">

<!-- Устанавливает стиль строки состояния для веб-приложения-->
<meta name="apple-mobile-web-app-status-bar-style" content="write">

<!-- Управление обнаружением телефонных номеров-->
<meta name="format-detection" content="telephone=no">

<!--ANDROID -->
<!--Название веб-приложения-->
<meta name="application-name" content="<?echo $basik_res['title'];?>">

<!--Полноэкранный режим (минимизация верхнего бара браузера)-->
<meta name="mobile-web-app-capable" content="yes">


<!-- Иконка для веб-приложения, отображаемая в закладках и на рабочем столе-->
<link rel="icon" sizes="192x192" href="images/touch/chrome-touch-icon-192x192.png">


	<!-- Тег title должен быть отличным от тегов description и h1 -->

    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="theme-color" content="#ffffff"/>

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="../images/icon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

	<link rel="apple-touch-icon" sizes="76x76" href="/icons/apple-touch-icon-76x76.png">

	<link rel="apple-touch-icon" sizes="120x120" href="/icons/apple-touch-icon-120x120.png">

	<link rel="apple-touch-icon" sizes="152x152" href="/icons/apple-touch-icon-152x152.png">

	<link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-touch-icon-180x180.png">

	<!-- Изображение, которое отображается при открытии закладки с рабочего стола-->
	<link rel="apple-touch-startup-image" href="images/touch/startup.png">

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">

	<!--JS IN FOOTER-->

	<style>
	main{margin-top:72px; background:#fff;}
	body{cursor: pointer;}
	</style>

    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

</head>


<div id="body__overlay" onclick="close_all();" class="body__overlay"></div>

<script>
function close_all(){
	document.getElementById("body__overlay").classList.remove("is-visible");
	document.getElementById("shopping__cart").classList.remove("shopping__cart__on");
	document.getElementById("user__cart").classList.remove("user__cart__on");
	document.getElementById("tel__cart").classList.remove("tel__cart__on");
	document.getElementsByTagName("body")[0].classList.remove("search__box__show__hide");
	document.getElementById("login").classList.remove("in");
	document.getElementById("login").style.display="none";
	document.getElementById("video").classList.remove("in");
	document.getElementById("video").style.display="none";

	onscroll();

}
function open_dark(){
	document.getElementById("body__overlay").classList.add("is-visible");
	offscroll();
}
function login(){
	document.getElementById("body__overlay").classList.add("is-visible");
	document.getElementById("login").style.display="block";
	document.getElementById("login").classList.add("in");
	offscroll();
	auth2();
	function auth2(){
				var sms={user:"123"};
				var url="auth2.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							$("#auth2").html( result );
						});
			}
}
function callout(){
	document.getElementById("body__overlay").classList.add("is-visible");
	document.getElementById("login").style.display="block";
	document.getElementById("login").classList.add("in");
	offscroll();
	auth3();
	function auth3(){
				var sms={user:"123"};
				var url="/callout.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							$("#auth2").html( result );
						});
			}
}
</script>
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->

<!-- Start Header Style -->
        <header id="header" class="htc-header header--3 bg__white">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar1" class="mainmenu__area sticky__header scroll-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                            <div class="logo">
                                <a href="/">
                                    <img src="images/logo/logo.gif" style="height:100%;" alt="logo">
                                </a>
                            </div>
                        </div>
                        <!-- Start MAinmenu Ares -->
                        <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                            <nav class="mainmenu__nav hidden-xs hidden-sm">
                                <ul class="main__menu">
                                    <li class="drop"><a href="/">Бионика-маркет</a>
                                    </li>

                                    <li class="drop"><a>Все категории</a>
                                        <ul class="dropdown mega_dropdown">
                                            <? require "menu.php"; ?>
                                        </ul>
                                    </li>

									<li class="drop"><a href="company.php">Помощь</a>
                                    </li>
								</ul>
                            </nav>
                        </div>

						<div class="col-md-2 col-sm-4 col-xs-3">
                            <ul class="menu-extra">
                                <li class="cart__menu" onclick='document.getElementsByTagName("body")[0].classList.add("search__box__show__hide");open_dark();'><span class="ti-search"></span></li>
								<li class="cart__menu" onclick='tel();document.getElementById("tel__cart").classList.add("tel__cart__on");open_dark();'><span class="ti-headphone-alt"></span></li>

								<li class="cart__menu" onclick='auth();document.getElementById("user__cart").classList.add("user__cart__on");open_dark();'><span class="ti-user"></span></li>
								<li class="cart__menu" onclick='shopping();document.getElementById("shopping__cart").classList.add("shopping__cart__on");open_dark();'><span class="ti-shopping-cart"></span></li>
                            </ul>
                        </div>
						<div class="col-md-3 col-lg-3 col-sm-4 col-xs-4 hidden-xs hidden-sm" style="padding:0px; margin-left:60px;">
                            <div class="logo">
                                <a onclick="close_all(); callout();"><font style="vertical-align: inherit;">
                                    <img src="images/logo/call2.png" style="height:60%;" alt="logo">
                                </a>
								<script>

								</script>
                            </div>
                        </div>

					</div>
                        <!-- End MAinmenu Ares -->


                </div>
            </div>
            <!-- End Mainmenu Area -->
						<section class="htc__shop__sidebar bg__white ptb--10">
            <div class="container">
			<div class="htc-header header--3 bg__white row hidden-xs hidden-sm" style="z-index:1; position: fixed; top: 80px; padding:0px; width:100%">
						<div class="col-md-8 col-lg-8 col-sm-6 col-xs-6" style="text-align: right; width:83%; animation: backcity 8s ease infinite; animation-direction: alternate-reverse;">
						<form method="get" action="index.php" >
                                    <input placeholder="Поиск" autocomplete="off" name="seach" type="text" id="seach" aria-label="Поиск" aria-hidden="true" aria-labelledby="Поиск по сайту" value="" style="width: 100%;border-radius: 5px;background: #d7d7d7e6;border: 0px;padding: 5px;font-size: 18px; z-index:1; text-align: center;">
                                    <label style="display:none;" for="seach"><button type="submit" aria-label="Поиск" aria-hidden="true" aria-labelledby="Поиск по сайту" value="Поиск"></button></label>
                        </form>
						</div>
			</div>
			</div>
			</section>
        </header>
<!-- End Header Style -->

<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->

<!--
<div class="" style="padding-right:15px;">
    <ul class="menu-extra">

        <li class="cart__menu" onclick='document.getElementsByTagName("body")[0].classList.add("search__box__show__hide");open_dark();'><span class="ti-search"></span></li>
		<li class="cart__menu" onclick='tel();document.getElementById("tel__cart").classList.add("tel__cart__on");open_dark();'><span class="ti-headphone-alt"></span></li>

		<li class="cart__menu" onclick='auth();document.getElementById("user__cart").classList.add("user__cart__on");open_dark();'><span class="ti-user"></span></li>
		<li class="cart__menu" onclick='shopping();document.getElementById("shopping__cart").classList.add("shopping__cart__on");open_dark();'><span class="ti-shopping-cart"></span></li>
	</ul>
</div>

-->

<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->

<div id="shopping__cart" class="shopping__cart">
    <div class="shopping__cart__inner">
		<div id="shopping">
        <script>
			function shopping(){
				var sms={min:"1"};
				var url="shopping.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							$("#shopping").html( result );
						});
			}
		</script>
		</div>
    </div>
</div>


<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->

<div id="user__cart" class="user__cart">
    <div class="user__cart__inner">
	<div id="auth">
        <script>
			function auth(){
				var sms={user:"123"};
				var url="auth.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							$("#auth").html( result );
						});
			}
		</script>
	</div>
    </div>
</div>


<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->

<div id="tel__cart" class="tel__cart">
    <div class="tel__cart__inner">
		<div id="tel">
        <script>
			function tel(){
				var sms={user:"123"};
				var url="tel.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							$("#tel").html( result );
						});
			}
		</script>

		</div>


                </div>
</div>

<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->

<div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form method="get" action="index.php">
                                    <input placeholder="Поиск" name="seach" type="text" id="seach" aria-label="Поиск" aria-hidden="true" aria-labelledby="Поиск по сайту" value="">
                                    <label for="seach"><button type="submit" aria-label="Поиск" aria-hidden="true" aria-labelledby="Поиск по сайту" value="Поиск"></button></label>
                                </form>
                                <div class="search__close__btn" onclick='close_all();'>
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------->
<div class="modal fade" id="login" tabindex="-1" role="dialog" style="z-index: 99999; display: none;">
            <div class="modal-dialog modal__container" role="document">
				<div id="auth2">
				</div>

            </div><!-- .modal-dialog -->
</div>








<script type="text/javascript">
function offscroll(){
	document.getElementsByTagName("body")[0].style.overflow="hidden";
	//document.getElementsByTagName("body")[0].style.position="fixed";
	//document.getElementsByTagName("body")[0].style.width = "100%";
}
function onscroll(){
	document.getElementsByTagName("body")[0].style.overflow="";
	//document.getElementsByTagName("body")[0].style.position="";
	//document.getElementsByTagName("body")[0].style.width = "";
}

</script>



    <link rel="stylesheet" href="css/reset.min.css">
	<link rel="stylesheet" href="css/style.css">



<main style="padding-top: 40px;">

<?
$sql1 = 'SELECT * FROM `group` 
	WHERE 
		`id`= '.$res['group_id'].'
	;';
	$data1 = $mysqli->query($sql1);
	if($row1 = $data1->num_rows)$res1 = $data1->fetch_assoc();

$sql2 = 'SELECT * FROM `group` 
	WHERE 
		`id`= '.$res['2group_id'].'
	;';
	$data2 = $mysqli->query($sql2);
	if($row2 = $data2->num_rows)$res2 = $data2->fetch_assoc();

?>

<style>
.breadcrumb>li+li:before {
    content: ">";
}
</style>
<nav aria-label="breadcrumb" style="text-align: center;">
  <ol class="breadcrumb" style="background: #fff;">
    <li class="breadcrumb-item"><a href="/">Бионика-маркет</a></li>
    <li class="breadcrumb-item"><a href="<? echo $res1['url'];?>"><? echo $res1['title'];?></a></li>
	<li class="breadcrumb-item"><a href="<? echo $res2['url'];?>"><? echo $res2['title'];?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><u><? echo $res['name'];?></u></li>
  </ol>
</nav>


        <!-- Start Product Details -->
        <section class="htc__product__details pt--0 pb--0 bg__white">
            <div class="container">
                <div class="scroll-active">
                    <div class="row">
                        <div class="col-md-7 col-lg-7 col-sm-5 col-xs-12">
                            <div class="product__details__container product-details-5">
                                <div class="scroll-single-product mb--0" style="display:block; margin-left: auto; margin-right: auto;">
<!---->


                                    <div class="w" style="width: 90%;height: 61vmin;" >
										<div class="ts">
<!--                                            <div style=" height: calc(100% - var(--barH));" onclick="tst()"></div>-->
										<?
										$w_w=0;
										$w_nex=0;
										$w_kol=0;
											for($i=1; $i<16; $i++)
											if( isset($res['photo_'.$i])  && $res['photo_'.$i]!="" && $res['photo_'.$i]!=" ")
											{
												$w_kol++;
											}

										//$w_ww=100/$w_kol;
										$w_ww=100/$w_kol;
										if($w_ww>20)$w_ww=20;

										//$w_nex=95/$w_kol;
										$w_nex=80/$w_kol;

										//if($w_nex>15)$w_nex=15;




											for($i=1; $i<16; $i++)
											if( isset($res['photo_'.$i])  && $res['photo_'.$i]!="" && $res['photo_'.$i]!=" ")
											{
												if($i==1){$chch='checked="checked"';}
												else {$chch="";}
												echo '<input  type="radio" id="photo_'.$i.'" name="ts" '.$chch.'/>
												<label class="t" for="photo_'.$i.'" style="--l:'.$w_w.'%; --w: '.$w_ww.'%; background: url('.$res['photo_'.$i].') center center / contain no-repeat;">
												<img   class="my-foto" style="opacity: 0;" data-large="'.$res['photo_'.$i].'" src="'.$res['photo_'.$i].'"/>
												</label>';

											$w_w=$w_w+$w_nex;
											}

											if( isset($res['video']) && $res['video']!="" && $res['video']!=" ")
											{
												echo '<input type="radio" id="videov" name="ts"/>';
												echo '<label class="t" title="ВИДЕО" style="--l:'.$w_w.'%; --w: '.$w_ww.'%; background: url(images/video/6-luchshix-programm-dlya-montazha-video_1508095336-1140x570.jpg) center center / contain no-repeat;" >
												
												<img onclick="video();open_dark();" style="opacity: 0;" src="images/video/6-luchshix-programm-dlya-montazha-video_1508095336-1140x570.jpg"/></label>';
											}

										?>
										</div>
									</div>


									<div class="modal fade" id="video" tabindex="-1" role="dialog" style="z-index: 99999; display: none; overflow: auto;">
												<div class="modal-dialog modal__container" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button onclick="videoexit();close_all();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
														</div>
														<div class="modal-body">
															<div class="modal-product" style="padding-top:0px; overflow-y:auto;">

																<iframe id="videoi" src="<? echo $res['video'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

															</div><!-- .modal-product -->
														</div><!-- .modal-body -->
													</div><!-- .modal-content -->

												</div><!-- .modal-dialog -->

									</div>
									<script>
									function videoexit(){
									a=document.getElementById("videoi").src;
									document.getElementById("videoi").src=a;
									}
									function video(){
										document.getElementById("body__overlay").classList.add("is-visible");
										document.getElementById("video").style.display="block";
										document.getElementById("video").classList.add("in");

										x=document.getElementById("video").clientWidth;
										p=15;
										y=(x/1.9)-p-p-371;

										document.getElementById("videoi").height=y;
										document.getElementById("videoi").width=x-p-p;
										offscroll();

									}
									function videosize(){

									}
									</script>


<!---->
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-active col-md-5 col-lg-5 col-sm-7 col-xs-12 xmt-30" style="margin-top: 20px;">
                            <div class="htc__product__details__inner ">
                                <div class="pro__detl__title">
                                    <h1 style="padding-top:10px;"><? echo $res['name']; ?></h1>

                                </div>
                                <div class="pro__dtl__rating" style="    margin-top: 2px;">
                                    <span class="rat__qun">Артикул: <? echo $res['art']; ?>
									<? if($res['dost']!='' && $res['dost']!='0' && $res['dost']!=' '){ echo '<p></p>В наличии: '.$res['dost'].'</span>';}
										else {
											echo '<p></p><font style="color: #FF5B1F;">
											Приносим свои извинения, но товара пока что нет в наличии.</font>';
											if($res['zakaz']!="no"){echo '<font style="color: #FF5B1F;"> Его можно заказать =)</font>';}
											echo '</span>';

											$nokol=9999;
											}
									?>
                                </div>
                                <div class="pro__details">
                                    <p><? echo $res['comment']; ?></p>
                                </div>
                                <ul class="pro__dtl__prize" style="margin-bottom: 10px; margin-top: 10px; padding: 2px;">
                                    <li class="old__prize"><?    echo $res['rrc']; ?> р.</li>
                                    <li><? echo number_format((float)$res['sum_p'], 2, '.', ''); ?>р.</li>
                                </ul>
								<?
								if($nokol==9999)
								{
									if($res['zakaz']!="no"){echo '
									<ul class="pro__dtl__btn">

                                   <li class="buy__now__btn"><a onclick="shopzak();">Заказать</a></li>
								   
									</ul>';}


									goto noshopp; //запрет на покупку
								}

								
                                if($res['color']!=null && $res['color']!="" && $res['color']!=" ")
                                {
                                    echo '<div class="pro__dtl__color"> <h2 class="title__5">Цвет</h2> <ul class="pro__choose__color">';
									$i=0;
                                    foreach ( explode(",", $res['color']) as $color)
                                    {
										$i++;
                                        if($color!="" && $color!=" "){
											$x="setcolor();document.getElementById('color".$i."').classList.add('zmdi-star-circle');col='".$color."';";
											echo '<li><a onclick="'.$x.'"><i id="color'.$i.'" style="color: '.$color.';" class="zmdi zmdi-circle"></i></a></li>';
                                        }
                                    }
                                    echo '</ul></div>';
                                }
                                else
                                {
                                    echo '<div class="pro__dtl__color"> <h2 class="title__5"></h2> <ul class="pro__choose__color"></ul></div>';
                                }
								

                                if($res['razm']!=null && $res['razm']!="" && $res['razm']!=" ")
                                {
                                    echo '<div class="pro__dtl__size" style="margin-bottom: 10px;"> <h2 class="title__5" style="margin-bottom: 5px;">Размер</h2> <ul class="pro__choose__size">';
                                    foreach ( explode(",", $res['razm']) as $razm)
                                    {
                                        if($razm!="" && $razm!=" "){
                                            $x="setrazm();document.getElementById('".$razm."').style.border='1px solid';razm='".$razm."';";
                                            echo '<li><a id="'.$razm.'" class="setrazm" onclick="'.$x.'">'.$razm.'</a></li>';
                                        }
                                    }
                                    echo '</ul></div>';
                                }
                                else
                                {
                                    echo '<div class="pro__dtl__size" style="margin-bottom: 10px;"> <h2 class="title__5" style="margin-bottom: 5px;"></h2> <ul class="pro__choose__size"></ul></div>';
                                }

								?>
								<div class="product-action-wrap" style="    margin-bottom: 5px;">
                                    <div class="prodict-statas"><span>Количество:</span></div>
                                    <div class="product-quantity" style="width: 37%;">
                                        <form id='myform' method='POST' action=''>
                                            <div class="product-quantity">


                                                    <input class="" style="width:100%; text-align: center;" type="number" max="<?echo $res['dost'];?>" min="0" id="kol" name="" value="1">


                                            </div>
                                        </form>
                                    </div>

                                </div>

								<div class="product-action-wrap" style="    margin-bottom: 5px;">
                                    <div class="prodict-statas">
										<span>
											<table style="font-size: 15px;">
										<?
										$skidkacheck="".$res['skidka1'].$res['skidka2'].$res['skidka3'].$res['skidka2']."";
										if( $skidkacheck!="" )
										{
											echo '
												<tr>
													<td style="border:1px dotted #d5d5d5; padding:2px; text-transform:none;">
													При покупке
													</td>
													<td style="border:1px dotted #d5d5d5; padding:2px; text-transform:none;">
													Цена за шт.
													</td>
												</tr>											
											';
										}
										for($ff=1; $ff<=4; $ff++)
										{
											if($res['skidka'.$ff]!="")
											echo '
												<tr style="color:#ff5b1f;">
													<td style="border:1px dotted #d5d5d5; padding:2px; text-transform:none;">
													'.$res['skidkakol'.$ff].' <font style="font-size: 10px;">шт.</font>
													</td>
													<td style="border:1px dotted #d5d5d5; padding:2px; text-transform:none;">
													'.(($res['sum_p'])-(($res['skidka'.$ff])*($res['sum_p']))).' р.
													</td>
												</tr>											
											';
										}
										?>
											</table>
										</span>
									</div>
                                </div>

                                <ul class="pro__dtl__btn">
                                    <li class="buy__now__btn"><a onclick="shopadd(); location.href='/checkout.php';">Купить сейчас</a></li>
                                    <li><a onclick="laik();"><span style="line-height: 40px;"  class="ti-heart"></span></a></li>




                                    <li><a onclick="shopadd();"><span style="line-height: 40px;" class="ti-shopping-cart"></span></a></li>


                                </ul>
								<?
								noshopp:  //////// goto переход если нет товара
								?>
                                <div class="pro__social__share" style="margin-top: 10px;">
                                    <h2>Поделиться :</h2>
                                    <ul class="pro__soaial__link">
									<?
									if (isset($_SERVER['HTTPS']))
										$scheme = $_SERVER['HTTPS'];
									else
										$scheme = '';
									if (($scheme) && ($scheme != 'off')) $scheme = 'https';
									else $scheme = 'http';

									?>
									<?php $the_permalink=$scheme.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; // — на адрес страницы, которую нужно зашарить,?>
									<?php $the_title=$res['name'];  //— замените на заголовок страницы, которой вы делитесь в соцсети,?>
									<?php $bloginfo="Бионика-маркет"; // — замените на название сайта.?>

                                        <li><a target="_blank" href="https://twitter.com/share?url=<?php echo $the_permalink; ?>&amp;text=<?php echo $the_title; ?>&amp;hashtags=my_hashtag">
										<i class="zmdi zmdi-twitter"></i></a></li>
                                        <!--https://www.facebook.com/sharer.php?src=sp&u=&title=&description=&utm_source=share2-->
										<li><a target="_blank" href="https://www.facebook.com/sharer.php?src=sp&u=<?php echo $the_permalink; ?>&title=<?php echo $the_title." ".$bloginfo;?>&description=<?php echo $the_title." ".$bloginfo;?>&utm_source=share2">
										<i class="zmdi zmdi-facebook"></i></a></li>
										<li><a target="_blank" href="https://vk.com/share.php?url=<?php echo $the_permalink; ?>&title=<?echo $the_title." ".$bloginfo;?>&image=<?echo $img;?>">
										<i class="zmdi zmdi-vk"></i></a></li>
										<li><a target="_blank" href="https://connect.ok.ru/offer?url=<?php echo $the_permalink; ?>&title=<?php echo $the_title; ?>&imageUrl=<?echo $img;?>">
										<i class="zmdi zmdi-odnoklassniki"></i></a></li>

                                    </ul>
                                </div>
								<? if($res['laik']>=1){
								echo '
								<div class="pro__social__share" style="margin-top: 10px;">
									<h2>Понравилось :</h2>
									<ul class="pro__soaial__link">
									 <li>
										<a>'.$res['laik'].'</a>
									 </li>
									</ul>
								</div>';
								}
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Details -->
		<section style="margin: 40px;">
		</section>
        <!-- Start Product tab -->
        <section class="htc__product__details__tab bg__white pb--120">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <ul class="product__deatils__tab mb--60" role="tablist" id="ttt" onclick='$("html, body").animate({ scrollTop: $("#ttt").offset().top }, 1000);'>
                            <li role="presentation" class="active">
                                <a href="#description" role="tab" data-toggle="tab">Описание</a>
                            </li>
                            <li role="presentation">
                                <a href="#reviews" role="tab" data-toggle="tab">Отзывы</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="product__details__tab__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="product__tab__content fade in active">
                                <div class="product__description__wrap">
                                    <div class="product__desc">
                                        <h2 class="title__6">Описание</h2>
                                        <p><? echo $res['text']; ?></p>
                                    </div>
                                    <div class="pro__feature">
                                        <h2 class="title__6">Кратко</h2>
                                        <ul class="feature__list">
                                        <? $sss='<li><a><i class="zmdi zmdi-play-circle"></i>'; $sss2='</a></li>';

										if( isset($res['width']) && isset($res['height']) && isset($res['length']) )
										if( $res['width']!='' && $res['height']!='' && $res['length']!='' )
										if( $res['width']!=' ' && $res['height']!=' ' && $res['length']!=' ' )
										{
											echo $sss."Размеры: ".$res['width']."см. х".$res['height']."см. х".$res['length']."см. ".$sss2;
										}
										if( isset($res['massa']) )
										{
											if($res['massa']!='')
											if($res['massa']!=' ')echo $sss."Вес (объем): ".$res['massa']."".$sss2;
										}
										if( isset($res['firma']) )
										{
											if($res['firma']!='')
											if($res['firma']!=' ')echo $sss."Производитель: ".$res['firma']."".$sss2;
										}
										?>
										</ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
							<script>var idtov='<?echo $res['id'];?>';</script>
                            <div role="tabpanel" id="reviews" class="product__tab__content fade">

								<?include "comment.php";?>

                            </div>
                            <!-- End Single Content -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product tab -->
</main>

<script>
function laik(){
				var sms={id:"<?echo $res['id'];?>"};
				var url="laik.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							alert("Мы очень ценим ваше мнение)");
							//$("#laik").html( result );
						});
			}
</script>
<script>
razm='';
col='';

function shopadd(){

				var kolvos = $('#kol').val();
				var sms={art:"<?echo $res['art'];?>", kolvo:kolvos , colors:col ,razms:razm };
				var url="shopadd.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							//alert("Добавлено");
							shopping();document.getElementById("shopping__cart").classList.add("shopping__cart__on");open_dark();
							//$("#shopadd").html( result );
						});
			}
function shopzak(){

				var kolvos = 1;
				var zakaz = 1;
				var sms={art:"<?echo $res['art'];?>", kolvo:kolvos , colors:col ,razms:razm ,zakaz:zakaz};
				var url="shopadd.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							//alert("Добавлено");
							shopping();document.getElementById("shopping__cart").classList.add("shopping__cart__on");open_dark();
							//$("#shopadd").html( result );
						});
			}
</script>
<script>
function setcolor(){
	if(document.getElementById('color1'))document.getElementById('color1').classList.remove('zmdi-star-circle');
	if(document.getElementById('color2'))document.getElementById('color2').classList.remove('zmdi-star-circle');
	if(document.getElementById('color3'))document.getElementById('color3').classList.remove('zmdi-star-circle');
	if(document.getElementById('color4'))document.getElementById('color4').classList.remove('zmdi-star-circle');
	if(document.getElementById('color5'))document.getElementById('color5').classList.remove('zmdi-star-circle');
	if(document.getElementById('color6'))document.getElementById('color6').classList.remove('zmdi-star-circle');
	}
</script>
<script>
function setrazm(){
var element = document.getElementsByClassName('setrazm');
    for(i=0; i<element.length; i++)
    {
        element[i].style="";
    }
}

// $(function () {
//     $(".t:first").unbind("click").click(tst)
// })
// function tst() {
// console.log(123)
//
// }

</script>

<script  src="js/index.js"></script>
