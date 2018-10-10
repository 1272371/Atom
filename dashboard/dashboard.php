<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="icon" type="image/png" href="../img/favicon.png">

	<title>Home</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.wits.ac.za" class="simple-text">
                    <img src="assets/img/wits-logo.png">
                </a>
            </div>
            

            <ul class="nav">
                <li class="active">
                    <a>
                        <i class="pe-7s-graph"></i>
                        <p>Home</p>
                    </a>
                </li>
                
                <li>
                    <?php
                    if (empty($_GET)){
                        $course_id = "1";
                        $student = "500594";
                        $date = "2018";
                    } else {
                        $course_id = $_GET['course_id'];
                        $student = $_GET['student'];
                        $date = $_GET['date'];
                    }
                    echo "<a href='grade.php?course_id=".$course_id."&student=".$student."&date=".$date."'>";
                    echo "<i class='pe-7s-note2'></i>";
                    echo "<p>Grade Book</p>";
                    echo "</a>";
                    ?>
                </li>
                <li>
                    <?php
                    if (empty($_GET)){
                        $course_id = "1";
                        $student = "500594";
                        $date = "2018";
                    } else {
                        $course_id = $_GET['course_id'];
                        $student = $_GET['student'];
                        $date = $_GET['date'];
                    }
                    echo "<a href='stats.php?course_id=".$course_id."&student=".$student."&date=".$date."'>";
                    echo     "<i class='pe-7s-graph3'></i>";
                    echo    "<p>Statistics</p>";
                    echo "</a>";
                    ?>
                </li>
                <li>
                    <?php
                    if (empty($_GET)){
                        $course_id = "1";
                        $student = "500594";
                        $date = "2018";
                    } else {
                        $course_id = $_GET['course_id'];
                        $student = $_GET['student'];
                        $date = $_GET['date'];
                    }

                    echo "<a href='upload.php?course_id=".$course_id."&student=".$student."&date=".$date."'>";
                    echo     "<i class='pe-7s-cloud-upload'></i>";
                    echo     "<p>Upload Marks</p>";
                    echo "</a>";
                    ?>
                </li>
                <li>
                    <a href="#">
                        <i class="pe-7s-power"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel" style="background-color: white">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                
            </div>
        </nav>


        <div class="content" style="background-color: white">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4" style="max-height: 400px;overflow:scroll">
                        <div class="card card-user">
                            <div class="image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="assets/img/faces/face-0.jpg" alt="..."/>
                                <?php
                                    //Dashboard::getStudentDetails();
                                    include_once('dashboardTest.php');
                                    TestingDashboard::getStudentDetails(); 
                                ?>
                            <br>
                            </a>
                                </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-md-4" style="max-height: 360px;overflow:scroll">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Latest Marks</h4>
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <?php
                                    //Dashboard::getLatestMarks();
                                    include_once('dashboardTest.php');
                                    TestingDashboard::getLatestMarks(); 
                                ?>
                            	
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="max-height: 360px;overflow:scroll">
                        <div class="card">
                            <div class="header">
                                <div class="dropdown" style="padding-left:17px;padding-top:10px">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Class
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                
                                <?php
                                    include_once('dashboardTest.php');
                                    TestingDashboard::listClasses(); 
                                ?>

                                </ul>
                            </div>

                            <div class="dropdown" style="padding-left:17px;padding-top:10px">

                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Year
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                   <?php
                                        include_once( 'dashboardTest.php');
                                        TestingDashboard::listDates();
                                    ?>
                                </ul>
                                <!--<span style="padding-left:30px;font-size:large">COMS2002</span>-->
                             </div>    
                            </div>
                            <div class="content table-responsive table-full-width" style="max-height:290px;overflow:scroll">
                                <table class="table table-hover">
                                
                                <?php
                                    include_once('dashboardTest.php');
                                    TestingDashboard::getStudentList(); 
                                ?>

                            <script>
                                            jQuery(document).ready(function($) {
                                            $(".clickable-row").click(function() {
                                                window.location = $(this).data("href");
                                            });
                                        });
                            </script>

                            </div>
                        </div>
                    </div>
                            
                </div>
            </div>

                

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Predictor</h4>
                            </div>
                            <div class="content">
                                <div class="ct-chart" style="width:100%">
                                    <img src="assets/img/trendline.png">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                        </div>
                    </div>
                </div>
 
</body>



    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>


	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>


</html>
