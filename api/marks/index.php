<?php

    // headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Mark.php';

    // instanciate database and connect
    $database = new Database();
    $db = $database->connect();

    // instantiate mark object
    $mark = new Mark($db);

    // mark post query
    $result = $mark->get();

    // get mark count
    $num = $result->rowCount();

    if ($num > 0) {

        // marks exist
        $markArray = array();
        $markArray['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $markItem = array(
                'user_id' => $user_id
            );

            // push to data value in array
            array_push($markArray['data'], $markItem);

            echo json_encode($markArray);
        }
    }
    else {

        // no marks exist
        echo json_encode(array('message' => 'no marks found'));
    }