<!doctype html>
<html class="no-js" lang="ru">
<head>
<?

$basik = 'SELECT * FROM `basik` ORDER BY `id`';
$data_basik = $mysqli->query($basik);

if($basik_row = $data_basik->num_rows)$basik_res = $data_basik->fetch_assoc();
							
?>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1">
    <title><?echo $basik_res['title'];?></title>
    <meta name="description" content="<?echo $basik_res['description'];?>">
	
	<meta name="keywords" content="<?echo $basik_res['keywords'];?>">
	<!--
	<meta name="robots" content="index, follow" />
	<meta name="yandex" content="index, follow" />
	<meta name="google" content="index, follow" />
	<meta name="googlebot" content="index, follow" />
	<meta name="slurp" content="index, follow" />
	<meta name="bingbot" content="index, follow" />
	-->
	<meta name="author" content="<?echo $basik_res['author'];?>" />
	<meta name="copyright" lang="ru" content="<?echo $basik_res['copyright'];?>" />
	
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
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
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
	main{margin-top:72px;}
	</style>
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
					
					</div>
                        <!-- End MAinmenu Ares -->
						
                        
                </div>
            </div>
            <!-- End Mainmenu Area -->
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

