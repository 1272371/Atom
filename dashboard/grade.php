<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<title>Grade Book</title>

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
    <div class="sidebar" data-color="blue" >
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.wits.ac.za" class="simple-text">
                    <img src="assets/img/wits-logo.png">
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
                    <a>
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
                <li>
                    <a href="#">
                        <i class="pe-7s-cloud-upload"></i>
                        <p>Upload Marks</p>
                    </a>
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
                    <a class="navbar-brand" href="#">Grade Book</a>
                    <div class="dropdown" style="padding-left:10px;padding-top:10px">
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
        </div> 
                </div>
            </div>
        </nav>


        <div class="content" style="overflow:scroll;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">COMS2002</h4>
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <?php

                                    $link = mysqli_connect("localhost","root","", "database");

                                    if (mysqli_connect_error()){
                                        die ("Error!");
                                    }

                                    $query = "SELECT * FROM user";
                                    

                                    echo "<table class='table table-hover'>";
                                    echo "<thead>";
                                    echo        "<th>Student Number</th>";
                                    echo        "<th>Name</th>";
                                    echo        "<th>Faculty</th>";
                                    echo        "<th>YOS</th>";
                                    echo        "<th>Current Average (%)</th>";
                                    echo "</thead>";

                                    $result = mysqli_query($link, $query);
                                    

                                    while ($row = mysqli_fetch_array($result)) {
                                        
                                        $person=$row['user_id'];
                                        $query2 = "SELECT ROUND(AVG(percentage)) FROM grades where user_id=".$person;
                                        //$result2= mysqli_query($link, $query2);
                                        //$row2 = mysqli_fetch_array($result2);

                                        $student = $person;
                                       
                                        echo "<tr style='cursor:pointer;' class='clickable-row' data-href='dashboard.php?student=$student'><td>".$row['user_id']."</td><td>".$row['user_name']." ".$row['user_surname']."</td><td>"."<a href='dashboard.php' type='button' class='btn btn-light btn-sm'>More Info</a>"."</td></tr>";

                                        /*
											echo "<tr style='cursor:pointer;' class='clickable-row' data-href='dashboard.php?student=$student'><td>".$row['user_id']."</td><td>".$row['user_name']." ".$row['user_surname']."</td><td>".$row['user_coursecode']."</td><td>"."2018 - ".$row['user_enrollmentyear']."</td><td>".$row2['ROUND(AVG(percentage))']."</td><td>"."<a href='dashboard.php' type='button' class='btn btn-light btn-sm'>More Info</a>"."</td></tr>";
                                        */

                                   
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

                            </table>
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
