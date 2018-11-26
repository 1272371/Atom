<?php
	header('Content-Type: application/json');
	require("../config/DB.php");

	/*
	$query = 'SELECT * FROM user';

	$stmt = $pdo->query($query);

	$response = '[';
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$response .= '{"student":"'.htmlspecialchars($row['user_id']).'","name":"'.htmlspecialchars($row['user_name']).'","user_surname":"'.htmlspecialchars($row['user_surname']).'"},';
	}
	$response = substr($response,0,strlen($response)-1);
	$response .= ']';

	echo $response;
	*/
	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{

	}
	if($_SERVER['REQUEST_METHOD']=='GET')
	{
		if(isset($_GET['student_nr']))
		{
			$student = $_GET['student_nr'];
		}

		if(isset($_GET['student']) && $_GET['student']=='student')
		{
			$query="SELECT user.user_name,user.user_id,user.user_surname,faculty.faculty_name FROM faculty,user WHERE user.user_id=:student_nr AND faculty.faculty_id=user.faculty_id";

			$stmt = $pdo->prepare($query);
			$stmt->execute([':student_nr'=>$student]);

			echo json_encode($stmt->fetch(PDO::FETCH_ASSOC)); 
		}
		elseif(isset($_GET['courses']) && $_GET['courses']=='courses')
		{

			$query="SELECT DISTINCT(course.course_name),AVG(mark.mark_total) AS average,mark.user_id FROM mark,course WHERE mark.user_id=:student_nr AND course.course_id=mark.course_id ";
			$stmt = $pdo->prepare($query);
			$stmt->execute([':student_nr'=>$student]);


			$response = '[';
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$response .= '{"course":"'.htmlspecialchars($row['course_name']).'","mark_total":"'.htmlspecialchars(round($row['average'])).'","student":"'.htmlspecialchars($row['user_id']).'"},';
			}
			$response = substr($response,0,strlen($response)-1);
			$response .= ']';

			http_response_code(200);
			echo $response;
		}
		elseif(isset($_GET['average']) && $_GET['average']=='average')
		{
			$query ="SELECT AVG(mark.mark_total) AS average FROM mark WHERE mark.user_id=:student_nr";
			$stmt = $pdo->prepare($query);
			$stmt->execute([':student_nr'=>$student]);

			http_response_code(200);
			$response = '[';
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$response .= '{"average":"'.htmlspecialchars(round($row['average'])).'"},';
			}
			$response = substr($response,0,strlen($response)-1);
			$response .= ']';

			http_response_code(200);
			echo $response;	
		}
		elseif(isset($_GET['risk']) && $_GET['risk']=='risk')
		{
			http_response_code(200);
		}
		else
		{
			http_response_code(400);
			echo '{"status":"Bad Request"}';
		}

	}
?>
