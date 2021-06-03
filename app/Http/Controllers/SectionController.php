<?php

namespace App\Http\Controllers;

use App\EmployeeHistory;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public $permission;
    public function __construct()
    {
        $this->permission=new PermissionController();
    }
    public function showSections($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('section',$permission))?(($permission['section']['r']==1)?1:0):0) {
            $department = Department::find($id);
            $sections = array();
            foreach ($department->sections as $section) {
                if ($department->status == 1) {
                    if ($section->status == 1) {
                        $sections[] = $section;
                    }
                } else {
                    $sections[] = $section;
                }
            }
            return view('admins.showSections')->with(['sections' => $sections, 'department' => $department, 'trash' => 0,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function addSection($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('section',$permission))?(($permission['section']['c']==1)?1:0):0) {
            return view('admins.createSection')->with(['id'=> $id,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function storeSection(Request $request,$id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('section',$permission))?(($permission['section']['c']==1)?1:0):0) {
            $this->validate($request, [
                'description' => 'required',
                'name' => 'required|min:3|max:64',
                'image' => 'required|image'
            ]);
            if (count(Section::where('department_id', $id)->where('name', $request->name)->get()) > 0) {
                return redirect()->route('show.sections', ['id' => $id])->with('error', 'The ' . "$request->name" . ' section already exist');
            }
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
                $path = $request->file('image')->move(public_path().'/uploads/sections', $fileNameToStore);
            } else {
                $fileNameToStore = 'nopp.jpg';
            }
            $section = new Section;
            $section->name = $request->name;
            $section->description = $request->description;
            $section->status = 1;
            $department = Department::find($id);
            $section->department()->associate($department);
            $section->image = $fileNameToStore;
            $created_by = Admin::find(Auth::guard('admin')->user()->id);
            $section->created_admin()->associate($created_by);
            if ($section->save()) {
                return redirect()->route('show.sections', ['id' => $id])->with('success', 'Section added successfully');
            } else {
                return redirect()->route('show.sections', ['id' => $id])->with('error', 'Section addition failed!!!');
            }
        }else{
            abort(404);
        }
    }
    public function getSection($id){
        $department=Department::find($id);
        if(!$department){
            $options = '<option disabled>Select Department</option>';
        }else{
            $sections=$department->sections;
            if(count($sections)>0){
                $options = '<option disabled>Select One</option>';
            }else{
                $options = '<option disabled>No section available in this department first add section to this department</option>';
            }
            foreach($sections as $section){
                $options .= '<option value="'.$section->id.'">'.$section->name.'</option>';
            }
        }
        return response()->json([
            'options' => $options
        ]);
    }
    public function showSectionEmployees($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('employee',$permission))?(($permission['employee']['r']==1)?1:0):0) {
            $employee_histories = EmployeeHistory::where(['section_id' => $id, 'status' => 1])->select('employee_id')->distinct()
                ->with('employee')->get();
            $employees = [];
            foreach ($employee_histories as $history) {
                if ($history->employee->status == 1) {
                    $employees[] = $history->employee;
                }
            }
            return view('admins.showEmployees')->with(['employees' => $employees, 'trash' => 0,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function editSection($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('section',$permission))?(($permission['section']['u']==1)?1:0):0) {
            $section = Section::find($id);
            return view('admins.editSection')->with(['section'=> $section,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function updateSection(Request $request,$id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('section',$permission))?(($permission['section']['u']==1)?1:0):0) {
            $section = Section::find($id);
            $this->validate($request, [
                'description' => 'required',
                'name' => 'required|min:3|max:64',
                'image' => 'image'
            ]);
            if (count(Section::where(['department_id' => $section->department->id, 'name' => $request->name])->where('id', '!=', $id)->get()) > 0) {
                return redirect()->route('edit.section', ['id' => $id])->with('error', 'The ' . "$request->name" . ' section already exist');
            }
            if ($request->hasFile('image')) {
                //delete old image
                File::delete("uploads/sections/" . $section->image);
                //Get name of file with extension
                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                //Get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //Upload image
                $path = $request->file('image')->move(public_path().'/uploads/sections', $fileNameToStore);
                $section->image = $fileNameToStore;
            }
            $section->name = $request->name;
            $section->description = $request->description;
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $section->updated_admin()->associate($updated_by);
            if ($section->save()) {
                if ($section->status == 1) {
                    return redirect()->route('show.sections', ['id' => $section->department->id])->with('success', 'Section updated successfully');
                } else {
                    return redirect()->route('show.section.trash', ['id' => $section->department->id])->with('success', 'Section updated successfully');
                }
            } else {
                return redirect()->route('edit.section', ['id' => $id])->with('error', 'Section update failed!!!');
            }
        }else{
            abort(404);
        }
    }
    public function deleteSection($id)
    {
        $permission=$this->permission->getPermission();
        if((array_key_exists('section',$permission))?(($permission['section']['d']==1)?1:0):0) {
            $section = Section::find($id);
            $employee_histories = EmployeeHistory::where(['section_id' => $id, 'status' => 1])->select('employee_id')->distinct()
                ->with('employee')->get();
            $employees = [];
            foreach ($employee_histories as $history) {
                if ($history->employee->status == 1) {
                    $employees[] = $history->employee;
                }
            }
            $emp = count($employees);
            if ($emp > 0) {
                return redirect()->route('show.sections', ['id' => $section->department->id])->with('error', 'The section ' . $section->name . ' contains ' . $emp . ' employees first remove them from this section and delete this section');
            } else {
                $deleted_by = Admin::find(Auth::guard('admin')->user()->id);
                $section->deleted_admin()->associate($deleted_by);
                $section->status = 0;
                $section->save();
                return redirect()->route('show.sections', ['id' => $section->department->id])->with('success', 'Section deleted successfully');
            }
        }else{
            abort(404);
        }
    }
}
