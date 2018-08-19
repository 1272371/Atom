<?php
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'risk';
    $tb_query = 'select  * from person';
    
    $connect = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    // $result = mysqli_query($link, $tb_query);

    /*
     * if user is authenticated stay on the same page otherwise
     * redirect to login page 
     */
    header("Location: ../dist/login");
?>