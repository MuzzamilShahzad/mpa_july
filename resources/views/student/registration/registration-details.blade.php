<!-- Details Modal -->
<div class="modal fade" id="student-details-modal" tabindex="-1" aria-labelledby="registrationDetails" aria-hidden="true">
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
                                <select name="session_id" id="session-id" class="form-control session-select2">
                                    <option selected value="">Select Session</option>
                                    @foreach($data['sessions'] as $session)
                                    <option value="{{$session->id}}">{{$session->session}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="campus-id" class="form-label tx-semibold">Campus</label>
                                <input type="hidden" name="id" id="record-id" class="form-control" />
                                <select name="campus_id" id="campus-id" class="form-control campus-select2">
                                    <option selected value="">Select Campus</option>
                                    @foreach($data['campuses'] as $campus)
                                    <option value="{{$campus->id}}">{{$campus->campus}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="school-id" class="form-label tx-semibold">School System</label>
                                <select name="system_id" id="system-id" class="form-control system-select2">
                                    <option value="">Select System</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="class-id" class="form-label tx-semibold">Class</label>
                                <select name="class_id" id="class-id" class="form-control class-select2" disabled>
                                    <option selected value="">Select Class</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="group-id" class="form-label tx-semibold">Class Group</label>
                                <select name="group_id" id="group-id" class="form-control group-select2" disabled>
                                    <option value="">Select Class Group</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="registration-number" class="form-label tx-semibold">Registration Number</label>
                                <input type="text" name="registration-number" id="registration-number" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="form-number" class="form-label tx-semibold">Form Number</label>
                                <input type="text" name="form_no" id="form-number" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="first-name" class="form-label tx-semibold">First Name</label>
                                <input type="text" name="first_name" id="first-name" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="last-name" class="form-label tx-semibold">Last Name</label>
                                <input type="text" name="last_name" id="last-name" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="dob" class="form-label tx-semibold">Date of Birth</label>
                                <input class="form-control date-picker bg-transparent" name="dob" id="dob" placeholder="DD-MM-YYYY" type="date" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Gender</label>
                                <div class="pos-relative">
                                    <select class="form-control gender-select2" name="gender" id="gender" disabled>
                                        <option selected value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
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
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label tx-semibold">No. of Siblings</label>
                                <input type="text" class="form-control" name="no_of_siblings" id="no-of-siblings" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Previous Class (IF ANY)</label>
                                <div class="pos-relative">
                                    <select class="form-control previous-class-id-select2" name="previous_class_id" id="previous-class-id" disabled>
                                        <option value="">Select</option>
                                        @foreach($data['classes'] as $class)
                                        <option value="{{$class->id}}">{{$class->class}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Previous School (IF ANY)</label>
                                <input type="text" class="form-control" name="previous_school" id="previous-school" readonly>
                            </div>
                        </div>
                    </div>

                    <hr style="border: 1px solid lightgrey;">

                    <div class="row mt-3">

                        <h4 class="main-content-label mb-3"> <strong>Current Address</strong></h4>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label tx-semibold">House / Apartment Number</label>
                                <input type="text" class="form-control" name="house_no" id="house-no" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Block Number</label>
                                <input type="text" class="form-control" name="block_no" id="block-no" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Building Name/Number (If ANY)</label>
                                <input type="text" class="form-control" name="building_no" id="building-no" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Area</label>
                                <div class="pos-relative">
                                    <select class="form-control area-select2" name="area_id" id="area-id" disabled>
                                        <option selected value="">Select Area</option>
                                        @foreach($data['areas'] as $area)
                                        <option value="{{$area->id}}">{{$area->area}}</option>
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
                                        <option value="{{$city->id}}">{{$city->city}}</option>
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
                                <input type="text" class="form-control" name="father_cnic" id="father-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Name</label>
                                <input type="text" class="form-control" name="father_name" id="father-name" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Occupation</label>
                                <input type="text" class="form-control" name="father_occupation" id="father-occupation" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Company Name</label>
                                <input type="text" class="form-control" name="father_company_name" id="father-company-name" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Salary</label>
                                <input type="number" class="form-control" name="father_salary" id="father-salary" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Email</label>
                                <input type="text" class="form-control" name="father_email" id="father-email" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Father Phone No</label>
                                <input type="text" class="form-control" name="father_phone" id="father-phone" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label tx-semibold">How did you hear about us?</label>
                                <div class="pos-relative">
                                    <select class="form-control hear-about-us-select2" name="hear_about_us" id="hear-about-us" disabled>
                                        <option value="">Select</option>
                                        <option value="social_media">Social Media</option>
                                        <option value="electronic_media">Electronic Media</option>
                                        <option value="print_media">Print Media</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label tx-semibold">Select Test Group</label>
                                <div class="pos-relative">
                                    <select class="form-control test-group-select2" name="test_group_id" id="test-group-id" disabled>
                                        <option value="">Select Test</option>
                                        @foreach($data['tests'] as $test)
                                        <option value="{{$test->id}}">{{$test->name}}</option>
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
                                        <option value="{{$interview->id}}">{{$interview->name}}</option>
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
                <button type="button" class="btn btn-info" id="btn-edit-registration"> Edit Details </button>
                <button type="button" class="btn btn-primary" id="btn-save-registration" disabled> Save Details</button>
            </div>
        </div>
    </div>
</div>