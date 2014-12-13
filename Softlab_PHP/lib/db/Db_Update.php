<?php
class Db_Update extends Db_Base
{
	public static function Update($arr)
	{
		switch(self::GetDb())
		{
			case "mysql":$sql=self::Mysql($arr);break;
		}
		return $sql;
	}
	

	private static function Mysql($arr)
	{
		$sql="update $arr[0] set $arr[1] = '$arr[2]',$arr[3] = '$arr[4]',$arr[5] = '$arr[6]',$arr[7] = '$arr[8]',$arr[9] = '$arr[10]' ";
		return $sql;
	}
}