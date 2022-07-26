<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit',   ['only' => ['edit','update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = Permission::orderBy('id', 'DESC')->get();
        $data = array(
            'Permission'        =>  $permission,
            'page'              =>  'Permission',
            'menu'              =>  'Manage Permission'
        );

        return view('permission.listing', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'page'                  =>  'Permission',
            'menu'                  =>  'Add Permission'
        );
        return view('permission.add', compact('data'));
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
            'permission'            => 'required|string|unique:permissions,name',
        ]);

        if ($validator->fails()) {
            $response = array(
                'status'            =>  false,
                'error'             =>  $validator->errors()
            );
            return response()->json($response);
        } else {

            $permission = new Permission;
            $permission->name = $request->input('permission');
            $permission->guard_name = 'web';
            $permission_query = $permission->save();

            if ($permission_query) {

                $response = array(
                    'status'        =>  true,
                    'message'       =>  "Permission has been registered successfully."
                );

                return response()->json($response);
            } else {

                $response = array(
                    'status'        =>  false,
                    'message'       =>  'Some thing went worng please try again letter.'
                );

                return response()->json($response);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        $data = array(
            'Permission'            =>  $permission,
            'page'                  =>  'Permission',
            'menu'                  =>  'Show Permission'
        );
        
        return view('permission.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $data = array(
            'Permission'            =>  $permission,
            'page'                  =>  'Permission',
            'menu'                  =>  'Edit Permission'
        );
        
        return view('permission.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'                => 'required|numeric|gt:0|digits_between:1,11',
            'permission'        => 'required|string|unique:permissions,name,'.$request->id,
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'            =>  false,
                'error'             =>  $validator->errors()
            );

            return response()->json($response);
        } else {

            $permission             = Permission::findOrFail($request->id);
            $permission->name       = $request->input('permission');
            $permission_query       = $permission->save();
    
            if ($permission_query) {

                $response = array(
                    'status'        =>  true,
                    'message'       =>  "Permission has been updated successfully."
                );

                return response()->json($response);
            } else {

                $response = array(
                    'status'        =>  false,
                    'message'       =>  'Some thing went worng please try again letter.'
                );

                return response()->json($response);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
