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
                	<?php
                    if (empty($_GET)){
                        $course_id = "1";
                         $student = "500594";
                    } else {
                        $course_id = $_GET['course_id'];
                        $student = $_GET['student'];
                    }
                    echo "<a href='dashboard.php?course_id=".$course_id."&student=".$student."'>";
                    echo    "<i class='pe-7s-graph'></i>";
                    echo     "<p>Dashboard</p>";
                    echo "</a>";
                    ?>
                </li>
                <li>
                	<?php
                    if (empty($_GET)){
                        $course_id = "1";
                         $student = "500594";
                    } else {
                        $course_id = $_GET['course_id'];
                        $student = $_GET['student'];
                    }
                    echo "<a href='grade.php?course_id=".$course_id."&student=".$student."'>";
                    echo    "<i class='pe-7s-note2'></i>";
                    echo     "<p>Grade Book</p>";
                    echo "</a>";
                    ?>
                </li>
                
                <li class="active">
                    <a>
                        <i class="pe-7s-graph3"></i>
                        <p>Statistics</p>
                    </a>
                </li>
                <li>
                    <a href="upload.php">
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
                    <a class="navbar-brand" href="#">Statistics</a>
                     <div class="dropdown" style="padding-left:10px;padding-top:10px">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Class
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">

                                
                                <?php
                                    include_once('statsTest.php');
                                    echo StatsTesting::listClasses();
                                ?>

                                </ul>
                        </div>

                        <div class="dropdown" style="float:left;padding-left:10px" >
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" >Year
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="dates">
                           <?php
                                include_once( 'gradeTest.php');
                                StatsTesting::listDates();
                            ?>
                        </ul>
                        </div> 
            </div>
        </nav>


        <div class="content" style="background-color: white">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Class Statistics</h4>
                                <p class="category">COMS2002</p>
                            </div>
                            <div class="content">
                                <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Passed
                                        <i class="fa fa-circle text-danger"></i> Failed
                                        <i class="fa fa-circle text-warning"></i> Risky
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Student Performance</h4>
                                <p class="category">COMS2002</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart"></div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Passed
                                        <i class="fa fa-circle text-danger"></i> Failed
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="piechart" style="width: 900px; height: 500px;"></div>
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
    <script src="../js/axios.js"></script>
    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      var  pass=0
      var  fail=0
      var course_id="<?php echo $_GET['course_id']; ?>";
      console.log(course_id)
          axios.get('../api/getgrades.php?course='+course_id+'').then(function(res){
            this.pass=res.data.pass
            this.fail=res.data.fail
      })

      $(document).ready(function(){
          demo.initChartist();
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Task', 'Hours per Day'],
              ['Pass',     pass],
              ['Fail',      fail],
            ]);

            var options = {
              title: 'Course Name'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
          }
      });
    </script>
</html>
