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

    // call lookup function
    $basic->getLookups();

    // get statements
    $user_type_lookup = $basic->user_type_lookup;
    $assessment_info_lookup = $basic->assessment_info_lookup;
    $assessment_medium_lookup = $basic->assessment_medium_lookup;
    $assessment_type_lookup = $basic->assessment_type_lookup;

    // create array for lookups
    $lookupArray = array(
        'name' => 'lookups',
        'description' => 'Returns all lookup tables in database',
        'message' => 'success'
    );

    // contents go in this value
    $lookupArray['contents'] = array(
        'array' => 'awe'
    );
    $lookupArray['contents'] = array();

    // array index
    $i = 0;

    // user type lookup
    $num = $user_type_lookup->rowCount();
    $lookupArray['contents']['user_type_lookup'] = array();
    if ($num > 0) {
        // iterate through user type lookup table
        while($row = $user_type_lookup->fetch(PDO::FETCH_ASSOC)) {
            // push to content and id value in array
            $lookupArray['contents']['user_type_lookup'][$i] = array(
                'utl_id' => $row['utl_id'],
                'utl_name' => $row['utl_name']
            );
            $i++;
        }
    }
    else {

        // user doesn't have subjects
        echo json_encode(array('message' => 'error'));
    }
    // reset index
    $i = 0;
    // asssessment info lookup
    $num = $assessment_info_lookup->rowCount();
    $lookupArray['contents']['assessment_info_lookup'] = array();
    if ($num > 0) {
        // iterate through assessment info lookup table
        while($row = $assessment_info_lookup->fetch(PDO::FETCH_ASSOC)) {
            // push to content and id value in array
            $lookupArray['contents']['assessment_info_lookup'][$i] = array(
                'ail_id' => $row['ail_id'],
                'ail_name' => $row['ail_name']
            );
            $i++;
        }
    }
    else {

        // user doesn't have subjects
        echo json_encode(array('message' => 'error'));
    }
    // reset index
    $i = 0;
    // asssessment medium lookup
    $num = $assessment_medium_lookup->rowCount();
    $lookupArray['contents']['assessment_medium_lookup'] = array();
    if ($num > 0) {
        // iterate through assessment medium lookup table
        while($row = $assessment_medium_lookup->fetch(PDO::FETCH_ASSOC)) {
            // push to content and id value in array
            $lookupArray['contents']['assessment_medium_lookup'][$i] = array(
                'aml_id' => $row['aml_id'],
                'aml_name' => $row['aml_name']
            );
            $i++;
        }
    }
    else {

        // user doesn't have subjects
        echo json_encode(array('message' => 'error'));
    }
    // reset index
    $i = 0;
    // asssessment type lookup
    $num = $assessment_type_lookup->rowCount();
    $lookupArray['contents']['assessment_type_lookup'] = array();
    if ($num > 0) {
        // iterate through assessment medium lookup table
        while($row = $assessment_type_lookup->fetch(PDO::FETCH_ASSOC)) {
            // push to content and id value in array
            $lookupArray['contents']['assessment_type_lookup'][$i] = array(
                'atl_id' => $row['atl_id'],
                'atl_name' => $row['atl_name']
            );
            $i++;
        }
    }
    else {

        // user doesn't have subjects
        echo json_encode(array('message' => 'error'));
    }
    echo json_encode($lookupArray);