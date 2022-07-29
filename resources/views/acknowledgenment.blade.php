<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>interview</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css"> -->
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
         @page {
            size: A5 landscape;
        }
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                /*Chrome, Safari */
                color-adjust: exact !important;
                /*Firefox*/
            }

        }
    </style>
</head>

<body>
    <section class="container-fluid">
        <div class="row d-flex">
            <div class="col-2">
                <img src="{{ asset('backend/assets/img/logo.png') }}" height="100" alt="logo">
            </div>
            <div class="col-10">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>METROPOLITAN ACADEMY</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 bg-dark text-light p-0 text-center">
                        <p class=" font-weight-bold"> Head Office / Campus 1 : B-33 Block 13, F.B. Area, Karachi, Pakistan. Ph: (0092) 21 36363629 </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-6 offset-3 bg-dark text-light text-center">
                <p class="mt-3 font-weight-bold">ACKNOWLEDGEMENT FOR TEST</p>
            </div>
            <div class="col-3">
                <table class="table table-bordered m-0 p-0" style="float: right">
                    <tr>
                        <td class="m-0 p-0">Registration# MIN22012</td>
                    </tr>
                    <tr>
                        <td class="m-0 p-0">Form# R.SN # IN -38</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-12">
                <b>Received Registration Form for admission to <span class="border-bottom border-dark"> &nbsp; Class: Class IV &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span> </b>
            </div>

        </div>
        <div class="row d-flex">
            <div class="col-12">

                <table class="table table-bordered table-sm mt-4 mb-0">
                    <tr>
                        <th style="width:30%;">1.Name of Student</th>
                        <td style="width:70%;">ABUBAKAR</td>
                    </tr>
                    <tr>
                        <th>2.Father's Name</th>
                        <td>MUHAMMAD ADIL</td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <b>THE PARENTS ARE REQUESTED TO DROP THE CHILD AT SCHOOL FOR WRITTEN TEST ON
                    <span class="border-bottom border-dark"> 11-06-2022 &nbsp; </span>
                    AT
                    <span class="border-bottom border-dark"> 9:00 AM &nbsp; </span>
                </b>
            </div>
        </div>
        <div class="row mt-2 mb-0">
            <div class="offset-9 col-md-3" style="margin-top: 30px;">
                <b> Signature of Staff Member</b>
            </div>
        </div>

        <hr class="border-bottom border-dark bg-dark">

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <p class=" bg-dark text-light font-weight-bold p-1 "> INSTRUCTION FOR PARENTS &nbsp;</p>
            </div>

            <div class="col-md-12 col-sm-12 mt-1">
                <ol class='font-weight-bold'>
                    <li>The age of the child must be in accordance with the prescribed age limit for admission.</li>
                    <li>Admission will be granted only if recommended by the admission committee.</li>
                </ol>
            </div>

        </div>

        <hr class="border-bottom border-dark bg-dark">

        <div class="row bg-dark text-light text-center" style="position: fixed;bottom: 0; left: 0; right: 0;font-size: 13px;">

            <div class="col-4 mt-1">
                <p>
                    Incholi Campus <br>
                    C-10 Block 20, F.B. Area, karachi, Pakistan <br>
                    Ph: (021) 36344548
                </p>
            </div>
            <div class="col-4 mt-1">
                <p>
                    North Nazimabad Campus <br>
                    D-31 Block B, North Nazimabad, Karachi, Pakistan <br>
                    Ph: (021) 36670852
                </p>
            </div>
            <div class="col-4 mt-1">
                <p>
                    O Level's Naseerabad Campus <br>
                    C-4, Block 13, Federal B Area 97500 karachi, Pakistan <br>
                    Ph: (021) 36800252
                </p>
            </div>

        </div>
    </section>
</body>
<script>
    window.print();
</script>

</html>