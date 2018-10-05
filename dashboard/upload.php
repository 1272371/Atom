<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="icon" type="image/png" href="../img/favicon.png">


    <title>Statistics</title>

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
                <li>
                    <a href="dashboard.php">
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
                <li class="active">
                    <a href="#">
                        <i class="pe-7s-cloud-upload"></i>
                        <p>Upload</p>
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
                    <a class="navbar-brand" href="#">Upload Marks</a>
                     
            </div>
        </nav>


        <div class="content" style="background-color: white">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">

                        <div class="header">
                                <h4 class="title">Configurations</h4>
                            </div>

                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Assignment Type
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="dates">
                           <?php
                                include_once( 'gradeTest.php');
                                echo TestingGrade::listDates();
                            ?>
                        </ul>

                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Course
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="dates">
                           <?php
                                include_once( 'gradeTest.php');
                                echo TestingGrade::listDates();
                            ?>
                        </ul>

                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Medium Lookup
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="dates">
                           <?php
                                include_once( 'gradeTest.php');
                                echo TestingGrade::listDates();
                            ?>
                        </ul>

                        <textarea id="name">Name of Assignment</textarea>
                        <textarea id="weight">Weight</textarea>
                        <textarea id="total">Total</textarea>
                    </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">File Selector</h4>
                            </div>
                            <div class="content">
                                <style>
                                #drop_zone {

                                    background-color: #EEE;
                                    border: #999 5px dotted;
                                    width: 290px;
                                    height: 200px;
                                    padding: 8px;
                                    font-size: 18px;
                                    
                                }
                            </style>

                            
                            <div  id="drop_zone" ondrop="drag_drop(event)" ondragover="return false" ></div>
                            <input type="file"  id="fileInput">
                            <script src="assets/js/uploadFunctions.js"></script>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">File Preview</h4>
                                
                            </div>
                            <div class="content">
                                 <pre id="fileDisplayArea"></pre>

                                <button>Upload</button>
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

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            demo.initChartist();
        });
    </script>

</html>
