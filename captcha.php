<?php 
session_start();
unset($_SESSION['colorcaptcha'], $_SESSION['colorcaptchapos']);
	$protocol = isset ($_SERVER['HTTPS']) ? "https://" : "http://";
	$file = $protocol.$_SERVER['HTTP_HOST'].substr( __FILE__, strlen( $_SERVER[ 'DOCUMENT_ROOT' ]));
	$path = dirname ($file);
?>
<div id="pointer_div" onclick="point_it(event)" style="background-image:url('<?php echo $path;?>/captcha_control.php');width:160px;height:52px;">
	<img src="<?php echo $path;?>/cross.png" id="cross"	style="position: relative; visibility: hidden; z-index: 2;">
</div>
<input type="hidden" id="cc_clicked" />
<a href="#" onclick="change();">Reload picture</a>
<script type="text/javascript">
function point_it(event){
    pos_x = event.offsetX?(event.offsetX):event.pageX-document.getElementById("pointer_div").offsetLeft;
    pos_y = event.offsetY?(event.offsetY):event.pageY-document.getElementById("pointer_div").offsetTop;
    document.getElementById("cross").style.left = (pos_x-8) ;
    document.getElementById("cross").style.top = (pos_y-8) ;
    document.getElementById("cross").style.visibility = "visible" ;  
    send(pos_x, pos_y);	
}
function change(){ 
	document.getElementById('pointer_div').style.backgroundImage = "url('<?php echo $path;?>/captcha_control.php')";
	document.getElementById("cross").style.visibility = "hidden";
	document.getElementById('cc_clicked').value = 'true';
}
function send(x,y)
{
var xmlhttp;
if (window.XMLHttpRequest){
  xmlhttp=new XMLHttpRequest();
}
else {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    document.getElementById('cc_clicked').value = 'true';
  }
}
parameters = "x=" + x + "&y=" + y;
xmlhttp.open("GET",'<?php echo $path;?>/captcha_control.php?'+parameters,true);
xmlhttp.send();
}
</script>