<?php
	/*
		This is the Rest Api that will handle all the 
		GET(user requeste) and POST(user data input,like submitting a form) requests
		it will return json data as a response to the user/front-end
	*/
	/********************************************************************************/	
	/*
		These are the classes that we're going to use for the API
		The DB class is for connecting to the database
		it makes it simpler and shorter to get the data with the 
		query() function.
		We use PDO because it's accommodates a wider database range than just
		mysql and it is also more adopted than the mysqli php engine
	*/
	require_once('DB.php');
	require_once('Text.php');
	/*
		We don't want our requests to be cached,simply because we don't
		want the user to get the same cached data all the time even when
		we have changed or modified the api or the backend database data
	*/
	header("Cache-Control: no-store,no-cache,must-revalidate,max-age=0");
	header("Cache-Control: post-check=0,pre-check=0",false);
	header("Pragma:no-cache");

	/*
		We basically create a database instance,using the DB class 
	*/
	$db=new DB('localhost','d815108','s815108','random123');

	/*
		We are mainly going to get and send GET and POST requests,the DELETE(optional) method is mainly used
		for logouts and for deleting something i.e deleting a picture or data in a database
	*/
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if($_GET['url']=='register')
		{
			$data=file_get_contents("php://input");
	      	$data=json_decode($data);

	      	$username=$data->username;
	      	$password=$data->password;
	      	$confirm=$data->confirm;
	      	$type=$data->type;
	      	$name=$data->name;
	      	$surname=$data->surname;
	      	$faculty=$data->faculty;
	      	$enrollYear=$data->enroll_year;
	      	$school=$data->school;

	      	if(!empty($username) && !empty($password) && !empty($confirm) && !empty($type) && !empty($name) && !empty($surname) && !empty($faculty) && !empty($enrollYear) && !empty($school))
	      	{
	      		if($db->query('SELECT * FROM user WHERE student_nr=:s_nr',array(':s_nr'=>$username)))
	      		{
	      			http_response_code(200);
	      			echo '{"status":"User Aready Exists"}';
	      		}
	      		else
	      		{
	      			$db->query('INSERT INTO user VALUES(\'\',:student_number,:type,:name,:surname,:password,:faculty,:school,:enroll)',array(':student_number'=>$username,':type'=>$type,':name'=>$name,':surname'=>$surname,':password'=>password_hash($password,PASSWORD_BCRYPT),':faculty'=>$faculty,':enroll'=>$enrollYear,':school'=>$school));
	      			http_response_code(200);
	      			echo '{"status":"Success"}';
	      		}
	      		
	      	}
	      	else
	      	{
	      		http_response_code(200);
	      		echo '{"status":"Fill In All Fields"}';
	      	}
		}
		if($_GET['url']=='login')
		{
			$data=file_get_contents("php://input");
			$data=json_decode($data);

			$username=$data->username;
			$password=$data->password;

			if($db->query('SELECT * FROM user WHERE user_id=:user_id',array(':user_id'=>$username)))
			{
				if(password_verify($password,$db->query('SELECT user_password FROM user WHERE user_id=:user_id',array(':user_id'=>$username))[0]['user_password']))
				{
					$cryptstrong=True;
		  			$token=bin2hex(openssl_random_pseudo_bytes(64,$cryptstrong));

		  			$user_id=$db->query('SELECT user_id FROM user WHERE user_id=:user_id',array(':user_id'=>$username))[0]['user_id'];
		           	$name=$db->query('SELECT user_name FROM user WHERE user_id=:student',array(':student'=>$username))[0]['user_name'];
		           	$surname=$db->query('SELECT user_surname FROM user WHERE user_id=:student',array(':student'=>$username))[0]['user_surname'];
		  			$db->query('INSERT INTO token VALUES (\'\',:token, :user_id)',array(':token'=>sha1($token),':user_id'=>$user_id));

		           	setcookie("WITS",$token,time()+60*60*24*7,'/',NULL,NULL,TRUE);
		           	setcookie("SNID_",'1',time()+60*60*24*3,'/',NULL,NULL,TRUE);
		           	http_response_code(200);
		           	echo '{"status":"Success","name":"'.ucfirst(strtolower($name)).'","surname":"'.ucfirst(strtolower($surname)).'","user":"'.$username.'"}';
				}
				else
				{
					http_response_code(200);
					echo '{"status":"Incorrect Credentials"}';
				}
			}
			else
			{
				http_response_code(200);
				echo '{"status":"This user does not exist"}';
			}
		}
		if($_GET['url']=='add_module')
		{
			$data=file_get_contents("php://input");
			$data=json_decode($data);

			$name=strtoupper($data->name);
			$code=strtoupper($data->code);
			$school=strtoupper($data->school);

			if($db->query('SELECT * FROM module WHERE module_code=:code',array(':code'=>$code)))
			{
				http_response_code(200);
				echo '{"status":"Module Already Already Exists!"}';
			}
			else
			{
				$db->query('INSERT INTO module VALUES(\'\',:name,:school,:code)',array(':name'=>$name,':school'=>$school,':code'=>$code));
				http_response_code(200);
				echo '{"status":"Module Added!"}';
			}
		}
	}
	elseif($_SERVER['REQUEST_METHOD']=='GET')
	{
		if($_GET['url']=='logged')
		{
			if(isset($_COOKIE['WITS']))
			{
				$token=sha1($_COOKIE['WITS']);
				if($db->query('SELECT user_id FROM token WHERE token=:token',array(':token'=>sha1($token))))
				{
					http_response_code(200);
					echo '{"status":"1"}';
				}
				else
				{
					http_response_code(200);
					echo '{"status":"0"}';
				}
			}
			else
			{
				http_response_code(200);
				echo '{"status":"0"}';
			}
		}
	}
	elseif($_SERVER['REQUEST_METHOD']=='DELETE')
	{
		if($_GET['url']=='logout')
		{
			if(isset($_COOKIE['WITS']))
			{
				$db->query('DELETE FROM token WHERE token=:token',array(':token'=>sha1($_COOKIE['WITS'])));
          		setcookie('WITS','2',time()-3600);
          		setcookie('SNID_','2',time()-3600);
          		http_response_code(200);
          		echo '{"status":"Success"}';	
			}
			else
			{
				die();
			}

		}
	}
?>