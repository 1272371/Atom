<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kyren
 * Date: 2018/09/25
 * Time: 14:29
 */
$servername = "localhost";
$username = "1234567";
$password = "password";
$dbname = "risk";

$conn = new mysqli($servername, $username, $password, $dbname);
$link = mysqli_connect("localhost","","", "risk");
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
$query = "SELECT * FROM user WHERE student_nr=".$student;
$result = mysqli_query($link, $query);

if ($row = mysqli_fetch_array($result)) {
    echo "<h4 class='title'>".$row['user_name']." ".$row['user_surname']."<br />";
    echo         "<small>".$row['student_nr']."</small>";
    echo      "</h4>";
    echo    "</a>";
    echo "</div>";
    echo "<p class='description text-center'>" ;
    echo    $row['user_coursecode'];
/*$sql = "SELECT user_id, user_name, User_surname FROM "user";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}*/
$link->close();
?>