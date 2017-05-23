<?php 

class CaptchaImageMaker {

	public function generateRandomString(): string {
		$string = md5(sha1(time()));
		$string = substr($string, 0, 8).rand(0,100);
		return $string;
	}

	public function make(): bool {
		return imagedestroy($this->createCaptchaImage());
	}

	public function createCaptchaImage() {

		//putenv('GDFONTPATH=' . realpath('.'));
		$font			=	'./fonts/font.ttf';
		$img 			=	imagecreate(200, 100);
		$background 	= 	imagecreatefrompng("images/background.png");
		imagecolorallocate($img, 102, 153, 255);
		$textColor		=	imagecolorallocate($img, 0, 0, 0);

		imagecopymerge($img, $background, 100, 0, 100, 0, 100, 200,100);
		imagepolygon($img, [0,50,200,50,200,51], 3, imagecolorallocate($img, 255, 0, 0));
		imageline($img, 0, 0, 200, 100, $textColor);
		imagearc($img, 100, 50, 200, 100, 200, 200, $textColor);
		imagefttext($img, 20, -10, 40, 50, $textColor, $font, $this->generateRandomString()." 
			".substr(base64_encode(time()),-4));imagepng($img, "images/cap.png");

		return $img;
		
	}

}