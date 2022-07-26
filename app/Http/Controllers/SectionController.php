<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    
    public function listing(){
        $Section = Section::all();
        $data = array(
            'Section'    =>  $Section,
            'page'      =>  'Section',
            'menu'      =>  'Manage Section'
        );

        return view('section.listing', compact('data'));
    }

    public function add(){

       $data = array(
            'page'       =>  'Section',
            'menu'       =>  'Add Section',
        );

        return view('section.add', compact('data'));
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'section'              =>  'required|max:20|unique:sections'
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $section = new Section;

            $section->section           =  $request->section;
            
            $query = $section->save();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'Section has been added successfully.'
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
        $Section = Section::findOrFail($id);

        $data = array(
            'section'  =>  $Section,
            'page'    =>  'Section',
            'menu'    =>  'Edit Section'
        );

        return view('section.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'section'          =>  'required',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $section = Section::find($id);

            $section->section          =  $request->section;
            $query = $section->update();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'Section has been updated successfully'
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
        $section_id  =  $request->section_id;
        $query      =  Section::find($section_id)->delete();

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
