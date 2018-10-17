<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // get by id
    include_once '../config/Database.php';
    include_once '../models/Basic.php';

    // instanciate database and connect
    $database = new Database('127.0.0.1','risk','root','');
    $db = $database->connect();

    // instantiate user object
    $basic = new Basic($db);

    // get id from url
    $basic->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

    // get user
    $result = $basic->getSubjects();

    $num = $result->rowCount();

    if ($num > 0) {

        // subject exist
        $subjectArray = array(
            'name' => 'subject',
            'description' => 'Subject data for specific user',
            'message' => 'success'
        );
        $subjectArray['contents'] = array();
        $i = 0;

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $subjectItem = array(
                'course_id' => $course_id,
                'course_name' => $course_name
            );

            // push to content and id value in array
            $subjectArray['contents'][$i] = $subjectItem;
            $i++;
        }
        echo json_encode($subjectArray);
    }
    else {

        // user doesn't have subjects
        echo json_encode(array('message' => 'error'));
    }