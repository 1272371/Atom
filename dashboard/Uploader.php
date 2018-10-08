<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kyren
 * Date: 2018/10/08
 * Time: 16:31
 */
include_once('DB.php');
if(isset($_POST['Upload'])) {
    $mark = $_POST['mark'];
    $weight = $_POST['Assignment_Weight'];
    $name = $_POST['Name_of_Assignmnet'];
    $tot = $_POST['Total_Available_Marks'];
}
