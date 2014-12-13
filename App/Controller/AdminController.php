<?php
date_default_timezone_set('PRC'); 
class Admin extends Controller
{
	public function index()
	{	
		$this->Show();
	}
	public function login()
	{
		$this->Show();
	}

	public function newsManage()
	{
		$this->Show();
	}

	public function newsManageList()
	{
		$page=$_POST["page"];
		$rows=$_POST["rows"];
		$db = new Db();
		//$res=$db->Select("*")->From("news")->Exec();
		$arr1[0] = array( 0 => "news_time", 1 => "desc");
		$arr[0] = array( 0 => ($page-1)*$rows , 1 => "$rows");
		$res = $db->Select("*")->From("news")->Order($arr1)->Limit($arr)->Exec();
		$count=$db->Select("count(*) as num")->From("news")->Exec();
		$json="{\"total\":".$count[0]["num"].",\"rows\":[";
		foreach($res as $arr)
		{
			$json.=json_encode($arr);
			$json.=",";
		}

		$json=substr($json, 0,-1);
		$json.="]}";
		echo $json;
	}

	public function addNews()
	{
		$cla     = $_POST['cla'];
        $title   = $_POST['title'];
        $summary = $_POST['summary'];
        $picture = $_POST['picture'];
        $content = $_POST['content'];
        $time    = date('y-m-d H:i:s',time());
        $db = new Db();
        $arr[0]=array(0 => "1",1 => "$cla",2 => "$title",3 => "$summary",4 => "$picture",5 => "$content",6 => "$time");
		$res=$db->Insert("news")->Values($arr)->Exec();
	    	if($res)
	    	{
	    		$message = array( "status" => "ok");
				echo json_encode($message);
	    	}
	}

	public function editNews()
	{
		$news_id = $_POST['id'];
		$cla     = $_POST['cla'];
        $title   = $_POST['title'];
        $summary = $_POST['summary'];
        $picture = $_POST['picture'];
        $content = $_POST['content'];
		$db = new Db();
		$arr[0]=array(0 => "news_id",1 => "$news_id");
		$arrup=array("news","news_class","$cla","news_title","$title","news_summary","$summary","news_picture","$picture","news_content","$content");
		$res=$db->Update($arrup)->Where($arr)->Exec();
			if($res)
				{
					$message = array( "status" => "ok");
					echo json_encode($message);
				}	
	    	
	}

	public function deleteNews()
	{
		$news_id = $_POST['id'];
		//var_dump($news_id);die;
		$db = new Db();
		$arr[0]=array(0 => "news_id",1 => "=",2 => "$news_id");
		$res=$db->Delete("")->From("news")->Where($arr)->Exec();
		if($res)
		{
			$message = array("status" => "ok");
			echo json_encode($message);
			return;
		}
	}

	public function addEditorNews()
	{
		$news_id = isset($_GET['id'])?$_GET['id']:0;
		if(isset($news_id)&&$news_id!=0)
		{
			$db = new Db();
			$arr[0]=array(0 => "news_id",1 => "=",2 => "$news_id");
			$res=$db->Select("*")->From("news")->Where($arr)->Exec();
			$this->DataContext("news_class",$res[0]["news_class"],"string");
			$this->DataContext("news_title",$res[0]["news_title"],"string");
			$this->DataContext("news_summary",$res[0]["news_summary"],"string");
			$this->DataContext("news_picture",$res[0]["news_picture"],"string");
			$this->DataContext("news_content",$res[0]["news_content"],"string");
			$this->DataContext("news_id",$news_id,"string");
			$this->Show();
		}
		else
		{
			$this->Show();
		}
		
	}

	public function checklogin()
	{
		$username  = $_POST['username'];
		$password  = $_POST['password'];
		if($username&&$password)
		{
			$db = new Db();
			$arr[0]=array(0 => "username",1 => "=",2 => "'$username'");
			$res=$db->Select("password,username")->From("user")->Where($arr)->Exec();
			//$sql = "select password from user where username='".$_POST['username']."'";
			//$res = $sqlDb->getRow($sql);
			//var_dump($res[0]["username"]);die;
			if(!isset($res[0]))
    		{
    			$message = array( "status" => "no");
				echo json_encode($message);
				return;
			}
    		if($res[0]["password"] == md5($username.$password))
    		{
    			session_start();
    			$_SESSION['softlab_b128'] = $res[0]["username"];
    			//$this->Show("App/Views/Admin/index.html");
    			//var_dump($_SESSION['loginuser']);die;
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

}
?>