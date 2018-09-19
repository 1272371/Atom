<?php

    include_once 'Database.php';

    $host = 'localhost';
    $name = 'risk';
    $user = 'root';
    $pass = '';
    $connection;

    include_once 'Database.php';
    $database = new Database;
    $connection = $database->connectDatabase();

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_errno());
        }
        else {
            $sql = "create table if not exists faculty(
                faculty_id int(1) unsigned auto_increment primary key,
                faculty_name varchar(50) not null)";
    
            if (mysqli_query($connection, $sql)) {
                echo "Table faculty created successfully";
            }
            else {
                echo "Error creating faculty table: " . mysqli_error($connection);
            }
        }

    mysqli_close($connection);