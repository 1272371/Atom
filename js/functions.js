function Login()
{
	var username=$('#username').val()
	var password=$('#password').val()
	console.log(username)
	if(username.length>0 && password.length>0)
	{
		
		axios.post('api/login',{username:username,password:password}).then(function(res){
			console.log(res)
			if(res.data.status==="Success")
			{
				//redirect to the dashboard
				window.location.href="apiDashboard.html"
				
			}
			else
			{
				/*
					Show an error modal
					and reset the inputs
				*/
				ResponseModal(res.data.status)
			}
		})
		$.ajax({
			url:'api/login',
			contentType:'application/json',
			processData:false,
			data:'{"username:"'+username+'","password":"'+password+'"}',
			success:function(r)
			{
				console.log(r)
			},
			error:function(r)
			{
				console.log(r)
			}

		})

	}
	else
	{
		//Show an Error modal
		message='Fill in all fields'
		ResponseModal(message)
	}
}

/*
	Checks If the user is logged in or not
*/
function IsLogged()
{
	axios.get('api/logged').then(function(res){
		if(res.data.status==='True')
		{
			//stay on the dashboard
		}
		else
		{
			window.location.href="testing_login.html"
		}
	})
}

function DashboardRedirect()
{
	axios.get('api/logged').then(function(res){
		if(res.data.status==='True')
		{
			window.location.href="api_dashboard.html"
		}
	})
}

function Register()
{

	var username=$('#username').val()
	var password=$('#password').val()
	var confirm=$('#confirm').val()
	var type=$('#type').val()
	var name=$('#name').val()
	var surname=$('#surname').val()
	var faculty=$('#faculty').val()
	var school=$('#school').val()
	var enroll_year=$('#enroll_year').val()
	console.log(type)
	if(username.length==0 || password.length==0 || confirm.length==0 || type.length==0 || name.length==0 || surname.length==0 || faculty.length==0 || school.length==0 || enroll_year.length==0)
	{	
		/*
			Fill in all fields modal
		*/
		var message="Fill In All Fields"
		ResponseModal(message)
	}
	else
	{
		if(password !== confirm)
		{
			/*
				Passwords do not match modal
			*/
			var message="Passwords Do Not Match"
			ResponseModal(message)
		}
		else
		{
			axios.post('api/register',{username:username, password:password, confirm:confirm, type:type, name:name, surname:surname, faculty:faculty,school:school,enroll_year:enroll_year}).then(function(res){
				if(res.data.status==="Success")
				{
					/*
						Account created successfully
					*/
					ResponseModal(res.data.status)

					setInterval(function(){
						//redirect to the login page
					},3000)
				}
				else
				{
					/*
						Error on some data format or an unknown error
					*/
					ResponseModal(res.data.status)
				}
			})
		}
	}
}


function ResponseModal(res)
{
	$('#response').html(`
	<div class="modal container-fluid" id="responseModal">
		<div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title"><center></center></h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		        	<h5><center>`+res+`</center></h5>
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
		      </div>

		    </div>
	  	</div>
	</div>`)

	$('#responseModal').modal('show')
}

function RegisterView()
{
	$('#content').append(` 
	<div class="container">
	  <div class="form-group">
	    <label for="username">Student/Staff:</label>
	    <input type="text" class="form-control" id="username" placeholder="Staff/Student number">
	  </div>
	  <div class="form-group">
	    <label for="password">Password:</label>
	    <input type="password" class="form-control" id="password" placeholder="Password">
	  </div>
	  <div class="form-group">
	    <label for="confirm">Confirm Password:</label>
	    <input type="password" class="form-control" id="confirm" placeholder="Confirm Password">
	  </div>
	  <div class="form-group">
	  	<!--
	    <label for="type">Type:</label>
	    -->
	    <!--
	    	<input type="text" class="form-control" id="type" placeholder="Type">
	    -->
	    <select id="type" class="form-group">
	    	<option value="">Type</option>
	    	<option value="Student">Student</option>
	    	<option value="Staff">Staff</option>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="confirm">Name:</label>
	    <input type="text" class="form-control" id="name" placeholder="Name" >
	  </div>
	  <div class="form-group">
	    <label for="confirm">Surname:</label>
	    <input type="text" class="form-control" id="surname" placeholder="Surname">
	  </div>
	  <div class="form-group">
	    <label for="confirm">Faculty:</label>
	    <input type="text" class="form-control" id="faculty" placeholder="Faculty">
	  </div>
	  <div class="form-group">
	    <label for="confirm">School:</label>
	    <input type="text" class="form-control" id="school" placeholder="School">
	  </div>
	  <div class="form-group">
	    <label for="confirm">Enroll Year:</label>
	    <input type="text" class="form-control" id="enroll_year" placeholder="Enroll Year">
	  </div>

	  <!--
	  <div class="form-group form-check">
	    <label class="form-check-label">
	      <input class="form-check-input" type="checkbox"> Remember me
	    </label>
	  </div>
	  -->
	  <button onclick="Register()" class="btn btn-primary">Submit</button>
	</div> `)
}
/**
 * code is now in index.php
function LoginHeader()
{
	$('#content').append(`
	<header>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md navbar-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img class="img-fluid" src="img/asset/wits-logo.png" style="width: 96px; height: 57px;"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item ml-2 mr-2 active">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item ml-2 mr-2">
                            <a class="nav-link" href="dist/about/">About</a>
                        </li>
                        <li class="nav-item ml-2 mr-4">
                            <a class="nav-link" href="dist/team/">Team</a>
                        </li>
                        <li class="nav-item">
                            
                                <input class="form-module ml-2 mr-2" style="width: 10vw" type="text" name="user" id="username" placeholder="Username">
                                <input class="form-module ml-2 mr-2" style="width: 10vw" type="password" name="pass" id="password" placeholder="Password">
                                <button class="btn btn-outline-secondary ml-2 mr-2" style="color: #fff" type="submit" name="login" onclick="Login()" >Sign In</button>
                          
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>`)
}
*/

function LoginPageContent()
{
	$('#content').append(`    
		<!-- Jumbotron -->
	    <div class="container-fluid mt-5">
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
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-md-12 col-lg-3">
	                <div class="card mx-auto w-75">
	                    <img class="card-img-top" src="img/card/view-grades-card.png">
	                    <div class="card-body">
	                        <div class="text-center">
	                            <a href="#" class="btn btn-primary w-100">Staff Training</a> <!--submit button-->
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-12 col-lg-3">
	                <div class="card mx-auto w-75">
	                    <img class="card-img-top" src="img/card/view-grades-card.png">
	                    <div class="card-body">
	                        <div class="text-center">
	                            <a href="#" class="btn btn-danger w-100">Help</a> <!--submit button-->
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-12 col-lg-3">
	                <div class="card mx-auto w-75">
	                    <img class="card-img-top" src="img/card/view-grades-card.png">
	                    <div class="card-body">
	                        <div class="text-center">
	                            <a href="#" class="btn btn-warning w-100">Getting Started</a> <!--submit button-->
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-12 col-lg-3">
	                <div class="card mx-auto w-75">
	                    <img class="card-img-top" src="img/card/view-grades-card.png">
	                    <div class="card-body">
	                        <div class="text-center">
	                            <a href="#" class="btn btn-success w-100">About Us</a> <!--submit button-->
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- Image Slider -->
	    <div class="row">
	        <div class="col-lg-2"></div>
	        <div class="col-lg-8">
	            <div id="img-slider" class="carousel slide mt-5 mb-5 col-12 pl-4 pr-4" data-ride="carousel">
	                <ul class="carousel-indicators">
	                    <li data-target="#img-slider" data-slide-to="0" class="active"></li>
	                    <li data-target="#img-slider" data-slide-to="1"></li>
	                </ul>
	                <div class="carousel-inner">
	                    <div class="carousel-item active">
	                        <img class="img-fluid w-100" src="img/carousel/slide-0.jpg">
	                        <div class="carousel-caption">
	                            <a href="http://www.wits.ac.za/news/latest-news/research-news/2018/2018-08/wits-signs-memorandum-of-understanding-with-perot-museum.html"
	                                role="button"class="btn btn-outline-light btn-lg">
	                                Read more...
	                            </a>
	                        </div>
	                    </div>
	                    <div class="carousel-item">
	                        <img class="img-fluid w-100" src="img/carousel/slide-1.jpg">
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-lg-2"></div>
	    </div>

	    <div class="row mb-4">
	        <div class="col text-center">
	            <p class="h2">Quick Links</p>
	        </div>
	    </div>

	    <div class="row pb-4">
	        <div class="col-lg-4"></div>
	        <div class="col-lg-4">
	            <div class="row">
	                <div class="col">
	                    <a href="php/database.html">
	                        <img class="rounded img-fluid" src="img/button/database.png">
	                    </a>
	                </div>
	                <div class="col">
	                    <a href="php/database.html">
	                        <img class="rounded img-fluid" src="img/button/database.png">
	                    </a>
	                </div>
	                <div class="col">
	                    <a href="php/database.html">
	                        <img class="rounded img-fluid" src="img/button/database.png">
	                    </a>
	                </div>
	                <div class="col">
	                    <a href="php/database.html">
	                        <img class="rounded img-fluid" src="img/button/database.png">
	                    </a>
	                </div>
	            </div>
	        </div>
	        <div class="col-lg-4"></div>
	    </div>`
    )
	$('#img-slider').carousel()
}
function Dashboard()
{
	$('#content').append(`
		<div class="wrapper">
		    <div class="sidebar" data-color="blue">
		    	<div class="sidebar-wrapper">
		            <div class="logo">
		                <a href="http://www.wits.ac.za" class="simple-text">
		                    <img src="img/wits-logo.png">
		                </a>
		            </div>
		            <ul class="nav">
						<li class="active" id="dashboard">
		                	<a>
		                        <i class="pe-7s-graph active"></i>
		                        <p>Dashboard</p>
	                        </a>
		                </li>
		                <li id="profile">
		                	<a>
		                        <i class="pe-7s-user"></i>
		                        <p>User Profile</p>
		                    </a>
		                </li>
		                <li id="grade">
		                	<a>
		                        <i class="pe-7s-note2"></i>
		                        <p>Grade Book</p>
	                        </a>
		                </li>
		                <li id="stats">
		                	<a>
		                        <i class="pe-7s-graph3"></i>
		                        <p>Statistics</p>
		                    </a>
		                </li>
		                <li id="settings">
		                	<a>
	                        	<i class="pe-7s-settings"></i>
	                        	<p>Settings</p>
	                        </a>
		                </li>
		                <li id="settings">
		                	<a onclick="LogoutModal()">
	                        	<i class="pe-7s-power"></i>
	                        	<p>Logout</p>
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

		        <!--Dashboard Start-->
		        <div class="content" id="dashboard_view">
		            <div class="container-fluid">
		                <div class="row">
		                    <div class="col-md-4">
		                        <div class="card card-user">
		                            <div class="image">
		                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
		                            </div>
		                            <div class="content">
		                                <div class="author">
		                                     <a href="#">
		                                    <img class="avatar border-gray" src="dashboard/assets/img/faces/face-0.jpg" alt="..."/>

		                                      <h4 class="title">Phillip Chaney<br />
		                                         <small>2005890</small>
		                                      </h4>
		                                    </a>
		                                </div>
		                                <p class="description text-center"> 
		                                    Science 
		                                    <br>
		                                        BSc Gen 
		                                    <br>
		                                                   
		                                </p>
		                            </div>
		                            <hr>
		                            
		                        </div>
		                    </div>
		                    <div class="col-md-4">
		                        <div class="card">
		                            <div class="header">
		                                <h4 class="title">Latest Marks</h4>
		                                
		                            </div>
		                            <div class="content table-responsive table-full-width">
		                                <table class="table table-hover">
		                                    <tr>
		                                        <th>Subject</th>
		                                        <th>Subject Code</th>
		                                        <th>Mark (%)</th>
		                                    </tr>
		                                    <tbody>
		                                        <tr>
		                                            <td>Physics</td>
		                                            <td>PHYS1002</td>
		                                            <td>67</td>
		                                        </tr>
		                                        <tr>
		                                            <td>Applied Mathematics</td>
		                                            <td>APPM1001</td>
		                                            <td>76</td>
		                                        </tr>
		                                        <tr>
		                                            <td>Computer Science</td>
		                                            <td>COMS1006</td>
		                                            <td>92</td>
		                                        </tr>
		                                        <tr>
		                                            <td>Mathematics</td>
		                                            <td>MATH1010</td>
		                                            <td>78</td>
		                                        </tr>
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="col-md-4">
		                        <div class="card">
		                            <div class="header">
		                                <h4 class="title">Class List</h4>
		                                
		                            </div>
		                            <div class="content table-responsive table-full-width">
		                                <table class="table table-hover">
		                                    <tr>
		                                        <th>ID</th>
		                                        <th>Name</th>
		                                        <th>Faculty</th>
		                                        <th>YOS</th>
		                                        <th>Current Average</th>
		                                    </tr>
		                                    <tbody>
		                                        <tr>
		                                            <td>1</td>
		                                            <td>Dakota Rice</td>
		                                            <td>Science</td>
		                                            <td>2</td>
		                                            <td>76%</td>
		                                        </tr>
		                                        <tr>
		                                            <td>2</td>
		                                            <td>Minerva Hooper</td>
		                                            <td>Science</td>
		                                            <td>2</td>
		                                            <td>50%</td>
		                                        </tr>
		                                        <tr>
		                                            <td>3</td>
		                                            <td>Sage Rodriguez</td>
		                                            <td>Science</td>
		                                            <td>3</td>
		                                            <td>87%</td>
		                                        </tr>
		                                        <tr class="active">
		                                            <td>4</td>
		                                            <td>Philip Chaney</td>
		                                            <td>Science</td>
		                                            <td>3</td>
		                                            <td>39%</td>
		                                        </tr>
		                                    </tbody>
		                                </table>

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
		                                <img src="img/trendline.png">
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
                </div>
                <!--End Of Dashboard-->

				<!--Start Of Edit Profile-->                
                <div class="content" id="profile_view">
		            <div class="container-fluid">
		                <div class="row">
		                    <div class="col-md-8">
		                        <div class="card">
		                            <div class="header">
		                                <h4 class="title">Edit Profile</h4>
		                            </div>
		                            <div class="content">
		                                <form>
		                                    <div class="row">
		                                        <div class="col-md-5">
		                                            <div class="form-group">
		                                                <label>Company (disabled)</label>
		                                                <input type="text" class="form-control" disabled placeholder="Company" value="Creative Code Inc.">
		                                            </div>
		                                        </div>
		                                        <div class="col-md-3">
		                                            <div class="form-group">
		                                                <label>Stu Num</label>
		                                                <input type="text" class="form-control" placeholder="Username" value="765636">
		                                            </div>
		                                        </div>
		                                        <div class="col-md-4">
		                                            <div class="form-group">
		                                                <label for="exampleInputEmail1">Email address</label>
		                                                <input type="email" class="form-control" placeholder="Email" value="drake@music.com">
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-6">
		                                            <div class="form-group">
		                                                <label>First Name</label>
		                                                <input type="text" class="form-control" placeholder="Company" value="Aubrey">
		                                            </div>
		                                        </div>
		                                        <div class="col-md-6">
		                                            <div class="form-group">
		                                                <label>Last Name</label>
		                                                <input type="text" class="form-control" placeholder="Drake Graham" value="Andrew">
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-12">
		                                            <div class="form-group">
		                                                <label>Address</label>
		                                                <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-4">
		                                            <div class="form-group">
		                                                <label>City</label>
		                                                <input type="text" class="form-control" placeholder="City" value="Mike">
		                                            </div>
		                                        </div>
		                                        <div class="col-md-4">
		                                            <div class="form-group">
		                                                <label>Country</label>
		                                                <input type="text" class="form-control" placeholder="Country" value="Andrew">
		                                            </div>
		                                        </div>
		                                        <div class="col-md-4">
		                                            <div class="form-group">
		                                                <label>Postal Code</label>
		                                                <input type="number" class="form-control" placeholder="ZIP Code">
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-12">
		                                            <div class="form-group">
		                                                <label>Previous School</label>
		                                                <input type="text" class="form-control" placeholder="City" value="St John's">
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-12">
		                                            <div class="form-group">
		                                                <label>About Student</label>
		                                                <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike">Currenly on a bursary from Universal Studios.</textarea>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="clearfix"></div>
		                                </form>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="col-md-4">
		                        <div class="card card-user">
		                            <div class="image">
		                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
		                            </div>
		                            <div class="content">
		                                <div class="author">
		                                     <a href="#">
		                                    <img class="avatar border-gray" src="img/faces/face-3.jpg" alt="..."/>

		                                      <h4 class="title">Mike Andrew<br />
		                                         <small>michael24</small>
		                                      </h4>
		                                    </a>
		                                </div>
		                                <p class="description text-center"> "Lamborghini Mercy <br>
		                                                    Your chick she so thirsty <br>
		                                                    I'm in that two seat Lambo"
		                                </p>
		                            </div>
		                            <hr>
		                            <div class="text-center">
		                                <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
		                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
		                                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

		                            </div>
		                        </div>
		                    </div>

		                </div>
		            </div>
		        </div>
		        <!--End Of Edit Profile-->

		        <!-- Settings Start-->
		        <div class="content" id="settings_view">
		            <div class="container-fluid">
		                <div class="row">
		                    <div class="col-md-12">
		                        <div class="card">
		                            <div class="header">
		                                <h4 class="title">Light Bootstrap Table Heading</h4>
		                                <p class="category">Created using Roboto Font Family</p>
		                            </div>
		                            <div class="content">

		                                <div class="typo-line">
		                                    <h1><p class="category">Header 1</p>Light Bootstrap Table Heading </h1>
		                                </div>

		                                    <div class="typo-line">
		                                    <h2><p class="category">Header 2</p>Light Bootstrap Table Heading</h2>
		                                </div>
		                                <div class="typo-line">
		                                    <h3><p class="category">Header 3</p>Light Bootstrap Table Heading</h3>
		                                </div>
		                                <div class="typo-line">
		                                    <h4><p class="category">Header 4</p>Light Bootstrap Table Heading</h4>
		                                </div>
		                                <div class="typo-line">
		                                    <h5><p class="category">Header 5</p>Light Bootstrap Table Heading</h5>
		                                </div>
		                                 <div class="typo-line">
		                                    <h6><p class="category">Header 6</p>Light Bootstrap Table Heading</h6>
		                                </div>
		                                <div class="typo-line">
		                                    <p><span class="category">Paragraph</span>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam.</p>
		                                </div>
		                                <div class="typo-line">
		                                    <p class="category">Quote</p>
		                                    <blockquote>
		                                     <p>
		                                     Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam.
		                                     </p>
		                                     <small>
		                                     Steve Jobs, CEO Apple
		                                     </small>
		                                    </blockquote>
		                                </div>

		                                <div class="typo-line">
		                                    <p class="category">Muted Text</p>
		                                    <p class="text-muted">
		                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.
		                                    </p>
		                                </div>
		                                <div class="typo-line">
		                                    <!--
		                                     there are also "text-info", "text-success", "text-warning", "text-danger" clases for the text
		                                     -->
		                                    <p class="category">Coloured Text</p>
		                                    <p class="text-primary">
		                                        Text Primary - Light Bootstrap Table Heading and complex bootstrap dashboard you've ever seen on the internet.
		                                    </p>
		                                    <p class="text-info">
		                                        Text Info - Light Bootstrap Table Heading and complex bootstrap dashboard you've ever seen on the internet.
		                                    </p>
		                                    <p class="text-success">
		                                        Text Success - Light Bootstrap Table Heading and complex bootstrap dashboard you've ever seen on the internet.
		                                    </p>
		                                    <p class="text-warning">
		                                        Text Warning - Light Bootstrap Table Heading and complex bootstrap dashboard you've ever seen on the internet.
		                                    </p>
		                                    <p class="text-danger">
		                                        Text Danger - Light Bootstrap Table Heading and complex bootstrap dashboard you've ever seen on the internet.
		                                    </p>
		                                </div>

		                                <div class="typo-line">
		                                    <h2><p class="category">Small Tag</p>Header with small subtitle <br><small>".small" is a tag for the headers</small> </h2>
		                                </div>
		                            </div>
		                        </div>
		                    </div>

		                </div>
		            </div>
		        </div>
		        <!--Settings End-->

		        <!--Stats Start-->
		        <div class="content" id="stats_view">
		            <div class="container-fluid">
		                <div class="row">
		                    <div class="col-md-4">
		                        <div class="card">

		                            <div class="header">
		                                <h4 class="title">Class Statistics</h4>
		                                <p class="category">COMS1000</p>
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
		                                <p class="category">COMS1000</p>
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
		        </div>
		        <!--Stats End-->

		        <!-- Grade Book start-->
		        <div class="content" id="grade_view">
		        	<div class="dropdown" style="padding-left:30px;padding-top:10px;margin-left:-15px;" id="grade_view">
	                	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Class
	                    	<span class="caret"></span>
	                	</button>
		                <ul class="dropdown-menu">
		                    <li><a href="#">COMS1000</a></li>
		                    <li><a href="#">COMS2000</a></li>
		                    <li><a href="#">COMS3000</a></li>
		                </ul>
        			</div>
		            <div class="container-fluid">
		                <div class="row">
		                    <div class="col-md-12">
		                        <div class="card">
		                            <div class="header">
		                                <h4 class="title">COMS1000</h4>
		                                
		                            </div>
		                            <div class="content table-responsive table-full-width">
		                                <table class="table table-hover">
		                                    <thead>
		                                        <th>Student Number</th>
		                                    	<th>Name</th>
		                                    	<th>Faculty</th>
		                                    	<th>YOS</th>
		                                    	<th>Current Average</th>
		                                    </thead>
		                                    <tbody>
		                                        <tr>
		                                        	<td>2000000</td>
		                                        	<td>Dakota Rice</td>
		                                        	<td>Science</td>
		                                        	<td>2</td>
		                                        	<td>76%</td>
		                                            <td><a  type="button" class="btn btn-light btn-sm">Load Student</a></td>
		                                        </tr>
		                                        <tr>
		                                        	<td>2000578</td>
		                                        	<td>Minerva Hooper</td>
		                                        	<td>Science</td>
		                                        	<td>2</td>
		                                        	<td>50%</td>
		                                            <td><a  type="button" class="btn btn-light btn-sm">Load Student</a></td>
		                                        </tr>
		                                        <tr>
		                                        	<td>2000999</td>
		                                        	<td>Sage Rodriguez</td>
		                                        	<td>Science</td>
		                                        	<td>3</td>
		                                        	<td>87%</td>
		                                            <td><a type="button" class="btn btn-light btn-sm">Load Student</a></td>
		                                        </tr>
		                                        <tr class="active">
		                                        	<td>2005890</td>
		                                        	<td>Philip Chaney</td>
		                                        	<td>Science</td>
		                                        	<td>3</td>
		                                        	<td>39%</td>
		                                            <td><a type="button" class="btn btn-light btn-sm">Load Student</a></td>
		                                        </tr>
		                                        <tr>
		                                        	<td>2008293</td>
		                                        	<td>Doris Greene</td>
		                                        	<td>Science</td>
		                                        	<td>3</td>
		                                        	<td>57%</td>
		                                            <td><a type="button" class="btn btn-light btn-sm">Load Student</a></td>
		                                        </tr>
		                                        <tr>
		                                        	<td>2009637</td>
		                                        	<td>Mason Porter</td>
		                                        	<td>Science</td>
		                                        	<td>3</td>
		                                        	<td>38%</td>
		                                            <td><a type="button" class="btn btn-light btn-sm">Load Student</a></td>
		                                        </tr>
		                                        <tr>
		                                            <td>2004785</td>
		                                            <td>Johnny Depp</td>
		                                            <td>Science</td>
		                                            <td>3</td>
		                                            <td>90%</td>
		                                            <td><a type="button" class="btn btn-light btn-sm">Load Student</a></td>
		                                        </tr>
		                                        <tr>
		                                            <td>2046759</td>
		                                            <td>Aretha Franklin</td>
		                                            <td>Humanities</td>
		                                            <td>1</td>
		                                            <td>94%</td>
		                                            <td><a type="button" class="btn btn-light btn-sm">Load Student</a></td>
		                                        </tr>
		                                        <tr>
		                                            <td>2138904</td>
		                                            <td>James Dunn</td>
		                                            <td>Humanities</td>
		                                            <td>1</td>
		                                            <td>28%</td>
		                                            <td><a type="button" class="btn btn-light btn-sm">Load Student</a></td>
		                                        </tr>
		                                        <tr>
		                                            <td>2289304</td>
		                                            <td>Harry Potter</td>
		                                            <td>Humanities</td>
		                                            <td>1</td>
		                                            <td>80%</td>
		                                            <td><a type="button" class="btn btn-light btn-sm">Load Student</a></td>
		                                        </tr>
		                                    </tbody>
		                                </table>

		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <!--Grade Book end-->
           </div>
        </div>`
    )

	$('#settings').hide()
	$('#profile').hide()
	$('#profile_view').hide()
	$('#stats_view').hide()
	$('#settings_view').hide()
	$('#grade_view').hide()

	$('#dashboard').click(function(){
		$('#settings').removeClass("active")
		$('#profile').removeClass("active")
		$('#stats').removeClass("active")
		$('#dashboard').addClass("active")
		$('#grade').removeClass("active")

		$('#profile_view').hide()
		$('#stats_view').hide()
		$('#settings_view').hide()
		$('#grade_view').hide()
		$('#dashboard_view').show()
	})

	$('#profile').click(function(){
		$('#settings').removeClass("active")
		$('#profile').addClass("active")
		$('#stats').removeClass("active")
		$('#dashboard').removeClass("active")
		$('#grade').removeClass("active")

		$('#stats_view').hide()
		$('#settings_view').hide()
		$('#grade_view').hide()
		$('#dashboard_view').hide()
		$('#profile_view').show()
	})

	$('#stats').click(function(){
		$('#settings').removeClass("active")
		$('#profile').removeClass("active")
		$('#stats').addClass("active")
		$('#dashboard').removeClass("active")
		$('#grade').removeClass("active")

		$('#settings_view').hide()
		$('#profile_view').hide()
		$('#dashboard_view').hide()
		$('#grade_view').hide()
		$('#stats_view').show()
	})

	$('#settings').click(function(){
		$('#settings').addClass("active")
		$('#profile').removeClass("active")
		$('#stats').removeClass("active")
		$('#dashboard').removeClass("active")
		$('#grade').removeClass("active")

		$('#profile_view').hide()
		$('#stats_view').hide()
		$('#dashboard_view').hide()
		$('#grade_view').hide()
		$('#settings_view').show()
	})

	$('#grade').click(function(){
		$('#settings').removeClass("active")
		$('#profile').removeClass("active")
		$('#stats').removeClass("active")
		$('#dashboard').removeClass("active")
		$('#grade').addClass("active")

		$('#profile_view').hide()
		$('#stats_view').hide()
		$('#settings_view').hide()
		$('#dashboard_view').hide()
		$('#grade_view').show()	
	})
}
function AddMarks()
{

}
function AddMarksView()
{
	$('#content').append(`
	<div class="container">
	  <div class="form-group">
	    <label for="confirm">Module Name:</label>
	    <input type="text" class="form-control" id="name" placeholder="Module Name" >
	  </div>
	  <div class="form-group">
	    <label for="confirm">Module Code:</label>
	    <input type="text" class="form-control" id="code" placeholder="Module Code">
	  </div>
	  <div class="form-group">
	    <label for="confirm">School:</label>
	    <input type="text" class="form-control" id="school" placeholder="School">
	  </div>
	  <button class="btn btn-primary" name="login" onclick="AddModule()" >Add</button>
	</div> `)
}
function AddCourses()
{

}
function AddModuleView()
{
	$('#content').append(`
	<div class="container">
	  <div class="form-group">
	    <label for="confirm">Module Name:</label>
	    <input type="text" class="form-control" id="name" placeholder="Module Name" >
	  </div>
	  <div class="form-group">
	    <label for="confirm">Module Code:</label>
	    <input type="text" class="form-control" id="code" placeholder="Module Code">
	  </div>
	  <div class="form-group">
	    <label for="confirm">School:</label>
	    <input type="text" class="form-control" id="school" placeholder="School">
	  </div>
	  <button class="btn btn-primary" name="login" onclick="AddModule()" >Add</button>
	</div> `)
}
function AddModule()
{
	var name=$('#name').val()
	var code=$('#code').val()
	var school=$('#school').val()
	if(name.length===0 || code.length===0 || school.length===0)
	{
		var res='Fill In All Fields'
		ResponseModal(res)
	}
	else
	{
		axios.post('api/add_module',{name:name,code:code,school:school}).then(function(res){
			console.log(res.data)
			ResponseModal(res.data.status)
		})
	}
}
function AdminHeader()
{
	$('#content').append(`
	<header>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md navbar-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img class="img-fluid" src="img/asset/wits-logo.png" style="width: 96px; height: 57px;"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                    	<!--
                        <li class="nav-item ml-2 mr-2 active">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item ml-2 mr-2">
                            <a class="nav-link" href="dist/about/">About</a>
                        </li>
                        <li class="nav-item ml-2 mr-4">
                            <a class="nav-link" href="dist/team/">Team</a>
                        </li>
                        <li class="nav-item">
                            
                                <input class="form-module ml-2 mr-2" style="width: 10vw" type="text" name="user" id="username" placeholder="Username">
                                <input class="form-module ml-2 mr-2" style="width: 10vw" type="password" name="pass" id="password" placeholder="Password">
                                <button class="btn btn-outline-secondary ml-2 mr-2" style="color: #fff" type="submit" name="login" onclick="Login()" >Sign In</button>
                          
                        </li>
                        -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>`)
}

function Logout()
{
	axios.delete('api/logout').then(function(res){
		if(res.data.status==="Success")
		{
			window.location.href="testing_login.html"
		}
		else
		{
			//do something later
		}
	})
}

function LogoutModal()
{
	$('#response').html(`
	<div class="modal" id="responseModal">
		<div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title"><center></center></h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		        	<h5><center>Are you sure you want to logout?</center></h5>
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">No</button>
		        <button type="button" class="btn btn-outline-primary pull-left" data-dismiss="modal" onclick="Logout()">Yes</button>
		      </div>

		    </div>
	  	</div>
	</div>`)

	$('#responseModal').modal('show')
}