<?php
class Controller
{
	private static $arr=Array();
	private static $arrFor=Array();
	public function Show($fileName=null)
	{
		if(!isset($fileName))
			$fileName=APP_PATH."/Views/".(isset($_GET["c"])?$_GET["c"]:"Home")."/".(isset($_GET["a"])?$_GET["a"]:"index").".html";
		$f=fopen($fileName, "r");
		$text=fread($f, filesize($fileName));
		fclose($f);
		$text=$this->Replace($text,self::$arr);
		echo $this->ForReplace($text,self::$arrFor);
	}

	public function DataContext($str,$value,$type)
	{
		switch ($type) {
			case 'string':
				$i=sizeof(self::$arr);
				self::$arr[$i]=Array("sub"=>"@$str","str"=>$value);
				break;
			case 'for':
				self::$arrFor[$str]=$value;
				break;
		}
		
	}

	private function Replace($text,$arr)
	{
		foreach($arr as $a)
		{
			$text=str_replace($a["sub"], $a["str"], $text);
		}
		return $text;
	}

	private function ForReplace($text,$arr)
	{
		foreach ($arr as $key => $value) 
		{
			$str_1="@foreach_$key";
			$str_2="@forend_$key";
			$array=split("$str_1", $text);
			$array_end=split("$str_2",$array[1]);
			$array[1]=$array_end[0];
			$array[2]=$array_end[1];
	
			foreach ($value as $a) 
			{
				$str=$array[1];
							
				foreach ($a as $key_2 => $value_2) 
				{
					$str=str_replace("@".$key_2, $value_2, $str);
				}

				$array[0].=$str;
			}
			$text=$array[0].$array[2];

		}
		return $text;
	}


}
?>