<?php
class check 
{
	public function checkget($get)
	{
		if(preg_match('/[a-zA-Z0-9]{6,15}/',$get,$match))
		{
			return $match[0]==$get;
		}
		else 
			{
				return 0;
			}
	}

	public function checkemail($get)
	{
		if(preg_match('/[a-zA-Z0-9].*@.*\.com/',$get,$match))
		{
			return $match[0]==$get;
		}
		else 
			{
				return 0;
			}
	}
}
?>