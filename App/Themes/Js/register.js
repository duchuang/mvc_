$(document).ready(function(){
	$("#user").blur(function(){
		check("user","user_message","[a-zA-Z0-9]{6,15}","应输入字母或数字，6~15位");
	});

	$("#password").blur(function(){
		check("password","password_message","[a-zA-Z0-9]{6,15}","应输入字母或数字，6~15位");
	});

	$("#password_again").blur(function(){
		Chenk_againPwd("password_again");
	});

	$("#email").blur(function(){
		check("email","email_mes","[a-zA-Z0-9].*@.*\.com","应输入正确的邮箱！");
	});

	$("#confirm").click(function()
	{
		if(check("user","user_message","[a-zA-Z0-9]{6,15}","应输入字母或数字，6~15位")&&check("password","password_message","[a-zA-Z0-9]{6,15}","应输入字母或数字，6~15位")&&Chenk_againPwd("password_again")&&check("email","email_mes","[a-zA-Z0-9].*@.*\.com","应输入正确的邮箱！"))
		{

		}
		else
		{
			return false;
		}
		
	});
});

function check(id,id_msg,r,str)
{
	id="#"+id;
	id_msg="#"+id_msg;
	var value=$(id).val();
		var regex=new RegExp(r);
		if(regex.exec(value)==value)
		{
			$(id_msg).text("输入正确！");
			$(id_msg).css("color","green");
			return true;
		}
		else
		{
			$(id_msg).text(str);
			$(id_msg).css("color","red");
			return false;
		}
}

function Chenk_againPwd(id)
{
	id="#"+id;
	var value=$(id).val();
		var password=$("#password").val();
		if(value==password&&value!="")
		{
			$("#password_message_again").text("密码正确！");
			$("#password_message_again").css("color","green");
			return true;

		}
		else
		{
			$("#password_message_again").text("密码不正确！");
			$("#password_message_again").css("color","red");
			return false;
		}
}