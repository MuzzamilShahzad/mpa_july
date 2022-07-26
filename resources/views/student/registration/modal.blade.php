<div class="modal fade" id="edit-registeration-modal" tabindex="-1" aria-labelledby="registrationDetails" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationDetails">Registration Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('student.registration.update') }}" method="POST" id="edit-detail-form">
                    <div class="row">
                        <h4 class="main-content-label mb-3"> <strong>Student</strong></h4>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="session-id" class="form-label tx-semibold">Session</label>
                                <select name="session_id" id="session-id" class="form-control student-detail-session-select2" disabled>
                                    <option selected value="">Select Session</option>
                                    @foreach($data['sessions'] as $session)
                                    <option value="{{$session->id}}" {{ ($data["registration"]->session_id == $session->id) ? 'selected' : '' }}>{{$session->session}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="campus-id" class="form-label tx-semibold">Campus</label>
                                <select name="campus_id" id="campus-id" class="form-control campus-select2" disabled>
                                    <option selected value="">Select Campus</option>
                                    @foreach($data['campuses'] as $campus)
                                    <option value="{{$campus->id}}" {{ ($data["registration"]->campus_id == $campus->id) ? 'selected' : '' }}>{{$campus->campus}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="school-id" class="form-label tx-semibold">School System</label>
                                <select name="system_id" id="system-id" class="form-control system-select2" disabled>
                                    <option value=""></option>
                                    @foreach($data['systems'] as $system)
                                    <option value="{{$system->id}}" {{ ($data["registration"]->system_id == $system->id) ? 'selected' : '' }}>{{$system->system}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="class-id" class="form-label tx-semibold">Class</label>
                                <select name="class_id" id="class-id" class="form-control class-select2" disabled>
                                    <option selected value="">Select Class</option>
                                    @foreach($data['campusClasses'] as $class)
                                    <option value="{{$class->id}}" {{ ($data["registration"]->class_id == $class->id) ? 'selected' : '' }}>{{$class->class}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="group-id" class="form-label tx-semibold">Class Group</label>
                                <select name="group_id" id="group-id" class="form-control group-select2" disabled>
                                    <option value=""></option>
                                    @foreach($data['classGroups'] as $group)
                                    <option value="{{$group->id}}" {{ ($data["registration"]->class_group_id == $group->id) ? 'selected' : '' }}>{{$group->group}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="registration-number" class="form-label tx-semibold">Registration Number</label>
                                <input type="text" name="registration-number" value="{{ $data['registration']->registration_id }}" id="registration-number" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="form-number" class="form-label tx-semibold">Form Number</label>
                                <input type="text" name="form_no" id="form-number" value="{{ $data['registration']->form_no }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="first-name" class="form-label tx-semibold">First Name</label>
                                <input type="text" name="first_name" id="first-name" value="{{ $data['registration']->first_name }}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="last-name" class="form-label tx-semibold">Last Name</label>
                                <input type="text" name="last_name" id="last-name" value="{{ $data['registration']->last_name }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="dob" class="form-label tx-semibold">Date of Birth</label>
                                <input class="form-control date-picker bg-transparent" value="{{ $data['registration']->dob }}" name="dob" id="dob" placeholder="DD-MM-YYYY" type="date" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Gender</label>
                                <div class="pos-relative">
                                    <select class="form-control gender-select2" name="gender" id="gender" disabled>
                                        <option selected value="">Select Gender</option>
                                        <option value="male" {{ ($data["registration"]->gender == "male") ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ ($data["registration"]->gender == "female") ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Any sibling currently studying in MPA ?</label>
                                <div class="pos-relative">
                                    <select class="form-control siblings-in-mpa-select2" name="siblings_in_mpa" id="siblings-in-mpa" disabled>
                                        <option value="">Select If Any</option>
                                        <option value="yes" {{ ($data["registration"]->siblings_in_mpa == "yes") ? 'selected' : '' }}>Yes</option>
                                        <option value="no" {{ ($data["registration"]->siblings_in_mpa == "no") ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label tx-semibold">No. of Siblings</label>
                                <input type="text" class="form-control" value="{{ $data['registration']->no_of_siblings }}" name="no_of_siblings" id="no-of-siblings" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Previous Class (IF ANY)</label>
                                <div class="pos-relative">
                                    <select class="form-control previous-class-id-select2" name="previous_class_id" id="previous-class-id" disabled>
                                        <option value="">Select</option>
                                        @foreach($data['classes'] as $class)
                                        <option value="{{$class->id}}" {{ ($data["registration"]->previous_class_id == $class->id) ? 'selected' : '' }}>{{$class->class}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Previous School (IF ANY)</label>
                                <input type="text" class="form-control" value="{{ $data['registration']->previous_school }}" name="previous_school" id="previous-school" readonly>
                            </div>
                        </div>
                    </div>

                    <hr style="border: 1px solid lightgrey;">

                    <div class="row mt-3">

                        <h4 class="main-content-label mb-3"> <strong>Current Address</strong></h4>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label tx-semibold">House / Apartment Number</label>
                                <input type="text" class="form-control" name="house_no" value="{{ $data['registration']->house_no }}" id="house-no" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Block Number</label>
                                <input type="text" class="form-control" name="block_no" value="{{ $data['registration']->block_no }}" id="block-no" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Building Name/Number (If ANY)</label>
                                <input type="text" class="form-control" name="building_no" value="{{ $data['registration']->building_no }}" id="building-no" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Area</label>
                                <div class="pos-relative">
                                    <select class="form-control area-select2" name="area_id" id="area-id" disabled>
                                        <option selected value="">Select Area</option>
                                        @foreach($data['areas'] as $area)
                                        <option value="{{$area->id}}" {{ ($data["registration"]->area_id == $area->id) ? 'selected' : '' }}>{{$area->area}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label tx-semibold">City</label>
                                <div class="pos-relative">
                                    <select class="form-control city-select2" name="city_id" id="city-id" disabled>
                                        <option selected value="">Select City</option>
                                        @foreach($data['cities'] as $city)
                                        <option value="{{$city->id}}" {{ ($data["registration"]->city_id == $city->id) ? 'selected' : '' }}>{{$city->city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="border: 1px solid lightgrey;">

                    <div class="row mt-3">
                        <h4 class="main-content-label mb-3"> <strong>Father</strong> </h4>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father CNIC Number</label>
                                <input type="text" class="form-control" name="father_cnic" value="{{ json_decode($data['registration']->father_details)->cnic }}" id="father-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Name</label>
                                <input type="text" class="form-control" name="father_name" value="{{ json_decode($data['registration']->father_details)->name }}" id="father-name" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Occupation</label>
                                <input type="text" class="form-control" name="father_occupation" value="{{ json_decode($data['registration']->father_details)->occupation }}" id="father-occupation" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Company Name</label>
                                <input type="text" class="form-control" name="father_company_name" value="{{ json_decode($data['registration']->father_details)->company_name }}" id="father-company-name" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Salary</label>
                                <input type="number" class="form-control" name="father_salary" value="{{ json_decode($data['registration']->father_details)->salary }}" id="father-salary" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Email</label>
                                <input type="text" class="form-control" name="father_email" value="{{ json_decode($data['registration']->father_details)->email }}" id="father-email" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Phone No</label>
                                <input type="text" class="form-control" name="father_phone" id="father-phone" value="{{ json_decode($data['registration']->father_details)->phone }}" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">How did you hear about us?</label>
                                <div class="pos-relative">
                                    <select class="form-control hear-about-us-select2" name="hear_about_us" id="hear-about-us-edit-field" disabled>
                                        <option value="">Select</option>
                                        <option value="social_media" {{ ($data["registration"]->hear_about_us == 'social_media') ? 'selected' : '' }}>Social Media</option>
                                        <option value="electronic_media" {{ ($data["registration"]->hear_about_us == 'electronic_media') ? 'selected' : '' }}>Electronic Media</option>
                                        <option value="print_media" {{ ($data["registration"]->hear_about_us == 'print_media') ? 'selected' : '' }}>Print Media</option>
                                        <option value="other" {{ ($data["registration"]->hear_about_us == 'other') ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if(isset($data["registration"]->hear_about_us_other))
                        <div class="col-3" id="hear-about-us-other-row">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Other</label>
                                <input type="text" class="form-control" name="hear_about_us_other" value="{{ $data['registration']->hear_about_us_other }}" id="hear-about-us-other" readonly>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Select Test Group</label>
                                <div class="pos-relative">
                                    <select class="form-control test-group-select2" name="test_group_id" id="test-group-id" disabled>
                                        <option value="">Select Test</option>
                                        @foreach($data['tests'] as $test)
                                        <option value="{{$test->id}}" {{ ($data["registration"]->test_group_id == $test->id) ? 'selected' : '' }}>{{$test->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Select Interview Group</label>
                                <div class="pos-relative">
                                    <select class="form-control interview-group-select2" name="interview_group_id" id="interview-group-id" disabled>
                                        <option value="">Select Interview</option>
                                        @foreach($data['interviews'] as $interview)
                                        <option value="{{$interview->id}}" {{ ($data["registration"]->interview_group_id == $interview->id) ? 'selected' : '' }}>{{$interview->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Close </button>
                <a href="{{ route('student.registration.edit', $data['registration']->id) }}"><button type="button" class="btn btn-primary"> Edit </button></a>
            </div>
        </div>
    </div>
</div>