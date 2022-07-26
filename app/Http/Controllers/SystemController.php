<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\System;
use Illuminate\Support\Facades\Validator;

class SystemController extends Controller
{
    public function listing(){
        $System = System::all();
        $data = array(
            'System'  =>  $System,
            'page'     =>  'System',
            'menu'     =>  'Manage System'
        );

        return view('system.listing', compact('data'));
    }

    public function add(){
        $data = array(
            'page'  =>  'System',
            'menu'  =>  'Add System',
        );

        return view('system.add', compact('data'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'system'          =>  'required|max:20',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $system = new System;

            $system->system          =  $request->system;

            $query = $system->save();

            if ($query) {
                
                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'System has been added successfully'
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

    public function edit($id){
        $System = System::findOrFail($id);

        $data = array(
            'system'  =>  $System,
            'page'    =>  'System',
            'menu'    =>  'Edit System'
        );

        return view('system.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'system'          =>  'required',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $system = System::find($id);

            $system->system          =  $request->system;
            $query = $system->update();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'System has been updated successfully'
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

    public function delete(Request $request) {
        $system_id  =  $request->system_id;
        $query      =  System::find($system_id)->delete();

        if ($query) {

            $response = array(
                'status'   =>  true, 
                'message'  =>  'Record has been deleted successfully!'
            );
        }

        else {
            $response = array(
                'status'   =>  false,
                'message'  =>  'Some thing went worng try again later!'
            );
        }

        return response()->json($response); 
    }
}
