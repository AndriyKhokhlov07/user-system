<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "users_db");
//$conn = mysqli_connect("localhost", "id18571802_root", "Lu8}kb^ulRmndgMr", "id18571802_usersdb");

extract($_POST);
// ВІДОБРАЖАЮ КОРИСТУВАЧІВ
if(isset($_POST["displayData"])) {
    $query = "SELECT * FROM `users`";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) { ?>
        <tr id="<?php echo $row["id"]; ?>">
            <td>
                <label class="custom-checkbox">
                    <input type="checkbox" class="userCheckbox" data-id="<?php echo $row["id"]; ?>">
                    <label for="checkbox2"></label>
                </label>
            </td>
            <td><?php echo $row["first_name"]; ?> <?php echo $row["last_name"]; ?></td>
            <td><div class="<?php echo !!$row["user_status"]? 'active':'inactive'; ?>"></div></td>
            <td><?php echo $row["role"]; ?></td>
            <td><button type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data"><span class="fa fa-edit"></span></button>
                <button type="button" name="delete" value="Delete" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs delete_data" style="margin-left: 10px;"><span class="fa fa-trash"></span></button>
            </td>
        </tr>
    <?php }
    } else {
        echo "No Records Found!";
    }
}

// ДОДАЮ КОРИСТУВАЧА
    if(isset($_POST['checking_add'])) {
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $status = $_POST['status'];
        $role = $_POST['role'];

        $query = "INSERT INTO users (first_name,last_name,user_status,role) VALUES ('$fname','$lname','$status','$role')";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $status = $_POST['user_status'];
            $role = $_POST['user_role'];
        } else {
            echo $return = "Something Went Wrong.!";
        }
    }