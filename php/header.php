<?php session_start(); ?>
<body>
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
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item ml-2 mr-4">
                            <a class="nav-link" href="#">Team</a>
                        </li>
                        <li class="nav-item">
                            <form id="sign-in-form" action="php/login.php" method="POST">
                                <input class="form-module ml-2 mr-2" style="width: 10vw" type="text" name="user" placeholder="Username">
                                <input class="form-module ml-2 mr-2" style="width: 10vw" type="password" name="pass" placeholder="Password">
                                <button class="btn btn-outline-secondary ml-2 mr-2"
                                    style="color: #fff" type="submit" name="submit">Sign In</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</body>