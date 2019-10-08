<?php if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
//SELECT * FROM `shopping` GROUP BY `email`;
if(!( isset($_SESSION['admin']) && isset($_SESSION['store']) && isset($_SESSION['direct']) && isset($_SESSION['call'])))
						{

							$_SESSION['user']="Доступ закрыт";
							unset($_SESSION['pass']);
							unset($_SESSION['id']);
							unset($_SESSION['email']);
									unset($_SESSION['admin']);
									unset($_SESSION['store']);
									unset($_SESSION['direct']);
									unset($_SESSION['call']);
									unset($_SESSION['tel']);
									unset($_SESSION['full_adres']);
									exit;
						}?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

<script type="text/javascript">
			$(document).ready(function(){
			 $('.spoiler_links1').click(function(){
			  $(this).parent().children('div.spoiler_body1').toggle('normal');
			  return false;
			 });
			});
			$(document).ready(function(){
			 $('.spoiler_links2').click(function(){
			  $(this).parent().children('div.spoiler_body2').toggle('normal');
			  return false;
			 });
			});
			$(document).ready(function(){
			 $('.spoiler_links3').click(function(){
			  $(this).parent().children('div.spoiler_body3').toggle('normal');
			  return false;
			 });
			});
			$(document).ready(function(){
			 $('.spoiler_links4').click(function(){
			  $(this).parent().children('div.spoiler_body4').toggle('normal');
			  return false;
			 });
			});
			$(document).ready(function(){
			 $('.spoiler_links5').click(function(){
			  $(this).parent().children('div.spoiler_body5').toggle('normal');
			  return false;
			 });
			});
			$(document).ready(function(){
			 $('.spoiler_links6').click(function(){
			  $(this).parent().children('div.spoiler_body6').toggle('normal');
			  return false;
			 });
			});
			var newWin;
</script>
				
<style type="text/css">
.spoiler_body1 {display:none; border: 1px solid black;}
.spoiler_links1 {cursor:pointer;}
.spoiler_body2 {display:none; border: 1px solid black;}
.spoiler_links2 {cursor:pointer;}
.spoiler_body3 {display:none; border: 1px solid black;}
.spoiler_links3 {cursor:pointer;}
.spoiler_body4 {display:none; border: 1px solid black;}
.spoiler_links4 {cursor:pointer;}
.spoiler_body5 {display:none; border: 1px solid black;}
.spoiler_links5 {cursor:pointer;}
.spoiler_body6 {display:none; border: 1px solid black;}
.spoiler_links6 {cursor:pointer;}
.spoiler_body7 {display:none; border: 1px solid black;}
.spoiler_links7 {cursor:pointer;}
</style>

<div>

				<div href="" class="spoiler_links1" style="border: 1px solid black; padding:10px; background:#CCCCFF;">Настройки пользователя</div>
				<div class="spoiler_body1" >
				<?
				$sql = 'SELECT * FROM `users` WHERE `id`='.$_SESSION['id'].';';
							$Staff = $mysqli->query($sql);
							if($Staff_row = $Staff->num_rows)$Staff_res = $Staff->fetch_assoc();
							
				?>
				<table style='height: 20px;'>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$Staff_res["name"]; ?></td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><a onclick='rename();'> Изменить ФИО</a></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "******"; ?></td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><a onclick='repass();'>Именить пароль</a></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$Staff_res["email"]; ?></td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><a onclick='reemail();'>Именить почту</a></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$Staff_res["tel"]; ?></td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><a onclick='retel();'>Именить номер телефона</a></td> 
					</tr>
				</table>	
				</div>
				<div style="margin-bottom:2px;"></div>

			<script>
			function rename(){
				newWin = window.open("Modules/Settings/rename.php" ,"", "width=800,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");
				}
			function repass(){
				newWin = window.open("Modules/Settings/repass.php" ,"", "width=800,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");
				}
			function reemail(){
				newWin = window.open("Modules/Settings/reemail.php" ,"", "width=800,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");
				}
			function retel(){
				newWin = window.open("Modules/Settings/retel.php" ,"", "width=800,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");
				}	
			</script>
<?
if($_SESSION['admin']!=1)
if($_SESSION['store']!=1)
if($_SESSION['direct']!=1)	
goto a;
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
				<div href="" class="spoiler_links2" style="border: 1px solid black; padding:10px; background:#CCCCFF;">Настройки адреса магазина</div>
				<div class="spoiler_body2" >
				<?
				$sql = 'SELECT * FROM `adres` ORDER BY `id`';
							$Adres = $mysqli->query($sql);
							if($Adres_row = $Adres->num_rows)$Adres_res = $Adres->fetch_assoc();
							
				?>
				<table style='height: 20px;'>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>Индекс</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><?echo $Adres_res['index'];?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Страна</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo $Adres_res['country'];?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><?echo $Adres_res['type_region'];?></td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><?echo $Adres_res['region'];?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Город</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo $Adres_res['city'];?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>Улица</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><?echo $Adres_res['street'];?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Дом</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo $Adres_res['house'];?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>Квартира</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><?echo $Adres_res['apartment'];?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Офис</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo $Adres_res['office'];?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'>Полный адрес</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCCCFF'><?echo $Adres_res['full_adres'];?></td> 
					</tr>
					<tr style='height: 20px; text-align:center;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCFFCC' colspan="2"><a onclick='readres();'>Редактировать</a></td>
					</tr>
				</table>	
				</div>
				<div style="margin-bottom:2px;"></div>

			<script>
			function readres(){
				newWin = window.open("Modules/Settings/readres.php" ,"", "width=800,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");
				}
			</script>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?
if($_SESSION['admin']!=1)
goto a;
?>
				<div href="" class="spoiler_links3" style="border: 1px solid black; padding:10px; background:#CCCCFF;">Реквизиты банка</div>
				<div class="spoiler_body3" >
				<?
				$sql = 'SELECT * FROM `bank` ORDER BY `id`';
							$bank = $mysqli->query($sql);
							if($bank_row = $bank->num_rows)$bank_res = $bank->fetch_assoc();
							
				?>
				<table style='height: 20px;'>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>ИП</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["ip"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>ИНН</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["inn"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Счет №</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["Rnumber"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Тип счета</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["Rnumber_type"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Банк</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["bank"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>БИК</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["bik"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Город</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["city"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Коррю счет</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["Knumber"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>КПП</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["kpp"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>ОКТМО</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["oktmo"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Л/счет</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["Lnumber"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Код дохода</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["Dnumber"]; ?></td> 
					</tr>
					<tr style='height: 20px; text-align:center;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCFFCC' colspan="2"><a onclick='rebank();'>Редактировать</a></td>
					</tr>
				</table>	
				</div>
				<div style="margin-bottom:2px;"></div>

				<script>
			function rebank(){
				newWin = window.open("Modules/Settings/rebank.php" ,"", "width=800,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");
				}
			</script>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->				
				<div href="" class="spoiler_links4" style="border: 1px solid black; padding:10px; background:#CCCCFF;">Яндекс деньги</div>
				<div class="spoiler_body4" >
				<?
				$sql = 'SELECT * FROM `bankyd` ORDER BY `id`';
							$bank = $mysqli->query($sql);
							if($bank_row = $bank->num_rows)$bank_res = $bank->fetch_assoc();
							
				?>
				<table style='height: 20px;'>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>№ кошелька</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["receiver"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Тип формы</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["quickpay-form"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Название платежа</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["targets"]." 1912311200123456"; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Название магазина</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["formcomment"]; ?></td> 
					</tr>


					<tr style='height: 20px; text-align:center;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCFFCC' colspan="2"><a onclick='logyd();'>Просмотреть лог</a></td>
					</tr>
					<tr style='height: 20px; text-align:center;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCFFCC' colspan="2"><a onclick='rebankyd();'>Редактировать</a></td>
					</tr>
				</table>	
				</div>
				<div style="margin-bottom:2px;"></div>
				

				<script>
			function logyd(){
				newWin = window.open("logyd.php" ,"", "width=800,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");
				}
			function rebankyd(){
				newWin = window.open("Modules/Settings/rebankyd.php" ,"", "width=800,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");
				}
			</script>				
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->				
				<div href="" class="spoiler_links5" style="border: 1px solid black; padding:10px; background:#CCCCFF;">PayPal</div>
				<div class="spoiler_body5" >
				<?
				$sql = 'SELECT * FROM `bankpp` ORDER BY `id`';
							$bank = $mysqli->query($sql);
							if($bank_row = $bank->num_rows)$bank_res = $bank->fetch_assoc();
							
				?>
				<table style='height: 20px;'>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>PayPal mail</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["paypalemail"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Вернуть после оплаты на</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["return"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>В случае отмены оплаты</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["cancel_return"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Куда отправить уведомление об оплате</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$bank_res["notify_url"]; ?></td> 
					</tr>


					<tr style='height: 20px; text-align:center;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCFFCC' colspan="2"><a onclick='logyd();'>Просмотреть лог</a></td>
					</tr>
					<tr style='height: 20px; text-align:center;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCFFCC' colspan="2"><a onclick='rebankpp();'>Редактировать</a></td>
					</tr>
				</table>	
				</div>
				<div style="margin-bottom:2px;"></div>
				

				<script>
			function rebankpp(){
				newWin = window.open("Modules/Settings/rebankpp.php" ,"", "width=800,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");
				}
			</script>					
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->				
				<div href="" class="spoiler_links6" style="border: 1px solid black; padding:10px; background:#CCCCFF;">Настройки сайта</div>
				<div class="spoiler_body6" >
				<?
				$sql = 'SELECT * FROM `basik` ORDER BY `id`';
							$basik_data = $mysqli->query($sql);
							if($basik_row = $basik_data->num_rows)$basik = $basik_data->fetch_assoc();
							
				?>
				<table style='height: 20px;'>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Титульник</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$basik["title"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Выдача сниплета</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$basik["description"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Ключевые слова</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$basik["keywords"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Автор</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$basik["author"]; ?></td> 
					</tr>
					<tr style='height: 20px;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'>Фирма</td>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#FFFFCB'><?echo "".$basik["copyright"]; ?></td> 
					</tr>

					<tr style='height: 20px; text-align:center;'>
						<td style='height: 20px; vertical-align: top; border:1px solid black; background:#CCFFCC' colspan="2"><a onclick='basik();'>Редактировать</a></td>
					</tr>
				</table>	
				</div>
				<div style="margin-bottom:2px;"></div>
				

				<script>
			function basik(){
				newWin = window.open("Modules/Settings/basik.php" ,"", "width=800,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");
				}
			</script>					
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->				
				<div onclick='sitemap();' class="spoiler_links7" style="border: 1px solid black; padding:10px; background:#CCCCFF;">Генерировать sitemap.xml</div>				

				<script>
			function sitemap(){
				newWin = window.open("Modules/Sitemapgen.php" ,"", "width=800,height=550,left=200,top=200,menubar=no,toolbar=no,location=no");
				}
			</script>				
<?
a:
?>			
</div>			
			