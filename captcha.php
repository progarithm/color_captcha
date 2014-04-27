<?php 
session_status() or session_start();
unset($_SESSION['colorcaptcha'], $_SESSION['colorcaptchapos']);
	$protocol = isset ($_SERVER['HTTPS']) ? "https://" : "http://";
	$file = $protocol.$_SERVER['HTTP_HOST'].substr( __FILE__, strlen( $_SERVER[ 'DOCUMENT_ROOT' ]));
	$path = dirname ($file);
	$path = str_replace('\\', '/', $path);
?>
<div id="cc_pointer_div" onclick="ccpoint_it(event)" style="position: relative; background-image:url('<?php echo $path;?>/captcha_control.php');width:160px;height:52px;">
	<img src="<?php echo $path;?>/cross.png" id="cc_cross"	style="position: absolute; visibility: hidden; z-index: 2;">
</div>
<input type="hidden" id="cc_clicked" />
<a onclick="change();">Reload picture</a>
<script type="text/javascript">
function ccpoint_it(event){
    pos_x = event.offsetX?(event.offsetX):event.pageX-document.getElementById("cc_pointer_div").offsetLeft;
    pos_y = event.offsetY?(event.offsetY):event.pageY-document.getElementById("cc_pointer_div").offsetTop;
    document.getElementById("cc_cross").style.left = (pos_x-8) +'px';
    document.getElementById("cc_cross").style.top = (pos_y-8) +'px';
    document.getElementById("cc_cross").style.visibility = "visible" ;  
    send(pos_x, pos_y);	
}
function change(){ 
	document.getElementById('cc_pointer_div').style.backgroundImage = "url('<?php echo $path;?>/captcha_control.php')";
	document.getElementById("cc_cross").style.visibility = "hidden";
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