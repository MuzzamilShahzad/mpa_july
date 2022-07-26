<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentDetailsExport implements FromArray, WithHeadings, ShouldAutoSize
{
    use Exportable;


    public $admissionListing;

    public function __construct($admissionListing){   

        $this->admissionListing = $admissionListing;
    }

    public function headings(): array{
        return [
            // "registration_id",
            "temporary_gr",
            "gr",
            "roll_no",
            "session",
            // "session_id",
            "campus",
            // "campus_id",
            "system",
            // "system_id",
            "class",
            // "class_id",
            "group",
            // "group_id",
            "section",
            // "section_id",
            "bform_crms_no",
            "first_name",
            "last_name",
            "dob",
            "gender",
            "place_of_birth",
            "nationality",
            "mother_tongue",
            "previous_class",
            // "previous_class_id",
            "previous_school",
            "mobile_no",
            "email",
            "admission_year",
            "admission_date",
            "blood_group",
            "height",
            "weight",
            // "as_on_date",
            "fee_discount",
            "religion",
            "religion_type",
            "religion_type_other",
            "siblings_in_mpa",
            "total_no_of_siblings",
            "no_of_siblings_in_mpa",
            "student_vaccinated",
            "father_cnic",
            "father_salary",
            "father_email",
            "father_name",
            "father_phone",
            "father_occupation",
            "father_company_name",
            "father_vaccinated",
            "mother_cnic",
            "mother_salary",
            "mother_email",
            "mother_name",
            "mother_phone",
            "mother_occupation",
            "mother_company_name",
            "mother_vaccinated",
            "guardian_cnic",
            "guardian_name",
            "guardian_phone",
            "guardian_relation",
            "guardian_other_relation",
            "first_person_call",
            "current_house_no",
            "current_block_no",
            "current_building_name_no",
            "current_area_id",
            "current_city_id",
            "same_as_current",
            "permanent_house_no",
            "permanent_block_no",
            "permanent_building_name_no",
            "permanent_area_id",
            "permanent_city_id",
            "pick_and_drop",
            "vehicle_id",
            "vehicle_no",
            "status"
        ];
    }

    public function array(): array
    {
        $admissionListingDetails = [];

        foreach($this->admissionListing as $key => $admission) {
            
            $admissionDetails = array();
                
            // $admissionDetails['registration_id']      =  $admission->registration_id;
            $admissionDetails['temporary_gr']         =  isset($admission->temporary_gr) ? $admission->temporary_gr : '';
            $admissionDetails['gr']                   =  isset($admission->gr) ? $admission->gr : '';
            $admissionDetails['roll_no']              =  isset($admission->roll_no) ? $admission->roll_no : '';
            $admissionDetails['session']              =  isset($admission->session) ? $admission->session : '';
            // $admissionDetails['session_id']           =  $admission->session_id;
            $admissionDetails['campus']               =  isset($admission->campus) ? $admission->campus : '';
            // $admissionDetails['campus_id']            =  $admission->campus_id;
            $admissionDetails['system']               =  isset($admission->system) ? $admission->system : '';
            // $admissionDetails['system_id']            =  $admission->system_id;
            $admissionDetails['class']                =  isset($admission->class) ? $admission->class : '';
            // $admissionDetails['class_id']             =  $admission->class_id;
            $admissionDetails['group']                =  isset($admission->group) ? $admission->group : '';
            // $admissionDetails['group_id']             =  $admission->group_id;
            $admissionDetails['section']              =  isset($admission->section) ? $admission->section : '';
            // $admissionDetails['section_id']           =  $admission->section_id;
            $admissionDetails['bform_crms_no']        =  isset($admission->bform_crms_no) ? $admission->bform_crms_no : '';
            $admissionDetails['first_name']           =  isset($admission->first_name) ? $admission->first_name : '';
            $admissionDetails['last_name']            =  isset($admission->last_name) ? $admission->last_name : '';
            $admissionDetails['dob']                  =  isset($admission->dob) ? date('Y-m-d', strtotime($admission->dob)) : NULL;

            $admissionDetails['gender']               =  isset($admission->gender) ? $admission->gender : '';
            $admissionDetails['place_of_birth']       =  isset($admission->place_of_birth) ? $admission->place_of_birth : '';
            $admissionDetails['nationality']          =  isset($admission->nationality) ? $admission->nationality : '';
            $admissionDetails['mother_tongue']        =  isset($admission->mother_tongue) ? $admission->mother_tongue : '';
            $admissionDetails['previous_class']       =  isset($admission->previous_class) ? $admission->previous_class : '';
            // $admissionDetails['previous_class_id']    =  $admission->previous_class_id;
            $admissionDetails['previous_school']      =  isset($admission->previous_school) ? $admission->previous_school : '';

            $admissionDetails['mobile_no']            =  isset($admission->mobile_no) ? $admission->mobile_no : '';
            $admissionDetails['email']                =  isset($admission->email) ? $admission->email : '';
            $admissionDetails['admission_year']       =  isset($admission->admission_date) ? date('Y', strtotime($admission->admission_date)) : '';
            $admissionDetails['admission_date']       =  isset($admission->admission_date) ? date('Y-m-d', strtotime($admission->admission_date)) : '';

            $admissionDetails['blood_group']          =  isset($admission->blood_group) ? $admission->blood_group : '';
            $admissionDetails['height']               =  isset($admission->height) ? $admission->height : '';
            $admissionDetails['weight']               =  isset($admission->weight) ? $admission->weight : '';
            // $admissionDetails['as_on_date']           =  date('Y-m-d', strtotime($admission->as_on_date));
            $admissionDetails['fee_discount']         =  isset($admission->fee_discount) ? $admission->fee_discount : '';
            
            $admissionDetails['religion']             =  isset($admission->religion) ? $admission->religion : '';
            $admissionDetails['religion_type']        =  isset($admission->religion_type) ? $admission->religion_type : '';
            $admissionDetails['religion_type_other']  =  isset($admissionDetails['religion_type']) && $admissionDetails['religion_type'] == "other" ? ($admission->religion_type_other ? $admission->religion_type_other : '') : '';
            
            $admissionDetails['siblings_in_mpa']        =  isset($admission->siblings_in_mpa) ? $admission->siblings_in_mpa : 'no';
            $admissionDetails['total_no_of_siblings']   =  isset($admission->siblings_in_mpa) && strtolower($admission->siblings_in_mpa) == "yes" ? ($admission->total_no_of_siblings  ? $admission->total_no_of_siblings : '') : '';
            $admissionDetails['no_of_siblings_in_mpa']  =  isset($admission->siblings_in_mpa) && strtolower($admission->siblings_in_mpa) == "yes" ? ($admission->no_of_siblings_in_mpa ? $admission->no_of_siblings_in_mpa : '') : '';
            // dd($admission->siblings_in_mpa.' '.$admission->total_no_of_siblings.' '.$admission->no_of_siblings_in_mpa);
            
            $admissionDetails['student_vaccinated']  =  $admission->student_vaccinated;

            $fatherDetails = json_decode($admission->father_details);
 
            $admissionDetails['father_cnic']          =  isset($fatherDetails->cnic)          ?  $fatherDetails->cnic : '';
            $admissionDetails['father_salary']        =  isset($fatherDetails->salary)        ?  $fatherDetails->salary : '';
            $admissionDetails['father_email']         =  isset($fatherDetails->email)         ?  $fatherDetails->email : '';
            $admissionDetails['father_name']          =  isset($fatherDetails->name)          ?  $fatherDetails->name : '';
            $admissionDetails['father_phone']         =  isset($fatherDetails->phone)         ?  $fatherDetails->phone : '';
            $admissionDetails['father_occupation']    =  isset($fatherDetails->occupation)    ?  $fatherDetails->occupation : '';
            $admissionDetails['father_company_name']  =  isset($fatherDetails->company_name)  ?  $fatherDetails->company_name : '';
            $admissionDetails['father_vaccinated']    =  isset($fatherDetails->vaccinated) && !empty($fatherDetails->vaccinated) ? 'yes' : 'no';
            
            $motherDetails = json_decode($admission->mother_details);

            $admissionDetails['mother_cnic']          =  isset($motherDetails->cnic)          ?  $motherDetails->cnic : '';
            $admissionDetails['mother_salary']        =  isset($motherDetails->salary)        ?  $motherDetails->salary : '';
            $admissionDetails['mother_email']         =  isset($motherDetails->email)         ?  $motherDetails->email : '';
            $admissionDetails['mother_name']          =  isset($motherDetails->name)          ?  $motherDetails->name : '';
            $admissionDetails['mother_phone']         =  isset($motherDetails->phone)         ?  $motherDetails->phone : '';
            $admissionDetails['mother_occupation']    =  isset($motherDetails->occupation)    ?  $motherDetails->occupation : '';
            $admissionDetails['mother_company_name']  =  isset($motherDetails->company_name)  ?  $motherDetails->company_name : '';
            $admissionDetails['mother_vaccinated']    =  isset($motherDetails->vaccinated) && !empty($motherDetails->vaccinated) ? 'Yes' : 'No';

            $guardianDetails = json_decode($admission->guardian_details);
            // dd($guardianDetails);

            $admissionDetails['guardian_cnic']            =  isset($guardianDetails->cnic)      ?  $guardianDetails->cnic : '';
            $admissionDetails['guardian_name']            =  isset($guardianDetails->name)      ?  $guardianDetails->name : '';
            $admissionDetails['guardian_phone']           =  isset($guardianDetails->phone)     ?  $guardianDetails->phone : '';
            $admissionDetails['guardian_relation']        =  isset($guardianDetails->relation)  ?  $guardianDetails->relation : '';
            $admissionDetails['guardian_other_relation']  =  isset($guardianDetails->relation) && $guardianDetails->relation == 'other' ? $guardianDetails->other_relation : '';
            $admissionDetails['first_person_call']        =  isset($guardianDetails->first_person_call)  ?  $guardianDetails->first_person_call : '';
            
            $addressDetails    =  json_decode($admission->address_details);
           
            
            // $currentAddress    =  json_decode($addressDetails->current_address);
            // $sameAsCurrent     =  json_decode($addressDetails->same_as_current);
            // $permanentAddress  =  json_decode($addressDetails->permanent_address);
            
            $currentAddress    =  $addressDetails->current_address;
            $sameAsCurrent     =  $addressDetails->same_as_current;
            $permanentAddress  =  $addressDetails->permanent_address;
            
            // dd($currentAddress);
            
            $admissionDetails['current_house_no']          =  isset($currentAddress->current_house_no)          ?  $currentAddress->current_house_no : '' ;
            $admissionDetails['current_block_no']          =  isset($currentAddress->current_block_no)          ?  $currentAddress->current_block_no : '' ;
            $admissionDetails['current_building_name_no']  =  isset($currentAddress->current_building_name_no)  ?  $currentAddress->current_building_name_no : '' ;
            $admissionDetails['current_area_id']           =  isset($currentAddress->current_area_id)           ?  $currentAddress->current_area_id : '' ;
            $admissionDetails['current_city_id']           =  isset($currentAddress->current_city_id)           ?  $currentAddress->current_city_id : '' ;
            
            $admissionDetails['same_as_current'] = isset($sameAsCurrent->same_as_current) ? $sameAsCurrent->same_as_current : 'no';
            // dd($admissionDetails['same_as_current']);

            if($admissionDetails['same_as_current'] == 'yes'){
                
                $admissionDetails['permanent_house_no']          =  isset($currentAddress->current_house_no)          ?  $currentAddress->current_house_no : '' ;
                $admissionDetails['permanent_block_no']          =  isset($currentAddress->current_block_no)          ?  $currentAddress->current_block_no : '' ;
                $admissionDetails['permanent_building_name_no']  =  isset($currentAddress->current_building_name_no)  ?  $currentAddress->current_building_name_no : '' ;
                $admissionDetails['permanent_area_id']           =  isset($currentAddress->current_area_id)           ?  $currentAddress->current_area_id : '' ;
                $admissionDetails['permanent_city_id']           =  isset($currentAddress->current_city_id)           ?  $currentAddress->current_city_id : '' ;

            } else {
                
                $admissionDetails['permanent_house_no']          =  isset($permanentAddress->permanent_house_no)          ?  $permanentAddress->permanent_house_no : '' ;
                $admissionDetails['permanent_block_no']          =  isset($permanentAddress->permanent_block_no)          ?  $permanentAddress->permanent_block_no : '' ;
                $admissionDetails['permanent_building_name_no']  =  isset($permanentAddress->permanent_building_name_no)  ?  $permanentAddress->permanent_building_name_no : '' ;
                $admissionDetails['permanent_area_id']           =  isset($permanentAddress->permanent_area_id)           ?  $permanentAddress->permanent_area_id : '' ;
                $admissionDetails['permanent_city_id']           =  isset($permanentAddress->permanent_city_id)           ?  $permanentAddress->permanent_city_id : '' ;
            
            }

            $admissionDetails['pick_and_drop']        =  $admission->pick_and_drop;
            
            if($admissionDetails['pick_and_drop'] == "by_ride"){
                $admissionDetails['vehicle_id']       =  '';
                $admissionDetails['vehicle_no']       =  $admission->vehicle_no;
            } else if($admissionDetails['pick_and_drop'] == "by_school_van" || $admissionDetails['pick_and_drop'] == "by_private_van") {
                $admissionDetails['vehicle_id']       =  $admission->vehicle_id;
                $admissionDetails['vehicle_no']       =  $admission->vehicle_no;
            } else{
                $admissionDetails['vehicle_id']       =  '';
                $admissionDetails['vehicle_no']       =  '';
            }
            
            $admissionDetails['status']        =  $admission->status;
            array_push($admissionListingDetails,$admissionDetails);

            // dd($admissionListingDetails);
        }
        
        return [
            $admissionListingDetails
        ];
    }
}
