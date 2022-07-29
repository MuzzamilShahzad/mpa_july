<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admission;
use App\Models\Session;
use App\Models\Campus;
use App\Models\Section;
use App\Models\Area;
use App\Models\City;
use App\Models\Classes;
use App\Models\FeesTypes;
use App\Models\Month;
use App\Models\Fees;
use App\Models\StudentFees;

class FeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fee_slip(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids'            => 'Array|min:1',
        ]);

        if ($validator->fails()) {
            $response = array(
                'status'            =>  false,
                'error'             =>  $validator->errors()
            );
            return response()->json($response);
        } else {

            // $admission_campus_ids = [];
            // $admission_class_ids = [];
            
            // $admissions = Admission::select('admissions.*', 'fees_details.*', 'fees_types.*')
            // ->leftJoin('fees_details','fees_details.class_id', '=', 'admissions.class_id', 'fees_details.campus_id', '=', 'admissions.campus_id')
            // ->leftJoin('fees_types','fees_types.id', '=', 'fees_details.fees_type_id')
            // ->whereIn('admissions.id', $request->ids)
            // ->get();

            $admissions = Admission::WhereIn('admissions.id', $request->ids)->get();
            foreach($admissions as $admission) {
                $admission->father_details = json_decode($admission->father_details, true);
                $admission->address_details = json_decode($admission->address_details, true);
                $admission->fees_details = $admission->feeDetails->toArray();
                $fee_details_id = $admission->feeDetails->pluck('fees_type_id');
                $feeTypes = FeesTypes::WhereIn('id',$fee_details_id)->get(['short_code', 'type'])->toArray();

                $all_fees_types = [];
                $i = 0;
                foreach($feeTypes as $feeType) {
                    $fees_types = [$feeType["short_code"] =>  $admission->fees_details[$i]["fees_amount"]];
                    $all_fees_types = array_merge($all_fees_types, $fees_types);
                    $i++;
                }

                $admission->fees_types = $all_fees_types;
                $admission->section = $admission->section->section;
                $admission->class = $admission->classes->class;
                $admission->session = $admission->session->session;
                $admission->campus = $admission->campus->campus;

            }


            if ($admissions) {

                $data = array(
                    'Admissions'            =>  $admissions
                );
    
                $response = array(
                    'status'   =>  true,
                    'message'  =>  view('feescard.show', compact('data'))->render()
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentListing(Request $request){
        
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
            'page'       =>  'Fees',
            'menu'       =>  'Students Listing'
        );

        return view('fees.student.listing', compact('data'));
    }


    public function getStudentFeesRecord(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id'            => 'required|numeric|gt:0|digits_between:1,11',
        ]);

        if ($validator->fails()) {
            
            return redirect()->back()->with("message", "Record not found.");

        } else {

            $admission = Admission::findOrFail($request->student_id);
            
            $admission->father_details = json_decode($admission->father_details, true);
            $admission->address_details = json_decode($admission->address_details, true);

            $where = array(
                'campus_id'  => $admission->campus_id,
                'class_id'   => $admission->class_id,
                'session_id' => $admission->session_id
            );

            $fees = Fees::select("feeses.*", "fees_types.*")
                            ->join('fees_types','fees_types.id','=','feeses.fees_type_id')->where($where)->get();


            $where = array(
                'student_id'    => $admission->id,
                // 'campus_id'     => $admission->campus_id,
                // 'class_id'      => $admission->class_id,
                // 'session_id'    => $admission->session_id
            );

            $paid_feeses = StudentFees::where($where)->get()->toArray();
            


            if($paid_feeses) {
                $month_paid_feeses = array_column($paid_feeses, 'month_id');    
            }else {
                $month_paid_feeses = [];
            }


            // if (false !== $key = array_search(2, $month_paid_feeses)) {
            //     dd($key);
            // } else {
            //     dd("not found");
            // }
            // dd($paid_feeses);


            // $student_fees = Admission::select('admissions.*', 'feeses.*')
            //                         ->join('feeses','feeses.campus_id','=','admissions.campus_id','feeses.class_id','=','admissions.class_id','feeses.session_id','=','admissions.session_id')
            //                          ->join('fees_types','fees_types.id','=','feeses.fees_type_id')->get()  ;
            // dd($student_fees);
            // $admission->fees_details = $admission->feeDetails->toArray();   // Array
            // $fee_details_id = $admission->feeDetails->pluck('fees_type_id');
            
            // $feeTypes = FeesTypes::WhereIn('id',$fee_details_id)->get(['short_code', 'type'])->toArray();

            // $all_fees_types = [];
            // $i = 0;
            // foreach($feeTypes as $feeType) {
            //     $fees_types = [$feeType["short_code"] =>  $admission->fees_details[$i]["fees_amount"]];
            //     $all_fees_types = array_merge($all_fees_types, $fees_types);
            //     $i++;
            // }

            // $admission->fees_types = $all_fees_types;
            $admission->section = $admission->section->section;
            $admission->class = $admission->classes->class;
            $admission->session = $admission->session->session;
            $admission->campus = $admission->campus->campus;
            $fee_detalis = $admission->feeDetails;           // Object

            $months = Month::All();

            $data = array(
                "paid_feeses"   =>  $paid_feeses,
                "month_paid_feeses"   =>  $month_paid_feeses,
                'fee_detalis'   =>  $fees,
                'admission'     =>  $admission,
                'months'        =>  $months,
                'page'          =>  'Admission',
                'menu'          =>  'Collect Fees'
            );

            return view("fees.student.collect-fees", compact('data'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'month_ids'                 =>  'required|Array|min:1',
            'fee_ids'                   =>  'required|Array|min:1',
            'fee'                       =>  'required|Array|min:1',
            'discount'                  =>  'required|Array|min:1',
            'amount'                    =>  'required|Array|min:1',
            'fine'                      =>  'required|Array|min:1',
            'student_id'                =>  'required|numeric|gt:0|digits_between:1,11'
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'  =>  false,
                'error'   =>  $validator->errors()
            );
            
            return response()->json($response);
            
        } else {

            $i = 0;
            foreach($request->month_ids as $data) {
                $student_fees = new StudentFees;

                $student_fees->student_id       = $request->student_id;
                $student_fees->fees_id          = $request->fee_ids[$i];
                $student_fees->month_id         = $request->month_ids[$i];
                $student_fees->fees_amount      = $request->amount[$i];
                $student_fees->fee_discount     = $request->discount[$i];
                $student_fees->fine             = $request->fine[$i];
                $student_fees->note             = "This is note";

                $query = $student_fees->save();
                $i++;
            }
            
            $response = array(
                'status'   =>  true, 
                'message'  =>  'Student Fees has paid successfully.'
            );

            return response()->json($response);
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function show(Fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function edit(Fee $fee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fee $fee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fee $fee)
    {
        //
    }
}
