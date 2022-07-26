$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    // $("#add_campus").validate({
    //     rules: {
    //         "system_id[]": "required"
    //     },
    //     messages: {
    //         "system_id[]": "Please select category",
    //     }
    // });

    $('body').on("click", ".btn-add-system", function (e) {

        var system_length;

        var length        = $('.system-row').find('.row').length;

        if(length > 1){
            system_length = $('select[name="system_id[]"] option:first-child').length - 1;
        } else {
            system_length = $('select[name="system_id[]"] option').length - 1;
        }

        // if (length < system_length) {

            var add_system_row  =  $('.system-row').find('.row:last-child').html();
                add_system_row  = '<div class="row">'+add_system_row+'</div>';
            
            $(this).removeClass("btn-add-system");
            $(this).addClass("btn-remove-system");
            $(this).attr("alt", "remove-system");
            $(this).attr("src", baseUrl + "/backend/assets/img/remove-icon.png");
            
            $('.system-row').append(add_system_row);

        // }
    });

    $('body').on("click", ".btn-remove-system", function (e) {
        $(this).parent().parent().parent().remove();
    });

    // Start data store script
    $("#btn-add-campus").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var campus = $("#campus").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var address = $("#address").val();
        var logo = $("#logo").val();
        var active_session = $("#active_session").val();

        if (campus == "") {
            $("#campus").addClass("has-error");
            $("#campus").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (email == "") {
            $("#email").addClass("has-error");
            $("#email").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        } else if( !isEmail(email)) {
            $("#email").addClass("has-error");
            $("#email").after("<span class='error text-danger'>This email is not valid.</span>");
            flag = false;
        }

        if (phone == "") {
            $("#phone").addClass("has-error");
            $("#phone").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (address == "") {
            $("#address").addClass("has-error");
            $("#address").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (active_session == "") {
            $("#active_session").addClass("has-error");
            $("#active_session").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        $('.system-row').find('.row').each(function() {

            var system_id  = $(this).children().find("select[name='system_id[]']").val();
            var short_name = $(this).children().find("input[name='short_name[]']").val();
            
            if(system_id == ""){
                $(this).children().find("select[name='system_id[]']").siblings("span").find(".select2-selection--single").addClass("has-error");
                $(this).children().find("select[name='system_id[]']").siblings("span").after("<span class='error'>This field is required.</span>");
                flag = false;
            }

            if(short_name == ""){
                $(this).children().find("input[name='short_name[]']").addClass("has-error");
                $(this).children().find("input[name='short_name[]']").after("<span class='error text-danger'>This field is required.</span>");
                flag = false;
            }

        });
       
        if (flag) {

            var systems = $("select[name='system_id[]']").serializeArray();
            var system_id = [];
            systems.forEach(function (data) {
                system_id.push(data.value);
            });
            
            var short_names = $("input[name='short_name[]']").serializeArray();
            var short_name = [];
            short_names.forEach(function (data) {
                short_name.push(data.value);
            });

            $("#btn-add-campus").addClass('disabled');
            $("#btn-add-campus").html('. . . . .');

            var message = '';
            var formData = {
                "campus"          :  campus,
                "email"           :  email,
                "phone"           :  phone,
                "address"         :  address,
                "active_session"  :  active_session,
                "system_id"       :  system_id,
                "short_name"      :  short_name
            };
            $('#image-input-error').text('');

            console.log(formData);

            $.ajax({
                url: $(this).parent('form').attr('action'),
                type: $(this).parent('form').attr('method'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                // dataType: "json",
                // cache: false,
                // contentType: false,
                // processData: false,
                success: function (response) {

                    console.log(response);

                    if (response.status === false) {

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

                        $("#campus").val('');

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
                    $("#btn-add-campus").removeClass('disabled');
                    $("#btn-add-campus").html('Submitted');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End data store script

    // Start data update script
    $("#btn-update-campus").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var campus = $("#campus").val();

        if (campus == "") {
            $("#campus").addClass("has-error");
            $("#campus").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-update-campus").addClass('disabled');
            $("#btn-update-campus").html('. . . . .');

            var message = '';

            $.ajax({
                type: $(this).parent('form').attr('method'),
                url: $(this).parent('form').attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { "campus": campus },
                dataType: "json",
                success: function (response) {

                    if (response.status === false) {
                       
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
                    $("#btn-update-campus").removeClass('disabled');
                    $("#btn-update-campus").html('Updated');
                    setTimeout(function () {
                        $(".alert").remove();
                    }, 4000);
                }
            });
        }
    });
    // End data update script


    // Start Delete Data Script
    $(document).on('click', '#btn-delete-campus', function () {

        var campus_id = $(this).data('id');
        var url = baseUrl + '/campus/delete';
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
                    data: { campus_id: campus_id },
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

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
      }

});