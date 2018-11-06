<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="icon" type="image/png" href="../img/favicon.png">

	<title>Generate Report</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
      <link href="../css/pe-icon-7-stroke.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


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
                    <img src="../wits-logo.png">
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
                    <a>
                        <i class='pe-7s-note2'></i>
                        <p>Grade Book</p>
                    </a>
                </li>
                <li>
                    <a>
                        <i class='pe-7s-graph3'></i>
                        <p>Statistics</p>
                    </a>
                    
                </li>
                <li>
                    <a>
                        <i class='pe-7s-cloud-upload'></i>
                        <p>Upload</p>
                    </a>
                </li>
                <li>
                    <a>
                        <i class='pe-7s-paperclip'></i>
                        <p>Report</p>
                    </a>
                </li>
                <li>
                    <a>
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
                       
                    </button>
                    <a class="navbar-brand" href="#">Generate Report</a>
                </div>
                
            </div>
        </nav>


        <div class="content" style="background-color: white">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" style="overflow:scroll">
                        <div class="card">
                            <div class="content">
                                
                                    <h3 >Please specify the format of the report you would like to generate:</h3>
                                    
                                    
                                <hr>

                                <h3 style="margin-left: 40%">General Report </h3>

                                <a href="report.php"><button type="button" style="margin-left: 45%" class="btn btn-secondary">Generate</button></a>

                                <hr>

                                <h3 style="margin-left: 38%">Specialized Report</h3>

                                <h4 style="margin-left: 46%">Course</h4>

                                <form>
                                    <div style="margin-left: 37%">
                                        <label class="radio-inline">
                                          <input type="radio" name="course" value="bco" checked>Basic Computer Organisation
                                        </label>
                                    </div>
                                    <div style="margin-left: 32%"> 
                                        <label class="radio-inline">
                                          <input type="radio" name="course" value="iap">Introduction to Algorithms and Programming
                                        </label>
                                    </div>
                              </form>

                              <h4 style="margin-left: 43%">Assessment</h4>

                                <form>
                                

                                <?php

                                //DO ERROR CHECKING COURSE BETWEEN 1 - 18 and 19-
                                    $link = mysqli_connect("localhost","root","", "risk");

                                    if (mysqli_connect_error()){
                                        die ("Error!");
                                    }

                                    $query = "SELECT assessment_id, assessment_name FROM assessment"; 

                                    $result= mysqli_query($link, $query);
                                    $count=0;
                                    while ($row = mysqli_fetch_array($result)){

                                        echo "<div style='margin-left: 44%'>";
                                        echo "<label class='radio-inline'>";
                                        if ($count==0){
                                        echo "<input type='radio' name='assessment' checked value=".$row['assessment_id'].">";
                                        } else{
                                            echo "<input type='radio' name='assessment' value=".$row['assessment_id'].">";
                                        }
                                        echo $row['assessment_name'];
                                        echo "</label>";
                                        echo "</div>";
                                    }
                                ?>
                              </form>

                              <button type="button" style="margin-left: 45%" onclick="check()" class="btn btn-primary">Generate</button>
                                
                                <script>
                                    function check(){
                                        var course = document.querySelector('input[name="course"]:checked').value;
                                        
                                        var assessment = document.querySelector('input[name="assessment"]:checked').value;
                                        
                                        window.location="specificReport.php?course="+course+"&assessment="+assessment;

                                        
                                        /*$('input[type=radio][name=course]').change(function() {
                                        if (this.value == 'none') {
                                            alert("none");
                                             document.write("none");
                                        }
                                        else if (this.value == 'bco') {
                                            alert("bco");
                                            document.write("bco");
                                        } 
                                        else if (this.value == 'iap') {
                                            alert("iap");
                                            document.write("iap");
                                        });*/
                                    
                                    }
                                   
                                    /*$('input[type=radio][name=type1]').change(function() {
                                    if (this.value == 'general') {
                                        alert("Allot Thai Gayo Bhai");
                                    }
                                    else if (this.value == 'specific') {
                                        alert("Transfer Thai Gayo");
                                    }
                                    });*/

                                   
                                </script>
                            </div>
                        </div>     
                    </div>
                </div>
            </div>
        </div>

    </div>
 
</body>



    <!--   Core JS Files   -->
    <script src="../js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>

    
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="../js/light-bootstrap-dashboard.js?v=1.4.0"></script>


	<!--  Charts Plugin -->
	<script src="../js/chartist.min.js"></script>


</html>
