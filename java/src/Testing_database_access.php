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
$link = mysqli_connect("localhost","1234567","password", "risk");
if ($link->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user_id, user_name, User_surname FROM "user";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>