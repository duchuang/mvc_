<?php
class Db_Insert extends Db_Base
{
	public static function Insert($arr)
	{
		switch(self::GetDb())
		{
			case "mysql":$sql=self::Mysql($arr);break;
		}
		return $sql;
	}
	

	private static function Mysql($arr)
	{
		$sql="insert into ";
		$sql.=$arr;
		return $sql;
	}
}
?>