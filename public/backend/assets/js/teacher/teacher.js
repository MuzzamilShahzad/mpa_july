$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    // Start data store script
    $("#btn-add-teacher").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var teacher = $("#teacher").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var area = $("#area").val();
        var city = $("#city").val();
        var address = $("#address").val();

        if (teacher == "") {
            $("#teacher").addClass("has-error");
            $("#teacher").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (email == "") {
            $("#email").addClass("has-error");
            $("#email").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (phone == "") {
            $("#phone").addClass("has-error");
            $("#phone").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (area == "") {
            $("#area").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#area").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (city == "") {
            $("#city").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#city").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (address == "") {
            $("#address").addClass("has-error");
            $("#address").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-add-teacher").addClass('disabled');
            $("#btn-add-teacher").html('. . . . .');

            var message = '';

            var formData = {
                "teacher": teacher,
                "email": email,
                "phone": phone,
                "area": area,
                "city": city,
                "address": address,
            };

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
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

                        $("#teacher").val('');
                        $("#email").val('');
                        $("#phone").val('');
                        $("#area").val('');
                        $("#city").val('');
                        $("#address").val('');

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
                    $("#btn-add-teacher").removeClass('disabled');
                    $("#btn-add-teacher").html('Submitted');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End data store script

    // Start data update script
    $("#btn-update-teacher").on("click", function (e) {
        console.log("running");
        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var teacher = $("#teacher").val();

        if (teacher == "") {
            $("#teacher").addClass("has-error");
            $("#teacher").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-update-teacher").addClass('disabled');
            $("#btn-update-teacher").html('. . . . .');

            var message = '';

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { "teacher": teacher },
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
                    $("#btn-update-teacher").removeClass('disabled');
                    $("#btn-update-teacher").html('Updated');
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