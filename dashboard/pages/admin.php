

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

                                //$query2 = "SELECT user.user_id, user.user_name, user.user_surname,user.utl_id, subject.user_id FROM user LEFT JOIN subject ON user.user_id = subject.user_id WHERE user.utl_id=2";

                                $query = "SELECT * FROM user WHERE utl_id=2 AND user_id NOT IN (SELECT user_id FROM subject)";


                                $result = mysqli_query($link, $query);
                                //$result2 = mysqli_query($link, $query2);

                                while ($row = mysqli_fetch_array($result)){
                                    echo "<input type='radio' name='user' value=".$row['user_id']." data-id=".$row['user_id']."> ".$row['user_name']." ".$row['user_surname'].", ".$row['user_id']."<br>";
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

                                        $query = "SELECT DISTINCT * FROM course";
                                        
                                        $result= mysqli_query($link, $query);



                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<input type='checkbox' name='course' value=".$row['course_code']." id=".$row['course_code']."><label for=".$row['course_code'].">  ".$row['course_code']."</label><br>";
                                        }
                                    ?>
                                
                            </form>
                        </div>
                    </div>
                </div>
                
                </div class="row">
                    <button type="button" ng-click="assign()" class="btn btn-primary">Assign</button>

                    <?php
                        
                        if (empty($_GET)){
                           echo "empty";
                        } else {
                            $course_id = $_GET['courses'];
                            $user = $_GET['user'];
                            echo ($user);
                            echo ($course_id);
                        }

                        $link = mysqli_connect("localhost","root","", "risk");

                        if (mysqli_connect_error()){
                            die ("Error!");
                        }

                        $query = "INSERT INTO 'user' ('subject_id', 'subject_enrollmentyear', 'course_id', 'user_id') VALUES (NULL, 2018, )";
                        
                        mysqli_query($link, $query);

                        /*$('.button').click(function() {

                            $.ajax({
                              type: "POST",
                              url: "admin.php",
                              data: { name: "John" }
                            }).done(function( msg ) {
                              alert( "Data Saved: " + msg );
                            });    

                        });*/

                        /*function assignUser(){
                        if (empty($_GET)){
                           alert("empty");
                        } else {
                            $course_id = $_GET['course_id'];
                            $user = $_GET['user'];
                            alert($user);
                            alert($course_id);
                        }
                        }*/

                    ?>
                   
                </div>
            </div>
        </div>
    </div>
</div>
