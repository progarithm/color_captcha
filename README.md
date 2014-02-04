Why color captcha?
=============
The color captcha is a simple human validation tool, where users pick a color from image instead of typing the secret code which is realy boring process.

Example
--------------
![alt tag](https://raw.github.com/vaheshadunts/color_captcha/master/example.jpg)

How to use?
--------------
Using color captcha is very easy, just ```include('captcha.php')``` in script and the captcha image will appear like it shown in example.

After form submission ```$_SESSION['colorcaptcha']``` will be ```true``` if user picked up right color, otherwise it will be ```false```.

JavasScript validation
--------------
The value of hidden field with ```cc_clicked``` id, becames to ```true``` when user clicks on image.

Secureness
--------------
Positive side: There are many OCR tools already for traditional captchas.
Negative side: Color captcha is less secure then tradionals.

Requirements
--------------
 - PHP
 - PHP-GD
