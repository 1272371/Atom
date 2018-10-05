<?php
    class TestingDashboard{
        /**
         *
         */
        public function getLatestMarks(){

            $link = mysqli_connect("localhost","root","", "risk");

            if (mysqli_connect_error()){
                die ("Error!");
            }

            if (empty($_GET)){
                $student = "500594";
            } else {
                $student = $_GET['student'];
            }

          
            $query2 = "SELECT mark_total FROM mark WHERE user_id=".$student; 
            $query3 = "SELECT course_name,course_code FROM course";// WHERE grades.module = module.id";

            echo "<table class='table table-hover'>";

            echo "<thead>";
            echo        "<th>Subject</th>";
            echo        "<th>Subject Code</th>";
            echo        "<th>Current Mark (%)</th>";
            echo "</thead>";

            
            $result2= mysqli_query($link, $query2);
            $result3= mysqli_query($link, $query3);

            while ($row2 = mysqli_fetch_array($result2)) {
                
                    if ($row3 = mysqli_fetch_array($result3)){
                
                echo "<tr><td>".$row3['course_name']."</td><td>".$row3['course_code']."</td><td>".$row2['mark_total']."</td></tr>";
                }
            }
            echo "</table>";
        }

        public function getStudentDetails(){

            if (empty($_GET)){
                $student = "500594";
            } else {
                $student = $_GET['student'];
            }

            $link = mysqli_connect("localhost","root","", "risk");

            if (mysqli_connect_error()){
                die ("Error!");
            }

            $query = "SELECT * FROM user WHERE user_id=".$student;
            $result = mysqli_query($link, $query);

            if ($row = mysqli_fetch_array($result)) {
            echo "<h4 class='title'>".$row['user_name']." ".$row['user_surname']."<br />";
            echo         "<small>".$row['user_id']."</small>";
            echo      "</h4>";
            echo    "</a>";
            echo "</div>";
            echo "<p class='description text-center'>" ;
            echo    "Science";
            }
        }

        public function getStudentList(){
            $link = mysqli_connect("localhost","root","", "risk");

                if (mysqli_connect_error()){
                    die ("Error!");
                }

                $query = "SELECT * FROM user";

                if (empty($_GET)){
                        $course_id = "1";
                    } else {
                        $course_id = $_GET['course_id'];
                    }
                

                echo "<table class='table table-hover'>";
                echo "<thead>";
                echo        "<th>Student Number</th>";
                echo        "<th>Name</th>";
                echo        "<th>Current Average (%)</th>";
                echo "</thead>";

                $result = mysqli_query($link, $query);


                $query3 = "SELECT user_id FROM subject WHERE course_id =".$course_id ;
                $result3= mysqli_query($link, $query3);
                $classItems = array();
                while ($row3 = mysqli_fetch_array($result3)){
                    $classItems[] = $row3['user_id'];
                }
                

                while ($row = mysqli_fetch_array($result)) {
                    
                    $person=$row['user_id'];
                    $query2 = "SELECT ROUND(AVG(mark_total)) FROM mark where user_id=".$person;
                    $result2= mysqli_query($link, $query2);
                    $row2 = mysqli_fetch_array($result2);

                    $student = $person;
                   
                   if (in_array($student, $classItems)){
                    echo "<tr style='cursor:pointer;' class='clickable-row' data-href='dashboard.php?student=$student&course_id=$course_id'><td>".$row['user_id']."</td><td>".$row['user_name']." ".$row['user_surname']."</td><td>".$row2['ROUND(AVG(mark_total))']."</td></tr>";
                    }

            }
                echo "</table>";
        }

        public function listClasses(){
            $link = mysqli_connect("localhost","root","", "risk");

            if (mysqli_connect_error()){
                die ("Error!");
            }

            if (empty($_GET)){
                $course_id = "1";
                $student = "500594";
            } else {
                $course_id = $_GET['course_id'];
                $student = $_GET['student'];
            }

            $query4 = "SELECT course_code,course_id FROM course";
            
            $result4= mysqli_query($link, $query2);

            while ($row4 = mysqli_fetch_array($result2)) {
                echo "<li><a href='dashboard.php?student=$student&course_id=".$row4['course_id']."'>".$row4['course_code']."</a></li>";

                
            }
        }

        public function listDates(){
            $link = mysqli_connect("localhost","root","", "risk");

            if (mysqli_connect_error()){
                die ("Error!");
            }

            if (empty($_GET)){
                    $course_id = "1";
                } else {
                    $course_id = $_GET['course_id'];
                }

            $query2 = "SELECT DISTINCT subject_enrollmentyear FROM subject";
            
            $result2= mysqli_query($link, $query2);

            while ($row2 = mysqli_fetch_array($result2)) {
                echo "<li><a href='dashboard.php?course_id=$course_id&date=".$row2['subject_enrollmentyear']."'>".$row2['subject_enrollmentyear']."</a></li>";
            }

        }
    }
    
    
?>
