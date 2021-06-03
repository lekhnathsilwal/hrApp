<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Department;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Auth;

class DepartmentController extends Controller
{
    public $permission;
    public function __construct()
    {
        $this->permission=new PermissionController();
    }
    public function showDepartments(){
        $permission=$this->permission->getPermission();
        if((array_key_exists('department',$permission))?(($permission['department']['r']==1)?1:0):0){
            $departments = Department::where('status', 1)->get();
            return view('admins.showDepartments')->with(['departments' => $departments, 'trash' => 0, 'permission' => $permission]);
        }else{
            abort(404);
        }
    }
    public function addDepartment(){
        $permission=$this->permission->getPermission();
        if((array_key_exists('department',$permission))?(($permission['department']['c']==1)?1:0):0){
                return view('admins.createDepartment')->with('permission',$permission);
        }else{
            abort(404);
        }
    }
    public function storeDepartment(Request $request){
        $permission=$this->permission->getPermission();
        if((array_key_exists('department',$permission))?(($permission['department']['c']==1)?1:0):0) {
            $this->validate($request, [
                'description' => 'required',
                'name' => 'required|min:3|max:64|unique:departments,name',
                'image' => 'required|image'
            ], ['name.unique' => 'The :input department already exist']);
            if ($request->hasFile('image')) {
                //Get name of file with extension
                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                //Get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //Upload image
                $path = $request->file('image')->move(public_path().'/uploads/departments', $fileNameToStore);
            } else {
                $fileNameToStore = 'nopp.jpg';
            }
            $department = new Department;
            $department->name = $request->name;
            $department->description = $request->description;
            $department->status = 1;
            $department->image = $fileNameToStore;
            $created_by = Admin::find(Auth::guard('admin')->user()->id);
            $department->created_admin()->associate($created_by);
            if ($department->save()) {
                return redirect()->route('show.departments')->with('success', 'Department added successfully');
            } else {
                return redirect()->route('show.departments')->with('error', 'Department addition failed!!!');
            }
        }else{
            abort(404);
        }
    }
    public function editDepartment($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('department',$permission))?(($permission['department']['u']==1)?1:0):0) {
            $department = Department::find($id);
            return view('admins/editDepartment')->with(['department'=> $department,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function updateDepartment(Request $request, $id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('department',$permission))?(($permission['department']['u']==1)?1:0):0) {
            $department = Department::find($id);
            $this->validate($request, [
                'description' => 'required',
                'name' => 'required|min:3|max:64|unique:departments,name,' . $department->id,
                'image' => 'image'
            ], ['name.unique' => 'The :input department already exist']);
            if ($request->hasFile('image')) {
                //delete old image
                File::delete("uploads/departments/" . $department->image);
                //Get name of file with extension
                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                //Get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //Upload image
                $path = $request->file('image')->move(public_path().'/uploads/departments', $fileNameToStore);
                $department->image = $fileNameToStore;
            }
            $department->name = $request->name;
            $department->description = $request->description;
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $department->updated_admin()->associate($updated_by);
            if ($department->save()) {
                if ($department->status == 1) {
                    return redirect()->route('show.departments')->with('success', 'Department updated successfully');
                } else {
                    return redirect()->route('show.department.trash')->with('success', 'Department updated successfully');
                }
            } else {
                return redirect()->route('edit.department', ['id' => $id])->with('error', 'Department update failed!!!');
            }
        }else{
            abort(404);
        }
    }
    public function deleteDepartment($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('department',$permission))?(($permission['department']['d']==1)?1:0):0) {
            $department = Department::find($id);
            $sec = count($department->sections->where('status', 1));
            if ($sec > 0) {
                return redirect()->route('show.departments')->with('error', 'The department ' . $department->name . ' contsist ' . $sec . ' sections first delete them to delete the department');
            } else {
                $deleted_by = Admin::find(Auth::guard('admin')->user()->id);
                $department->deleted_admin()->associate($deleted_by);
                $department->status = 0;
                $department->save();
                return redirect()->route('show.departments')->with('success', 'Department deleted successfully');
            }
        }else{
            abort(404);
        }
    }
}
