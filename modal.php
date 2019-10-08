<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 


$sql = 'SELECT * FROM `tovar` WHERE `id`='.$_POST['id'].'';
$data = $mysqli->query($sql);
$row = $data->num_rows;
$res = $data->fetch_assoc();


?>


<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
    <div class="modal-product">
        <!-- Start product images -->
        <div class="product-images">
            <div class="main-image images">
				<a href="<?echo $res['url'];?>">
                <img style="max-height:400px;" alt="<?echo $res['name'];?>" src="<?echo $res['photo_1'];?>">
				</a>
            </div>
        </div>
        <!-- end product images -->
        <div class="product-info">
            <h1><?echo $res['name'];?></h1>
            <div class="rating__and__review">
                <div class="review">
					<a href="#">Понравилось <?echo $res['laik'];?></a>
                </div>
            </div>
            <div class="price-box-3">
                <div class="s-price-box">
					<span class="new-price"><?echo ''.number_format((int)$res['sum_p'], 2, '.',' ').' р';?></span>
					<span class="old-price"><?echo ''.number_format((int)$res['sum_p']*1.521, 2, '.',' ').' р';?></span>
                </div>
            </div>
            <div class="quick-desc">
                <?echo $res['comment'];?>
            </div>
            <div class="select__color">
			<?	if( isset($res['color1']) || isset($res['color2']) || isset($res['color3']) || isset($res['color4']) || isset($res['color5']) || isset($res['color6']) )
				{
				
                echo '<h2>Цвет</h2>
                <ul class="color__list">';
				
				if(isset($res['color1'])){	echo '<li class="'.$res['color1'].'"><a>'.$res['color1'].'</a></li>';}
				if(isset($res['color2'])){	echo '<li class="'.$res['color2'].'"><a>'.$res['color2'].'</a></li>';}
				if(isset($res['color3'])){	echo '<li class="'.$res['color3'].'"><a>'.$res['color3'].'</a></li>';}
				if(isset($res['color4'])){	echo '<li class="'.$res['color4'].'"><a>'.$res['color4'].'</a></li>';}
				if(isset($res['color5'])){	echo '<li class="'.$res['color5'].'"><a>'.$res['color5'].'</a></li>';}
				if(isset($res['color6'])){	echo '<li class="'.$res['color6'].'"><a>'.$res['color6'].'</a></li>';}
				echo '</ul>';
				}
				?>
               
            </div>
            <div class="select__size">
			<?
			if( isset($res['razm1']) || isset($res['razm2']) || isset($res['razm3']) || isset($res['razm4']) || isset($res['razm5']) || isset($res['razm6']) )
			{
			echo '<h2>Размеры</h2><ul class="color__list">';
                                
            if(isset($res['razm1'])){ echo '<li class="l__size"><a>'.$res['razm1'].'</a></li>';}
			if(isset($res['razm2'])){ echo '<li class="l__size"><a>'.$res['razm2'].'</a></li>';}
			if(isset($res['razm3'])){ echo '<li class="l__size"><a>'.$res['razm3'].'</a></li>';}
			if(isset($res['razm4'])){ echo '<li class="l__size"><a>'.$res['razm4'].'</a></li>';}
			if(isset($res['razm5'])){ echo '<li class="l__size"><a>'.$res['razm5'].'</a></li>';}
			if(isset($res['razm6'])){ echo '<li class="l__size"><a>'.$res['razm6'].'</a></li>';}
                                    
										
			echo '</ul>';
			}
			?>
            </div>
            <div class="addtocart-btn">
				<a title="Просмотреть товар" href="<?echo $res['url'];?>"><span class="ti-arrow-right"></span></a>
                
				
            </div>
        </div><!-- .product-info -->
    </div><!-- .modal-product -->
</div><!-- .modal-body -->

            