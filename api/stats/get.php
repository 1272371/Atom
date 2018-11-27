<?php

	header('Content-Type: application/json');
	require("../../connect/DB.php");
	
	if($_SERVER['REQUEST_METHOD']=='GET')
	{
		if(isset($_GET['lecturer']))
		{
			if(isset($_GET['type']) && $_GET['type']=='info')
			{
				$lecturer = $_GET['lecturer'];
				$query="SELECT utl_id FROM user WHERE user_id=:uid";
				$stmt=$pdo->prepare($query);

				if($stmt->execute([':uid'=>$lecturer]))
				{
					if($stmt->fetch(PDO::FETCH_ASSOC)['utl_id']==2)
					{
						$query="SELECT user.user_id,user.user_name,user.user_surname,faculty.faculty_name FROM user,faculty WHERE user_id=:uid AND faculty.faculty_id=user.faculty_id";

						$stmt=$pdo->prepare($query);
						$stmt->execute([':uid'=>$lecturer]);

						echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
					}
					else
					{
						die();
					}
				}
				else
				{
					die();
				}
			}
			
			if(isset($_GET['type']) && $_GET['type']=='average')
			{
				$lecturer = $_GET['lecturer'];
				$query="SELECT utl_id FROM user WHERE user_id=:uid";
				$stmt=$pdo->prepare($query);

				if($stmt->execute([':uid'=>$lecturer]))
				{
					if($stmt->fetch(PDO::FETCH_ASSOC)['utl_id']==2)
					{
						$query="SELECT course_id FROM subject WHERE user_id=:uid";
						$stmt="";
						$stmt=$pdo->prepare($query);
						$stmt->execute([':uid'=>$lecturer]);

						$courses=array();
						while($row=$stmt->fetch(PDO::FETCH_ASSOC))
						{
							array_push($courses,$row['course_id']);
						}

						/**********************************Fixed**************************************************/
						$response = '[';
						foreach ($courses as $course) 
						{
							$query="SELECT AVG(mark.mark_total) AS average,course.course_name FROM mark,course WHERE course.course_id=mark.course_id AND mark.course_id=:course_id";
							$stmt=$pdo->prepare($query);
							$stmt->execute([':course_id' => $course ]);

							while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{
								$response .='{"average":"'.htmlspecialchars(round($row['average'] +10)).'","course_name":"'.htmlspecialchars($row['course_name']).'"},';
							}
						}
						$response = substr($response,0,strlen($response)-1);
						$response .= ']';

						http_response_code(200);
						echo $response;
					}
					else
					{
						die();//it's a student
					}
				}
				else
				{
					die();
				}
			}
			if(isset($_GET['type']) && $_GET['type']=='courses')
			{
				$lecturer = $_GET['lecturer'];
				$query="SELECT utl_id FROM user WHERE user_id=:uid";
				$stmt=$pdo->prepare($query);

				if($stmt->execute([':uid'=>$lecturer]))
				{
					if($stmt->fetch(PDO::FETCH_ASSOC)['utl_id']==2)
					{
						$query="SELECT course_id FROM subject WHERE user_id=:uid";
						$stmt="";
						$stmt=$pdo->prepare($query);
						$stmt->execute([':uid'=>$lecturer]);

						$courses=array();
						while($row=$stmt->fetch(PDO::FETCH_ASSOC))
						{
							array_push($courses,$row['course_id']);
						}
						/*********************************Courses Have years and etc ******************************/
						/*
						$response = '[';
						foreach ($courses as $course) 
						{
							$query="SELECT COUNT(*) AS class FROM mark WHERE mark.course_id=:course_id AND mark.mark_total ";
							$stmt=$pdo->prepare($query);
							$stmt->execute([':course_id' => $course ]);

							while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{
								$response .='{"class":"'.htmlspecialchars(round(((int)$row['class']/3)-1)).'"},';
							}
						}
						$response = substr($response,0,strlen($response)-1);
						$response .= ']';

						http_response_code(200);
						echo $response;
						*/						
					}
					else
					{
						die();
					}
				}
				else
				{
					die();
				}
			}
		}
		else
		{
			die();
		}
	}
?>
