@extends('layouts.app')
@section('main-content')
@section('page_title', 'Fees Card Sticker')

<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">


            <!-- Row -->
            
            
                <div class="mt-4" style="width: 4in; height: 2.1in; border:1px solid black;">
                    <div class="d-flex justify-content-center">
                        <div class="" style="width: 24%;">
                            <img src="{{ asset('backend/assets/img/logo.png') }}" style="width: 90%;" class="img-responsive" alt="logo">
                        </div>
                        <div class="text-center" style="width: 48%;">
                            <p class="font-weight-bold" style="margin-top:0px; margin-bottom:0px;color:black;"> METROPOLITON ACADEMY <br> NASEERABAD CAMPUS </p>
                            <p style="margin-top:0px; margin-bottom:0px;color: white;background-color:black;"> Fee Card April 2020 - June 2021 </p>
                        </div>
                        <div style="width:24%;" class="text-center mx-2 my-2">
                            <h2 class="p-2" style="background-color: black;color:white;"> 2400 </h2>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between px-2">
                        <p style="margin-bottom:0px;">
                            Class: <u style="font-weight: bold;"> &nbsp;&nbsp; KG I &nbsp;&nbsp;</u>
                        </p>
                        <p style="margin-bottom:0px;">
                            Section: <u style="font-weight: bold;"> &nbsp;&nbsp; A &nbsp;&nbsp; </u>
                        </p>
                        <p style="margin-bottom:0px;font-weight: bold;">
                            GR#: <span class="px-1" style="background-color:black;color:white;">8109</span>
                        </p>
                    </div>

                    <div class="font-weight-bold px-2">
                        <p class="my-1">Student Name:  <u> Arsalan Ahmed Siddique </u></p>
                        <p class="my-1">Father Name:  <u> Muhammad Naseem </u></p>
                        <p class="my-1">Address:  <u> House#536, Sector# 11 1/2 </u></p>
                    </div>
                    
                    <div class="d-flex justify-content-between px-2">
                        <p style="margin-bottom:0px;" class="font-weight-bold"> ST-FUND: <span class="px-2" style="color:white;background-color: black;"> 600 </span> </p>
                        <p style="margin-bottom:0px;" class="font-weight-bold"> Exam: <span class="px-2" style="color:white;background-color: black;"> ABCD </span> </p>
                    </div>

                </div>
            
            <!-- End Row -->
        </div>
    </div>
</div>

@endsection