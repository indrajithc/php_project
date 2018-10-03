<?php
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');



if(  IS_AJAX  ) {
	 $x_ = $_POST['x']; 
	 $y_   = $_POST['y']; 
	 $w_   = $_POST['w']; 
	 $h_   = $_POST['h']; 
	 $photo_url_   = $_POST['photo_url']; 
	 $TARGET_W   = $_POST['targ_w']; 
	 $TARGET_H   = $_POST['targ_h']; 
	 $sest_utl_p_  = $_POST['sest_utl_p_']; 


 	 $x_ = floor($x_);
	 $y_   = floor($y_);
	 $w_   = floor($w_);
	 $h_   = floor($h_);

	 $TARGET_W   = floor($TARGET_W);
	 $TARGET_H   = floor($TARGET_H); 


	$url = $_SERVER['REQUEST_URI']; //returns the current URL
	$parts = explode('/',$url);
	$dir = $_SERVER['SERVER_NAME'];
	for ($i = 0; $i < count($parts) - 1; $i++) {
	 $dir .= $parts[$i] . "/";
	} 




 
	$jpeg_quality = 90;
 
	$src0 = $photo_url_ ;
	$src =  'uploads/'.$src0; 

	$success =0;

	 try {

 $allowed_formats = array(
        "jpg",
        "png",
        "gif",
        "bmp"
    );
     
    list($name, $ext) = explode(".", $photo_url_);
    if (!in_array($ext, $allowed_formats))
    {
        $err = "<strong>Oh snap!</strong>Invalid file formats only use jpg,png,gif";
        return false;
    }

    if ($ext == "jpg" || $ext == "jpeg")
    {
        $img_r = imagecreatefromjpeg($src);
    }
    else
    if ($ext == "png")
    {
        $img_r = imagecreatefrompng($src);
    }
    else
    {
        $img_r = imagecreatefromgif($src);
    }
 

 

   
		$dst_r = ImageCreateTrueColor( $TARGET_W, $TARGET_H );

		imagecopyresampled($dst_r,$img_r,0,0,$x_,$y_, $TARGET_W,$TARGET_H,$w_,$h_);

		imagejpeg($dst_r,  $sest_utl_p_.$photo_url_ ,$jpeg_quality);

		 
		if (file_exists($src)) {
		    unlink($src); 
		  } 

	 } catch ( Exception $a) {
	 	
	 }
		if (file_exists($sest_utl_p_.$photo_url_)) {
			$success = 1;
		  } 

	 
		echo json_encode(array('success'=> $success,
								 'name' =>  $photo_url_, 
								'path'  => $sest_utl_p_ ,
								'folder'=>basename($sest_utl_p_),
								'full' => $dir.$sest_utl_p_.$photo_url_ 
					 			));

 

	exit;
}

 
?>














 