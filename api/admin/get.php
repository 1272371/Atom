<?php
	header('Content-Type: application/json');
	require("../config/DB.php");

	if($_SERVER['REQUEST_METHOD']=='GET')
	{	
		if(isset($_GET['type']) && $_GET['type']=='lecturer')
		{
			$query = "SELECT * FROM user WHERE utl_id=2 AND user_id NOT IN (SELECT user_id FROM subject)";
			$stmt = $pdo->query($query);

			$response = '[';
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$response .= '{"user_id":"'.$row['user_id'].'","user_name":"'.$row['user_name'].'","user_surname":"'.$row['user_surname'].'"},';
			}
			$response = substr($response,0,strlen($response)-1);
			$response .= ']';

			http_response_code(200);
			echo $response;					
		}
		elseif(isset($_GET['type']) && $_GET['type']=='teach')
		{
			/*
				$query = "SELECT * FROM user WHERE utl_id=2 AND user_id NOT IN (SELECT user_id FROM subject)";
				$stmt = $pdo->query($query);

				$response = '[';
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$response .= '{"average":"'.htmlspecialchars(round($row['average'])).'"},';
				}
				$response = substr($response,0,strlen($response)-1);
				$response .= ']';

				http_response_code(200);
				echo $response;
			*/					
		}
		else
		{
			http_response_code(400);
		}	
	}
?>	
