<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "users_db");
$query = "SELECT * FROM `users`";
$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Data</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="container">
    <div class="table-wrapper" style="padding-bottom: 0;">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6" style="height: 40px; width: 345px;">
                    <h2><b>Users </b>Management System</h2>
                </div>
                <!--ГРУПА КНОПОК ВЕРХ-->
                <div class="col-sm-6" id="add_top">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addEmployeeModal" id="add_button" style="margin-top: 8px;">Add User</button>

                    <div class="form-group" style="height: 40px;">
                        <label>
                            <select class="form-control" id="action1" style="margin-top: 8px; height: 32px; width: 150px;">
                                <option value="">Please select</option>
                                <option value="Set Active">Set Active</option>
                                <option value="Set Not Active">Set Not Active</option>
                                <option value="Delete">Delete</option>
                            </select>
                        </label>
                    </div>
                    <button class="btn_ok btn-success" id="ok" style="margin-top: 8px; margin-left: 0;"><span style="margin-top: 2px;">Ok</span></button>
                </div>
            </div>
        </div>

        <!--ТАБЛИЦЯ-->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="selectAll">
                            <label for="selectAll"></label>
                        </span>
                    </th>
                    <th>NAME</th>
                    <th>STATUS</th>
                    <th>ROLE</th>
                    <th>OPTION</th>
                </tr>
            </thead>
            <tbody class="usersdata" id="usersdata">

            </tbody>
    </table>

        <!--ГРУПА КНОПОК НИЗ-->
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6" id="add_bottom" >
                    <a href="#addEmployeeModal" class="btn btn-success " data-toggle="modal" style="margin-top: 8px;"><span>Add User</span></a>
                    <div class="form-group" style="height: 40px;">
                        <label>
                            <select id="action2" class="form-control" name="select" style="margin-top: 8px; height: 32px; width: 150px;">
                                <option value="select">Please select</option>
                                <option  value="set-active">Set active</option>
                                <option  value="set-not-active">Set not active</option>
                                <option value="delete">Delete</option>
                            </select>
                        </label>
                    </div>
                   <button class="btn btn-success" type="submit" name="submit" style="margin-top: 8px; margin-left: 0;"><span style="margin-top: 2px;">Ok</span></button>
                </div>
            </div>
    </div>

    <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="user_form">
                <div class="modal-header">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firstName1">FIRST NAME</label>
                        <input type="text" id="firstName1" name="firstName1" class="form-control firstName1" placeholder="First Name" required >
                        <span id="firstName1_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="lastName1">LAST NAME</label>
                        <input type="text" id="lastName1" name="lastName1" class="form-control lastName1" placeholder="Last Name" required >
                        <span id="lastName1_error" class="text-danger"></span>
                    </div>
                    <!--SWITCHBOX-->
                    <div class="form-group custom-control custom-switch" style="margin-top: 30px; margin-bottom: 0;">
                        <label for="status1" class="col-form-label">STATUS</label>
                        <label for="status1" class="switch" style="margin-left: 30px;">
                            <input type="checkbox" class="status" name="status1" id="status1" value="0" required >
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <!--SELECTBOX-->
                    <div class="form-group" >
                        <label style="padding-top:28px;">
                            <select class="form-control role" name="role1" id="role1" style="height: 34px;" required >
                                <option value="" >Please select</option>
                                <option value="Admin" onselect>Admin</option>
                                <option value="User" onselect>User</option>
                            </select>
                            <span id="role1_error" class="text-danger"></span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="hidden" name="employee_id" id="employee_id" />
                    <input type="button" class="btn btn-success " id="save" value="Save" />
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- DELETE Modal  -->
    <div id="actionEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 238px;">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_d" name="id" class="form-control">
                    <p>Are you sure you want to <span id="action-text">delete</span> these Records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="button" class="btn btn-success" id="delete">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- PLEASE SELECT USERS -->
    <div id="selectEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="height: 200px;">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Select User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_d" name="id" class="form-control">
                        <h5>Please select Users</h5>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-success" data-dismiss="modal" id="select" value="Ok">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--DELETE icons -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="height: 238px;">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_delete" ">
                        <p>Are you sure you want to <span id="action-text">delete</span> these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="button" class="btn btn-danger" id="btnDelete" >Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Successfully  -->
    <div id="successEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="height: 200px;">
                <form id="successModal">
                    <div class="modal-header">
                        <h4 class="modal-title">Add User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_d" name="id" class="form-control">
                        <h5 class="modal-body-text">Data added successfully !</h5>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-success" data-dismiss="modal" value="Ok">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    <script src="ajax/app.js"></script>

</body>
</html>