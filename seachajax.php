<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";
/*
echo "<br><br><br></br>";
foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>POST ".$key." = ".$value."</p>";} //все POST запросы
foreach ($_GET as $key => $value) {$add[$key] = $value;  echo "<p>GET ".$key." = ".$value."</p>";} //все GET запросы
*/


echo '<p>
	<ul class="sidebar__list">
	<li><i style="margin-left:15px; color: '.$_POST['setcolor'].';" class="zmdi zmdi-circle">';
	if($_POST['seach']!=NULL && $_POST['seach']!="")echo' - '.$_POST['seach'].'';
	if($_POST['razm']!=NULL && $_POST['razm']!="0")echo' - '.$_POST['razm'].'';
echo '</i></li>
	</ul>
	</p>';

$sortirovka='ORDER BY `id` DESC';
if($_POST['sortirovka']==0){$sortirovka='ORDER BY `id`';}
if($_POST['sortirovka']==1){$sortirovka='ORDER BY `id`';}
if($_POST['sortirovka']==2){$sortirovka='ORDER BY `id` DESC';}
if($_POST['sortirovka']==4){$sortirovka='ORDER BY `sum_p`';}
if($_POST['sortirovka']==3){$sortirovka='ORDER BY `sum_p` DESC';}

if($_POST['razm']!="0" && $_POST['razm']!="" && $_POST['razm']!=" ")
{
    $set_razm = 'and (`razm` LIKE "%'.$_POST['razm'].'%")';
}

if($_POST['setcolor']!="0" && $_POST['setcolor']!="" && $_POST['setcolor']!=" ")
{
    $set_razm = $set_razm .'and (`color` LIKE "%'.$_POST['setcolor'].'%")';
}



if(isset($_POST['group_id'])) $GO['group_id']='and (`group_id` LIKE "%'. $_POST['group_id'] .'%" or `2group_id` LIKE "%'. $_POST['group_id'] .'%")';

if($_POST['group_id']=="") {$_POST['group_id']="0";unset($_SESSION['backgroup']);}
if($_POST['group_id']==" ") {$_POST['group_id']="0";unset($_SESSION['backgroup']);}

if($_POST['seach']!="" &&  $_POST['seach']!=" "){

						$sql1 = 'SELECT * FROM `tovar` 
					WHERE 
						(`name` LIKE "%'. $_POST['seach'] .'%" or 
						`name_print` LIKE "%'. $_POST['seach'] .'%" or
						`comment` LIKE "%'. $_POST['seach'] .'%" or
						`text` LIKE "%'. $_POST['seach'] .'%") 
						'.$GO['group_id'].'
						'.$set_razm.'
					'.$sortirovka.'	
					;';

}
else
{
if($_POST['group_id']=="0"){$_POST['group_id']="";}
						$sql1 = 'SELECT * FROM `tovar` 
					WHERE 
						(`group_id` LIKE "%'. $_POST['group_id'] .'%" or
						`2group_id` LIKE "%'. $_POST['group_id'] .'%")
						'.$set_razm.'
					'.$sortirovka.'	
					;';
}


					$data1 = $mysqli->query($sql1);
					$row1 = $data1->num_rows;
					$data2 = $mysqli->query($sql1);
					$row2 = $data2->num_rows;


function StartSingleProductSeach($id,$art,$url,$name,$img,$sum_p,$rrc,$video,$color){

$end='<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">';
$end.='    <div class="product">';
$end.='		<div class="product__inner" style="overflow: hidden; border:1px solid #dbdbdd; border-bottom-style: none;">';
$end.='            <div class="pro__thumb" style="background-image: url('.$img.');    background-size: contain;      background-repeat: no-repeat; background-position: center;">';

$end.='                <a href="'.$url.'"><figure>';
$end.='            <div style="width:100%; bottom: 20px; position: absolute;">';

foreach ($color as $element)
{
	if($element!='' && $element!=' ')	
		$end.='<div style="width:100%; height:14px;text-align: right;"><ul class="sidebar__list"><li><i style="margin-left:15px; color: '.$element.';" class="zmdi zmdi-circle"></i></li></ul></div>';
}

$end.=' 					</div>';
$end.='                    <img style="opacity:0; height:260px;" src="'.$img.'" alt="'.$name.'">';
$end.='                </a></figure><figcaption style="display:none;">'.$name.'</figcaption>';
$end.='            </div>';

$end.='		</div>';
$end.='		<div class="product__details" style="border:1px solid #dbdbdd; border-top-style: none;">';
$end.='			<h2 style="min-height:65px;max-height:65px; font-size:16px;"><a href="'.$url.'">'.$name.'</a></h2>';
$end.='			<ul class="product__action">';
$x="modalopen('".$id."');";
$end.='				<li><a data-toggle="modal" onclick="'.$x.'" data-target="#productModal1" title="Просмотр" class="quick-view modal-view detail-link" href=""><span class="ti-eye"></span></a></li>';
$x="shopadd('".$art."');";

$x="laik('".$id."');";
$end.='				<li><a title="Нравится" onclick="'.$x.'"><span class="ti-heart"></span></a></li>';
if($video==1)$end.='				<li><a href="'.$url.'"><span class="ti-video-camera"></span></a></li>';
$end.='			</ul>';
$end.='			<ul class="product__price">';
$end.='				<li class="old__price">'.number_format($rrc, 2, '.',' ').' р</li>';
$end.='				<li class="new__price">'.number_format($sum_p, 2, '.',' ').' р</li>';
$end.='			</ul>';
$end.='		</div>';
$end.='	</div>';
$end.='</div>';
return $end;
}

function StartListProductSeach($id,$art,$url,$name,$img,$sum_p,$comment,$rrc,$video){
$end='<div class="single__list__content clearfix">';
$end.='<div class="col-md-3 col-lg-3 col-sm-4 col-xs-12">';
$end.='    <div class="list__thumb">';
$end.='        <a href="'.$url.'">';
$end.='            <img src="'.$img.'" alt="'.$name.'" >';
$end.='        </a>';
$end.='    </div>';
$end.='</div>';
$end.='<div class="col-md-9 col-lg-9 col-sm-8 col-xs-12">';
$end.='    <div class="list__details__inner">';
$end.='        <h2><a href="'.$url.'">'.$name.'</a>';
if($video==1)$end.='				<a><span class="ti-video-camera"></span></a></h2>';
$end.='        </h2>';
$end.='        <p>'.$comment.'</p>';
$end.='        <span class="product__price"><s>'.number_format($rrc, 2, '.',' ').' р</s> <span style="color: #FF5B1F;">'.number_format($sum_p, 2, '.',' ').' р</span></span>';
$end.='        <div class="shop__btn">';
$end.='            <a class="htc__btn" target="_blank" href="'.$url.'"><span class="ti-eye"></span>Просмотреть</a>';
$end.='        </div>';
$end.='    </div>';
$end.='</div>';
$end.='</div>';
return $end;
}

?>


<div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
	<? 
		while($res1 = $data1->fetch_assoc())
		{
			if($res1['active']=="no"){continue;}

			$intdost=(int)$res1['dost'];
			if($intdost<=0)if($res1['zakaz']=="no")
			{
				$mysqli->query("UPDATE `tovar` SET `active` = 'no'	WHERE `id`=".$res1['id'].";");

				$mysqli->query("
				INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`) 
				VALUES ('Закончился товар [".$res1['name']."]','Modules/Storage/tovar_red.php?id=".$res1['id']."','0','1','1','0');
				");

				continue;
			}

			if($res1['massa']=="0" || $res1['massa']=="" || $res1['massa']==" " || (!(isset($res1['massa']))))
			{
				$mysqli->query("UPDATE `tovar` SET `active` = 'no'	WHERE `id`=".$res1['id'].";");
				$mysqli->query("
				INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`) 
				VALUES ('Не указана масса [".$res1['name']."]','Modules/Storage/tovar_red.php?id=".$res1['id']."','0','1','1','0');
				");
				continue;
			}

			// проверка сумм
			if($res1['sum_p']<$_POST['pricemin']){continue;}
			if($res1['sum_p']>$_POST['pricemax']){continue;}

			// установка возможных размеров
			if(strlen($res1['razm']))
			{
				$all_razm_fromBD = $all_razm_fromBD .",". $res1['razm'];
			}
			// установка возможных цветов
			if(strlen($res1['color']))
			{
				$all_color_fromBD = $all_color_fromBD .",". $res1['color'];
			}


			// проверка фоток
			for($i=1;$i<=16;$i++)
			{
				if($i==16)
				{
					$mysqli->query("UPDATE `tovar` SET `active` = 'no'	WHERE `id`=".$res1['id'].";");

						$mysqli->query("
						INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`) 
						VALUES ('Нет фотографий [".$res1['name']."]','Modules/Storage/tovar_red.php?id=".$res1['id']."','0','1','1','0');
						");

					echo "<script>location.href=location.href;</script>";
					break;
				}
				if(($res1['photo_'.$i]!=NULL)&&($res1['photo_'.$i]!=''))
				{
					$img11=$res1['photo_'.$i];
					break;
				}
			}
			// проверка видосов
			if($res1['video']!="" && $res1['video']!=" "){$svideo=1;}
			else {$svideo=0;}


			echo StartSingleProductSeach($res1['id'],$res1['art'],$res1['url'],$res1['name'],$img11,$res1['sum_p'],$res1['rrc'],$svideo,explode(",", $res1['color']));
		}

		// вернуть размеры обработчику
		echo "<div id='all_razm' style='display:none;'>";
		if(strlen($all_razm_fromBD))
		foreach ( array_unique(explode(",", $all_razm_fromBD)) as $razm)
		{
			if($razm!="" && $razm!=" ")
			echo "<li>
					<a onclick='razm=\"".$razm."\";seachajax1();'  style='text-transform: uppercase;'>
					".$razm." 
					</a>
				  </li>";
		}
		echo "</div>";
		
		// вернуть цыета обработчику
		//all_color_fromBD
		// $result = array_unique($input);
		echo "<div id='all_color' style='display:none;'>";
		if(strlen($all_color_fromBD))
		foreach ( array_unique(explode(",", $all_color_fromBD)) as $color)
		{
			if($color!="" && $color!=" ")
				
			$solor_enter = $solor_enter. "
			<div
			onclick='setcolor=\"".$color."\";seachajax1();'
			class='color_set'
			style=\"background: ".$color.";\">
			</div>
			";
		}
		echo $solor_enter."</div>";
		
	?>
</div>


<div role="tabpanel" id="list-view" class="single-grid-view tab-pane fade clearfix">
	<?	
		while($res2 = $data2->fetch_assoc())
		{
			if($res2['active']=="no"){continue;}

			$intdost=(int)$res2['dost'];
			if($intdost<=0)if($res1['zakaz']=="no"){$mysqli->query("UPDATE `tovar` SET `active` = 'no'	WHERE `id`=".$res2['id'].";"); continue;}


			if($res2['sum_p']<$_POST['pricemin']){continue;}
			if($res2['sum_p']>$_POST['pricemax']){continue;}

			for($i=1;$i<=16;$i++)
			{
				if($i==16)
				{
					$mysqli->query("UPDATE `tovar` SET `active` = 'no'	WHERE `id`=".$res2['id'].";");
					echo "<script>location.href=location.href;</script>";
					break;
				}
				if(($res2['photo_'.$i]!=NULL)&&($res2['photo_'.$i]!=''))
				{
					$img22=$res2['photo_'.$i];
					break;
				}
			}

			if($res2['video']!="" && $res2['video']!=" "){$svideo=1;}
			else {$svideo=0;}

			echo StartListProductSeach($res2['id'],$res2['art'],$res2['url'],$res2['name'],$img22,$res2['sum_p'],$res2['comment'],$res2['rrc'],$svideo);
		}
	?>
</div>









<script>
function shopadd(art){


				var sms={art:art,kolvo:"1"};
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
function laik(id){
				var sms={id:id};
				var url="laik.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							alert("Мы очень ценим ваше мнение)");
						});
			}
</script>

        <!-- Modal -->
        <div class="modal fade" id="productModal1" tabindex="-1" role="dialog">
            <div class="modal-dialog modal__container" role="document">
                <div class="modal-content" id="modalopen">

				</div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div>
        <!-- END Modal -->




<script>
function modalopen(id){
				var sms={id:id};
				var url="modal.php";
				var metod="POST";

					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							$("#modalopen").html( result );
						});
			}
</script>



<?
if($_POST['group_id']=="") {$_POST['group_id']="0";unset($_SESSION['backgroup']);}
if($_POST['group_id']==" ") {$_POST['group_id']="0";unset($_SESSION['backgroup']);}

$kategory = 'SELECT * FROM `group` WHERE `parent`='.$_POST['group_id'].';';

$datakategory = $mysqli->query($kategory);
$rowkategory = $datakategory->num_rows;

echo '<div style="display:none;"><ul class="sidebar__list" id="grop">';

if(isset($_SESSION['backgroup']))
if($_SESSION['backgroup']!="")
if($_SESSION['backgroup']!=" ")
{
	echo '<li><a onclick="entergroup_id='.$_SESSION['backgroup'].';seachajax1();" style="font-size:14px; text-transform:uppercase;"><i class = "zmdi zmdi-mail-reply-all"> </i> Назад</a></li>';
	if($simvol=="")$simvol='<i class = "zmdi zmdi-mail-send"> </i> ';
}

while($resk = $datakategory->fetch_assoc())
{
	echo '<li><a onclick="entergroup_id='.$resk['id'].';seachajax1();" style="font-size:14px; text-transform:uppercase;">'.$simvol.$resk['title'].'</a></li>';
}
echo '</ul></div>';
$_SESSION['backgroup']=$_POST['group_id'];
?>
