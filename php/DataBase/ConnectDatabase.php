<?php

$dbHost;
$dbUsername;
$dbPassword;
$dbName;
$dbConnected;

class ConnectDatabase {

    public function setUpDatabaseVariables() {
        $connected = @fsockopen('www.google.com', 80);

        if ($connected) {
            /** connect to wits remote server */
            $dbConnected = true;
            header('Location: http://lamp.ms.wits.ac.za/~815108/ConnectDatabase.php');
        }
        else {
            /** connect to xampp local server */
            $db_host = 'localhost';
            $db_username = 'root';
            $db_password = '';
            $db_name = 'risk';
            $dbConnected = false;
        }
    }
    
}