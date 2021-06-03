<?php

namespace App\Http\Controllers;

use App\EmployeeHistory;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Section;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public $permission;
    public function __construct()
    {
        $this->permission=new PermissionController();
    }
    public function addExperience($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['c']==1)?1:0):0) {
            $departments = Department::select('id', 'name')->get();
            $data = [];
            foreach (Auth::guard('admin')->user()->company->admins as $admin) {
                if ($admin->status == 1) {
                    $data[] = $admin;
                }
            }
            if (count($departments) > 0) {
                return view('admins.createEmployeeExperience')->with(['id' => $id, 'departments' => $departments, 'supervisors' => $data,'permission'=>$permission]);
            } else {
                return redirect()->back()->with('error', 'there is no any departments first add department and create experience');
            }
        }else{
            abort(404);
        }
    }
    public function storeEmployeeExperience(Request $request, $id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['c']==1)?1:0):0) {
            $this->validate($request, [
                'joined_date' => 'date|required',
                'position' => 'required|min:1|max:64',
                'department_id' => 'required',
                'section_id' => 'required',
                'resigned_date' => 'date|nullable',
                'shift_from' => 'required',
                'shift_to' => 'required'
            ]);
            if($request->input('resigned_date')!=null){
                if($request->input('joined_date')>$request->input('resigned_date')){
                    return redirect()->back()->with('error', 'resigned date must be after joined date!!!');
                }
            }
            $history = new EmployeeHistory;
            $employee = Employee::find($id);
            $history->employee()->associate($employee);
            $history->joined_date = $request->joined_date;
            $department = Department::find($request->department_id);
            $history->department()->associate($department);
            $section = Section::find($request->section_id);
            $history->section()->associate($section);
            $history->position = $request->position;
            $history->resigned_date = $request->resigned_date;
            $history->shift_from = $request->shift_from;
            $history->shift_to = $request->shift_to;
            $history->company()->associate(Company::find(Auth::guard('admin')->user()->company_id));
            $supervisor = Admin::find($request->supervisor_id);
            $history->supervisor()->associate($supervisor);
            $history->status = 1;
            $history->review = $request->review;
            $created_by = Admin::find(Auth::guard('admin')->user()->id);
            $history->admin()->associate($created_by);
            if ($history->save()) {
                return redirect()->route('show.employee.details', ['id' => $id])->with('success', 'Experience added successfully');
            } else {
                return redirect()->route('show.employee.details', ['id' => $id])->with('error', 'Experience addition failed!!!');
            }
        }else{
            abort(404);
        }
    }
    public function editExperience($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['u']==1)?1:0):0) {
            $experience = EmployeeHistory::find($id);
            $departments = Department::select('id', 'name')->get();
            $data = [];
            foreach (Auth::guard('admin')->user()->company->admins as $admin) {
                if ($admin->status == 1) {
                    $data[] = $admin;
                }
            }
            if (count($departments) > 0) {
                return view('admins.editExperience')->with(['experience' => $experience, 'departments' => $departments, 'supervisors' => $data,'permission'=>$permission]);
            } else {
                return redirect()->back()->with('error', 'there is no any departments first add department and create experience');
            }
        }else{
            abort(404);
        }
    }
    public function updateExperience(Request $request, $id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['u']==1)?1:0):0) {
            $history = EmployeeHistory::find($id);
            $this->validate($request, [
                'joined_date' => 'date|required',
                'position' => 'required|min:1|max:64',
                'resigned_date' => 'date|nullable',
                'shift_from' => 'required',
                'shift_to' => 'required'
            ]);
            if($request->input('resigned_date')!=null){
                if($request->input('joined_date')>$request->input('resigned_date')){
                    return redirect()->back()->with('error', 'resigned date must be after joined date!!!');
                }
            }
            $history->joined_date = $request->joined_date;
            $department = Department::find($request->department_id);
            $history->department()->associate($department);
            $section = Section::find($request->section_id);
            $history->section()->associate($section);
            $history->position = $request->position;
            $history->resigned_date = $request->resigned_date;
            $history->shift_from = $request->shift_from;
            $history->shift_to = $request->shift_to;
            $supervisor = Admin::find($request->supervisor_id);
            $history->supervisor()->associate($supervisor);
            $history->review = $request->review;
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $history->updated_admin()->associate($updated_by);
            if ($history->save()) {
                return redirect()->route('show.employee.details', ['id' => $history->employee->id])->with('success', 'Experience updated successfully');
            } else {
                return redirect()->route('edit.experience', ['id' => $history->id])->with('error', 'Experience update failed!!!');
            }
        }else{
            abort(404);
        }
    }
    public function deleteExperience($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['d']==1)?1:0):0) {
            $history = EmployeeHistory::find($id);
            $deleted_by = Admin::find(Auth::guard('admin')->user()->id);
            $history->deleted_admin()->associate($deleted_by);
            $history->status = 0;
            $history->save();
            return redirect()->route('show.employee.details', ['id' => $history->employee->id]);
        }else{
            abort(404);
        }
    }
    public function showExperienceDetails($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['r']==1)?1:0):0) {
            $history = EmployeeHistory::find($id);
            return view('admins.viewExperienceDetail')->with(['history' => $history, 'permission' => $permission]);
        }else{
            abort(404);
        }
    }
}
