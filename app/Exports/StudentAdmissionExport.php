<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentAdmissionExport implements FromArray, WithHeadings, ShouldAutoSize
{
    use Exportable;


    public $errors;
    public $got_some_error;

    public function __construct($data, $error)
    {        
        $this->errors = $data;
        // $this->got_some_error = json_encode($error);
        $this->got_some_error = $error;
    }

    public function headings(): array
    {
        return [
            "temporary_gr",	
            "bform_crms_no",
            "dob",
            "gender",
            "nationality",
            "mother_tongue",
            "first_name",
            "last_name",
            "religion_type",
            "religion_type_other",
            "admission_date",
            "previous_school",	
            "blood_group",
            "height",
            "weight",
            "student_vaccinated",
            "father_name",
            "father_cnic",
            "father_phone",	
            "father_email",
            "father_occupation"	,
            "father_company_name",	
            "father_salary",
            "father_vaccinated",
            "mother_name",
            "mother_cnic",
            "mother_phone",
            "mother_email",
            "mother_occupation",
            "mother_company_name",
            "mother_salary",
            "mother_vaccinated",
            "current_house_no",
            "current_block_no",	
            "area",
            "guardian_name",
            "guardian_phone",	
            "guardian_relation",
            "first_person_call",
            "pick_and_drop",
            "driver",
            "name",
            "driver_number",
            "vehicle_no",
            "no_of_siblings",
            "siblings_in_mpa",
            "error"																			
        ];
    }

    public function array(): array
    {
        $error_data = [];
        foreach($this->errors as $key => $error) {
            // print_r($this->got_some_error);
            // print_r($this->got_some_error[$key]);
            // dd($key.'<br />');
            array_push($error_data,
                [
                    $error["temporary_gr"], 
                    $error["bform_crms_no"],
                    $error["dob"],
                    $error["gender"],
                    $error["nationality"],
                    $error["mother_tongue"],
                    $error["first_name"],
                    $error["last_name"],
                    $error["religion_type"],
                    $error["religion_type_other"],
                    $error["admission_date"],
                    $error["previous_school"],
                    $error["blood_group"],
                    $error["height"],
                    $error["weight"],
                    $error["student_vaccinated"],

                    $error["father_name"],
                    $error["father_cnic"],
                    $error["father_phone"],
                    $error["father_email"],
                    $error["father_occupation"],
                    $error["father_company_name"],
                    $error["father_salary"],
                    $error["father_vaccinated"],

                    $error["mother_name"],
                    $error["mother_cnic"],
                    $error["mother_phone"],
                    $error["mother_email"],
                    $error["mother_occupation"],
                    $error["mother_company_name"],
                    $error["mother_salary"],
                    $error["mother_vaccinated"],

                    $error["current_house_no"],
                    $error["current_block_no"],

                    "N/A",

                    $error["guardian_name"],
                    $error["guardian_phone"],
                    $error["guardian_relation"],

                    $error["first_person_call"],
                    $error["pick_and_drop"],
                    "N/A",
                    "N/A",
                    "N/A",
                    // $error["vehicle_no"],
                    "N/A",
                    $error["total_no_of_siblings"],
                    $error["siblings_in_mpa"],
                    $this->got_some_error[$key]


                    // $error["place_of_birth"],
                    // $error["previous_class_id"],
                    // $error["mobile_no"],
                    // $error["email"],
                    // $error["as_on_date"],
                    // $error["fees_discount"],
                    // $error["religion"],
                    // $error["guardian_cnic"],
                    // $error["guardian_relation_other"],
                    // $error["current_building_name_no"],
                    // $error["current_area_id"],
                    // $error["current_city_id"],
                    // $error["vehicle_id"],
                ]
            );
        }

        return [
            $error_data
        ];
    }
}
