@extends('layouts.app')
@section('main-content')
@section('page_title', 'Fees')

<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Row -->
            <div class="mt-4">
                <h4> Student Fees </h4>

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
                                        <div class="col-8 text-start"> <p class="my-2">Arsalan Ahmed Siddique</p>  </div>
                                    </div>

                                    <div class="row" style="border-bottom: 2px solid lightgrey;">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Father Name:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> Arsalan Ahmed Siddique</p> </div>
                                    </div>

                                    <div class="row" style="border-bottom: 2px solid lightgrey;">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Mobile Number:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> Arsalan Ahmed Siddique</p> </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Category:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> Arsalan Ahmed Siddique</p> </div>
                                    </div>
                                </div>

                                <div class="col pt-2 pb-2">
                                    <div class="row" style="border-bottom: 2px solid lightgrey;">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Class Section:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> Arsalan Ahmed Siddique</p> </div>
                                    </div>

                                    <div class="row" style="border-bottom: 2px solid lightgrey;">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Admission No:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> Arsalan Ahmed Siddique</p> </div>
                                    </div>

                                    <div class="row" style="border-bottom: 2px solid lightgrey;">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Roll Number:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> Arsalan Ahmed Siddique</p> </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4"> <p class="my-2 font-weight-bolder">Profile Discount:</p> </div>
                                        <div class="col-8 text-start"> <p class="my-2"> Arsalan Ahmed Siddique</p> </div>
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
                                <h3> 0.00 </h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 d-flex justify-content-between">
                                <h3> Student Profile Discount </h3>
                                <h3> 0.00 </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-2 mb-2">
                    <div class="row">
                        <div class="col-11">
                            <div class="m-3 d-flex justify-content-center">
                                <button class="btn btn-warning me-2"> <i class="fa fa-money"></i> Collect Selected </button>
                                <button class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#collect-and-print-fee-modal"> <i class="fa fa-money"></i> Collect and Print </button>
                            </div>
                        </div>
                        <div class="col-1">
                            <h5 class="my-4 text-end me-3"> {{ date("d-m-Y") }} </h5>
                        </div>
                    </div>
                </div>

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
                                        <tr>
                                            <td class="month"> Aug-22 </td>
                                            <td> <input type="text" name="fee" class="fee form-control" value="1500"> </td>
                                            <td> <input type="text" name="disocunt" class="discount form-control"> </td>
                                            <td> <input type="text" name="fine" class="fine form-control"> </td>
                                            <td> <textarea class="form-control note" name="note" cols="30" rows="1"></textarea> </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm btn-add-fee" data-id="1"> <i class="fa fa-plus"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="month"> Sep-22 </td>
                                            <td> <input type="text" name="fee" class="fee form-control" value="1500"> </td>
                                            <td> <input type="text" name="disocunt" class="discount form-control"> </td>
                                            <td> <input type="text" name="fine" class="fine form-control"> </td>
                                            <td> <textarea class="form-control note" name="note" cols="30" rows="1"></textarea> </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm btn-add-fee" data-id="2"> <i class="fa fa-plus"></i> </button>
                                            </td>
                                        </tr>
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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-end">Grand Total</th>
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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="other_fee_name"> EXM Fund </td>
                                            <td> <input type="text" name="fee" class="fee form-control" value="1000"> </td>
                                            <td> <input type="text" name="disocunt" class="discount form-control"> </td>
                                            <td> <input type="text" name="fine" class="fine form-control"> </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm btn-add-other-fee" data-id="3"> <i class="fa fa-plus"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="other_fee_name"> STD Fund </td>
                                            <td> <input type="text" name="fee" class="fee form-control" value="1200"> </td>
                                            <td> <input type="text" name="disocunt" class="discount form-control"> </td>
                                            <td> <input type="text" name="fine" class="fine form-control"> </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm btn-add-other-fee" data-id="4"> <i class="fa fa-plus"></i> </button>
                                            </td>
                                        </tr>
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
                <p class="my-1 mt-2">CAMPUS II</p>
                <p>C-10 Block 20, F.B Area, Karachi, Pakistan. PH: (0092) 21 36344548</p>
                <p class="my-1 mt-2"><strong>JUNAID KHAN (20165)</strong></p>
                <p>Class I - B</p>
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
                            <td>Rs. 3600/=</td>
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