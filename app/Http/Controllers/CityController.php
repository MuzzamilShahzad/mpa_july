<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\City;

class CityController extends Controller
{

    public function listing(){
        $City = City::all();
        $data = array(
            'City'    =>  $City,
            'page'      =>  'City',
            'menu'      =>  'Manage City'
        );

        return view('city.listing', compact('data'));
    }

    public function add(){

       $data = array(
            'page'       =>  'City',
            'menu'       =>  'Add City',
        );

        return view('city.add', compact('data'));
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'city'              =>  'required|unique:cities'
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $city = new City;

            $city->city           =  $request->city;
            
            $query = $city->save();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'City has been added successfully.'
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
        $City = City::findOrFail($id);

        $data = array(
            'city'  =>  $City,
            'page'    =>  'City',
            'menu'    =>  'Edit City'
        );

        return view('city.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'city'          =>  'required',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $city = City::find($id);

            $city->city          =  $request->city;
            $query = $city->update();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'City has been updated successfully'
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
        $city_id  =  $request->city_id;
        $query      =  City::find($city_id)->delete();

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
