<? 
waterMark($_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'],
 "watermark.png", "bottom=5,right=5"); 
 
function waterMark($original, $watermark, $placement = 
'bottom=5,right=5', $destination = null) { 


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
		/*if($info_o[0]>$info_o[1])
		{
			$xx1=($info_o[0]-$info_o[1])/2;
			$xx2=$info_o[1];
			$yy1=0;	
			$yy2=$info_o[1];
			$info_o[0]=$xx2;
			$info_o[1]=$yy2;
		}
		if($info_o[0]<$info_o[1])
		{
			$xx1=0;
			$xx2=$info_o[0];
			$yy1=($info_o[1]-$info_o[0])/2;
			$yy2=$info_o[0];
			$info_o[0]=$xx2;
			$info_o[1]=$yy2;
		}*/
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
 
   switch ($info_o[2]) { 
      case 1: 
         imageGIF($out); 
         break; 
      case 2: 
         imageJPEG($out); 
         break; 
      case 3: 
         imagePNG($out); 
         break; 
         } 
 
   imageDestroy($out); 
   imageDestroy($original); 
   imageDestroy($watermark); 
 
   return true; 
   } 
?>