<?php
class Db_Where extends Db_Base
{
	public static function Where($where)
	{
		switch(self::GetDb())
		{
			case "mysql":$sql=self::Mysql($where);break;
		}
		return $sql;
	}

	private static function Mysql($where)
	{
		$sql="where ";
		foreach($where as $data)
		{
			if(isset($data[3]))
			{
				$sql=$sql.$data[0].$data[1].$data[2]." ".$data[3];
			}
			else if(isset($data[2]))
			{
				$sql=$sql.$data[0].$data[1].$data[2];
			}
			else
			{
				$sql=$sql.$data[0]." = ".$data[1];
			}

		}
		// foreach ($where as $key => $value) {
		// 	$sql=$sql.$key[0];
		// }
		// var_dump($sql);
		
		return $sql;
		
	}
}
?>