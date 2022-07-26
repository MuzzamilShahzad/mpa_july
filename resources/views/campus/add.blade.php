@extends('layouts.app')
@section('main-content')
@section('page_title', 'Add Campus')

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
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div>
                                <h6 class="main-content-label">{{ $data['menu'] }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row row-sm">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <form action="{{ route('campus.store') }}" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="tx-semibold">Name</label>
                                            <input name="campus" class="form-control" type="text" placeholder="Enter Name" id="campus">
                                        </div>
                                        <div class="row system-row">
                                            <div class="row">
                                                <div class="form-group col-md-5 mb-0">
                                                    <div class="form-group">
                                                        <label class="tx-semibold">Select System</label>
                                                        <select name="system_id[]" class="form-control">
                                                            <option value="">Select System</option>
                                                            @foreach($data["systems"] as $system)
                                                                <option value="{{ $system->id }}">{{ $system->system }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5 mb-0">   
                                                    <div class="form-group">
                                                        <label class="tx-semibold">Short Name</label>
                                                        <input name="short_name[]" class="form-control" type="text" placeholder="Enter Short Name" maxlength="10" id="short_name">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-2 mb-0">
                                                    <div class="form-group">
                                                        <label class="form-label tx-semibold"> </label>
                                                        <img class="btn-add-system mt-4" id="img" alt="add-system" src="{{ url('backend/assets/img/add-icon.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                                                
                                        <div class="form-group">
                                            <label class="tx-semibold">Address</label>
                                            <div class="pos-relative">
                                                <input name="address" class="form-control pd-r-80" type="text" placeholder="Enter Address" id="address">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Phone</label>
                                            <div class="pos-relative">
                                                <input name="phone" class="form-control pd-r-80" type="text" placeholder="03XX XXXXXXX" id="phone">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="tx-semibold">Email</label>
                                            <div class="pos-relative">
                                                <input name="email" class="form-control pd-r-80" type="email" placeholder="@gmail.com" id="email">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="tx-semibold">Active Session</label>
                                            <div class="pos-relative">
                                                <input name="active_session" class="form-control pd-r-80" type="number" placeholder="0-9999" id="active_session">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="tx-semibold">Logo Upload</label>
                                            <div class="pos-relative">
                                                <input type="file" class="dropify" id="logo" height="80%" name="logo" data-height="200" />
                                            </div>
                                        </div>

                                        <button class="btn ripple btn-primary" id="btn-add-campus" type="submit">Submit</button>
                                        <a href="{{ route('campus.listing') }}" class="btn ripple btn-danger">Back</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>

<!-- {{-- Own javascript --}} -->
<script src="{{ url('backend/assets/js/campus/campus.js') }}"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

<script>
    $(":input").inputmask();
</script>

@endsection
