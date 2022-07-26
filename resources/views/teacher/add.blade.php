@extends('layouts.app')
@section('main-content')
@section('page_title', 'Add Teacher')

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
                <div class="col-lg-6 col-md-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div>
                                <h6 class="main-content-label">{{ $data['menu'] }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('teacher.store') }}" method="POST">
                                <div class="form-group">
                                    <label class="tx-semibold">Teacher Name</label>
                                    <input name="teacher" class="form-control" type="text" placeholder="Enter Teacher Name" id="teacher">
                                </div>
                                <div class="form-group">
                                    <label class="tx-semibold">Email</label>
                                    <input name="email" class="form-control" type="email" placeholder="Enter Teacher Email" id="email">
                                </div>
                                <div class="form-group">
                                    <label class="tx-semibold">Phone</label>
                                    <input name="phone" class="form-control" type="text" data-inputmask="'mask': '03##-#######'" placeholder="Enter Teacher Phone" id="phone">
                                </div>
                                <div class="form-group">
                                    <label class="tx-semibold">Select Area</label>
                                    <select name="area" id="area" class="form-control select2">
                                        @foreach($data['areas'] as $key => $area)
                                        <option value="{{ $key }}"> {{ $area->area }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="tx-semibold">Select City</label>
                                    <select name="city" id="city" class="form-control select2">
                                        @foreach($data['cities'] as $key => $city)
                                            <option value="{{ $key }}">{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="tx-semibold">Address</label>
                                    <input name="address" class="form-control" type="text" placeholder="Enter Address" id="address">
                                </div>
                                <button class="btn ripple btn-primary" id="btn-add-teacher" type="submit">Submit</button>
                                <a href="{{ route('teacher.index') }}" class="btn ripple btn-danger">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>

<!-- {{-- Own javascript --}} -->
<script src="{{ url('backend/assets/js/teacher/teacher.js') }}"></script>

@endsection
