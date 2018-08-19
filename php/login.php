<?php
    session_start();

    if (isset($_POST['submit'])) {

        include 'connect.php';

        $user = mysqli_real_escape_string($connect, $_POST['user']);
        $pass = mysqli_real_escape_string($connect, $_POST['pass']);

        // check if inputs are empt
        if (empty($user) || empty($pass)) {

        }
        else {
            $sql = "select * from user where user_id='$user'";
            $result = mysqli_query($connect, $sql);
            $check = mysqli_num_rows($result);

            if ($result < 1) {
                //
            }
            else {
                if ($row = mysqli_fetch_assoc($result)) {
                    // de-hash password
                    $hashed = password_verify($pass, $row['user_password']);
                    if ($hashed == false) {

                    }
                    else if ($hashed == true) {
                        // sign in user
                        $_SESSION['user_id'] == $row['user_id'];
                        header("Location: ../index.php?signin=success");
                    }
                }
            }
        }

    }
    else {
        header("Location: ../login/index.php?signin=error");
        exit();
    }
?>