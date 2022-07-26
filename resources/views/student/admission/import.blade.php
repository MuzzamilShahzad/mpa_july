@extends('layouts.app')
@section('main-content')
@section('page_title', 'Import Admission')

<style>
    .chkbox-select-all-admission {
        width: 20px; 
        height: 20px;
    }
    .fa-check{
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

            
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>You have some problems in records, please fix and upload it again. <a href="{{ url('/')."/storage/".Session::get('excel_file_path') }}">click here</a></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>

            {{ Session::forget('excel_file_path') }}

            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <a href="{{ route('admission.import.store') }}" class="btn btn-primary" style="float:right">Add Admission</a>
                            <div>
                                <h1 class="main-content-label mb-1">Import Students</h1>
                            </div>
                            <br>
                            <form method="POST" action="{{ route('admission.import.store') }}" enctype="multipart/form-data">
                                @csrf
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
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <label class="form-label tx-semibold">Excel File</label>
                                            <div class="pos-relative">
                                                <input type="file" name="import_file" class="form-control" id="import-file" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-0">
                                        <div class="form-group">
                                            <button class="btn btn-primary mt-4" id="btn-import-admisisonssss"> Import </button>
                                        </div>
                                    </div>
                                </div>
                            </form>    
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>

<script src="{{ url('backend/assets/js/student/admission.js') }}"></script>

@endsection