<?php
class Common 
{
	public static function Start()
	{
		if(isset($_GET["c"])&&isset($_GET["a"])&&($_GET["c"]=="admin"&&$_GET["a"]!="login"&&$_GET["a"]!="checklogin"))
		{
			session_start();
			if(!isset($_SESSION["softlab_b128"]))
			{
				header("Location:?c=admin&a=login");
			}
		}
	}
}
?>