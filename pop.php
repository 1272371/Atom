<?php

    $conn = new mysqli('localhost', 's815108', 'random123', 'd815108');

    if ($conn) {

        $row = file('csv/COMS1015-BCO-2018.csv', FILE_SKIP_EMPTY_LINES);
        $length = count($row);

        for ($i = 1; $i < $length; $i++) {

            $column = explode(',', $row[$i]);

            //
            $id = chop($column[0]);
            $total = 1;
            $mark1 = (double) chop($column[1]);
            $mark2 = (double) chop($column[2]);
            $mark3 = (double) chop($column[3]);


            $query = 'INSERT INTO
            mark
            (mark_total, user_id, assessment_id)
            VALUES
            (' . $mark1 . ', ' . $id . ', 16),
            (' . $mark2 . ', ' . $id . ', 17),
            (' . $mark3 . ', ' . $id . ', 18)';

            if ($conn->query($query)) {
                echo 'success ' . $id . ' <br>';
            }
            else {
                echo mysqli_error($conn) . '<br>';
            }

            sleep(0.5);
        }
    }