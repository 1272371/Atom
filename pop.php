<?php

    include_once 'api/config/Database.php';

    $db = new Database();
    $conn = $db->connect();

    if ($conn) {

        $row = file('csv/COMS1015-BCO-2013.csv', FILE_SKIP_EMPTY_LINES);
        $length = count($row);

        for ($i = 1; $i < $length; $i++) {

            $column = explode(',', $row[$i]);

            //
            $id = chop($column[0]);

            $query = 'INSERT INTO
            subject
            SET
            course_id = :course_id,
            subject_enrollmentyear = :subject_enrollmentyear,
            user_id = :user_id';

            $state = $conn->prepare($query);

            $state->bindParam(':course_id', 1);
            $state->bindParam(':subject_enrollmentyear', 2013);
            $state->bindParam(':user_id', $id);

            $state->execute();

            sleep(0.5);
    }
    }