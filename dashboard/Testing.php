<?php
class buttonDropdown{

     	public function listClasses(){

            $link = mysqli_connect("localhost","1234567","password", "api_risk");

            if (mysqli_connect_error()){
                die ("Error!");
            }

            $query2 = "SELECT module_code FROM module";
            
            $result2= mysqli_query($link, $query2);

            while ($row2 = mysqli_fetch_array($result2)) {
                echo "<li><a href='#'>".$row2['module_code']."</a></li>";
            }
    	}
	}  
?>