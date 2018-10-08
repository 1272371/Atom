<?php
    class TestingGrade{
        public function getStudentList(){
            $link = mysqli_connect("localhost","root","", "risk");

                if (mysqli_connect_error()){
                    die ("Error!");
                }

                if (empty($_GET)){
                        $course_id = "1";
                        $student = "500594";
                        $date = "2018";
                    } else {
                        $course_id = $_GET['course_id'];
                        $student = $_GET['student'];
                        $date = $_GET['date'];
                    }

                $query = "SELECT * FROM user";
                

                echo "<table class='table table-hover'>";
                echo "<thead>";
                echo        "<th>Student Number</th>";
                echo        "<th>Name</th>";
                echo        "<th>Faculty</th>";
                echo        "<th>YOS</th>";
                echo        "<th>Current Average (%)</th>";
                echo "</thead>";

                $result = mysqli_query($link, $query);

                $query3 = "SELECT user_id,subject_enrollmentyear FROM subject WHERE course_id =".$course_id ;
                $result3= mysqli_query($link, $query3);
                $classItems = array();
                while ($row3 = mysqli_fetch_array($result3)){
                    if ($row3['subject_enrollmentyear'] == $date){
                        $classItems[] = $row3['user_id'];
                    }
                }
                    
                

                while ($row = mysqli_fetch_array($result)) {
                    
                    $person=$row['user_id'];

                    $query2 = "SELECT ROUND(AVG(mark_total)) FROM mark where user_id=".$person;
                    $result2= mysqli_query($link, $query2);
                    $row2 = mysqli_fetch_array($result2);

                    $student = $person;

                    

                   if (in_array($student, $classItems)){
                    echo "<tr style='cursor:pointer;' class='clickable-row' data-href='dashboard.php?student=$student&course_id=$course_id&date=$date'><td>".$row['user_id']."</td><td>".$row['user_name']." ".$row['user_surname']."</td><td>Science</td><td>2</td><td>".$row2['ROUND(AVG(mark_total))']."</td><td>"."<a href='dashboard.php' type='button' class='btn btn-light btn-sm'>More Info</a>"."</td></tr>";
                    }
            }
                echo "</table>";

        }

        public function listClasses(){

            if (empty($_GET)){
                        $course_id = "1";
                        $student = "500594";
                        $date = "2018";
                    } else {
                        $course_id = $_GET['course_id'];
                        $student = $_GET['student'];
                        $date = $_GET['date'];
                    }

            $link = mysqli_connect("localhost","root","", "risk");

            if (mysqli_connect_error()){
                die ("Error!");
            }

            $query2 = "SELECT course_code,course_id FROM course";
            
            $result2= mysqli_query($link, $query2);

            while ($row2 = mysqli_fetch_array($result2)) {
                echo "<li><a href='grade.php?course_id=".$row2['course_id']."&student=".$student."&date=".$date."'>".$row2['course_code']."</a></li>";
            }
        }

        public function listDates(){
        	$link = mysqli_connect("localhost","root","", "risk");

            if (mysqli_connect_error()){
                die ("Error!");
            }

            if (empty($_GET)){
                        $course_id = "1";
                        $student = "500594";
                        $date = "2018";
                    } else {
                        $course_id = $_GET['course_id'];
                        $student = $_GET['student'];
                        $date = $_GET['date'];
                    }

            $query4 = "SELECT DISTINCT subject_enrollmentyear FROM subject";
            
            $result4= mysqli_query($link, $query4);

            while ($row4 = mysqli_fetch_array($result4)) {
                echo "<li><a href='grade.php?course_id=$course_id&student=$student&date=".$row4['subject_enrollmentyear']."'>".$row4['subject_enrollmentyear']."</a></li>";
            }

        }
    }
?>
