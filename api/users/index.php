<?php

    $query = explode("&", $_SERVER['QUERY_STRING']);
    $count = count($query);

    if ($count == 1) {

        if (strlen($query[0]) == 0) {

            // no query string get all users
            header("Location: get.php?redirect=true");
        }
        else {

            /**
             * single query string
             * get user with same id
             * get users with same name
             * get users with same surname
             */
            header("Location: user.php?" . $query[0] . '&redirect=' . password_hash('1', PASSWORD_DEFAULT));
        }
    }