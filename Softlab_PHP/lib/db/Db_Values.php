<?php
class Db_Values extends Db_Base
{
	public static function Values($arr)
	{
		switch(self::GetDb())
		{
			case "mysql":$sql=self::Mysql($arr);break;
		}
		return $sql;
	}
	

	private static function Mysql($arr)
	{
		$sql=" values (NULL,'";
		foreach($arr as $data)
		{
			$sql.= implode("','",$data);
		}
		return $sql.="')";
	}
}