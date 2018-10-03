<?php
    class TestingGrade{
        public function getStudentList(){
            $link = mysqli_connect("localhost","root","", "risk");

                if (mysqli_connect_error()){
                    die ("Error!");
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
                

                while ($row = mysqli_fetch_array($result)) {
                    
                    $person=$row['user_id'];
                    $query2 = "SELECT ROUND(AVG(mark_total)) FROM mark where user_id=".$person;
                    $result2= mysqli_query($link, $query2);
                    $row2 = mysqli_fetch_array($result2);

                    $student = $person;
                   
                    echo "<tr style='cursor:pointer;' class='clickable-row' data-href='dashboard.php?student=$student'><td>".$row['user_id']."</td><td>".$row['user_name']." ".$row['user_surname']."</td><td>Science</td><td>2</td><td>".$row2['ROUND(AVG(mark_total))']."</td><td>"."<a href='dashboard.php' type='button' class='btn btn-light btn-sm'>More Info</a>"."</td></tr>";
            }
                echo "</table>";

        }

        public function listClasses(){

            $link = mysqli_connect("localhost","root","", "risk");

            if (mysqli_connect_error()){
                die ("Error!");
            }

            $query2 = "SELECT course_code FROM course";
            
            $result2= mysqli_query($link, $query2);

            while ($row2 = mysqli_fetch_array($result2)) {
                echo "<li><a href='grade.php?course=".$row2['course_code']."'>".$row2['course_code']."</a></li>";
            }
        }
    }
?>
