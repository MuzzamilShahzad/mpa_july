<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit',   ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->get();

        $data = array(
            'Role'      =>  $roles,
            'page'      =>  'Role',
            'menu'      =>  'Manage Role'
        );

        return view('roles.listing', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        $data = array(
            'permission'            =>  $permission,
            'page'                  =>  'Role',
            'menu'                  =>  'Add Role'
        );
        return view('roles.add', compact('data'));
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
            'role'               => 'required|string|unique:roles,name',
            'permission'         => 'required|array|min:1'
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'            =>  false,
                'error'             =>  $validator->errors()
            );

            return response()->json($response);
        } else {

            $role_query = Role::create(['name' => $request->input('role')]);
            $permission_query = $role_query->syncPermissions($request->input('permission'));


            if ($role_query && $permission_query) {

                $response = array(
                    'status'        =>  true,
                    'message'       =>  "Role has been registered successfully."
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        $data = array(
            'permission'            =>  $rolePermissions,
            'Role'                  =>  $role,
            'page'                  =>  'Role',
            'menu'                  =>  'Show Role'
        );

        return view('roles.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

            $data = array(
                'role_permission'       =>  $rolePermissions,
                'Permission'            =>  $permission,
                'Role'                  =>  $role,
                'page'                  =>  'Role',
                'menu'                  =>  'Show Role'
            );
        
        return view('roles.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id'                => 'required|numeric|gt:0|digits_between:1,11',
            'role'              => 'required|string|unique:roles,name,'.$request->id,
            'permission'        => 'required|array|min:1'
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'            =>  false,
                'error'             =>  $validator->errors()
            );

            return response()->json($response);
        } else {

            $role = Role::find($request->id);
            $role->name = $request->input('role');
            $role_query = $role->save();
    
            $permission_query = $role->syncPermissions($request->input('permission'));
    


            if ($role_query && $permission_query) {

                $response = array(
                    'status'        =>  true,
                    'message'       =>  "Role has been updated successfully."
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
