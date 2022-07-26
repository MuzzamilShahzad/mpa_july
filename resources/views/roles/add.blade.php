@extends('layouts.app')
@section('main-content')
@section('page_title', 'Add Role')

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
                            <form action="{{ route('role.store') }}" method="POST">
                                <div class="form-group">
                                    <label class="tx-semibold">Role Name</label>
                                    <input name="role" class="form-control" type="text" placeholder="Enter Role Name" id="role">
                                </div>

                                <div class="form-group">
                                    <div class="form-label tx-semibold">Select Permission</div>
                                        <div class="custom-controls-stacked">
                                            @foreach($data["permission"] as $item)
                                            <label class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" name="permission[]" class="permission custom-control-input" value="{{ $item->id }}">
                                                <span class="custom-control-label">{{ $item->name }}</span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                                <button class="btn ripple btn-primary" id="btn-add-role" type="submit">Submit</button>
                                <a href="{{ route('role.index') }}" class="btn ripple btn-danger">Back</a>
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
<script src="{{ url('backend/assets/js/role/role.js') }}"></script>

@endsection
