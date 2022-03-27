<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "users_db");

if (isset($_POST['update_status'])) {
    $ids = $_POST['id'];
    $status = $_POST['status'];

    foreach ($ids as $id) {
        $query = "UPDATE users SET user_status=$status WHERE id=$id";
        $query_run = mysqli_query($conn, $query);
        $result_array = [];
        if ($query_run) {
            $ids = $_POST['id'];
            $status = $_POST['status'];
        } else {
            echo $return = "Something Went Wrong.!";
        }
    }
    mysqli_close($conn);
}