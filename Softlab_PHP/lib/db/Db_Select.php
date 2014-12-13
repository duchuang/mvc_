<?php
class Db_Select extends Db_Base
{
	public static function Select($arr)
	{
		switch(self::GetDb())
		{
			case "mysql":$sql=self::Mysql($arr);break;
		}
		return $sql;
	}

	private static function Mysql($arr)
	{
		$sql="select ";
		if(sizeof($arr)==1)
		{
			$sql.=$arr;
		}
		else
		{
			foreach ($arr as $value) 
			{
				$sql=$sql.$value.",";
			}
			$sql=substr($sql, -1);
		}
		return $sql;
	}
}
?>