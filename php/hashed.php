<?php
    if (isset($_GET['pass'])) {
        $pass = $_GET['pass'];
        $hashed = password_hash($pass, PASSWORD_DEFAULT);
        echo $hashed;
    }
?>