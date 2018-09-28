<?php

    $connected = @fsockopen('www.google.com', 80);

    if (!$connected) {

        $db = null;

        try {
            // uses php database object (PDO)
            $db = new PDO(
                'mysql:host=localhost;dbname=risk', 'root', '');

            // set attributes
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo json_encode(array('message' => $e->getMessage()));
            exit();
        }

        if ($db) {
            /**
             * update local database
             * 
             * drop all tables
             * create new tables
             * insert into tables
             * 
             * create lookup tables first since
             * they don't depend on any other table
             */

            // main tables
            $user;
            $faculty;
            $school;
            $course;
            $assessment;

            // link tables
            $subject;
            $mark;

            // lookup tables
            $user_type_lookup;
            $assessment_info_lookup;
            $assessment_type_lookup;
            $assessment_medium_lookup;

            /**
             * drop all tables
             */
            $user = 'DESCRIBE user';
            // prepare query
            $statement = $db->prepare($user);

            // execute query
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_NUM);

            for ($i = 0; $i < $statement->rowCount() - 1; $i++) {
                echo $row[$i] . "\n";
            }
        }

    }
    else {
        echo json_encode(array('message' => 'error'));
        exit();
    }