$(document).ready(function () {

    var baseUrl = $(".base-url").val();

    $("#btn-add-admission").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");
        var flag = true;

        //Student Table Data
        var temporary_gr = $("#temporary-gr").val();
        var gr = $("#gr").val();
        var roll_no = $("#roll-no").val();
        var session_id = $("#session-id").val();
        var campus_id = $("#campus-id").val();
        var system_id = $("#system-id").val();
        var class_id = $("#class-id").val();
        var group_id = $("#group-id").val();
        var section_id = $("#section-id").val();
        var bform_crms_no = $("#bform-crms-no").val();
        var first_name = $("#first-name").val();
        var last_name = $("#last-name").val();
        var dob = $("#dob").val();
        var gender = $("#gender").val();
        var place_of_birth = $("#place-of-birth").val();
        var nationality = $("#nationality").val();
        var mother_tongue = $("#mother-tongue").val();
        var previous_class_id = $("#previous-class-id").val();
        var previous_school = $("#previous-school").val();
        var mobile_no = $("#mobile-no").val();
        var email = $("#email").val();
        var admission_date = $("#admission-date").val();
        var blood_group = $("#blood-group").val();
        var height = $("#height").val();
        var weight = $("#weight").val();
        var as_on_date = $("#as-on-date").val();
        var fee_discount = $("#fee-discount").val();

        var religion = $("#religion").val();
        var religion_type = $("#religion-type").val();
        var religion_type_other = $("#religion-type-other").val();

        var siblings_in_mpa = $("#siblings-in-mpa").val();
        var no_of_siblings = $("#no-of-siblings").val();

        var student_vaccinated = $("input[name='student_vaccinated']:checked").val();

        //Student Father Table Data
        var father_cnic = $("#father-cnic").val();
        var father_salary = $("#father-salary").val();
        var father_email = $("#father-email").val();
        var father_name = $("#father-name").val();
        var father_phone = $("#father-phone").val();
        var father_occupation = $("#father-occupation").val();
        var father_company_name = $("#father-company-name").val();
        var father_vaccinated = $("input[name='father_vaccinated']:checked").val();

        //Student Mother Table Data
        var mother_cnic = $("#mother-cnic").val();
        var mother_salary = $("#mother-salary").val();
        var mother_email = $("#mother-email").val();
        var mother_name = $("#mother-name").val();
        var mother_phone = $("#mother-phone").val();
        var mother_occupation = $("#mother-occupation").val();
        var mother_company_name = $("#mother-company-name").val();
        var mother_vaccinated = $("input[name='mother_vaccinated']:checked").val();

        //Student Guardian Table Data
        var guardian_cnic = $("#guardian-cnic").val();
        var guardian_name = $("#guardian-name").val();
        var guardian_phone = $("#guardian-phone").val();
        var guardian_relation = $("#guardian-relation").val();
        var guardian_relation_other = $("#guardian-relation-other").val();
        var first_person_call = $("#first-person-call").val();

        //Student Address Table Data
        var current_house_no = $("#current-house-no").val();
        var current_block_no = $("#current-block-no").val();
        var current_building_name_no = $("#current-building-name-no").val();
        var current_area_id = $("#current-area-id").val();
        var current_city_id = $("#current-city-id").val();

        var same_as_current = $("input[name='same_as_current']:checked").val();

        var permanent_house_no = $("#permanent-house-no").val();
        var permanent_block_no = $("#permanent-block-no").val();
        var permanent_building_name_no = $("#permanent-building-name-no").val();
        var permanent_area_id = $("#permanent-area-id").val();
        var permanent_city_id = $("#permanent-city-id").val();

        //Student Pick And Drop Table Data
        var pick_and_drop = $("#pick-and-drop").val();

        // var school_driver_name          =  $("#school-driver-name").val();
        // var school_driver_phone         =  $("#school-driver-phone").val();
        // var school_vehicle_no           =  $("#school-vehicle-no").val();

        // var private_driver_name         =  $("#private-driver-name").val();
        // var private_driver_phone        =  $("#private-driver-phone").val();
        // var private_vehicle_no          =  $("#private-vehicle-no").val();

        if (temporary_gr == "") {
            $("#temporary-gr").addClass("has-error");
            $("#temporary-gr").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (gr == "") {
            $("#gr").addClass("has-error");
            $("#gr").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (session_id == "") {
            $("#session-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#session-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (campus_id == "") {
            $("#campus-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#campus-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (system_id == "") {
            $("#system-id:not([disabled]").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#system-id:not([disabled]").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (class_id == "") {
            $("#class-id:not([disabled]").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#class-id:not([disabled]").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        // if (class_group_id == "" || class_group_id == "0") {
        // if ($("#group-id:not([disabled])")) {
        if ($("#group-id").prop('disabled') == false) {
            if (group_id == "") {
                $("#group-id").siblings("span").find(".select2-selection--single").addClass("has-error");
                $("#group-id").siblings("span").after("<span class='error'>This field is required.</span>");
                flag = false;
            }

        }
        if (section_id == "") {
            $("#section-id:not([disabled]").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#section-id:not([disabled]").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (first_name == "") {
            $("#first-name").addClass("has-error");
            $("#first-name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (last_name == "") {
            $("#last-name").addClass("has-error");
            $("#last-name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        // if (roll_no == "") {
        //     $("#roll-no").addClass("has-error");
        //     $("#roll-no").after("<span class='error'>This field is required.</span>");
        //     flag = false;
        // }

        if (gender == "") {
            $("#gender").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#gender").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (place_of_birth == "") {
            $("#place-of-birth").addClass("has-error");
            $("#place-of-birth").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (nationality == "") {
            $("#nationality").addClass("has-error");
            $("#nationality").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (mother_tongue == "") {
            $("#mother-tongue").addClass("has-error");
            $("#mother-tongue").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (previous_class_id !== "" && previous_class_id !== "0") {

            if (previous_school == "") {
                $("#previous-school").addClass("has-error");
                $("#previous-school").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }

        if (admission_date == "") {
            $("#admission-date").addClass("has-error");
            $("#admission-date").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (religion == "") {
            $("#religion").addClass("has-error");
            $("#religion").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (religion_type == "") {
            $("#religion-type").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#religion-type").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;

        } else if (religion_type == "other") {
            if (religion_type_other == "") {
                $("#religion-type-other").addClass("has-error");
                $("#religion-type-other").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }

        if (siblings_in_mpa == "yes") {
            if (no_of_siblings == "") {
                $("#no-of-siblings").addClass("has-error");
                $("#no-of-siblings").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }

        if (father_cnic == "") {
            $("#father-cnic").addClass("has-error");
            $("#father-cnic").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (father_name == "") {
            $("#father-name").addClass("has-error");
            $("#father-name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (father_phone == "") {
            $("#father-phone").addClass("has-error");
            $("#father-phone").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (mother_cnic == "") {
            $("#mother-cnic").addClass("has-error");
            $("#mother-cnic").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (mother_name == "") {
            $("#mother-name").addClass("has-error");
            $("#mother-name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (mother_phone == "") {
            $("#mother-phone").addClass("has-error");
            $("#mother-phone").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (guardian_relation == "other") {
            if (guardian_relation_other == "") {
                $("#guardian-relation-other").addClass("has-error");
                $("#guardian-relation-other").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }
        if (first_person_call == "") {
            $("#first-person-call").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#first-person-call").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (current_house_no == "") {
            $("#current-house-no").addClass("has-error");
            $("#current-house-no").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (current_block_no == "") {
            $("#current-block-no").addClass("has-error");
            $("#current-block-no").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        // if (current_building_name_no == "") {
        //     $("#current-building-name-no").addClass("has-error");
        //     $("#current-building-name-no").after("<span class='error'>This field is required.</span>");
        //     flag = false;
        // }
        if (current_area_id == "") {
            $("#current-area-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#current-area-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (current_city_id == "") {
            $("#current-city-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#current-city-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if ($('#same-as-current').is(':checked') == false) {
            if (permanent_house_no == "") {
                $("#permanent-house-no").addClass("has-error");
                $("#permanent-house-no").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
            if (permanent_block_no == "") {
                $("#permanent-block-no").addClass("has-error");
                $("#permanent-block-no").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
            if (permanent_area_id == "") {
                $("#permanent-area-id").siblings("span").find(".select2-selection--single").addClass("has-error");
                $("#permanent-area-id").siblings("span").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
            if (permanent_city_id == "") {
                $("#permanent-city-id").siblings("span").find(".select2-selection--single").addClass("has-error");
                $("#permanent-city-id").siblings("span").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }
        if (pick_and_drop == "") {

            $("#pick-and-drop").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#pick-and-drop").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;

        } else {



            if (pick_and_drop == 'by_ride') {

                var vehicle_no = $("#vehicle-no").val();

                if (vehicle_no == '') {
                    $("#vehicle-no").addClass("has-error");
                    $("#vehicle-no").after("<span class='error'>This field is required.</span>");
                    flag = false;
                }

            }

            if (pick_and_drop == 'by_school_van' || pick_and_drop == 'by_private_van') {

                var vehicle_id = $("#vehicle-id").val();

                if (vehicle_id == '' || vehicle_id == '0') {
                    $("#vehicle-id").siblings("span").find(".select2-selection--single").addClass("has-error");
                    $("#vehicle-id").siblings("span").after("<span class='error'>This field is required.</span>");
                    flag = false;
                }

            }
        }

        if (flag) {

            $("#btn-add-admission").addClass('disabled');
            $("#btn-add-admission").html('. . . . .');

            var message = '';

            var formData = {

                "temporary_gr": temporary_gr,
                "gr": gr,
                "roll_no": roll_no,
                "session_id": session_id,
                "campus_id": campus_id,
                "system_id": system_id,
                "class_id": class_id,
                "group_id": group_id,
                "section_id": section_id,
                "bform_crms_no": bform_crms_no,
                "first_name": first_name,
                "last_name": last_name,
                "dob": dob,
                "gender": gender,
                "place_of_birth": place_of_birth,
                "nationality": nationality,
                "mother_tongue": mother_tongue,
                "previous_class_id": previous_class_id,
                "previous_school": previous_school,
                "mobile_no": mobile_no,
                "email": email,
                "admission_date": admission_date,
                "blood_group": blood_group,
                "height": height,
                "weight": weight,
                "as_on_date": as_on_date,
                "fee_discount": fee_discount,
                "religion": religion,
                "religion_type": religion_type,
                "religion_type_other": religion_type_other,
                "siblings_in_mpa": siblings_in_mpa,
                "no_of_siblings": no_of_siblings,
                "student_vaccinated": student_vaccinated,

                "father_cnic": father_cnic.replace(new RegExp('-', 'g'), ""),
                "father_salary": father_salary,
                "father_email": father_email,
                "father_name": father_name,
                "father_phone": father_phone.replace("-", ""),
                "father_occupation": father_occupation,
                "father_company_name": father_company_name,
                "father_vaccinated": father_vaccinated,

                "mother_cnic": mother_cnic.replace(new RegExp('-', 'g'), ""),
                "mother_salary": mother_salary,
                "mother_email": mother_email,
                "mother_name": mother_name,
                "mother_phone": mother_phone.replace("-", ""),
                "mother_occupation": mother_occupation,
                "mother_company_name": mother_company_name,
                "mother_vaccinated": mother_vaccinated,

                "guardian_cnic": guardian_cnic.replace(new RegExp('-', 'g'), ""),
                "guardian_name": guardian_name,
                "guardian_phone": guardian_phone.replace("-", ""),
                "guardian_relation": guardian_relation,
                "guardian_relation_other": guardian_relation_other,
                "first_person_call": first_person_call,

                "current_house_no": current_house_no,
                "current_block_no": current_block_no,
                "current_building_name_no": current_building_name_no,
                "current_area_id": current_area_id,
                "current_city_id": current_city_id,

                "same_as_current": same_as_current,

                "permanent_house_no": permanent_house_no,
                "permanent_block_no": permanent_block_no,
                "permanent_building_name_no": permanent_building_name_no,
                "permanent_area_id": permanent_area_id,
                "permanent_city_id": permanent_city_id,

                "pick_and_drop": pick_and_drop,
                // "vehicle_no"                  :  vehicle_no,
                // "driver_name"                 :  driver_name,
                // "driver_phone"                :  driver_phone

            };

            // if($('#same-as-current').is(':checked') == true){

            // }

            if (pick_and_drop == 'by_ride') {

                formData.vehicle_no = vehicle_no;
            }

            if (pick_and_drop == 'by_school_van' || pick_and_drop == 'by_private_van') {

                formData.vehicle_id = vehicle_id;

            }

            $.ajax({
                url: baseUrl + '/admission/store',
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                dataType: "json",
                success: function (response) {

                    if (response.status === false) {

                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                $.each(response.error, function (key, value) {

                                    if (key === 'admission_date') {
                                        $("input[name='" + key + "']").addClass("has-error");
                                        $("input[name='" + key + "']").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                    } else {
                                        console.log(key + " - " + value);
                                        $("input[name='" + key + "']").addClass("has-error");
                                        $("input[name='" + key + "']").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");

                                        // $("select[name='" + key + "']").siblings("span").find(".select2-selection--single").addClass("has-error");
                                        // $("select[name='" + key + "']").siblings("span").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                    }

                                });
                            }
                        } else {
                            message += `<div class="alert alert-success alert-dismissible">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <strong> Error!</strong> `+ response.message + `
                                        </div>`;
                        }
                    } else {

                        $("#session-id, #class-id, #section-id, #category-id, #campus-id, #gender, #blood-group, #school-house-id, #current-area-id, #permanent-area-id, #pick-and-drop, #siblings-in-mpa, #religion-type, #guardian-relation, #first-person-call").val('').change();

                        $("#gr, #roll-no, #temporary-gr, #system, #bform-crms-no, #first-name, #last-name, #dob, #place-of-birth, #nationality, #mother-tongue, #previous-class, #previous-school, #religion, #mobile-no, #email, #admission-date, #height, #weight, #as-on-date, #fee-discount, #student-vaccinated, #father-cnic, #father-salary, #father-email, #father-name, #father-phone, #father-occupation, #father-company-name, #father-vaccinated, #mother-cnic, #mother-salary, #mother-email, #mother-name, #mother-phone, #mother-occupation, #mother-company-name, #mother-vaccinated, #guardian-cnic, #guardian-first-name, #guardian-phone, #guardian-relation, #first-person-call, #current-house-no, #current-block-no, #current-building-name-no, #current-city, #permanent-house-no, #permanent-block-no, #permanent-building-name-no, #permanent-city, #ride-vehicle-no, #school-driver-name, #school-driver-phone, #school-vehicle-no, #private-driver-name, #private-driver-phone, #private-vehicle-no,#other-relation, #other-religion, #no-of-siblings").val('');

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
                    var html = '';

                    if (message !== '') {
                        $("#after-form-store-msg").prepend(message);
                        setTimeout(function () {
                            $(".alert").remove();
                        }, 4000);
                    }

                    $('#pick-drop-append-input').html(html);

                    $("#btn-add-admission").removeClass('disabled');
                    $("#btn-add-admission").html('Submit');
                }
            });
        }
    });

    $("#btn-edit-admission").on("click", function (e) {

        e.preventDefault();
        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");
        var flag = true;

        //Student Table Data
        var id = $("#id").val();
        var temporary_gr = $("#temporary-gr").val();
        var gr = $("#gr").val();
        var roll_no = $("#roll-no").val();
        var session_id = $("#session-id").val();
        var campus_id = $("#campus-id").val();
        var system_id = $("#system-id").val();
        var class_id = $("#class-id").val();
        var group_id = $("#group-id").val();
        var section_id = $("#section-id").val();
        var bform_crms_no = $("#bform-crms-no").val();
        var first_name = $("#first-name").val();
        var last_name = $("#last-name").val();
        var dob = $("#dob").val();
        var gender = $("#gender").val();
        var place_of_birth = $("#place-of-birth").val();
        var nationality = $("#nationality").val();
        var mother_tongue = $("#mother-tongue").val();
        var previous_class_id = $("#previous-class-id").val();
        var previous_school = $("#previous-school").val();
        var mobile_no = $("#mobile-no").val();
        var email = $("#email").val();
        var admission_date = $("#admission-date").val();
        var blood_group = $("#blood-group").val();
        var height = $("#height").val();
        var weight = $("#weight").val();
        var as_on_date = $("#as-on-date").val();
        var fee_discount = $("#fee-discount").val();

        var religion = $("#religion").val();
        var religion_type = $("#religion-type").val();
        var religion_type_other = $("#religion-type-other").val();

        var siblings_in_mpa = $("#siblings-in-mpa").val();
        var no_of_siblings = $("#no-of-siblings").val();

        var student_vaccinated = $("input[name='student_vaccinated']:checked").val();

        //Student Father Table Data
        var father_cnic = $("#father-cnic").val();
        var father_salary = $("#father-salary").val();
        var father_email = $("#father-email").val();
        var father_name = $("#father-name").val();
        var father_phone = $("#father-phone").val();
        var father_occupation = $("#father-occupation").val();
        var father_company_name = $("#father-company-name").val();
        var father_vaccinated = $("input[name='father_vaccinated']:checked").val();

        //Student Mother Table Data
        var mother_cnic = $("#mother-cnic").val();
        var mother_salary = $("#mother-salary").val();
        var mother_email = $("#mother-email").val();
        var mother_name = $("#mother-name").val();
        var mother_phone = $("#mother-phone").val();
        var mother_occupation = $("#mother-occupation").val();
        var mother_company_name = $("#mother-company-name").val();
        var mother_vaccinated = $("input[name='mother_vaccinated']:checked").val();

        //Student Guardian Table Data
        var guardian_cnic = $("#guardian-cnic").val();
        var guardian_name = $("#guardian-name").val();
        var guardian_phone = $("#guardian-phone").val();
        var guardian_relation = $("#guardian-relation").val();
        var guardian_relation_other = $("#guardian-relation-other").val();
        var first_person_call = $("#first-person-call").val();

        //Student Address Table Data
        var current_house_no = $("#current-house-no").val();
        var current_block_no = $("#current-block-no").val();
        var current_building_name_no = $("#current-building-name-no").val();
        var current_area_id = $("#current-area-id").val();
        var current_city_id = $("#current-city-id").val();

        var same_as_current = $("input[name='same_as_current']:checked").val();

        var permanent_house_no = $("#permanent-house-no").val();
        var permanent_block_no = $("#permanent-block-no").val();
        var permanent_building_name_no = $("#permanent-building-name-no").val();
        var permanent_area_id = $("#permanent-area-id").val();
        var permanent_city_id = $("#permanent-city-id").val();

        //Student Pick And Drop Table Data
        var pick_and_drop = $("#pick-and-drop").val();


        if (id == "") {
            $("#temporary-gr").after("<span class='error'>Record id is required.</span>");
            flag = false;
        }

        if (temporary_gr == "") {
            $("#temporary-gr").addClass("has-error");
            $("#temporary-gr").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (gr == "") {
            $("#gr").addClass("has-error");
            $("#gr").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (session_id == "") {
            $("#session-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#session-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (campus_id == "") {
            $("#campus-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#campus-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (system_id == "") {
            $("#system-id:not([disabled]").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#system-id:not([disabled]").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (class_id == "") {
            $("#class-id:not([disabled]").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#class-id:not([disabled]").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        // if ($("#group-id:not([disabled])")) {
        if ($("#group-id").prop('disabled') == false) {
            if (group_id == "") {
                $("#group-id").siblings("span").find(".select2-selection--single").addClass("has-error");
                $("#group-id").siblings("span").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }
        if (section_id == "") {
            $("#section-id:not([disabled]").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#section-id:not([disabled]").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (first_name == "") {
            $("#first-name").addClass("has-error");
            $("#first-name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (last_name == "") {
            $("#last-name").addClass("has-error");
            $("#last-name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (gender == "") {
            $("#gender").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#gender").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (place_of_birth == "") {
            $("#place-of-birth").addClass("has-error");
            $("#place-of-birth").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (nationality == "") {
            $("#nationality").addClass("has-error");
            $("#nationality").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (mother_tongue == "") {
            $("#mother-tongue").addClass("has-error");
            $("#mother-tongue").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (previous_class_id !== "" && previous_class_id !== "0") {

            if (previous_school == "") {
                $("#previous-school").addClass("has-error");
                $("#previous-school").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }

        if (admission_date == "") {
            $("#admission-date").addClass("has-error");
            $("#admission-date").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (religion == "") {
            $("#religion").addClass("has-error");
            $("#religion").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (religion_type == "") {
            $("#religion-type").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#religion-type").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;

        } else if (religion_type == "other") {
            if (religion_type_other == "") {
                $("#religion-type-other").addClass("has-error");
                $("#religion-type-other").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }

        if (siblings_in_mpa == "yes") {
            if (no_of_siblings == "") {
                $("#no-of-siblings").addClass("has-error");
                $("#no-of-siblings").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }

        if (father_cnic == "") {
            $("#father-cnic").addClass("has-error");
            $("#father-cnic").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (father_name == "") {
            $("#father-name").addClass("has-error");
            $("#father-name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (father_phone == "") {
            $("#father-phone").addClass("has-error");
            $("#father-phone").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (mother_cnic == "") {
            $("#mother-cnic").addClass("has-error");
            $("#mother-cnic").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (mother_name == "") {
            $("#mother-name").addClass("has-error");
            $("#mother-name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (mother_phone == "") {
            $("#mother-phone").addClass("has-error");
            $("#mother-phone").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (guardian_relation == "other") {
            if (guardian_relation_other == "") {
                $("#guardian-relation-other").addClass("has-error");
                $("#guardian-relation-other").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }
        if (first_person_call == "") {
            $("#first-person-call").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#first-person-call").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (current_house_no == "") {
            $("#current-house-no").addClass("has-error");
            $("#current-house-no").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (current_block_no == "") {
            $("#current-block-no").addClass("has-error");
            $("#current-block-no").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (current_area_id == "") {
            $("#current-area-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#current-area-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (current_city_id == "") {
            $("#current-city-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#current-city-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if ($('#same-as-current').is(':checked') == false) {
            if (permanent_house_no == "") {
                $("#permanent-house-no").addClass("has-error");
                $("#permanent-house-no").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
            if (permanent_block_no == "") {
                $("#permanent-block-no").addClass("has-error");
                $("#permanent-block-no").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
            if (permanent_area_id == "") {
                $("#permanent-area-id").siblings("span").find(".select2-selection--single").addClass("has-error");
                $("#permanent-area-id").siblings("span").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
            if (permanent_city_id == "") {
                $("#permanent-city-id").siblings("span").find(".select2-selection--single").addClass("has-error");
                $("#permanent-city-id").siblings("span").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }
        if (pick_and_drop == "") {

            $("#pick-and-drop").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#pick-and-drop").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;

        } else {



            if (pick_and_drop == 'by_ride') {

                var vehicle_no = $("#vehicle-no").val();

                if (vehicle_no == '') {
                    $("#vehicle-no").addClass("has-error");
                    $("#vehicle-no").after("<span class='error'>This field is required.</span>");
                    flag = false;
                }

            }

            if (pick_and_drop == 'by_school_van' || pick_and_drop == 'by_private_van') {

                var vehicle_id = $("#vehicle-id").val();

                if (vehicle_id == '' || vehicle_id == '0') {
                    $("#vehicle-id").siblings("span").find(".select2-selection--single").addClass("has-error");
                    $("#vehicle-id").siblings("span").after("<span class='error'>This field is required.</span>");
                    flag = false;
                }

            }
        }

        if (flag) {

            $("#btn-edit-admission").addClass('disabled');
            $("#btn-edit-admission").html('. . . . .');

            var message = '';

            var formData = {

                "id": id,
                "temporary_gr": temporary_gr,
                "gr": gr,
                "roll_no": roll_no,
                "session_id": session_id,
                "campus_id": campus_id,
                "system_id": system_id,
                "class_id": class_id,
                "group_id": group_id,
                "section_id": section_id,
                "bform_crms_no": bform_crms_no,
                "first_name": first_name,
                "last_name": last_name,
                "dob": dob,
                "gender": gender,
                "place_of_birth": place_of_birth,
                "nationality": nationality,
                "mother_tongue": mother_tongue,
                "previous_class_id": previous_class_id,
                "previous_school": previous_school,
                "mobile_no": mobile_no,
                "email": email,
                "admission_date": admission_date,
                "blood_group": blood_group,
                "height": height,
                "weight": weight,
                "as_on_date": as_on_date,
                "fee_discount": fee_discount,
                "religion": religion,
                "religion_type": religion_type,
                "religion_type_other": religion_type_other,
                "siblings_in_mpa": siblings_in_mpa,
                "no_of_siblings": no_of_siblings,
                "student_vaccinated": student_vaccinated,

                "father_cnic": father_cnic.replace(new RegExp('-', 'g'), ""),
                "father_salary": father_salary,
                "father_email": father_email,
                "father_name": father_name,
                "father_phone": father_phone.replace("-", ""),
                "father_occupation": father_occupation,
                "father_company_name": father_company_name,
                "father_vaccinated": father_vaccinated,

                "mother_cnic": mother_cnic.replace(new RegExp('-', 'g'), ""),
                "mother_salary": mother_salary,
                "mother_email": mother_email,
                "mother_name": mother_name,
                "mother_phone": mother_phone.replace("-", ""),
                "mother_occupation": mother_occupation,
                "mother_company_name": mother_company_name,
                "mother_vaccinated": mother_vaccinated,

                "guardian_cnic": guardian_cnic.replace(new RegExp('-', 'g'), ""),
                "guardian_name": guardian_name,
                "guardian_phone": guardian_phone.replace("-", ""),
                "guardian_relation": guardian_relation,
                "guardian_relation_other": guardian_relation_other,
                "first_person_call": first_person_call,

                "current_house_no": current_house_no,
                "current_block_no": current_block_no,
                "current_building_name_no": current_building_name_no,
                "current_area_id": current_area_id,
                "current_city_id": current_city_id,

                "same_as_current": same_as_current,

                "permanent_house_no": permanent_house_no,
                "permanent_block_no": permanent_block_no,
                "permanent_building_name_no": permanent_building_name_no,
                "permanent_area_id": permanent_area_id,
                "permanent_city_id": permanent_city_id,

                "pick_and_drop": pick_and_drop,

            };

            if (pick_and_drop == 'by_ride') {

                formData.vehicle_no = vehicle_no;
            }

            if (pick_and_drop == 'by_school_van' || pick_and_drop == 'by_private_van') {

                formData.vehicle_id = vehicle_id;

            }

            $.ajax({
                url: baseUrl + '/admission/update',
                type: "PUT",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                dataType: "json",
                success: function (response) {

                    if (response.status === false) {

                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                $.each(response.error, function (key, value) {

                                    if (key === 'admission_date') {
                                        $("input[name='" + key + "']").addClass("has-error");
                                        $("input[name='" + key + "']").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                    } else {
                                        console.log(key + " - " + value);
                                        $("input[name='" + key + "']").addClass("has-error");
                                        $("input[name='" + key + "']").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");

                                        // $("select[name='" + key + "']").siblings("span").find(".select2-selection--single").addClass("has-error");
                                        // $("select[name='" + key + "']").siblings("span").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                    }

                                });
                            }
                        } else {
                            message += `<div class="alert alert-success alert-dismissible">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <strong> Error!</strong> `+ response.message + `
                                        </div>`;
                        }
                    } else {

                        $("#session-id, #class-id, #section-id, #category-id, #campus-id, #gender, #blood-group, #school-house-id, #current-area-id, #permanent-area-id, #pick-and-drop, #siblings-in-mpa, #religion-type, #guardian-relation, #first-person-call").val('').change();

                        $("#gr, #roll-no, #temporary-gr, #system, #bform-crms-no, #first-name, #last-name, #dob, #place-of-birth, #nationality, #mother-tongue, #previous-class, #previous-school, #religion, #mobile-no, #email, #admission-date, #height, #weight, #as-on-date, #fee-discount, #student-vaccinated, #father-cnic, #father-salary, #father-email, #father-name, #father-phone, #father-occupation, #father-company-name, #father-vaccinated, #mother-cnic, #mother-salary, #mother-email, #mother-name, #mother-phone, #mother-occupation, #mother-company-name, #mother-vaccinated, #guardian-cnic, #guardian-first-name, #guardian-phone, #guardian-relation, #first-person-call, #current-house-no, #current-block-no, #current-building-name-no, #current-city, #permanent-house-no, #permanent-block-no, #permanent-building-name-no, #permanent-city, #ride-vehicle-no, #school-driver-name, #school-driver-phone, #school-vehicle-no, #private-driver-name, #private-driver-phone, #private-vehicle-no,#other-relation, #other-religion, #no-of-siblings").val('');

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
                    var html = '';

                    if (message !== '') {
                        $("#after-form-store-msg").prepend(message);
                        setTimeout(function () {
                            $(".alert").remove();
                        }, 4000);
                    }

                    $('#pick-drop-append-input').html(html);

                    $("#btn-edit-admission").removeClass('disabled');
                    $("#btn-edit-admission").html('Submit');
                }
            });
        }
    });

    $(document).on('change', '#pick-and-drop', function (e) {

        e.preventDefault();
        $("#pick-drop-details-row").remove();
        var pick_and_drop = $('#pick-and-drop').val();

        if (pick_and_drop == 'by_ride') {

            var html = `<div class="form-row" id="pick-drop-details-row">
                            <div class="form-group col-md-12 mb-0">
                                <label class="form-label tx-semibold">Vehicle No</label>
                                <input type="text" class="form-control" name="vehicle_no" id="vehicle-no">
                            </div>
                        </div>`;
            $(this).parent().parent().after(html);
        }

        if (pick_and_drop == 'by_school_van' || pick_and_drop == 'by_private_van') {

            $.ajax({
                url: baseUrl + '/vehicle/listing-by-type',
                type: "GET",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { pick_and_drop: pick_and_drop },
                dataType: "json",
                success: function (response) {
                    console.log(response.status);
                    if (response.status === false) {
                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                console.log();
                                $("select[name='pick_and_drop']").siblings("span").find(".select2-selection--single").addClass("has-error");
                                $("select[name='pick_and_drop']").siblings("span").after("<span class='error'>" + response.error.pick_and_drop + "</span>");
                            }
                        }
                    } else {

                        var html = `<div class="form-row" id="pick-drop-details-row">
                                        <div class="form-group col-md-12 mb-0">
                                            <div class="form-group">
                                                <label class="form-label tx-semibold">Select Vehicle</label>
                                                <div class="pos-relative">
                                                    <select class="form-control select2" name="vehicle_id" id="vehicle-id">
                                                        <option value="">Select Vehicle</option>`;
                        console.log(response.vehicles);
                        $.each(response.vehicles, function (key, value) {
                            html += `<option value="` + value.id + `">` + value.number + ` [ ` + value.maker + ` ] </option>`;
                        });

                        html += `                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;

                        $('#pick-and-drop').parent().parent().after(html);
                        $("#vehicle-id").select2();
                    }
                }
            });
        }

    });

    // Start data update script
    $("#btn-update-admission").on("click", function (e) {
        e.preventDefault();

        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");
        var flag = true;

        //Student Table Data
        var student_id = $(this).data('id');
        var gr = $("#gr").val();
        var bform_crms_no = $("#bform-crms-no").val();
        var dob = $("#dob").val();
        var gender = $("#gender").val();
        var place_of_birth = $("#place-of-birth").val();
        var nationality = $("#nationality").val();
        var mother_tongue = $("#mother-tongue").val();
        var first_name = $("#first-name").val();
        var last_name = $("#last-name").val();
        var religion = $("#religion").val();
        var admission_date = $("#admission-date").val();
        var previous_class = $("#previous-class").val();
        var previous_school = $("#previous-school").val();
        var blood_group = $("#blood-group").val();
        var height = $("#height").val();
        var weight = $("#weight").val();
        var student_vaccinated = $("input[name='student_vaccinated']:checked").val();
        var as_on_date = $("#as-on-date").val();
        var fee_discount = $("#fee-discount").val();
        var system = $("#system").val();
        var roll_no = $("#roll-no").val();
        var temporary_gr = $("#temporary-gr").val();
        var mobile_no = $("#mobile-no").val();
        var email = $("#email").val();

        //Student Religion Type Table Data
        var religion_type = $("#religion-type").val();
        var other_religion = $("#other-religion").val();

        //Student Sibling Table Data
        var siblings_in_mpa = $("#siblings-in-mpa").val();
        var no_of_siblings = $("#no-of-siblings").val();

        //Student Father Table Data
        var father_name = $("#father-name").val();
        var father_cnic = $("#father-cnic").val();
        var father_phone = $("#father-phone").val();
        var father_email = $("#father-email").val();
        var father_occupation = $("#father-occupation").val();
        var father_company_name = $("#father-company-name").val();
        var father_salary = $("#father-salary").val();
        var father_vaccinated = $("input[name='father_vaccinated']:checked").val();

        //Student Mother Table Data
        var mother_name = $("#mother-name").val();
        var mother_cnic = $("#mother-cnic").val();
        var mother_phone = $("#mother-phone").val();
        var mother_email = $("#mother-email").val();
        var mother_occupation = $("#mother-occupation").val();
        var mother_company_name = $("#mother-company-name").val();
        var mother_salary = $("#mother-salary").val();
        var mother_vaccinated = $("input[name='mother_vaccinated']:checked").val();

        //Student Guardian Table Data
        var guardian_first_name = $("#guardian-first-name").val();
        var guardian_phone = $("#guardian-phone").val();
        var guardian_relation = $("#guardian-relation").val();
        var other_relation = $("#other-relation").val();
        var first_person_call = $("#first-person-call").val();
        var guardian_cnic = $("#guardian-cnic").val();

        //Student Address Table Data
        var current_house_no = $("#current-house-no").val();
        var current_block_no = $("#current-block-no").val();
        var current_building_name_no = $("#current-building-name-no").val();
        var current_city = $("#current-city").val();
        var current_area_id = $("#current-area-id").val();

        var same_as_current = $("input[name='same_as_current']:checked").val();

        var permanent_house_no = $("#permanent-house-no").val();
        var permanent_block_no = $("#permanent-block-no").val();
        var permanent_building_name_no = $("#permanent-building-name-no").val();
        var permanent_city = $("#permanent-city").val();
        var permanent_area_id = $("#permanent-area-id").val();

        //Student Pick And Drop Table Data
        var pick_and_drop = $("#pick-and-drop").val();
        var ride_vehicle_no = $("#ride-vehicle-no").val();

        var school_driver_name = $("#school-driver-name").val();
        var school_driver_phone = $("#school-driver-phone").val();
        var school_vehicle_no = $("#school-vehicle-no").val();

        var private_driver_name = $("#private-driver-name").val();
        var private_driver_phone = $("#private-driver-phone").val();
        var private_vehicle_no = $("#private-vehicle-no").val();

        //Student Detail Table Data
        var campus_id = $("#campus-id").val();
        var session_id = $("#session-id").val();
        var class_id = $("#class-id").val();
        var section_id = $("#section-id").val();
        var category_id = $("#category-id").val();
        var school_house_id = $("#school-house-id").val();

        if (gr == "") {
            $("#gr").addClass("has-error");
            $("#gr").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (gender == "") {
            $("#gender").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#gender").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (place_of_birth == "") {
            $("#place-of-birth").addClass("has-error");
            $("#place-of-birth").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (nationality == "") {
            $("#nationality").addClass("has-error");
            $("#nationality").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (mother_tongue == "") {
            $("#mother-tongue").addClass("has-error");
            $("#mother-tongue").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (first_name == "") {
            $("#first-name").addClass("has-error");
            $("#first-name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (last_name == "") {
            $("#last-name").addClass("has-error");
            $("#last-name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (religion == "") {
            $("#religion").addClass("has-error");
            $("#religion").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (admission_date == "") {
            $("#admission-date").addClass("has-error");
            $("#admission-date").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (roll_no == "") {
            $("#roll-no").addClass("has-error");
            $("#roll-no").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (religion_type == "other") {
            if (other_religion == "") {
                $("#other-religion").addClass("has-error");
                $("#other-religion").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }

        if (father_name == "") {
            $("#father-name").addClass("has-error");
            $("#father-name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (father_cnic == "") {
            $("#father-cnic").addClass("has-error");
            $("#father-cnic").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (father_phone == "") {
            $("#father-phone").addClass("has-error");
            $("#father-phone").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (mother_name == "") {
            $("#mother-name").addClass("has-error");
            $("#mother-name").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (mother_cnic == "") {
            $("#mother-cnic").addClass("has-error");
            $("#mother-cnic").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (mother_phone == "") {
            $("#mother-phone").addClass("has-error");
            $("#mother-phone").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (first_person_call == "") {
            $("#first-person-call").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#first-person-call").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (guardian_relation == "other") {
            if (other_relation == "") {
                $("#other-relation").addClass("has-error");
                $("#other-relation").after("<span class='error'>This field is required.</span>");
                flag = false;
            }
        }

        if (pick_and_drop == "") {
            $("#pick-and-drop").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#pick-and-drop").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        if (campus_id == "") {
            $("#campus-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#campus-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (session_id == "") {
            $("#session-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#session-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (class_id == "") {
            $("#class-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#class-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (section_id == "") {
            $("#section-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#section-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }
        if (category_id == "") {
            $("#category-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#category-id").siblings("span").after("<span class='error'>This field is required.</span>");
            flag = false;
        }

        console.log(flag);

        if (flag) {


            $("#btn-update-admission").addClass('disabled');
            $("#btn-update-admission").html('. . . . .');

            var message = '';
            var formData = {
                "student_id": student_id,
                "gr": gr,
                "bform_crms_no": bform_crms_no,
                "dob": dob,
                "gender": gender,
                "place_of_birth": place_of_birth,
                "nationality": nationality,
                "mother_tongue": mother_tongue,
                "first_name": first_name,
                "last_name": last_name,
                "religion": religion,
                "admission_date": admission_date,
                "previous_class": previous_class,
                "previous_school": previous_school,
                "blood_group": blood_group,
                "height": height,
                "weight": weight,
                "student_vaccinated": student_vaccinated,
                "as_on_date": as_on_date,
                "fee_discount": fee_discount,
                "system": system,
                "roll_no": roll_no,
                "temporary_gr": temporary_gr,
                "mobile_no": mobile_no,
                "email": email,

                "religion_type": religion_type,
                "other_religion": other_religion,

                "siblings_in_mpa": siblings_in_mpa,
                "no_of_siblings": no_of_siblings,

                "father_name": father_name,
                "father_cnic": father_cnic,
                "father_phone": father_phone,
                "father_email": father_email,
                "father_occupation": father_occupation,
                "father_company_name": father_company_name,
                "father_salary": father_salary,
                "father_vaccinated": father_vaccinated,

                "mother_name": mother_name,
                "mother_cnic": mother_cnic,
                "mother_phone": mother_phone,
                "mother_email": mother_email,
                "mother_occupation": mother_occupation,
                "mother_company_name": mother_company_name,
                "mother_salary": mother_salary,
                "mother_vaccinated": mother_vaccinated,

                "guardian_first_name": guardian_first_name,
                "guardian_phone": guardian_phone,
                "guardian_relation": guardian_relation,
                "other_relation": other_relation,
                "first_person_call": first_person_call,
                "guardian_cnic": guardian_cnic,

                "campus_id": campus_id,
                "session_id": session_id,
                "class_id": class_id,
                "section_id": section_id,
                "category_id": category_id,
                "first_person_call": first_person_call,
                "school_house_id": school_house_id,


                "current_house_no": current_house_no,
                "current_block_no": current_block_no,
                "current_building_name_no": current_building_name_no,
                "current_city": current_city,
                "current_area_id": current_area_id,
                "same_as_current": same_as_current,
                "permanent_house_no": permanent_house_no,
                "permanent_block_no": permanent_block_no,
                "permanent_building_name_no": permanent_building_name_no,
                "permanent_city": permanent_city,
                "permanent_area_id": permanent_area_id,

                "pick_and_drop": pick_and_drop,
                "ride_vehicle_no": ride_vehicle_no,
                "school_driver_name": school_driver_name,
                "school_driver_phone": school_driver_phone,
                "school_vehicle_no": school_vehicle_no,
                "private_driver_name": private_driver_name,
                "private_driver_phone": private_driver_phone,
                "private_vehicle_no": private_vehicle_no
            };



            $.ajax({
                url: baseUrl + '/admission/update',
                type: "PUT",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                dataType: "json",
                success: function (response) {

                    if (response.status === false) {

                        if (response.error) {
                            if (Object.keys(response.error).length > 0) {
                                $.each(response.error, function (key, value) {

                                    if (key === 'admission_date') {
                                        $("input[name='" + key + "']").addClass("has-error");
                                        $("input[name='" + key + "']").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                    } else {
                                        $("select[name='" + key + "']").siblings("span").find(".select2-selection--single").addClass("has-error");
                                        $("select[name='" + key + "']").siblings("span").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                    }

                                });
                            }
                        } else {
                            message += `<div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <strong> Error!</strong> `+ response.message + `
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

                    if (message !== '') {
                        $("#after-form-store-msg").prepend(message);
                        setTimeout(function () {
                            $(".alert").remove();
                        }, 4000);
                    }

                    $("#btn-update-admission").removeClass('disabled');
                    $("#btn-update-admission").html('Updated');
                }
            });
        }
    });

    $(document).on('change', "#same-as-current", function () {

        if ($('#same-as-current').is(':checked')) {
            $("#permanent-house-no, #permanent-block-no, #permanent-building-name-no, #permanent-city, #permanent-area-id, #permanent-city-id").prop('disabled', true);
            $("#permanent-house-no, #permanent-block-no, #permanent-building-name-no, #permanent-city, #permanent-area-id, #permanent-city-id").val('');
            $("#permanent-area-id, #permanent-city-id").val('').change();
        } else {
            $("#permanent-house-no, #permanent-block-no, #permanent-building-name-no, #permanent-city, #permanent-area-id, #permanent-city-id").prop('disabled', false);
            $("#permanent-house-no, #permanent-block-no, #permanent-building-name-no, #permanent-city, #permanent-area-id, #permanent-city-id").val('');
            $("#permanent-area-id, #permanent-city-id").val('').change();
        }
    });
    // End data update script

    $(document).on('change', '#campus-id', function (e) {

        e.preventDefault();

        $("#campus-id").siblings("span").find(".select2-selection--single").removeClass("has-error");
        $("#campus-id").siblings('span.error').remove();

        $('#system-id, #class-id, #group-id').html('<option value="">Select</option>');
        $('#system-id, #class-id, #group-id').prop('disabled', true);

        var promotion_modal = $('#promote-student-modal').hasClass('show');
        if (promotion_modal) {
            var campus_id = $('#promotion-form').find('#campus-id').val();
        } else {
            var campus_id = $('#campus-id').val();
        }

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

                            if (promotion_modal) {
                                $('#promotion-form').find('#system-id').prop('disabled', false);
                                $('#promotion-form').find('#system-id').html(schoolSystems);
                            } else {
                                $('#system-id').prop('disabled', false);
                                $('#system-id').html(schoolSystems);
                            }

                        } else {

                            if (promotion_modal) {

                                $('#promotion-form').find('#system-id, #class-id, #group-id').html('<option value="">Select</option>');
                                $('#promotion-form').find('#system-id, #class-id, #group-id').prop('disabled', true);

                            } else {

                                $('#system-id, #class-id, #group-id').html('<option value="">Select</option>');
                                $('#system-id, #class-id, #group-id').prop('disabled', true);

                            }
                        }

                    } else {

                        $("#campus-id").siblings("span").find(".select2-selection--single").addClass("has-error");
                        $("#campus-id").siblings("span").after("<span class='error'>" + response.error.campus_id.toString().split(/[,]+/).join("<br/>") + "</span>");

                    }
                }
            });
        }
    });

    $(document).on('change', '#system-id', function (e) {

        e.preventDefault();

        $('#class-id, #group-id').html('<option value="">Select</option>');
        $('#class-id, #group-id').prop('disabled', true);

        var promotion_modal = $('#promote-student-modal').hasClass('show');
        if (promotion_modal) {
            var campus_id = $('#promotion-form').find('#campus-id').val();
            var system_id = $('#promotion-form').find('#system-id').val();
        } else {
            var campus_id = $('#campus-id').val();
            var system_id = $('#system-id').val();
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

                            if (promotion_modal) {
                                $('#promotion-form').find('#class-id').prop('disabled', false);
                                $('#promotion-form').find('#class-id').html(classes);
                            } else {
                                $('#class-id').prop('disabled', false);
                                $('#class-id').html(classes);
                            }

                        } else {
                            if (promotion_modal) {
                                $('#promotion-form').find('#class-id').prop('disabled', true);
                                $('#promotion-form').find('#class-id').html('<option value="">Select</option>');
                            } else {
                                $('#class-id').prop('disabled', true);
                                $('#class-id').html('<option value="">Select</option>');
                            }
                        }
                    }
                }
            });
        }
    });

    $(document).on('change', '#class-id', function (e) {

        e.preventDefault();

        $('#group-id').html('<option value="">Select</option>');
        $('#group-id').prop('disabled', true);

        var promotion_modal = $('#promote-student-modal').hasClass('show');
        if (promotion_modal) {
            var campus_id = $('#promotion-form').find('#campus-id').val();
            var system_id = $('#promotion-form').find('#system-id').val();
            var class_id = $('#promotion-form').find('#class-id').val();
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

                    console.log(response);
                    console.log(response.classGroups);

                    if (response.status === true) {

                        var classGroup = response.classGroups;
                        var groups = `<option value="">Select</option>`;
                        console.log(classGroup.length);
                        if (classGroup.length) {
                            $(classGroup).each(function (key, value) {
                                groups += `<option value="` + value.id + `" >` + value.group + `</option>`;
                            });
                            if (promotion_modal) {
                                $('#promotion-form').find('#group-id').prop('disabled', false);
                                $('#promotion-form').find('#group-id').html(groups);
                            } else {
                                $('#group-id').prop('disabled', false);
                                $('#group-id').html(groups);
                            }
                        } else {
                            if (promotion_modal) {
                                $('#promotion-form').find('#group-id').html('<option value="">Select</option>');
                                $('#promotion-form').find('#group-id').prop('disabled', true);
                            } else {
                                $('#group-id').html('<option value="">Select</option>');
                                $('#group-id').prop('disabled', true);
                            }
                        }
                    }
                }
            });
        }
    });

    // Enable Religion Other Input
    $(document).on('change', '#religion-type', function (e) {
        e.preventDefault();

        var religion_type = $('#religion-type').val();

        if (religion_type == "other") {
            $('#religion-type-other').prop('disabled', false);
        }
        else {
            $('#religion-type-other').prop('disabled', true);
        }
    });

    // Enable Guardian Relation Other Input
    $(document).on('change', '#guardian-relation', function (e) {
        e.preventDefault();

        var guardian_relation = $('#guardian-relation').val();

        if (guardian_relation == "other") {
            $('#guardian-relation-other').prop('disabled', false);
        }
        else {
            $("#guardian-relation-other").removeClass("has-error");
            $("#guardian-relation-other").siblings('span.error').remove();
            $('#guardian-relation-other').val('');
            $('#guardian-relation-other').prop('disabled', true);
        }
    });

    // Get Pick / Drop Details
    $(document).on('change', '#pick-and-drop-old', function (e) {

        e.preventDefault();
        $("#pick-drop-details-row").remove();
        var pick_and_drop = $('#pick-and-drop').val();
        var html = '<div class="form-row" id="pick-drop-details-row">';

        if (pick_and_drop == 'by_ride' || pick_and_drop == 'by_school_van' || pick_and_drop == 'by_private_van') {

            html += `<div class="form-group col-md-4 mb-0">
                            <label class="form-label tx-semibold">Vehicle No</label>
                            <input type="text" class="form-control" name="vehicle_no" id="vehicle-no">
                        </div>`;

        }
        if (pick_and_drop == 'by_school_van' || pick_and_drop == 'by_private_van') {

            html += `<div class="form-group col-md-4 mb-0" > 
                            <label class="form-label tx-semibold">Driver Name</label> 
                            <input type="text" class="form-control" name="driver_name" id="driver-name"> 
                        </div>
                        <div class="form-group col-md-4 mb-0"> 
                            <label class="form-label tx-semibold">Driver Phone</label> 
                            <input type="number" class="form-control" name="driver_phone" id="driver-phone" placeholder="03##-#######"> 
                        </div>`;
        }
        html += `</div>`;
        $(this).parent().parent().after(html);

        // if (pick_and_drop == 'by_ride') {

        //     html +=     `<label class="form-label tx-semibold">Vehicle No</label>
        //                 <input type="text" class="form-control" name="ride_vehicle_no" id="ride-vehicle-no">
        //             </div>`;        

        //     $(this).parent().parent().after(html);

        // } else if (pick_and_drop == 'by_school_van') {

        //     html +=    `<div class="form-row"> 
        //                     <div class="form-group col-md-4 mb-0" > 
        //                         <label class="form-label tx-semibold">School Driver Name</label> 
        //                         <input type="text" class="form-control" name="school_driver_name" id="school-driver-name"> 
        //                     </div>

        //                     <div class="form-group col-md-4 mb-0"> 
        //                         <label class="form-label tx-semibold">School Driver Phone</label> 
        //                         <input type="number" class="form-control" name="school_driver_phone" id="school-driver-phone" placeholder="03##-#######"> 
        //                     </div>

        //                     <div class="form-group col-md-4 mb-0"> 
        //                         <label class="form-label tx-semibold">School Vehicle No</label> 
        //                         <input type="text" class="form-control" name="school_vehicle_no" id="school-vehicle-no"> 
        //                     </div> 
        //                 </div >
        //             </div>`;
        //     $(this).parent().parent().after(html);

        // } else if (pick_and_drop == 'by_private_van') {

        //     html +=    `<div class="form-row"> 
        //                     <div class="form-group col-md-4 mb-0">
        //                         <label class="form-label tx-semibold">Private Driver Name</label> 
        //                         <input type="text" class="form-control" name="private_driver_name" id="private-driver-name">
        //                     </div>

        //                     <div class="form-group col-md-4 mb-0">
        //                         <label class="form-label tx-semibold">Private Driver Phone</label> 
        //                         <input type="number" class="form-control" name="private_driver_phone" id="private-driver-phone" placeholder="03##-#######"> 
        //                     </div>

        //                     <div class="form-group col-md-4 mb-0"> 
        //                         <label class="form-label tx-semibold">School Vehicle No</label> 
        //                         <input type="text" class="form-control" name="private_vehicle_no" id="private-vehicle-no"> 
        //                     </div> 
        //                 </div>
        //             </div>`;
        //     $(this).parent().parent().after(html);
        // }

    });

    // btn-import-file
    $("#btn-import-admisisons").on("click", function (e) {
        e.preventDefault();

        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;
        var message = '';

        var campus_id = $("#campus-id").val();
        var session_id = $("#session-id").val();
        var class_id = $("#class-id").val();
        var system_id = $("#system-id").val();
        var section_id = $("#section-id").val();
        var group_id = $("#group-id").val();
        var import_file = $("#import-file").val();

        if (campus_id == "" || campus_id == "0") {
            $("#campus-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $("#campus-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (system_id == "" || system_id == "0") {
            $("#system-id:not([disabled])").siblings(".select2-selection--single").addClass("has-error");
            $("#system-id:not([disabled])").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (class_id == "" || class_id == "0") {
            $("#class-id:not([disabled]").siblings(".select2-selection--single").addClass("has-error");
            $("#class-id:not([disabled]").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (group_id == "" || group_id == "0") {
            $("#group-id:not([disabled]").siblings(".select2-selection--single").addClass("has-error");
            $("#group-id:not([disabled]").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (session_id == "" || session_id == "0") {
            $("#session-id").siblings(".select2-selection--single").addClass("has-error");
            $("#session-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (section_id == "" || section_id == "0") {
            $("#section-id").siblings(".select2-selection--single").addClass("has-error");
            $("#section-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (import_file == "" || import_file == "0") {
            $("#import-file").siblings(".select2-selection--single").addClass("has-error");
            $("#import-file").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-import-admisisons").addClass('disabled');
            $("#btn-import-admisisons").html('. . . . .');

            var formData = {
                "campus_id": campus_id,
                "system_id": system_id,
                "class_id": class_id,
                "group_id": group_id,
                "session_id": session_id,
                "section_id": section_id,
                "import_file": import_file
            }

            $.ajax({
                url: baseUrl + '/admission/import/store',
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                dataType: "json",
                success: function (response) {

                    if (response.status === false) {
                        if (response.error) {

                            $("#btn-import-admisisons").html('Save Details');
                            $("#btn-import-admisisons").removeClass('disabled');

                            if (Object.keys(response.error).length > 0) {
                                $.each(response.error, function (key, value) {
                                    $("select[name='" + key + "']").siblings("span").find(".select2-selection--single").addClass("has-error");
                                    $("select[name='" + key + "']").siblings("span").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                                });
                            }
                        }
                    }
                },
                error: function () {

                    $("#btn-import-admisisons").removeClass('disabled');
                    $("#btn-import-admisisons").html('Submit');

                    message = `<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong> Whoops !</strong> Something went wrong please contact to admintrator.
                        </div>`;
                },
                complete: function () {

                    if (message !== '') {
                        $("form").prepend(message);
                    }

                    $("#btn-import-admisisons").removeClass('disabled');
                    $("#btn-import-admisisons").html('Submit');

                }
            });
        }
    });

    //Student Search
    $("#btn-search-student").on("click", function (e) {
        e.preventDefault();

        var campus_id = $("#campus-id").val();
        var session_id = $("#session-id").val();
        var class_id = $("#class-id").val();
        var section_id = $("#section-id").val();

        var formData = {
            'campus_id': campus_id,
            'session_id': session_id,
            'class_id': class_id,
            'section_id': section_id
        };

        $.ajax({
            url: baseUrl + '/search/student',
            type: "POST",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            dataType: "json",
            success: function (response) {

                if (response.status === false) {
                    if (response.error) {
                        if (Object.keys(response.error).length > 0) {
                            $.each(response.error, function (key, value) {
                                $("select[name='" + key + "']").siblings("span").find(".select2-selection--single").addClass("has-error");
                                $("select[name='" + key + "']").siblings("span").after("<span class='error'>" + value.toString().split(/[,]+/).join("<br/>") + "</span>");
                            });
                        }
                    }
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

    //Student Details
    $(document).on('click', '#btn-student-details', function () {
        var student_id = $(this).data('id');

        $.ajax({
            url: baseUrl + '/student/details',
            type: "GET",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { student_id: student_id },
            dataType: "json",
            success: function (response) {
                console.log(response);
            },
            error: function () {
                message = `<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong> Whoops !</strong> Something went wrong please contact to admintrator.
                            </div>`;
            },
            complete: function () {
                // 
            }
        });

    });

    // Save Students Promotion
    $('#btn-save-promotion-old').on("click", function (e) {
        e.preventDefault();

        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;

        var campus_id = $('#promotion-form').find('#campus-id').val();
        var system_id = $('#promotion-form').find('#system-id').val()
        var class_id = $('#promotion-form').find('#class-id').val()
        var group_id = $('#promotion-form').find('#group-id').val()
        var session_id = $('#promotion-form').find('#session-id').val()
        var section_id = $('#promotion-form').find('#section-id').val()

        if (session_id == "" || session_id == "0") {
            $('#promotion-form').find("#session-id").siblings(".select2-selection--single").addClass("has-error");
            $('#promotion-form').find("#session-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (campus_id == "" || campus_id == "0") {
            $('#promotion-form').find("#campus-id").siblings("span").find(".select2-selection--single").addClass("has-error");
            $('#promotion-form').find("#campus-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (system_id == "" || system_id == "0") {
            $('#promotion-form').find("#system-id:not([disabled])").siblings(".select2-selection--single").addClass("has-error");
            $('#promotion-form').find("#system-id:not([disabled])").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (class_id == "" || class_id == "0") {
            $('#promotion-form').find("#class-id:not([disabled]").siblings(".select2-selection--single").addClass("has-error");
            $('#promotion-form').find("#class-id:not([disabled]").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        // if (group_id == "" || group_id == "0") {
        //     $('#promotion-form').find("#group-id:not([disabled]").siblings(".select2-selection--single").addClass("has-error");
        //     $('#promotion-form').find("#group-id:not([disabled]").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
        //     flag = false;
        // }

        // if (section_id == "" || section_id == "0") {
        //     $('#promotion-form').find("#section-id").siblings(".select2-selection--single").addClass("has-error");
        //     $('#promotion-form').find("#section-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
        //     flag = false;
        // }

        if (flag) {

            $("#btn-save-promotion").addClass('disabled');
            $("#btn-save-promotion").html('. . . . .');
            var message = '';
            var reg_ids = [];
            $('.chkbox-select-admission:checked').each(function () {
                var registration_id = (this.checked ? $(this).attr('data-id') : "");
                if (registration_id) {
                    reg_ids.push(registration_id);
                }
            });

            var formData = {
                "campus_id": campus_id,
                "system_id": system_id,
                "class_id": class_id,
                "group_id": group_id,
                "session_id": session_id,
                // "section_id": section_id,
                "registeration_ids": reg_ids
            }

            $.ajax({
                url: baseUrl + '/admission/promotion',
                type: "PUT",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.status === false) {

                        if (response.error) {
                            $("#btn-save-promotion").html('Save Details');
                            $("#btn-save-promotion").removeClass('disabled');

                            if (Object.keys(response.error).length > 0) {

                                var input_fields = ['campus_id', 'class_id', 'system_id', 'group_id', 'section_id', 'session_id',];
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

                        $("#btn-save-promotion").html('Save Details');
                        $("#btn-save-promotionpromotion").removeClass('disabled');

                        message += `<div class="alert alert-success alert-dismissible">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong> Success!</strong> `+ response.message + `
                                    </div>`;

                        location.reload();

                    }
                },
                error: function () {

                    $("#btn-save-promotion").html('Save Details');
                    $("#btn-save-promotion").removeClass('disabled');

                    message = `<div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong> Whoops !</strong> Something went wrong please contact to admintrator.
                                </div>`;
                },
                complete: function () {

                    if (message !== '') {
                        $("form").prepend(message);
                    }

                    $("#btn-add-promotion").removeClass('disabled');
                    $("#btn-add-promotion").html('Submit');
                }
            });

        }
    });

    // Save Students Promotion
    $('#btn-admission-excel-download').on("click", function (e) {
        e.preventDefault();

        var session_id = $('#session-id').val();
        var campus_id = $('#campus-id').val();
        var system_id = $('#system-id').val();
        var class_id = $('#class-id').val();
        var group_id = $('#group-id').val();
        var section_id = $('#section-id').val();

        // console.log(baseUrl+"/admission/export-excel?session_id="+session_id+"&campus_id="+campus_id+"&system_id="+system_id+"&class_id"+class_id+"&group_id="+group_id+"&section_id="+section_id);

        window.location.href = baseUrl + "/admission/export-excel?session_id=" + session_id + "&campus_id=" + campus_id + "&system_id=" + system_id + "&class_id=" + class_id + "&group_id=" + group_id + "&section_id=" + section_id;

    });

    $('#btn-save-promotion').on("click", function (e) {
        e.preventDefault();

        $("span.error, .alert").remove();
        $("span, input").removeClass("has-error");

        var flag = true;

        var campus_id = $('#promotion-form').find('#campus-id').val();
        var system_id = $('#promotion-form').find('#system-id').val()
        var class_id = $('#promotion-form').find('#class-id').val()
        var group_id = $('#promotion-form').find('#group-id').val()
        var session_id = $('#promotion-form').find('#session-id').val()
        var section_id = $('#promotion-form').find('#section-id').val()

        // if (session_id == "" || session_id == "0") {
        //     $('#promotion-form').find("#session-id").siblings(".select2-selection--single").addClass("has-error");
        //     $('#promotion-form').find("#session-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
        //     flag = false;
        // }

        // if (campus_id == "" || campus_id == "0") {
        //     $('#promotion-form').find("#campus-id").siblings("span").find(".select2-selection--single").addClass("has-error");
        //     $('#promotion-form').find("#campus-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
        //     flag = false;
        // }
        // if (system_id == "" || system_id == "0") {
        //     $('#promotion-form').find("#system-id:not([disabled])").siblings(".select2-selection--single").addClass("has-error");
        //     $('#promotion-form').find("#system-id:not([disabled])").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
        //     flag = false;
        // }
        // if (class_id == "" || class_id == "0") {
        //     $('#promotion-form').find("#class-id:not([disabled]").siblings(".select2-selection--single").addClass("has-error");
        //     $('#promotion-form').find("#class-id:not([disabled]").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
        //     flag = false;
        // }
        // if (group_id == "" || group_id == "0") {
        //     $('#promotion-form').find("#group-id:not([disabled]").siblings(".select2-selection--single").addClass("has-error");
        //     $('#promotion-form').find("#group-id:not([disabled]").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
        //     flag = false;
        // }

        // if (section_id == "" || section_id == "0") {
        //     $('#promotion-form').find("#section-id").siblings(".select2-selection--single").addClass("has-error");
        //     $('#promotion-form').find("#section-id").siblings("span").after("<span class='error text-danger'>This field is required.</span>");
        //     flag = false;
        // }

        if (session_id == "" || session_id == "0") {
            $('#promotion-form').find("#session-id").addClass("has-error");
            $('#promotion-form').find("#session-id").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (campus_id == "" || campus_id == "0") {
            $('#promotion-form').find("#campus-id").addClass("has-error");
            $('#promotion-form').find("#campus-id").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (system_id == "" || system_id == "0") {
            $('#promotion-form').find("#system-id:not([disabled])").addClass("has-error");
            $('#promotion-form').find("#system-id:not([disabled])").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }
        if (class_id == "" || class_id == "0") {
            $('#promotion-form').find("#class-id:not([disabled]").addClass("has-error");
            $('#promotion-form').find("#class-id:not([disabled]").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (section_id == "" || section_id == "0") {
            $('#promotion-form').find("#section-id").addClass("has-error");
            $('#promotion-form').find("#section-id").after("<span class='error text-danger'>This field is required.</span>");
            flag = false;
        }

        if (flag) {

            $("#btn-save-promotion").addClass('disabled');
            $("#btn-save-promotion").html('. . . . .');
            var message = '';
            var reg_ids = [];
            $('.chkbox-select-admission:checked').each(function () {
                var registration_id = (this.checked ? $(this).attr('data-id') : "");
                if (registration_id) {
                    reg_ids.push(registration_id);
                }
            });

            var formData = {
                "campus_id": campus_id,
                "system_id": system_id,
                "class_id": class_id,
                "group_id": group_id,
                "session_id": session_id,
                "section_id": section_id,
                "registeration_ids": reg_ids
            }

            $.ajax({
                url: baseUrl + '/admission/promotion',
                type: "PUT",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.status === false) {

                        if (response.error) {
                            $("#btn-save-promotion").html('Save Details');
                            $("#btn-save-promotion").removeClass('disabled');

                            if (Object.keys(response.error).length > 0) {

                                var input_fields = ['campus_id', 'class_id', 'system_id', 'group_id', 'section_id', 'session_id',];
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

                        $("#btn-save-promotion").html('Save Details');
                        $("#btn-save-promotionpromotion").removeClass('disabled');

                        message += `<div class="alert alert-success alert-dismissible">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong> Success!</strong> `+ response.message + `
                                    </div>`;

                        location.reload();

                    }
                },
                error: function () {

                    $("#btn-save-promotion").html('Save Details');
                    $("#btn-save-promotion").removeClass('disabled');

                    message = `<div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong> Whoops !</strong> Something went wrong please contact to admintrator.
                                </div>`;
                },
                complete: function () {

                    if (message !== '') {
                        $("form").prepend(message);
                    }

                    $("#btn-add-promotion").removeClass('disabled');
                    $("#btn-add-promotion").html('Submit');
                }
            });

        }
    });

    // Start Delete Data Script
    // $(document).on('click', '#btn-delete-admission', function () {

    //     var admission_id = $(this).data('id');
    //     var url = baseUrl + '/admission/delete';
    //     var row = $(this).parent().parent("tr");

    //     swal.fire({

    //         icon: 'warning',
    //         title: 'Are you sure?',
    //         html: 'You want to <b>delete</b> this record',
    //         showCancelButton: true,
    //         showCloseButton: true,
    //         cancelButtonText: 'Cancel',
    //         confirmButtonText: 'Yes, Delete',
    //         cancelButtonColor: '#d33',
    //         confirmButtonColor: '#556ee6',
    //         allowOutsideClick: false

    //     }).then(function (result) {

    //         if (result.value) {

    //             $.ajax({
    //                 url: url,
    //                 type: 'DELETE',
    //                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    //                 data: { admission_id: admission_id },
    //                 dataType: "json",
    //                 success: function (response) {
    //                     if (response.status == false) {
    //                         message = {
    //                             icon: 'error',
    //                             title: 'Oops...',
    //                             text: response.message,
    //                         };
    //                     } else {
    //                         row.remove();

    //                         message = {
    //                             icon: 'success',
    //                             title: 'Success',
    //                             text: response.message,
    //                         }
    //                     }
    //                 },

    //                 error: function () {
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Oops...',
    //                         text: 'Some thing went wrong please contact to Administrator!',
    //                     })
    //                 },

    //                 complete: function () {
    //                     Swal.fire({
    //                         icon: message.icon,
    //                         title: message.title,
    //                         text: message.text,
    //                     })
    //                 }
    //             });
    //         }
    //     });
    // });
    // End Delete Data Script

});