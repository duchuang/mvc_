<?php
class Db_Order extends Db_Base
{
	public static function Order($arr)
	{
		switch(self::GetDb())
		{
			case "mysql":$sql=self::Mysql($arr);break;
		}
		return $sql;
	}

	private static function Mysql($arr)
	{
		$sql="order by ";
		foreach ($arr as $key) 
		{
			$sql.=$key[0]." ".$key[1]." ";
		}
		return $sql;
	}
}
?>