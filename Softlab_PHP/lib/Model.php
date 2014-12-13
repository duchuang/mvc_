<?php
class Model extends Db
{
	public function Create()
	{
		$res=$this->Exec();
		$a=array();
		foreach ($res as $arr) 
		{
			foreach ($arr as $key => $value) 
			{
				$this->$key=$value;
			}
			$a[]=$this;
		}
		return $a;
	}

	public static function Init()
	{
		return new Self;
	}
}
?>