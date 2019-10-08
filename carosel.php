 <style type="text/css">
    .slider {
	box-sizing: border-box;
        width: 90%;
        margin: 50px auto;
    }

    .slick-slide {
	box-sizing: border-box;
      margin: 0px 0px;
    }

    .slick-slide img {
	box-sizing: border-box;
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
	box-sizing: border-box;
      color: black;
    }


    .slick-slide {
	    cursor: pointer;
	box-sizing: border-box;
      transition: all ease-in-out .3s;
      opacity: .3;
    }

    div.slick-active {
	    cursor: pointer;
	box-sizing: border-box;
      opacity: .8;
	 box-shadow:0px 0px 23px 1px rgba(0,0,0,0.29);
	-webkit-box-shadow:0px 0px 23px 1px rgba(0,0,0,0.29);
	-moz-box-shadow:0px 0px 23px 1px rgba(0,0,0,0.29);
    }

    div.slick-current {
	    cursor: pointer;
	box-sizing: border-box;
      opacity: 1;
	  transition: 0.3s;
	   transform: translateZ(1px);
	  	box-shadow:0px 0px 23px 1px rgba(0,0,0,0.29);
	-webkit-box-shadow:0px 0px 23px 1px rgba(0,0,0,0.29);
	-moz-box-shadow:0px 0px 23px 1px rgba(0,0,0,0.29);
    }


  </style>
  
 <section class="hidden-xs hidden-sm regular slider" style="opacity:0;" onclick="">
 <?
 //random news/////////////////////////////////
$sqlrn = 'SELECT * FROM `tovar`  WHERE `active`!="no" and `dost`!="0"  ORDER BY RAND() LIMIT 5;';
$datarn = $mysqli->query($sqlrn);
$rowrn = $datarn->num_rows;
$duble="";
while($resrn = $datarn->fetch_assoc())
{
		for($i=1;$i<=16;$i++)
		{
			if($i==16)
			{
				$mysqli->query("UPDATE `tovar` SET `active` = 'no'	WHERE `id`=".$resrn['id'].";");
				echo "<script>location.href=location.href;</script>";
				break;
			}
			if(($resrn['photo_'.$i]!=NULL)&&($resrn['photo_'.$i]!=''))
			{
				$img5=$resrn['photo_'.$i];
				break;
			}

		}
	
    echo '<div> ';
	echo '	<div style="text-align:center;color:#000; background-image: url('.$img5.');    background-size: cover;">';
	echo '		<div style="position: absolute;  height: 90%; top: 50%; margin-left:40px;width: 18vw; opacity:1;">';
	echo '			<span onclick="" style="font-size: 22px; transform: perspective(6px) rotateY(0.5deg); font-weight: 400;background:#fff;     display: block; padding: 5px 20px;">'.$resrn['name_print'].'</span>';
	echo '		</div>';
	$jsss="locationgo('".$resrn['url']."');";
	$jsssup="up();";
	$jsssdown="down();";
	echo '		<img onmousedown="'.$jsssdown.'" onmouseup="'.$jsssup.'" onclick="'.$jsss.'" style="opacity:0;width:350px;height:300px; " src="'.$img5.'">';
	echo '	</div>';
	echo '</div>';
	
	if($rowrn<4){
			$jsss="locationgo('".$resrn['url']."');";
			$jsssup="up();";
			$jsssdown="down();";
			
		$duble = $duble. '<div> ';
		$duble = $duble. '	<div style="text-align:center;color:#000; background-image: url('.$img5.');    background-size: cover;">';
		$duble = $duble. '		<div style="position: absolute;  height: 90%; top: 50%; margin-left:40px;width: 18vw; opacity:1;">';
		$duble = $duble. '			<span onclick="" style="font-size: 22px; transform: perspective(6px) rotateY(0.5deg); font-weight: 400;background:#fff;     display: block; padding: 5px 20px;">'.$resrn['name_print'].'</span>';
		$duble = $duble. '		</div>';
			
		$duble = $duble. '		<img onmousedown="'.$jsssdown.'" onmouseup="'.$jsssup.'" onclick="'.$jsss.'" style="opacity:0;width:350px;height:300px; " src="'.$img5.'">';
		$duble = $duble. '	</div>';
		$duble = $duble. '</div>';	
	}
}
echo $duble;
 ?>
 </section>
  
  
  <script src="./slick/jquery-1.8.2.min.js" type="text/javascript"></script>
  <script src="./slick/slick.min.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).on('ready', function() {
      $(".regular").slick({
        dots: true,
        infinite: true,
		centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
	  $(".regular")[0].style.opacity="1";
	  
	
    });
	var slicknextparam = setInterval('slicknext()', 5000);
	function slicknext(){
		$('button.slick-next.slick-arrow').click();
	}
	
	var x1=0;
	var x2=0;
	function up(){x2=event.clientX;}
	function down()	{x1=event.clientX;	clearInterval(slicknextparam);}
	function locationgo(x){
	if(x1==x2)location.href=x;
	}
</script>