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

                                echo "<div style='margin-left: 44%'>";
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
                    <button type="button" onclick="check()" class="btn btn-primary">Generate</button>       
                    <script>
                        function check(){
                            var course = document.querySelector('input[name="course"]:checked').value;
                            
                            var assessment = document.querySelector('input[name="assessment"]:checked').value;

                            var dateSelector = document.getElementById("date");
                            var date = dateSelector.options[dateSelector.selectedIndex].value;
                            
                            if ((course=="bco" && assessment <19)||(course=="iap" && assessment >=19)){
                                window.location="specificReport.php?course="+course+"&assessment="+assessment+"&date="+date;
                            } else{
                                alert ("Please Select a valid valid assessment and course combination (BCO: assessment < 18; IAP: assessment > 18)");
                            }

                            
                            /*$('input[type=radio][name=course]').change(function() {
                            if (this.value == 'none') {
                                alert("none");
                                    document.write("none");
                            }
                            else if (this.value == 'bco') {
                                alert("bco");
                                document.write("bco");
                            } 
                            else if (this.value == 'iap') {
                                alert("iap");
                                document.write("iap");
                            });*/
                        
                        }
                        
                        /*$('input[type=radio][name=type1]').change(function() {
                        if (this.value == 'general') {
                            alert("Allot Thai Gayo Bhai");
                        }
                        else if (this.value == 'specific') {
                            alert("Transfer Thai Gayo");
                        }
                        });*/

                        
                    </script>
                </div>
        </div>
    </div>
</div>