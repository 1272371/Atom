<?php

    // headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Token.php';

    // instanciate database and connect
    $database = new Database();
    $db = $database->connect();

    // instantiate user object
    $token = new Token($db);

    // get id from url
    $token->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();
    $token->user_password = isset($_GET['user_password']) ? $_GET['user_password'] : die();

    // get user
    $token->setToken();

    // create array
    $userArray = array(
        // 'user_id' => $user->user_id,
    );

    $GLOBALS['user_id'] = $token->user_id;
    $GLOBALS['user_type'] = $token->user_type;
    $GLOBALS['user_name'] = $token->user_name;
    $GLOBALS['user_surname'] = $token->user_surname;
    header("Location: ../../dashboard/dashboard.php");

    // make json
    // print_r(json_encode($userArray));