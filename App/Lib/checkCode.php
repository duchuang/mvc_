<?php
class Code {
	public function checkcode() {
		session_start();
		header("content-type: image/png");
		$checkCode="";
		for($i=0;$i<4;$i++){
			$checkCode.=dechex(rand(1,5));
		}
		$_SESSION['myCheckCode']=$checkCode;
		// 创建图片并把随机数画上去
		$img=imagecreatetruecolor(80,32);
		// 背景颜色默认就是黑色
		// 你可以指定背景颜色
		$bgcolor=imagecolorallocate($img,255,255,255);
		imagefill($img,0,0,$bgcolor);

		// 画出干扰线段
		for($i=0;$i<6;$i++){
			imageline($img,rand(0,110),rand(0,30),rand(0,110),rand(0,30),
			imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255)
			));
		}
		for($i=0;$i<500;$i++)
		{
			imagesetpixel($img,rand(0,110),rand(0,30),imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255)
			));
		}

		// 把四个随机值画上去
		imagestring($img,5,25,7,$checkCode,imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255)));

		imagepng($img);
	}
}
?>