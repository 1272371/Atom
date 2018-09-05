<?php namespace php\Signing;

    class Login{
        function link(){

            $db_host = 'localhost';
            $db_username = 'root';
            $db_password = '';
            $db_name = 'risk';
            $tb_query = 'select  * from user';

            return mysqli_connect($db_host, $db_username, $db_password, $db_name);
        }

        function init(){
             $connect = $this->link ();
            if (isset($_POST['submit'])) {
                session_start();
                /** @var TYPE_NAME $connect */
                $user = mysqli_real_escape_string($connect, $_POST['user']);
                $pass = mysqli_real_escape_string($connect, $_POST['pass']);
                login($user, $pass);
            }
            else {
                header("Location: ../index.php?signin=error");
                exit();
            }
        }

        function login($user, $pass)
        {
            $connect = $this->link ();
            // check if inputs are empt
            if (empty($user) || empty($pass)) {
                header("Location: ../index.php?signin=empty");
                exit();
            } else {
                $sql = "select * from user where user_id='$user'";
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
            return $check;
        }
    }
?>