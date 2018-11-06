<?php

    // headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD']=='POST') {

        if (isset($_GET['user_id'])) {

            include_once __DIR__ . '../../config/Database.php';
            include_once __DIR__ . '../../models/Mark.php';
            include_once __DIR__ . '../../models/Basic.php';
            include_once __DIR__ . '../../models/Assessment.php';
            include_once __DIR__ . '../../models/User.php';

            // instanciate database and connect
            $database = new Database('127.0.0.1','risk','root','');
            $db = $database->connect();

            // instantiate mark object
            $mark = new Mark($db);

            // instantiate basic object
            $basic = new Basic($db);

            // instantiate assessment object
            $assessment = new Assessment($db);

            // instantiate user object
            $user = new User($db);

            // get id from url
            $basic->user_id = $_GET['user_id'];

            // get subjects
            $result = $basic->getSubjects();

            $num = $result->rowCount();

            if ($num > 0) {

                // subject exist
                $gradesArray = array(
                    'name' => 'grades',
                    'description' => 'returns data for grades-book page',
                    'message' => 'success'
                );
                // contents go in here
                $gradesArray['contents'] = array();

                // courses the lecturer teaches
                $gradesArray['contents']['courses'] = array();
                
                // index iterator
                $i = 0;

                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
        
                    $gradeItem = array(
                        'course_id' => $course_id,
                        'course_name' => $course_name
                    );
        
                    // push to content and id value in array
                    $gradesArray['contents']['courses'][$i] = $gradeItem;
                    $i++;
                }
                $gradesArray['contents']['grades'] = array();

                // check if year and course id is set
                if (isset($_GET['year']) && isset($_GET['course_id'])) {

                    // default course lowest id get all students registered for current year
                    $basic->course_id = $_GET['course_id'];
                    $basic->subject_enrollmentyear = $_GET['year'];

                    // call function
                    $results = $basic->getStudents();

                    // number of results
                    $num = $results->rowCount();

                    // iterator
                    $i = 0;

                    while ($rows = $results->fetch(PDO::FETCH_ASSOC)) {
                        extract($rows);

                        // set user id
                        $user->user_id = $user_id;

                        // call function
                        $user->getUser();

                        // get average
                        $average = $mark->getMarksByUserId($user_id);

                        $userItem = array(
                            'user_id' => $user_id,
                            'user_name' => $user->user_name,
                            'user_surname' => $user->user_surname,
                            'faculty_name' => $user->faculty_name,
                            'average' => $average
                        );

                        // push
                        $gradesArray['contents']['grades'][$i] = $userItem;

                        // iterate
                        $i++;
                    }
                    // print
                    echo json_encode($gradesArray);
                }
                else {
                    // default course lowest id get all students registered for current year
                    $basic->course_id = $gradesArray['contents']['courses'][0]['course_id'];
                    $basic->subject_enrollmentyear = date('Y');

                    // call function
                    $results = $basic->getStudents();

                    // number of results
                    $num = $results->rowCount();

                    // iterator
                    $i = 0;

                    while ($rows = $results->fetch(PDO::FETCH_ASSOC)) {
                        extract($rows);

                        // set user id
                        $user->user_id = $user_id;

                        // call function
                        $user->getUser();

                        // get average
                        $average = $mark->getMarksByUserId($user_id);

                        $userItem = array(
                            'user_id' => $user_id,
                            'user_name' => $user->user_name,
                            'user_surname' => $user->user_surname,
                            'faculty_name' => $user->faculty_name,
                            'average' => $average
                        );

                        // push
                        $gradesArray['contents']['grades'][$i] = $userItem;

                        // iterate
                        $i++;
                    }
                    // print
                    echo json_encode($gradesArray);
                }
            }

        }
        else {
            // user_id not set
            echo json_encode(array('message' => 'error'));
        }

    }
    else {
        // bad request
        header("HTTP/1.0 400 Bad Request");
        http_response_code(400);
}