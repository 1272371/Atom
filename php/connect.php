<?php

    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'risk';
    $tb_query = 'select  * from user';
    
    $connect = mysqli_connect($db_host, $db_username, $db_password, $db_name);
?>