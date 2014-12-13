<?php
class Db_Base
{
	public static function GetDb()
	{
		return config::$db["db_type"];
	}
}
?>