<?php
	$params=[
		'host' => '127.0.0.1',
		'user' => 'root',
		'pwd' => '',
		'db' => 'risk'
	];
	$opts=[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
	try {
		$dsn = sprintf('mysql:charset=UTF8;host=%s;dbname=%s',$params['host'],$params['db']);
		$pdo = new PDO($dsn,$params['user'],$params['pwd'],$opts);
	} catch (PDOException $e) {
		error_log($e->getMessage());
	}catch(Throwable $e){
		error_log($e->getMessage());
	}
?>