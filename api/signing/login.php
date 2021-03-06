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
            $user_id = $_POST["username"];
            $user_password =  $_POST["password"];

            if (empty($_POST["username"]) || empty($_POST["password"])) {
                echo json_encode(array('message' => 'error'));
                die;
            }

            $check = 'a';
            $pos = strpos($user_id, $check);
            if($pos === false){
                $user_idt = $user_id;
            }else{
                $user_idt =str_replace("a","",$user_id);
            }

            $token->user_id = intval($user_idt);
            $token->user_password = $user_password;


	        //host for students : ldap://ss.wits.ac.za/;ldap://146.141.8.201
            $ldap_con_student = ldap_connect("ldap://ss.wits.ac.za/;ldap://146.141.8.201");

            //host for staff : ldap://ds.wits.ac.za/;ldap://146.141.128.150
            $ldap_con_staff = ldap_connect("ldap://ds.wits.ac.za/;ldap://146.141.128.150");
            ldap_set_option($ldap_con_student, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap_con_staff, LDAP_OPT_PROTOCOL_VERSION, 3);

            // get user
            $token->setToken();

            if ( @ldap_bind($ldap_con_student,$user_id,$user_password) ||$token->ok || @ldap_bind($ldap_con_staff,$user_id,$user_password) ) {
                // response

                if($token->ok) {

                    http_response_code(200);
                    $GLOBALS['user_id'] = $token->user_id;
                    $GLOBALS['user_type'] = $token->user_type;
                    $GLOBALS['user_name'] = $token->user_name;
                    $GLOBALS['user_surname'] = $token->user_surname;
                }elseif(@ldap_bind($ldap_con_student,$user_id,$user_password)){
                    //this is the insert into db part
                    //instantiate new

                    $ldapfilter="(|(cn=".$user_id."))";
                    $ldapjustthese = array( "sn", "givenName");
                    //Students Context
                    $ldapcontext = "ou=students,ou=wits university,dc=ss,dc=wits,dc=ac,dc=za";
                    //Staff Context
                    //$ldapcontext = "ou=wits university,dc=ds,dc=wits,dc=ac,dc=za";

                    $sr=ldap_search($ldap_con_student, $ldapcontext, $ldapfilter, $ldapjustthese); //or die ("Error in search query: ".ldap_error($ldap_con_student));
                    $info = ldap_get_entries($ldap_con_student, $sr);

                    //Set values
                    $user_name = $info[0]["givenname"][0];
                    $user_surname = $info[0]["sn"][0];
                    $user_type = 2;
                    $faculty_name = 5;

                    //Add the user to our db
                    $connect = mysqli_connect('127.0.0.1','root','','risk');
                    /*if ($connect->connect_error) {
                        die("Connection failed: " . $connet->connect_error);
                    }*/
                    $sql = 'INSERT INTO user (user_id,user_name,user_surname,user_password,faculty_id,utl_id)
                            VALUES ('. $user_idt . ', "' . $user_name .
                            '", "' . $user_surname . '","'.password_hash($user_password,PASSWORD_DEFAULT).'", ' . $faculty_name . ', ' . $user_type . ')';
                    mysqli_query($connect,$sql);
                    mysqli_close($connect);

                    // remake token and login
                    $token->setToken();
                    http_response_code(200);
                    $GLOBALS['user_id'] = $token->user_id;
                    $GLOBALS['user_type'] = $token->user_type;
                    $GLOBALS['user_name'] = $token->user_name;
                    $GLOBALS['user_surname'] = $token->user_surname;

                }else{
                    //this is the insert into db part
                    //instantiate new

                    $ldapfilter="(|(cn=".$user_id."))";
                    $ldapjustthese = array( "sn", "givenName");
                    //Students Context
                    //$ldapcontext = "ou=students,ou=wits university,dc=ss,dc=wits,dc=ac,dc=za";
                    //Staff Context
                    $ldapcontext = "ou=wits university,dc=ds,dc=wits,dc=ac,dc=za";

                    $sr=ldap_search($ldap_con_staff, $ldapcontext, $ldapfilter, $ldapjustthese);//or die ("Error in search query: ".ldap_error($ldap_con_staff));
                    $info = ldap_get_entries($ldap_con_staff, $sr);

                    //Set values
                    $user_name = $info[0]["givenname"][0];
                    $user_surname = $info[0]["sn"][0];
                    $user_type = 2;
                    $faculty_name = 5;

                    //Add the user to our db
                    $connect = mysqli_connect('127.0.0.1','root','','risk');
                    $sql = 'INSERT INTO user (user_id,user_name,user_surname,user_password,faculty_id,utl_id)
                            VALUES ('. $user_idt . ', "' . $user_name .
                        '", "' . $user_surname . '","'.password_hash($user_password,PASSWORD_DEFAULT).'", ' . $faculty_name . ', ' . $user_type . ')';
                    mysqli_query($connect,$sql);
                    mysqli_close($connect);

                    // remake token and login
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
                http_response_code(200);
                echo json_encode(array('message' => 'error'));
            }
        }
        else {
            // couldn't login
            http_response_code(200);
            echo json_encode(array('message' => 'error'));
        }
    }
    else {

        // bad request
        header("HTTP/1.0 400 Bad Request");
        http_response_code(400);
    }