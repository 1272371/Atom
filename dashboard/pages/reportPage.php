<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <!-- toggle button -->
    <!-- onmousedown="event.preventDefault()" prevents button from staying clicked -->
    <button onmousedown="event.preventDefault()" ng-click="sidebar()" id="sidebarCollapse" type="button">
        <i class="fa fa-bars"></i>
    </button>
    <a class="navbar-brand ml-3 mr-auto">{{ title }}</a>
</nav>

<div class="row">
    <div class="col">
        <div id="report-card" class="card m-2">
                <div class="card-body p-0" style="overflow-x:hidden; overflow-y:auto; text-align: center">
                    <!-- report -->
                    <h3 style="margin: 24px">Please specify the format of the report you would like to generate</h3>
                    <hr>
                    <!-- general report -->
                    <h3 style="margin: 24px">General Report </h3>
                    <a href="./pages/report.php"><button type="button" class="btn btn-secondary">Generate</button></a>
                    <hr>
                    <!-- specialised -->
                    <h3>Specialized Report</h3>
                    <h4>Course</h4>
                    <form>
                        <div>
                            <label class="radio-inline">
                              <input type="radio" name="course" value="bco" checked>Basic Computer Organisation
                            </label>
                        </div>
                        <div> 
                            <label class="radio-inline">
                              <input type="radio" name="course" value="iap">Introduction to Algorithms and Programming
                            </label>
                        </div>
                    </form>

                    <h4>Date</h4>
                    <div style="padding-bottom: 10px">
                        <select id="date">
                             <?php
                                $link = mysqli_connect("localhost","root","", "risk");

                                if (mysqli_connect_error()){
                                    die ("Error!");
                                }

                                $query = "SELECT DISTINCT subject_enrollmentyear FROM subject"; 

                                $result= mysqli_query($link, $query);
                                $count=0;
                                while ($row = mysqli_fetch_array($result)){
                                    
                                    echo "<option value='".$row['subject_enrollmentyear']."'>".$row['subject_enrollmentyear']."</option>";
                                    
                                }
                            ?>
                        </select>
                    </div>
                    <h4>Assessment</h4>
                    <form>
                        <?php

                        //DO ERROR CHECKING COURSE BETWEEN 1 - 18 and 19-
                            $link = mysqli_connect("localhost","root","", "risk");

                            if (mysqli_connect_error()){
                                die ("Error!");
                            }

                            $query = "SELECT assessment_id, assessment_name FROM assessment"; 

                            $result= mysqli_query($link, $query);
                            $count=0;
                            while ($row = mysqli_fetch_array($result)){

                                echo "<div>";
                                echo "<label class='radio-inline'>";
                                if ($count==0){
                                echo ($count+1)." <input type='radio' name='assessment' checked value=".$row['assessment_id'].">";
                                } else{
                                    echo ($count+1)." <input type='radio' name='assessment' value=".$row['assessment_id'].">";
                                }
                                echo $row['assessment_name'];
                                echo "</label>";
                                echo "</div>";
                                $count++;
                            }
                        ?>
                    </form>
                    <button id="btnbtn" type="button" ng-click="check()" class="btn btn-primary" style="margin:10px;">Generate</button>
                </div>
        </div>
    </div>
</div>