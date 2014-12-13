<?php
class Db_From extends Db_Base
{
	public static function From($table)
	{
		switch(self::GetDb())
		{
			case "mysql":$sql=self::Mysql($table);break;
		}
		return $sql;
	}

	private static function Mysql($table)
	{
		$sql=" from $table ";
		return $sql;
	}
}
?>