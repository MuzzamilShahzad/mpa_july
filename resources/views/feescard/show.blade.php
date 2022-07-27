<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@foreach($data['Admissions'] as $admission)
    <div class="mt-4" style="width: 4in; height: 2in; border:1px solid black;">
        <div class="d-flex justify-content-center" style="margin-top: 0.25rem;">
            <div style="width: 24%;">
                <img src="{{ asset('backend/assets/img/logo.png') }}" style="width: 90%;" class="img-responsive" alt="logo">
            </div>
            <div class="text-center" style="width: 48%;">
                <p class="font-weight-bold" style="margin-bottom:0px;color:black;font-size:14px;"> METROPOLITON ACADEMY <br> {{ $admission->campus }} </p>
                <p style="font-size: 14px; margin-top:0px; margin-bottom:0px;color: white;background-color:black;"> Fee Card {{ $admission->session }} </p>
            </div>
            <div style="width:24%;" class="text-center mx-2 my-2">
                <h4 class="p-2" style="background-color: black;color:white;"> {{ $admission->fees_types["TF"] }} </h4>
            </div>
        </div>

        <div class="d-flex justify-content-between px-2">
            <p style="font-weight: bold;margin-bottom:0px;">
                Class: <u> &nbsp;&nbsp; {{ $admission->class }} &nbsp;&nbsp;</u>
            </p>
            <p style="font-weight: bold;margin-bottom:0px;">
                Section: <u> &nbsp;&nbsp; {{ $admission->section }} &nbsp;&nbsp; </u>
            </p>
            <p style="margin-bottom:0px;font-weight: bold;">
                GR#: <span class="px-1" style="background-color:black;color:white;"> {{ $admission->temporary_gr }} </span>
            </p>
        </div>

        <div class="font-weight-bold px-2">
            <p style="margin:0 auto;font-size:14px;">Student Name:  <u> {{ $admission->first_name }} {{ $admission->last_name }} </u></p>
            <p style="margin:0 auto;font-size:14px;">Father Name:  <u> {{ $admission->father_details["name"] }} </u></p>
            <p style="margin:0 auto;font-size:14px;">Address:  <u> {{ $admission->address_details["current_address"]["current_house_no"] }} </u></p>
        </div>
        
        <div class="d-flex justify-content-between px-2">
            <p class="my-1 font-weight-bold" style="font-size:14px;"> ST-FUND: <span class="px-2" style="color:white;background-color: black;"> {{ $admission->fees_types["SF"] }} </span> </p>
            <p class="my-1 font-weight-bold" style="font-size:14px;"> EXAM: <span class="px-2" style="color:white;background-color: black;"> {{ $admission->fees_types["EF"] }} </span> </p>
        </div>
    </div>
@endforeach
 