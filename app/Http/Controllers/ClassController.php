<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    
    public function listing(){
        $Class = Classes::all();
        $data = array(
            'Class'    =>  $Class,
            'page'      =>  'Class',
            'menu'      =>  'Manage Class'
        );

        return view('class.listing', compact('data'));
    }

    public function add(){

       $data = array(
            'page'       =>  'Class',
            'menu'       =>  'Add Class',
        );

        return view('class.add', compact('data'));
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'class'              =>  'required|max:20|unique:classes'
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $class = new Classes;

            $class->class           =  $request->class;
            
            $query = $class->save();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'Class has been added successfully.'
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
        $Class = Classes::findOrFail($id);

        $data = array(
            'class'  =>  $Class,
            'page'    =>  'Class',
            'menu'    =>  'Edit Class'
        );

        return view('class.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'class'          =>  'required',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $class = Classes::find($id);

            $class->class          =  $request->class;
            $query = $class->update();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'Class has been updated successfully'
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
        $class_id  =  $request->class_id;
        $query      =  Classes::find($class_id)->delete();

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
