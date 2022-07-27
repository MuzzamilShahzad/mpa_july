<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admission;
use App\Models\FeesTypes;
use View;

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
    public function index()
    {
        //
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
