@extends('layouts.app')
@section('main-content')
@section('page_title', 'Edit Student Registration')

<style>
    /* .select2-selection__clear {
        margin-top: 1px;
        margin-right: 10px;
    } */
</style>

<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">{{ $data['menu'] }}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;">{{ $data['page'] }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data['menu'] }}</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->
            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card custom-card">
                        <div class="card-header d-flex">
                            <h6 class="main-content-label">{{ $data['menu'] }}</h6>
                        </div>
                        <form>
                            <input type="hidden" name="record_id" id="record-id" value="{{ (isset($data["registration"]) && !empty($data["registration"])) ? (isset($data["registration"]->id)) ? $data["registration"]->id : 'No Data' : '' }}">
                            <div class="card-body">
                                <h4 class="main-content-label"> <strong>Student</strong></h4>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <div class="pos-relative">
                                                <label class="form-label tx-semibold">Session</label>
                                                <select class="form-control select2" name="session_id" id="session-id">
                                                    <option value="">Select</option>
                                                    @foreach($data['session'] as $session)
                                                    <option value="{{$session->id}}"{{ ($data["registration"]->session_id == $session->id) ? 'selected' : '' }}>{{$session->session}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Campus</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="campus_id" id="campus-id">
                                                    <option value="">Select</option>
                                                    @foreach($data['campus'] as $campus)
                                                    <option value="{{$campus->id}}" {{ ($data["registration"]->campus_id == $campus->id) ? 'selected' : '' }}>{{$campus->campus}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">School System</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="system_id" id="system-id">
                                                    <option value="">Select</option>
                                                    @foreach($data['systems'] as $system)
                                                        <option value="{{$system->id}}" {{ ($data["registration"]->system_id == $system->id) ? 'selected' : '' }}>{{$system->system}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <div class="pos-relative">
                                                <label class="form-label tx-semibold">Class</label>
                                                <select class="form-control select2" name="class_id" id="class-id">
                                                    <option value="">Select</option>
                                                    @foreach($data['campusClasses'] as $class)
                                                        <option value="{{$class->id}}" {{ ($data["registration"]->class_id == $class->id) ? 'selected' : '' }}>{{$class->class}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class Group</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="class_group_id" id="class-group-id">
                                                    <option value="">Select</option>
                                                    @foreach($data['groups'] as $group)
                                                        <option value="{{$group->id}}" {{ ($data["registration"]->class_group_id == $group->id) ? 'selected' : '' }}>{{$group->group}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Form Number</label>
                                            <input type="text" name="form_no" id="form-number" value="{{ (isset($data["registration"]) && !empty($data["registration"])) ? (isset($data["registration"]->form_no)) ? $data["registration"]->form_no : 'No Data' : '' }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">First Name</label>
                                            <input type="text" name="first_name" id="first-name" value="{{ (isset($data["registration"]) && !empty($data["registration"])) ? (isset($data["registration"]->first_name)) ? $data["registration"]->first_name : 'No Data' : '' }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Last Name</label>
                                            <input type="text" name="last_name" id="last-name" value="{{ (isset($data["registration"]) && !empty($data["registration"])) ? (isset($data["registration"]->last_name)) ? $data["registration"]->last_name : 'No Data' : '' }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold date-picker">Date of Birth</label>
                                            <input class="form-control date-picker bg-transparent" value="{{ (isset($data["registration"]) && !empty($data["registration"])) ? (isset($data["registration"]->dob)) ? $data["registration"]->dob : '' : '' }}" name="dob" id="dob" placeholder="DD-MM-YYYY" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Gender</label>
                                            <div class="pos-relative">
                                            <select class="form-control gender-select2" name="gender" id="gender">
                                                <option selected value="">Select Gender</option>
                                                <option value="male" {{ ($data["registration"]->gender == "male") ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ ($data["registration"]->gender == "female") ? 'selected' : '' }}>Female</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Is there any sibling currently studying in MPA ?</label>
                                            <div class="pos-relative">
                                            <select class="form-control siblings-in-mpa-select2" name="siblings_in_mpa" id="siblings-in-mpa">
                                                <option value="">Select If Any</option>
                                                <option value="yes" {{ ($data["registration"]->siblings_in_mpa == "yes") ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ ($data["registration"]->siblings_in_mpa == "no") ? 'selected' : '' }}>No</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">No. of Siblings</label>
                                            <input type="text" class="form-control" value="{{ (isset($data["registration"]) && !empty($data["registration"])) ? (isset($data["registration"]->no_of_siblings)) ? $data["registration"]->no_of_siblings : 'No Data' : '' }}" name="no_of_siblings" id="no-of-siblings">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Previous Class (IF ANY)</label>
                                            <div class="pos-relative">
                                            <select class="form-control previous-class-id-select2" name="previous_class_id" id="previous-class-id">
                                                <option value="">Select</option>
                                                @foreach($data['classes'] as $class)
                                                <option value="{{$class->id}}" {{ ($data["registration"]->previous_class_id == $class->id) ? 'selected' : '' }}>{{$class->class}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Previous School (IF ANY)</label>
                                            <input type="text" class="form-control" value="{{ (isset($data['registration']) && !empty($data['registration'])) ? (isset($data['registration']->previous_school)) ? $data['registration']->previous_school : 'No Data' : '' }}" name="previous_school" id="previous-school">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="main-content-label"> <strong>Current Address</strong> </h4>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">House / Apartment Number</label>
                                            <input type="text" class="form-control" name="house_no" value="{{ (isset($data['registration']) && !empty($data['registration'])) ? (isset($data['registration']->house_no)) ? $data['registration']->house_no : 'No Data' : '' }}" id="house-no">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Block Number</label>
                                            <input type="text" class="form-control" name="block_no" value="{{ (isset($data['registration']) && !empty($data['registration'])) ? (isset($data['registration']->block_no)) ? $data['registration']->block_no : 'No Data' : '' }}" id="block-no">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Building Name/Number (If ANY)</label>
                                            <input type="text" class="form-control" name="building_no" value="{{ (isset($data['registration']) && !empty($data['registration'])) ? (isset($data['registration']->building_no)) ? $data['registration']->building_no : 'No Data' : 'No Set' }}" id="building-no">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Area</label>
                                            <div class="pos-relative">
                                            <select class="form-control area-select2" name="area_id" id="area-id">
                                                <option selected value="">Select Area</option>
                                                @foreach($data['areas'] as $area)
                                                <option value="{{$area->id}}" {{ ($data["registration"]->area_id == $area->id) ? 'selected' : '' }}>{{$area->area}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">City</label>
                                            <div class="pos-relative">
                                            <select class="form-control city-select2" name="city_id" id="city-id">
                                                <option selected value="">Select City</option>
                                                @foreach($data['cities'] as $city)
                                                <option value="{{$city->id}}" {{ ($data["registration"]->city_id == $city->id) ? 'selected' : '' }}>{{$city->city}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="main-content-label"> <strong>Father</strong> </h4>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father CNIC Number</label>
                                            <input type="text" class="form-control" name="father_cnic" value="{{ (isset($data['registration']) && !empty($data['registration'])) ? (isset($data['father_details']->cnic)) ? $data['father_details']->cnic : 'No Data' : '' }}" id="father-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Name</label>
                                            <input type="text" class="form-control" name="father_name" value="{{ (isset($data['registration']) && !empty($data['registration'])) ? (isset($data['father_details']->name)) ? $data['father_details']->name : 'No Data' : '' }}" id="father-name">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Occupation</label>
                                            <input type="text" class="form-control" name="father_occupation" value="{{ (isset($data['registration']) && !empty($data['registration'])) ? (isset($data['father_details']->occupation)) ? $data['father_details']->occupation : 'No Data' : '' }}" id="father-occupation">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Company Name</label>
                                            <input type="text" class="form-control" name="father_company_name" value="{{ (isset($data['registration']) && !empty($data['registration'])) ? (isset($data['father_details']->company_name)) ? $data['father_details']->company_name : 'No Data' : '' }}" id="father-company-name">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Salary</label>
                                            <input type="number" class="form-control" name="father_salary" value="{{ (isset($data['registration']) && !empty($data['registration'])) ? (isset($data['father_details']->salary)) ? $data['father_details']->salary : 'No Data' : '' }}" id="father-salary">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Email</label>
                                            <input type="text" class="form-control" name="father_email" value="{{ (isset($data['registration']) && !empty($data['registration'])) ? (isset($data['father_details']->email)) ? $data['father_details']->email : 'No Data' : '' }}" id="father-email">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Phone No </label>
                                            <input type="text" class="form-control" name="father_phone" id="father-phone" value="{{ (isset($data['registration']) && !empty($data['registration'])) ? (isset($data['father_details']->phone)) ? $data['father_details']->phone : 'No Data' : '' }}" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">How did you hear about us?</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="hear_about_us " id="hear-about-us">
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
                                    <div class="form-group col-md-4 mb-0" id="hear-about-us-other-row">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Other</label>
                                            <input type="text" class="form-control" name="hear_about_us_other" value="{{ (isset($data['registration']) && !empty($data['registration'])) ? (isset($data['registration']->hear_about_us_other)) ? $data["registration"]->hear_about_us_other : 'No Data' : '' }}" id="hear-about-us-other">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="main-content-label">
                                    <input type="checkbox" name="test_group_chkbox" id="test-group-chkbox" {{ (isset($data["registration"]) && !empty($data["registration"])) ? (isset($data["registration"]->test_group_id)) ? 'checked' : 'asds' : 'asdsaa' }}>
                                    <strong>Test Group </strong>
                                </h4>
                                <br>
                                <div class="form-row" id="test-group-row">
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <div class="pos-relative">
                                            <select class="form-control select2" name="test_group_id" id="test-group-id">
                                                <option value="">Select Test  </option>
                                                @foreach($data['tests'] as $test)
                                                    <option value="{{$test->id}}" {{ ($data["registration"]->test_group_id == $test->id) ? 'selected' : '' }}>{{$test->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    @if(!empty($data["registration"]->test_group_id))
                                    <div class="form-group col-md-2 mb-0">
                                        <img src="http://localhost:8000/backend/assets/img/add-icon.png" class="btn-add-img" alt="Add Test" id="btn-add-test">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="main-content-label">
                                    <input type="checkbox" name="interview_group_chkbox" id="interview-group-chkbox" {{ (isset($data["registration"]) && !empty($data["registration"])) ? (isset($data["registration"]->interview_group_id)) ? 'checked' : '' : '' }} />
                                    <strong>Interview Group</strong>
                                </h4>
                                <br>
                                <div class="form-row" id="interview-group-row">
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <div class="pos-relative">
                                            <select class="form-control select2" name="interview_group_id" id="interview-group-id">
                                                <option value="">Select Interview</option>
                                                @foreach($data['interviews'] as $interview)
                                                    <option value="{{$interview->id}}" {{ ($data["registration"]->interview_group_id == $interview->id) ? 'selected' : '' }}>{{$interview->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    @if(!empty($data["registration"]->interview_group_id))
                                    <div class="form-group col-md-2 mb-0">
                                        <img src="http://localhost:8000/backend/assets/img/add-icon.png" class="btn-add-img" alt="Add interview" id="btn-add-interview">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-footer mt-2">
                                    <button type="submit" class="btn btn-primary" id="btn-save-registration">Save Registeration</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>

<!-- {{-- Own javascript --}} -->
<script src="{{ url('backend/assets/js/student/registration.js') }}"></script>

<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

<script>
    $(":input").inputmask();
</script>

@endsection