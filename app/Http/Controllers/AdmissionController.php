<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Session;
use App\Models\Campus;
use App\Models\Section;
use App\Models\Area;
use App\Models\City;
use App\Models\Classes;
use App\Models\Admission;
use App\Models\Registration;
use App\Models\CampusClass;
use App\Models\Vehicle;
use App\Imports\StudentAdmissionImport;
use App\Exports\StudentAdmissionExport;
use App\Exports\StudentDetailsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session as Sessions;

class AdmissionController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Karachi");
    }

    public function listing(Request $request) {
        
        $session    =  Session::get();
        $campus     =  Campus::where('is_active',1)->where('is_delete',0)->get();
        $section    =  Section::get();
        $area       =  Area::get();
        $city       =  City::get();
        $class      =  Classes::get();
        
        if($request->session_id){
            $where['session_id'] = $request->session_id;
        }
        
        if($request->campus_id){
            $where['campus_id'] = $request->campus_id;
        }
        
        if($request->system_id){
            $where['system_id'] = $request->system_id;
        }
        
        if($request->class_id){
            $where['class_id'] = $request->class_id;
        }

        if($request->group_id){
            $where['group_id'] = $request->group_id;
        }

        if($request->section_id){
            $where['section_id'] = $request->section_id;
        }

        $where['is_active'] = 1;
        $where['is_delete'] = 0;
        $admission  =  Admission::where($where)->get();
        
        $data = array(
            'session'    =>  $session,
            'campus'     =>  $campus,
            'section'    =>  $section,
            'class'      =>  $class,
            'area'       =>  $area,
            'city'       =>  $city,
            'admission'  =>  $admission,
            'page'       =>  'Admission',
            'menu'       =>  'Admissions Listing'
        );

        return view('student.admission.listing', compact('data'));
    }
    
    public function getListingBySessionSystemClassGroupSection(Request $request) {
        
        if($request->session_id){
            $where['session_id'] = $request->session_id;
        }
        
        if($request->campus_id){
            $where['campus_id'] = $request->campus_id;
        }
        
        if($request->system_id){
            $where['system_id'] = $request->system_id;
        }
        
        if($request->class_id){
            $where['class_id'] = $request->class_id;
        }

        if($request->group_id){
            $where['group_id'] = $request->group_id;
        }

        if($request->section_id){
            $where['section_id'] = $request->section_id;
        }

        $where['admissions.is_active'] = 1;
        $where['admissions.is_delete'] = 0;

        $admission  = Admission::select('admissions.id',
                                        'admissions.temporary_gr',
                                        'admissions.gr',
                                        'admissions.first_name',
                                        'admissions.last_name',
                                        'admissions.father_details',
                                        'admissions.admission_date',
                                        'campuses.campus',
                                        'systems.system',
                                        'classes.class',
                                        'groups.group',
                                        'sections.section')
                                ->leftJoin('campuses','campuses.id','=','admissions.campus_id')
                                ->leftJoin('systems','systems.id','=','admissions.system_id')
                                ->leftJoin('classes','classes.id','=','admissions.class_id')
                                ->leftJoin('groups','groups.id','=','admissions.group_id')
                                ->leftJoin('sections','sections.id','=','admissions.section_id')
                                ->where($where)
                                // ->where('admissions.id',1)
                                ->get();
        $response = array(
            'data'         =>  $admission
        );

        return response()->json($response);

    }

    public function create() {
        $session  =  Session::get();
        $campus   =  Campus::where('is_active',1)->where('is_delete',0)->get();
        $section  =  Section::get();
        $area     =  Area::get();
        $city     =  City::get();
        $class    =  Classes::get();

        $data = array(
            'session'  =>  $session,
            'campus'   =>  $campus,
            'section'  =>  $section,
            'class'    =>  $class,
            'area'     =>  $area,
            'city'     =>  $city,
            'page'     =>  'Admission',
            'menu'     =>  'Add Admission'
        );

        // dd($data);

        return view('student.admission.add', compact('data'));
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'temporary_gr'              =>  'required|unique:admissions,temporary_gr|string|min:1,max:10',  
            'gr'                        =>  'required|unique:admissions,gr|string|min:1,max:20',
            'session_id'                =>  'required|numeric|gt:0|digits_between:1,11',
            'campus_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'system_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'class_id'                  =>  'required|numeric|gt:0|digits_between:1,11',
            'group_id'                  =>  'nullable|numeric|gt:0|digits_between:1,11',
            'section_id'                =>  'nullable|numeric|gt:0|digits_between:1,11',
            'bform_crms_no'             =>  'nullable|numeric|gt:0|digits:11',
            'first_name'                =>  'required|alpha|max:30',
            'last_name'                 =>  'required|alpha|max:30',
            'dob'                       =>  'nullable|date',
            'gender'                    =>  'required|in:male,female',
            'place_of_birth'            =>  'required|alpha|max:30',
            'nationality'               =>  'required|alpha|max:30',
            'mother_tongue'             =>  'required|alpha|max:30',
            'previous_class_id'         =>  'nullable|numeric|gt:0|digits_between:1,11',
            'previous_school'           =>  'nullable|max:30',
            'mobile_no'                 =>  'nullable|max:20',
            'email'                     =>  'nullable|email|max:30',
            'admission_date'            =>  'nullable|date',
            'blood_group'               =>  'nullable|min:2|max:3',
            'height'                    =>  'nullable|gt:0|between:1,10',
            'weight'                    =>  'nullable|gt:0',
            'as_on_date'                =>  'nullable|date',
            'fees_discount'             =>  'nullable|min:0|digits_between:1,3',
            'religion'                  =>  'required|max:20',
            'religion_type'             =>  'required|in:sunni,asna_ashri,other',
            'religion_type_other'       =>  'nullable|required_if:religion_type,other|max:20',
            'siblings_in_mpa'           =>  'nullable|in:yes,no',
            'no_of_siblings'            =>  'nullable|numeric|required_if:siblings_in_mpa,yes|gt:0|digits_between:1,11',
            'student_vaccinated'        =>  'nullable|in:yes,no',
            'father_cnic'               =>  'required|numeric|gt:0|digits:13',
            'father_salary'             =>  'nullable|numeric|gt:0|digits_between:1,11',
            'father_email'              =>  'nullable|email|max:30',
            'father_name'               =>  'required|max:30',
            'father_phone'              =>  'required|numeric|gt:0|digits:11',
            'father_occupation'         =>  'nullable|string|max:30',
            'father_company_name'       =>  'nullable|max:30',
            'father_vaccinated'         =>  'nullable|in:yes,no',
            'mother_cnic'               =>  'required|numeric|gt:0|digits:13',
            'mother_salary'             =>  'nullable|numeric|gt:0|digits_between:1,11',
            'mother_email'              =>  'nullable|email|max:30',
            'mother_name'               =>  'required|max:30',
            'mother_phone'              =>  'required|numeric|gt:0|digits:11',
            'mother_occupation'         =>  'nullable|string:30',
            'mother_company_name'       =>  'nullable|max:30',
            'mother_vaccinated'         =>  'nullable|in:yes,no',
            'guardian_cnic'             =>  'nullable|numeric|gt:0|digits:13',
            'guardian_name'             =>  'nullable|max:30',
            'guardian_phone'            =>  'nullable|numeric|gt:0|digits:11',
            'guardian_relation'         =>  'nullable|in:uncle_aunty,grandfather_grandmother,neighbours,other',
            'guardian_relation_other'   =>  'nullable|required_if:guardian_relation,other|max:20',
            'first_person_call'         =>  'required|in:father,mother,guardian',
            'current_house_no'          =>  'required|max:60',
            'current_block_no'          =>  'required|max:60',
            'current_building_name_no'  =>  'nullable|max:60',
            'current_area_id'           =>  'required|numeric|gt:0|digits_between:1,11',
            'current_city_id'           =>  'required|numeric|gt:0|digits_between:1,11',
            'pick_and_drop'             =>  'required|in:by_walk,by_ride,by_private_van,by_school_van',
            'vehicle_no'                =>  'nullable|required_if:pick_and_drop,by_ride|max:20',
            'vehicle_id'                =>  'nullable|required_if:pick_and_drop,by_school_van|required_if:pick_and_drop,by_private_van|digits_between:1,11',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);
            
        } else {
            $success = false;
            // DB::beginTransaction();
            try {
                
                $formData =  $request->all();

                $student  = new Admission();
               
                if(isset($request->temporary_gr) && !empty($request->temporary_gr)) {
                    $student->registration_id  = Registration::where('registration_id', $request->temporary_gr)->first()->id;
                }

                $student->temporary_gr         =  $request->temporary_gr;
                $student->gr                   =  $request->gr;
                $student->roll_no              =  $request->roll_no;
                $student->session_id           =  $request->session_id;
                $student->campus_id            =  $request->campus_id;
                $student->system_id            =  $request->system_id;
                $student->class_id             =  $request->class_id;
                $student->group_id             =  $request->group_id;
                $student->section_id           =  $request->section_id;
                $student->bform_crms_no        =  $request->bform_crms_no;
                $student->first_name           =  $request->first_name;
                $student->last_name            =  $request->last_name;
                $student->dob                  =  isset($request->dob) ? date('Y-m-d', strtotime($request->dob)) : NULL;

                $student->gender               =  $request->gender;
                $student->place_of_birth       =  $request->place_of_birth;
                $student->nationality          =  $request->nationality;
                $student->mother_tongue        =  $request->mother_tongue;
                $student->previous_class_id    =  $request->previous_class_id;
                $student->previous_school      =  $request->previous_school;

                $student->mobile_no            =  $request->mobile_no;
                $student->email                =  $request->email;
                $student->admission_date       =  date('Y-m-d', strtotime($request->admission_date));

                $student->blood_group          =  $request->blood_group;
                $student->height               =  $request->height;
                $student->weight               =  $request->weight;
                $student->as_on_date           =  date('Y-m-d', strtotime($request->as_on_date));
                $student->fee_discount         =  $request->fee_discount;
                
                $student->religion             =  $request->religion;
                $student->religion_type        =  $request->religion_type;
                $student->siblings_in_mpa      =  $request->siblings_in_mpa;
                $student->pick_and_drop        =  $request->pick_and_drop;
                
                if($student->pick_and_drop == "by_ride"){
                    $student->vehicle_no       =  $request->vehicle_no;
                }else if($student->pick_and_drop == "by_school_van" || $student->pick_and_drop == "by_private_van") {
                    $student->vehicle_id       =  $request->vehicle_id;
                }

                if($student->religion_type == "other"){
                    $student->religion_type_other  =  $request->religion_type_other;
                }
                
                if($student->siblings_in_mpa == "yes"){
                    $student->no_of_siblings_in_mpa  =  $request->no_of_siblings;
                }

                $student->student_vaccinated  =  $request->student_vaccinated;

                $fatherDetails = array(
                    'cnic'          =>  $request->father_cnic,
                    'salary'        =>  $request->father_salary,
                    'email'         =>  $request->father_email,
                    'name'          =>  $request->father_name,
                    'phone'         =>  $request->father_phone,
                    'occupation'    =>  $request->father_occupation,
                    'company_name'  =>  $request->father_company_name,
                    'vaccinated'    =>  $request->father_vaccinated
                );
                $student->father_details = json_encode($fatherDetails);
                
                $motherDetails = array(
                    'cnic'          =>  $request->mother_cnic,
                    'salary'        =>  $request->mother_salary,
                    'email'         =>  $request->mother_email,
                    'name'          =>  $request->mother_name,
                    'phone'         =>  $request->mother_phone,
                    'occupation'    =>  $request->mother_occupation,
                    'company_name'  =>  $request->mother_company_name,
                    'vaccinated'    =>  $request->mother_vaccinated
                );
                $student->mother_details = json_encode($motherDetails);

                $guardianDetails = array(
                    'cnic'               =>  $request->guardian_cnic,
                    'name'               =>  $request->guardian_name,
                    'phone'              =>  $request->guardian_phone,
                    'relation'           =>  $request->guardian_relation,
                    'other_relation'     =>  $request->guardian_relation == 'other' ? $request->guardian_other_relation : NULL,
                    'first_person_call'  =>  $request->first_person_call,
                );
                
                $student->guardian_details = json_encode($guardianDetails);
               
                $currentAddress = array(
                    'current_house_no'            =>  $request->current_house_no,
                    'current_block_no'            =>  $request->current_block_no,
                    'current_building_name_no'    =>  $request->current_building_name_no,
                    'current_area_id'             =>  $request->current_area_id,
                    'current_city_id'             =>  $request->current_city_id
                );

                if($request->same_as_current == 'on'){
                    
                    $sameAsCurrent = array(
                        'same_as_current' => 'yes'
                    );
                    
                    $permanentAddress = array(
                        'permanent_house_no'            =>  $request->current_house_no,
                        'permanent_block_no'            =>  $request->current_block_no,
                        'permanent_building_name_no'    =>  $request->current_building_name_no,
                        'permanent_area_id'             =>  $request->current_area_id,
                        'permanent_city_id'             =>  $request->current_city_id
                    );

                } else {
                    
                    $sameAsCurrent = array(
                        'same_as_current' => 'no'
                    );
                    
                    $permanentAddress = array(
                        'permanent_house_no'            =>  $request->permanent_house_no,
                        'permanent_block_no'            =>  $request->permanent_block_no,
                        'permanent_building_name_no'    =>  $request->permanent_building_name_no,
                        'permanent_area_id'             =>  $request->permanent_area_id,
                        'permanent_city_id'             =>  $request->permanent_city_id
                    );

                }

                $student->address_details = json_encode(array(
                    'current_address'    =>  $currentAddress,
                    'same_as_current'    =>  $sameAsCurrent,
                    'permanent_address'  =>  $permanentAddress

                ));

                // dd($student);
                
                if($student->save()){
                    
                    $response = array(
                        'status'   =>  true, 
                        'message'  =>  "Record has been inserted."
                    );

                } else {
                    $response = array(
                        'status'   =>  false, 
                        'message'  =>  "Error Occured"
                    );
                }

                return response()->json($response);

            } catch (\Exception $e) {
                // DB::rollback();
                $success = false;
                $response = array(
                    'status'   =>  false, 
                    'message'  =>  $e
                );
                return response()->json($response);
            }
        }
    }

    public function update(Request $request) {

        $validator = Validator::make($request->all(), [
            'temporary_gr'              =>  'required|string|min:1,max:10|unique:admissions,temporary_gr,'.$request->id,  
            'gr'                        =>  'required|string|min:1,max:20|unique:admissions,gr,'.$request->id,
            'session_id'                =>  'required|numeric|gt:0|digits_between:1,11',
            'campus_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'system_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'class_id'                  =>  'required|numeric|gt:0|digits_between:1,11',
            'group_id'                  =>  'nullable|numeric|gt:0|digits_between:1,11',
            'section_id'                =>  'nullable|numeric|gt:0|digits_between:1,11',
            'bform_crms_no'             =>  'nullable|string|max:20',
            'first_name'                =>  'required|alpha|max:30',
            'last_name'                 =>  'required|alpha|max:30',
            'dob'                       =>  'nullable|date',
            'gender'                    =>  'required|in:male,female',
            'place_of_birth'            =>  'required|alpha|max:30',
            'nationality'               =>  'required|alpha|max:30',
            'mother_tongue'             =>  'required|alpha|max:30',
            'previous_class_id'         =>  'nullable|numeric|gt:0|digits_between:1,11',
            'previous_school'           =>  'nullable|max:30',
            'mobile_no'                 =>  'nullable|max:20',
            'email'                     =>  'nullable|email|max:30',
            'admission_date'            =>  'nullable|date',
            'blood_group'               =>  'nullable|min:2|max:3',
            'height'                    =>  'nullable|gt:0|between:1,10',
            'weight'                    =>  'nullable|gt:0',
            'as_on_date'                =>  'nullable|date',
            'fees_discount'             =>  'nullable|min:0|digits_between:1,3',
            'religion'                  =>  'required|max:20',
            'religion_type'             =>  'required|in:sunni,asna_ashri,other',
            'religion_type_other'       =>  'nullable|required_if:religion_type,other|max:20',
            'siblings_in_mpa'           =>  'nullable|in:yes,no',
            'no_of_siblings'            =>  'nullable|numeric|required_if:siblings_in_mpa,yes|gt:0|digits_between:1,11',
            'student_vaccinated'        =>  'nullable|in:yes,no',
            'father_cnic'               =>  'required|numeric|gt:0|digits:13',
            'father_salary'             =>  'nullable|numeric|gt:0|digits_between:1,11',
            'father_email'              =>  'nullable|email|max:30',
            'father_name'               =>  'required|max:30',
            'father_phone'              =>  'required|numeric|gt:0|digits:11',
            'father_occupation'         =>  'nullable|string|max:30',
            'father_company_name'       =>  'nullable|max:30',
            'father_vaccinated'         =>  'nullable|in:yes,no',
            'mother_cnic'               =>  'required|numeric|gt:0|digits:13',
            'mother_salary'             =>  'nullable|numeric|gt:0|digits_between:1,11',
            'mother_email'              =>  'nullable|email|max:30',
            'mother_name'               =>  'required|max:30',
            'mother_phone'              =>  'required|numeric|gt:0|digits:11',
            'mother_occupation'         =>  'nullable|string:30',
            'mother_company_name'       =>  'nullable|max:30',
            'mother_vaccinated'         =>  'nullable|in:yes,no',
            'guardian_cnic'             =>  'nullable|numeric|gt:0|digits:13',
            'guardian_name'             =>  'nullable|max:30',
            'guardian_phone'            =>  'nullable|numeric|gt:0|digits:11',
            'guardian_relation'         =>  'nullable|in:uncle_aunty,grandfather_grandmother,neighbours,other',
            'guardian_relation_other'   =>  'nullable|required_if:guardian_relation,other|max:20',
            'first_person_call'         =>  'required|in:father,mother,guardian',
            'current_house_no'          =>  'required|max:60',
            'current_block_no'          =>  'required|max:60',
            'current_building_name_no'  =>  'nullable|max:60',
            'current_area_id'           =>  'required|numeric|gt:0|digits_between:1,11',
            'current_city_id'          =>  'required|numeric|gt:0|digits_between:1,11',
            'pick_and_drop'             =>  'required|in:by_walk,by_ride,by_private_van,by_school_van',
            'vehicle_no'                =>  'nullable|required_if:pick_and_drop,by_ride|max:20',
            'vehicle_id'                =>  'nullable|required_if:pick_and_drop,by_school_van|required_if:pick_and_drop,by_private_van|digits_between:1,11',
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()
            );
            
            return response()->json($response);
            
        } else {
            $success = false;
            // DB::beginTransaction();
            try {
                
                $studentDeatils  = Admission::findOrFail($request->id);
                $student  = new \stdClass;
                // dd($student);
                if(isset($request->temporary_gr) && !empty($request->temporary_gr)) {
                    $registration  = Registration::where('registration_id', $request->temporary_gr)->first();
                    // dd($registration_id);
                    if($registration){

                        $student->registration_id  = $registration->id;
                    }
                }

                $student->temporary_gr         =  $request->temporary_gr;
                $student->gr                   =  $request->gr;
                $student->roll_no              =  $request->roll_no;
                $student->session_id           =  $request->session_id;
                $student->campus_id            =  $request->campus_id;
                $student->system_id            =  $request->system_id;
                $student->class_id             =  $request->class_id;
                $student->group_id             =  $request->group_id;
                $student->section_id           =  $request->section_id;
                $student->bform_crms_no        =  $request->bform_crms_no;
                $student->first_name           =  $request->first_name;
                $student->last_name            =  $request->last_name;
                $student->dob                  =  isset($request->dob) ? date('Y-m-d', strtotime($request->dob)) : NULL;

                $student->gender               =  $request->gender;
                $student->place_of_birth       =  $request->place_of_birth;
                $student->nationality          =  $request->nationality;
                $student->mother_tongue        =  $request->mother_tongue;
                $student->previous_class_id    =  $request->previous_class_id;
                $student->previous_school      =  $request->previous_school;

                $student->mobile_no            =  $request->mobile_no;
                $student->email                =  $request->email;
                $student->admission_date       =  date('Y-m-d', strtotime($request->admission_date));

                $student->blood_group          =  $request->blood_group;
                $student->height               =  $request->height;
                $student->weight               =  $request->weight;
                $student->as_on_date           =  date('Y-m-d', strtotime($request->as_on_date));
                $student->fee_discount         =  $request->fee_discount;
                
                $student->religion             =  $request->religion;
                $student->religion_type        =  $request->religion_type;
                $student->siblings_in_mpa      =  $request->siblings_in_mpa;
                $student->pick_and_drop        =  $request->pick_and_drop;
                
                if($student->pick_and_drop == "by_ride"){
                    $student->vehicle_no       =  $request->vehicle_no;
                }else if($student->pick_and_drop == "by_school_van" || $student->pick_and_drop == "by_private_van") {
                    $student->vehicle_id       =  $request->vehicle_id;
                }

                if($student->religion_type == "other"){
                    $student->religion_type_other  =  $request->religion_type_other;
                }
                
                if($student->siblings_in_mpa == "yes"){
                    $student->no_of_siblings_in_mpa  =  $request->no_of_siblings;
                }

                $student->student_vaccinated  =  $request->student_vaccinated;

                $fatherDetails = array(
                    'cnic'          =>  $request->father_cnic,
                    'salary'        =>  $request->father_salary,
                    'email'         =>  $request->father_email,
                    'name'          =>  $request->father_name,
                    'phone'         =>  $request->father_phone,
                    'occupation'    =>  $request->father_occupation,
                    'company_name'  =>  $request->father_company_name,
                    'vaccinated'    =>  $request->father_vaccinated
                );
                $student->father_details = json_encode($fatherDetails);
                
                $motherDetails = array(
                    'cnic'          =>  $request->mother_cnic,
                    'salary'        =>  $request->mother_salary,
                    'email'         =>  $request->mother_email,
                    'name'          =>  $request->mother_name,
                    'phone'         =>  $request->mother_phone,
                    'occupation'    =>  $request->mother_occupation,
                    'company_name'  =>  $request->mother_company_name,
                    'vaccinated'    =>  $request->mother_vaccinated
                );
                $student->mother_details = json_encode($motherDetails);

                $guardianDetails = array(
                    'cnic'               =>  $request->guardian_cnic,
                    'name'               =>  $request->guardian_name,
                    'phone'              =>  $request->guardian_phone,
                    'relation'           =>  $request->guardian_relation,
                    'other_relation'     =>  $request->guardian_relation == 'other' ? $request->guardian_other_relation : NULL,
                    'first_person_call'  =>  $request->first_person_call,
                );
                
                $student->guardian_details = json_encode($guardianDetails);
               
                $currentAddress = array(
                    'current_house_no'            =>  $request->current_house_no,
                    'current_block_no'            =>  $request->current_block_no,
                    'current_building_name_no'    =>  $request->current_building_name_no,
                    'current_area_id'             =>  $request->current_area_id,
                    'current_city_id'             =>  $request->current_city_id
                );

                if($request->same_as_current == 'on'){
                    
                    $sameAsCurrent = array(
                        'same_as_current' => 'yes'
                    );
                    
                    $permanentAddress = array(
                        'permanent_house_no'            =>  $request->current_house_no,
                        'permanent_block_no'            =>  $request->current_block_no,
                        'permanent_building_name_no'    =>  $request->current_building_name_no,
                        'permanent_area_id'             =>  $request->current_area_id,
                        'permanent_city_id'             =>  $request->current_city_id
                    );

                } else {
                    
                    $sameAsCurrent = array(
                        'same_as_current' => 'no'
                    );
                    
                    $permanentAddress = array(
                        'permanent_house_no'            =>  $request->permanent_house_no,
                        'permanent_block_no'            =>  $request->permanent_block_no,
                        'permanent_building_name_no'    =>  $request->permanent_building_name_no,
                        'permanent_area_id'             =>  $request->permanent_area_id,
                        'permanent_city_id'             =>  $request->permanent_city_id
                    );

                }

                $student->address_details = json_encode(array(
                    'current_address'    =>  $currentAddress,
                    'same_as_current'    =>  $sameAsCurrent,
                    'permanent_address'  =>  $permanentAddress

                ));

                // dd($student);
                $data = (array) $student;
                $update = Admission::where('id',$request->id)->update($data);
                
                if($update){
                    
                    $response = array(
                        'status'   =>  true, 
                        'message'  =>  "Record has been updated successfully."
                    );

                } else {
                    $response = array(
                        'status'   =>  false, 
                        'message'  =>  "Error Occured"
                    );
                }

                return response()->json($response);

            } catch (\Exception $e) {
                // DB::rollback();
                $success = false;
                $response = array(
                    'status'   =>  false, 
                    'message'  =>  'éxception '.$e
                );
                return response()->json($response);
            }
        }
    }

    public function delete(Request $request) {
        
        $admission_id      =  $request->admission_id;
        
        if($admission_id){
            $admissionDetails  =  Admission::find($admission_id);
            
            if($admissionDetails){
                
                $deleteAdmission = Admission::where('id',$student_id)->delete();

                if ($deleteAdmission) {
                    $response = array(
                        'status'   =>  true, 
                        'message'  =>  'Record has been deleted successfully!'
                    );
                } else {
                    $response = array(
                        'status'   =>  false,
                        'message'  =>  'Some thing went worng!'
                    );
                }
            } else {
                $response = array(
                    'status'   =>  false,
                    'message'  =>  'Admission Not Found.'
                );
            }
            return response()->json($response); 
        }
    }

    public function studentPromotion(Request $request){
        $validator = Validator::make($request->all(), [
            'campus_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'system_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'class_id'                  =>  'required|numeric|gt:0|digits_between:1,11',
            'session_id'                =>  'required|numeric|gt:0|digits_between:1,11',
            'section_id'                =>  'required|numeric|gt:0|digits_between:1,11',
            // 'group_id'                  =>  'required|numeric|gt:0|digits_between:1,11',
            'registeration_ids'         =>  'required|array'
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'  =>  false,
                'error'   =>  $validator->errors()
            );

            return response()->json($response);
        } else {
            // $query = Admission::whereIn('id', $request->registeration_ids)->update([
            //     "campus_id"             => $request->campus_id,
            //     "system_id"             => $request->system_id,
            //     "class_id"              => $request->class_id,
            //     "session_id"            => $request->session_id,
            //     "group_id"              => $request->group_id,
            // ]);

            $data = array(
                "campus_id"             => $request->campus_id,
                "system_id"             => $request->system_id,
                "class_id"              => $request->class_id,
                "session_id"            => $request->session_id,
                // "group_id"              => $request->group_id,
                "section_id"            => $request->section_id,
            );
            
            if(isset($request->group_id) && $request->group_id > 0){
                $data['group_id'] = $request->group_id;
            }
            
            $query = Admission::whereIn('id', $request->registeration_ids)->update($data);

            if ($query) {
                $response = array(
                    'status'   =>  true,
                    'message'  =>  "Students promoted successfully."
                );
                return response()->json($response);
            } else {
                $response = array(
                    'status'   =>  false,
                    'message'  =>  'Some thing went worng please try again letter'
                );
                return response()->json($response);
            }
        }
    }

    public function edit($id) {

        $request = array(
            'id' => $id
        );
        
        $validator = Validator::make($request,[
            'id'  =>  'required|numeric|gt:0|digits_between:1,11',
        ]);

        if($validator->fails()){

            $response = array(
                'status'  =>  false,
                'error'   =>  $validator->errors()
            );

            return response()->json($response);

        } else {

            $session  =  Session::get();
            $campus   =  Campus::where('is_active',1)->where('is_delete',0)->get();
            $section  =  Section::get();
            $area     =  Area::get();
            $city     =  City::get();
            $class    =  Classes::get();
            $vehicle  =  Vehicle::get();
    
            $data = array(
                'session'  =>  $session,
                'campus'   =>  $campus,
                'section'  =>  $section,
                'class'    =>  $class,
                'area'     =>  $area,
                'city'     =>  $city,
                'page'     =>  'Admission',
                'menu'     =>  'Edit Admission'
            );
        
            $admission  = Admission::select('admissions.*',
                                            'campuses.campus',
                                            'systems.system',
                                            'classes.class',
                                            'groups.group',
                                            'sections.section')
                                    ->leftJoin('campuses','campuses.id','=','admissions.campus_id')
                                    ->leftJoin('systems','systems.id','=','admissions.system_id')
                                    ->leftJoin('classes','classes.id','=','admissions.class_id')
                                    ->leftJoin('groups','groups.id','=','admissions.group_id')
                                    ->leftJoin('sections','sections.id','=','admissions.section_id')
                                    ->where('admissions.id', $request['id'])
                                    ->first();
            
            if($admission){
                
                if($admission->vehicle_id){
                    $pick_and_drop = str_replace('by_','',$admission->pick_and_drop);
                    $vehicle = Vehicle::where('vehicle_type',$pick_and_drop)->get();
                    $data['vehicle']     =  $vehicle;
                } else {
                    $data['vehicle'] = Vehicle::get();
                }
                // dd($admission->vehicle_id);
                // dd($data['vehicle']);
                if($admission->campus_id) {

                    $system = Campus::select('systems.*')
                                ->join('campus_details', 'campus_details.campus_id', '=', 'campuses.id')
                                ->join('systems', 'systems.id', '=', 'campus_details.system_id')
                                ->where('campuses.id', $admission->campus_id)
                                ->where('campuses.is_active', 1)
                                ->where('campuses.is_delete', 0)
                                ->get();

                } else {

                    $system = System::get();
                }
                
                // dd($system);
        
                $campusClass = Classes::select('classes.id', 'classes.class')
                                        ->join('campus_classes', 'campus_classes.class_id', '=', 'classes.id')
                                        ->join('campus_details', 'campus_details.id', '=', 'campus_classes.campus_detail_id')
                                        ->where('campus_details.campus_id', $admission->campus_id)
                                        ->where('campus_details.system_id', $admission->system_id)
                                        ->where('classes.is_active', 1)
                                        ->where('classes.is_delete', 0)
                                        ->get();
        
                $group = CampusClass::select('groups.*')
                                    ->join('campus_details', 'campus_details.id', '=', 'campus_classes.campus_detail_id')
                                    ->join('class_groups', 'class_groups.class_id', '=', 'campus_classes.class_id')
                                    ->join('groups', 'groups.id', '=', 'class_groups.group_id')
                                    ->where('campus_details.campus_id', $admission->campus_id)
                                    ->where('campus_details.system_id', $admission->system_id)
                                    ->where('campus_classes.class_id', $admission->class_id)
                                    ->get();

                $data['admission']     =  $admission;
                $data['system']        =  $system;
                $data['campus_class']  =  $campusClass;
                $data['group']         =  $group;

                $data['admission']['father_details']    =  json_decode($data['admission']->father_details);
                $data['admission']['mother_details']    =  json_decode($data['admission']->mother_details);
                $data['admission']['guardian_details']  =  json_decode($data['admission']->guardian_details);
                $data['admission']['address_details']   =  json_decode($data['admission']->address_details);

                // dd($data['admission']->address_details->same_as_current);
                // dd($data['admission']->guardian_details);
                
                return view('student.admission.edit', compact('data'));
                
            } else {

                $data['admission']  =  $admission;
                return redirect()->view('student.admission.edit', compact('data'));
            }
        }
    }

    public function import(){

        $campuses        =  Campus::get();
        $sessions        =  Session::get();
        $sections        =  Section::get();
        $areas           =  Area::get();

        $data = array(
            'campus'         =>  $campuses,
            'session'        =>  $sessions,
            'section'        =>  $sections,
            'areas'          =>  $areas,
            'page'           =>  'Admission',
            'menu'           =>  'Import Student Admission Data'
        );
        
        return view('student.admission.import',compact('data'));
    }

    public function importStore(Request $request){

        $validator = Validator::make($request->all(),[
            'session_id'        =>  'nullable|numeric|gt:0|digits_between:1,11',
            'section_id'        =>  'nullable|numeric|gt:0|digits_between:1,11',
            'campus_id'         =>  'nullable|numeric|gt:0|digits_between:1,11',
            'system_id'         =>  'nullable|numeric|gt:0|digits_between:1,11',
            'class_id'          =>  'nullable|numeric|gt:0|digits_between:1,11',
            'group_id'          =>  'nullable|numeric|gt:0|digits_between:1,11',
            'import_file'       =>  'required|mimes:xlsx,xls,csv'
        ]);
       
        if($validator->fails()) {

            $response = array(
                'status'  =>  false,
                'error'   =>  $validator->errors()
            );

            return response()->json($response);

        } else {
            $data = [
                "session_id"    => $request->session_id,
                "section_id"    => $request->section_id,
                "campus_id"     => $request->campus_id,
                "system_id"     => $request->system_id,
                "class_id"      => $request->class_id,
                "group_id"      => $request->group_id
            ];

            $dataForExport = [];
            $errorsForReurnToBladeFile = [];
            $flag = false;
            $file_path = "";

            try {

                $import = new StudentAdmissionImport($data);
                $import->import(request()->file('import_file'));

                foreach ($import->failures() as $failure) {
                   
                    // $failure->row();        // row that went wrong
                    // $failure->attribute();  // either heading key (if using heading row concern) or column index
                    // $failure->errors();     // Actual error messages from Laravel validator
                    // $failure->values();     // The values of the row that has failed.

                    if($failure->row()) {
                        $flag = true;
                        $errorsForReurnToBladeFile [$failure->row()][$failure->attribute()] = $failure->errors();
                        $dataForExport [$failure->row()] = $failure->values();    
                    }
               }

               if($flag) {
                    ksort($dataForExport);
                    ksort($errorsForReurnToBladeFile);
                    // dd($errorsForReurnToBladeFile);
                    $file_name = date('Y-m-d_H-i-s');          
                    // Excel::store(new StudentAdmissionExport($dataForExport, $failure->errors()), 'uploads/student/admissions/student-admission-'.$file_name.'.xlsx');
                    Excel::store(new StudentAdmissionExport($dataForExport, $errorsForReurnToBladeFile), 'uploads/student/admissions/student-admission-'.$file_name.'.xlsx', 'public');  
                    Sessions::put('excel_file_path', 'uploads/student/admissions/student-admission-'.$file_name.'.xlsx');
                }
                
                return redirect()->back()->with('errors', $errorsForReurnToBladeFile);
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();

                foreach ($failures as $failure) {
                    $failure->row();        // row that went wrong
                    $failure->attribute();  // either heading key (if using heading row concern) or column index
                    $failure->errors();     // Actual error messages from Laravel validator
                    $failure->values();     // The values of the row that has failed.

                    if($failure->row()) {
                        $flag = true;
                        $errorsForReurnToBladeFile [$failure->row()][$failure->attribute()] = $failure->errors();
                        $dataForExport [$failure->row()] = $failure->values();    
                    }
               }

               if($flag) {
                    ksort($dataForExport);
                    $file_name = date('Y-m-d_H-i-s');          
                    Excel::store(new StudentAdmissionExport($dataForExport), 'public/uploads/student/admissions/student-admission-'.$file_name.'.xlsx');
                    $file_path = 'student-admission-2022-07-19_19-29-16'.$file_name.'.xlsx';
            }
                // foreach ($failures as $key => $failure) {
                //     echo "<pre>";
                //     print_r($failure->row());    
                //     echo "<br />";                
                //     // if($failure->row()) {
                //     //     $dataForExport [$failure->row()] = $failure->values();
                //     //     // $dataForExport [$failure->row()][$failure->attribute()] = $failure->errors();
                //     // }

                //     // $errorsForReurnToBladeFile [$failure->row()][$failure->attribute()] = $failure->errors();                   
                //     $errorsForReurnToBladeFile [$failure->row()]["values"] = $failure->values();                   
                // }

                // dd("as");


            }

            return redirect()->back()->with('errors', $errorsForReurnToBladeFile);
        }
    }

    public function exportExcel(Request $request)
    {
        if($request->session_id){
            $where['session_id'] = $request->session_id;
        }
        
        if($request->campus_id){
            $where['campus_id'] = $request->campus_id;
        }
        
        if($request->system_id){
            $where['system_id'] = $request->system_id;
        }
        
        if($request->class_id){
            $where['class_id'] = $request->class_id;
        }

        if($request->group_id){
            $where['group_id'] = $request->group_id;
        }

        if($request->section_id){
            $where['section_id'] = $request->section_id;
        }
        
        if($request->admission_id){
            $where['admissions.id'] = $request->admission_id;
        }

        
        $where['admissions.is_active'] = 1;
        $where['admissions.is_delete'] = 0;
        // dd($where);

        $admissionListing  = Admission::select('admissions.*',
                                                'admissions.id',
                                                // 'admissions.temporary_gr',
                                                // 'admissions.gr',
                                                // 'admissions.first_name',
                                                // 'admissions.last_name',
                                                // 'admissions.father_details',
                                                // 'admissions.admission_date',
                                                'sessions.session',
                                                'campuses.campus',
                                                'systems.system',
                                                'classes.class',
                                                'previous_class.class as previous_class',
                                                'groups.group',
                                                'sections.section')
                                        ->leftJoin('sessions','sessions.id','=','admissions.session_id')
                                        ->leftJoin('campuses','campuses.id','=','admissions.campus_id')
                                        ->leftJoin('systems','systems.id','=','admissions.system_id')
                                        ->leftJoin('classes as classes','classes.id','=','admissions.class_id')
                                        ->leftJoin('classes as previous_class','previous_class.id','=','admissions.previous_class_id')
                                        ->leftJoin('groups','groups.id','=','admissions.group_id')
                                        ->leftJoin('sections','sections.id','=','admissions.section_id')
                                        ->where($where)
                                        ->get();
        // dd($admissionListing);

        $file_name = 'student_details_'.date('d-m-Y');
        
        return Excel::download(new StudentDetailsExport($admissionListing), $file_name.'.xlsx');
    }

}
