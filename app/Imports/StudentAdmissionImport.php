<?php

namespace App\Imports;

use App\Models\Admission;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use App\Models\Classes;
use App\Models\Section;
use App\Models\System;
use App\Models\Campus;
use App\Models\Area;

class StudentAdmissionImport implements ToCollection, WithValidation, WithHeadingRow, SkipsOnFailure, ShouldAutoSize
{

    use Importable, SkipsFailures;

    public $campus_id;
    public $class_id;
    public $section_id;
    public $session_id;
    public $system_id;
    public $group_id;
    public $my_error_bag = [];

    public function  __construct($data)
    {

        ini_set('memory_limit', '3000M');
        ini_set('max_execution_time', '6000');

        $this->campus_id        = $data["campus_id"];
        $this->class_id         = $data["class_id"];
        $this->section_id       = $data["section_id"];
        $this->session_id       = $data["session_id"];
        $this->system_id        = $data["system_id"];
        $this->group_id         = $data["group_id"];

    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {

            $admisssion                         = new Admission();
            // $admisssion->campus_id              = (isset($this->campus_id)  && !empty($this->campus_id)     ? $this->campus_id      : 2);
            $admisssion->campus_id              = 1;
            $admisssion->class_id               = (isset($this->class_id)   && !empty($this->class_id)      ? $this->class_id       : $row["class_id"]);
            $admisssion->section_id             = isset($this->section_id) ? $this->section_id : $row["section_id"] ;
            $admisssion->session_id             = isset($this->session_id) ? $this->session_id : '1' ;
            $admisssion->group_id               = isset($this->group_id) ? $this->group_id : NULL;
            // $admisssion->system_id              = (isset($this->system_id)   && !empty($this->system_id)      ? $this->system_id       : $row["system_id"]);
            // dd($admisssion->system_id.$row["last_name"]);
            $admisssion->system_id              = 1;
            $admisssion->temporary_gr           = isset($row["temporary_gr"]) ? $row["temporary_gr"] : '';

            // dd($admisssion->temporary_gr);
            $admisssion->gr                     = isset($row["temporary_gr"]) ? $row["temporary_gr"] : '';
            $admisssion->bform_crms_no          = isset($row["bform_crms_no"]) ? $row["bform_crms_no"] : '';
            $admisssion->first_name             = isset($row["first_name"]) ? $row["first_name"] : '';
            $admisssion->last_name              = isset($row["last_name"]) ? $row["last_name"] : '';
            $admisssion->dob                    = isset($row["dob"]) ? $row["dob"] : NULL;
            $admisssion->gender                 = isset($row["gender"]) ? $row["gender"] : '';
            $admisssion->place_of_birth         = "Karachi";
            $admisssion->nationality            = isset($row["nationality"]) ? str_replace(' ','', $row["nationality"]) : '';
            $admisssion->mother_tongue          = isset($row["mother_tongue"]) ? $row["mother_tongue"] : '';
            // $admisssion->previous_class_id      = isset($row["previous_class_id"]) ? $row["previous_class_id"] : '';
            $admisssion->previous_school        = isset($row["previous_school"]) ? $row["previous_school"] : '';
            $admisssion->mobile_no              = isset($row["phone"]) ? $row["phone"] : '';
            // $admisssion->email                  = isset($row["email"]) ? $row["email"] : '';

            $admisssion->admission_date         = isset($row["admission_date"])  ? (strlen($row["admission_date"]) > 4 ? date("Y-m-d", strtotime($row["admission_date"])) : date("Y-m-d", strtotime($row["admission_date"]))."-08-01") : NULL;
            $admisssion->blood_group            = isset($row["blood_group"]) ? $row["blood_group"] : '';
            $admisssion->height                 = isset($row["height"]) ? $row["height"] : '';
            $admisssion->weight                 = isset($row["weight"]) ? $row["weight"] : '';
            // $admisssion->as_on_date             = isset($row["as_on_date"]) ? $row["as_on_date"] : '';
            // $admisssion->fees_discount          = isset($row["fees_discount"]) ? $row["fees_discount"] : '';
            $admisssion->religion               = isset($row["religion"]) ? $row["religion"] : '';
            $admisssion->religion_type          = (isset($row["religion_type"]) && !empty($row["religion_type"]) && $row["religion_type"] == 'yes' ? 'asna_ashri' : "other");
            $admisssion->religion_type_other    = (isset($row["religion_type_other"]) && !empty($row["religion_type_other"] && $row["religion_type_other"] == "yes") ? $row["religion_type_other"] : "N/A");
            $admisssion->siblings_in_mpa        = (isset($row["siblings_in_mpa"]) && !empty($row["siblings_in_mpa"]) && ($row["siblings_in_mpa"] > 0) ? "yes" : "no");
            $admisssion->total_no_of_siblings   = isset($row["total_no_of_siblings"]) ? $row["total_no_of_siblings"] : null;
            $admisssion->no_of_siblings_in_mpa  = isset($row["siblings_in_mpa"]) ? $row["siblings_in_mpa"] : null;
            $admisssion->student_vaccinated     = isset($row["student_vaccinated"]) ? $row["student_vaccinated"] : 'no';
            $admisssion->pick_and_drop          = isset($row["pick_and_drop"]) && !empty($data["pick_and_drop"]) ? $row["pick_and_drop"] : 'by_walk';

            $admisssion->father_details         = json_encode([
                                                    "name"              => isset($row["father_name"]) ? $row["father_name"] : '',
                                                    "email"             => isset($row["father_email"]) ? $row["father_email"] : '',
                                                    "phone"             => isset($row["father_phone"]) ? $row["father_phone"] : '',
                                                    "company_name"      => isset($row["father_company_name"]) ? $row["father_company_name"] : '',
                                                    "cnic"              => isset($row["father_cnic"]) ? $row["father_cnic"] : '',
                                                    "phone"             => isset($row["father_phone"]) ? $row["father_phone"] : '',
                                                    "occupation"        => isset($row["father_occupation"]) ? $row["father_occupation"] : '',
                                                    "salary"            => isset($row["father_salary"]) ? $row["father_salary"] : '',
                                                    "vaccinated"        => "yes"
                                                ]);

            $admisssion->mother_details         = json_encode([
                                                    "name"              => isset($row["mother_name"]) ? $row["mother_name"] : '',
                                                    "email"             => isset($row["mother_email"]) ? $row["mother_email"] : '',
                                                    "phone"             => isset($row["mother_phone"]) ? $row["mother_phone"] : '',
                                                    "company_name"      => isset($row["mother_company_name"]) ? $row["mother_company_name"] : '',
                                                    "cnic"              => isset($row["mother_cnic"]) ? $row["mother_cnic"] : '',
                                                    "phone"             => isset($row["mother_phone"]) ? $row["mother_phone"] : '',
                                                    "occupation"        => isset($row["mother_occupation"]) ? $row["mother_occupation"] : '',
                                                    "salary"            => isset($row["mother_salary"]) ? $row["mother_salary"] : '',
                                                    "vaccinated"        => "yes"
                                                ]);

            $admisssion->guardian_details       = json_encode([
                                                    'cnic'               => isset($row["father_cnic"]) ? $row["father_cnic"] : '',
                                                    'name'               => isset($row["guardian_name"]) ? $row["guardian_name"] : '',
                                                    'phone'              => isset($row["guardian_phone"]) ? $row["guardian_phone"] : '',
                                                    'relation'           => isset($row["guardian_relation"]) ? $row["guardian_relation"] : '',
                                                    'other_relation'     => (isset($row["guardian_relation"]) && $row["guardian_relation"] == 'other') ? $row["guardian_relation_other"] : NULL,
                                                    'first_person_call'  => isset($row["first_person_call"]) ? $row["first_person_call"] : '',
                                                ]);


            $currentAddress                     = [
                                                    'current_house_no'            => isset($row["current_house_no"]) ? $row["current_house_no"] : '',
                                                    'current_block_no'            => isset($row["current_block_no"]) ? $row["current_block_no"] : '',
                                                    'current_building_name_no'    => isset($row["current_building_name_no"]) ? $row["current_building_name_no"] : 'N/A',
                                                    'current_area_id'             => isset($row["current_area"]) ? $row["current_area"] : '',
                                                    'current_city_id'             =>  "1"
                                                ];

            $permanentAddress                   = [
                                                    'permanent_house_no'            => isset($row["current_house_no"]) ? $row["current_house_no"] : '',
                                                    'permanent_block_no'            => isset($row["current_block_no"]) ? $row["current_block_no"] : '',
                                                    'permanent_building_name_no'    => isset($row["permanent_building_name_no"]) ? $row["permanent_building_name_no"] : 'N/A',
                                                    'permanent_area_id'             => isset($row["current_area"]) ? $row["current_area"] : '',
                                                    'permanent_city_id'             => "1"
                                                ];

            $admisssion->address_details       = json_encode([
                                                    'current_address'    =>  $currentAddress,
                                                    'same_as_current'    =>  ['same_as_current'  =>  "yes"],
                                                    'permanent_address'  =>  $permanentAddress
                                                ]);

            $admisssion->save();

        }   
    }

    public function prepareForValidation($data, $index)
    {

        // dd(explode('-', trim(preg_replace('/\s+/', '-', str_replace('-', '', $data["father_phone"]))))[0]);
        // dd(explode('-', trim(preg_replace('/\s+/', '-', $data["mother_phone"]))));


        $data["admission_year"]                 = isset($data["admission_year"]) ? (int)$data["admission_year"] : "";

        // dd($data);


        if(isset($data["class"]) && !empty($data["class"])) {
            $result                             = Classes::where('class', $data["class"])->first();
            $data["class_id"]                   = $result ? $result->id : "";
        }

        if(isset($data["section"]) && !empty($data["section"])) {
            $result                             = Section::where('section', $data["section"])->first();
            $data["section_id"]                 = ($result) ? $result->id : "";
        }

        if(isset($data["system"]) && !empty($data["system"])) {
            $result                             = System::where('system', $data["system"])->first();
            $data["system_id"]                  = ($result) ? $result->id : "";
        }

        if(isset($data["admission_class"]) && !empty($data["admission_class"])) {
            $result                             = Classes::where('class', $data["admission_class"])->first();
            $data["previous_class_id"]          = ($result) ? $result->id : "";
        }

        if(isset($data["campus"]) && !empty($data["campus"])) {
            $campus_name                        = "Campus ".$this->numberToRomanRepresentation((int) filter_var($data["campus"], FILTER_SANITIZE_NUMBER_INT));
            $result                             = Campus::where('campus', $campus_name)->first();
            $data["campus_id"]                  = ($result) ? $result->id : "";
        }

        $data['religion']                       = isset($data['religion'])             ? strtolower($data["religion"])                     : '' ;
        $data['weight']                         = isset($data['weight']) && $data["weight"] > 0              ? $data["weight"]                                 : '0.0' ;
        $data['height']                         = isset($data['height']) && $data["height"] > 0              ? $data["height"] : '0.0' ;

        // dd([$data['weight'], $data['height']]);

        $data['dob']                            = isset($data['dob'])                  ? date("Y-m-d", strtotime($data['dob']))            : NULL ;
        $data['admission_date']                 = isset($data['admission_year']) && !empty($data["admission_year"])       ? $data['admission_year']."-08-01"                  : NULL ;
        $data['current_city_id']                = 1;
        $data['temporary_gr']                   = isset($data['temporary_gr'])         ? (string) $data['temporary_gr']                    : '' ;
        $data['gender']                         = isset($data['gender'])               ? strtolower($data['gender'])                       : '' ;
        $data['student_vaccinated']             = isset($data['student_vaccinated'])   ? strtolower($data['student_vaccinated'])           : 'no' ;
        $data['first_person_call']              = isset($data['first_person_call'])    ? strtolower($data['first_person_call'])            : '' ;
        
        $data['mother_vaccinated']              = isset($data['mother_vaccinated'])    ? strtolower($data['mother_vaccinated'])            : '' ;
        $data['mother_cnic']                    = isset($data['mother_cnic'])          ? str_replace('-', '', $data['mother_cnic'])        : '' ;       
        $data['mother_phone']                   = isset($data["mother_phone"])  ? explode('-', trim(preg_replace('/\s+/', '-', str_replace('-', '', $data["mother_phone"]))))[0] : '';
        $data['mother_phone']                   = isset($data["guardian_phone"])  ? explode('-', trim(preg_replace('/\s+/', '-', str_replace('-', '', $data["guardian_phone"]))))[0] : '';
        $data['mother_salary']                  = isset($data['mother_salary'])        ? str_replace('k', '000', strtolower($data["mother_salary"]))   : '' ;
        
        $data['father_cnic']                    = isset($data['father_cnic'])          ? str_replace('-', '', $data['father_cnic'])        : '' ;       
        $data['father_vaccinated']              = isset($data['father_vaccinated'])    ? strtolower($data['father_vaccinated'])            : '' ;
        $data['father_phone']                   = isset($data['father_phone'])         ? explode('-', trim(preg_replace('/\s+/', '-', str_replace('-', '', $data["father_phone"]))))[0]       : '' ;       
        $data['father_salary']                  = isset($data['father_salary'])       ? str_replace('k', '000', strtolower($data["father_salary"]))   : '' ;

        $data['pick_and_drop']                  = isset($data['pick_and_drop'])        ? str_replace(' ', '_', $data["pick_and_drop"])     : '' ;
        $data['pick_and_drop']                  = isset($data['pick_and_drop'])        ? strtolower($data['pick_and_drop'])                : '' ;


        $data['sunni']                          = isset($data['sunni'])         ? strtolower($data['sunni']) : '';
        $data['asna_ashri']                     = isset($data['asna_ashri'])    ? strtolower($data['asna_ashri']) : '';

        $data['religion_type']                  = isset($data['sunni']) && strtolower($data['sunni']) == 'yes' ? 'sunni' : (isset($data['sunni']) && strtolower($data['asna_ashri']) == 'yes' ? 'asna_ashri'  : 'other');
        $data['religion_type_other']            = strtolower($data['sunni']) == 'yes' ? ''      : (strtolower($data['asna_ashri']) == 'yes' ? ''            : $data["religion_type_other"]);

        // $data['religion_type']   = strtolower(['sunni'] == 'yes') ? 'sunni' : (strtolower(['asna_ashri'] == 'yes') ? 'asna_ashri' : 'other');
        // $data['religion_type_other']   = strtolower(['sunni'] == 'yes') ? '' : (strtolower(['asna_ashri'] == 'yes') ? '' : $data['religion_type']);
        
        if(isset($data['guardian_relation']) && !empty($data['guardian_relation'])) {
            $guardian_relations                 = ["uncle", "grand_father", "neighbours"];
            $guardian_relation                  = explode("/", $data['guardian_relation']);
            $data['guardian_relation']          = str_replace('d f', 'd_f', strtolower($guardian_relation[0]));
            $data['guardian_relation']          = str_replace(' ', '', $data['guardian_relation']);
            $data['guardian_relation']          = strtolower($data['guardian_relation']);

            if($data['guardian_relation'] == "grand_father") {
                $data['guardian_relation']      = "grandfather_grandmother";
            }else if($data['guardian_relation'] == "uncle") { 
                $data['guardian_relation']      = "uncle_aunty";
            }else if($data['guardian_relation'] == "neighbours") {
                $data['guardian_relation']      = "neighbours";
            }else {
                $data['guardian_relation']      = "other";
                $data['guardian_relation_other']      = $data['guardian_relation'];
            }
        }
        
        if(isset($data["current_area"]) && !empty($data["current_area"])) {
            $result                             = Area::where('area', 'like', '%'.$data["current_area"].'%')->first();
            if($result) {
                $data["current_area"]                   = $result->id;
            }else {
                $data["current_area"]                   = "";
            }

            // $data["current_area_id"]                   = 1;
        }

        $data["pick_and_drop"]                  = isset($data["pick_and_drop"]) && in_array($data["pick_and_drop"], ['parent', 'guardian']) ? "by_".$data["pick_and_drop"] : $data["pick_and_drop"];

        return $data;

    }

    /**
    * @return array
    */
    public function rules(): array
    {
        return [
            
            // '*.temporary_gr'              =>  'required|unique:admissions,temporary_gr|string|min:1,max:20',  
            '*.temporary_gr'              =>  'nullable|string|max:20',  
            '*.campus'                    =>  'required|string|min:8,max:30',  
            '*.system'                    =>  'nullable|string|min:6,max:30',  
            '*.class'                     =>  'required|string|min:4,max:30',  
            '*.section'                   =>  'required|string|min:1,max:30',  
            '*.bform_crms_no'             =>  'nullable',
            '*.dob'                       =>  'nullable|date',
            '*.gender'                    =>  'nullable|in:male,female',
            '*.place_of_birth'            =>  'nullable|max:30',                                      // required => karachi
            '*.nationality'               =>  'nullable|max:30',
            '*.mother_tongue'             =>  'nullable|max:30',
            '*.first_name'                =>  'required|string|max:30',
            '*.last_name'                 =>  'nullable',
            '*.religion'                  =>  'nullable',                         // issue if asna ok else other
            '*.religion_type'             =>  'nullable|in:sunni,asna_ashri,other',                         // issue if asna ok else other
            '*.religion_type_other'       =>  'nullable|max:20',            // invalid => n/a
            // '*.admission_year'            =>  'required|max:'.(date('Y')+1),                                              // invalid => 1 aug
            '*.admission_year'            =>  'nullable',                                             // invalid => 1 aug
            '*.admission_class'           =>  'nullable',
            '*.previous_school'           =>  'nullable|max:40',
            '*.blood_group'               =>  'nullable',
            '*.height'                    =>  'nullable',
            '*.weight'                    =>  'nullable',
            '*.student_vaccinated'        =>  'nullable',
            '*.phone'                 =>  'nullable|max:20',
            // '*.email'                     =>  'nullable|email|max:30',
            // '*.as_on_date'                =>  'nullable|date',
            // '*.fees_discount'             =>  'nullable|min:0|digits_between:1,3',
            '*.father_name'               =>  'required',
            // '*.father_cnic'               =>  'required|numeric|gt:0|digits:13',
            '*.father_cnic'               =>  'nullable|max:20',
            '*.father_phone'              =>  'nullable',                
            '*.father_email'              =>  'nullable',
            '*.father_occupation'         =>  'nullable',
            '*.father_company_name'       =>  'nullable',                                            // 30 -> 40                    
            '*.father_salary'             =>  'nullable',
            '*.father_vaccinated'         =>  'nullable',
            '*.mother_name'               =>  'nullable',
            '*.mother_cnic'               =>  'nullable',
            '*.mother_phone'              =>  'nullable',                    
            '*.mother_email'              =>  'nullable',
            '*.mother_occupation'         =>  'nullable',
            '*.mother_company_name'       =>  'nullable',
            '*.mother_salary'             =>  'nullable',
            '*.mother_vaccinated'         =>  'nullable',
            '*.current_house_no'          =>  'nullable',
            '*.current_block_no'          =>  'nullable',
            '*.current_area'              =>  'nullable',
            // '*.guardian_cnic'             =>  'nullable|numeric|gt:0|digits:13',
            '*.guardian_name'             =>  'nullable',
            '*.guardian_phone'            =>  'nullable',
            '*.guardian_relation'         =>  'nullable|in:uncle_aunty,grandfather_grandmother,neighbours,other',       // invalid
            // '*.guardian_relation_other'   =>  'nullable|required_if:guardian_relation,other|max:20',
            '*.first_person_call'         =>  'nullable',
            '*.pick_and_drop'             =>  'nullable|in:by_walk,by_ride,by_private_van,by_school_van,by_parent,by_guardian',
            '*.total_no_of_siblings'      =>  'nullable', 
            '*.siblings_in_mpa'           =>  'nullable',
            // '*.no_of_siblings'            =>  'nullable|numeric|required_if:siblings_in_mpa,gt:0|gt:0|digits_between:1,10',  // issue
            // '*.vehicle_number'                =>  'nullable|required_if:pick_and_drop,by_ride|max:20',
            // '*.vehicle_id'                =>  'nullable|required_if:pick_and_drop,by_school_van|required_if:pick_and_drop,by_private_van|digits_between:1,10',
            
        ];
    }

    /**
     * @param int $number
     * @return string
     */
    function numberToRomanRepresentation($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}
