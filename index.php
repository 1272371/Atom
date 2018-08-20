<?php include_once 'php/header.php'?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />

    <!--CSS-->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <!--Title & Icon-->
    <title>
        Welcome
        <?php
            if (isset($_SESSION['user_id'])) {
                echo ", ";
                echo $_SESSION['user_name'];
            }
        ?>
    </title>
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>
<body>
    <!-- Jumbotron -->
    <div class="container-fluid">
        <div class="row jumbotron">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                <h1 style="font-size:5rem;">teach, learn, collaborate</h1>
                <p class="lead">
                    Wits-e is an open source, interoperable, enterprise ready platform for e-learning
                    and collaboration at Wits. It is built on Sakai.
                </p>
            </div>
        </div>
    </div>

    <!-- Cards -->
    <div class="container-fluid padding">
        <div class="row padding">
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src="img/card/view-grades-card.png">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <p class="card-text">
                            In order to pass, you need to keep up with your grades,
                            check your grades regularly
                        </p>
                        <a href="#" class="btn btn-outline-secondary">View grades</a> <!--submit button-->
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src="img/card/view-grades-card.png">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <p class="card-text">
                            In order to pass, you need to keep up with your grades,
                            check your grades regularly
                        </p>
                        <a href="#" class="btn btn-outline-secondary">Graph overview</a> <!--submit button-->
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src="img/card/view-grades-card.png">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <p class="card-text">
                            In order to pass, you need to keep up with your grades,
                            check your grades regularly
                        </p>
                        <a href="#" class="btn btn-outline-secondary">Reports</a> <!--submit button-->
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src="img/card/view-grades-card.png">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <p class="card-text">
                            In order to pass, you need to keep up with your grades,
                            check your grades regularly
                        </p>
                        <a href="#" class="btn btn-outline-secondary">Summary</a> <!--submit button-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Slider -->
    <div id="img-slider" class="carousel slide mt-5 mb-5" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#img-slider" data-slide-to="0" class="active"></li>
            <li data-target="#img-slider" data-slide-to="1"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/carousel/slide-0.jpg">
                <div class="carousel-caption">
                    <button type="button" class="btn btn-outline-light btn-lg">Read more...</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/carousel/slide-1.jpg">
            </div>
        </div>
    </div>

    <!--Scripts-->
    <script src="jquery/jquery.js"></script>
    <script src="bootstrap/bootstrap.js"></script>
    <script src="js/popper.min.js"></script>
</body>
</html>