$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    // Start data store script
    $("#btn-add-class").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var classname = $("#class").val();

        if (classname == "") {
            $("#class").addClass("has-error");
            $("#class").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-add-class").addClass('disabled');
            $("#btn-add-class").html('. . . . .');

            var message = '';

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { "class": classname },
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

                        $("#class").val('');

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
                    $("#btn-add-class").removeClass('disabled');
                    $("#btn-add-class").html('Submitted');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End data store script

    // Start data update script
    $("#btn-update-class").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var classname = $("#class").val();

        if (classname == "") {
            $("#class").addClass("has-error");
            $("#class").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-update-class").addClass('disabled');
            $("#btn-update-class").html('. . . . .');

            var message = '';

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { "class": classname },
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
                    $("#btn-update-class").removeClass('disabled');
                    $("#btn-update-class").html('Updated');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End data update script


    // Start Delete Data Script
    $(document).on('click', '#btn-delete-class', function () {

        var class_id = $(this).data('id');
        var url = baseUrl + '/class/delete';
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
                    data: { class_id: class_id },
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