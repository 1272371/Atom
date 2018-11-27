<?php
	header('Content-Type: application/json');
	require("../../connect/DB.php");
	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if(!empty($_GET['lecturer']) && !empty($_GET['course_code']))
		{
			$data = [
    			'course_id' => $_GET['course_id'],
    			'user_id' => $_GET['user_id']
			];

			$sql = "INSERT INTO user (subject_id, subject_enrollmentyear, course_id, user_id) VALUES (NULL, 2018,:course_id,:user_id)";
			
			$stmt= $pdo->prepare($sql);
			$stmt->execute($data);
		}
		else
		{
			die();
		}
	}
	else
	{
		http_response_code(400);
	}
?>
