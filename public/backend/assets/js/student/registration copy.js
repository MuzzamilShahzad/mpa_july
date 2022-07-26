$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    $("#btn-add-registration").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;

        var campus_id = $("#campus-id").val();
        var system_id = $("#system-id").val();
        var class_id = $("#class-id").val();
        var class_group_id = $("#class-group-id").val();
        var session_id = $("#session-id").val();
        var form_no = $("#form-no").val();
        var first_name = $("#first-name").val();
        var last_name = $("#last-name").val();
        var dob = $("#dob").val();
        var gender = $("#gender").val();
        var siblings_in_mpa = $("#siblings-in-mpa").val();
        var no_of_siblings = $("#no-of-siblings").val();
        var previous_class = $("#previous-class").val();
        var previous_school = $("#previous-school").val();

        var house_no = $("#house-no").val();
        var block_no = $("#block-no").val();
        var building_no = $("#building-no").val();
        var area_id = $("#area-id").val();
        var city_id = $("#city-id").val();

        var father_cnic = $("#father-cnic").val();
        var father_name = $("#father-name").val();
        var father_occupation = $("#father-occupation").val();
        var father_company_name = $("#father-company-name").val();
        var father_salary = $("#father-salary").val();
        var father_email = $("#father-email").val();
        var father_phone = $("#father-phone").val();
        var hear_about_us = $("#hear-about-us").val();
        var hear_about_us_other = $("#hear-about-us-other").val();

        var test_group_chkbox = $('#test-group-chkbox').is(':checked');
        var interview_group_chkbox = $('#interview-group-chkbox').is(':checked');

        var test_group = $("#test-group-id").val();
        var interview_group = $("#interview-group-id").val();

        if (campus_id == "" || campus_id == "0") {
            $("#campus-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#campus-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (system_id == "" || system_id == "0") {
            $("#system-id:not([disabled])").find(".select2-selection--single").addClass("has-error");
            $("#system-id:not([disabled])").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (class_id == "" || class_id == "0") {
            $("#class-id:not([disabled]").find(".select2-selection--single").addClass("has-error");
            $("#class-id:not([disabled]").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (session_id == "" || session_id == "0") {
            $("#session-id").find(".select2-selection--single").addClass("has-error");
            $("#session-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (class_group_id == "" || class_group_id == "0") {
            $("#class-group-id").find(".select2-selection--single").addClass("has-error");
            $("#class-group-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (first_name == "") {
            $("#first-name").addClass("has-error");
            $("#first-name ").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (last_name == "") {
            $("#last-name").addClass("has-error");
            $("#last-name").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (gender == "") {
            $("#gender").find(".select2-selection--single").addClass("has-error");
            $("#gender").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (siblings_in_mpa == "") {
            $("#siblings-in-mpa").addClass("has-error");
            $("#siblings-in-mpa").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (siblings_in_mpa == "Yes" && no_of_siblings == "") {
            $("#no-of-siblings").addClass("has-error");
            $("#no-of-siblings").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (house_no == "") {
            $("#house-no").addClass("has-error");
            $("#house-no").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (block_no == "") {
            $("#block-no").addClass("has-error");
            $("#block-no").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (area_id == "" || area_id == "0") {
            $("#area-id").siblings("span").addClass("has-error");
            $("#area-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (city_id == "" || city_id == "0") {
            $("#city-id").siblings("span").addClass("has-error");
            $("#city-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (father_name == "") {
            $("#father-name").addClass("has-error");
            $("#father-name").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (father_cnic == "") {
            $("#father-cnic").addClass("has-error");
            $("#father-cnic").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        } else if ($.isNumeric(father_cnic.replace(/-/g, '')) === false) {
            $("#father-cnic").addClass("has-error");
            $("#father-cnic").after("<span class='error text-danger'>This field must be a number.</span>");
            flag = false;
        }

        if (father_phone == "") {
            $("#father-phone").addClass("has-error");
            $("#father-phone").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        } else if ($.isNumeric(father_phone.replace(/-/g, '')) === false) {
            $("#father-phone").addClass("has-error");
            $("#father-phone").after("<span class='error text-danger'>This field must be a number.</span>");
            flag = false;
        }

        if (hear_about_us == "other" && hear_about_us_other == "") {
            $("#hear-about-us-other").addClass("has-error");
            $("#hear-about-us-other").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if ($('#test-group-chkbox').is(':checked')) {

            if ($("#test-group-id").prop("disabled")) {

                var test_name = $("#test-name").val();
                var test_date = $("#test-date").val();
                var test_time = $("#test-time").val();

                if ($("#test-name").val() == "") {
                    $("#test-name").addClass("has-error");
                    $("#test-name").after("<span class='error text-danger'>This field is required.</span>");
                    flag = false;
                }
                if ($("#test-date").val() == "") {
                    $("#test-date").addClass("has-error");
                    $("#test-date").after("<span class='error text-danger'>This field is required.</span>");
                    flag = false;
                }
                if ($("#test-time").val() == "") {
                    $("#test-time").addClass("has-error");
                    $("#test-time").after("<span class='error text-danger'>This field is required.</span>");
                    flag = false;
                }

            } else {

                if ($("#test-group-id").val() == "") {
                    $("#test-group-id:not([disabled]").siblings("span").find(".select2-selection--single").addClass("has-error");
                    $("#test-group-id:not([disabled]").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
                    flag = false;
                }

            }

        }
        if ($('#interview-group-chkbox').is(':checked')) {

            if ($("#interview-group-id").prop("disabled")) {

                var interview_name = $("#interview-name").val();
                var interview_date = $("#interview-date").val();
                var interview_time = $("#interview-time").val();

                if ($("#interview-name").val() == "") {
                    $("#interview-name").addClass("has-error");
                    $("#interview-name").after("<span class='error text-danger'>This field is required.</span>");
                    flag = false;
                }
                if ($("#interview-date").val() == "") {
                    $("#interview-date").addClass("has-error");
                    $("#interview-date").after("<span class='error text-danger'>This field is required.</span>");
                    flag = false;
                }
                if ($("#interview-time").val() == "") {
                    $("#interview-time").addClass("has-error");
                    $("#interview-time").after("<span class='error text-danger'>This field is required.</span>");
                    flag = false;
                }

            } else {
                if ($("#interview-group-id").val() == "") {
                    $("#interview-group-id:not([disabled]").siblings("span").find(".select2-selection--single").addClass("has-error");
                    $("#interview-group-id:not([disabled]").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
                    flag = false;
                }
            }
        }

        if (flag) {

            $("#btn-add-registration").addClass('disabled');
            $("#btn-add-registration").html('. . . . .');

            var message = '';
            var formData = {
                "campus_id": campus_id,
                "system_id": system_id,
                "class_id": class_id,
                "class_group_id": class_group_id,
                "form_no": form_no,
                "session_id": session_id,
                "first_name": first_name,
                "last_name": last_name,
                "dob": dob,
                "gender": gender,
                "siblings_in_mpa": siblings_in_mpa,
                "no_of_siblings": no_of_siblings,
                "previous_class": previous_class,
                "previous_school": previous_school,

                "house_no": house_no,
                "block_no": block_no,
                "building_no": building_no,
                "area_id": area_id,
                "city_id": city_id,

                "father_salary": father_salary,
                "father_name": father_name,
                "father_cnic": father_cnic.replace(/-/g, ''),
                "father_email": father_email,
                "father_occupation": father_occupation,
                "father_company_name": father_company_name,
                "father_phone": father_phone.replace("-", ""),
                "hear_about_us": hear_about_us,
                "hear_about_us_other": hear_about_us_other,

                "test_group_chkbox": test_group_chkbox,
                "interview_group_chkbox": interview_group_chkbox,

                "test_group_id": test_group,
                "interview_group_id": interview_group,

                "test_name": test_name,
                "test_date": test_date,
                "test_time": test_time,

                "interview_name": interview_name,
                "interview_date": interview_date,
                "interview_time": interview_time,

            };

            $.ajax({
                url: baseUrl + '/student/registration/store',
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.status === false) {

                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                var input_fields = ['', 'first_name', 'form_no', 'last_name', 'dob', 'no_of_siblings', 'previous_school', 'father_cnic', 'father_name', 'father_occupation', 'father_phone',
                                    'father_salary', 'father_email', 'father_company_name', 'test_name', 'test_date', 'test_time', 'interview_name', 'interview_date', 'interview_time'];
                                $.each(response.error, function (key, value) {
                                    if (input_fields.indexOf(key)) {
                                        $("input[name='" + key + "']").addClass("has-error");
                                        $("input[name='" + key + "']").after("<span class='error text-danger'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                    } else {
                                        $("select[name='" + key + "']").siblings("span").find(".select2-selection--single").addClass("has-error");
                                        $("select[name='" + key + "']").siblings("span").after("<span class='error text-danger'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                    }

                                });
                            }
                        } else {
                            message += `<div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <strong> Success!</strong> `+ response.message + `
                                        </div>`;
                        }
                    } else {

                        $("#campus-id, #class-id, #session-id, #gender, #siblings-in-mpa, #area-id, #test-group-id, #interview-group-id").val('').change();
                        $("#system, #form-no, #computerize-registration, #first-name, #last-name, #dob, #no-of-siblings, #previous-class, #previous-school, #house-no, #block-no, #building-name-no, #city, #father-cnic, #father-name, #father-occupation, #father-company-name, #father-salary, #father-email, #father-phone, #other").val('');

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

                    if (message !== '') {
                        $("form").prepend(message);
                    }

                    $("#btn-add-registration").removeClass('disabled');
                    $("#btn-add-registration").html('Submit');
                }
            });
        }
    });

    // $('#interview-group-chkbox').change(function (e) {

    //     var session_id = $("#session-id").val();

    //     if (session_id == "" || session_id == "0") {
    //         $("#session-id").find(".select2-selection--single").addClass("has-error");
    //         $("#session-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
    //         $("#interview-group-id").siblings("span").after("<span class='error text-danger'>Please select session first.</span>");
    //         flag = false;
    //     } else {

    //         if ($("#interview-group-id").prop("disabled", true)) {

    //             $.ajax({
    //                 url: baseUrl + '/get/interview-group',
    //                 type: "GET",
    //                 data: { session_id: session_id },
    //                 success: function (response) {

    //                     if (response.status === true) {
    //                         var interviewGroupRecord = response.interviewGroup
    //                         var interviewGroup = `<option selected value="0">Select </option>`;
    //                         if (interviewGroupRecord.length) {
    //                             $(interviewGroupRecord).each(function (key, value) {
    //                                 console.log(value);
    //                                 interviewGroup += `<option value="` + value.id + `" >` + value.name + `</option>`;
    //                             });
    //                         }


    //                         $('#interview-group-id').prop('disabled', false);
    //                         $('#interview-group-id').html(interviewGroup);

    //                     }
    //                 }
    //             });
    //         }
    //     }
    // });

    $('#hear-about-us').change(function (e) {

        var hear_about_us = $("#hear-about-us").val();
        if (hear_about_us === "other") {
            $('#hear-about-us').parent().parent().parent().after(`<div class="form-group col-md-4 mb-0" id="hear-about-us-other-row">
                                                                        <div class="form-group">
                                                                            <label class="form-label tx-semibold">Other</label>
                                                                            <input type="text" class="form-control" name="hear_about_us_other" id="hear-about-us-other">
                                                                        </div>
                                                                    </div>`);
        } else {

            $("#hear-about-us-other-row").remove();

        }

    });

    $('#hear-about-us-edit-field').change(function (e) {

        var hear_about_us = $("#hear-about-us-edit-field").val();
        if (hear_about_us === "other") {
            $('#hear-about-us-edit-field').parent().parent().parent().after(`<div class="col-3" id="hear-about-us-other-row">
                                                                        <div class="form-group">
                                                                            <label class="form-label tx-semibold">Other</label>
                                                                            <input type="text" class="form-control" name="hear_about_us_other" id="hear-about-us-other">
                                                                        </div>
                                                                    </div>`);
        } else {

            $("#hear-about-us-other-row").remove();

        }

    });

    $(document).on('click', '#delete-all', function () {
        $('.reg-checkbox:checkbox:checked').each(function () {
            var registration_id = (this.checked ? $(this).val() : "");
            if (registration_id) {
                console.log(registration_id);
            }
        });
    });

    $('#select-all').on("click", function () {

        var result = $('.reg-checkbox').is(':checked');
        if (result) {
            $('.reg-checkbox').removeAttr('checked');

            $('.action-btn').prop('disabled', false);
            $('.action-btn').prop('disabled', false);
            $('.action-btn').prop('disabled', false);

            $('#delete-all').remove();
            $('#promote').remove();
        } else {
            $('.reg-checkbox').attr('checked', 'checked');

            $('.action-btn').prop('disabled', true);
            $('.action-btn').prop('disabled', true);
            $('.action-btn').prop('disabled', true);

            $('.table-heading').after("&nbsp;&nbsp;<button class='btn btn-sm btn-danger' id='delete-all'> Delete </button>&nbsp;&nbsp;<button data-bs-target='#promote-student-modal' data-bs-toggle='modal' class='btn btn-sm btn-primary' id='promote'> Promote </button>");
        }

    })

    $('.reg-checkbox').on("click", function () {

        var result = $('.reg-checkbox').is(':checked');
        if (result) {
            $('.action-btn').prop('disabled', true);
            $('.action-btn').prop('disabled', true);
            $('.action-btn').prop('disabled', true);

            var delete_all_btn = $('#delete-all').length;
            var promote_all_btn = $('#promote').length;

            if (promote_all_btn) {
                // do nothing
            } else {
                $('.table-heading').after("&nbsp;&nbsp;<button data-bs-target='#promote-student-modal' data-bs-toggle='modal' class='btn btn-sm btn-primary' id='promote'> Promote </button>");
            }
            if (delete_all_btn) {
                // do nothing
            } else {
                $('.table-heading').after("&nbsp;&nbsp;<button class='btn btn-sm btn-danger' id='delete-all'> Delete </button>");
            }


        } else {
            $('.action-btn').prop('disabled', false);
            $('.action-btn').prop('disabled', false);
            $('.action-btn').prop('disabled', false);

            $('#delete-all').remove();
            $('#promote').remove();
        }

    })

    $('body').on("click", "#btn-add-test", function (e) {

        // Submit Request
        $(this).parent('div').remove();
        $("#test-group-id").val('0').change();
        $("#test-group-id").prop('disabled', true);

        $('#test-group-row').after(`<div class="form-row" id="test-group-details">
                                        <div class="form-group col-md-3 mb-0">
                                            <div class="form-group">
                                                <label class="form-label tx-semibold">Name</label>
                                                <input type="text" class="form-control" name="test_name" id="test-name" placeholder="Test Name">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 mb-0">
                                            <div class="form-group">
                                                <label class="form-label tx-semibold date-picker">Date</label>
                                                <input class="form-control date-picker bg-transparent" name="test_date" id="test-date" placeholder="DD-MM-YYYY" type="text" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 mb-0">
                                            <div class="form-group">
                                                <label class="form-label tx-semibold date-picker">Time</label>
                                                <input class="form-control time-picker bg-transparent" name="test_time" id="test-time" placeholder="DD-MM-YYYY" type="time">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2 mb-0">
                                            <div class="form-group">
                                                <label class="form-label tx-semibold date-picker">Remove</label>
                                                <img src="`+ baseUrl + `/backend/assets/img/remove-icon.png" class="btn-remove-img" alt="Remove Test" id="btn-remove-test">
                                            </div>
                                        </div>
                                    </div>`);

        $('.date-picker').datepicker({
            dateFormat: 'dd-mm-yy',
            showOtherMonths: true,
            selectOtherMonths: true
        });
    });

    $('body').on("click", "#btn-remove-test", function (e) {

        $("#test-group-id").val('0').change();
        $("#test-group-id").prop('disabled', false);

        $("#test-group-details").remove();
        $("#test-group-row").children('div').after(`<div class="form-group col-md-2 mb-0">
                                                        <img src="`+ baseUrl + `/backend/assets/img/add-icon.png" class="btn-add-img" alt="Add Test" id="btn-add-test">
                                                    </div>`);
    });

    $('body').on("click", "#btn-add-interview", function (e) {

        $(this).parent('div').remove();
        $("#interview-group-id").val('0').change();
        $("#interview-group-id").prop('disabled', true);

        $('#interview-group-row').after(`<div class="form-row" id="interview-group-details">
                                            <div class="form-group col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label class="form-label tx-semibold">Name</label>
                                                    <input type="text" class="form-control" name="interview_name" id="interview-name" placeholder="Interview Name">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label class="form-label tx-semibold date-picker">Date</label>
                                                    <input class="form-control date-picker bg-transparent" name="interview_date" id="interview-date" placeholder="DD-MM-YYYY" type="text" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label class="form-label tx-semibold date-picker">Time</label>
                                                    <input class="form-control time-picker bg-transparent" name="interview_time" id="interview-time" placeholder="DD-MM-YYYY" type="time">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-2 mb-0">
                                                <div class="form-group">
                                                    <label class="form-label tx-semibold date-picker">Remove</label>
                                                    <img src="`+ baseUrl + `/backend/assets/img/remove-icon.png" class="btn-remove-img" alt="Remove Interview" id="btn-remove-interview">
                                                </div>
                                            </div>
                                        </div>`);
        $('.date-picker').datepicker({
            dateFormat: 'dd-mm-yy',
            showOtherMonths: true,
            selectOtherMonths: true
        });
    });

    $('body').on("click", "#btn-remove-interview", function (e) {

        $("#interview-group-id").val('0').change();
        $("#interview-group-id").prop('disabled', false);

        $("#interview-group-details").remove();
        $("#interview-group-row").children('div').after(`<div class="form-group col-md-2 mb-0">
                                                            <img src="`+ baseUrl + `/backend/assets/img/add-icon.png" class="btn-add-img" alt="Add Interview" id="btn-add-interview">
                                                        </div>`);
    });

    $(document).on('change', '#campus-id-old', function (e) {
        e.preventDefault();

        var campus_id = $('#campus-id').val();

        if (campus_id !== "" && campus_id > "0") {

            $.ajax({
                url: baseUrl + '/campus/school-system',
                type: "GET",
                data: { campus_id: campus_id },
                success: function (response) {
                    if (response.status === true) {

                        var campusSchoolSystems = response.campusSchoolSystems
                        var campusClasses = response.campusClasses

                        var schoolSystems = `<option selected value="0">Select School System</option>`;
                        if (campusSchoolSystems.length) {
                            $(campusSchoolSystems).each(function (key, value) {
                                schoolSystems += `<option value="` + value.id + `" >` + value.type + `</option>`;
                            });
                        }

                        $('#system-id').prop('disabled', false);
                        $('#system-id').html(schoolSystems);
                    }
                }
            });
        } else {

            $('#system-id').html('<option selected value="0">Select School System</option>');
            $('#system-id').prop('disabled', true);

            $('#class-id').html('<option selected value="0">Select Class</option>');
            $('#class-id').prop('disabled', true);

            $('#class-group-id').html('<option selected value="0">Select Class Group</option>');
            $('#class-group-id').prop('disabled', true);
        }
    });

    $(document).on('change', '#system-id-old', function (e) {
        e.preventDefault();

        var campus_id = $('#campus-id').val();
        var system_id = $('#system-id').val();

        if ((campus_id !== "" && campus_id > "0") && (system_id !== "" && system_id > "0")) {
            $.ajax({
                url: baseUrl + '/campus/classes',
                type: "GET",
                data: { campus_id: campus_id, system_id: system_id },
                success: function (response) {

                    if (response.status === true) {


                        var campusClasses = response.campusClasses;

                        var classes = `<option selected value="0">Select Class</option>`;

                        if (campusClasses.length) {
                            $(campusClasses).each(function (key, value) {
                                classes += `<option value="` + value.id + `" >` + value.name + `</option>`;
                            });
                        }

                        $('#class-id').prop('disabled', false);
                        $('#class-id').html(classes);
                    }
                }
            });
        }
    });

    $(document).on('change', '#class-id-old', function (e) {
        e.preventDefault();

        var class_id = $('#class-id').val();
        var campus_id = $('#campus-id').val();

        if ((class_id !== "" && class_id > "0") && (campus_id !== "" && campus_id > "0")) {
            $.ajax({
                url: baseUrl + '/campus/get-class-groups',
                type: "GET",
                data: { class_id: class_id, campus_id: campus_id },
                success: function (response) {

                    if (response.status === true) {

                        var classGroup = response.classGroups;

                        var groups = `<option selected value="">Select</option>`;
                        if (classGroup.length) {
                            $(classGroup).each(function (key, value) {
                                groups += `<option value="` + value.id + `" >` + value.name + `</option>`;
                            });
                        }

                        $('#class-group-id').prop('disabled', false);
                        $('#class-group-id').html(groups);
                    }
                }
            });
        }
    });

    $(document).on('change', '#campus-id', function (e) {

        e.preventDefault();

        var campus_id = $(this).val();

        if (campus_id !== "" && campus_id > "0") {
            $.ajax({
                url: baseUrl + '/campus/school-system',
                type: "GET",
                data: { campus_id: campus_id },
                success: function (response) {

                    if (response.status === true) {

                        var campusSchoolSystems = response.campusSchoolSystems
                        var schoolSystems = `<option value="">Select</option>`;

                        if (campusSchoolSystems.length) {
                            $(campusSchoolSystems).each(function (key, value) {
                                schoolSystems += `<option value="` + value.id + `" >` + value.system + `</option>`;
                            });
                        }

                        var std_modal = $('#student-details-modal').hasClass('show');
                        var promotion_modal = $('#promote-student-modal').hasClass('show');
                        if (promotion_modal) {
                            $('#promotion-form').find('#system-id').prop('disabled', false);
                            $('#promotion-form').find('#system-id').html(schoolSystems);

                            $('#promotion-form').find('#class-id, #class-group-id').siblings("span.error").remove();
                            $('#promotion-form').find('#class-id, #class-group-id').siblings("span").find(".select2-selection--single").removeClass("has-error");

                            $('#promotion-form').find('#class-id, #class-group-id').html('<option value="">Select</option>');
                            $('#promotion-form').find('#class-id, #class-group-id').prop('disabled', true);
                        } else if (std_modal) {
                            $('#edit-detail-form').find('#system-id').prop('disabled', false);
                            $('#edit-detail-form').find('#system-id').html(schoolSystems);

                            $('#edit-detail-form').find('#class-id, #class-group-id').siblings("span.error").remove();
                            $('#edit-detail-form').find('#class-id, #class-group-id').siblings("span").find(".select2-selection--single").removeClass("has-error");

                            $('#edit-detail-form').find('#class-id, #class-group-id').html('<option value="">Select</option>');
                            $('#edit-detail-form').find('#class-id, #class-group-id').prop('disabled', true);
                        } else {
                            $('#system-id').prop('disabled', false);
                            $('#system-id').html(schoolSystems);

                            $('#class-id, #class-group-id').siblings("span.error").remove();
                            $('#class-id, #class-group-id').siblings("span").find(".select2-selection--single").removeClass("has-error");

                            $('#class-id, #class-group-id').html('<option value="">Select</option>');
                            $('#class-id, #class-group-id').prop('disabled', true);
                        }

                    }
                }
            });
        } else {
            $('#system-id, #class-id, #class-group-id').siblings("span.error").remove();
            $('#system-id, #class-id, #class-group-id').siblings("span").find(".select2-selection--single").removeClass("has-error");

            $('#system-id, #class-id, #class-group-id').html('<option value="">Select</option>');
            $('#system-id, #class-id, #class-group-id').prop('disabled', true);
        }
    });

    $(document).on('change', '#system-id', function (e) {

        e.preventDefault();

        var std_modal = $('#student-details-modal').hasClass('show');
        var promotion_modal = $('#promote-student-modal').hasClass('show');

        if (promotion_modal) {
            var campus_id = $('#promotion-form').find('#campus-id').val();
            var system_id = $(this).val();
        } else if (std_modal) {
            var campus_id = $('#edit-detail-form').find('#campus-id').val();
            var system_id = $(this).val();
        } else {
            var campus_id = $('#campus-id').val();
            var system_id = $(this).val();
        }


        if ((campus_id !== "" && campus_id > "0") && (system_id !== "" && system_id > "0")) {

            $.ajax({
                url: baseUrl + '/campus/classes',
                type: "GET",
                data: { campus_id: campus_id, system_id: system_id },
                success: function (response) {

                    if (response.status === true) {

                        var campusClasses = response.campusClasses;
                        var classes = `<option value="">Select</option>`;

                        if (campusClasses.length) {
                            $(campusClasses).each(function (key, value) {
                                classes += `<option value="` + value.id + `" >` + value.class + `</option>`;
                            });
                        }

                        if (std_modal) {

                            $('#edit-detail-form').find('#class-id').prop('disabled', false);
                            $('#edit-detail-form').find('#class-id').html(classes);

                            $('#edit-detail-form').find('#class-group-id').siblings("span.error").remove();
                            $('#edit-detail-form').find('#class-group-id').siblings("span").find(".select2-selection--single").removeClass("has-error");

                            $('#edit-detail-form').find('#class-group-id').html('<option value="">Select</option>');
                            $('#edit-detail-form').find('#class-group-id').prop('disabled', true);

                        } else if (promotion_modal) {

                            $('#promotion-form').find('#class-id').prop('disabled', false);
                            $('#promotion-form').find('#class-id').html(classes);

                            $('#promotion-form').find('#class-group-id').siblings("span.error").remove();
                            $('#promotion-form').find('#class-group-id').siblings("span").find(".select2-selection--single").removeClass("has-error");

                            $('#promotion-form').find('#class-group-id').html('<option value="">Select</option>');
                            $('#promotion-form').find('#class-group-id').prop('disabled', true);

                        } else {
                            $('#class-id').prop('disabled', false);
                            $('#class-id').html(classes);

                            $('#class-group-id').siblings("span.error").remove();
                            $('#class-group-id').siblings("span").find(".select2-selection--single").removeClass("has-error");

                            $('#class-group-id').html('<option value="">Select</option>');
                            $('#class-group-id').prop('disabled', true);
                        }
                    }
                }
            });

        } else {
            $('#class-id, #class-group-id').siblings("span.error").remove();
            $('#class-id, #class-group-id').siblings("span").find(".select2-selection--single").removeClass("has-error");

            $('#class-id, #class-group-id').html('<option value="">Select</option>');
            $('#class-id, #class-group-id').prop('disabled', true);
        }

    });

    // $(document).on('change', '#session-id', function (e) {
    //     e.preventDefault();

    //     var campus_id = $('#campus-id').val();
    //     var system_id = $('#system-id').val();
    //     var session_id = $('#session-id').val();

    //     if ((campus_id !== "" && campus_id > "0") && (system_id !== "" && system_id > "0") && (session_id !== "" && session_id > "0")) {

    //         $.ajax({
    //             url: baseUrl + '/campus/student/form-id',
    //             type: "GET",
    //             data: { campus_id: campus_id, system_id: system_id, session_id: session_id },
    //             success: function (response) {
    //                 if (response.status === true) {
    //                     var formNumber = response.formNumber;
    //                     $('#reg-no').val(formNumber);
    //                 }
    //             }
    //         })

    //     } else {

    //         $('#reg-no').val("");

    //     }

    // });

    $(document).on('change', '#class-id', function (e) {
        e.preventDefault();

        var std_modal = $('#student-details-modal').hasClass('show');
        var promotion_modal = $('#promote-student-modal').hasClass('show');

        if (promotion_modal) {
            var campus_id = $('#promotion-form').find('#campus-id').val();
            var system_id = $('#promotion-form').find('#system-id').val();
            var class_id = $(this).val();
        } else if (std_modal) {
            var campus_id = $('#edit-detail-form').find('#campus-id').val();
            var system_id = $('#edit-detail-form').find('#system-id').val();
            var class_id = $(this).val();
        } else {
            var campus_id = $('#campus-id').val();
            var system_id = $('#system-id').val();
            var class_id = $('#class-id').val();
        }

        if ((campus_id !== "" && campus_id > "0") && (system_id !== "" && system_id > "0") && (class_id !== "" && class_id > "0")) {
            $.ajax({
                url: baseUrl + '/campus/class-groups-and-sections',
                type: "GET",
                data: { campus_id: campus_id, system_id: system_id, class_id: class_id },
                success: function (response) {

                    if (response.status === true) {

                        var classGroup = response.classGroups;
                        var groups = `<option value="">Select</option>`;

                        if (std_modal) {
                            if (classGroup.length) {
                                $(classGroup).each(function (key, value) {
                                    groups += `<option value="` + value.id + `" >` + value.group + `</option>`;
                                });

                                $('#edit-detail-form').find('#class-group-id').prop('disabled', false);
                                $('#edit-detail-form').find('#class-group-id').html(groups);
                            }
                        } else if (promotion_modal) {
                            if (classGroup.length) {
                                $(classGroup).each(function (key, value) {
                                    groups += `<option value="` + value.id + `" >` + value.group + `</option>`;
                                });

                                $('#promotion-form').find('#class-group-id').prop('disabled', false);
                                $('#promotion-form').find('#class-group-id').html(groups);
                            }
                        } else {
                            if (classGroup.length) {
                                $(classGroup).each(function (key, value) {
                                    groups += `<option value="` + value.id + `" >` + value.group + `</option>`;
                                });

                                $('#class-group-id').prop('disabled', false);
                                $('#class-group-id').html(groups);
                            }
                        }

                    }
                }
            });
        } else {

            $('#class-group-id').siblings("span.error").remove();
            $('#class-group-id').siblings("span").find(".select2-selection--single").removeClass("has-error");

            $('#class-group-id').html('<option value="">Select</option>');
            $('#class-group-id').prop('disabled', true);
        }
    });

    $(document).on('click', '#btn-view-registration', function () {
        console.log(id);

        var id = $(this).data('id');
        $.ajax({
            url: baseUrl + '/student/registration/details',
            type: "GET",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { id: id },
            dataType: "json",
            success: function (response) {

                if (response.status == true) {
                    $('#edit-registeration-view').find('#edit-registeration-modal').remove();

                    $('#edit-registeration-view').append(response.data);
                    $('#edit-registeration-modal').modal("show");
                }

            },
            error: function () {
                message = `<div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong> Whoops !</strong> Something went wrong please contact to admintrator.
                                </div>`;
            },
            complete: function () {
            }
        });

    });

    // $(document).on('change', '#session-id', function (e) {
    //     e.preventDefault();

    //     var session_id = $('#session-id').val();

    //     if(session_id !== "" && session_id > "0"){

    //         $.ajax({
    //             url: baseUrl + '/campus/get-test-inteview-groups',
    //             type: "GET",
    //             data: { session_id: session_id },
    //             success: function (response) {

    //                 if(response.status === true){

    //                     var interviewGroups  =  response.interviewGroups;
    //                     var testGroups       =  response.testGroups;

    //                     var interviews  =  `<option selected value="">Select</option>`;
    //                     var tests       =  `<option selected value="">Select</option>`;

    //                     if(interviewGroups.length){
    //                         $(interviewGroups).each(function(key, value){
    //                             interviews += `<option value="`+value.id+`" >`+value.type+`</option>`;
    //                         });
    //                     }

    //                     if(testGroups.length){
    //                         $(testGroups).each(function(key, value){
    //                             tests += `<option value="`+value.id+`" >`+value.type+`</option>`;
    //                         });
    //                     }

    //                     // $('#test-group').prop('disabled',false);
    //                     $('#test-group').html(tests);

    //                     // $('#interview-group').prop('disabled',false);
    //                     $('#interview-group').html(interviews);
    //                 }
    //             }
    //         });
    //     }
    // });

    $(document).on('change', "#test-group-chkbox", function () {

        $("#btn-add-test").parent('div').remove();
        $("#test-group-details").remove();

        if ($('#test-group-chkbox').is(':checked')) {

            var session_id = $("#session-id").val();

            if (session_id == "" || session_id == "0") {
                $("#session-id").find(".select2-selection--single").addClass("has-error");
                $("#session-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
                $("#test-group-id").siblings("span").after("<span class='error text-danger'>Please select session first.</span>");
                flag = false;
            } else {

                $("#test-group-id").prop('disabled', false);

                $("#test-group-row").children('div').after(`<div class="form-group col-md-2 mb-0">
                    <img src="`+ baseUrl + `/backend/assets/img/add-icon.png" class="btn-add-img" alt="Add Test" id="btn-add-test">
                </div>`);

                $.ajax({
                    url: baseUrl + '/get/test-group',
                    type: "GET",
                    data: { session_id: session_id },
                    success: function (response) {
                        if (response.status === true) {
                            var testGroupRecord = response.testGroup

                            var testGroup = `<option selected value="">Select </option>`;
                            if (testGroupRecord.length) {
                                $(testGroupRecord).each(function (key, value) {
                                    testGroup += `<option value="` + value.id + `" >` + value.name + `</option>`;
                                });
                            }

                            $('#test-group-id').prop('disabled', false);
                            $('#test-group-id').html(testGroup);

                        }
                    }
                });
            }


        } else {
            $("#test-group-id").val('0').change();
            $("#test-group-id").prop('disabled', true);

            $('#test-group-id').siblings("span.error").remove();
            $('#test-group-id').siblings("span").find(".select2-selection--single").removeClass("has-error");
            $('#session-id').siblings("span.error").remove();
        }
    });

    $(document).on('change', "#interview-group-chkbox", function () {

        $("#btn-add-interview").parent('div').remove();
        $("#interview-group-details").remove();

        if ($('#interview-group-chkbox').is(':checked')) {


            var session_id = $("#session-id").val();

            if (session_id == "" || session_id == "0") {
                $("#session-id").find(".select2-selection--single").addClass("has-error");
                $("#session-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
                $("#interview-group-id").siblings("span").after("<span class='error text-danger'>Please select session first.</span>");
                flag = false;
            } else {

                $("#interview-group-id").prop('disabled', false);
                $("#interview-group-row").children('div').after(`<div class="form-group col-md-2 mb-0">
                                                            <img src="`+ baseUrl + `/backend/assets/img/add-icon.png" class="btn-add-img" alt="Add interview" id="btn-add-interview">
                                                        </div>`);
                $.ajax({
                    url: baseUrl + '/get/interview-group',
                    type: "GET",
                    data: { session_id: session_id },
                    success: function (response) {

                        if (response.status === true) {
                            var interviewGroupRecord = response.interviewGroup
                            var interviewGroup = `<option selected value="">Select </option>`;
                            if (interviewGroupRecord.length) {
                                $(interviewGroupRecord).each(function (key, value) {
                                    interviewGroup += `<option value="` + value.id + `" >` + value.name + `</option>`;
                                });
                            }

                            $('#interview-group-id').prop('disabled', false);
                            $('#interview-group-id').html(interviewGroup);

                        }
                    }
                });
            }

        } else {
            $("#interview-group-id").val('0').change();
            $("#interview-group-id").prop('disabled', true);

            $('#interview-group-id').siblings("span.error").remove();
            $('#session-id').siblings("span.error").remove();
            $('#interview-group-id').siblings("span").find(".select2-selection--single").removeClass("has-error");
        }
    });

    $('.date-picker').datepicker({
        dateFormat: 'dd-mm-yy',
        showOtherMonths: true,
        selectOtherMonths: true
    });

    // $('.date-time-picker').datetimepicker({
    // 	format: "dd-mm-yyyy HH:ii P",
    //     timepicker:true,
    // 	autoclose : true
    // });

});