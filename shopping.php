<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";


if(isset($_POST['kol']))
{
	$sql = 'SELECT * FROM `shopping` 
		WHERE 
		`id` ="'. $_POST['idid'] .'" 
		;';
		$data = $mysqli->query($sql);
		if($row = $data->num_rows)$res = $data->fetch_assoc();

	if(($res['session_id']==session_id()) || ($res['email']==$_SESSION['email']))
	{
		$mysqli->query("
						UPDATE `shopping`
						SET `kolvo` = '".$_POST["kol"]."'
						WHERE `id`=".$_POST['idid'].";
						");

			$sql2 = 'SELECT * FROM `shopping` WHERE `session_id` ="' .session_id() .'" ;';
			$data2 = $mysqli->query($sql2);
			$row2 = $data2->num_rows;
			while($res2 = $data2->fetch_assoc())
			{
				if($_SESSION['tel']!=$res2['tel'])$mysqli->query(" UPDATE `shopping` SET `tel` = '".$_SESSION['tel']."' WHERE `id`=".$res2["id"].";");

				if($_SESSION['email']!=$res2['email'])if(isset($_SESSION['email']))	$mysqli->query(" UPDATE `shopping` SET `email` = '".$_SESSION['email']."' WHERE `id`=".$res2["id"].";");
				if($_SESSION['tel']!=$res2['tel'])if(isset($_SESSION['tel']))	$mysqli->query(" UPDATE `shopping` SET `tel` = '".$_SESSION['tel']."' WHERE `id`=".$res2["id"].";");
				if($_SESSION['user']!=$res2['fio'])if(isset($_SESSION['user']))	$mysqli->query(" UPDATE `shopping` SET `fio` = '".$_SESSION['user']."' WHERE `id`=".$res2["id"].";");
				if($_SESSION['full_adres']!=$res2['full_adres'])if(isset($_SESSION['full_adres']))	$mysqli->query(" UPDATE `shopping` SET `full_adres` = '".$_SESSION['full_adres']."' WHERE `id`=".$res2["id"].";");
			}
	}
}


	if(isset($_POST['min'])){

	echo '
	
	<div class="offsetmenu__close__btn" onclick="close_all();">
            <font style="font-size: 36px;"><i class="zmdi zmdi-close"></i></font>
        </div>
		
		<div class="shp__cart__wrap">
		
		';

		$sum_all=0;

		if(isset($_SESSION['email'])&&$_SESSION['email']!=''&&$_SESSION['email']!=' '){
		$sql = 'SELECT * FROM `shopping` 
		WHERE 
		`email` ="'. $_SESSION['email'] .'"
		;';
			/*$sql2='SELECT * FROM `shopping` WHERE `session_id` ="'. session_id() .'";';
			$data2 = $mysqli->query($sql2);
			$row2 = $data2->num_rows;
			while($res2 = $data2->fetch_assoc())
			{
				if($_SESSION['tel']!=$res2['tel'])$mysqli->query(" UPDATE `shopping` SET `tel` = '".$_SESSION['tel']."' WHERE `id`=".$res2["id"].";");

				if($_SESSION['email']!=$res2['email'])if(isset($_SESSION['email']))	$mysqli->query(" UPDATE `shopping` SET `email` = '".$_SESSION['email']."' WHERE `id`=".$res2["id"].";");
				if($_SESSION['tel']!=$res2['tel'])if(isset($_SESSION['tel']))	$mysqli->query(" UPDATE `shopping` SET `tel` = '".$_SESSION['tel']."' WHERE `id`=".$res2["id"].";");
				if($_SESSION['user']!=$res2['fio'])if(isset($_SESSION['user']))	$mysqli->query(" UPDATE `shopping` SET `fio` = '".$_SESSION['user']."' WHERE `id`=".$res2["id"].";");
				if($_SESSION['full_adres']!=$res2['full_adres'])if(isset($_SESSION['full_adres']))	$mysqli->query(" UPDATE `shopping` SET `full_adres` = '".$_SESSION['full_adres']."' WHERE `id`=".$res2["id"].";");
			}*/
		}
		else{
		$sql = 'SELECT * FROM `shopping` 
		WHERE 
		`session_id` ="'. session_id() .'"
		;';	}
		$data = $mysqli->query($sql);
		$row = $data->num_rows;
		while($res = $data->fetch_assoc()){
        if($res['check']=="no"){
		$sum_prom= (int)$res['kolvo']*(double)$res['sum_p'];
		$sum_all+=$sum_prom;

				echo '
				<div class="shp__single__product">
				<div class="shp__pro__thumb">
					<a>
				';

				echo '<img src="'.$res['img'].'" alt="'.$res['name'].'">';

				echo '
				</a>
				</div>
				<div class="shp__pro__details">
					<h2>
					<a href="'.$res['url'].'">
					<font style="vertical-align: inherit;">
					<font style="vertical-align: inherit;">
				';

				echo $res['name'];

				echo '
				</font>
					</font>
					</a>
					</h2>
					
					<span class="quantity">
					<font style="vertical-align: inherit;">';
				if($res['art']!="0"){
					if($res['zakaz']=="no"){
						echo '<font style="vertical-align: inherit;">Количество: ';
					}
					else{
						echo '<font style="color: #FF5B1F; vertical-align: inherit;">Заказ: ';
					}

					echo $res['kolvo'];


				}


				echo '</font>
					</font>
					</span>
					<span class="shp__price">
					<font style="vertical-align: inherit;">
					<font style="vertical-align: inherit;">
					
					';

				echo number_format($sum_prom, 2, '.',' ').' р';

				$x="del('".$res['id']."');";

				echo '
				</font>
					</font>
					</span>
					
				</div>
				<div class="remove__btn">
					<a onclick="'.$x.'" title="Удалить этот элемент"><i class="zmdi zmdi-close"></i></a>
				</div>
				</div>';
		}
		}
	$_SESSION['summ_all']=number_format($sum_all, 2, '.',' ');

	echo '			
				
        </div>

        <ul class="shoping__total">
            <li class="subtotal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">итог:</font></font></li>
            <li class="total__price"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.number_format($sum_all, 2, '.',' ').' р</font></font></li>
        </ul>
        <ul class="shopping__btn">
            <li><a href="shopping.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Просмотр корзины</font></font></a></li>
            <li class="shp__checkout"><a href="checkout.php"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Оформить заказ</font></font></a></li>
        </ul>		
		<br>
		</br>
		<br>
		</br>
		<br>
		</br>
	';
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	else //full size
	{
		require "header.php";
		echo '
		<!-- cart-main-area start -->
		<br>
		</br>
		<div id="cartfull">
        <div class="cart-main-area ptb--120 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form>               
                            <div class="table-content table-responsive">
							
							
							
							
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Изображение</th>
                                            <th class="product-name">Название</th>
                                            <th class="product-price">Цена</th>
                                            <th class="product-quantity">Количество</th>
                                            <th class="product-subtotal">Итог</th>
                                            <th class="product-remove">Удалить</th>
                                        </tr>
                                    </thead>
                                    <tbody>
		';
	$sum_all=0;

		if(isset($_SESSION['email'])&&$_SESSION['email']!=''&&$_SESSION['email']!=' '){
		$sql = 'SELECT * FROM `shopping` 
		WHERE 
		`email` ="'. $_SESSION['email'] .'"
		;';

			/*$sql2='SELECT * FROM `shopping` WHERE `session_id` ="'. session_id() .'";';
			$data2 = $mysqli->query($sql2);
			$row2 = $data2->num_rows;
			while($res2 = $data2->fetch_assoc())
			{
				if($_SESSION['tel']!=$res2['tel'])$mysqli->query(" UPDATE `shopping` SET `tel` = '".$_SESSION['tel']."' WHERE `id`=".$res2["id"].";");

				if($_SESSION['email']!=$res2['email'])if(isset($_SESSION['email']))	$mysqli->query(" UPDATE `shopping` SET `email` = '".$_SESSION['email']."' WHERE `id`=".$res2["id"].";");
				if($_SESSION['tel']!=$res2['tel'])if(isset($_SESSION['tel']))	$mysqli->query(" UPDATE `shopping` SET `tel` = '".$_SESSION['tel']."' WHERE `id`=".$res2["id"].";");
				if($_SESSION['user']!=$res2['fio'])if(isset($_SESSION['user']))	$mysqli->query(" UPDATE `shopping` SET `fio` = '".$_SESSION['user']."' WHERE `id`=".$res2["id"].";");
				if($_SESSION['full_adres']!=$res2['full_adres'])if(isset($_SESSION['full_adres']))	$mysqli->query(" UPDATE `shopping` SET `full_adres` = '".$_SESSION['full_adres']."' WHERE `id`=".$res2["id"].";");
			}*/
		}
		else{
		$sql = 'SELECT * FROM `shopping` 
		WHERE 
		`session_id` ="'. session_id() .'"
		;';	}
		$data = $mysqli->query($sql);
		$row = $data->num_rows;

		while($res = $data->fetch_assoc())
		{
		if($res['check']=="no"){

		$sum_prom= (int)$res['kolvo']*(double)$res['sum_p'];
		$sum_all+=$sum_prom;
		$x="delfull('".$res['id']."');";
		$y="update('".$res['id']."');";
                                        echo '<tr>';
                                            echo '<td class="product-thumbnail"><a><img src="'.$res['img'].'" alt="'.$res['name'].'" /></a></td>';
											if($res['zakaz']!="no"){$zakazli='<font style="color: #FF5B1F;">(Под заказ)</font></br>';}
											else{$zakazli='';}
                                            echo '<td class="product-name"><a href="'.$res['url'].'">'.$zakazli.$res['name'].'</a></td>';
                                            echo '<td class="product-price"><span class="amount">';
											echo number_format($res['sum_p'], 2, '.',' ').' р';
											echo '</span></td>';
                                            if($res['art']!="0")echo '<td class="product-quantity"><label><input type="number" id="kol'.$res['id'].'" value="'.(int)$res['kolvo'].'" /><a onclick="'.$y.'"> применить</a></label></td>';
                                            else echo '<td class="product-quantity"><label>1</label></td>';
											echo '<td class="product-subtotal">';
											echo number_format($sum_prom, 2, '.',' ').' р';
											echo '</td>
                                            <td class="product-remove"><a onclick="'.$x.'">Х</a></td>';
                                        echo '</tr>';
		}

		}
		$_SESSION['summ_all']=number_format($sum_all, 2, '.',' ');
		echo '									
                                    </tbody>
                                </table>
								
								
								
								
							
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-sm-7 col-xs-12">
                                    <div class="buttons-cart">
                                        <a href="shopping.php">Обновить корзину</a>
                                        <a href="/">Продолжить покупки</a>
                                    </div>
                                    <div class="coupon">
                                        <h3>Купон</h3>
                                        <p>Введите код купона, если он у вас есть.</p>
                                        <input type="text" placeholder="Код купона" />
                                        <div class="buttons-cart"><a>Применить</a></div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-5 col-xs-12">
                                    <div class="cart_totals">
                                        <h2>Итоги корзины</h2>
                                        <table>
                                            <tbody>

                                                <tr class="shipping">
                                                    <th><img src="images/payment/cat.jpg" alt="Мяф!"></th>
                                                    <td>
                                                        <p><a class="shipping-calculator-button" >"Дальше будут конфиденциальные вопросы. Отвечая на них ВЫ подтверждаете согласие на обработку персональных данных." ♥</a></p>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Всего</th>
                                                    <td>
                                                        <strong><span class="amount">'.number_format($sum_all, 2, '.',' ').' р</span></strong>
                                                    </td>
                                                </tr>                                           
                                            </tbody>
                                        </table>
                                        <div class="wc-proceed-to-checkout">
                                            <a href="checkout.php">Оформить заказ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
		</div>
        <!-- cart-main-area end -->
		';




		require "footer.php";
	}
	//foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>POST ".$key." = ".$value."</p>";} //все POST запросы
?>

<script>
	function del(id)
	{
				var del = id;
				var sms={del:del};
				var url="shopadd.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							shopping();
							alert("Удалено");

						});
	}
</script>

<script>
	function delfull(id)

		{
				var del = id;
				var sms={del:del};
				var url="shopadd.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							location.reload();

						});
	}
</script>

<script>
function update(id)
{
				ss='#kol'+id;
				var idid = id;
				var kol = $(ss).val();
				var sms={kol:kol , idid:idid};
				var url="shopping.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{


							location.reload();
						});
}
</script>
