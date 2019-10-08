<?php if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
if($_SESSION['admin']!=1)
if($_SESSION['store']!=1)
exit;
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
						}
						
$corzina_sql ='SELECT DISTINCT `email` FROM `shopping`;';
$corzina_data = $mysqli->query($corzina_sql);
$corzina_row = $corzina_data->num_rows;
$corzina; //[1]-номер [2]-сумма всего должен [3]-полученная сумма
	for($i=1;$corzina_res  = $corzina_data ->fetch_assoc();$i++)
	{
		$corzina[$i][1]=$corzina_res['email'];
		$user_sql ="SELECT * FROM  `shopping` WHERE  `email` LIKE  '%".$corzina[$i][1]."%';";
		$user_data = $mysqli->query($user_sql);
		$user_row = $user_data->num_rows;
		while($user_res  = $user_data ->fetch_assoc())
		{
			if($user_res['check']!="ok"){$corzina[$i][2]=$corzina[$i][2]+(int)$user_res['sum_p'];}
			
			if($user_res['art']=="0")$corzina[$i][13]+=(int)$user_res['sum_p']; //доставка
			$corzina[$i][14]=$user_res['fio'];
			$corzina[$i][15]=$user_res['tel'];
			if($user_res['checkcall']=="yes")$corzina[$i][20]="Проверен колл центром";
			
		}
	}
for($i=1;$i<=$corzina_row;$i++)	{
$order_sql ="SELECT * FROM `orders` WHERE `label`= '".$corzina[$i][1]."' and `user_check`!='ok' ORDER BY `id` DESC;";
$order_data = $mysqli->query($order_sql);
$order_row = $order_data->num_rows;
if($order_row>0)
{
$short=10;
$order_res  = $order_data ->fetch_assoc();
$corzina[$i][3]=$order_res['id'];
$corzina[$i][4]=$order_res['withdraw_amount'];
$corzina[$i][5]=$order_res['amount'];
$corzina[$i][6]=$order_res['user_check'];
$corzina[$i][7]=$order_res['sha1'];
$corzina[$i][8]=$order_res['sha1_hash'];
$corzina[$i][17]=$order_res['verification'];
if($order_res['notification_type']=="Наложенный платеж"){$corzina[$i][18]="</br><font style='color:red; font-size:15px;'>Наложенный платеж</font>";}
else{$corzina[$i][18]="";}

if($corzina[$i][7]==$corzina[$i][8])$corzina[$i][9]="ok"; //ключи сошлись
else $corzina[$i][9]="no";

if($corzina[$i][4]>=$corzina[$i][2])$corzina[$i][10]="ok"; //сумма сошлась
else $corzina[$i][10]="no";

for($j=1;$j <= 10;$j++)	if(isset($corzina[$i][$j]))$short--;
if($short==0)$corzina[$i][11]="ok"; //все значения на местах вывод заказа 
else $corzina[$i][11]="no";

if($corzina[$i][11]=="ok")
	if($corzina[$i][9]=="ok")
		if($corzina[$i][10]=="ok") {$corzina[$i][12]="complete"; $com++;}
		else {$corzina[$i][12]="Error";$err++;} //Ошибка в цене
	else {$corzina[$i][12]="Error";$err++;} //Ошибка в верификации платежа (ключи)
else {$corzina[$i][12]="Error";$err++;} //не все значения
if($corzina[$i][17]=="ok"){$corzina[$i][12]="complete"; $com++;$err--;}
}

}

?>





<div class="title_bar" id="title_bar">
        <div id="titlebar_left">
          <h2 id="page_title">Заказы</h2>
        </div>
        <div id="titlebar_right">
          <div class="action_items">
		  <?$newWin= "newWin = window.open('Modules/Export.php' ,'', 'width=900,height=550,left=200,top=200,menubar=no,toolbar=no,location=no');";?>
            <span class="action_item"><a onclick="<?echo $newWin;?>" href="">Выгрузить заказы</a></span>
          </div>
        </div>
      </div>




<div class="flashes"></div>

<div id="active_admin_content" class="with_sidebar">
	<div id="main_content_wrapper">
		<div id="main_content" style="margin-right: 0px;">
			<div class="table_tools">
				<div class="scopes" style="width: calc((100% - 10px) - 122.599px); float: left;">
					<ul class="table_tools_segmented_control scope-default-group">
						<li class="scope all selected">
						<a onclick='
					  document.getElementById("order_yes").style.display="block";
					  document.getElementById("order_no").style.display="none";
					  document.getElementsByClassName("scope all")[0].classList.add("selected");
					  document.getElementsByClassName("scope in_progress")[0].classList.remove("selected");
					  ' class="table_tools_button">
						В ожидании	<span class="count">(<?echo $com;?>)</span>
						</a>
						</li>
						<li class="scope in_progress">
						<a onclick='
					  document.getElementById("order_no").style.display="block";
					  document.getElementById("order_yes").style.display="none";
					  document.getElementsByClassName("scope all")[0].classList.remove("selected");
					  document.getElementsByClassName("scope in_progress")[0].classList.add("selected");
					  ' class="table_tools_button">
						Ошибки	<span class="count">(<?echo $err;?>)</span>
						</a>
						</li>
					</ul>
				</div>
			</div>
			  
			<div class="paginated_collection">
				<div class="paginated_collection_contents">
					<div class="index_content">
						<div class="index_as_table">
<!---------------------------------------------------------------------------------------->					
<!---------------------------------------------------------------------------------------->						
<!---------------------------------------------------------------------------------------->						
					
					
<div id="order_yes">
<table border="0" cellspacing="0" cellpadding="0" id="index_table_orders" class="index_table index" paginator="true" >
	<thead>
		<tr>
			<tr>
			<th class="sorted-desc col col-id"><a>№</a></th>
			<th class="col col-reference"><a>Покупатель</a></th>
			<th class="col col-amount"><a>Цена</a></th>
			<th class="col col-state"><a>Верификация</a></th>
			<th class="col col-created_at"><a>Банк</a></th>
			<th class="col col-updated_at"><a>Сделка закрыта</a></th>
			<th class="col col-actions">Действия</th>
			</tr>
		</tr>
	</thead>
	
	<tbody>
<?
	for($i=1;$i <= $corzina_row;$i++)
	{
		if($corzina[$i][11]=="ok")
		if($corzina[$i][12]=="complete")
		{
$newWin= "newWin = window.open('Modules/Orders/Ordersview.php?email=".$corzina[$i][1]."' ,'', 'width=900,height=550,left=200,top=200,menubar=no,toolbar=no,location=no');";
$newWin1= "newWin = window.open('Modules/Orders/Ordersedit.php?email=".$corzina[$i][1]."' ,'', 'width=955,height=550,left=200,top=200,menubar=no,toolbar=no,location=no');";

if($corzina[$i][18]==""){$dd="nextorder('".$corzina[$i][3]."','".$corzina[$i][1]."','".$corzina[$i][5]."','p','".$corzina[$i][14]."','оплата покупки','".$_SESSION['email']."');";}
else{$dd="nextordernaloj('".$corzina[$i][3]."','".$corzina[$i][1]."','".$corzina[$i][5]."','p','".$corzina[$i][14]."','оплата покупки','".$_SESSION['email']."','".$corzina[$i][4]."');";}

$ddd="gotrack('".$corzina[$i][3]."','".$corzina[$i][1]."');";
$jjj="gobreak('".$corzina[$i][1]."');";

echo '
<tr class="odd" id="order_77">
	<td class="col col-id">
		<a class="resource_id_link">
			<p>'.$i.'</p>
		</a>
	</td>
	<td class="col col-reference">
		<p>'.$corzina[$i][14].'</p>
		<p>'.$corzina[$i][15].'</p>
		<p>'.$corzina[$i][1].$corzina[$i][18].'</p>
	</td>
	<td class="col col-amount">
		<p title="Обьявленая цена"><span class="iconify" data-icon="fa-solid:donate" data-inline="false"></span>
		'.$corzina[$i][2].'</p>
		<p title="Доставка"><span class="iconify" data-icon="fa-solid:truck" data-inline="false"></span>
		'.$corzina[$i][13].'</p>
	</td>
	<td class="col col-state">
		<span title="Нет ошибок" class="status_tag '.$corzina[$i][12].'">'.$corzina[$i][12].'</span>
	</td>
	<td class="col col-created_at">
		<p title="Запрошеная цена"><span class="iconify" data-icon="fa-solid:donate" data-inline="false"></span>
		'.$corzina[$i][4].'</p>
		<p title="На счету"><span class="iconify" data-icon="fa-solid:money-check-alt" data-inline="false"></span>
		'.$corzina[$i][5].'</p>
	</td>
	<td class="col col-updated_at">
		<span title="Проверка персоналом" class="status_tag '.$corzina[$i][6].'">'.$corzina[$i][6].'</span>
		</br></br><span>'.$corzina[$i][20].'</span>
	</td>
	<td class="col col-actions">
		<div class="table_actions">
			<p>	<a onclick="'.$newWin.'" class="view_link member_link" title="Просмотр">Просмотр</a>
				<a onclick="'.$newWin1.'" class="edit_link member_link" title="Редактирование">Изменить</a>
			<p>	<a class="delete_link member_link" onclick="'.$ddd.'" title="Посылка отправлена">(отправил человеку)</a></p>
			<p>	<a class="delete_link member_link" onclick="'.$dd.'" title="Закрыть сделку">Закрыть</a> <a class="delete_link member_link" onclick="'.$jjj.'" title="Отмена">Отмена</a></p>
		</div>
	</td>
</tr>
';
		}	
	}
?>
	</tbody>
</table>
</div>

<div id="order_no" style="display: none;">
<table border="0" cellspacing="0" cellpadding="0" id="index_table_orders" class="index_table index" paginator="true" >
	<thead>
		<tr>
			<tr>
			<th class="sorted-desc col col-id"><a>№</a></th>
			<th class="col col-reference"><a>Покупатель</a></th>
			<th class="col col-amount"><a>Цена</a></th>
			<th class="col col-state"><a>Верификация</a></th>
			<th class="col col-created_at"><a>Банк</a></th>
			<th class="col col-updated_at"><a>Сделка закрыта</a></th>
			<th class="col col-actions">Действия</th>
			</tr>
		</tr>
	</thead>
	
	<tbody>
<?
	for($i=1;$i <= $corzina_row;$i++)
	{
		if($corzina[$i][11]=="ok")
		if($corzina[$i][12]=="Error")
		{
$newWin= "newWin = window.open('Modules/Orders/Ordersview.php?email=".$corzina[$i][1]."' ,'', 'width=900,height=550,left=200,top=200,menubar=no,toolbar=no,location=no');";
$newWin1= "newWin = window.open('Modules/Orders/Ordersedit.php?email=".$corzina[$i][1]."' ,'', 'width=955,height=550,left=200,top=200,menubar=no,toolbar=no,location=no');";

if($corzina[$i][18]==""){$dd="nextorder('".$corzina[$i][3]."','".$corzina[$i][1]."','".$corzina[$i][5]."','p','".$corzina[$i][14]."','оплата покупки','".$_SESSION['email']."');";}
else{$dd="nextordernaloj('".$corzina[$i][3]."','".$corzina[$i][1]."','".$corzina[$i][5]."','p','".$corzina[$i][14]."','оплата покупки','".$_SESSION['email']."','".$corzina[$i][4]."');";}

$ddd="gotrack('".$corzina[$i][3]."','".$corzina[$i][1]."');";
$jjj="gobreak('".$corzina[$i][1]."');";


echo '
<tr class="odd" id="order_77">
	<td class="col col-id">
		<a class="resource_id_link">
			<p>'.$i.'</p>
		</a>
	</td>
	<td class="col col-reference">
		<p>'.$corzina[$i][14].'</p>
		<p>'.$corzina[$i][15].'</p>
		<p>'.$corzina[$i][1].$corzina[$i][18].'</p>
	</td>
	<td class="col col-amount">
		<p title="Обьявленая цена"><span class="iconify" data-icon="fa-solid:donate" data-inline="false"></span>
		'.$corzina[$i][2].'</p>
		<p title="Доставка"><span class="iconify" data-icon="fa-solid:truck" data-inline="false"></span>
		'.$corzina[$i][13].'</p>
	</td>
	<td class="col col-state">
		<span title="Есть ошибоки" class="status_tag '.$corzina[$i][12].'">'.$corzina[$i][12].'</span>
	</td>
	<td class="col col-created_at">
		<p title="Запрошеная цена"><span class="iconify" data-icon="fa-solid:donate" data-inline="false"></span>
		'.$corzina[$i][4].'</p>
		<p title="На счету"><span class="iconify" data-icon="fa-solid:money-check-alt" data-inline="false"></span>
		'.$corzina[$i][5].'</p>
	</td>
	<td class="col col-updated_at">
		<span title="Проверка персоналом" class="status_tag '.$corzina[$i][6].'">'.$corzina[$i][6].'</span>
		</br></br><span>'.$corzina[$i][20].'</span>
	</td>
	<td class="col col-actions">
		<div class="table_actions">
			<p>	<a onclick="'.$newWin.'" class="view_link member_link" title="Просмотр">Просмотр</a>
				<a onclick="'.$newWin1.'" class="edit_link member_link" title="Редактирование">Изменить</a>
						<p>	<a class="delete_link member_link" onclick="'.$ddd.'" title="Посылка отправлена">(отправил человеку)</a></p>
			<p>	<a class="delete_link member_link" onclick="'.$dd.'" title="Закрыть сделку">Закрыть</a>  <a class="delete_link member_link" onclick="'.$jjj.'" title="Отмена">Отмена</a></p>
				
		</div>
	</td>
</tr>
';
		}	
	}
?>
	</tbody>
</table>
</div>

<!---------------------------------------------------------------------------------------->					
<!---------------------------------------------------------------------------------------->						
<!---------------------- ------------------------------------------------------------------>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="msg"></div>

			<script>
				function gotrack(id,email){
				var text1 = $('#fio').val();
									
				var years = prompt('Введите трекер', 'без трекера');
				    if (years === null) {
						return; //break out of the function early
					}
									
				var post={id:id,email:email,treck:years};
				var url="/Modules/Orders/Orderstrack.php";
				var metod="POST";
				$.ajax({
					type: metod,
					url: url,
					data: post
				}).done(function( result )
				{
					$("#msg").html( result );
				});
				
				
				

			}
			function gobreak(email){
				var text1 = $('#fio').val();
									
				randnj=Math.floor(Math.random() * (9999 - 1000 + 1)) + 1000;
				var nj = prompt('Отмена?(Повторить пин код: '+randnj+' )', 'Все верно?');
				    if (nj === null) {
						return; //break out of the function early
					}	
					else{
					if(nj!=randnj) return;
					}
								randnj=Math.floor(Math.random() * (9999 - 1000 + 1)) + 1000;
				var nj = prompt('Возврат денег произошел?(Повторить пин код: '+randnj+' )', 'Все верно?');
				    if (nj === null) {
						return; //break out of the function early
					}	
					else{
					if(nj!=randnj) return;
					}
				
									
				var post={email:email};
				var url="/Modules/Orders/Ordersbreak.php";
				var metod="POST";
				$.ajax({
					type: metod,
					url: url,
					data: post
				}).done(function( result )
				{
					$("#msg").html( result );
				});
				
				
				

			}
			function nextorder(id,email,sum,pm,name,becose,emailadm){
				var text1 = $('#fio').val();
									
									
				var post={id:id,email:email,sum:sum,pm:pm,name:name,becose:becose,email_admin:emailadm};
				var url="/Modules/Orders/Ordersgo.php";
				var metod="POST";
				$.ajax({
					type: metod,
					url: url,
					data: post
				}).done(function( result )
				{
					$("#msg").html( result );
				});
				
				
				

			}
			function nextordernaloj(id,email,sum,pm,name,becose,emailadm,wa){
				var text1 = $('#fio').val();
				
				randnj=Math.floor(Math.random() * (9999 - 1000 + 1)) + 1000;
				var nj = prompt('Внимание наложенный платеж (Повторить пин код: '+randnj+' )', 'Все верно? Денюшки пришли?');
				    if (nj === null) {
						return; //break out of the function early
					}	
					else{
					if(nj!=randnj) return;
					}
				
									
				var post={id:id,email:email,sum:sum,pm:pm,name:name,becose:becose,email_admin:emailadm,wa:wa};
				var url="/Modules/Orders/Ordersgo.php";
				var metod="POST";
				$.ajax({
					type: metod,
					url: url,
					data: post
				}).done(function( result )
				{
					$("#msg").html( result );
				});
				
				
				

			}
			</script>


<?
// 1- почта
// 2- сумма заказа
// 3- ид в оплате
// 4- сумма выставленая
// 5- зачисленая 
// 6- закрыта ли сделка
// 7- ключь 1
// 8- ключь 2
// 9- ключи сошлись
// 10- сумма сошлась
// 11- являеться заказом
// 12- ошибки или отсутствие
// 13- доставка
// 14- ФИО
// 15- телефон
// 16- скидка
// 17- проставленая верификация
// 18- Наложенный платеж
// $com- всего полож
// $err- всего отриц
?>