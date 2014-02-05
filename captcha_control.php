<?php
	session_start();
	$size = 25;
	if ( isset($_GET['x'] )) {
		$_SESSION['colorcaptcha'] =	( $_GET['x'] >= $_SESSION['colorcaptchapos']['x']  && $_GET['x'] <= $_SESSION['colorcaptchapos']['x'] + $size &&
			$_GET['y'] >= $_SESSION['colorcaptchapos']['y']  && $_GET['y'] <= $_SESSION['colorcaptchapos']['y'] + $size ) ? true : false; 
	}
	else {
  	header('Content-type: image/JPG'); 
	$im = imagecreatetruecolor(160, 52);
	$bg =	ImageColorAllocate($im, 255,255,200);
	$colors = array (
		"aqua" => "0,255,255",
		"black" => "0,0,0",
		"blue" => "0,0,255",
		"green" => "0,128,0",
		"lime" => "0,255,0",
		"magenta" => "255,0,255",
		//"maroon" => "128,0,0",
		"orange" => "255,165,0",
		"purple" => "128,0,128",
		"red" => "255,0,0",
		"silver" => "192,192,192",
		"yellow" => "255,255,0",
		"white" => "255,255,255"
	);
	
	$cols = array_keys($colors);
	shuffle($cols);
	$true = rand(0,count($cols) - 1);
	$_SESSION['colorcaptchapos']['x'] = ($true - ( ($true > 5) ? 6 : 0 )) * ($size + 2);
	$_SESSION['colorcaptchapos']['y'] = ($true > 5 ? 1 : 0) * ($size + 2);
	$token = $cols[$true];
	imagefill($im,0,0,$bg);
	
	$i = 0;
	$startX = 0;
	$startY = 0;
	foreach ($cols as $color){
		$hex = explode(',', $colors[$color]);
		imagefilledrectangle ( $im ,$startX ,$startY , $startX + $size, $startY + $size, imagecolorallocate($im, $hex[0],$hex[1],$hex[2]));
		if ( $startX > $size * 5) {
			$startX = 0;
			$startY += $size + 2;
		} else {
			$startX += $size + 2;
		}
	}
	
	writeText($im, $token);
	imagejpeg ( $im, null, 99 );
	}
function writeText($im, $token) {
	$size = 5;
	$poistionX = rand(1, 26);
	$poistionY = rand(1, 34);
	$text_color = imagecolorallocate($im, 255, 255, 255);
	$contoure_color = imagecolorallocate($im, 0, 0, 0);
	$text = "Click on {$token}";
	imagestring ( $im, 5, $poistionX - 1, $poistionY, $text, $contoure_color );
	imagestring ( $im, 5, $poistionX, $poistionY -1, $text, $contoure_color );
	imagestring ( $im, 5, $poistionX + 1, $poistionY, $text, $contoure_color );
	imagestring ( $im, 5, $poistionX, $poistionY + 1 , $text, $contoure_color );
	imagestring ( $im, 5, $poistionX, $poistionY, $text, $text_color );
}

?>