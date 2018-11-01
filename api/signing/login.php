<?php

    if ($_SERVER['REQUEST_METHOD']=='POST') {
        // headers
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');


        if (isset($_POST['username']) && isset($_POST['password'])) {

            include_once __DIR__ .'../../config/Database.php';
            include_once __DIR__ .'../../models/Token.php';

            // instanciate database and connect
            $database = new Database('127.0.0.1','risk','root','');
            $db = $database->connect();

            // instantiate user object
            $token = new Token($db);

            // get id from url
            $token->user_id = $_POST['username'];
            $token->user_password = $_POST['password'];

            // get user
            $token->setToken();

            if ($token->ok) {
                // response
                http_response_code(200);
                $GLOBALS['user_id'] = $token->user_id;
                $GLOBALS['user_type'] = $token->user_type;
                $GLOBALS['user_name'] = $token->user_name;
                $GLOBALS['user_surname'] = $token->user_surname;
                // json
                echo json_encode(array('message' => 'success'));
            }
            else {
                // couldn't login
                http_response_code(400);
                echo json_encode(array('message' => 'error'));
            }
        }
        else {
            // couldn't login
            http_response_code(400);
            echo json_encode(array('message' => 'error'));
        }
    }
    else {

        // bad request
        header("HTTP/1.0 400 Bad Request");
        http_response_code(400);
    }