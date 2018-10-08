<?php
	class DB
	{
		//static means that you don't have to create an object when you are using the function
		public static function connect()
		{
			$pdo=new PDO('mysql:host=127.0.0.1;dbname=risk;charset=utf8', 'root','') ;
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		}

		public static function query($query,$params=array())
		{
			$statement = self::connect()->prepare($query);
			$statement->execute($params);

			if(explode(' ',$query)[0]=='SELECT')
			{
				$data=$statement->fetchAll();
				return $data;
			}
			
		}
	}
?>