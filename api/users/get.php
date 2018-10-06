<?php

    // headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/User.php';

    // instanciate database and connect
    $database = new Database();
    $db = $database->connect();

    // instantiate user object
    $user = new User($db);

    // user post query
    $result = $user->get();

    // get user count
    $num = $result->rowCount();

    if ($num > 0) {

        // users exist
        $userArray = array(
            'name' => 'users',
            'description' => 'All users in database'
        );
        $userArray['content'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $userItem = array(
                'user_id' => $user_id,
                'user_name' => $user_name,
                'user_surname' => $user_surname,
                'faculty_name' => $faculty_name
            );

            // create id array
            $userArray['content'][$user_id] = array();

            // push to content and id value in array
            array_push($userArray['content'][$user_id], $userItem);
        }
        echo json_encode($userArray);
    }
    else {

        // no users exist
        echo json_encode(array('message' => 'no users found'));
    }