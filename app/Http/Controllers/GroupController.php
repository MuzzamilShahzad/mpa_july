<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function listing(){
        $Group = Group::all();
        $data = array(
            'Group'    =>  $Group,
            'page'      =>  'Group',
            'menu'      =>  'Manage Group'
        );

        return view('group.listing', compact('data'));
    }

    public function add(){

       $data = array(
            'page'       =>  'Group',
            'menu'       =>  'Add Group',
        );

        return view('group.add', compact('data'));
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'group'              =>  'required|max:20|unique:groups'
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $group = new Group;

            $group->group           =  $request->group;
            
            $query = $group->save();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'Group has been added successfully.'
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
        $Group = Group::findOrFail($id);

        $data = array(
            'group'  =>  $Group,
            'page'    =>  'Group',
            'menu'    =>  'Edit Group'
        );

        return view('group.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'group'          =>  'required',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $group = Group::find($id);

            $group->group          =  $request->group;
            $query = $group->update();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'Group has been updated successfully'
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
        $group_id  =  $request->group_id;
        $query      =  Group::find($group_id)->delete();

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