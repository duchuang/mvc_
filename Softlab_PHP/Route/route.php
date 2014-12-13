<?php
class Route
{
	public static function Start()
	{
		$C=isset($_GET['c'])?$_GET['c']:"Home";
		$a=isset($_GET['a'])?$_GET['a']:"index";
		require_once APP_PATH."/Controller/".$C."Controller.php";
		$c=new $C;
		$c->$a();
	}

	// public static function Start()
	// {
	// 	$url=$_SERVER['PHP_SELF'];

	// 	$url=split("index.php", $url);

	// 	if($url[1]!="")
	// 	{
	// 		$url=str_replace(".html", "", $url[1]);
	// 		$arr=split("/", $url);
	// 		require_once APP_PATH."/Controller/".$arr[1]."Controller.php";
	// 		$c=new $arr[1];
	// 		$c->$arr[2]();
	// 	}
	// 	else
	// 	{
	// 		require_once APP_PATH."/Controller/HomeController.php";
	// 		$c=new Home();
	// 		$c->index();
	// 	}
	// }
}
?>