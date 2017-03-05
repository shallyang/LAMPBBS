<?php
function makeCode($width=80,$height=30,$codelen=4,$pixelNum=80,$arcNum=10){
    //开启session服务
    session_start();
	/* 验证码的制作,数目指定,验证码随机 ,有干扰元素*/
	// 准备验证码
	$str = '1234567890qwertyuiopasdfghjklzxcvbnm';
	$str1 = str_shuffle($str); 
	$code = substr($str1,4,$codelen);
	// echo $code;
	/* 输出验证码 */
	// 画布
	$img = imagecreatetruecolor($width,$height);

	// 颜色
	$red = imagecolorallocate($img,255,0,0);
	$green = imagecolorallocate($img,0,255,0);
	$blue = imagecolorallocate($img,0,0,255);

	// 打印到画布
	imagefill($img,0,0,imagecolorallocate($img,rand(175,255),rand(175,255),rand(175,255)));
	// imagestring($img,5,0,0,$code,$red);
	imagettftext($img,20,0,rand(0,35),rand(20,$height-5),imagecolorallocate($img,rand(0,100),rand(0,100),rand(0,100)),'fonts/simfang.ttf',$code);
	for($i=0;$i<$pixelNum;$i++){
		imagesetpixel($img,rand(0,80),rand(0,30),imagecolorallocate($img,rand(80,150),rand(80,150),rand(80,150)));
	}

	// for($i=0;$i<5;$i++){
		// imageline($img,rand(0,80),rand(0,80),rand(0,30),rand(0,30),$red);
	// }
	for($i=0;$i<$arcNum;$i++){
		imagearc($img,rand(0,80),rand(0,30),rand(0,100),rand(0,100),rand(0,360),rand(0,360),imagecolorallocate($img,rand(80,150),rand(80,150),rand(80,150)));
	}
	// 输出画布
	header('content-type:image/png');
	imagepng($img);

	// 销毁画布
	imagedestroy($img);
    //session 获取验证码
    $_SESSION['code'] = $code;
}

makeCode();












