<?php
class Db_Delete extends Db_Base
{
	public static function Delete($arr)
	{
		switch(self::GetDb())
		{
			case "mysql":$sql=self::Mysql($arr);break;
		}
		return $sql;
	}

	private static function Mysql($arr)
	{
		$sql="delete";
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