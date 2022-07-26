@extends('layouts.app')
@section('main-content')
@section('page_title', 'Add Student Registration')

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
                        <form action="{{ route('student.registration.store') }}" method="post">
                            <div class="card-body">
                                <h4 class="main-content-label"> <strong>Student</strong></h4>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Campus</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="campus_id" id="campus-id">
                                                    <option value="">Select</option>
                                                    @foreach($data['campus'] as $campus)
                                                    <option value="{{$campus->id}}">{{$campus->campus}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">School System</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="system_id" id="system-id" disabled>
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <div class="pos-relative">
                                                <label class="form-label tx-semibold">Class</label>
                                                <select class="form-control select2" name="class_id" id="class-id" disabled>
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class Group</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="class_group_id" id="class-group-id" disabled>
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <div class="pos-relative">
                                                <label class="form-label tx-semibold">Session</label>
                                                <select class="form-control select2" name="session_id" id="session-id">
                                                    <option value="">Select</option>
                                                    @foreach($data['session'] as $session)
                                                    <option value="{{$session->id}}">{{$session->session}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Form Number</label>
                                            <input type="text" class="form-control" name="form_no" id="form-no">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first-name">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last-name">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold date-picker">Date of Birth</label>
                                            <input class="form-control date-picker bg-transparent" name="dob" id="dob" placeholder="DD-MM-YYYY" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Gender</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="gender" id="gender">
                                                    <option selected value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Is there any sibling currently studying in MPA ?</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="siblings_in_mpa" id="siblings-in-mpa">
                                                    <option value="">Select If Any</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">No. of Siblings</label>
                                            <input type="number" class="form-control" name="no_of_siblings" id="no-of-siblings">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Previous Class (IF ANY)</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="previous_class" id="previous-class">
                                                    <option value="">Select</option>
                                                    @foreach($data['class'] as $class)
                                                    <option value="{{$class->id}}">{{$class->class}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Previous School (IF ANY)</label>
                                            <input type="text" class="form-control" name="previous_school" id="previous-school">
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
                                            <input type="text" class="form-control" name="house_no" id="house-no">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Block Number</label>
                                            <input type="text" class="form-control" name="block_no" id="block-no">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Building Name/Number (If ANY)</label>
                                            <input type="text" class="form-control" name="building_no" id="building-no">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Area</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="area_id " id="area-id">
                                                    <option value="">Select</option>
                                                    @foreach($data['area'] as $area)
                                                    <option value="{{$area->id}}">{{$area->area}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">City</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="city_id" id="city-id">
                                                    <option value="">Select</option>
                                                    @foreach($data['city'] as $city)
                                                    <option value="{{$city->id}}">{{$city->city}}</option>
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
                                            <input type="text" class="form-control" name="father_cnic" id="father-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Name</label>
                                            <input type="text" class="form-control" name="father_name" id="father-name">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Occupation</label>
                                            <input type="text" class="form-control" name="father_occupation" id="father-occupation">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Company Name</label>
                                            <input type="text" class="form-control" name="father_company_name" id="father-company-name">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Salary</label>
                                            <input type="number" class="form-control" name="father_salary" id="father-salary">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Email</label>
                                            <input type="text" class="form-control" name="father_email" id="father-email">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Phone No</label>
                                            <input type="text" class="form-control" name="father_phone" id="father-phone" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">How did you hear about us?</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="hear_about_us " id="hear-about-us">
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
                            </div>
                            <div class="card-body">
                                <h4 class="main-content-label">
                                    <input type="checkbox" name="test_group_chkbox" id="test-group-chkbox">
                                    <strong>Test Group</strong>
                                </h4>
                                <br>
                                <div class="form-row" id="test-group-row">
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="test_group_id" id="test-group-id" disabled>
                                                    <option value="">Select Test</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="main-content-label">
                                    <input type="checkbox" name="interview_group_chkbox" id="interview-group-chkbox" />
                                    <strong>Interview Group</strong>
                                </h4>
                                <br>
                                <div class="form-row" id="interview-group-row">
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="interview_group_id" id="interview-group-id" disabled>
                                                    <option value="">Select Interview</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-footer mt-2">
                                    <button type="submit" class="btn btn-primary" id="btn-add-registration">Save</button>
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