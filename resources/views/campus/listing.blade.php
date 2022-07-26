@extends('layouts.app')
@section('main-content')
@section('page_title', 'Campus')
<style>
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
                        <a href="{{ route('campus.create') }}" class="btn btn-primary" style="float:right">Add Campus</a>
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
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <!-- <th>Status</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['campus'] as $key => $campus)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $campus->campus }}</td>
                                            <!-- <td> 
                                                @if($campus->is_active)
                                                <button class="btn btn-success btn-sm"> Active </button> 
                                                @else
                                                <button class="btn btn-warning btn-sm"> In Active </button> 
                                                @endif
                                            </td> -->
                                            <td>
                                                <a href="{{ route('campus.edit',$campus->id) }}">
                                                    <i class="fas fa-edit" id="btn-edit-campus" data-id="{{ $campus->id }}" title="Edit"></i> 
                                                </a>
                                                <!-- <a href="{{ route('campus.edit',$campus->id) }}" class="btn btn-primary btn-sm">Edit</a> -->
                                                <!-- <button data-id="{{ $campus->id }}" id="btn-delete-campus" class="btn btn-danger btn-sm">Delete</button> -->
                                                <i class="fas fa-trash" id="btn-delete-campus" data-id="{{ $campus->id }}" title="Delete"></i>
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
            <!-- End Row -->
        </div>
    </div>
</div>

<!-- {{-- Own javascript --}} -->
<script src="{{ url('backend/assets/js/campus/campus.js') }}"></script>

@endsection
