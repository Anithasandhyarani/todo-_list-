<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "employee_management_db");
$id = $_GET['id'];
$sql = "DELETE FROM todo_list WHERE id='$id'";

if (mysqli_query($con, $sql)) {
    $_SESSION['suc'] = "deleted successfully";
    header("location:todo_list.php?suc=$_SESSION[suc]");
} else {
    echo "error";
}
