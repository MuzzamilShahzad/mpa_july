@extends('layouts.app')
@section('main-content')
@section('page_title', 'Add Permission')

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
                            <form action="{{ route('permission.store') }}" method="POST">
                                <div class="form-group">
                                    <label class="tx-semibold">Permission Name</label>
                                    <input name="permission" class="form-control" type="text" placeholder="Enter Permission Name" id="permission">
                                </div>
                                
                                <button class="btn ripple btn-primary" id="btn-add-permission" type="submit">Submit</button>
                                <a href="{{ route('permission.index') }}" class="btn ripple btn-danger">Back</a>
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
<script src="{{ url('backend/assets/js/permission/permission.js') }}"></script>

@endsection
