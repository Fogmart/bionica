<main style="background:#fff;">
<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";


	$sql = 'SELECT * FROM `news` WHERE `id` LIMIT 2;';
	$news_d = $mysqli->query($sql);
	$row = $news_d->num_rows;

	for($i=1;$res = $news_d->fetch_assoc();$i++)
	{
		$news[$i]=$res['id_tovar'];
		$srcid[$i]=$res['srcid'];

	}

    if($news[1]=='b'){
        $sqln = 'SELECT * FROM `banners` WHERE `id`=' . $srcid[1] . ';';
        $n_banner=true;

    }else {
        if ($news[1] != '0') {
            if ($news[1] != 'r') {
                if ($news[1] != 't') {
                    if ($news[1] != 'n') {
                        $sqln = 'SELECT * FROM `tovar` WHERE `id`=' . $news[1] . ';';
                    } else {
                        $sqln = 'SELECT * FROM `tovar` WHERE (`active`!="no" and `dost`!="0") or (`active`!="no" and `zakaz`="yes") ORDER BY `id` DESC LIMIT 1;';
                    }
                } else {
                    $sqln = 'SELECT * FROM `tovar` WHERE (`active`!="no" and `dost`!="0") or (`active`!="no" and `zakaz`="yes") ORDER BY `kup` DESC LIMIT 1;';
                }
            } else {
                $sqln = 'SELECT * FROM `tovar`  WHERE (`active`!="no" and `dost`!="0") or (`active`!="no" and `zakaz`="yes")  ORDER BY RAND() LIMIT 1;';

            }
        } else {
            $sqln = '';
        }
    }

	if($news[2]!='0')
	{
		if($news[2]!='r')
		{
			if($news[2]!='t')
			{
				if($news[2]!='n')
				{
					$sqlp = 'SELECT * FROM `tovar` WHERE `id`='.$news[2].';';
				}
				else{
				$sqlp = 'SELECT * FROM `tovar` WHERE (`active`!="no" and `dost`!="0") or (`active`!="no" and `zakaz`="yes") ORDER BY `id` DESC LIMIT 1;';
				}
			}
			else{
			$sqlp = 'SELECT * FROM `tovar` WHERE (`active`!="no" and `dost`!="0") or (`active`!="no" and `zakaz`="yes") ORDER BY `kup` DESC LIMIT 1;';
			}
		}
		else{
		$sqlp = 'SELECT * FROM `tovar`  WHERE (`active`!="no" and `dost`!="0") or (`active`!="no" and `zakaz`="yes")  ORDER BY RAND() LIMIT 1;';

		}
	}
	else
	{
		$sqlp = '';
	}



//news/////////////////////////////////////
if($sqln!=''){
//$sqln = 'SELECT * FROM `tovar` WHERE `active`!="no" and `dost`!="0" ORDER BY `id` DESC LIMIT 1;';
$datan = $mysqli->query($sqln);
if($rown = $datan->num_rows){$resn = $datan->fetch_assoc();}
}
//popular/////////////////////////////////
if($sqlp!=''){
//$sqlp = 'SELECT * FROM `tovar` WHERE `active`!="no" and `dost`!="0" ORDER BY `kup` DESC LIMIT 1;';
$datap = $mysqli->query($sqlp);
if($rowp = $datap->num_rows){$resp = $datap->fetch_assoc();}
}


//


?>

 <!-- Start Slider Area -->
		<?
		if($rown>0)
		for($i=1;$i<=16;$i++)
		{
		    if ($n_banner){
                $img1 = $resn['img'];
            } else {
                if ($i == 16) {
                    $mysqli->query("UPDATE `tovar` SET `active` = 'no'	WHERE `id`=" . $resn['id'] . ";");
                    //echo "<script>location.href=location.href;</script>";
                    break;
                }
                if (($resn['photo_' . $i] != NULL) && ($resn['photo_' . $i] != '')) {
                    $img1 = $resn['photo_' . $i];
                    break;
                }
            }

		}

		if($rowp>0)
		for($i=1;$i<=16;$i++)
		{
			if($i==16)
			{
				$mysqli->query("UPDATE `tovar` SET `active` = 'no'	WHERE `id`=".$resp['id'].";");
				echo "<script>location.href=location.href;</script>";
				break;
			}
			if(($resp['photo_'.$i]!=NULL)&&($resp['photo_'.$i]!=''))
			{
				$img2=$resp['photo_'.$i];
				break;
			}


		}

		?>
		        <!-- Start Feature Product -->
        <section class="categories-slider-area bg__white">
            <div class="container">
                <div class="row">
                    <!-- Start Left Feature -->
                    <div class="col-md-9 col-lg-9 col-sm-8 col-xs-12 float-left-style">
                        <!-- Start Slider Area -->
                        <div class="slider__container slider--one">
                            <div class="slider__activation__wrap owl-carousel owl-theme">
							<?if($sqln=='')goto gg1;?>
                                <!-- Start Single Slide -->
                                <div class="slide slider__full--screen slider-height-inherit slider-text-right" style="background: rgba(0, 0, 0, 0) url(<?echo $img1;?>) no-repeat scroll center center / contain;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-10 col-lg-8 col-md-offset-2 col-lg-offset-4 col-sm-12 col-xs-12">
                                                <div class="slider__inner" <?php if ($n_banner) {?> onclick='$(location).attr("href", "<?=$resn['url']?>")'; <?php }?> >
                                                    <div class="new__product__details" style="z-index:9990;">
                                                        <?php if (!$n_banner) {?>
                                                            <h2 style="text-transform: none; padding-right: 8px; background: #fff;animation: textanim2 15s ease infinite;animation-direction:alternate-reverse;"><a href="<?echo $resn['url'];?>"><?echo $resn['name'];?></a></h2>
                                                            <div class="new__product__btn" style="background: #fff; width: 100%;animation: textanim 12s ease infinite;animation-direction:alternate-reverse;">

                                                                <a class="htc__btn shop__now__btn" onclick="shopadd('<?echo $resn['art'];?>');">в корзину ♥</a>
                                                                <a style="color: #3a3a3a; font-family: Dosis; font-size: 16px; transition: all 0.5s ease 0s;"> <?echo number_format($resn['sum_p'], 2, ' р ',' ').' к';?></a>
                                                            </div>
                                                        <?php }?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Slide -->
							<?gg1:?>
							<?if($sqlp=='')goto gg2;?>
                                <!-- Start Single Slide -->
                                <div class="slide slider__full--screen slider-height-inherit  slider-text-left" style="background: rgba(0, 0, 0, 0) url(<?echo $img2;?>) no-repeat scroll center center / contain ;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                                                <div class="slider__inner">
                                                    <div class="new__product__details" style="z-index:9990;">
														<h2 style="text-transform: none; padding-right: 8px; background: #fff; animation: textanim 12s ease infinite;animation-direction:alternate;"><a href="<?echo $resp['url'];?>"><?echo $resp['name'];?></a></h2>
														<div class="new__product__btn" style="background: #fff;animation: textanim2 14s ease infinite;animation-direction:alternate;">
															<a class="htc__btn shop__now__btn" onclick="shopadd('<?echo $resp['art'];?>');">в корзину☺</a>
															<a style="color: #3a3a3a; font-family: Dosis; font-size: 16px; transition: all 0.5s ease 0s;"> <?echo number_format($resp['sum_p'], 2, ' р ',' ').' к';?></a>
														</div>
													</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Slide -->
							<?gg2:?>
                            </div>
                        </div>
                        <!-- Start Slider Area -->
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12 float-right-style">
                        <div class="categories-menu mrg-xs">
                            <div class="category-heading" style="">
                               <h3 style="color:#000; background: rgba(215, 215, 218, 0.9) none repeat scroll 0 0;">Бионика Маркет</h3>
                            </div>
                            <div class="category-menu-list">
                                <ul>
                                  <?echo $doublemenu;?>
                                    <li><a href="index.php?seach=" style="text-transform: uppercase;"><img alt="" src="images/icons/next.png">Весь каталог</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Left Feature -->
                </div>
            </div>
        </section>
        <!-- End Feature Product -->















					<style>
									@keyframes textanim{
									0%	{transform: rotate3d(1, 1, 1, -6deg);}
									50% {}
									100%{transform: rotate3d(1, 1, 1, 6deg);}
									}
									@keyframes textanim2{
									0%	{transform: rotate3d(1, 1, 1, -3deg);}
									50% {}
									100%{transform: rotate3d(1, 1, 1, 3deg);}
									}
									.anim{
										animation: city 10s ease infinite;
										animation-direction:alternate-reverse;
									}
									.anim2{
										animation: backcity 9s ease infinite;
										animation-direction:alternate-reverse;
									}
									@keyframes city {
									0%	{transform: perspective(6px) rotateY(0.1deg);}
									50% {}
									100%{transform: perspective(6px) rotateY(-0.1deg);}
									}
									@keyframes backcity {
									0%	{transform: perspective(6px) rotateY(0.1deg);}
									50% {}
									100%{transform: perspective(6px) rotateY(-0.1deg);}
									}
					</style>

<script>
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
</script>

        <!-- Start Our Product Area -->
        <section class="htc__product__area ptb--30 bg__white">
            <div class="container">
                <div class="htc__product__container">
                    <!-- Start Product MEnu -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product__menu">
                                <button data-filter="*"  class="is-checked">Все</button>
								<?
								$sql22 = 'SELECT * FROM `group` WHERE `parent`=0;';
								$data22 = $mysqli->query($sql22);
								$row22 = $data22->num_rows;
								while($res22 = $data22->fetch_assoc()){
									echo '<button data-filter=".cat--'.$res22['id'].'">'.$res22['title'].'</button>';
								}

                                //<button data-filter=".cat--1">Furnitures</button>
                                //<button data-filter=".cat--2">Bags</button>
                                //<button data-filter=".cat--3">Decoration</button>
                                //<button data-filter=".cat--4">Accessories</button>
								?>
                            </div>
                        </div>
                    </div>
                    <!-- End Product MEnu -->
                    <div class="row">
                        <div class="product__list another-product-style">
						<?
						$sqlt = 'SELECT * FROM `tovar`  WHERE `active`!="no" and `dost`!="0" or `active`!="no" and `zakaz`="yes"  ORDER BY RAND() LIMIT 20;';
						$datat = $mysqli->query($sqlt);
						if($rowt = $datat->num_rows)
						while($rest = $datat->fetch_assoc()){

							if($rest['massa']=="0" || $rest['massa']=="" || $rest['massa']==" " || (!(isset($rest['massa']))))
							if($rest['zakaz']!="yes")
							{$mysqli->query("UPDATE `tovar` SET `active` = 'no'	WHERE `id`=".$rest['id'].";");

									$mysqli->query("
									INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`) 
									VALUES ('Не указана масса [".$rest['name']."]','Modules/Storage/tovar_red.php?id=".$rest['id']."','0','1','1','0');
									");

							continue;
							echo "<script> location.reload(); </script>";
							}

							$intdost=(int)$rest['dost'];
							if($intdost<=0)if($rest['zakaz']=="no")
							{
								$mysqli->query("UPDATE `tovar` SET `active` = 'no'	WHERE `id`=".$rest['id'].";");

								$mysqli->query("
								INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`) 
								VALUES ('Закончился товар [".$rest['name']."]','Modules/Storage/tovar_red.php?id=".$rest['id']."','0','1','0','0');
								");

								continue;
							}
						if($rowt>0)
						for($i=1;$i<=16;$i++)
						{
							if($i==16)
							{
								$mysqli->query("UPDATE `tovar` SET `active` = 'no'	WHERE `id`=".$rest['id'].";");
											$mysqli->query("
											INSERT INTO `notifications`(`title`, `url`, `admin`, `store`, `direct`, `call`) 
											VALUES ('Нет фотографий [".$rest['name']."]','Modules/Storage/tovar_red.php?id=".$rest['id']."','0','1','1','0');
											");
								echo "<script>location.href=location.href;</script>";
								break;
							}
							if(($rest['photo_'.$i]!=NULL)&&($rest['photo_'.$i]!=''))
							{
								$img3=$rest['photo_'.$i];
								break;
							}


						}

						echo '<!-- Start Single Product -->';
                        echo '    <div class="col-md-3 single__pro col-lg-3 col-sm-4 col-xs-12 cat--'.$rest['group_id'].' cat--'.$rest['2group_id'].'">';
                        echo '        <div class="product foo">';
                        echo '            <div class="product__inner" style="overflow: hidden; border:1px solid #dbdbdd; border-bottom-style: none;">';
                        echo '                <div class="pro__thumb">';
                        echo '                    <a href="'.$rest['url'].'"> <div style="background-image:url(\''.$img3.'\');background-size: cover; background-position: center; animation: backcity '.rand(5, 15).'s ease infinite; animation-direction:alternate-reverse;">';
                        echo '                        <img style="width:270px; height:270px; opacity:0;" src="'.$img3.'" alt="'.$rest['name'].'">';
                        echo '                    </div></a>';
                        echo '                </div>';
                        echo '                ';
                        echo '            </div>';
                        echo '            <div class="product__details" style="border:1px solid #dbdbdd; border-top-style: none;">';
                        echo '                <h2 style="min-height:65px;max-height:65px; font-size:16px;"><a href="'.$rest['url'].'">'.$rest['name'].'</a></h2>';
                        echo '                <ul class="product__action">';
						$x="modalopen('".$rest['id']."');";
                        echo '                        <li><a data-toggle="modal" onclick="'.$x.'" data-target="#productModal1" title="Просмотр" class="quick-view modal-view detail-link" href=""><span class="ti-eye"></span></a></li>';
                        $x="shopadd('".$rest['art']."');";

                        $x="laik('".$rest['id']."');";
						echo '                        <li><a title="Нравиться" onclick="'.$x.'"><span class="ti-heart"></span></a></li>';

						if($rest['video']!="" && $rest['video']!=" ")echo '				<li><a href="'.$rest['url'].'"><span class="ti-video-camera"></span></a></li>';
                        echo '                </ul>';
						echo '				<ul class="product__price">';
                        echo '                    <li class="old__price">'.number_format($rest['rrc'], 2, '.',' ').' р</li>';
                        echo '                    <li class="new__price">'.number_format($rest['sum_p'], 2, '.',' ').' р</li>';
                        echo '                </ul>';
                        echo '            </div>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '<!-- End Single Product -->	';


						}
						?>



                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Our Product Area -->
		<!------------------->
		<!------------------->
		<!------------------->
		<!------------------->
		<!------------------->
		<!------------------->
		<?include "carosel.php";?>
		<!--<section class="htc__blog__area bg__white pb--130">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title text-center">
                            <h2 class="title__line">Возможно интересно</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <div class="blog__wrap clearfix mt--60 xmt-30">


                    </div>

                </div>
            </div>
        </section>--->
		<!------------------->
		<!------------------->
		<!------------------->
		<!------------------->
		<!------------------->
		<!------------------->
		<!------------------->


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
$('div#photo_2').toggle();
</script>




</main>


