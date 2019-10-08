<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 



if (isset($_SERVER['HTTPS']))
    $scheme = $_SERVER['HTTPS'];
else
    $scheme = '';
if (($scheme) && ($scheme != 'off')) $scheme = 'https';
else $scheme = 'http';





//upload.php

$folder_name = 'img/';
//$folder_name =$_SERVER['DOCUMENT_ROOT']."/img/"; 
$folderURL_name =$scheme."://".$_SERVER['SERVER_NAME']."/img/"; 




//загрузка файла
if(!empty($_FILES))
{
 $temp_file = $_FILES['file']['tmp_name'];
 //$location = $folder_name . $_FILES['file']['name']; 
 
 $location = $folder_name . $var . '_' . rand(100000, 999999) . '.' . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
 
 move_uploaded_file($temp_file, $location);
 
 waterMark($location,"watermark.png", "bottom=5,right=5");
 
 	$sql = 'SELECT * FROM `tovar` WHERE `id`="'.$_GET['id'].'";'; 
	
	$data = $mysqli->query($sql);
	$row = $data->num_rows;
	if($row!=0)$res = $data->fetch_assoc();
	
	$z=1;
	for($i=1;$i<16; $i++)
	{
		if( $res['photo_'.$i] !=  ""  &&  isset($res['photo_'.$i])  )
		{
			if(!file_exists($res['photo_'.$i])) {continue;}
			
		$img[$z++]=$res['photo_'.$i];	
		}
	}
	
	$mysqli->query("
	UPDATE `tovar`
	SET `photo_1`=NULL,`photo_2`=NULL,`photo_3`=NULL,`photo_4`=NULL,`photo_5`=NULL,`photo_6`=NULL,`photo_7`=NULL,
	`photo_8`=NULL,`photo_9`=NULL,`photo_10`=NULL,`photo_11`=NULL,`photo_12`=NULL,`photo_13`=NULL,`photo_14`=NULL,`photo_15`=NULL
	WHERE `id`=".$_GET['id'].";
	");
	
	$sql="UPDATE `tovar` SET ";
	
	$z=1;
	for($i=1;$i<16; $i++)
	{
		if($img[$i]!="")
		{
		$sql.="`photo_".($z++)."` = '".$img[$i]."',";
		}
	
	}
	
	$sql.="`photo_".($z)."` = '".$location."' ";
	$sql.="WHERE `id`=".$_GET['id'].";";
	
	$mysqli->query($sql);
	
	
}

if(isset($_POST["name"]))
{
 $filename = $folder_name.$_POST["name"];
 unlink($filename);
 //echo "del";
	$mysqli->query("
	UPDATE `tovar`
	SET `photo_".$_POST['nphoto']."`=NULL
	WHERE `id`=".$_POST['id'].";
	"); 
 
}

$result = array();


/////// загрузка файлов

$output.="";
//foreach ($_POST as $key => $value) {echo "<p>POST ".$key." = ".$value."</p>";} 


if(isset($_POST['id'])){
	
	$z=1; //Нумерация файла
	
	$sql = 'SELECT * FROM `tovar` WHERE `id`="'.$_POST['id'].'";'; 
	
	$data = $mysqli->query($sql);
	$row = $data->num_rows;
	if($row!=0)$res = $data->fetch_assoc();
	
	for($i=1;$i<16; $i++)
	{
		if( $res['photo_'.$i] !=  ""  &&  isset($res['photo_'.$i])  )
		{
			$file = str_replace("img/", "", $res["photo_".$i]);
			$file = str_replace("/img/", "", $file);
			
			if (file_exists("img/".$file))
			{
				$output .= '
				<div class="dz-preview dz-processing dz-success dz-complete dz-image-preview">
					<div class="dz-image" style="background-image: url('.$folderURL_name.$file.'); background-size: cover;">
						<img data-dz-thumbnail="" style="height:100%; opacity: 0;" alt="t22zj-4ap14.jpg" src="'.$folderURL_name.$file.'"/>
					</div>  
					<div class="dz-details">    
						<div class="dz-size">
						</div>    
						<div class="dz-filename">
							<span  data-dz-name="">'.$file.'</span>
						</div>  
					</div>  
					<div class="dz-progress">
						<span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span>
					</div>  
					<div class="dz-error-message">
						<span data-dz-errormessage=""></span>
					</div>  
					<div class="dz-success-mark">
						<svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"><title>Check</title><defs></defs><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>      </g>    </svg>  
					</div>  
					<div class="dz-error-mark"><svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Error</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">          <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>        </g>      </g>    </svg>  
					</div>
					<button type="button" onclick="delimg(this,\''.$i.'\');" class="btn btn-link del_image" id="'.$file.'">Remove</button>
					
				</div>';				
			}
		
		}
	}
	if($row!=0)echo $output;
}



//// отобразить все
/*
$files = scandir('img'); //папка
if(false !== $files)
{
 foreach($files as $file)
 {
  if('.' !=  $file && '..' != $file)
  {
$file="25397qqRrH2J8-4s.jpg";
$output .= '
<div class="dz-preview dz-processing dz-success dz-complete dz-image-preview">
	<div class="dz-image" style="background-image: url('.$folderURL_name.$file.'); background-size: cover;">
		<img data-dz-thumbnail="" style="height:100%; opacity: 0;" alt="t22zj-4ap14.jpg" src="'.$folderURL_name.$file.'"/>
	</div>  
	<div class="dz-details">    
		<div class="dz-size">
		</div>    
		<div class="dz-filename">
			<span data-dz-name="">'.$file.'</span>
		</div>  
	</div>  
	<div class="dz-progress">
		<span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span>
	</div>  
	<div class="dz-error-message">
		<span data-dz-errormessage=""></span>
	</div>  
	<div class="dz-success-mark">
		<svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"><title>Check</title><defs></defs><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>      </g>    </svg>  
	</div>  
	<div class="dz-error-mark"><svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Error</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">          <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>        </g>      </g>    </svg>  
	</div>
	<button type="button" class="btn btn-link remove_image" id="'.$file.'">Remove</button>
</div>';
  }
 }
}
echo $output;*/






































function waterMark($original, $watermark, $placement ='bottom=5,right=5', $destination = null) { 

	$filefolder=$original;

   $original = urldecode($original);
   $info_o = @getImageSize($original); 
   if (!$info_o) 
         return false; 
	
	/*$watermark = new Imagick($watermark);
	$watermark->adaptiveResizeImage($info_o[0],$info_o[1]);*/
	
	
	 
   $info_w = @getImageSize($watermark); 
   if (!$info_w) 
         return false; 
	 
	 
	 
 
   list ($vertical, $horizontal) = explode (',', $placement,2); 
   list($vertical, $sy) = explode ('=', trim($vertical),2); 
   list($horizontal, $sx) = explode ('=', trim($horizontal),2); 
 
   switch (trim($vertical)) { 
      case 'bottom': 
         $y = $info_o[1] - $info_w[1] - (int)$sy; 
         break; 
      case 'middle': 
         $y = ceil($info_o[1]/2) - ceil($info_w[1]/2) + (int)$sy; 
         break; 
      default: 
         $y = (int)$sy; 
         break; 
      } 
 
   switch (trim($horizontal)) { 
      case 'right': 
         $x = $info_o[0] - $info_w[0] - (int)$sx; 
         break; 
      case 'center': 
         $x = ceil($info_o[0]/2) - ceil($info_w[0]/2) + (int)$sx; 
         break; 
      default: 
         $x = (int)$sx; 
         break; 
      } 
 
    if($info_o[0]!=$info_o[1])
   {
		if($info_o[0]>$info_o[1])
		{
			$xx1=0;
			$xx2=$info_o[0];
			$yy1=($info_o[0]-$info_o[1])/2;	
			$yy2=$info_o[0];
			//$info_o[0]=$xx2;
			//$info_o[1]=$yy2;
		}
		if($info_o[0]<$info_o[1])
		{
			$xx1=0;
			$xx2=$info_o[1];
			$yy1=0;
			$yy2=$info_o[1];
			//$info_o[0]=$xx2;
			//$info_o[1]=$yy2;
		}
   }
   else
   {
	   $xx1=0;
	   $xx2=$info_o[0];	
	   $yy1=0;	
	   $yy2=$info_o[1];
	   //$info_o[0]=$xx2;
	   //$info_o[1]=$yy2;
	}
 
 
   header("Content-Type: ".$info_o['mime']); 
  
   $original = @imageCreateFromString(file_get_contents($original)); 
   
   
   $watermark = @imageCreateFromString(file_get_contents($watermark)); 
  
  
		  // Размеры новой фотки.
		$w = $info_o[0];
		$h = $info_o[1];

		if (empty($w)) {
			$w = ceil($h / ($info_w[1] / $info_w[0]));
		}
		if (empty($h)) {
			$h = ceil($w / ($info_w[0] / $info_w[1]));
		}

		$tmp = imageCreateTrueColor($w, $h);
	
			imagealphablending($tmp, true); 
			imageSaveAlpha($tmp, true);
			$transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127); 
			imagefill($tmp, 0, 0, $transparent); 
			imagecolortransparent($tmp, $transparent);    

		$tw = ceil($h / ($info_w[1]  / $info_w[0]));
		$th = ceil($w / ($info_w[0] / $info_w[1] ));
		if ($tw < $w) {
			imageCopyResampled($tmp, $watermark, ceil(($w - $tw) / 2), 0, 0, 0, $tw, $h, $info_w[0], $info_w[1]);        
		} else {
			imageCopyResampled($tmp, $watermark, 0, ceil(($h - $th) / 2), 0, 0, $w, $th, $info_w[0], $info_w[1]);    
		}            

		$watermark = $tmp;
  
  
   

   
   $out = imageCreateTrueColor($xx2,$yy2); 
   $bggg = imagecolorallocate($out, 255, 255, 255);
   imagefill($out, 0, 0, $bggg);
   
   imagealphablending($out, false);
   //imagesavealpha($out, true);
   $transparent  = imagecolorallocatealpha($out, 255, 255, 255, 0);
   
   imagefilledrectangle($out, 0, 0, $info_o[0], $info_o[1], $transparent);
   imagealphablending($out, true);
   
   
 
   imageCopy($out, $original, $xx1, $yy1, 0, 0, $info_o[0], $info_o[1]); 
 
//Здесь задаем размер изображения в которые можно добавлять Watermark
// $info_o[0] > 250 - ширина изображения должна быть больше 250 px
// $info_o[1] > 250 - высота изображения должна быть больше 250 px

 
   if( ($info_o[0] > 250) && ($info_o[1] > 250) )
   {
	   $xxx=0;//($info_o[0]/2)-($info_w[0]/2);
	   $yyy=0;//($info_o[1]/2)-($info_w[1]/2);
	   
	   imagealphablending($watermark, true);
	   
	   
   imageCopy($out, $watermark, $xxx, $yyy, 0, 0, $info_o[0], $info_o[1]);
   }
 
	//imagePng($out, '../image_name.png');
	
   switch ($info_o[2]) { 
      case 1: 
         imageGIF($out,$filefolder); 
         break; 
      case 2: 
         imageJPEG($out,$filefolder); 
         break; 
      case 3: 
         imagePNG($out,$filefolder); 
         break; 
         } 
 
   imageDestroy($out); 
   imageDestroy($original); 
   imageDestroy($watermark); 
 
   return true; 
   } 
?>