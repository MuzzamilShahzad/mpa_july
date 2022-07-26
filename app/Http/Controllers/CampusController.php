<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Campus;
use App\Models\System;
use App\Models\CampusDetails;
use App\Models\Classes;
use App\Models\ClassGroup;
use App\Models\Section;
use App\Models\CampusClass;

class CampusController extends Controller
{

    public function getCampusSchoolSystemByCampusId(Request $request){
        
        $validator = Validator::make($request->all(), [
            'campus_id'       =>  'required|numeric|gt:0|digits_between:1,11'
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()
            );
            
            return response()->json($response);
            
        } else {
            
            $formData = $request->all();

            $campusSchoolSystems  =  $this->getCampusSchoolSystem($formData['campus_id']);
           
            $response = array(
                'status'               => true,
                'campusSchoolSystems'  =>  $campusSchoolSystems,
            );

            return response()->json($response);
        }
    }

    public function getCampusSchoolSystem($campus_id = NULL){
        
        $schoolSystems = Campus::select('systems.*')
                            ->join('campus_details','campus_details.campus_id','=','campuses.id')
                            ->join('systems','systems.id','=','campus_details.system_id')
                            ->where('campuses.id',$campus_id)
                            ->where('campuses.is_active',1)
                            ->where('campuses.is_delete',0)
                            ->get();

        return $schoolSystems;
    }
    
    public function getCampusClassesByCampusAndSystemId(Request $request){

        $validator = Validator::make($request->all(), [
            'campus_id'       =>  'required|numeric|gt:0|digits_between:1,11',
            'system_id'       =>  'required|numeric|gt:0|digits_between:1,11'
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()
            );
            
            return response()->json($response);
            
        } else {
            
            $formData = $request->all();
           
            $campusClasses        =  $this->getCampusClasses($formData);
           
            $response = array(
                'status'               => true,
                'campusClasses'        =>  $campusClasses
            );

            return response()->json($response);
        }
    }

    public function getClassGroupAndSectionByCampusSystemAndClassId(Request $request){
        
        $validator = Validator::make($request->all(), [
            'campus_id'       =>  'required|numeric|gt:0|digits_between:1,11',
            'system_id'       =>  'required|numeric|gt:0|digits_between:1,11',
            'class_id'        =>  'required|numeric|gt:0|digits_between:1,11'
        ]);

        if ($validator->fails()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()
            );
            
            return response()->json($response);
            
        } else {
            
            $formData = $request->all();

            $ClassGroupAndSection  =  $this->getCampusClassGroupAndSection($formData);
            
            $response = array(
                'status'         => true,
                'classGroups'    =>  $ClassGroupAndSection['classGroups'],
                'classSections'  =>  $ClassGroupAndSection['classSections'],
            );

            return response()->json($response);
        }
    }

    public function getCampusClassGroupAndSection($formData){

        // $classGroups = ClassGroup::select('class_groups.*')
        //                     // ->join('groups', 'groups.id', '=', 'class_groups.group_id')
        //                     // ->join('campus_class_groups','campus_class_groups.class_group_id','=','class_groups.id')
        //                     ->join('campus_classes','campus_classes.id','=','class_groups.class_id')
        //                     // ->join('campus_details','campus_details.id','=','campus_classes.campus_detail_id')
        //                     // ->where('campus_details.campus_id',$formData['campus_id'])
        //                     // ->where('campus_details.system_id',$formData['system_id'])
        //                     // ->where('campus_classes.class_id',$formData['class_id'])
        //                     // ->where('class_groups.is_active',1)
        //                     // ->where('class_groups.is_delete',0)
        //                     ->get();

        $classGroups = CampusClass::select('groups.*')
                            ->join('campus_details','campus_details.id','=','campus_classes.campus_detail_id')
                            ->join('class_groups','class_groups.class_id','=','campus_classes.class_id')
                            ->join('groups','groups.id','=','class_groups.group_id')
                            ->where('campus_details.campus_id',$formData['campus_id'])
                            ->where('campus_details.system_id',$formData['system_id'])
                            ->where('campus_classes.class_id',$formData['class_id'])
                            ->get();                    
        
        $classSections = Section::get();                                
        
        return array(   
            'classGroups'   => $classGroups,
            'classSections' => $classSections
        );
    }

    public function getCampusClasses($data = array()){
       
        $campusClasses = Classes::select('classes.id','classes.class')
                            ->join('campus_classes','campus_classes.class_id','=','classes.id')
                            ->join('campus_details','campus_details.id','=','campus_classes.campus_detail_id')
                            ->where('campus_details.campus_id',$data['campus_id'])
                            ->where('campus_details.system_id',$data['system_id'])
                            ->where('classes.is_active',1)
                            ->where('classes.is_delete',0)
                            ->get();
                            
        return $campusClasses;
    }

    public function listing(){
        
        $campus = Campus::all();
        $data = array(
            'campus'    =>  $campus,
            'page'      =>  'Campus',
            'menu'      =>  'Manage Campus'
        );

        return view('campus.listing', compact('data'));
    }

    public function add(){

        $systems = System::all();
        
        $data = array(
            'page'       =>  'Campus',
            'menu'       =>  'Add Campus',
            'systems'    =>  $systems
        );

        return view('campus.add', compact('data'));
    }

    public function store(Request $request) {
        
        // dd($request->toArray());

        $validator = Validator::make($request->all(), [
            'campus'          =>  'required|max:20',
            'email'           =>  'required',
            'phone'           =>  'required|max:15',
            'address'         =>  'required|max:60',
            'active_session'  =>  'required|numeric',
            'system_id.*'     =>  'required|numeric',
            'short_name.*'    =>  'required|unique:campuses,campus|max:10',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $campus = new Campus;

            $campus->campus           =  $request->name;
            $campus->email          =  $request->email;
            $campus->phone          =  $request->phone;
            $campus->address        =  $request->address;
            $campus->active_session =  $request->active_session;

            if(isset($request->logo)) {
                $imageName = time().'.'.$request->logo->extension();  
                $request->logo->move(public_path('uploads/campus/'), $imageName);
                $campus->logo = "uploads/campus/".$imageName;
            }

            $query = $campus->save();

            if ($query) {
                
                $campusDetails = new CampusDetails;
                $campusDetails->campus_id = $campus->id;
                $campusDetails->short_name = $request->short_name;
                $campusDetails->system_id = $request->system;
                
                $query2 = $campusDetails->save();

                if($query2) {

                    $response = array(
                        'status'   =>  true, 
                        'message'  =>  'Campus has been added successfully'
                    );
    
                    return response()->json($response);

                }else {

                    $response = array(
                        'status'   =>  false, 
                        'message'  =>  'Some thing went worng, please update campus details manually.'
                    );
    
                    return response()->json($response);

                }


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
        $campus = Campus::find($id);
        $data = array(
            'campus'  =>  $campus,
            'page'    =>  'Campus',
            'menu'    =>  'Edit Campus'
        );

        return view('campus.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'campus'          =>  'required|unique:campus,campus|string|min:6,max:20',
        ]);

        if ($validator->errors()->all()) {

            $response = array(
                'status'  =>  false, 
                'error'   =>  $validator->errors()->toArray()
            );
            
            return response()->json($response);

        } else {
            $system = System::find($id);

            $driver->name          =  $request->name;
            $driver->address       =  $request->address;
            $driver->cnic          =  $request->cnic;
            $driver->license_no    =  $request->license_no;
            $driver->joining_date  =  date('Y-m-d', strtotime($request->joining_date));

            $query = $driver->update();

            if ($query) {

                $response = array(
                    'status'   =>  true, 
                    'message'  =>  'Driver has been updated successfully'
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
