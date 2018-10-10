<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="icon" type="image/png" href="../img/favicon.png">


    <title>Upload</title>

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
                    echo "<a href='dashboard.php?course_id=".$course_id."&student=".$student."&date=".$date."'>";
                    echo    "<i class='pe-7s-graph'></i>";
                    echo     "<p>Home</p>";
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
                <li class="active">
                    <a>
                        <i class="pe-7s-cloud-upload"></i>
                        <p>Upload</p>
                    </a>
                </li>
                <li>
                    <a href="../index.php">
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

        <form action="Uploader.php" method="post">
        <div class="content" style="background-color: white">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                        <div class="card" style="height:291px">

                        <div class="header">
                                <h4 class="title">Configurations</h4>
                        </div>

                        <div style="margin:10px">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="width:40%" name="Assignment_Type">Assignment Type
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dates">
                               <?php
                                    include_once( 'uploadTest.php');
                                    TestingUpload::getAssignmentType();
                                ?>
                            </ul>

                            <input  placeholder="Name of Assignmnet" id="name" type="text" class="form-control" style="width:40%;float: right;" name="Name_of_Assignmnet">
                        </div>

                        <div style="margin:10px">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="width:40%">Course
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dates">
                               <?php
                                    include_once( 'uploadTest.php');
                                   TestingUpload::listClasses();
                                ?>
                            </ul>

                            <input  placeholder="Assignment Weight" id="weight" type="text" class="form-control" style="width:40%;float: right;" name="Assignment_Weight">

                        </div>

                        <div style="margin:10px;padding-bottom: 10px">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="width:40%">Medium Lookup
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dates">
                               <?php
                                    include_once( 'uploadTest.php');
                                    TestingUpload::getMedium();
                                ?>
                            </ul>

                            <input  placeholder="Total Available Marks" id="total" type="text" class="form-control" style="width:40%;float: right;" name="Total_Available_Marks">
                        </div>

                    </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">File Selector</h4>
                            </div>
                            <div class="content">
                                <style>
                                #drop_zone {

                                    background-color: #EEE;
                                    border: #999 5px dotted;
                                   
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

                                <textarea cols="140" rows="10" name="mark" id="fileDisplayArea" ><?php $mark;?></textarea>
                                <input type="submit" class="btn btn-primary" style="color: blue;border-color-color: blue" id="UploadButton"  value="Upload">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
    <script src="C:\xampp\htdocs\java\src\testing.php"></script>
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
