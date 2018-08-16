<?php
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'risk';
    $tb_query = 'select  * from student';
    
    $link = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    $result = mysqli_query($link, $tb_query);
    echo mysqli_num_rows($result);
    /*
     * if user is authenticated stay on the same page otherwise
     * redirect to login page 
     */
    // header("Location: /dist/login");
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />

    <!--CSS-->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <script src="main.js"></script>
    <!--Title-->
    <!--Title & Icon-->
    <title>Risk - Welcome</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../img/favicon.png">
</head>
<body>

    <div class="card card-block d-flex" style="width: 18rem;">
        <img class="card-img-top" src="/img/view-grades-card.png" alt="Card image cap">
        <div class="card-body align-items-center justify-content-center">
            <h5 class="card-title">View grades</h5>
            <p class="card-text">check your grades</p>
            <a href="#" class="btn btn-primary btn-block">VIEW</a>
        </div>
    </div>

    <!--Scripts-->
    <script src="jquery/jquery.js"></script>
    <script src="bootstrap/bootstrap.js"></script>
    <script src="js/popper.min.js"></script>
</body>
</html>