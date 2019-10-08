<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";
$sqlsss = 'SELECT * FROM `group` 
	WHERE 
		`url`="'. $_GET['seach'] .'" OR `id` ='.$_POST['group_id'].' OR `url`="'.$_POST['route'].'"
	;';
	$datasss = $mysqli->query($sqlsss);
	if($rowsss = $datasss->num_rows)$ressss = $datasss->fetch_assoc();

?>
<!doctype html>
<html class="no-js" lang="ru">
<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1">
	<?
	$title2=$ressss['title'];
	$ressss['title'] = mb_substr($ressss['title'], 0, 38, 'UTF-8');?>
    <title><?echo $ressss['title']." Бионика-маркет Ставрополь край";?></title>
    <meta name="description" content="<?echo $title2." и другие полезные товары Бионика-маркет Ставрополь край";?>">

	<meta name="keywords" content="<?echo $ressss['title']." Бионика-маркет Подарок Полезно Здоровье Масажоры СПА Ставрополь Ставропольский край";?>">

	<meta name="robots" content="index, follow" />
	<meta name="yandex" content="index, follow" />
	<meta name="google" content="index, follow" />
	<meta name="googlebot" content="index, follow" />
	<meta name="slurp" content="index, follow" />
	<meta name="bingbot" content="index, follow" />

	<meta property="og:url"                content="<?echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="<?echo $ressss['title']." Бионика-маркет";?>" />
	<meta property="og:description"        content="<?echo $ressss['title']."";?>" />

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
</head>


<div id="body__overlay" onclick="close_all();" class="body__overlay"></div>

<script>
function close_all(){
	document.getElementById("body__overlay").classList.remove("is-visible");
	document.getElementById("shopping__cart").classList.remove("shopping__cart__on");
	document.getElementById("user__cart").classList.remove("user__cart__on");
	document.getElementById("tel__cart").classList.remove("tel__cart__on");
	document.getElementById("login").classList.remove("in");
	document.getElementById("login").style.display="none";


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
                                    <input placeholder="Поиск" name="seach" type="text" id="seach" aria-label="Поиск" aria-hidden="true" aria-labelledby="Поиск по сайту" value="" style="width: 100%;border-radius: 5px;background: #d7d7d7e6;border: 0px;padding: 5px;font-size: 18px; z-index:1; text-align: center;">
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
<div class="modal fade in" id="login" tabindex="-1" role="dialog" style="z-index: 99999; display: none;">
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

<?
$_POST['group_id'];
$_POST['route'];
$_GET['seach'];

$sqlid = 'SELECT MAX(sum_p) as maxid FROM `tovar`';
$datamax = $mysqli->query($sqlid);
$resid = $datamax->fetch_assoc();
$id_int = $resid['maxid']+1000;

echo '<script>
		var entergroup_id ="'.$_POST['group_id'].'";
		var enterroute ="'.$_POST['route'].'";
		var enterseach ="'.$_GET['seach'].'";
		var rangemin =0;
		var rangemax ='.$id_int.';
		var basikrangemin =0;
		var basikrangemax ='.$id_int.';
		var setcolor;
		var razm;
		var sortirovka;
	</script>';
?>

<main style="background:#fff;    padding-top: 40px;">
<h1 style="display:none;"><?echo $ressss['title']." Бионика-маркет Ставрополь край";?></h1>
<h2 style="display:none;"><?echo $ressss['title']." Бионика-маркет Ставрополь край";?></h2>

        <!-- Start Our ShopSide Area -->
        <section class="htc__shop__sidebar bg__white ptb--10">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <div class="htc__shop__left__sidebar">
                            <!-- Start Range -->
                            <div class="htc-grid-range" style="margin-bottom: 15px; padding-bottom: 10px;">
                                <h4 class="section-title-4">Фильтр по цене</h4>
                                <div class="content-shopby">
                                    <div class="price_filter s-filter clear">
                                        <form>
                                            <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
													<div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 20.4082%; width: 59.1837%;">
													</div>
													<span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 20.4082%;">
													</span>
													<span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 79.5918%;">
													</span>
											</div>
<!----------------------------------------------------------------------->
                                            <div class="slider__range--output">
                                                <div class="price__output--wrap">
                                                    <div class="price--output">
                                                        <span></span><input type="text" id="amount" readonly>
                                                    </div>
                                                    <div class="price--filter">
                                                        <a onclick="seachajax1();" style="cursor: pointer;" >Применить</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Range -->
                            <!-- Start Product Cat -->
                            <div class="htc__shop__cat" style="margin-bottom:15px; padding-bottom: 10px;">
                                <h4 class="section-title-4" style="margin-bottom: 10px;">По категориям <u><a onclick="entergroup_id=0;seachajax1();" style="font-size:12px; text-transform:uppercase;">Сбросить</a></u></h4>
                                <ul class="sidebar__list" id="groplist">
ТУТ ГРУППЫ
                                </ul>
                            </div>
                            <!-- End Product Cat -->
                            <!-- Start Color Cat -->
                            <div class="htc__shop__cat" style="margin-bottom:15px; padding-bottom: 10px;">
                                <h4 class="section-title-4" style="margin-bottom: 10px;">Цвета <u style="font-size:12px;"><a onclick='setcolor="0";seachajax1();'>Сбросить</a></u></h4>
                                <!--<ul class="sidebar__list" style = "display: inline-flex;">
									
									<li id="red-1" style="margin: 2px;">
												<div
												onclick='setcolor="red";seachajax1();'												
												style="
												background: #ff0000;float: left;
												width: 20px;
												height: 20px;
												border-radius: 99px;												
												"></div>
									</li>									
									<li id="red-1" style="margin: 2px;">
												<div
												onclick='setcolor="red";seachajax1();'												
												style="
												background: #ff0000;float: left;
												width: 20px;
												height: 20px;
												border-radius: 99px;												
												"></div>
									</li>
																
								
<!--<li id="green-1" class="green"><a onclick='setcolor="green";seachajax1();'><i class="zmdi zmdi-circle"></i>Зеленый</a></li>-->

                               <!-- </ul>-->
<style>
.color_set{
	float: left;
	width: 20px;
	height: 20px;
	border-radius: 99px;	
	margin: 2px;	
	border: 1px solid #bbbbbb;
}							   
</style>
							   <div style="width:100%; display: inline-block;" id="all_color_fetch">
							   </div>
                            </div>
                            <!-- End Color Cat -->
                            <!-- Start Size Cat -->
                            <div class="htc__shop__cat" style="margin-bottom:15px; padding-bottom: 10px;">
                                <h4 class="section-title-4" style="margin-bottom: 10px;">Размер <u style="font-size:12px;"><a onclick='razm="0";seachajax1();'>Сбросить</a></u></h4>
                                <!--ul class="sidebar__list"-->
								<ul class="htc__tags" id="all_razm_fetch">

									<li id="razmxs" style="display:none;"><a onclick='razm="xs";seachajax1();'  style="text-transform: uppercase;">xs </a></li>
                                </ul>
                            </div>
                            <!-- End Size Cat -->

                        </div>
                    </div>
                    <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12 smt-30">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="producy__view__container">
                                    <!-- Start Short Form -->
                                    <div class="product__list__option">
                                        <div class="order-single-btn">
                                            <select onclick="seachajax1();" class="select-color selectpicker" id="sortirovka">
                                              <option value="2" checked>По умолчанию</option>
                                              <option value="2" >Новые</option>
											  <option value="1">Старые</option>
                                              <option value="4">Дешевле->Дороже</option>
                                              <option value="3">Дороже->Дешевле</option>
                                            </select>
                                        </div>
                                        <div class="shp__pro__show">
                                            <span>
											<a onclick="sliderrangeclear();seachajax1();">
											Отменить все фильтры
											</a></span>
                                        </div>
                                    </div>
                                    <!-- End Short Form -->
                                    <!-- Start List And Grid View -->
                                    <ul class="view__mode" role="tablist">
                                        <li role="presentation" class="grid-view active"><a href="#grid-view" id="grid-view-ok" role="tab" data-toggle="tab"><i class="zmdi zmdi-grid"></i></a></li>
                                        <li role="presentation" class="list-view"><a href="#list-view" role="tab" data-toggle="tab"><i class="zmdi zmdi-view-list"></i></a></li>
                                    </ul>
                                    <!-- End List And Grid View -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="shop__grid__view__wrap another-product-style" id="seachajax">
<!---------------------------------------------------------------------------------------------------->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Our ShopSide Area -->
</main>
<script>
window.onload=function go(){seachajax1();}

function seachajax1(){

				sortirovka = $('#sortirovka').val();
				var pricemin = $("#slider-range").slider("values", 0);
				var pricemax = $("#slider-range").slider("values", 1);
				var sms={group_id:entergroup_id, seach:enterseach, route:enterroute, pricemin:pricemin, pricemax:pricemax, setcolor:setcolor, razm:razm, sortirovka:sortirovka};
				var url="seachajax.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{

							$("#seachajax").html( result );
							$("#groplist").html($("#grop").html());
							$("#all_razm_fetch").html($("#all_razm").html());
							$("#all_color_fetch").html($("#all_color").html());

							displaycolor();

							document.getElementById('grid-view-ok').click();
						});
}

  function sliderrangeclear(){
	$("#slider-range").slider({
      range: true,
      min: rangemin,
      max: rangemax,
      values: [rangemin, rangemax],
      slide: function(event, ui) {
          $("#amount").val("" + ui.values[0] + "р. - " + ui.values[1] + "р.");
      }
  });
  $("#amount").val("" + $("#slider-range").slider("values", 0) + "р. - " + $("#slider-range").slider("values", 1) + "р." );
  	entergroup_id='0';
	enterseach='';
	enterroute='';
	pricemin='10';
	pricemax='20000';
	setcolor='0';
	razm='0';
	document.getElementById('sortirovka').value='2';
  }

</script>










