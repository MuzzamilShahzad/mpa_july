<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{

    public function listing(){
        $Area = Area::all();
        $data = array(
            'Area'    =>  $Area,
            'page'      =>  'Area',
            'menu'      =>  'Manage Area'
        );

        return view('area.listing', compact('data'));
    }

    public function add(){

       $data = array(
            'page'       =>  'Areas',
            'menu'       =>  'Add Area',
        );

        return view('area.add', compact('data'));
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'area'              =>  'required'
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $area = new Area;

            $area->area           =  $request->area;
            
            $query = $area->save();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'Area has been added successfully.'
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
        $Area = Area::findOrFail($id);

        $data = array(
            'area'  =>  $Area,
            'page'    =>  'Area',
            'menu'    =>  'Edit Area'
        );

        return view('area.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'area'          =>  'required',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $area = Area::find($id);

            $area->area          =  $request->area;
            $query = $area->update();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'Area has been updated successfully'
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
        $area_id  =  $request->area_id;
        $query      =  Area::find($area_id)->delete();

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
