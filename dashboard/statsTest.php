<?php

	class StatsTesting{
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
            
            $result4= mysqli_query($link, $query4);

            while ($row4 = mysqli_fetch_array($result4)) {
                echo "<li><a href='stats.php?student=$student&course_id=".$row4['course_id']."'>".$row4['course_code']."</a></li>";

                
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

            if (empty($_GET)){
                $student = "500594";
            } else {
                $student = $_GET['student'];
            }

            $query2 = "SELECT DISTINCT subject_enrollmentyear FROM subject";
            
            $result2= mysqli_query($link, $query2);

            while ($row2 = mysqli_fetch_array($result2)) {
                echo "<li><a href='stats.php?student=$student&course_id=$course_id&date=".$row2['subject_enrollmentyear']."'>".$row2['subject_enrollmentyear']."</a></li>";
            }

        }
        /*
        public function course(){
            if($_GET['course_id']==1)
            {
                $course_name="Basic Computer Organisation"
            }
            if($_GET['course_id']==2)
            {
                $course_name="Introduction to Algorithms and Programming"
            }
        }
        */
	}

?>

