<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public $permission;
    public function __construct()
    {
        $this->permission=new PermissionController();
    }
    public function search($val)
    {
        $data='';

        if(Auth::user()->type==0) {
            $companies = Company::where("name", "like", $val . '%')->get();
            if (count($companies) > 0) {
                $data .= "<h5>Companies</h5>";
                foreach ($companies as $company) {
                    $data .= "<a href='".route('show.company.details',['id'=>$company->id])."'><li>$company->name</li></a>";
                }
            }
            $admins = Admin::where("name", "like",  $val . '%')
                            ->orWhere("email", "like",  $val . '%')
                            ->orWhere("contact", "like", '%'.  $val . '%')->get();
            if (count($admins) > 0) {
                $data .= "<h5>Admins</h5>";
                foreach ($admins as $admin) {
                    $data .= "<a href='" . route('show.admin.details',['id'=>$admin->id]) . "'><li>$admin->name</li></a>";
                }
            }
            $employees = Employee::where("name", "like", $val . '%')
                                    ->orWhere("email", "like", $val .'%')
                                    ->orWhere("contact", "like",'%'. $val .'%')->get();
            if (count($employees) > 0) {
                $data .= "<h5>Employees</h5>";
                foreach ($employees as $employee) {
                    $data .= "<a href='" . route('show.employee.details',['id'=>$employee->id]) . "'><li>$employee->name</li></a>";
                }
            }
            $departments = Department::where("name", "like", $val . '%')->get();
            if (count($departments) > 0) {
                $data .= "<h5>Departments</h5>";
                foreach ($departments as $department) {
                    $data .= "<a href='".(($department->status==0)?route('show.trash.department.sections',['id'=>$department->id]):route('show.sections',['id'=>$department->id]))."'><li>$department->name</li></a>";
                }
            }
            $sections = Section::where("name", "like", $val . '%')->get();
            if (count($sections) > 0) {
                $data .= "<h5>Sections</h5>";
                foreach ($sections as $section) {
                    $data .= "<a href='".(($section->status==0)?route('show.trash.section.histories',['id'=>$section->id]):route('show.sectionEmployees',['id'=>$section->id]))."'><li>$section->name</li></a>";
                }
            }
            if(strlen($data)==0)
            {
                return "<h5>No record Found!</h5>";
            }
        }
        else
        {
            $permission=$this->permission->getPermission();
            if((array_key_exists('admin',$permission))?(($permission['admin']['r']==1)?1:0):0) {
                $admins = Admin::where("name", "like", $val . '%')
                    ->orWhere("email", "like", $val . '%')
                    ->orWhere("contact", "like", '%' . $val . '%')->where('company_id', Auth::guard('admin')->user()->company_id)->get();
                if (count($admins) > 0) {
                    $data .= "<h5>Admins</h5>";
                    foreach ($admins as $admin) {
                        if($admin->type!=0) {
                            if ($admin->status == 0) {
                                if ((array_key_exists('trash', $permission)) ? (($permission['trash']['r'] == 1) ? 1 : 0) : 0) {
                                    $data .= "<a href='" . route('show.admin.details', ['id' => $admin->id]) . "'><li>$admin->name</li></a>";
                                }
                            } else {
                                $data .= "<a href='" . route('show.admin.details', ['id' => $admin->id]) . "'><li>$admin->name</li></a>";
                            }
                        }
                    }
                }
            }
            if((array_key_exists('employee',$permission))?(($permission['employee']['r']==1)?1:0):0) {
                $employees = Employee::where("name", "like", $val . '%')
                    ->orWhere("email", "like", $val . '%')
                    ->orWhere("contact", "like", '%' . $val . '%')->get();
                if (count($employees) > 0) {
                    $data .= "<h5>Employees</h5>";
                    foreach ($employees as $employee) {
                        if($employee->status==0){
                            if((array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0) {
                                $data .= "<a href='" . route('show.employee.details', ['id' => $employee->id]) . "'><li>$employee->name</li></a>";
                            }
                        }else{
                            $data .= "<a href='" . route('show.employee.details', ['id' => $employee->id]) . "'><li>$employee->name</li></a>";
                        }
                    }
                }
            }
            if((array_key_exists('department',$permission))?(($permission['department']['r']==1)?1:0):0) {
                $departments = Department::where("name", "like", $val . '%')->get();
                if (count($departments) > 0) {
                    $data .= "<h5>Departments</h5>";
                    foreach ($departments as $department) {
                        if($department->status==0){
                            $data .= "<a href='" . (((array_key_exists('section',$permission))?(($permission['section']['r']==1)?1:0):0 && (array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0) ? route('show.trash.department.sections', ['id' => $department->id]):'#') . "'><li>$department->name</li></a>";
                        }else{
                            $data .= "<a href='" . (((array_key_exists('section',$permission))?(($permission['section']['r']==1)?1:0):0) ? route('show.sections', ['id' => $department->id]):'#') . "'><li>$department->name</li></a>";
                        }
                    }
                }
            }
            if((array_key_exists('section',$permission))?(($permission['section']['r']==1)?1:0):0) {
                $sections = Section::where("name", "like", $val . '%')->get();
                if (count($sections) > 0) {
                    $data .= "<h5>Sections</h5>";
                    foreach ($sections as $section) {
                        if($section->status==0){
                            $data .= "<a href='" . (((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['r']==1)?1:0):0 && (array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0) ? route('show.trash.section.histories', ['id' => $section->id]) : '#') . "'><li>$section->name</li></a>";
                        }else{
                            $data .= "<a href='" . (((array_key_exists('employee',$permission))?(($permission['employee']['r']==1)?1:0):0) ? route('show.sectionEmployees', ['id' => $section->id]):'#') . "'><li>$section->name</li></a>";
                        }
                    }
                }
            }
            if(strlen($data)==0)
            {
                return "<h5>No record Found!</h5>";
            }
        }

        return $data;

    }
}
