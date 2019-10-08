<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; ?>


							<?
				$sql = 'SELECT * FROM `adres` ORDER BY `id`';
							$Adres = $mysqli->query($sql);
							if($Adres_row = $Adres->num_rows)$Adres_res = $Adres->fetch_assoc();

				?>
	<footer class="htc__foooter__area gray-bg" style="/*position: sticky; bottom: 0px;display: block;z-index: -9999999;*/">
            <div class="container">
                <div class="row">
                    <div class="footer__container clearfix">
                         <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="ft__widget">
                                <div class="ft__logo">
                                    <a>
                                        <img src="images/logo/backend.gif" alt="footer logo">
                                    </a>
                                </div>
                                <div class="footer-address">
                                    <ul>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-pin"></i>
                                            </div>
                                            <div class="address-text">
                                                <p><?echo $Adres_res['full_adres'];?></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-email"></i>
                                            </div>
                                            <div class="address-text">
                                                <a href="mailto:<? echo $Adres_res['email'];?>"><? echo $Adres_res['email'];?></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-phone-in-talk"></i>
                                            </div>
                                            <div class="address-text">
                                                <p><a href="tel:+7<?echo $Adres_res['tel1']?>">+7<?echo $Adres_res['tel1']?></a></p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="social__icon">
                                    <!---<li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>--->
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->
                    </div>
                </div>

                <!-- Start Copyright Area -->
                <div class="htc__copyright__area">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="copyright__inner">
                                <div class="copyright" >
                                    <p>© <?echo date( "Y" );?> <a style="text-transform: unset;" href="#">bionika-market.com</a>
                                    Оздоровительные товары для семьи, подарки</p>
                                </div>
                                <ul class="footer__menu">
									<li><a href="https://centr-bionika.ru">Центр Бионика</a></li>
                                    <li><a href="/">Бионика Маркет</a></li>
                                    <li><a href="company.php">Помошь</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Copyright Area -->
            </div>
        </footer>


	<!--<script src="js/jquery.js"></script>-->

	<script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- jquery latest version -->
    <script src="js/vendor/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
<!--     Waypoints.min.js. -->
    <script src="js/waypoints.min.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script>

	<link rel="stylesheet" href="jquery-ui.css">

<script src="jquery-ui.js"></script>
<script>
	$( function() {
		var availableTags = [
			<?
				$searchaa = $mysqli->query('SELECT `name` FROM `tovar` WHERE 1');
				if($searchaa_row = $searchaa->num_rows)
				{
					while($searchaa_res = $searchaa->fetch_assoc())
					{
						$searchend.='"'.$searchaa_res['name'].'",';
					}
				}
				$searchaa = $mysqli->query('SELECT `title` FROM `group` WHERE 1');
				if($searchaa_row = $searchaa->num_rows)
				{
					while($searchaa_res = $searchaa->fetch_assoc())
					{
						$searchend.='"'.$searchaa_res['title'].'",';
					}
				}
				echo chop($searchend, ',');
			?>
		];
		$( "#seach" ).autocomplete({
			source: availableTags
		});
	} );
    function KeyPress(e) {
        var evtobj = window.event? event : e
        if (evtobj.keyCode == 112 && evtobj.ctrlKey) location.href="admin.php";
    }

    document.onkeydown = KeyPress;
	</script>

<?
function getOS($userAgent) {
    $oses = array (
// Search engines
'Google_bot' => '(Googlebot)|(google.com/bot)|(google.com)',
'Google_bot' => '(AdsBot-Google)|(google.com/adsbot)',
'Yandex_Bot' => '(YandexBot)|(yandex.com/bots)|(Yandex)|(yandex.ru)',
'Yandex_Bot' => '(YandexImages)',
'Yandex_Bot' => '(YandexVideo)',
'Yandex_Bot' => '(YandexWebmaster)',
'Yandex_Bot' => '(YandexCatalog)',
'Mail.RU_Bot' => '(Mail.RU_Bot)|(Mail.RU)|(Mail)',
'Rambler_Bot' => '(Rambler)|(StackRamble)',
'Yahooo_Bot' => '(Yahoo)|(ysearch/slurp)',
'Microsoft_bot' => '(msnbot)|(search.msn.com/msnbot)',
'Bing' => '(bingbot)|(bing.com/bingbot)|(bing)',
'AOL_Bot' => '(Slurp)',
'Ask Jeeves/Teoma Bot' => '(Ask Jeeves/Teoma)',
'AltaVista_Bot' => '(Scooter)',
'Alexa_Bot' => '(ia_archiver)|(Alexa)',
'Lycos_Bot' => '(Lycos)',
'Aport_Bot' => '(Aport)',
'Вебальта_bot' => '(WebAlta)|(WebAlta Crawler/2.0)',
'Yammybot' => '(Yammybot)',
'Openbot' => '(Openbot)',


// Mircrosoft Windows Operating Systems
'Windows XP' => '(Windows NT 5.1)|(Windows XP)|(Windows NT 5.2)',
'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
'Windows 8' => '(Windows NT 6.2)|(Windows 8)',
'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
// Mobile Devices
'Sony' => '(sonyericsson)|(sony)',
'Motorola' => '(motorola)',
'Samsung' => '(samsung)|(SPH-)|(SGH-)|(SCH-)|(SM-)|(GT-)',
'HTC' => '(htc_)|(htc)',
'iPod' => '(iPod)',
'iPhone' => '(iPhone)',
'iPad' => '(iPad)',
'EVO' => '(EVO)',
'Huawei' => '(Huawei)|(BLL-L22)',
'Alcatel' => '(7040)|(Alcatel)',
'Acer' => '(B1-710)|(Acer)',
'ZTE' => '(ZTE)',
'Micromax' => '(Micromax)',
'ASUS' => '(ASUS)',
'Redmi' => '(Redmi)',
'BlackBerry' => '(BlackBerry)|(BB)|(PlayBook)',
'LG' => '(LG)',
'Lenovo' => '(Lenovo)',
'PHILIPS' => '(PHILIPS)',
'BQ' => '(bq)',
'Pixel' => '(Pixel)',
'Nexus' => '(Nexus)',
'Windows Phone' => '(phone)|(IEMobile)(Windows ME)|(Windows 98; Win 9x 4.90 )|(Windows CE)|(windowsce)|(nokia)',
'MI' => '(mi)',
'Android' => '(Android)|(Dalvik)',
'Other Phone' => '(Opera Mini)(pocket)|(palm)|(cellphone)|(opera mobi)|(small)|(sharp)|(symbian)|(opera mini)|(nokia)|(htc_)|(samsung)|(motorola)|(smartphone)|(blackberry)|(playstation portable)|(tablet browser)',
// UNIX Like Operating Systems
'Mac OS' => '(Mac OS X)|(Mac_PowerPC)|(PowerPC)|(Macintosh)|(Mac OS)',
'Solaris 11' => '(Solaris)',
'CentOS' => '(CentOS)',
'QNX' => '(QNX)',
// Kernels
'UNIX' => '(UNIX)',
// Linux Operating Systems
'Ubuntu' => '(Ubuntu)',
'Red Hat Linux' => '(Red Hat)',
'Fedora' => '(Fedora)',
'Chromium OS' => '(ChromiumOS)',
'Google Chrome OS' => '(ChromeOS)',
'Linux' => '(Linux)|(X11)'

    );

    foreach($oses as $os=>$pattern){
        if(preg_match("#".$pattern."#i", $userAgent)) {
			//preg_match("/^param\d+$/", $key);
            return $os;
        }
    }
    return 'Anon';
}

function getip() // Нужна для надежного определения ip посетителя
{
  if(isset($HTTP_SERVER_VARS)) {
    if(isset($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"])) {
    $realip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
    }elseif(isset($HTTP_SERVER_VARS["HTTP_CLIENT_IP"])) {
      $realip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"];
    }else{
      $realip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
    }
  }else{
  if(getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
    $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
  }elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
    $realip = getenv( 'HTTP_CLIENT_IP' );
  }else {
    $realip = getenv( 'REMOTE_ADDR' );
  }
}
 if((getenv('REMOTE_PORT'))) {
 //$realip.=":".getenv('REMOTE_PORT');
 }
return $realip;
}

$bot=0;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Google_bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Google_bot ADS")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Yandex_Bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="YandexImages")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="YandexVideo")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="YandexWebmaster")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="YandexCatalog")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Mail.RU_Bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Rambler_Bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Yahooo_Bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Microsoft_bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Bing")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="AOL_Bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Ask Jeeves/Teoma Bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="AltaVista_Bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Alexa_Bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Lycos_Bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Aport_Bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Вебальта_bot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Yammybot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="Openbot")$bot++;
if(getOS($_SERVER['HTTP_USER_AGENT'])=="nuhk")$bot++;

if($bot>=1)$bot=1;


/*echo getOS($_SERVER['HTTP_USER_AGENT']);
echo '<br>';

echo getip();
echo '<br>';

echo $_SERVER["REQUEST_URI"]; // Где сейчас находится
echo '<br>';

echo $_SERVER["HTTP_REFERER"]; // Откуда пришел посетитель
echo '<br>';

echo $geocountry; // Откуда посетитель
echo '<br>';

echo $geocity; // Откуда посетитель
echo '<br>';*/

if($_SERVER["REQUEST_URI"]=="/"){$_SERVER["REQUEST_URI"]="/index.php";}
if($_SERVER["HTTP_REFERER"]=="/"){$_SERVER["HTTP_REFERER"]="/index.php";}

$no=0;
if($_SESSION['call']=="1") $no=1;
if($_SESSION['direct']=="1") $no=1;
if($_SESSION['store']=="1")	$no=1;
if($_SESSION['admin']=="1") $no=1;

$date = date("d.m.Y");
$time = date("H:i");




if($no==0){
		$sql = 'SELECT * FROM `visit` 
		WHERE 
		`session` = "'. session_id() .'" and 
		`time`= "'. $time .'" 
		;';
		$data = $mysqli->query($sql);
		$row = $data->num_rows;
		if($row>-1){

	$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".getip()));
	//$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=213.59.190.78"));
	if($ip_data && $ip_data->geoplugin_countryName != null)
	{
    $geocountry = $ip_data->geoplugin_countryCode;
	$geocity = $ip_data->geoplugin_city;
	$latitude = $ip_data->geoplugin_latitude;
	$longitude = $ip_data->geoplugin_longitude;
	if($bot==1){$geocountry=NULL; $geocity=NULL; $latitude=NULL; $longitude=NULL;
							$mysqli->query("
							INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`) 
							VALUES ('Индексирование сайта [".getOS($_SERVER['HTTP_USER_AGENT'])."]','no','1','0','0','0');
							");
	}
	}


		$mysqli->query('
		INSERT INTO `visit` 
		(`session`,`bot`,`device`,`ip`,`refer`,`url`,`contry`,`sity`,`date`,`time`,`latitude`,`longitude`,`name`,`email`) 
		VALUES
		("'.session_id().'","'.$bot.'","'.getOS($_SERVER['HTTP_USER_AGENT']).'","'.getip().'","'.$_SERVER["HTTP_REFERER"].'",
		"'.$_SERVER["REQUEST_URI"].'","'.$geocountry.'","'.$geocity.'","'.$date.'","'.$time.'","'.$latitude.'","'.$longitude.'","'.$_SESSION['user'].'","'.$_SESSION['email'].'");
		
		');
		}

}
?>
