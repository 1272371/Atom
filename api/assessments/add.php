<?php

    // headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // check if cookie exists and active before uploading
    if (isset($_COOKIE['atom_risk'])) {

        // include database files
        include_once '../config/Database.php';
        include_once '../models/Token.php';
        include_once '../models/Assessment.php';

        // instanciate database and connect
        $database = new Database();
        $db = $database->connect();

        // instantiate user object
        $token = new Token($db);

        // get token
        $token->token = sha1($_COOKIE['atom_risk']);

        $token->getToken();
        // only lecturers can upload marks
        if ($token->ok && $token->utl_id == 2) {

            // instantiate new assessment
            $assessment = new Assessment($db);

            // get variables
            $assessment->assessment_name = isset($_GET['assessment_name']) ? $_GET['assessment_name'] : die();
            $assessment->assessment_weight = (float) isset($_GET['assessment_weight']) ? $_GET['assessment_weight'] : die();
            $assessment->assessment_date = isset($_GET['assessment_date']) ? $_GET['assessment_date'] : die();
            $assessment->assessment_total = (float) isset($_GET['assessment_total']) ? $_GET['assessment_total'] : die();
            $assessment->ail_id = isset($_GET['ail_id']) ? (int) $_GET['ail_id'] : die();
            $assessment->aml_id = isset($_GET['aml_id']) ? (int) $_GET['aml_id'] : die();
            $assessment->atl_id = isset($_GET['atl_id']) ? (int) $_GET['atl_id'] : die();
            $assessment->course_id = isset($_GET['course_id']) ? (int) $_GET['course_id'] : die();
            $assessment->csv = isset($_GET['csv']) ? explode(';', $_GET['csv']) : die();

            // call query function
            $assessment->addAssessment();


            if ($assessment->ok) {
                echo json_encode(array('message' => 'success'));
            }
            else {
                echo json_encode(array('message' => 'error'));
            }
        }

    }
    else {
        // bad request
        header("HTTP/1.0 400 Bad Request");
        http_response_code(400);
    }