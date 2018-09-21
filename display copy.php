<?php

    mysqli_connect("localhost","api_risk",);

    if (mysqli_connect_error()){
      echo "There was an error connecting to the database";

    } else {
      echo "Database connection successful!";
    }

?>