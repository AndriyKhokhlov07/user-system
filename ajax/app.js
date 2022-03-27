displayData();

$('#add_button').click(function(){
    $('#save').val("Save");
    $('#user_form')[0].reset();
    $('.modal-title').text("Add User");
});

/////// ПЕРЕГЛЯДАЮ ДАНІ КОРИСТУВАЧА ///////
$(document).on('click', '.edit_data', function() {
    let employee_id = $(this).attr('id');

    $.ajax({
        url: "fetch.php",
        method: "POST",
        data: { employee_id: employee_id },
        dataType: "json",
        success: function (data) {
            // let employee_id = data.id;
            let first_name = data.first_name;
            let last_name = data.last_name;
            let user_status = data.user_status;
            let role = data.role;

            $('#employee_id').val(data.id);
            $('#firstName1').val(first_name);
            $('#lastName1').val(last_name);
            $('#status1').is(function () {
                $(this).val(user_status);
                if (user_status == 0) $(this).prop('checked', false);
                else $(this).prop('checked', true);
            });
            $('#role1').val(role);

            $('.modal-title').text("Edit User");
            $('#save').val("Update");
            $('#addEmployeeModal').modal('show');
        }
    });
  });
$('#save').click(function (e) {

    let employee_id = $('#employee_id').val();
    let fname = $('#firstName1').val();
    let lname = $('#lastName1').val();
    let status = $('#status1').val();
    let role = $('#role1').val();
    e.preventDefault();

    if(employee_id) {
        if (fname !== "" && lname !== "" && status !== "" && role !== "") {
            $.ajax({
                url: 'update.php',
                type: 'POST',
                dataType: "html",
                data: {
                    update_user: true,
                    employee_id: employee_id,
                    first_name: fname,
                    last_name: lname,
                    user_status: status,
                    user_role: role,
                },
                success: function (data) {
                    displayData(data);
                    $('#addEmployeeModal').modal('hide');
                    $('.modal-title').text("Update User");
                    $('.modal-body-text').text("Data updated successfully !");
                    $('#successEmployeeModal').modal('show');
                }
            });
        }
    } else {
        if (fname !== "" && lname !== "" && status !== "" && role !== "") {
            $.ajax({
                type: "POST",
                url: "save.php",
                data: {
                    checking_add: true,
                    firstName: fname,
                    lastName: lname,
                    status: status,
                    role: role,
                },
                success: function (data) {
                    displayData(data);
                    $('#addEmployeeModal').modal('hide');
                    $('#successEmployeeModal').modal('show');
                  }
            });
        } else {
            alert("Please enter all fillds.");
        }
    }
});
 ////// ВИДАЛЯЮ КОРИСТУВАЧА ///////
    $('body').on('click', '.delete_data', function () {
    let id = $(this).attr("id");
    let id_obj = $(this).parents("tr");
    $('#deleteEmployeeModal').modal('show');
    $('#btnDelete').click(function () {
        $.ajax({
            url: 'delete.php',
            method: 'POST',
            data: { id:id },
        }).done(function () {
            id_obj.remove();
            $('#deleteEmployeeModal').modal('hide');
            $('.modal-title').text("Delete User");
            $('.modal-body-text').text("Data deleted successfully !");
            $('#successEmployeeModal').modal('show');
        });
    });
})
//////// ГРУПОВІ ДІЇ ////////
$(document).on("click", "#ok", function() {
    let action = $('#action1 :selected').val();
    console.log(action);

    let users = [];
    $(".userCheckbox:checked").each(function (i) {
        users[i] = $(this).attr('data-id');
    });
    console.log(users);

    if (users.length <= 0) {
        $('#selectEmployeeModal').modal('show');
    } else {
        let title = action + ' Users';
        $('.modal-title').text(title);
        $('#delete').text(action);
        $('#action-text').text(action.toLowerCase());
        $('#actionEmployeeModal').modal('show');


        $("#delete").click(function () {
            if ($('#action1').val() === "Set Active") {
                let status = 1;
                $.ajax({
                    type: "POST",
                    url: "update_all.php",
                    dataType: 'html',
                    data: {
                        update_status: true,
                        id: users,
                        status: status
                    },
                    success: function (data) {
                         displayData(data);
                        $('#actionEmployeeModal').modal('hide');
                        $('.modal-title').text("Set Active User");
                        $('.modal-body-text').text("Data updated successfully !");
                        $('#successEmployeeModal').modal('show');
                    }
                });
            }

            if ($('#action1').val() === "Set Not Active") {
                let status = 0;
                $.ajax({
                    type: "POST",
                    url: "update_all.php",
                    dataType: 'html',
                    data: {
                        update_status: true,
                        id: users,
                        status: status
                    },
                    success: function (data) {
                        displayData(data);
                        $('#actionEmployeeModal').modal('hide');
                        $('.modal-title').text("Set Not Active User");
                        $('.modal-body-text').text("Data updated successfully !");
                        $('#successEmployeeModal').modal('show');
                    }
                });
            }

            if ($('#action1').val() === "Delete") {
                $.ajax({
                    url: 'delete_all.php',
                    method: 'POST',
                    data: {id: users},
                    success: function () {
                        for (let i = 0; i < users.length; i++) {
                            $('tr#' + users[i]).remove();
                        }
                        $('#actionEmployeeModal').modal('hide');
                        $('#successEmployeeModal').modal('show');
                        $('.modal-title').text("Delete User");
                        $('.modal-body-text').text("Data deleted successfully !");

                    }
                });
            } else {
                return false;
            }
        });
    }
});

//////// ВІДОБРАЖАЮ КОРИСТУВАЧІВ ////////
   function displayData() {
       let displayData = "displayData";
       $.ajax({
           type: "POST",
           url: "save.php",
           data: { displayData: displayData },
           success: function (data) {
               $('#usersdata').html(data);
           }
       });
   }
 ////// ЛОГІКА CHECK-BOX //////
    $("#selectAll").change(function () {
        $(".userCheckbox").prop("checked", $(this).prop("checked"))
    })
    $(".userCheckbox").change(function () {
        if($(this).prop("checked") === false) {
            $("#selectAll").prop("checked", false)
        }
        if($(".userCheckbox:checked").length === $(".userCheckbox").length){
            $("#selectAll").prop("checked", true)
        }
    })


    ////// ЛОГІКА SWITCH-BOX ///////
    $('#status1').click(function () {
        if (this.checked) {
            $(this).attr('value', 1);
        } else {
            $(this).attr('value', 0);
        }
    });

   $('#status').click(function () {
       if (this.checked) {
           $(this).attr('value', 1);
       } else {
           $(this).attr('value', 0);
       }
   });
