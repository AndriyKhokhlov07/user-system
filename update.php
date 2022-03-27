<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "users_db");

if(isset($_POST['update_user'])) {
    $userId = $_POST['employee_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $status = $_POST['user_status'];
    $role = $_POST['user_role'];

    $query = "UPDATE users SET first_name='$firstName', last_name='$lastName', user_status ='$status',role='$role' WHERE id='$userId'  ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $userId = $_POST['employee_id'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $status = $_POST['user_status'];
        $role = $_POST['user_role'];

    } else {
        echo $return = "Something Went Wrong.!";
    }
}