<?php 

require "src/Captcha.php";

$captcha = new CaptchaImageMaker;
var_dump($captcha->make());