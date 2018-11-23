

<div class="container-fluid" style="overflow:auto;">
    <!-- two column layout -->
    <div class="col pl-0 ml-1 mr-1">
        <!-- summary -->
        <div id="recent-card" class="card">
            <div class="card-body p-0" style="overflow:auto;">
                <div class="row">
                    <div class="col">
                        <h4 style="font-weight:100; padding: 20px 20px 8px 20px">Admin</h4>
                    </div>
                    
                </div>

                <div class="row" style="overflow:auto;">
                    <div class="col">
                        <div class="card" style="overflow:auto; height:80%; margin:10px">
                           
                            <?php
                                $link = mysqli_connect("localhost","root","", "risk");

                                if (mysqli_connect_error()){
                                    die ("Error!");
                                }

                                $query = "SELECT * FROM user WHERE utl_id=2";
                                

                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo        "<th>Student Number</th>";
                                echo        "<th>Name</th>";
                                echo        "<th>Faculty</th>";
                                echo        "<th>YOS</th>";
                                echo        "<th>Current Average (%)</th>";
                                echo "</thead>";

                                $result = mysqli_query($link, $query);

                                $query3 = "SELECT user_id,subject_enrollmentyear FROM subject" ;
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
                                    echo "<tr style='cursor:pointer;' class='clickable-row' <td>".$row['user_id']."</td><td>".$row['user_name']." ".$row['user_surname']."</td><td>Science</td><td>2</td><td>".$row2['ROUND(AVG(mark_total))']."</td><td>"."<a href='dashboard.php' type='button' class='btn btn-light btn-sm'>More Info</a>"."</td></tr>";
                                    }
                            }
                                echo "</table>";
                            ?>
                             <script>
                                        jQuery(document).ready(function($) {
                                        $(".clickable-row").click(function() {
                                            window.location = $(this).data("href");
                                        });
                                    });
                            </script> 

                               
                        </div>
                    </div>
                    <div class="col">
                         <div class="card" style="margin:10px">
                            <h5>Select courses that the lecturer teaches:</h5>
                            <form>
                                    <?php
                                        $link = mysqli_connect("localhost","root","", "risk");

                                        if (mysqli_connect_error()){
                                            die ("Error!");
                                        }

                                        $query2 = "SELECT DISTINCT * FROM course";
                                        
                                        $result2= mysqli_query($link, $query2);

                                        while ($row2 = mysqli_fetch_array($result2)) {
                                            echo "<input type='checkbox' name=".$row2['course_code']." value=".$row2['course_code']." id=".$row2['course_code']."><label for=".$row2['course_code'].">".$row2['course_code']."</label><br>";
                                        }
                                    ?>
                                
                            </form>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
