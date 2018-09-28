<?php

    include_once 'api/config/Database.php';

    $db = new Database();
    $conn = $db->connect();

    if ($conn) {

        $row = file('csv/random-user.csv', FILE_SKIP_EMPTY_LINES);
        $length = count($row);

        for ($i = 1; $i < $length; $i++) {

            $column = explode(',', $row[$i]);

            //
            $id = chop($column[0]);
            $name = chop($column[1]);
            $surname = chop($column[2]);
            $password = password_hash('password', PASSWORD_DEFAULT);
            $fid = 5;
            $tid = 1;

            $query = 'INSERT INTO
            user
            SET
            user_id = :user_id,
            user_name = :user_name,
            user_surname = :user_surname,
            user_password = :user_password,
            faculty_id = :faculty_id,
            utl_id = :utl_id';

            $state = $conn->prepare($query);

            $state->bindParam(':user_id', $id);
            $state->bindParam(':user_name', $name);
            $state->bindParam(':user_surname', $surname);
            $state->bindParam(':user_password', $password);
            $state->bindParam(':faculty_id', $fid);
            $state->bindParam(':utl_id', $tid);

            $state->execute();

            sleep(0.5);
    }
    }