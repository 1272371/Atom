<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // headers
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        if (isset($_COOKIE['atom_risk'])) {

            // include database files
            include_once __DIR__ .'../../config/Database.php';
            include_once __DIR__ .'../../models/Token.php';

            // instanciate database and connect
            $database = new Database('127.0.0.1','risk','root','');
            $db = $database->connect();

            // instantiate user object
            $token = new Token($db);

            // get token
            $token->token = sha1($_COOKIE['atom_risk']);

            $token->getToken();

            if ($token->ok) {
                // token exists now delete

                if ($token->deleteToken()) {
                    http_response_code(200);
                    echo json_encode(array('message' => 'success'));
                }
                else {
                    http_response_code(200);
                    echo json_encode(array('message' => 'error'));
                }
            }
            else {
                http_response_code(200);
                echo json_encode(array('message' => 'error'));
            }
        }
        else {
            http_response_code(200);
        }
    }
    else {

        // bad request
        header("HTTP/1.0 400 Bad Request");
        http_response_code(400);
    }