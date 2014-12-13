<?php
require_once APP_PATH.'/Lib/checkCode.php';
require_once APP_PATH.'/Lib/check.php';
class Home extends Controller
{
	public function index()
	{
		// $a=Array();
		// $sqlDb = new SqlDb();
		// 	$sql = "select * from user";
		// 	$res = $sqlDb->getAll($sql);
		// // $a[0]=Array("1"=>"sfsdf","2"=>"1234");
		// // $a[1]=Array("1"=>"sadasd","2"=>"3456");
		// 	$sql = "select * from news";
		// 	$res2 = $sqlDb->getAll($sql);
		// 	$this->DataContext("name1",$res2,"for");
		// $this->DataContext("name","liguifa","string");
		// $this->DataContext("name2",$res,"for");
		 //$db=new Db();

		 // $arr[0]=array(0 => "user_id",1 => "=",2 => "9");
		 // $res=$db->Select("*")->From("user")->Where($arr)->Exec();
			//var_dump($res);
		//print_r($res[0]['username']);

		// $res=$db->Delete("")->From("user")->Where($arr)->Exec();
		// var_dump($res);
		 // $arr[0]=array(0 => "5555",1 => "sdffd",2 => "sdfsf",3 => "5sdf@qq.com",4 => "1");
		 // $res=$db->Insert("user")->Values($arr)->Exec();
		//  var_dump($res);
		// $arr[0]=array(0 => "user_id",1 => "2");
		// $arrup=array("user","username","sdfs11111sd");
		// $res=$db->Update($arrup)->Where($arr)->Exec();
		// var_dump($res);
		 $this->Show();
	}

	public function news()
	{
		$page=isset($_POST["page"])?$_POST["page"]:1;
		$db = new Db();
		$pa = ($page-1)*20;
		$arr=array(array("$pa","20"));
		$res=$db->Select("*")->From("news")->Limit($arr)->Exec();
		// echo $res[0]['news_title'];
		$this->DataContext("news",$res,"for");
		$this->Show();
	}

	public function newsMore()
	{
		$page=$_POST['page'];
		$db = new Db();
		$count=$db->Select("count(*) as num")->From("news")->Exec();
		if($count[0]["num"] > ($page-1)*20+1)
		{
			$arr[0] = array(0 => ($page-1)*20+1, 1=>20);
			$res=$db->Select("*")->From("news")->Limit($arr)->Exec();
			$json = "{\"total\":\"20\",\"row\":[";
			foreach($res as $arr)
			{
				$json.=json_encode($arr);
				$json.=",";
			}

			$json=substr($json,0,-1);
			$json.="]}";
			echo $json;
		} else {
			$message = array( "status" => "no");
			echo json_encode($message);
		}
	}


	public function forum()
	{
		$sqlDb = new SqlDb();
		$sql = "select * from forum";
		$res = $sqlDb->getRow($sql);
		echo $res['forum_content'];
		$this->Show();
	}


	public function upload()
	{
		$this->Show("");
	}

	public function checkupload()
	{
		$dir = str_replace('\\','/',dirname(dirname(__FILE__))); 
    	$upload_dir = $dir.'/upload/';
    	if(isset($_FILES['files']))
    	{	//var_dump($_FILES['files']);
    		$tem_name = $_FILES['files']['tmp_name'];
    		if($tem_name!=""&&($_FILES["files"]["size"] < 20000))
    		{
	      		$file_name = $_FILES['files']['name'];
	    		$file_name = time().basename($file_name);
	    		move_uploaded_file($tem_name,$upload_dir.$file_name);
	    		$this->Show();
    		}
    	  else
    	  {echo "false";}
			
    	}
		
	}

	public function Code() 
	{
		$c=new code();
		$c->checkcode();
	}

	public function login()
	{
		$this->Show();
	}

	public function checklogin()
	{
		$username  = $_POST['username'];
		$password  = $_POST['password'];

		if($username&&$password)
		{
			$db = new Db();
			$arr[0]=array(0 => "username",1 => "=",2 => "'$username'");
			$res=$db->Select("password")->From("user")->Where($arr)->Exec();
			//$sql = "select password from user where username='".$_POST['username']."'";
			//$res = $sqlDb->getRow($sql);
			if(!isset($res[0]))
    		{
    			$message = array( "status" => "no");
				echo json_encode($message);
				return;
			}
			//echo md5($username.$password);die;
    		if($res[0]["password"] == md5($username.$password))
    		{
    			// $this->Show("App/Views/Home/index.html");
    			$message = array( "status" => "ok");
				echo json_encode($message);
				return;	
    		}
    		else 
    		{
    			$message = array( "status" => "no");
				echo json_encode($message);
				return;
    		}
		}
		else 
		{
			$message = array( "status" => "wu");
			echo json_encode($message);
			return;
		}
	}

	public function register()
	{
			$this->Show();
	}

	public function checkregister()
	{		
		
		$user      = $_POST['user'];
		$password  = $_POST['password'];
		$password2 = $_POST['password_again'];
		$email     = $_POST['email'];
		$checkCode = $_POST['yz'];
		if($user&&$password&&$password2&&$email&&$checkCode)
		{
			session_start();
			if($checkCode!=$_SESSION['myCheckCode'])
			{
				$message = array( "status" => "yz");
				echo json_encode($message);
				return;
			}
			if($password!=$password2)
			{
				$message = array( "status" => "psd");
				echo json_encode($message);
				return;
			}
			$c = new check();
			if($c->checkget($user)==0 || $c->checkget($password)==0 || $c->checkemail($email)==0)
			{
				$message = array( "status" => "tian");
				echo json_encode($message);
				return;
			}
		
			$db=new Db();
		    $arr[0]=array(0 => "username",1 => "=",2 => ""."'".$_POST['user']."'"."");
			$res=$db->Select("username")->From("user")->Where($arr)->Exec();
			//var_dump($res);
			if(isset($res[0]))
			{
				$message = array( "status" => "user");
				echo json_encode($message);
				return;
			}
			else
			{
				$db=new Db();
				//$sql = "insert into user values (NULL,'".$_POST['username']."','".$_POST['password']."')";
				$arr[0]=array(0 => "".$_POST['user']."",1 => "".md5($_POST['user'].$_POST['password'])."",2 => "".$_POST['email']."",3 => "0");
				$res=$db->Insert("user")->Values($arr)->Exec();
	    		if($res)
	    		{
	    			$message = array( "status" => "ok");
					echo json_encode($message);
	    		}
	    		else 
	    		{
					$message = array( "status" => "no");
					echo json_encode($message);
					return;
				}
			}
		}	
	}
	

}
?>