<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Campus;
use App\Models\Session;
use App\Models\Section;
use App\Models\Area;
use App\Models\City;
use App\Models\Classes;
use App\Models\Registration;
use App\Models\CampusClass;
use App\Models\TestInterviewGroup;
use Illuminate\Support\Facades\View;

class StudentRegistrationController extends Controller
{

    public function listing()
    {
        $classes        =  Classes::get();
        $campuses       =  Campus::where('is_active', 1)->where('is_delete', 0)->get();
        $sessions       =  Session::get();
        $areas          =  Area::get();
        $cities         =  City::get();
        $studentClasses =  Classes::get();
        $sections       =  Section::get();
        $students       =  Registration::get();
        $tests          =  TestInterviewGroup::where('type', 'test')->get();
        $interviews     =  TestInterviewGroup::where('type', 'interview')->get();

        $data = array(
            'campuses'        =>  $campuses,
            'classes'         =>  $classes,
            'sessions'        =>  $sessions,
            'studentClasses'  =>  $studentClasses,
            'sections'        =>  $sections,
            'areas'           =>  $areas,
            'cities'          =>  $cities,
            'students'        =>  $students,
            'tests'           =>  $tests,
            'interviews'      =>  $interviews,
            'page'            =>  'Registeration',
            'menu'            =>  'Manage Registeration'
        );

        return view('student.registration.listing', compact('data'));
    }

    public function getListingBySessionSystemClassGroup(Request $request)
    {

        if ($request->session_id) {
            $where['session_id'] = $request->session_id;
        }
        if ($request->campus_id) {
            $where['campus_id'] = $request->campus_id;
        }
        if ($request->system_id) {
            $where['system_id'] = $request->system_id;
        }
        if ($request->class_id) {
            $where['class_id'] = $request->class_id;
        }
        if ($request->group_id) {
            $where['group_id'] = $request->group_id;
        }

        $where['student_registrations.is_active'] = 1;
        $where['student_registrations.is_delete'] = 0;

        $registration = Registration::select(
            'student_registrations.id',
            'student_registrations.registration_id',
            'student_registrations.first_name',
            'student_registrations.last_name',
            'student_registrations.father_details',
            'campuses.campus',
            'systems.system',
            'classes.class',
            'groups.group'
        )
            ->leftJoin('campuses', 'campuses.id', '=', 'student_registrations.campus_id')
            ->leftJoin('systems', 'systems.id', '=', 'student_registrations.system_id')
            ->leftJoin('classes', 'classes.id', '=', 'student_registrations.class_id')
            ->leftJoin('groups', 'groups.id', '=', 'student_registrations.class_group_id')
            ->where($where)
            ->get();

        $response = array(
            'data'              =>  $registration
        );

        return response()->json($response);
    }

    public function registrationDetails(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id'       =>  'required|numeric|gt:0|digits_between:1,11',
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'  =>  false,
                'error'   =>  $validator->errors()
            );

            return response()->json($response);
        } else {

            $classes        =  Classes::get();
            $campuses       =  Campus::where('is_active', 1)->where('is_delete', 0)->get();
            $sessions       =  Session::get();
            $areas          =  Area::get();
            $cities         =  City::get();
            $sections       =  Section::get();
            $tests          =  TestInterviewGroup::where('type', 'test')->get();
            $interviews     =  TestInterviewGroup::where('type', 'interview')->get();
            $registration   = Registration::findOrFail($request->id);

            $campusSchoolSystems = Campus::select('systems.*')
                ->join('campus_details', 'campus_details.campus_id', '=', 'campuses.id')
                ->join('systems', 'systems.id', '=', 'campus_details.system_id')
                ->where('campuses.id', $registration->campus_id)
                ->where('campuses.is_active', 1)
                ->where('campuses.is_delete', 0)
                ->get();

            $campusClasses = Classes::select('classes.id', 'classes.class')
                ->join('campus_classes', 'campus_classes.class_id', '=', 'classes.id')
                ->join('campus_details', 'campus_details.id', '=', 'campus_classes.campus_detail_id')
                ->where('campus_details.campus_id', $registration->campus_id)
                ->where('campus_details.system_id', $registration->system_id)
                ->where('classes.is_active', 1)
                ->where('classes.is_delete', 0)
                ->get();

            $classGroups = CampusClass::select('groups.*')
                ->join('campus_details', 'campus_details.id', '=', 'campus_classes.campus_detail_id')
                ->join('class_groups', 'class_groups.class_id', '=', 'campus_classes.class_id')
                ->join('groups', 'groups.id', '=', 'class_groups.group_id')
                ->where('campus_details.campus_id', $registration->campus_id)
                ->where('campus_details.system_id', $registration->system_id)
                ->where('campus_classes.class_id', $registration->class_id)
                ->get();


            $data = array(
                'campuses'          =>  $campuses,
                'classes'           =>  $classes,
                'sessions'          =>  $sessions,
                'sections'          =>  $sections,
                'areas'             =>  $areas,
                'cities'            =>  $cities,
                'tests'             =>  $tests,
                'interviews'        =>  $interviews,
                'systems'           =>  $registration,
                'registration'      =>  $registration,
                'campusClasses'           =>  $campusClasses,
                'systems'           =>  $campusSchoolSystems,
                'classGroups'       =>  $classGroups
            );

            $data = (string)View::make('student.registration.modal', compact('data'));
            return response()->json(["status" => true, "data" => $data]);
        }
    }

    public function edit($id)
    {
        $test = ["id" => $id];
        $validator = Validator::make($test, [
            'id'        =>  'numeric|gt:0|digits_between:1,11',
        ]);

        if ($validator->errors()->all()) {
            return redirect()->route('student.registration.listing')->with('error', $validator->errors()->toArray());
        }
        
        $classes        =   Classes::get();
        $campuses       =   Campus::where('is_active', 1)->where('is_delete', 0)->get();
        $sessions       =   Session::get();
        $areas          =   Area::get();
        $cities         =   City::get();
        $sections       =   Section::get();
        $tests          =   TestInterviewGroup::where('type', 'test')->get();
        $interviews     =   TestInterviewGroup::where('type', 'interview')->get();
        $registration   =   Registration::where('id', $id)->first();
        
        if(!$registration) {
            return redirect()->route('student.registration.listing')->with('error', "Registeraion Id: $id not found");
        }
       
        if($registration && isset($registration->campus_id)) {
            $systems = Campus::select('systems.*')
            ->join('campus_details', 'campus_details.campus_id', '=', 'campuses.id')
            ->join('systems', 'systems.id', '=', 'campus_details.system_id')
            ->where('campuses.id', $registration->campus_id)
            ->where('campuses.is_active', 1)
            ->where('campuses.is_delete', 0)
            ->get();
        }else {
            $systems = [];
        }

        if($registration && isset($registration->campus_id)) {
            $campusClasses = Classes::select('classes.id', 'classes.class')
                ->join('campus_classes', 'campus_classes.class_id', '=', 'classes.id')
                ->join('campus_details', 'campus_details.id', '=', 'campus_classes.campus_detail_id')
                ->where('campus_details.campus_id', $registration->campus_id)
                ->where('campus_details.system_id', $registration->system_id)
                ->where('classes.is_active', 1)
                ->where('classes.is_delete', 0)
                ->get();
        }else {
            $campusClasses = [];
        }
        if($registration && isset($registration->campus_id)) {
            $classGroups = CampusClass::select('groups.*')
                ->join('campus_details', 'campus_details.id', '=', 'campus_classes.campus_detail_id')
                ->join('class_groups', 'class_groups.class_id', '=', 'campus_classes.class_id')
                ->join('groups', 'groups.id', '=', 'class_groups.group_id')
                ->where('campus_details.campus_id', $registration->campus_id)
                ->where('campus_details.system_id', $registration->system_id)
                ->where('campus_classes.class_id', $registration->class_id)
                ->get();
        }else {
            $classGroups = [];
        }

        $data = array(
            'campus'            =>  $campuses,
            'session'           =>  $sessions,
            'sections'          =>  $sections,
            'areas'             =>  $areas,
            'cities'            =>  $cities,
            'tests'             =>  $tests,
            'interviews'        =>  $interviews,
            'systems'           =>  $registration,
            'registration'      =>  $registration,
            'campusClasses'     =>  $campusClasses,
            'classes'           =>  $classes,
            'systems'           =>  $systems,
            'groups'            =>  $classGroups,
            'father_details'    =>  json_decode($registration->father_details),
            'page'              =>  'Registeration',
            'menu'              =>  'Edit Admission'
        );

        return view('student.registration.edit', compact("data"));
        
    }

    public function add()
    {

        $campus         =  Campus::get();
        $session        =  Session::get();
        $area           =  Area::get();
        $city           =  City::get();
        $class          =  Classes::get();
        $tests          =  TestInterviewGroup::where('type', 'test')->get();
        $interviews     =  TestInterviewGroup::where('type', 'interview')->get();

        $data = array(
            'campus'        =>  $campus,
            'session'       =>  $session,
            'class'         =>  $class,
            'area'          =>  $area,
            'city'          =>  $city,
            'tests'         =>  $tests,
            'interviews'    =>  $interviews,
            'page'          =>  'Student Registration',
            'menu'          =>  'Add Student Registration'
        );

        return view('student.registration.add', compact('data'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'campus_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'system_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'class_id'                  =>  'required|numeric|gt:0|digits_between:1,11',
            'session_id'                =>  'required|numeric|gt:0|digits_between:1,11',
            'class_group_id'            =>  'numeric|gt:0|digits_between:1,11',
            'form_no'                   =>  'nullable|alpha_dash|max:20',
            'first_name'                =>  'required|alpha|max:30',
            'last_name'                 =>  'required|alpha|max:30',
            'dob'                       =>  'nullable|date',
            'gender'                    =>  'required|alpha',
            'siblings_in_mpa'           =>  'string|max:3',
            'no_of_siblings'            =>  'nullable|numeric|gt:0|digits_between:1,11',
            'previous_class_id'         =>  'nullable|numeric|gt:0|digits_between:1,11',
            'previous_school'           =>  'max:60',
            // CURRENT ADDRESS
            'house_no'                  =>  'required|string|max:60',
            'block_no'                  =>  'required|string|max:60',
            'building_no'               =>  'required|string|max:60',
            'area_id'                   =>  'required|numeric|gt:0|digits_between:1,11',
            'city_id'                   =>  'required|numeric|gt:0|digits_between:1,11',
            // FATHERS DETAIL
            'father_salary'             =>  'nullable|numeric|gt:0|digits_between:1,11',
            'father_name'               =>  'required|max:30',
            'father_cnic'               =>  'required|numeric|gt:0|digits:13',
            'father_email'              =>  'nullable|email|max:60',
            'father_occupation'         =>  'string|max:30',
            'father_company_name'       =>  'max:30',
            'father_phone'              =>  'required|numeric|gt:0|digits:11',
            'hear_about_us'             =>  'nullable|string|max:20',
            'hear_about_us_other'       =>  'required_if:hear_about_us,other|string|max:20',
            // TEST-INTERVIEW GROUP
            'test_group_id'             =>  'nullable|numeric|gt:0|digits_between:1,11',
            'interview_group_id'        =>  'nullable|numeric|gt:0|digits_between:1,11'
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false,
                'error'   =>  $validator->errors()->toArray()
            );

            return response()->json($response);
        } else {

            $father_details = json_encode([
                "name"           => $request->father_name,
                "cnic"           => $request->father_cnic,
                "phone"          => $request->father_phone,
                "email"          => $request->father_email,
                "company_name"   => $request->father_company_name,
                "occupation"     => $request->father_occupation,
                "salary"         => $request->father_salary,
            ]);

            $registration = Registration::where("campus_id", $request->campus_id)->where("session_id", $request->session_id)->where("system_id", $request->system_id)->orderBy('id', 'DESC')->limit(1)->first();
            if ($registration) {
                $session = explode("-", $registration->session->session);
                $campus_details = $registration->campus->campusDetails;
                $reg_no = filter_var($registration->registration_id, FILTER_SANITIZE_NUMBER_INT);
                $registration_id = $campus_details->short_name . (++$reg_no);
            } else {
                $campus_details = Campus::findOrFail($request->campus_id)->campusDetails;

                $session = Session::findOrFail($request->session_id);
                $session = explode("-", $session->session);
                $registration_id = $campus_details->short_name . substr($session[0], -2) . str_pad(1, 10 - (strlen($campus_details->short_name . substr($session[0], -2))), '0', STR_PAD_LEFT);
            }

            $registration = new Registration;

            $registration->registration_id     =  $registration_id;
            $registration->campus_id           =  $request->campus_id;
            $registration->system_id           =  $request->system_id;
            $registration->class_id            =  $request->class_id;
            $registration->class_group_id      =  $request->class_group_id;
            $registration->session_id          =  $request->session_id;
            $registration->area_id             =  $request->area_id;
            $registration->city_id             =  $request->city_id;
            $registration->form_no             =  $request->form_no;
            $registration->first_name          =  $request->first_name;
            $registration->last_name           =  $request->last_name;
            $registration->dob                 =  isset($request->dob) ? date("Y-m-d", strtotime($request->dob)) : null;
            $registration->gender              =  $request->gender;
            $registration->siblings_in_mpa     =  $request->siblings_in_mpa;
            $registration->no_of_siblings      =  $request->no_of_siblings;
            $registration->previous_class_id   =  $request->previous_class;
            $registration->previous_school     =  $request->previous_school;
            $registration->house_no            =  $request->house_no;
            $registration->building_no         =  $request->building_no;
            $registration->block_no            =  $request->block_no;
            $registration->father_details      =  $father_details;
            $registration->test_group_id       =  $request->test_group;
            $registration->interview_group_id  =  $request->interview_group;
            $registration->hear_about_us       =  $request->hear_about_us;

            if ($request->hear_about_us == "other") {
                $registration->hear_about_us_other =  $request->hear_about_us_other;
            }


            if ($request->test_group_chkbox == "true") {
                if ($request->test_group_id) {
                    $registration->test_group_id = $request->test_group_id;
                } else {
                    $testGroup = new TestInterviewGroup;
                    $testGroup->session_id = $request->session_id;
                    $testGroup->name = $request->test_name;
                    $testGroup->type = "test";
                    $testGroup->date = date("Y-m-d", strtotime($request->test_date));
                    $testGroup->time = $request->test_time;

                    $testQuery = $testGroup->save();

                    $registration->test_group_id = $testGroup->id;
                }
            }
            if ($request->interview_group_chkbox == "true") {

                if ($request->interview_group_id) {
                    $registration->interview_group_id = $request->interview_group_id;
                } else {
                    $interviewGroup = new TestInterviewGroup;
                    $interviewGroup->session_id = $request->session_id;
                    $interviewGroup->name = $request->interview_name;
                    $interviewGroup->type = "interview";
                    $interviewGroup->date = date("Y-m-d", strtotime($request->interview_date));
                    $interviewGroup->time = $request->interview_time;

                    $interviewQuery = $interviewGroup->save();

                    $registration->interview_group_id = $interviewGroup->id;
                }
            }

            $query = $registration->save();

            if ($query) {

                $response = array(
                    'status'   =>  true,
                    'message'  =>  "Student has been registered successfully with registeration id $registration->registration_id."
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

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'                        =>  'numeric|gt:0|digits_between:1,11',
            'campus_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'system_id'                 =>  'required|numeric|gt:0|digits_between:1,11',
            'class_id'                  =>  'required|numeric|gt:0|digits_between:1,11',
            'session_id'                =>  'required|numeric|gt:0|digits_between:1,11',
            'class_group_id'            =>  'numeric|gt:0|digits_between:1,11',
            'form_no'                   =>  'nullable|alpha_dash',
            'first_name'                =>  'required|alpha|max:30',
            'last_name'                 =>  'required|alpha|max:30',
            'dob'                       =>  'nullable|date',
            'gender'                    =>  'required|alpha',
            'siblings_in_mpa'           =>  'string|max:3',
            'no_of_siblings'            =>  'nullable|numeric|gt:0|digits_between:1,11',
            'previous_class_id'         =>  'nullable|numeric|gt:0|digits_between:1,11',
            'previous_school'           =>  'max:60',
            // CURRENT ADDRESS
            'house_no'                  =>  'required|string|max:60',
            'block_no'                  =>  'required|string|max:60',
            'building_no'               =>  'required|string|max:60',
            'area_id'                   =>  'required|numeric|gt:0|digits_between:1,11',
            'city_id'                   =>  'required|numeric|gt:0|digits_between:1,11',
            // FATHERS DETAIL
            'father_salary'             =>  'nullable|numeric|gt:0|digits_between:1,11',
            'father_name'               =>  'required|max:30',
            'father_cnic'               =>  'required|numeric|gt:0|digits:13',
            'father_email'              =>  'nullable|email|max:60',
            'father_occupation'         =>  'string|max:30',
            'father_company_name'       =>  'max:30',
            'father_phone'              =>  'required|numeric|gt:0|digits:11',
            'hear_about_us'             =>  'nullable|string|max:20',
            'hear_about_us_other'       =>  'required_if:hear_about_us,other|string|max:20',
            // TEST-INTERVIEW GROUP
            'test_group_id'             =>  'nullable|numeric|gt:0|digits_between:1,11',
            'interview_group_id'        =>  'nullable|numeric|gt:0|digits_between:1,11'
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false,
                'error'   =>  $validator->errors()->toArray()
            );

            return response()->json($response);
        } else {
            $registration = Registration::findOrFail($request->id);

            $father_details = json_encode([
                "name"           => $request->father_name,
                "cnic"           => $request->father_cnic,
                "phone"          => $request->father_phone,
                "email"          => $request->father_email,
                "company_name"   => $request->father_company_name,
                "occupation"     => $request->father_occupation,
                "salary"         => $request->father_salary,
            ]);

            $registration->class_group_id             = $request->class_group_id;
            $registration->campus_id            = $request->campus_id;
            $registration->system_id            = $request->system_id;
            $registration->session_id           = $request->session_id;
            $registration->class_id             = $request->class_id;
            $registration->first_name           = $request->first_name;
            $registration->form_no              = $request->form_no;
            $registration->last_name            = $request->last_name;
            $registration->dob                  = isset($request->dob) ? date("Y-m-d", strtotime($request->dob)) : null;
            $registration->gender               = $request->gender;
            $registration->siblings_in_mpa      = $request->siblings_in_mpa;
            $registration->no_of_siblings       = $request->no_of_siblings;
            $registration->previous_class_id    = $request->previous_class_id;
            $registration->previous_school      = $request->previous_school;
            $registration->house_no             = $request->house_no;
            $registration->block_no             = $request->block_no;
            $registration->building_no          = $request->building_no;
            $registration->area_id              = $request->area_id;
            $registration->city_id              = $request->city_id;
            $registration->father_details       = $father_details;
            $registration->test_group_id        = $request->test_group_id;
            $registration->interview_group_id   = $request->interview_group_id;
            $registration->hear_about_us        = $request->hear_about_us;

            if ($request->test_group_chkbox == "true") {
                if ($request->test_group_id) {
                    $registration->test_group_id = $request->test_group_id;
                } else {
                    $testGroup = new TestInterviewGroup;
                    $testGroup->session_id = $request->session_id;
                    $testGroup->name = $request->test_name;
                    $testGroup->type = "test";
                    $testGroup->date = date("Y-m-d", strtotime($request->test_date));
                    $testGroup->time = $request->test_time;

                    $testQuery = $testGroup->save();

                    $registration->test_group_id = $testGroup->id;
                }
            }
            if ($request->interview_group_chkbox == "true") {

                if ($request->interview_group_id) {
                    $registration->interview_group_id = $request->interview_group_id;
                } else {
                    $interviewGroup = new TestInterviewGroup;
                    $interviewGroup->session_id = $request->session_id;
                    $interviewGroup->name = $request->interview_name;
                    $interviewGroup->type = "interview";
                    $interviewGroup->date = date("Y-m-d", strtotime($request->interview_date));
                    $interviewGroup->time = $request->interview_time;

                    $interviewQuery = $interviewGroup->save();

                    $registration->interview_group_id = $interviewGroup->id;
                }
            }

            $query = $registration->save();

            if ($query) {

                $response = array(
                    'status'   =>  true,
                    'message'  =>  "Record has been updated successfully."
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

    public function studentForward($id)
    {

        $registeration = Registration::where('id', $id)->first();

        if ($registeration) {

            $session  =  Session::get();
            $campus   =  Campus::where('is_active', 1)->where('is_delete', 0)->get();
            $section  =  Section::get();
            $area     =  Area::get();
            $city     =  City::get();
            $class    =  Classes::get();

            $schoolSystems = Campus::select('systems.*')
                ->join('campus_details', 'campus_details.campus_id', '=', 'campuses.id')
                ->join('systems', 'systems.id', '=', 'campus_details.system_id')
                ->where('campuses.id', $registeration->campus_id)
                ->where('campuses.is_active', 1)
                ->where('campuses.is_delete', 0)
                ->get();

            $campusClasses = Classes::select('classes.id', 'classes.class')
                ->join('campus_classes', 'campus_classes.class_id', '=', 'classes.id')
                ->join('campus_details', 'campus_details.id', '=', 'campus_classes.campus_detail_id')
                ->where('campus_details.campus_id', $registeration->campus_id)
                ->where('campus_details.system_id', $registeration->system_id)
                ->where('classes.is_active', 1)
                ->where('classes.is_delete', 0)
                ->get();

            $classGroups = CampusClass::select('groups.*')
                ->join('campus_details', 'campus_details.id', '=', 'campus_classes.campus_detail_id')
                ->join('class_groups', 'class_groups.class_id', '=', 'campus_classes.class_id')
                ->join('groups', 'groups.id', '=', 'class_groups.group_id')
                ->where('campus_details.campus_id', $registeration->campus_id)
                ->where('campus_details.system_id', $registeration->system_id)
                ->where('campus_classes.class_id', $registeration->class_id)
                ->get();

            $data = array(
                'session'       =>  $session,
                'campus'        =>  $campus,
                'section'       =>  $section,
                'class'         =>  $class,
                'area'          =>  $area,
                'city'          =>  $city,
                'registeration' =>  $registeration,
                'campusClasses' =>  $campusClasses,
                'schoolSystems' =>  $schoolSystems,
                'classGroups'   =>  $classGroups,
                'father_details'    =>  json_decode($registeration->father_details),
                'page'          =>  'Admission',
                'menu'          =>  'Add Admission'
            );

            return view('student.admission.forward', compact('data'));
        } else {

            $response = array(
                'status'   =>  false,
                'message'  =>  'Some thing went worng please try again later'
            );
            return redirect()->back()->with($response);
        }
    }

    public function getStudentFormNumberByCampusIdAndSystemIdAndSessionId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'campus_id'       =>  'required|numeric|gt:0|digits_between:1,11',
            'system_id'       =>  'required|numeric|gt:0|digits_between:1,11',
            'session_id'      =>  'required|numeric|gt:0|digits_between:1,11'
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'  =>  false,
                'error'   =>  $validator->errors()
            );

            return response()->json($response);
        } else {

            $registration = Registration::where("campus_id", $request->campus_id)->where("session_id", $request->session_id)->where("system_id", $request->system_id)->orderBy('id', 'DESC')->limit(1)->first();

            if ($registration) {
                $session = explode("-", $registration->session->session);
                $campus_details = $registration->campus->campusDetails;
                $reg_no = $registration->registration_id;
                $student_form_number = $campus_details->short_name . substr($session[0], -2) . str_pad(++$reg_no, 10 - (strlen($campus_details->short_name . substr($session[0], -2))), '0', STR_PAD_LEFT);;
            } else {
                $campus_details = Campus::findOrFail($request->campus_id)->campusDetails;
                $session = Session::findOrFail($request->session_id);
                $session = explode("-", $session->session);
                $student_form_number = $campus_details->short_name . substr($session[0], -2) . str_pad(1, 10 - (strlen($campus_details->short_name . substr($session[0], -2))), '0', STR_PAD_LEFT);
            }

            return response()->json(["status" => true, "formNumber" => $student_form_number]);
        }
    }

    public function getTestGroupBySessionId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'session_id'      =>  'required|numeric|gt:0|digits_between:1,11'
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'  =>  false,
                'error'   =>  $validator->errors()
            );

            return response()->json($response);
        } else {
            $testGroup = TestInterviewGroup::where("type", "test")->get();

            $response = array(
                'status'  =>  true,
                'testGroup'   =>  $testGroup
            );

            return response()->json($response);
        }
    }

    public function getInterviewGroupBySessionId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'session_id'      =>  'required|numeric|gt:0|digits_between:1,11'
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'  =>  false,
                'error'   =>  $validator->errors()
            );

            return response()->json($response);
        } else {
            $interviewGroup = TestInterviewGroup::where("type", "interview")->get();

            $response = array(
                'status'           =>  true,
                'interviewGroup'   =>  $interviewGroup
            );

            return response()->json($response);
        }
    }

    public function registrationDetailsModal()
    {
        $classes        =  Classes::get();
        $campuses       =  Campus::where('is_active', 1)->where('is_delete', 0)->get();
        $sessions       =  Session::get();
        $areas          =  Area::get();
        $cities         =  City::get();
        $studentClasses =  Classes::get();
        $sections       =  Section::get();
        $students       =  Registration::get();
        $tests          =  TestInterviewGroup::where('type', 'test')->get();
        $interviews     =  TestInterviewGroup::where('type', 'interview')->get();

        $data = array(
            'campuses'        =>  $campuses,
            'classes'         =>  $classes,
            'sessions'        =>  $sessions,
            'studentClasses'  =>  $studentClasses,
            'sections'        =>  $sections,
            'areas'           =>  $areas,
            'cities'          =>  $cities,
            'students'        =>  $students,
            'tests'           =>  $tests,
            'interviews'      =>  $interviews,
            'page'            =>  'Registeration',
            'menu'            =>  'Manage Registeration'
        );

        return view('student.registration.registration-details', compact('data'));
    }
}
