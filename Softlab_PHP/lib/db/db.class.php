<?php
// require_once "Db_Base.php";
// require_once "Db_Select.php";
// require_once "Db_Insert.php";
// require_once "Db_Values.php";
// require_once "Db_Delete.php";
// require_once "Db_From.php";
// require_once "Db_Update.php";
// require_once "Db_Where.php";
// require_once "Db_Limit.php";
// require_once "Db_Order.php";

function __autoload($class) 
{
	require($class . '.php');
}

class Db
{
	private $sql;
	private static $link;
	// public static $link;
	// public $dbname   ="softlab";
	// public $username ="root";
	// public $password ="duchuang";
	// public $host     ="localhost";

	// public function __construct() 
	// {
	// 	if(!self::$link)
	// 		self::$link = mysql_connect ($this->host,$this->username,$this->password);
 //            mysql_query("use $this->dbname",self::$link);
	// }

	// public function insert($sql) 
	// {
	// 	$res = mysql_query($sql,self::$link) or die(mysql_error());
	// 	return $res;
	// }

	// public function delete($sql)
	// {
	// 	$res = mysql_query($sql,self::$link) or die(mysql_error());
	// 	return $res;
	// }

	// public function update($sql) 
	// {
	// 	$res = mysql_query($sql,self::$link) or die(mysql_error());
	// 	return $res;
	// }

	// public function getRow($sql)
	// {
	// 	$res = mysql_query($sql,self::$link) or die(mysql_error());
	// 	return mysql_fetch_assoc($res);
	// }

	// public function getAll($sql)
	// {
	// 	$arr = array();
	// 	$res = mysql_query($sql,self::$link) or die(mysql_error());
	// 	while ($row = mysql_fetch_assoc($res))
	//     {
	// 		$arr[] = $row;
	// 	}
	// 	mysql_free_result($res);
	// 	return $arr;
	// }

	// public function close_connect()
	// {
	// 	if(!empty(self::$link))
	// 	{
	// 		mysql_close(self::$link);
	// 	}
	// }
	public function Db()
	{
		if(!self::$link)
			self::$link=new mysqli(config::$db["db_host"],config::$db["db_username"],config::$db["db_password"],config::$db["db_database"]);
	}

	public function Update($data) 
	{
		$this->sql.=Db_Update::Update($data);
		return $this;
	}

	public function Insert($data) 
	{
		$this->sql.=Db_Insert::Insert($data);
		return $this;
	}

	public function Order($data) 
	{
		$this->sql.=Db_Order::Order($data);
		return $this;
	}

	public function Values($data) 
	{
		$this->sql.=Db_Values::Values($data);
		
		return $this;
	}

	public function Delete($data) 
	{
		$this->sql.=Db_Delete::Delete($data);
		return $this;
	}

	public function Select($data)
	{
		$this->sql=Db_Select::Select($data);
		return $this;
	}

	public function Limit($arr)
	{
		$this->sql.=Db_Limit::Limit($arr);
		return $this;
	}

	public function From($table)
	{
		$this->sql.=Db_From::From($table);
		return $this;
	}

	public function Where($where)
	{
		$this->sql.=Db_Where::Where($where);
		return $this;
	}

	public function Exec()
	{
		Log::write($this->sql);
		//self::$link->query("set names gb2312");
		$res=self::$link->query($this->sql);
		//var_dump($this->sql);die;
		if(!is_bool($res))
		{
			$arr = array();
			while ($row = $res->fetch_assoc())
			{
				$arr[] = $row;
			}
	 		return $arr;
		}
		else
		{
	 		return $res;
		}
	}
}
?>