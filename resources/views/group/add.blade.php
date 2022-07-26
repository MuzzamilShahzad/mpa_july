@extends('layouts.app')
@section('main-content')
@section('page_title', 'Add Group')

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
                                    <form action="{{ route('group.store') }}" method="post">
                                        <div class="form-group">
                                            <label class="tx-semibold">Group Name</label>
                                            <input name="group" class="form-control" type="text" placeholder="Enter Class Group Name" id="group">
                                        </div>

                                        <button class="btn ripple btn-primary" id="btn-add-group" type="submit">Submit</button>
                                        <a href="{{ route('group.view') }}" class="btn ripple btn-danger">Back</a>
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
<script src="{{ url('backend/assets/js/group/group.js') }}"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

<script>
    $(":input").inputmask();
</script>

@endsection
