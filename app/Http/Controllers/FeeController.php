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

            $admission_campus_ids = [];
            $admission_class_ids = [];
            
            $admissions = Admission::select('admissions.*', 'fees_details.*', 'fees_types.*')
            ->leftJoin('fees_details','fees_details.class_id', '=', 'admissions.class_id', 'fees_details.campus_id', '=', 'admissions.campus_id')
            ->leftJoin('fees_types','fees_types.id', '=', 'fees_details.fees_type_id')
            ->whereIn('admissions.id', $request->ids)
            ->get();

            return response()->json($admissions[0]);
            

            $data = array(
                'page'                  =>  'Fees Card Sticker',
                'menu'                  =>  'Fees Card Sticker',
                'Admission'             =>  $admission
            );

            return view('feescard.show', compact('data'));


            // $admissions = Admission::whereIn('admissions.id', $request->ids)
            //     ->leftjoin('fees_details','fees_details.class_id', '=', 'admissions.class_id')
            //     ->leftjoin('fees_details','fees_details.campus_id', '=', 'admissions.campus_id')
            //     ->get();

            
            // $admissions = Admission::whereIn('id', $request->ids)->get();
            // foreach($admissions as $admission) {
            //     if(!in_array($admission->campus_id, $admission_campus_ids)) {
            //         array_push($admission->campus_id, $admission_campus_ids);
            //     }

            //     if(!in_array($admission->class_id, $admission_class_ids)) {
            //         array_push($admission->class_id ,$admission_class_ids);
            //     }
            // }

            // return response()->json([$admission_campus_ids, $admission_class_ids]);

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
