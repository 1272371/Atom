<?php

    $query = explode("&", $_SERVER['QUERY_STRING']);
    $count = count($query);

    if ($count == 1) {

        if (strlen($query[0]) == 0) {

            // no query was passed in
            header("Location: get.php");
        }
        else {

            // redirect to relevant page
            header("Location: user.php?" . $query[0]);
        }
    }