@extends('layouts.app')
@section('main-content')
@section('page_title', 'Fees')

<style>
    .form-control[readonly] {
        background-color: white;
    }

    .badge {
        cursor: pointer;
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
            <div class="mt-4">
                <div class="card mt-2 mb-2">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="avatar avatar-xxl d-none d-sm-flex m-3" style="width:140px;height:140px;">
                                <img alt="avatar" class="rounded-7" src="http://localhost/mpa_july/public/backend/assets/img/users/admin.png">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row" style="margin:0 auto;">
                                <div class="col pt-2 pb-2">
                                    <div class="row" style="border-bottom: 2px solid lightgrey;">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Name:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2">{{ $data["admission"]->first_name }} {{ $data["admission"]->last_name }} </p>  </div>
                                    </div>

                                    <div class="row" style="border-bottom: 2px solid lightgrey;">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Father Name:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> {{ $data["admission"]->father_details["name"] }} </p> </div>
                                    </div>

                                    <div class="row" style="border-bottom: 2px solid lightgrey;">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Mobile Number:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> {{ $data["admission"]->mobile_no }} </p> </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Category:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> </p> </div>
                                    </div>
                                </div>

                                <div class="col pt-2 pb-2">
                                    <div class="row" style="border-bottom: 2px solid lightgrey;">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Class Section:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> {{ $data["admission"]->section }} </p> </div>
                                    </div>

                                    <div class="row" style="border-bottom: 2px solid lightgrey;">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Admission No:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> </p> </div>
                                    </div>

                                    <div class="row" style="border-bottom: 2px solid lightgrey;">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Roll Number:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> </p> {{ $data["admission"]->roll_no }} </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Profile Discount:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2" id="fee_discount"> {{ ($data["admission"]->fee_discount) ? $data["admission"]->fee_discount : "00" 	 }} </p> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-2 mb-2">
                    <div class="row">
                        <div class="col">
                            <div class="p-3 d-flex justify-content-between">
                                <h3> Student Profile Discount </h3>
                                <h3> {{ ($data["admission"]->fee_discount) ? $data["admission"]->fee_discount."%" : "00" }} </h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 d-flex justify-content-between">
                                <h3> Other Session Balance </h3>
                                <h3> 0.00 </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-2 mb-2">
                    <div class="row">
                        <div class="col-11">
                            <div class="m-3 d-flex justify-content-center">
                                <button class="btn btn-warning me-2" id="collect-selected-fees"> <i class="fa fa-money"></i> Collect Selected </button>
                                <button class="btn btn-success ms-2" id="collect-and-print-fees-record" data-bs-toggle="modal" data-bs-target="#collect-and-print-fee-modal"> <i class="fa fa-money"></i> Collect and Print </button>
                            </div>
                        </div>
                        <div class="col-1">
                            <h5 class="my-4 text-end me-3"> {{ date("d-m-Y") }} </h5>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="student_id" id="student-id" value="{{ $data['admission']->id }}" />

                <div class="card mt-2 mb-2">
                    <div class="row">
                        <div class="col p-4">
                            <div class="table-responsive">
                                <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>Monthly Fees</th>
                                            <th>Fees</th>
                                            <th>Discount</th>
                                            <th>Fine</th>
                                            <th>Note</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data["fee_detalis"] as $fee_detail)
                                        @if($fee_detail->short_code == 'MF')
                                        @foreach($data["months"] as $month)
                                        <tr>
                                            <td class="month"> {{ $month->month }} {{ $data["admission"]->session }} </td>
                                            <td> <input type="number" name="fee" class="fee form-control" value="{{ $fee_detail->fees_amount }}"> </td>
                                            @php
                                            
                                            $key = '';
                                            if (false !== $key = array_search($month->id, $data["month_paid_feeses"])) {
                                                $data["month_paid_feeses"][$key];
                                            }else {
                                                $key = '';
                                            }

                                            @endphp
                                            <td> <input type="number" name="discount" value="{{ isset($key) && $key >= 0 ? $data["paid_feeses"][$key]["fee_discount"] : '' }}" class="discount form-control"> </td>
                                            <td> <input type="number" name="fine" value="{{ isset($key) && $key >= 0 ? $data["paid_feeses"][$key]["fine"] : '' }}" class="fine form-control"> </td>
                                            <td> <textarea class="form-control note" name="note" cols="30" rows="1"></textarea> </td>
                                            <td>

                                                @if(in_array($month->id, $data["month_paid_feeses"]))
                                                <div class="badge bg-success" month-id="{{ $month->id }}" fee-id="{{ $fee_detail->fees_type_id }}" data-id="{{ $fee_detail->id }}">Paid</div>
                                                @else
                                                <button class="btn btn-primary btn-sm btn-add-fee" month-id="{{ $month->id }}" fee-id="{{ $fee_detail->fees_type_id }}" data-id="{{ $fee_detail->id }}"> <i class="fa fa-plus"></i> </button>
                                                @endif
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col p-4">
                            <div class="table-responsive">
                                <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Fees</th>
                                            <th>Discount</th>
                                            <th>Fine</th>
                                            <th>Amount</th>
                                            <th>Note</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="student-fee-collect-table-body">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-end">Profile Discount</th>
                                            <th>{{ ($data["admission"]->fee_discount) ? $data["admission"]->fee_discount."%" : "00" }}</th>    
                                            <th class="text-end">Grand Total</th>
                                            <th id="grand-total">00</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-2 mb-2">
                    <div class="row">
                        <div class="col-6 p-4">
                            <div class="table-responsive">
                                <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>Other Fee</th>
                                            <th>Fees</th>
                                            <th>Discount</th>
                                            <th>Fine</th>
                                            <th>Note</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data["fee_detalis"] as $fee_detail)
                                        @if($fee_detail->short_code != 'MF')
                                        <tr>
                                            <td class="other_fee_name"> {{ $fee_detail->type }} </td>
                                            <td> <input type="number" name="fee" class="fee form-control" value="{{ $fee_detail->fees_amount }}"> </td>

                                            @php
                                            
                                            $key = '';
                                            if (false !== $key = array_search($fee_detail->id, $data["paid_feeses_ids"])) {
                                                $data["paid_feeses_ids"][$key];
                                            }else {
                                                $key = '';
                                            }

                                            @endphp

                                            <td> <input type="number" name="discount" value="{{ isset($key) && $key >= 0 ? $data["paid_feeses"][$key]["fee_discount"] : '' }}" class="discount form-control"> </td>
                                            <td> <input type="number" name="fine" value="{{ isset($key) && $key >= 0 ? $data["paid_feeses"][$key]["fine"] : '' }}" class="fine form-control"> </td>
                                            <td> <textarea class="form-control note" name="note" cols="30" rows="1"></textarea> </td>

                                            <td>

                                                @if(in_array($fee_detail->id, $data["paid_feeses_ids"]))
                                                <div class="badge bg-success" fee-id="{{ $fee_detail->fees_type_id }}" data-id="{{ $fee_detail->id }}">Paid</div>
                                                @else
                                                <button class="btn btn-primary btn-sm btn-add-other-fee" fee-id="{{ $fee_detail->fees_type_id }}" data-id="{{ $fee_detail->id }}"> <i class="fa fa-plus"></i> </button>
                                                @endif

                                            </td>
                                        </tr>
                                        @endif
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


<!-- Modal -->
<div class="modal fade" id="collect-and-print-fee-modal" tabindex="-1" aria-labelledby="collect-and-print-fee-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="collect-and-print-fee-modal-label">Collect and Print</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-2">
        <div class="border p-4">
            <div class="d-flex justify-content-between">
                <p>Date: {{ date("d-m-Y") }}</p>
                <p>Receipt No.:  00028</p>
            </div>
            <div class="text-center">
                <h1>METROPOLITAN ACADEMY</h1>
                <p class="my-1 mt-2">{{ $data["admission"]->campus }}</p>
                <p>C-10 Block 20, F.B Area, Karachi, Pakistan. PH: (0092) 21 36344548</p>
                <p class="my-1 mt-2"><strong>{{ $data["admission"]->first_name }}{{ $data["admission"]->last_name }} (20165)</strong></p>
                <p>{{ $data["admission"]->class }} - {{ $data["admission"]->section }}</p>
            </div>

            <div class="table-responsive mt-2">
                <table class="table text-nowrap text-md-nowrap table-striped mg-b-0">
                    <thead>
                        <tr>
                            <td>Invoice#</td>
                            <td>Month</td>
                            <td>Details</td>
                            <td>Amount</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2/40128</td>
                            <td>Aug-21</td>
                            <td>Tution Fee</td>
                            <td>Rs. 3200/=</td>
                        </tr>
                        <tr>
                            <td>Fine</td>
                            <td></td>
                            <td>Total Fee</td>
                            <td>Rs. 400/=</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total</strong></td>
                            <td id="print-grand-total">Rs. 3600/=</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <p class="mt-2"><strong>Note:</strong> Fee once deposit is not refundable or adjustable. </p>            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Print</button>
      </div>
    </div>
  </div>
</div>

<script src="{{ url('backend/assets/js/fees/student/student.js') }}"></script>

@endsection