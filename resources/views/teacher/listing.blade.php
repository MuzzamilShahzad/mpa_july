@extends('layouts.app')
@section('main-content')
@section('page_title', 'Teacher')

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
                            <a href="{{ route('teacher.create') }}" class="btn btn-primary" style="float:right">Add Teacher</a>
                            <div>
                                <h1 class="main-content-label mb-1">{{ $data['menu'] }} </h1>
                            </div>
                            <br>
                            <br>
                            <br>

                            <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead>
                                        <tr>
                                            <th width="10px">S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Area</th>
                                            <th>City</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['Teacher'] as $sno => $item)
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            <td>{{ $item->teacher }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->area }}</td>
                                            <td>{{ $item->city }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td> 
                                                @if($item->is_active)
                                                <button class="btn btn-success btn-sm"> Active </button> 
                                                @else
                                                <button class="btn btn-warning btn-sm"> In Active </button> 
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('teacher.edit',$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <button data-id="{{ $item->id }}" id="btn-delete-system" class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- {{-- Own javascript --}} -->
<script src="{{ url('backend/assets/js/teacher/teacher.js') }}"></script>

@endsection
