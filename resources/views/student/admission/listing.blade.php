@extends('layouts.app')
@section('main-content')
@section('page_title', $data['page'] .' | '.$data['menu'])

<style>
    .chkbox-select-all-admission {
        width: 20px; 
        height: 20px;
    }
    .fa-check, .fa-file-excel{
        color: #19b159;
    }
    .fa-edit{
        color: #4d65d9;
    }
    .fa-trash{
        color: #ff334d;
    }
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
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <a href="{{ route('admission.create') }}" class="btn btn-primary" style="float:right">Add Admission</a>
                            <div>
                                <h1 class="main-content-label mb-1">Search Students</h1>
                            </div>
                            <br>
                            <form method="GET" action="{{ route('admission.listing') }}">
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Session</label>
                                            <div class="pos-relative">
                                                <select class="form-control session-select2" name="session_id" id="session-id">
                                                    <option value="">Select Session</option>
                                                    @foreach($data['session'] as $session)
                                                        <option value="{{$session->id}}">{{$session->session}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Campus</label>
                                            <div class="pos-relative">
                                                <select class="form-control campus-select2" name="campus_id" id="campus-id">
                                                    <option value="">Select Campus</option>
                                                    @foreach($data['campus'] as $campus)
                                                        <option value="{{$campus->id}}">{{$campus->campus}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">System</label>
                                            <div class="pos-relative">
                                                <select class="form-control system-select2" name="system_id" id="system-id" disabled>
                                                    <option value="">Select System</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class</label>
                                            <div class="pos-relative">
                                                <select class="form-control class-select2" name="class_id" id="class-id" disabled>
                                                    <option value="">Select Class</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class Group</label>
                                            <div class="pos-relative">
                                                <select class="form-control group-select2" name="group_id" id="group-id" disabled>
                                                    <option value="">Select Class Group</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Section</label>
                                            <div class="pos-relative">
                                                <select class="form-control section-select2" name="section_id" id="section-id">
                                                    <option selected value="">Select Section</option>
                                                    @foreach($data['section'] as $section)
                                                        <option value="{{$section->id}}">{{$section->section}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 mt-4">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit" id="btn-admission-search">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            <button class="btn btn-light" type="submit" id="btn-admission-excel-download">
                                                <i class="fas fa-file-excel"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>    
                            <hr style="border: 1px solid black;">
                            <div class="d-flex">
                                <h1 class="main-content-label table-heading mb-1">{{ $data['menu'] }} </h1>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="admission-listing-datatable">
                                    <thead>
                                        <tr>
                                            <th data-orderable="false" class="text-center"></th>
                                            <th data-orderable="false"> 
                                                <div class="form-check">
                                                    <input class="form-check-input chkbox-select-all-admission" type="checkbox">
                                                </div>
                                            </th>
                                            <th>Temp Gr / Gr No.</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Father Name</th>
                                            <th>Campus (System)</th>
                                            <th>Class (Group)</th>
                                            <th>Section</th>
                                            <th>Admission Date</th>
                                            <th data-orderable="false">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

            <!-- Details Modal -->
            <div class="modal fade" id="admission-details-modal" tabindex="-1" aria-labelledby="admission-details" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="admissionDetails">Admission Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admission.store') }}" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Temporary G.R</label>
                                            <input type="text" class="form-control bg-transparent" name="temporary_gr" id="temporary-gr">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">G.R</label>
                                            <input type="text" class="form-control" name="gr" id="gr">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Roll Number</label>
                                            <input type="text" class="form-control" name="roll_no" id="roll-no">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Session</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="session_id" id="session-id">
                                                    <option selected value="">Select Session</option>
                                                    @foreach($data['session'] as $session)
                                                        <option value="{{$session->id}}">{{$session->session}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Campus</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="campus_id" id="campus-id">
                                                    <option value="">Select Campus</option>
                                                    @foreach($data['campus'] as $campus)
                                                        <option value="{{$campus->id}}">{{$campus->campus}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">School System</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="system_id" id="system-id" disabled>
                                                    <option value="">Select School System</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="class_id" id="class-id" disabled>
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class Group</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="group_id" id="group-id" disabled>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Section</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="section_id" id="section-id">
                                                    <option value="">Select Section</option>
                                                    @foreach($data['section'] as $section)
                                                        <option value="{{$section->id}}">{{$section->section}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">B-Form / CRMS No </label>
                                            <input type="text" class="form-control" name="bform_crms_no" id="bform-crms-no">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first-name">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last-name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold date-picker">Date of Birth</label>
                                            <input class="form-control date-picker bg-transparent" name="dob" id="dob" placeholder="DD-MM-YYYY" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Gender</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="gender" id="gender">
                                                    <option selected value="">Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Place of Birth</label>
                                            <input type="text" class="form-control" name="place_of_birth"  id="place-of-birth">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Nationality</label>
                                            <input type="text" class="form-control" name="nationality"  id="nationality">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Tongue</label>
                                            <input type="text" class="form-control" name="mother_tongue"  id="mother-tongue">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Previous Class (IF ANY)</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="previous_class_id" id="previous-class-id">
                                                    <option value="">Select</option>
                                                    @foreach($data['class'] as $class)
                                                        <option value="{{$class->id}}">{{$class->class}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>    
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Previous School</label>
                                            <input type="text" class="form-control" name="previous_school"  id="previous-school">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mobile Number</label>
                                            <input type="text" class="form-control" name="mobile_no" id="mobile-no" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Email</label>
                                            <input type="text" class="form-control" name="email"  id="email">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold date-picker">Admission Date</label>
                                            <input class="form-control date-picker bg-transparent" name="admission_date" id="admission-date" placeholder="DD-MM-YYYY" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Blood Group</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="blood_group" id="blood-group">
                                                    <option selected value="">Select Blood Group</option>
                                                    <option value="O+">O+</option>
                                                    <option value="A+">A+</option>
                                                    <option value="B+">B+</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Height</label>
                                            <input type="number" class="form-control" name="height" id="height" min="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <!-- <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">School House</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="school_house_id" id="school-house-id">
                                                    <option selected value="">Select School House</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Weight</label>
                                            <input type="number" class="form-control" name="weight" id="weight" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold date-picker">As on Date</label>
                                            <input class="form-control date-picker bg-transparent" name="as_on_date" id="as-on-date" placeholder="DD-MM-YYYY" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Fee Discount</label>
                                            <input type="number" class="form-control" name="fee_discount"  id="fee-discount" min="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Religion</label>
                                            <input type="text" class="form-control" name="religion"  id="religion">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Select Religion Type</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="religion_type" id="religion-type">
                                                    <option selected value="">Select Religion Type</option>
                                                    <option value="sunni">Sunni</option>
                                                    <option value="asna_ashri">Asna Ashri</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group" id="religion-type-other-input">
                                            <label class="form-label tx-semibold">Other</label>
                                            <input type="text" class="form-control" name="religion_type_other" id="religion-type-other" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Is there any sibling currently studying in MPA ?</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="siblings_in_mpa" id="siblings-in-mpa">
                                                    <option selected value="">Select</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">No. of Siblings</label>
                                            <input type="number" class="form-control" name="no_of_siblings"  id="no-of-siblings">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Student Vaccinated</label>
                                            <div class="btn-list radiobtns radio-btn">
                                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="student_vaccinated" id="student-vaccinated-yes" value="yes" checked>
                                                    <label class="btn btn-outline-primary" for="student-vaccinated-yes">Yes</label>

                                                    <input type="radio" class="btn-check" name="student_vaccinated" id="student-vaccinated-no" value="no">
                                                    <label class="btn btn-outline-primary" for="student-vaccinated-no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6 class="main-content-label">Parent Guardian Detail</h6>
                                <hr style="border: 1px solid black;">
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father CNIC Number</label>
                                            <input type="text" class="form-control" name="father_cnic" id="father-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Salary</label>
                                            <input type="number" class="form-control" name="father_salary" id="father-salary">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Email</label>
                                            <input type="text" class="form-control" name="father_email" id="father-email">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Name</label>
                                            <input type="text" class="form-control" name="father_name" id="father-name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Phone No</label>
                                            <input type="text" class="form-control" name="father_phone"  id="father-phone" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Occupation</label>
                                            <input type="text" class="form-control" name="father_occupation"  id="father-occupation">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Company Name</label>
                                            <input type="text" class="form-control" name="father_company_name" id="father-company-name">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Vaccinated</label>
                                            <div class="btn-list radiobtns radio-btn">
                                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="father_vaccinated" id="father-vaccinated-yes" value="yes" checked>
                                                    <label class="btn btn-outline-primary" for="father-vaccinated-yes">Yes</label>

                                                    <input type="radio" class="btn-check" name="father_vaccinated" id="father-vaccinated-no" value="no">
                                                    <label class="btn btn-outline-primary" for="father-vaccinated-no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother CNIC Number</label>
                                            <input type="text" class="form-control" name="mother_cnic" id="mother-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Salary</label>
                                            <input type="number" class="form-control" name="mother_salary" id="mother-salary">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Email</label>
                                            <input type="text" class="form-control" name="mother_email" id="mother-email">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Name</label>
                                            <input type="text" class="form-control" name="mother_name" id="mother-name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Phone No</label>
                                            <input type="text" class="form-control" name="mother_phone"  id="mother-phone" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Occupation</label>
                                            <input type="text" class="form-control" name="mother_occupation"  id="mother-occupation">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Company Name</label>
                                            <input type="text" class="form-control" name="mother_company_name" id="mother-company-name">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Vaccinated</label>

                                            <div class="btn-list radiobtns radio-btn">
                                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="mother_vaccinated" id="mother-vaccinated-yes" value="yes" checked>
                                                    <label class="btn btn-outline-primary" for="mother-vaccinated-yes">Yes</label>

                                                    <input type="radio" class="btn-check" name="mother_vaccinated" id="mother-vaccinated-no" value="no">
                                                    <label class="btn btn-outline-primary" for="mother-vaccinated-no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Guardian CNIC</label>
                                            <input type="text" class="form-control" name="guardian_cnic" id="guardian-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Guardian Name</label>
                                            <input type="text" class="form-control" name="guardian_name" id="guardian-name">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Guardian Phone</label>
                                            <input type="text" class="form-control" name="guardian_phone" id="guardian-phone" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Select Guardian Relation</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="guardian_relation" id="guardian-relation">
                                                    <option value="">Select Religion Type</option>
                                                    <option value="uncle_aunty">Uncle/Aunty</option>
                                                    <option value="grandfather_grandmother">GrandFather/GrandMother</option>
                                                    <option value="neighbours">Neighbours</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group" id="guardian-relation-other-input">
                                            <label class="form-label tx-semibold">Other</label>
                                            <input type="text" class="form-control" name="guardian_relation_other" id="guardian-relation-other" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">First Person to call in case of Emergency</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="first_person_call" id="first-person-call">
                                                    <option selected value="">Select Person To Call</option>
                                                    <option value="father">Father</option>
                                                    <option value="mother">Mother</option>
                                                    <option value="guardian">Guardian</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6 class="main-content-label">Address Details</h6>
                                <hr style="border: 1px solid black;">
                                <h6 class="main-content-label">Current Address</h6>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">House / Apartment Number</label>
                                            <input type="text" class="form-control" name="current_house_no" id="current-house-no">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Block Number</label>
                                            <input type="text" class="form-control" name="current_block_no" id="current-block-no">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Building Name/Number (If ANY)</label>
                                            <input type="text" class="form-control" name="current_building_name_no"  id="current-building-name-no">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Area</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="current_area_id " id="current-area-id">
                                                    <option selected value="">Select Area</option>
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
                                                <select class="form-control select2" name="current_city_id " id="current-city-id">
                                                    <option value="">Select City</option>
                                                    @foreach($data['city'] as $city)
                                                        <option value="{{$city->id}}">{{$city->city}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-0">
                                        <h6 class="main-content-label">Permanent Address</h6>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-check form-check-inline">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="same_as_current" id="same-as-current" checked>
                                                <span class="custom-control-label"><strong> Same As Current Address </strong></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">House / Apartment Number</label>
                                            <input type="text" class="form-control" name="permanent_house_no" id="permanent-house-no" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Block Number</label>
                                            <input type="text" class="form-control" name="permanent_block_no" id="permanent-block-no" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Building Name/Number (If ANY)</label>
                                            <input type="text" class="form-control" name="permanent_building_name_no"  id="permanent-building-name-no" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Area</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="permanent_area_id" id="permanent-area-id" disabled>
                                                    <option selected value="">Select Area</option>
                                                    @foreach($data['area'] as $area)
                                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">City</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="permanent_city_id" id="permanent-city-id" disabled>
                                                    <option value="">Select City</option>
                                                    @foreach($data['city'] as $city)
                                                        <option value="{{$city->id}}">{{$city->city}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6 class="main-content-label">Pick up / Drop off Transport Details</h6>
                                <hr style="border: 1px solid black;">
                                <div class="form-row">
                                    <div class="form-group col-md-12 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Select Pick up / Drop off Transport Details</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="pick_and_drop" id="pick-and-drop">
                                                    <option value="">Select Pick/Drop</option>
                                                    <option value="by_walk">By Walk</option>
                                                    <option value="by_ride">By Ride</option>
                                                    <option value="by_school_van">School Van</option>
                                                    <option value="by_private_van">Private Van</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer mt-2">
                                    <button type="submit" class="btn btn-primary" id="btn-add-admission">Save</button>
                                    <a href="{{ route('admission.listing') }}" class="btn btn-danger">Back</a>
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

            <!-- Promote Student Modal -->
            <div class="modal fade" id="promote-student-modal" tabindex="-1" aria-labelledby="promoteStudent" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="promoteStudent">Promotion Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admission.promote') }}" method="POST" id="promotion-form">
                                <div class="row">

                                    <h4 class="main-content-label mb-3"> <strong>Student</strong></h4>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="session-id" class="form-label tx-semibold">Session</label>
                                            <select name="session_id" id="session-id" class="form-control sessionSelect2">
                                                <option value="">Select Session</option>
                                                @foreach($data['session'] as $session)
                                                <option value="{{$session->id}}">{{$session->session}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="campus-id" class="form-label tx-semibold">Campus</label>
                                            <input type="hidden" name="id" id="record-id" class="form-control" />
                                            <select name="campus_id" id="campus-id" class="form-control campusSelect2">
                                                <option value="">Select Campus</option>
                                                @foreach($data['campus'] as $campus)
                                                <option value="{{$campus->id}}">{{$campus->campus}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="school-id" class="form-label tx-semibold">School System</label>
                                            <select name="system_id" id="system-id" class="form-control systemSelect2" disabled>
                                                <option value="">Select School System</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="class-id" class="form-label tx-semibold">Class</label>
                                            <select name="class_id" id="class-id" class="form-control classSelect2" disabled>
                                                <option value="">Select Class</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="class-group-id" class="form-label tx-semibold">Class Group</label>
                                            <select name="group_id" id="group-id" class="form-control classGroupSelect2" disabled>
                                                <option value="">Class Group</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="section-id" class="form-label tx-semibold">Section</label>
                                            <select name="section_id" id="section-id" class="form-control classGroupSelect2">
                                                <option value="">Select Section</option>
                                                @foreach($data['section'] as $section)
                                                    <option value="{{$section->id}}">{{$section->section}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row mt-3">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="class-group-id" class="form-label tx-semibold">Section</label>
                                            <select name="section_id" id="section-id" class="form-control classGroupSelect2" disabled>
                                                <option value="">Select Section</option>
                                                @foreach($data['section'] as $section)
                                                    <option value="{{$section->id}}">{{$section->section}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- <div class="row mt-3">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Section</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="section_id" id="section-id">
                                                    <option value="">Select Section</option>
                                                    @foreach($data['section'] as $section)
                                                        <option value="{{$section->id}}">{{$section->section}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Close </button>
                            <button type="button" class="btn btn-primary" id="btn-save-promotion"> Save Details</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Fees Sticker Modal -->
            <div class="modal fade" id="print-sticker-modal" tabindex="-1" aria-labelledby="print-sticker-modal" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="print-sticker-modal">Fees Stickers</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="print-sticker-modal-body">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Close </button>
                            <button type="button" class="btn btn-info" id="btn-print-sticker-modal-body"> Print </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('backend/assets/js/student/admission.js') }}"></script>

@endsection