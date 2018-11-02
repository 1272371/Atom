<?php

    if ($_SERVER['REQUEST_METHOD']=='POST') {
        // headers
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');


        if (isset($_POST['username']) && isset($_POST['password'])) {

            include_once __DIR__ .'../../config/Database.php';
            include_once __DIR__ .'../../models/Token.php';
            include_once __DIR__ .'../../models/User.php';

            // instanciate database and connect
            $database = new Database('127.0.0.1','risk','root','');
            $db = $database->connect();

            // instantiate user object
            $token = new Token($db);

            // get id from url
            $token->user_id =$_POST['username'];
            $token->user_password = $_POST['password'];

            $ldap_dn = "DS\ ".$_POST["username"]."+".$_POST["password"]."";
	        $ldap_password = $_POST["password"];

            $ldap_con = ldap_connect("ldap://ss.wits.ac.za/;ldap://146.141.8.201");
            ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

            // get user
            $token->setToken();
            //$token->ok
            if (@ldap_bind($ldap_con,$ldap_dn) || $token->ok) {
                // response

                if($token->ok) {

                    http_response_code(200);
                    $GLOBALS['user_id'] = $token->user_id;
                    $GLOBALS['user_type'] = $token->user_type;
                    $GLOBALS['user_name'] = $token->user_name;
                    $GLOBALS['user_surname'] = $token->user_surname;
                }else{

                    //instantiate new
                    $user = new User($db);
                    //Set values
                    $user -> user_id = 111111;
                    $user->user_password =  $_POST['password'];
                    $user->user_type = 2;
                    $user->user_yearofstudy = NULL;
                    $user->faculty_name = 5;
                    $user->user_name = "issac";
                    $user->user_surname = "Newton";
                    //Add the user to our db
                    $user->addUser();

                    if ($user->ok) {
                        echo json_encode(array('message' => 'success'));
                    }
                    else {
                        echo json_encode(array('message' => 'error'));
                    }

                    $token->user_id ="1234567";
                    $token->user_password = "password";
                    $token->setToken();
                    http_response_code(200);
                    $GLOBALS['user_id'] = $token->user_id;
                    $GLOBALS['user_type'] = $token->user_type;
                    $GLOBALS['user_name'] = $token->user_name;
                    $GLOBALS['user_surname'] = $token->user_surname;
                }
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
