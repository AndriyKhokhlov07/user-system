<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "users_db");

    if(isset($_POST["employee_id"])) {
        $query = "SELECT * FROM users WHERE id = '" . $_POST["employee_id"] . "'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }

