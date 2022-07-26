@extends('layouts.app')
@section('main-content')
@section('page_title', $data['page'] .' | '.$data['menu'])

<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">
            <!-- Page Header -->
            <a href="{{ route('admission.import') }}" class="btn btn-primary" style="float:right">Import</a>
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
                        <form action="{{ route('admission.update') }}" method="post">
                            <input type="hidden" id="id" name="id" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->id) ? $data['admission']->id: '') : ''}}">
                            <div class="card-body" id="after-form-store-msg">
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Temporary G.R</label>
                                            <input type="text" class="form-control bg-transparent" name="temporary_gr" id="temporary-gr" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->temporary_gr) ? $data['admission']->temporary_gr : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">G.R</label>
                                            <input type="text" class="form-control" name="gr" id="gr" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->gr) ? $data['admission']->gr : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Roll Number</label>
                                            <input type="text" class="form-control" name="roll_no" id="roll-no" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->roll_no) ? $data['admission']->roll_no : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Session</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="session_id" id="session-id">
                                                    <option selected value="">Select Session</option>
                                                    @foreach($data['session'] as $session)
                                                        <option value="{{$session->id}}" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->session_id) ? 'selected' : '') : ''}}>{{$session->session}}</option>
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
                                                        <option value="{{$campus->id}}" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->campus_id) && $data['admission']->campus_id == $campus->id ? 'selected' : '') : ''}}>{{$campus->campus}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">School System</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="system_id" id="system-id" {{ isset($data['admission']) && !empty($data['admission']) ? ( !isset($data['admission']->system_id) ? 'disabled' : '') : 'disabled'}}>
                                                    <option value="">Select School System</option>
                                                    @foreach($data['system'] as $system)
                                                        <option value="{{$system->id}}" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->system_id) && $data['admission']->system_id == $system->id ? 'selected' : '') : ''}}>{{$system->system}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="class_id" id="class-id" {{ isset($data['admission']) && !empty($data['admission']) ? ( !isset($data['admission']->class_id) ? 'disabled' : '') : 'disabled'}}>
                                                    <option value="">Select</option>
                                                    @foreach($data['campus_class'] as $class)
                                                        <option value="{{$class->id}}" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->class_id) && $data['admission']->class_id == $class->id ? 'selected' : '') : ''}}>{{$class->class}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Class Group</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="group_id" id="group-id" {{ isset($data['admission']) && !empty($data['admission']) ? ( !isset($data['admission']->group_id) ? 'disabled' : '') : 'disabled'}}>
                                                    <option value="">Select</option>
                                                    @foreach($data['group'] as $group)
                                                        <option value="{{$group->id}}" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->group_id) && $data['admission']->group_id == $group->id ? 'selected' : '') : ''}}>{{$group->group}}</option>
                                                    @endforeach
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
                                                        <option value="{{$section->id}}" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->section_id) && $data['admission']->section_id == $section->id ? 'selected' : '') : ''}}>{{$section->section}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">B-Form / CRMS No </label>
                                            <input type="text" class="form-control" name="bform_crms_no" id="bform-crms-no"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->bform_crms_no) ? $data['admission']->bform_crms_no : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first-name"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->first_name) ? $data['admission']->first_name : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last-name" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->last_name) ? $data['admission']->last_name : '') : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold date-picker">Date of Birth</label>
                                            <input class="form-control date-picker bg-transparent" name="dob" id="dob" placeholder="DD-MM-YYYY" type="text" readonly value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->dob) ? date('d-m-Y',strtotime($data['admission']->dob)) : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Gender</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="gender" id="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="male" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->gender) && $data['admission']->gender == 'male' ? 'selected' : '') : ''}}>Male</option>
                                                    <option value="female" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->gender) && $data['admission']->gender == 'female' ? 'selected' : '') : ''}}>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Place of Birth</label>
                                            <input type="text" class="form-control" name="place_of_birth"  id="place-of-birth"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->place_of_birth) ? $data['admission']->place_of_birth : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Nationality</label>
                                            <input type="text" class="form-control" name="nationality"  id="nationality" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->nationality) ? $data['admission']->nationality : '') : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Tongue</label>
                                            <input type="text" class="form-control" name="mother_tongue"  id="mother-tongue"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ($data['admission']->mother_tongue) ? $data['admission']->mother_tongue : '' : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Previous Class (IF ANY)</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="previous_class_id" id="previous-class-id">
                                                    <option value="">Select</option>
                                                    @foreach($data['class'] as $class)
                                                        <option value="{{$class->id}}" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->previous_class_id) && $data['admission']->previous_class_id == $class->id ? 'selected' : '') : ''}}>{{$class->class}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>    
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Previous School</label>
                                            <input type="text" class="form-control" name="previous_school"  id="previous-school" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->previous_school) ? $data['admission']->previous_school : '') : ''}}">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mobile Number</label>
                                            <input type="text" class="form-control" name="mobile_no" id="mobile-no" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->mobile_no) ? $data['admission']->mobile_no : '') : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Email</label>
                                            <input type="text" class="form-control" name="email"  id="email"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->email) ? $data['admission']->email : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold date-picker">Admission Date</label>
                                            <input class="form-control date-picker bg-transparent" name="admission_date" id="admission-date" placeholder="DD-MM-YYYY" type="text" readonly  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->admission_date) ? date('d-m-Y',strtotime($data['admission']->admission_date)) : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Blood Group</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="blood_group" id="blood-group">
                                                    <option selected value="">Select Blood Group</option>
                                                    <option value="O+"  {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->blood_group) && $data['admission']->blood_group == 'O+' ? 'selected' : '') : ''}}>O+</option>
                                                    <option value="A+"  {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->blood_group) && $data['admission']->blood_group == 'A+' ? 'selected' : '') : ''}}>A+</option>
                                                    <option value="B+"  {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->blood_group) && $data['admission']->blood_group == 'B+' ? 'selected' : '') : ''}}>B+</option>
                                                    <option value="AB+" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->blood_group) && $data['admission']->blood_group == 'AB+' ? 'selected' : '') : ''}}>AB+</option>
                                                    <option value="O-"  {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->blood_group) && $data['admission']->blood_group == 'O-' ? 'selected' : '') : ''}}>O-</option>
                                                    <option value="A-"  {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->blood_group) && $data['admission']->blood_group == 'A-' ? 'selected' : '') : ''}}>A-</option>
                                                    <option value="B-"  {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->blood_group) && $data['admission']->blood_group == 'B-' ? 'selected' : '') : ''}}>B-</option>
                                                    <option value="AB-" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->blood_group) && $data['admission']->blood_group == 'AB-' ? 'selected' : '') : ''}}>AB-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Height</label>
                                            <input type="number" class="form-control" name="height" id="height" min="0"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->height) ? $data['admission']->height : '') : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Weight</label>
                                            <input type="number" class="form-control" name="weight" id="weight" min="0"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->weight) ? $data['admission']->weight : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold date-picker">As on Date</label>
                                            <input class="form-control date-picker bg-transparent" name="as_on_date" id="as-on-date" placeholder="DD-MM-YYYY" type="text" readonly value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->as_on_date) ? date('d-m-Y',strtotime($data['admission']->as_on_date)) : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Fee Discount</label>
                                            <input type="number" class="form-control" name="fee_discount"  id="fee-discount" min="0"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->fee_discount) ? $data['admission']->fee_discount : '') : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Religion</label>
                                            <input type="text" class="form-control" name="religion"  id="religion"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->religion) ? $data['admission']->religion : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Select Religion Type</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="religion_type" id="religion-type">
                                                    <option selected value="">Select Religion Type</option>
                                                    <option value="sunni"      {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->religion_type) && $data['admission']->religion_type == 'sunni' ? 'selected' : '') : ''}}>Sunni</option>
                                                    <option value="asna_ashri" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->religion_type) && $data['admission']->religion_type == 'asna_ashri' ? 'selected' : '') : ''}}>Asna Ashri</option>
                                                    <option value="other"      {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->religion_type) && $data['admission']->religion_type == 'other' ? 'selected' : '') : ''}}>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group" id="religion-type-other-input">
                                            <label class="form-label tx-semibold">Other</label>
                                            <input type="text" class="form-control" name="religion_type_other" id="religion-type-other" disabled  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->religion_type_other) ? $data['admission']->religion_type_other : '') : ''}}">
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
                                                    <option value="yes" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->siblings_in_mpa) && $data['admission']->siblings_in_mpa == 'yes' ? 'selected' : '') : ''}}>Yes</option>
                                                    <option value="no"  {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->siblings_in_mpa) && $data['admission']->siblings_in_mpa == 'no' ? 'selected' : '') : ''}}>No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">No. of Siblings</label>
                                            <input type="number" class="form-control" name="no_of_siblings"  id="no-of-siblings"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->no_of_siblings_in_mpa) ? $data['admission']->no_of_siblings_in_mpa : '') : ''}}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Student Vaccinated</label>
                                            <div class="btn-list radiobtns radio-btn">
                                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="student_vaccinated" id="student-vaccinated-yes" value="yes" checked>
                                                    <label class="btn btn-outline-primary" for="student-vaccinated-yes">Yes</label>

                                                    <input type="radio" class="btn-check" name="student_vaccinated" id="student-vaccinated-no" value="no"  {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->student_vaccinated) && $data['admission']->student_vaccinated == 'no' ? 'checked' : '') : ''}}>
                                                    <label class="btn btn-outline-primary" for="student-vaccinated-no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header d-flex">
                                <h6 class="main-content-label">Parent Guardian Detail</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father CNIC Number</label>
                                            <input type="text" class="form-control" name="father_cnic" id="father-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->father_details->cnic) ? $data['admission']->father_details->cnic : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Salary</label>
                                            <input type="number" class="form-control" name="father_salary" id="father-salary"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->father_details->salary) ? $data['admission']->father_details->salary : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Email</label>
                                            <input type="text" class="form-control" name="father_email" id="father-email" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->father_details->email) ? $data['admission']->father_details->email : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Name</label>
                                            <input type="text" class="form-control" name="father_name" id="father-name"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->father_details->name) ? $data['admission']->father_details->name : '') : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Phone No</label>
                                            <input type="text" class="form-control" name="father_phone"  id="father-phone" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->father_details->phone) ? $data['admission']->father_details->phone : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Occupation</label>
                                            <input type="text" class="form-control" name="father_occupation"  id="father-occupation"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->father_details->occupation) ? $data['admission']->father_details->occupation : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Company Name</label>
                                            <input type="text" class="form-control" name="father_company_name" id="father-company-name"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->father_details->company_name) ? $data['admission']->father_details->company_name : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Father Vaccinated</label>
                                            <div class="btn-list radiobtns radio-btn">
                                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="father_vaccinated" id="father-vaccinated-yes" value="yes" checked>
                                                    <label class="btn btn-outline-primary" for="father-vaccinated-yes">Yes</label>

                                                    <input type="radio" class="btn-check" name="father_vaccinated" id="father-vaccinated-no" value="no"  {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->father_vaccinated) && $data['admission']->father_vaccinated == 'no' ? 'checked' : '') : ''}}>
                                                    <label class="btn btn-outline-primary" for="father-vaccinated-no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr style="border: 1px solid black;">
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother CNIC Number</label>
                                            <input type="text" class="form-control" name="mother_cnic" id="mother-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->mother_details->cnic) ? $data['admission']->mother_details->cnic : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Salary</label>
                                            <input type="number" class="form-control" name="mother_salary" id="mother-salary"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->mother_details->salary) ? $data['admission']->mother_details->salary : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Email</label>
                                            <input type="text" class="form-control" name="mother_email" id="mother-email" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->mother_details->email) ? $data['admission']->mother_details->email : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Name</label>
                                            <input type="text" class="form-control" name="mother_name" id="mother-name" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->mother_details->name) ? $data['admission']->mother_details->name : '') : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Phone No</label>
                                            <input type="text" class="form-control" name="mother_phone"  id="mother-phone" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->mother_details->phone) ? $data['admission']->mother_details->phone : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Occupation</label>
                                            <input type="text" class="form-control" name="mother_occupation"  id="mother-occupation"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->mother_details->occupation) ? $data['admission']->mother_details->occupation : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Company Name</label>
                                            <input type="text" class="form-control" name="mother_company_name" id="mother-company-name"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->mother_details->company_name) ? $data['admission']->mother_details->company_name : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Mother Vaccinated</label>

                                            <div class="btn-list radiobtns radio-btn">
                                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="mother_vaccinated" id="mother-vaccinated-yes" value="yes" checked>
                                                    <label class="btn btn-outline-primary" for="mother-vaccinated-yes">Yes</label>

                                                    <input type="radio" class="btn-check" name="mother_vaccinated" id="mother-vaccinated-no" value="no"  {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->mother_vaccinated) && $data['admission']->mother_vaccinated == 'no' ? 'checked' : '') : ''}}>
                                                    <label class="btn btn-outline-primary" for="mother-vaccinated-no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr style="border: 1px solid black;">
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Guardian CNIC</label>
                                            <input type="text" class="form-control" name="guardian_cnic" id="guardian-cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->guardian_details->cnic) ? $data['admission']->guardian_details->cnic : '') : ''}}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Guardian Name</label>
                                            <input type="text" class="form-control" name="guardian_name" id="guardian-name"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->guardian_details->name) ? $data['admission']->guardian_details->name : '') : ''}}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Guardian Phone</label>
                                            <input type="text" class="form-control" name="guardian_phone" id="guardian-phone" data-inputmask="'mask': '03##-#######'" placeholder="03##-#######"  value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->guardian_details->phone) ? $data['admission']->guardian_details->phone : '') : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Select Guardian Relation</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="guardian_relation" id="guardian-relation">
                                                    <option selected value="">Select Religion Type</option>
                                                    <option value="uncle_aunty"              {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->guardian_relation->relation) && $data['admission']->guardian_relation->relation == 'uncle_aunty'             ? 'selected' : '') : ''}}>Uncle/Aunty</option>
                                                    <option value="grandfather_grandmother"  {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->guardian_relation->relation) && $data['admission']->guardian_relation->relation == 'grandfather_grandmother' ? 'selected' : '') : ''}}>GrandFather/GrandMother</option>
                                                    <option value="neighbours"               {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->guardian_relation->relation) && $data['admission']->guardian_relation->relation == 'neighbours'              ? 'selected' : '') : ''}}>Neighbours</option>
                                                    <option value="other"                    {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->guardian_relation->relation) && $data['admission']->guardian_relation->relation == 'other'                   ? 'selected' : '') : ''}}>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group" id="guardian-relation-other-input">
                                            <label class="form-label tx-semibold">Other</label>
                                            <input type="text" class="form-control" name="guardian_relation_other" id="guardian-relation-other" {{ isset($data['admission']) && !empty($data['admission']) ? ( !isset($data['admission']->guardian_relation->other_relation) ? 'disabled' : '') : 'disabled'}} value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->guardian_relation->other_relation)  ? $data['admission']->guardian_relation->other_relation : '') : ''}}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">First Person to call in case of Emergency</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="first_person_call" id="first-person-call">
                                                    <option selected value="">Select Person To Call</option>
                                                    <option value="father"   {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->guardian_details->first_person_call) && $data['admission']->guardian_details->first_person_call == 'father'    ? 'selected' : '') : ''}}>Father</option>
                                                    <option value="mother"   {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->guardian_details->first_person_call) && $data['admission']->guardian_details->first_person_call == 'mother'    ? 'selected' : '') : ''}}>Mother</option>
                                                    <option value="guardian" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->guardian_details->first_person_call) && $data['admission']->guardian_details->first_person_call == 'guardian'  ? 'selected' : '') : ''}}>Guardian</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header d-flex">
                                <h6 class="main-content-label">Address Details</h6>
                            </div>
                            <div class="card-body">
                                <h6 class="main-content-label">Current Address</h6>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">House / Apartment Number</label>
                                            <input type="text" class="form-control" name="current_house_no" id="current-house-no" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->current_address->current_house_no) ? $data['admission']->address_details->current_address->current_house_no : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Block Number</label>
                                            <input type="text" class="form-control" name="current_block_no" id="current-block-no" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->current_address->current_block_no) ? $data['admission']->address_details->current_address->current_block_no : '') : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Building Name/Number (If ANY)</label>
                                            <input type="text" class="form-control" name="current_building_name_no"  id="current-building-name-no" value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->current_address->current_building_name_no) ? $data['admission']->address_details->current_address->current_building_name_no : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Area</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="current_area_id " id="current-area-id">
                                                    <option selected value="">Select Area</option>
                                                    @foreach($data['area'] as $area)
                                                        <option value="{{$area->id}}" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->current_address->current_area_id) && $data['admission']->address_details->current_address->current_area_id == $area->id ? 'selected': '') : ''}}>{{$area->area}}</option>
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
                                                        <option value="{{$city->id}}" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->current_address->current_city_id) && $data['admission']->address_details->current_address->current_city_id == $city->id ? 'selected': '') : ''}}>{{$city->city}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr style="border: 1px solid black;">
                                <br>
                                <div class="form-row">
                                    <div class="col-md-6 mb-0">
                                        <h6 class="main-content-label">Permanent Address</h6>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-check form-check-inline">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="same_as_current" id="same-as-current" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->same_as_current->same_as_current) && $data['admission']->address_details->same_as_current->same_as_current == 'yes' ? 'checked' : '') : ''}}>
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
                                            <input type="text" class="form-control" name="permanent_house_no" id="permanent-house-no"          {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->same_as_current->same_as_current) && $data['admission']->address_details->same_as_current->same_as_current == 'yes' ? 'disabled' : '') : ''}} value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->permanent_address->permanent_house_no) && $data['admission']->address_details->same_as_current->same_as_current == 'no' ? $data['admission']->address_details->permanent_address->permanent_house_no : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Block Number</label>
                                            <input type="text" class="form-control" name="permanent_block_no" id="permanent-block-no" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->same_as_current->same_as_current) && $data['admission']->address_details->same_as_current->same_as_current == 'yes' ? 'disabled' : '') : ''}} value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->permanent_address->permanent_house_no) && $data['admission']->address_details->same_as_current->same_as_current == 'no' ? $data['admission']->address_details->permanent_address->permanent_house_no : '') : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Building Name/Number (If ANY)</label>
                                            <input type="text" class="form-control" name="permanent_building_name_no"  id="permanent-building-name-no" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->same_as_current->same_as_current) && $data['admission']->address_details->same_as_current->same_as_current == 'yes' ? 'disabled' : '') : ''}} value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->permanent_address->permanent_house_no) && $data['admission']->address_details->same_as_current->same_as_current == 'no' ? $data['admission']->address_details->permanent_address->permanent_house_no : '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Area</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="permanent_area_id" id="permanent-area-id" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->same_as_current->same_as_current) && $data['admission']->address_details->same_as_current->same_as_current == 'yes' ? 'disabled' : '') : ''}} value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->permanent_address->permanent_house_no) && $data['admission']->address_details->same_as_current->same_as_current == 'no' ? $data['admission']->address_details->permanent_address->permanent_house_no : '') : ''}}">
                                                    <option selected value="">Select Area</option>
                                                    @foreach($data['area'] as $area)
                                                        <option value="{{$area->id}}" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->permanent_address->permanent_area_id) && $data['admission']->address_details->permanent_address->permanent_area_id == $area->id && $data['admission']->address_details->same_as_current->same_as_current == 'no' ? 'selected' : '') : ''}}>{{$area->area}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">City</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="permanent_city_id" id="permanent-city-id" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->same_as_current->same_as_current) && $data['admission']->address_details->same_as_current->same_as_current == 'yes' ? 'disabled' : '') : ''}} value="{{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->permanent_address->current_house_no) && $data['admission']->address_details->same_as_current->same_as_current == 'no' ? $data['admission']->address_details->permanent_address->current_house_no : '') : ''}}">
                                                    <option value="">Select City</option>
                                                    @foreach($data['city'] as $city)
                                                        <option value="{{$city->id}}" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->address_details->permanent_address->permanent_city_id) && $data['admission']->address_details->permanent_address->permanent_city_id == $city->id && $data['admission']->address_details->same_as_current->same_as_current == 'no' ? 'selected' : '') : ''}}>{{$city->city}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header d-flex">
                                <h6 class="main-content-label">Pick up / Drop off Transport Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Select Pick up / Drop off Transport Details</label>
                                            <div class="pos-relative">
                                                <select class="form-control select2" name="pick_and_drop" id="pick-and-drop">
                                                    <option value="">Select Pick/Drop</option>
                                                    <option value="by_walk"        {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->pick_and_drop) && $data['admission']->pick_and_drop == 'by_walk'         ? 'selected' : '') : ''}}>By Walk</option>
                                                    <option value="by_ride"        {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->pick_and_drop) && $data['admission']->pick_and_drop == 'by_ride'         ? 'selected' : '') : ''}}>By Ride</option>
                                                    <option value="by_school_van"  {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->pick_and_drop) && $data['admission']->pick_and_drop == 'by_school_van'   ? 'selected' : '') : ''}}>School Van</option>
                                                    <option value="by_private_van" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->pick_and_drop) && $data['admission']->pick_and_drop == 'by_private_van'  ? 'selected' : '') : ''}}>Private Van</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($data['admission']) && !empty($data['admission']) && isset($data['admission']->pick_and_drop) && $data['admission']->pick_and_drop == 'by_ride')
                                    <div class="form-row" id="pick-drop-details-row">
                                        <div class="form-group col-md-12 mb-0">
                                            <label class="form-label tx-semibold">Vehicle No</label>
                                            <input type="text" class="form-control" name="vehicle_no" id="vehicle-no">
                                        </div>
                                    </div>
                                @elseif(isset($data['admission']) && !empty($data['admission']) && isset($data['admission']->pick_and_drop) && in_array($data['admission']->pick_and_drop, ['by_school_van','by_private_van']))
                                    <div class="form-row" id="pick-drop-details-row">
                                        <div class="form-group col-md-12 mb-0">
                                            <div class="form-group">
                                                <label class="form-label tx-semibold">Select Vehicle</label>
                                                <div class="pos-relative">
                                                    <select class="form-control select2" name="vehicle_id" id="vehicle-id">
                                                        <option value="">Select Vehicle</option>
                                                        @foreach($data['vehicle'] as $vehicle)
                                                            <option value="{{$vehicle->id}}" {{ isset($data['admission']) && !empty($data['admission']) ? ( isset($data['admission']->vehicle_id) && $data['admission']->vehicle_id == $vehicle->id ? 'selected' : '') : ''}}> {{$vehicle->number.' [ '.$vehicle->maker. ' ]' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-footer mt-2">
                                    <button type="submit" class="btn btn-primary" id="btn-edit-admission">Save</button>
                                    <a href="{{ route('admission.listing') }}" class="btn btn-danger">Back</a>
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
<script src="{{ url('backend/assets/js/student/admission.js') }}"></script>

<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

<script>
    $(":input").inputmask();
</script>

@endsection
