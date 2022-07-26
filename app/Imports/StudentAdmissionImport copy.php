<?php

namespace App\Imports;

use App\Models\Admission;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentAdmissionImport implements ToCollection, WithValidation, WithHeadingRow
{

    public $campus_id;
    public $class_id;
    public $section_id;
    public $session_id;
    public $system_id;
    public $group_id;

    public function  __construct($data)
    {

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

        $my_error_bag = [];

        foreach($rows as $row) {

            $validator = Validation::make([
                '*.temporary_gr'              =>  'required|unique:admissions,temporary_gr|string|min:1,max:10',  
                '*.gr'                        =>  'required|unique:admissions,gr|digits_between:1,11',          // required
                '*.bform_crms_no'             =>  'nullable|numeric|gt:0|digits:13',
                '*.first_name'                =>  'required|string|max:30',
                '*.last_name'                 =>  'required|string|max:30',
                '*.dob'                       =>  'nullable|date',
                '*.gender'                    =>  'required|in:male,female',
                '*.place_of_birth'            =>  'required|alpha|max:30',                  // required
                '*.nationality'               =>  'required|alpha|max:30',
                '*.mother_tongue'             =>  'required|alpha|max:30',
                '*.previous_class_id'         =>  'nullable|numeric|gt:0|digits_between:1,11',
                '*.previous_school'           =>  'nullable|max:30',
                '*.mobile_no'                 =>  'nullable|max:20',
                '*.email'                     =>  'nullable|email|max:30',
                '*.admission_date'            =>  'nullable|date',                              // invalid
                '*.blood_group'               =>  'nullable|min:2|max:3',
                '*.height'                    =>  'nullable|gt:0|between:1,10',
                '*.weight'                    =>  'nullable|gt:0',
                '*.as_on_date'                =>  'nullable|date',
                '*.fees_discount'             =>  'nullable|min:0|digits_between:1,3',
                '*.religion'                  =>  'required|max:20',                            // required
                '*.religion_type'             =>  'required|in:sunni,asna_ashri,other',
                '*.religion_type_other'       =>  'nullable|required_if:religion_type,other|max:20',        // invalid
                '*.siblings_in_mpa'           =>  'nullable|in:yes,no',                         
                '*.no_of_siblings'            =>  'nullable|numeric|required_if:siblings_in_mpa,yes|gt:0|digits_between:1,11',
                '*.student_vaccinated'        =>  'nullable|in:yes,no',
                '*.father_cnic'               =>  'required|numeric|gt:0|digits:13',
                '*.father_salary'             =>  'nullable|numeric|gt:0|digits_between:1,11',
                '*.father_email'              =>  'nullable|email|max:30',
                '*.father_name'               =>  'required|max:30',
                '*.father_phone'              =>  'required|numeric|gt:0|digits:11',                // required
                '*.father_occupation'         =>  'nullable|string|max:30',
                '*.father_company_name'       =>  'nullable|max:40',                                   // 30 -> 40                    
                '*.father_vaccinated'         =>  'nullable|in:yes,no',
                '*.mother_cnic'               =>  'required|numeric|gt:0|digits:13',
                '*.mother_salary'             =>  'nullable|numeric|gt:0|digits_between:1,11',
                '*.mother_email'              =>  'nullable|email|max:30',
                '*.mother_name'               =>  'required|max:30',
                '*.mother_phone'              =>  'required|numeric|gt:0|digits:11',                    // required
                '*.mother_occupation'         =>  'nullable|string:30',
                '*.mother_company_name'       =>  'nullable|max:30',
                '*.mother_vaccinated'         =>  'nullable|in:yes,no',
                '*.guardian_cnic'             =>  'nullable|numeric|gt:0|digits:13',
                '*.guardian_name'             =>  'nullable|max:30',
                '*.guardian_phone'            =>  'nullable|numeric|gt:0|digits:11',
                '*.guardian_relation'         =>  'nullable|in:uncle_aunty,grandfather_grandmother,neighbours,other',       // invalid
                '*.guardian_relation_other'   =>  'nullable|required_if:guardian_relation,other|max:20',
                '*.first_person_call'         =>  'required|in:father,mother,guardian',
                '*.current_house_no'          =>  'required|max:60',
                '*.current_block_no'          =>  'required|max:60',
                '*.current_building_name_no'  =>  'nullable|max:60',
                '*.current_area_id'           =>  'required|numeric|gt:0|digits_between:1,11',
                '*.current_city_id'           =>  'required|numeric|gt:0|digits_between:1,11',
                '*.pick_and_drop'             =>  'required|in:by_walk,by_ride,by_private_van,by_school_van',
                '*.vehicle_no'                =>  'nullable|required_if:pick_and_drop,by_ride|max:20',
                '*.vehicle_id'                =>  'nullable|required_if:pick_and_drop,by_school_van|required_if:pick_and_drop,by_private_van|digits_between:1,11',
            ]);

            if($validator->fails()) {
                array_push($my_error_bag, $validator->errors());
            }
            
            $admisssion                         = new Admission();

            $admisssion->campus_id              = $this->campus_id;
            $admisssion->class_id               = $this->class_id;
            $admisssion->section_id             = $this->section_id;
            $admisssion->session_id             = $this->session_id;
            $admisssion->group_id               = $this->group_id;
            $admisssion->system_id              = $this->system_id;
            $admisssion->temporary_gr           = $row["temporary_gr"];
            $admisssion->gr                     = $row["gr"];
            $admisssion->bform_crms_no          = $row["bform_crms_no"];
            $admisssion->first_name             = $row["first_name"];
            $admisssion->last_name              = $row["last_name"];
            $admisssion->dob                    = $row["dob"];
            $admisssion->gender                 = $row["gender"];
            $admisssion->place_of_birth         = $row["place_of_birth"];
            $admisssion->nationality            = $row["nationality"];
            $admisssion->mother_tongue          = $row["mother_tongue"];
            $admisssion->previous_class_id      = $row["previous_class_id"];
            $admisssion->previous_school        = $row["previous_school"];
            $admisssion->mobile_no              = $row["mobile_no"];
            $admisssion->email                  = $row["email"];
            $admisssion->admission_date         = $row["admission_date"];
            $admisssion->blood_group            = $row["blood_group"];
            $admisssion->height                 = $row["height"];
            $admisssion->weight                 = $row["weight"];
            $admisssion->as_on_date             = $row["as_on_date"];
            $admisssion->fees_discount          = $row["fees_discount"];
            $admisssion->religion               = $row["religion"];
            $admisssion->religion_type          = $row["religion_type"];
            $admisssion->religion_type_other    = $row["religion_type_other"];
            $admisssion->siblings_in_mpa        = $row["siblings_in_mpa"];
            $admisssion->no_of_siblings         = $row["no_of_siblings"];
            $admisssion->student_vaccinated     = $row["student_vaccinated"];

            $admisssion->save();

        }

        return $my_error_bag;
        
    }

    public function prepareForValidation($data, $index)
    {

        $data['temporary_gr']                   = $data['temporary_gr']         ? (string)$data['temporary_gr']                     : '';
        $data['gender']                         = $data['gender']               ? strtolower($data['gender'])                       : '';
        $data['father_vaccinated']              = $data['father_vaccinated']    ? strtolower($data['father_vaccinated'])            : '';
        $data['student_vaccinated']             = $data['student_vaccinated']   ? strtolower($data['student_vaccinated'])           : '';
        $data['first_person_call']              = $data['first_person_call']    ? strtolower($data['first_person_call'])            : '';
        $data['student_vaccinated']             = $data['student_vaccinated']   ? strtolower($data['student_vaccinated'])           : '';
        $data['mother_vaccinated']              = $data['mother_vaccinated']    ? strtolower($data['mother_vaccinated'])            : '';
        $data['mother_cnic']                    = $data['mother_cnic']          ? str_replace('-', '', $data['mother_cnic'])        : '';       
        $data['father_salary']                  = $data['father_salary']        ? str_replace('k', '000', $data["father_salary"])   : '';
        $data['pick_and_drop']                  = $data['pick_and_drop']        ? str_replace(' ', '_', $data["pick_and_drop"])     : '';
        $data['pick_and_drop']                  = $data['pick_and_drop']        ? strtolower($data['pick_and_drop'])                : '';

        return $data;

    }

    /**
    * @return array
    */
    public function rules(): array
    {
        return [
            
            '*.temporary_gr'              =>  'required|unique:admissions,temporary_gr|string|min:1,max:10',  
            '*.gr'                        =>  'required|unique:admissions,gr|digits_between:1,11',          // required
            '*.bform_crms_no'             =>  'nullable|numeric|gt:0|digits:13',
            '*.first_name'                =>  'required|string|max:30',
            '*.last_name'                 =>  'required|string|max:30',
            '*.dob'                       =>  'nullable|date',
            '*.gender'                    =>  'required|in:male,female',
            '*.place_of_birth'            =>  'required|alpha|max:30',                  // required
            '*.nationality'               =>  'required|alpha|max:30',
            '*.mother_tongue'             =>  'required|alpha|max:30',
            '*.previous_class_id'         =>  'nullable|numeric|gt:0|digits_between:1,11',
            '*.previous_school'           =>  'nullable|max:30',
            '*.mobile_no'                 =>  'nullable|max:20',
            '*.email'                     =>  'nullable|email|max:30',
            '*.admission_date'            =>  'nullable|date',                              // invalid
            '*.blood_group'               =>  'nullable|min:2|max:3',
            '*.height'                    =>  'nullable|gt:0|between:1,10',
            '*.weight'                    =>  'nullable|gt:0',
            '*.as_on_date'                =>  'nullable|date',
            '*.fees_discount'             =>  'nullable|min:0|digits_between:1,3',
            '*.religion'                  =>  'required|max:20',                            // required
            '*.religion_type'             =>  'required|in:sunni,asna_ashri,other',
            '*.religion_type_other'       =>  'nullable|required_if:religion_type,other|max:20',        // invalid
            '*.siblings_in_mpa'           =>  'nullable|in:yes,no',                         
            '*.no_of_siblings'            =>  'nullable|numeric|required_if:siblings_in_mpa,yes|gt:0|digits_between:1,11',
            '*.student_vaccinated'        =>  'nullable|in:yes,no',
            '*.father_cnic'               =>  'required|numeric|gt:0|digits:13',
            '*.father_salary'             =>  'nullable|numeric|gt:0|digits_between:1,11',
            '*.father_email'              =>  'nullable|email|max:30',
            '*.father_name'               =>  'required|max:30',
            '*.father_phone'              =>  'required|numeric|gt:0|digits:11',                // required
            '*.father_occupation'         =>  'nullable|string|max:30',
            '*.father_company_name'       =>  'nullable|max:40',                                   // 30 -> 40                    
            '*.father_vaccinated'         =>  'nullable|in:yes,no',
            '*.mother_cnic'               =>  'required|numeric|gt:0|digits:13',
            '*.mother_salary'             =>  'nullable|numeric|gt:0|digits_between:1,11',
            '*.mother_email'              =>  'nullable|email|max:30',
            '*.mother_name'               =>  'required|max:30',
            '*.mother_phone'              =>  'required|numeric|gt:0|digits:11',                    // required
            '*.mother_occupation'         =>  'nullable|string:30',
            '*.mother_company_name'       =>  'nullable|max:30',
            '*.mother_vaccinated'         =>  'nullable|in:yes,no',
            '*.guardian_cnic'             =>  'nullable|numeric|gt:0|digits:13',
            '*.guardian_name'             =>  'nullable|max:30',
            '*.guardian_phone'            =>  'nullable|numeric|gt:0|digits:11',
            '*.guardian_relation'         =>  'nullable|in:uncle_aunty,grandfather_grandmother,neighbours,other',       // invalid
            '*.guardian_relation_other'   =>  'nullable|required_if:guardian_relation,other|max:20',
            '*.first_person_call'         =>  'required|in:father,mother,guardian',
            '*.current_house_no'          =>  'required|max:60',
            '*.current_block_no'          =>  'required|max:60',
            '*.current_building_name_no'  =>  'nullable|max:60',
            '*.current_area_id'           =>  'required|numeric|gt:0|digits_between:1,11',
            '*.current_city_id'           =>  'required|numeric|gt:0|digits_between:1,11',
            '*.pick_and_drop'             =>  'required|in:by_walk,by_ride,by_private_van,by_school_van',
            '*.vehicle_no'                =>  'nullable|required_if:pick_and_drop,by_ride|max:20',
            '*.vehicle_id'                =>  'nullable|required_if:pick_and_drop,by_school_van|required_if:pick_and_drop,by_private_van|digits_between:1,11',
            
        ];
    }
}
