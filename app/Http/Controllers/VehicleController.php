<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function listingByType(Request $request) {

        $pick_and_drop = 'by_school_van,by_private_van';

        $validator   = Validator::make($request->all(),[
            'pick_and_drop'  =>  'required|in:'.$pick_and_drop,
        ]);

       
        if($validator->fails()){

            $response = array(
                'status'    => FALSE,
                'error'  =>  $validator->errors()
            );

        } else {
            
            $vehice_type  =  str_replace('by_',"",$request->pick_and_drop); 
            $vehicles  =  Vehicle::where('vehicle_type',$vehice_type)->where('is_active',1)->where('is_delete',0)->get();
            $response = array(
                'status'    => TRUE,
                'vehicles'  =>  $vehicles
            );
        }

        return response()->json($response);
    }
}
