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

    // get id from url
    $user->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

    // get user
    $user->getUser();

    // create array
    $userArray = array(
        'user_id' => $user->user_id,
    );

    // make json
    print_r(json_encode($userArray));