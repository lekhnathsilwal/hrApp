<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public $permission;
    public function __construct()
    {
        $this->permission=new PermissionController();
    }
    public function showEmployees(){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee',$permission))?(($permission['employee']['r']==1)?1:0):0) {
            $employees = Employee::where('status', 1)->get();
            return view('admins.showEmployees')->with(['employees' => $employees, 'trash' => 0,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function showCompanyPresentEmployees(){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee',$permission))?(($permission['employee']['r']==1)?1:0):0) {
            $company=Auth::guard('admin')->user()->company;
            $employees=[];
            foreach($company->employee_histories->where('status',1)->where('resigned_date',null)->unique('employee_id') as $employee_history) {
                if ($employee_history->employee->status == 1) {
                    $employees[] = $employee_history->employee;
                }
            }
            return view('admins.showEmployees')->with(['employees' => $employees, 'trash' => 0,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function showCompanyPastEmployees(){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee',$permission))?(($permission['employee']['r']==1)?1:0):0) {
            $company=Auth::guard('admin')->user()->company;
            $employees=[];
            foreach($company->employee_histories->where('status',1)->where('resigned_date','!=',null)->unique('employee_id') as $employee_history) {
                if ($employee_history->employee->status == 1) {
                    $employees[] = $employee_history->employee;
                }
            }
            return view('admins.showEmployees')->with(['employees' => $employees, 'trash' => 0,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function addEmployee(){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee',$permission))?(($permission['employee']['c']==1)?1:0):0) {
            return view('admins.createEmployee')->with('permission',$permission);
        }else{
            abort(404);
        }
    }
    public function storeEmployee(Request $request){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee',$permission))?(($permission['employee']['c']==1)?1:0):0) {
            $this->validate($request, [
                'email' => 'email|required|unique:employees,email',
                'name' => 'required|min:3|max:64',
                'contact' => 'required|min:9|max:16',
                'address' => 'required|min:3|max:128',
                'profile_picture' => 'required|image',
                'dob' => 'required|date',
                'gender' => 'required'
            ]);
            if ($request->hasFile('profile_picture')) {
                //Get name of file with extension
                $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();
                //Get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //Upload image
                $path = $request->file('profile_picture')->move(public_path().'/uploads/employee/profile_picture', $fileNameToStore);
            } else {
                $fileNameToStore = 'nopp.jpg';
            }
            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->contact = $request->contact;
            $employee->dob = $request->dob;
            $employee->gender = $request->gender;
            $employee->profile_picture = $fileNameToStore;
            $employee->status = 1;
            $created_by = Admin::find(Auth::guard('admin')->user()->id);
            $employee->admin()->associate($created_by);
            if ($employee->save()) {
                return redirect()->route('show.employees')->with('success', 'Employee added successfully');
            } else {
                return redirect()->route('show.employees')->with('error', 'Employee addition failed!!!');
            }
        }else{
            abort(404);
        }
    }
    public function showEmployeeDetails($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee',$permission))?(($permission['employee']['r']==1)?1:0):0) {
            $employee = Employee::find($id);
            return view('admins.showEmployeeDetails')->with(['employee'=> $employee,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function editEmployee($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee',$permission))?(($permission['employee']['u']==1)?1:0):0) {
            $employee = Employee::find($id);
            return view('admins.editEmployee')->with(['employee'=>$employee,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function updateEmployee(Request $request, $id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee',$permission))?(($permission['employee']['u']==1)?1:0):0) {
            $employee = Employee::find($id);
            $this->validate($request, [
                'email' => 'email|required|unique:employees,email,' . $employee->id,
                'name' => 'required|min:3|max:64',
                'contact' => 'required|min:9|max:16',
                'address' => 'required|min:3|max:128',
                'profile_picture' => 'image',
                'dob' => 'required|date',
                'gender' => 'required'
            ]);
            if ($request->hasFile('profile_picture')) {
                //delete old image
                File::delete("uploads/employee/profile_picture/" . $employee->profile_picture);
                //Get name of file with extension
                $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();
                //Get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //Upload image
                $path = $request->file('profile_picture')->move(public_path().'/uploads/employee/profile_picture', $fileNameToStore);
                $employee->profile_picture = $fileNameToStore;
            }
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->contact = $request->contact;
            $employee->dob = $request->dob;
            $employee->gender = $request->gender;
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $employee->updated_admin()->associate($updated_by);
            if ($employee->save()) {
                if ($employee->status == 1) {
                    return redirect()->route('show.employees')->with('success', 'Employee update successfully');
                } else {
                    return redirect()->route('show.employee.trash')->with('success', 'Employee updated successfully');
                }
            } else {
                return redirect()->route('edit.employees', ['id' => $id])->with('error', 'Employee update failed!!!');
            }
        }else{
            abort(404);
        }
    }
    public function deleteEmployee($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee',$permission))?(($permission['employee']['d']==1)?1:0):0) {
            $employee = Employee::find($id);
            $deleted_by = Admin::find(Auth::guard('admin')->user()->id);
            $employee->deleted_admin()->associate($deleted_by);
            $employee->status = 0;
            $employee->save();
            return redirect()->back()->with('success', 'Employee deleted successfully');
        }else{
            abort(404);
        }
    }
}
