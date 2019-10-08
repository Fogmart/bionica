<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
session_start();

?>
<div class="offsetmenu__close__btn" onclick='close_all();'>
            <font style="font-size: 36px;"><i class="zmdi zmdi-close"></i></font>
        </div>
		<div class="shp__cart__wrap">
		
		
		
			<div class="shp__single__product">
				<div class="shp__pro__thumb">
					<a href="#">
						<img src="images/payment/user.png" alt="Фото">
					</a>
				</div>
				<div class="shp__pro__details">
					<h2>
					<a href="product-details.html">
					<font style="vertical-align: inherit;">
					<font style="vertical-align: inherit;"><? echo $_SESSION['user'];	?>
					</font>
					</font>
					</a>
					</h2>
					
					<span class="quantity">
					<font style="vertical-align: inherit;">
					<font style="vertical-align: inherit;"><? echo $_SESSION['tel'];	?>
					</font>
					</font>
					</span>
					<span class="quantity">
					<font style="vertical-align: inherit;">
					<font style="vertical-align: inherit;"><br><? echo $_SESSION['full_adres'];	?>
					</font>
					</font>
					</span>
					<span class="shp__price">
					<font style="vertical-align: inherit;">
					<font style="vertical-align: inherit;"><? echo $_SESSION['email'];	?>
					</font>
					</font>
					</span>
					
				</div>
			</div>
                        
        </div>
        <ul class="user__btn">
            <li><a href="shopping.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Просмотр корзины</font></font></a></li>
            
			
			<?if(!isset($_SESSION['user'])|| $_SESSION['user']=="anonymous"){
				echo '<li class="shp__checkout"><a onclick="close_all(); login();" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Войти</font></font></a></li>';
			}
			else
			{
				echo '<li class="shp__checkout"><a onclick="close_all(); exlogin();" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выйти</font></font></a></li>';
			}
				?>
        </ul>
		<div id="exit"></div>
		<script>
		
		function exlogin(){
				var sms={user:"123"};
				var url="exit.php";
				var metod="POST";
				
					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							$("#exit").html( result );
						});
			}
		</script>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		