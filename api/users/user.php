<?php

    if (isset($_GET['redirect']) && password_verify('1', $_GET['redirect'])) {
        // headers
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        // users exist
        $userArray = array(
            'name' => 'user',
            'description' => 'Specific users in database'
        );
        $userArray['content'] = array();

        if (isset($_GET['user_id'])) {
            // get by id
            include_once '../config/Database.php';
            include_once '../models/User.php';

            // instanciate database and connect
            $database = new Database();
            $db = $database->connect();

            // instantiate user object
            $user = new User($db);

            // get id from url
            $user->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

            // get user
            $user->getUser();

            // create array
            $userArray['content'][$user->user_id] = array(
                'user_id' => $user->user_id,
                'user_name' => $user->user_name,
                'user_surname' => $user->user_surname,
                'faculty_name' => $user->faculty_name,
            );

            // make json
            print_r(json_encode($userArray));
        }
        elseif (isset($_GET['user_name'])) {
            // get by name
            include_once '../config/Database.php';
            include_once '../models/User.php';

            // instanciate database and connect
            $database = new Database();
            $db = $database->connect();

            // instantiate user object
            $user = new User($db);

            // get id from url
            $user->user_name = isset($_GET['user_name']) ? $_GET['user_name'] : die();

            // user post query
            $result = $user->getUsersByName();

            // get user count
            $num = $result->rowCount();

            if ($num > 0) {
                // users exist
                $userArray = array(
                    'name' => 'users',
                    'description' => 'Specific users in database'
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
        }
    }