<?php
class Log
{
	const LOGFILE = 'log';

	public static function write($cont)
	{
		$cont .= "|";
		$log = self::isBak();
		$fh = fopen($log,'ab');
		fwrite($fh,$cont);
		fclose($fh);
	}

	public static function bak() 
	{
		$log = 'e:/workspace/softlab_b128/SoftLab_PHP/lib/data/log/'.self::LOGFILE;
		$bak = 'e:/workspace/softlab_b128/SoftLab_PHP/lib/data/log/'.data('ymd').me_rand(10000,99999).'.bak';
		rename($log,$bak);
	}
	public static function isBak() 
	{
		$log = 'e:/workspace/softlab_b128/SoftLab_PHP/lib/data/log/'.self::LOGFILE;
		if(!file_exists($log))
		{
			touch($log);
			return $log;
		}

		clearstatcache(true,$log);
		$size = filesize($log);
		if($size <= 1024*1024)
		{
			return $log;
		}
		if(!self::Bak())
		{
			return $log;
		} else {
			touch($log);
			return $log;
		}
	}
}

?>