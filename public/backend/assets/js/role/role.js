$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    // Start data store script
    $("#btn-add-role").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var role = $("#role").val();
        
        var permission = $('.permission:checkbox:checked').map(function () {
            return this.value;
        }).get();

        
        if (role == "") {
            $("#role").addClass("has-error");
            $("#role").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (permission == "") {
            $(".permission").addClass("has-error");
            $(".permission").after("<span class='error text-danger'>Please select permisison.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-add-role").addClass('disabled');
            $("#btn-add-role").html('. . . . .');

            var message = '';

            var formData = {
                "role": role,
                "permission": permission,
            };


            $.ajax({
                type: 'POST',
                url: baseUrl + '/role',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                dataType: "json",
                success: function (response) {

                    if (response.status === false) {
                        var a = response.error;

                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                message += `<div class="alert alert-danger">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <ul>`;
                                $.each(response.error, function (key, value) {

                                    $("#" + key).addClass("has-error");
                                    $("#" + key).after("<span class='error text-danger'>" + value.toString().replace(',', '<br>') + "</span>");

                                    message += `<li>` + value + `</li>`
                                });
                                message += `</ul>
                                    </div>`;
                            }
                        } else {
                            message += `<div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                <strong> Success!</strong> `+ response.message + `
                                            </div>`;
                        }
                    } else {

                        $("#role").val('');
                        $(".permission").prop('checked', false);

                        message += `<div class="alert alert-success alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong> Success!</strong> `+ response.message + `
                                </div>`;
                    }
                },
                error: function () {
                    message = `<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong> Whoops !</strong> Something went wrong please contact to admintrator.
                            </div>`;
                },
                complete: function () {

                    $("form").prepend(message);
                    $("#btn-add-role").removeClass('disabled');
                    $("#btn-add-role").html('Submitted');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End data store script

    // Start data update script
    $("#btn-update-role").on("click", function (e) {
        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var role = $("#role").val();
        var role_id = $("#role-id").val();
        var permission = $('.permission:checkbox:checked').map(function () {
            return this.value;
        }).get();

        if (role == "") {
            $("#role").addClass("has-error");
            $("#role").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (permission == "") {
            $(".permission").addClass("has-error");
            $(".permission").after("<span class='error text-danger'>Please select permisison.</span>");
            flag = false;
        }

        if (role_id == "") {
            $("#role-id").addClass("has-error");
            $("#role-id").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-update-role").addClass('disabled');
            $("#btn-update-role").html('. . . . .');

            var message = '';
            var message = '';

            var formData = {
                "role": role,
                "permission": permission,
                "id": role_id,
            };

            $.ajax({
                type: 'PUT',
                url: baseUrl + '/role/update',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                dataType: "json",
                success: function (response) {

                    if (response.status === false) {
                        var a = response.error;

                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                message += `<div class="alert alert-danger">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <ul>`;
                                $.each(response.error, function (key, value) {

                                    $("#" + key).addClass("has-error");
                                    $("#" + key).after("<span class='error text-danger'>" + value.toString().replace(',', '<br>') + "</span>");

                                    message += `<li>` + value + `</li>`
                                });
                                message += `</ul>
                                    </div>`;
                            }
                        } else {
                            message += `<div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                <strong> Success!</strong> `+ response.message + `
                                            </div>`;
                        }
                    } else {

                        message += `<div class="alert alert-success alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong> Success!</strong> `+ response.message + `
                                </div>`;
                    }
                },
                error: function () {
                    message = `<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong> Whoops !</strong> Something went wrong please contact to admintrator.
                            </div>`;
                },
                complete: function () {

                    $("form").prepend(message);
                    $("#btn-update-role").removeClass('disabled');
                    $("#btn-update-role").html('Updated');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End data update script

    // Start Delete Data Script
    $(document).on('click', '#btn-delete-teacher', function () {

        var system_id = $(this).data('id');
        var url = baseUrl + '/teacher/delete';
        var row = $(this).parent().parent("tr");

        swal.fire({

            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this record',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 300,
            allowOutsideClick: false

        }).then(function (result) {

            if (result.value) {

                var message;
                // console.log(message);

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: { system_id: system_id },
                    dataType: "json",
                    success: function (response) {
                        if (response.status == false) {

                            message = {
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            };

                        } else {
                            row.remove();

                            message = {
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                            }
                        }
                    },

                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Some thing went wrong please contact to Administrator!',
                        })
                    },

                    complete: function () {
                        Swal.fire({
                            icon: message.icon,
                            title: message.title,
                            text: message.text,
                        })
                    }
                });
            }
        });
    });
    // End Delete Data Script

});