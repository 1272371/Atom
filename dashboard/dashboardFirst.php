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

    <script src="assets/js/jquery.3.3.1.min.js" type="text/javascript"></script>


    <!--     Fonts and icons     
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
-->

</head>
<body>

<div style="background-color: white">
    <div  style="background-color: white">
        <nav class="navbar navbar-default navbar-fixed" >
            <div class="container-fluid" >
                <div class="navbar-header" align="center" >
                    <h3>Welcome to the Student Risk Analysis Dashboard</h3>
                </div>
                
            </div>
        </nav>


        <div class="content" style="background-color: white;">
            <div class="container-fluid">
                <div class="row">

                    <style>
                        .card:hover{
                            width: 105%;
                            height: 105%;
                            border: 2px solid ;
                        }
                    </style>
                    
                    <div class="col-md-4" style="max-height:300px">
                        <div class="card" style="height: 300px;">
                            <div class="header" align="center">
                                <h4 class="title">Home</h4>
                                <a href="dashboard.php">
                                    <img style="height:250px" src="../img/house.svg">
                                </a>
                            </div>
                            <div class="content">
                                
                                    
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card" style="height: 300px">
                            <div class="header" align="center">
                                <h4 class="title">Grade Book</h4>
                                <a href="grade.php">
                                    <img style="height:250px" src="../img/books.svg">
                                </a>
                            </div>
                            <div class="content">
                                
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card" style="height: 300px">
                            <div class="header" align="center">
                                <h4 class="title">Statistics</h4>
                                <a href="stats.php">
                                <img style="height:250px" src="../img/pie-chart.svg">
                                </a>
                            </div>
                            <div class="content">
                                
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card" style="height: 300px">
                            <div class="header" align="center">
                                <h4 class="title">Upload Marks</h4>
                                <a href="upload.php">
                                    <img style="height:250px" src="../img/upload.svg">
                                </a>
                            </div>
                            <div class="content">
                                
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card" style="height: 300px">
                            <div class="header" align="center">
                                <h4 class="title"></h4>
                                
                            </div>
                            <div class="content">
                                
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card" style="height: 300px">
                            <div class="header" align="center">
                                <h4 class="title">Logout</h4>
                                <a href="#">
                                    <img style="height:250px" src="../img/logout.svg">
                                </a> 
                            </div>
                            <div class="content">
                                
                                    
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
