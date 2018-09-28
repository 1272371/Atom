<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="icon" type="image/png" href="../img/favicon.png">

	<title>Dashboard</title>

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
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <li>
                    <a href="grade.php">
                        <i class="pe-7s-note2"></i>
                        <p>Grade Book</p>
                    </a>
                </li>
                <li>
                    <a href="stats.php">
                        <i class="pe-7s-graph3"></i>
                        <p>Statistics</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
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


        <div class="content">
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

                                if (empty($_GET)){
                                    $student = "1234567";
                                } else {
                                    $student = $_GET['student'];
                                }

                                $link = mysqli_connect("localhost","1234567","password", "api_risk");

                                if (mysqli_connect_error()){
                                    die ("Error!");
                                }

                                $query = "SELECT * FROM user WHERE student_nr=".$student;
                                $result = mysqli_query($link, $query);

                                if ($row = mysqli_fetch_array($result)) {
                                echo "<h4 class='title'>".$row['user_name']." ".$row['user_surname']."<br />";
                                echo         "<small>".$row['student_nr']."</small>";
                                echo      "</h4>";
                                echo    "</a>";
                                echo "</div>";
                                echo "<p class='description text-center'>" ;
                                echo    $row['user_coursecode'];
                                }
  
                            ?>
                            <br>
                            </p>
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
                                class Dashboard{
                                    public function getLatestMarks(){

                                        $link = mysqli_connect("localhost","1234567","password", "api_risk");

                                        if (mysqli_connect_error()){
                                            die ("Error!");
                                        }

                                        if (empty($_GET)){
                                            $student = "1234567";
                                        } else {
                                            $student = $_GET['student'];
                                        }

                                      
                                       	$query2 = "SELECT percentage FROM grades WHERE user_id=".$student; 
                                        $query3 = "SELECT module_name,module_code FROM module";// WHERE grades.module = module.id";

                                        echo "<table class='table table-hover'>";

                                        echo "<thead>";
                                        echo        "<th>Subject</th>";
                                        echo        "<th>Subject Code</th>";
                                        echo        "<th>Current Mark (%)</th>";
                                        echo "</thead>";

                                        
                                        $result2= mysqli_query($link, $query2);
                                        $result3= mysqli_query($link, $query3);

                                        while ($row2 = mysqli_fetch_array($result2)) {
                                            
                                            	if ($row3 = mysqli_fetch_array($result3)){
                                            
                                            echo "<tr><td>".$row3['module_name']."</td><td>".$row3['module_code']."</td><td>".$row2['percentage']."</td></tr>";
                                        	}
                                    	}
                                        echo "</table>";
                                    }
                                }
                                Dashboard::getLatestMarks();
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="max-height: 400px;overflow:scroll">
                        <div class="card">
                            <div class="header">
                                <div class="dropdown" style="padding-left:17px;padding-top:10px">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Class
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                
                                <?php
                                    class buttonDropdown{

                                    public function listClasses(){

                                        $link = mysqli_connect("localhost","1234567","password", "api_risk");

                                        if (mysqli_connect_error()){
                                            die ("Error!");
                                        }

                                        $query2 = "SELECT module_code FROM module";
                                        
                                        $result2= mysqli_query($link, $query2);

                                        while ($row2 = mysqli_fetch_array($result2)) {
                                            echo "<li><a href='#'>".$row2['module_code']."</a></li>";
                                        }
                                    }

                                    }

                                    buttonDropdown::listClasses();
                                
                                ?>

                                </ul>
                                <span style="padding-left:30px;font-size:large">COMS2002</span>
                             </div>    
                            </div>
                            <div class="content table-responsive table-full-width" style="max-height:290px;overflow:scroll">
                                <table class="table table-hover">
                                
                                <?php

                                $link = mysqli_connect("localhost","1234567","password", "api_risk");

                                if (mysqli_connect_error()){
                                    die ("Error!");
                                }

                                $query = "SELECT * FROM user";
                                

                                echo "<table class='table table-hover'>";

                                echo "<thead>";
                                echo        "<th>Student Number</th>";
                                echo        "<th>Name</th>";
                                echo        "<th>Surname</th>";
                                echo        "<th>Latest Mark (%)</th>";
                                echo "</thead>";

                                $result = mysqli_query($link, $query);

                                while ($row = mysqli_fetch_array($result)) {

                                        $person=$row['student_nr'];
                                        $query2 = "SELECT ROUND(AVG(percentage)) FROM grades WHERE user_id=".$person;
                                        $result2= mysqli_query($link, $query2);
                                        $row2 = mysqli_fetch_array($result2);
                                    
                                    echo "<tr class='clickable-row' data-href='dashboard.php?student=$student'><td>".$row['student_nr']."</td><td>".$row['user_name']."</td><td>".$row['user_surname']."</td><td>".$row2['ROUND(AVG(percentage))']."</td></tr>"; 
                            }
                                echo "</table>";
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

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>


</html>
