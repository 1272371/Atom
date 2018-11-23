

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
                            <h5>Select a lecturer to assign to courses:</h5>
                           <form>
                                <?php
                                    $link = mysqli_connect("localhost","root","", "risk");

                                if (mysqli_connect_error()){
                                    die ("Error!");
                                }

                                $query = "SELECT * FROM user WHERE utl_id=2";

                                $result = mysqli_query($link, $query);

                                while ($row = mysqli_fetch_array($result)){
                                    echo "<input type='radio' name='user' value=".$row['user_id']."> ".$row['user_name']." ".$row['user_surname'].", ".$row['user_id']."<br>";
                                }
                                ?>
                           </form>  
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
                                            echo "<input type='checkbox' name='course' value=".$row2['course_code']." id=".$row2['course_code']."><label for=".$row2['course_code'].">  ".$row2['course_code']."</label><br>";
                                        }
                                    ?>
                                
                            </form>
                        </div>
                    </div>
                </div>
                
                </div class="row">
                    <button type="button" ng-click="assign()" class="btn btn-primary">Assign</button>

                   
                </div>
            </div>
        </div>
    </div>
</div>
