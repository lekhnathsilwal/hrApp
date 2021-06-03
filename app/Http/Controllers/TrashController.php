<?php

namespace App\Http\Controllers;

use App\EmployeeHistory;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Section;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TrashController extends Controller
{
    public $permission;
    public function __construct()
    {
        $this->permission=new PermissionController();
    }
    public function showTrashAdmins(){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0)&&((array_key_exists('admin',$permission))?(($permission['admin']['r']==1)?1:0):0)) {
            if (Auth::guard('admin')->user()->type == 0) {
                $admins = Admin::where(['type' => 0, 'status' => 0])->get();
            } else {
                $admins = Admin::where(['company_id' => Auth::guard('admin')->user()->company_id, 'status' => 0])->get();
            }
            return view('admins.showAdmins')->with(['admins' => $admins, 'trash' => 1,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function restoreAdmin($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['c']==1)?1:0):0)&&((array_key_exists('admin',$permission))?(($permission['admin']['c']==1)?1:0):0)) {
            $admin = Admin::find($id);
            $admin->status = 1;
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $admin->updated_admin()->associate($updated_by);
            $admin->save();
            return redirect()->back()->with('success', 'Admin ' . $admin->name . ' restored Successfully');
        }else{
            abort(404);
        }
    }
    public function permanentDeleteAdmin($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['d']==1)?1:0):0)&&((array_key_exists('admin',$permission))?(($permission['admin']['d']==1)?1:0):0)) {
            $admin = Admin::find($id);
            if($admin->profile_picture!='nopp.jpg') {
                //delete image
                File::delete("uploads/admin/profile_picture/" . $admin->profile_picture);
            }
            $admin->delete();
            return redirect()->route('show.admin.trash')->with('success', 'Admin Deleted Permanently');
        }else{
            abort(404);
        }
    }
    public function showTrashRoles(){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0)&&((array_key_exists('role',$permission))?(($permission['role']['r']==1)?1:0):0)) {
            if (Auth::guard('admin')->user()->type == 0) {
                $admins = Admin::where('type', 0)->get();
                $roles = [];
                foreach ($admins as $admin) {
                    foreach ($admin->created_roles as $created_role) {
                        if ($created_role->status == 0) {
                            $roles[][] = $created_role;
                        }
                    }
                }
            } else {
                $admins = Admin::where(['company_id' => Auth::guard('admin')->user()->company_id])->get();
                $roles = [];
                foreach ($admins as $admin) {
                    foreach ($admin->created_roles as $created_role) {
                        if ($created_role->status == 0) {
                            $roles[][] = $created_role;
                        }
                    }
                }
            }
            return view('admins.showRoles')->with(['roles' => $roles, 'trash' => 1,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function restoreRole($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['c']==1)?1:0):0)&&((array_key_exists('role',$permission))?(($permission['role']['c']==1)?1:0):0)) {
            $role = Role::find($id);
            $role->status = 1;
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $role->updated_admin()->associate($updated_by);
            $role->save();
            return redirect()->back()->with('success', 'The role' . $role->name . 'restored successfully');
        }else{
            abort(404);
        }
    }
    public function permanentDeleteRole($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['d']==1)?1:0):0)&&((array_key_exists('role',$permission))?(($permission['role']['d']==1)?1:0):0)) {
            $role = Role::find($id);
            $role->delete();
            return redirect()->route('show.role.trash')->with('success', 'Role Deleted Permanently');
        }else{
            abort(404);
        }
    }
    public function showTrashExperience(){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0)&&((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['r']==1)?1:0):0)) {
            $employee_histories = EmployeeHistory::where(['company_id' => Auth::guard('admin')->user()->company_id, 'status' => 0])->get();
            return view('admins.showEmployeeHistoryTrash')->with(['employee_histories' => $employee_histories, 'trash' => 1,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function restoreExperience($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['c']==1)?1:0):0)&&((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['c']==1)?1:0):0)) {
            $history = EmployeeHistory::find($id);
            $history->status = 1;
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $history->updated_admin()->associate($updated_by);
            $history->save();
            return redirect()->route('show.employee.details', ['id' => $history->employee->id]);
        }else{
            abort(404);
        }
    }
    public function permanentDeleteExperience($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['d']==1)?1:0):0)&&((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['d']==1)?1:0):0)) {
            $history = EmployeeHistory::find($id);
            $history->delete();
            return redirect()->route('show.employee.history.trash')->with('success', 'Experience Deleted Successfully!!!');
        }else{
            abort(404);
        }
    }
    public function showTrashEmployee(){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0)&&((array_key_exists('employee',$permission))?(($permission['employee']['r']==1)?1:0):0)) {
            $employees = Employee::where('status', 0)->get();
            return view('admins.showEmployees')->with(['employees' => $employees, 'trash' => 1,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function restoreEmployee($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['c']==1)?1:0):0)&&((array_key_exists('employee',$permission))?(($permission['employee']['c']==1)?1:0):0)) {
            $employee = Employee::find($id);
            $employee->status = 1;
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $employee->updated_admin()->associate($updated_by);
            $employee->save();
            return redirect()->back()->with('success', 'Employee ' . $employee->name . ' restored successfully!!!');
        }else{
            abort(404);
        }
    }
    public function permanentDeleteEmployee($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['d']==1)?1:0):0)&&((array_key_exists('employee',$permission))?(($permission['employee']['d']==1)?1:0):0)) {
            $employee = Employee::find($id);
            //delete image
            File::delete("uploads/employee/profile_picture/" . $employee->profile_picture);
            $employee->delete();
            return redirect()->route('show.employee.trash')->with('success', 'Employee Deleted Successfully!!!');
        }else{
            abort(404);
        }
    }
    public function showTrashDepartment(){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0)&&((array_key_exists('department',$permission))?(($permission['department']['r']==1)?1:0):0)) {
            $departments = Department::where('status', 0)->get();
            return view('admins.showDepartments')->with(['departments' => $departments, 'trash' => 1,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function showTrashSection(){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0)&&((array_key_exists('section',$permission))?(($permission['section']['r']==1)?1:0):0)) {
            $sections = Section::where('status', 0)->get();
            $department = null;
            if (count($sections) > 0) {
                $department = $sections->first()->department;
            }
            return view('admins.showSections')->with(['sections' => $sections, 'department' => $department, 'trash' => 1,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function showTrashSectionHistories($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0)&&((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['r']==1)?1:0):0)) {
            $employee_histories = EmployeeHistory::where('section_id', $id)->get();
            return view('admins.showEmployeeHistoryTrash')->with(['employee_histories' => $employee_histories, 'trash' => 1,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function showTrashDepartmentSections($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0)&&((array_key_exists('section',$permission))?(($permission['section']['r']==1)?1:0):0)) {
            $department = Department::find($id);
            $sections = $department->sections;
            return view('admins.showSections')->with(['sections' => $sections, 'department' => $department, 'trash' => 1,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function restoreDepartment($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['c']==1)?1:0):0)&&((array_key_exists('department',$permission))?(($permission['department']['c']==1)?1:0):0)) {
            $department = Department::find($id);
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $department->updated_admin()->associate($updated_by);
            $department->status = 1;
            $department->save();
            return redirect()->route('show.departments')->with('success', 'Department ' . $department->name . ' restored successfully!!!');
        }else{
            abort(404);
        }
    }
    public function permanentDeleteDepartment($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['d']==1)?1:0):0)&&((array_key_exists('department',$permission))?(($permission['department']['d']==1)?1:0):0)) {
            $department = Department::find($id);
            $cnt = count($department->sections);
            if ($cnt > 0) {
                return redirect()->route('show.department.trash')->with('error', 'There are ' . $cnt . ' sections in associated with this department first delete those to delete the department');
            } else {
                //delete image
                File::delete("uploads/departments/" . $department->image);
                $department->delete();
                return redirect()->route('show.department.trash')->with('success', 'Department deleted permanently');
            }
        }else{
            abort(404);
        }
    }
    public function restoreSection($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['c']==1)?1:0):0)&&((array_key_exists('section',$permission))?(($permission['section']['c']==1)?1:0):0)) {
            $section = Section::find($id);
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $section->updated_admin()->associate($updated_by);
            $section->status = 1;
            $section->save();
            if ($section->department->status == 1) {
                return redirect()->route('show.sections', ['id' => $section->department->id])->with('success', 'Section ' . $section->name . ' restored successfully!!!');
            } else {
                return redirect()->route('show.section.trash')->with('success', 'Section ' . $section->name . ' restored successfully!!!');
            }
        }else{
            abort(404);
        }
    }
    public function permanentDeleteSection($id){
        $permission=$this->permission->getPermission();
        if(((array_key_exists('trash',$permission))?(($permission['trash']['d']==1)?1:0):0)&&((array_key_exists('section',$permission))?(($permission['section']['d']==1)?1:0):0)) {
            $section = Section::find($id);
            $cnt = count($section->employee_histories);
            if ($cnt > 0) {
                return redirect()->route('show.section.trash')->with('error', 'There are ' . $cnt . ' employee histories in associated with this section first delete those to delete the section');
            } else {
                //delete image
                File::delete("uploads/sections/" . $section->image);
                $section->delete();
                return redirect()->route('show.section.trash')->with('success', 'Section deleted permanently');
            }
        }else{
            abort(404);
        }
    }
}
