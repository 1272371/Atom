<?php
    class TestingUpload{
        public function getAssignmentType(){
            if (empty($_GET)){
                        $course_id = "1";
                        $student = "500594";
                        $date = "2018";
                    } else {
                        $course_id = $_GET['course_id'];
                        $student = $_GET['student'];
                        $date = $_GET['date'];
                    }
            
            echo "<li><a href='grade.php?course_id=$course_id&student=$student&date=$date'>Assignment Type 1</a></li>";


            

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
            $count = 0;
            while ($row2 = mysqli_fetch_array($result2)) {
                echo "<option value='course".$count."'>".$row2['course_code']."</option>";
                $count = $count+1;
            }
        }

        public function getMedium(){
            if (empty($_GET)){
                        $course_id = "1";
                        $student = "500594";
                        $date = "2018";
                    } else {
                        $course_id = $_GET['course_id'];
                        $student = $_GET['student'];
                        $date = $_GET['date'];
                    }
        	
            echo "<li><a href='grade.php?course_id=$course_id&student=$student&date=".$date."'>Medium 1</a></li>";






            

        }

        public function listAssignmentType(){
        	$link = mysqli_connect("localhost","root","", "risk");

            if (mysqli_connect_error()){
                die ("Error!");
            }

            $query2 = "SELECT atl_name, atl_id FROM assessment_type_lookup";
            
            $result2= mysqli_query($link, $query2);
            
            while ($row2 = mysqli_fetch_array($result2)) {
                echo "<option value='".$row2['atl_id']."'>".$row2['atl_name']."</option>";
            }
        }

        public function getMediums(){
        	$link = mysqli_connect("localhost","root","", "risk");

            if (mysqli_connect_error()){
                die ("Error!");
            }

            $query2 = "SELECT aml_name FROM assessment_medium_lookup";
            
            $result2= mysqli_query($link, $query2);
            
            while ($row2 = mysqli_fetch_array($result2)) {
                echo "<option value='".$row2['aml_name']."'>".$row2['aml_name']."</option>";
            }
        }
        
    }
?>
