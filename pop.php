<?php

    $conn = new mysqli('localhost', 's815108', 'random123', 'd815108');

    if ($conn) {

        $row = file('csv/COMS1018-IAP-2017.csv', FILE_SKIP_EMPTY_LINES);
        $length = count($row);

        for ($i = 1; $i < $length; $i++) {

            $column = explode(',', $row[$i]);

            //
            $id = chop($column[0]);
            $total = 1;
            $mark1 = (double) chop($column[1]);
            $mark2 = (double) chop($column[2]);
            $mark3 = (double) chop($column[3]);
            $mark4 = (double) chop($column[4]);
            $mark5 = (double) chop($column[5]);
            $mark6 = (double) chop($column[6]);
            $mark7 = (double) chop($column[7]);


            $query = 'INSERT INTO
            mark
            (mark_total, user_id, assessment_id)
            VALUES
            (' . $mark1 . ', ' . $id . ', 32),
            (' . $mark2 . ', ' . $id . ', 33),
            (' . $mark3 . ', ' . $id . ', 34),
            (' . $mark4 . ', ' . $id . ', 35),
            (' . $mark5 . ', ' . $id . ', 36),
            (' . $mark6 . ', ' . $id . ', 37),
            (' . $mark7 . ', ' . $id . ', 38)';

            if ($conn->query($query)) {
                echo 'success ' . $id . ' <br>';
            }
            else {
                echo mysqli_error($conn) . '<br>';
            }

            sleep(0.5);
        }
    }