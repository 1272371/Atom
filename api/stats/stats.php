<?php

	header('Content-Type: application/json');
	require("../config/DB.php");
	
	if($_SERVER['REQUEST_METHOD']=='GET')
	{
		if(isset($_GET['lecturer']))
		{
			$lecturer = $_GET['lecturer'];
			$query="SELECT utl_id FROM user WHERE user_id=:uid";
			$stmt=$pdo->prepare($query);

			if($stmt->execute([':uid'=>$lecturer]))
			{
				if($stmt->fetch(PDO::FETCH_ASSOC)['utl_id']==2)
				{
					$query="SELECT course_id FROM subject WHERE user_id=:uid";

					$stmt=$pdo->prepare($query);
					$stmt->execute([':uid'=>$lecturer]);
					/**********************************Nonsense Query below,I'll fix it later**************************************************/
					/*
					$response = '[';
					while($row=$stmt->fetch(PDO::FETCH_ASSOC))
					{
						$query="SELECT AVG(mark.mark_total) AS average,course.course_name FROM mark,course WHERE mark.course_id=:course_id";
						$stmt=$pdo->prepare($query);
						$stmt->execute([':course_id' => $row['course_id'] ]);

						while($row=$stmt->fetch(PDO::FETCH_ASSOC))
						{
							$response .='{"average":"'.htmlspecialchars(round($row['average'])).'","course_name":"'.htmlspecialchars($row['course_name']).'"},';
						}
					}
					$response = substr($response,0,strlen($response)-1);
					$response .= ']';

					http_response_code(200);
					echo $response;
					*/

					echo '{"status":"Nothing to see here,bugs everywhere"}';
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
		else
		{
			die();
		}
	}
?>
