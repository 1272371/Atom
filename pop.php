<?php

    $conn = new mysqli('localhost', 's815108', 'random123', 'd815108');

    if ($conn) {

        $row = file('csv/COMS1018-IAP-2016.csv', FILE_SKIP_EMPTY_LINES);
        $length = count($row);

        for ($i = 1; $i < $length; $i++) {

            $column = explode(',', $row[$i]);

            //
            $id = chop($column[0]);
            $cid = 1;
            $year = 2016;

            $query = 'INSERT INTO
            subject
            (course_id, subject_enrollmentyear, user_id)
            VALUES (2, ' . $year . ', ' . $id . ')';

            if ($conn->query($query)) {
                echo 'success ' . $id . ' <br>';
            };

            sleep(0.5);
        }
    }