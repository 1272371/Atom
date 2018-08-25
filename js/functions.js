function Login()
{
	var username=$('#username').val()
	var password=$('#password').val()

	if(username.length>0 && password.length>0)
	{
		axios.post('api/login',{username:username,password:password}).then(function(res){
			if(res.data.status==="Success")
			{
				//redirect to the dashboard
				
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
		if(res.data.status==='Logged')
		{
			/*
				Allow user to be on the current page
				if the page is not a login page

				if the page is a login page,we should direct the user 
				to the dashboard
			*/
		}
		else
		{
			//redirect to the login page
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

function Dashboard()
{
	$('#content').append(`<div>Dashboard</div>`)
}

