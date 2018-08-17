<?php include "../../php/login.php";?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css" />

    <!--CSS-->
    <link rel="stylesheet" href="../../bootstrap/bootstrap.css">
    <!--Title-->
    <!--Title & Icon-->
    <title>Welcome, Sign In</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../img/favicon.png">
</head>
<body>
    <!-- Modal -->
    <div class="modal-dialog text-center">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-12 user-img">
                    <img src="../../img/face.png">
                </div>
                <form id="sign-in-form" action="" method="POST" class="col-12">
                    <div class="form-group">
                        <label for="Username"></label>
                        <input id="sign-in-form-user" type="text" name="user" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="User password"></label>
                        <input id="sign-in-form-pass" type="password" name="pass" class="form-control" placeholder="Password">
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary">Sign In</button>
                </form>
                <div class="col-12 forgot">
                    <a href="#">Forgot password?</a>
                </div>
            </div>
        </div>
    </div>

    <!--Scripts-->
    <script src="../../jquery/jquery.js"></script>
    <script src="../../bootstrap/bootstrap.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="main.js"></script>
</body>
</html>