<?php

    include 'connect.php';
    if (isset($_POST['submit'])) {
        session_start();
        /** @var TYPE_NAME $connect */
        $user = mysqli_real_escape_string($connect, $_POST['user']);
        $pass = mysqli_real_escape_string($connect, $_POST['pass']);
        login(user,pass);
    }else {
        header("Location: ../index.php?signin=error");
        exit();
    }

    /**
     * @param $user
     * @param $pass
     */
    function login($user, $pass)
     {
        // check if inputs are empt
        if (empty($user) || empty($pass)) {
            header("Location: ../index.php?signin=empty");
            exit();
        } else {
            $sql = "select * from user where user_id='$user'";
            /** @var TYPE_NAME $connect */
            $result = mysqli_query($connect, $sql);
            $check = mysqli_num_rows($result);

            if ($check < 1) {
                // no result in database
                header("Location: ../index.php?signin=error");
                exit();
            } else {
                // data from data base inserted into array called $row
                if ($row = mysqli_fetch_assoc($result)) {
                    // de-hash password
                    $hashed = password_verify($pass, $row['user_password']);
                    if ($hashed == false) {
                        // passwords don't match
                        header("Location: ../index.php?signin=error");
                        exit();
                    } else if ($hashed == true) {
                        // sign in user
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['user_name'] = $row['user_name'];
                        header("Location: ../dashboard/dashboard.html");
                        exit();
                    }
                }
            }
        }

    }
?>