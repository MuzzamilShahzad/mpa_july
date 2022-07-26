<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher        =   Teacher::All();

        $data = array(
            'Teacher'   =>  $teacher,
            'page'      =>  'Teacher',
            'menu'      =>  'Manage Teacher'
        );
        return view("teacher.listing", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'areas'                 =>  Area::All(),
            'cities'                =>  City::All(),
            'page'                  =>  'Teacher',
            'menu'                  =>  'Add Teacher'
        );
        return view("teacher.add", compact('data'));
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
            'teacher'               =>  'required|string|max:30',
            'email'                 =>  'required|email|unique:teachers,email|max:30',
            'phone'                 =>  'required|unique:teachers,phone|numeric|gt:0|digits_between:1,11',
            'area'                  =>  'required|numeric|gt:0|digits_between:1,11',
            'city'                  =>  'required|numeric|gt:0|digits_between:1,11',
            'address'               =>  'required|string|max:100',
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'            =>  false,
                'error'             =>  $validator->errors()
            );

            return response()->json($response);
        } else {

            $teacher                =   new Teacher();
            $teacher->teacher       =   $request->teacher;
            $teacher->email         =   $request->email;
            $teacher->phone         =   $request->phone;
            $teacher->area          =   $request->area;
            $teacher->city          =   $request->city;
            $teacher->address       =   $request->address;
            
            $query = $teacher->save();

            if ($query) {

                $response = array(
                    'status'        =>  true,
                    'message'       =>  "Teacher has been registered successfully"
                );

                return response()->json($response);
            } else {

                $response = array(
                    'status'        =>  false,
                    'message'       =>  'Some thing went worng please try again letter'
                );

                return response()->json($response);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        $data = array(
            'Teacher'   =>  $teacher,
            'page'      =>  'Teacher',
            'menu'      =>  'Add Teacher'
        );
        return view("teacher.show", compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $data = array(
            'Teacher'   =>  $teacher,
            'page'      =>  'Teacher',
            'menu'      =>  'Add Teacher'
        );
        return view("teacher.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
