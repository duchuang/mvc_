<?php
class Db_Limit extends Db_Base
{
	public static function Limit($arr)
	{
		switch(self::GetDb())
		{
			case "mysql":$sql=self::Mysql($arr);break;
		}
		return $sql;
	}

	private static function Mysql($arr)
	{
		$sql="limit ";
		foreach($arr as $data)
		{
			$sql.=$data[0].','.$data[1];
		}
		return $sql;
	}
}
?>