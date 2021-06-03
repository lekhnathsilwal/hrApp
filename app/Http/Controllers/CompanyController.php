<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    public $permission;
    public function __construct()
    {
        $this->permission=new PermissionController();
    }
    public function create(){
        $permission=$this->permission->getPermission();
        if((array_key_exists('company',$permission))?(($permission['company']['c']==1)?1:0):0) {
            return view('companies.createCompany')->with('permission', $permission);
        }else{
            abort(404);
        }
    }
    public function store(Request $request){
        $permission=$this->permission->getPermission();
        if((array_key_exists('company',$permission))?(($permission['company']['c']==1)?1:0):0) {
            $this->validate($request, [
                'name' => 'required|max:64|unique:companies,name',
                'image' => 'required|image'
            ], ['name.unique' => 'The :input company already exist']);
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
                $path = $request->file('image')->move(public_path().'/uploads/companies', $fileNameToStore);
            } else {
                $fileNameToStore = 'nopp.jpg';
            }
            $company = new Company;
            $company->name = $request->name;
            $company->image = $fileNameToStore;
            $company->save();
            return redirect()->route('show.companies');
        }else{
            abort(404);
        }
    }
    public function edit($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('company',$permission))?(($permission['company']['u']==1)?1:0):0) {
            $company = Company::find($id);
            return view('companies.editCompany')->with(['company' => $company, 'permission' => $permission]);
        }else{
            abort(404);
        }
    }
    public function update(Request $request,$id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('company',$permission))?(($permission['company']['u']==1)?1:0):0) {
            $this->validate($request, [
                'name' => 'required|max:64|unique:companies,name,' . $id,
                'image' => 'image'
            ], ['name.unique' => 'The :input company already exist']);
            $company = Company::find($id);
            if ($request->hasFile('image')) {
                //delete old image
                File::delete("uploads/companies/" . $company->image);
                //Get name of file with extension
                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                //Get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //Upload image
                $path = $request->file('image')->move(public_path().'/uploads/companies', $fileNameToStore);
                $company->image = $fileNameToStore;
            }
            $company->name = $request->name;
            $company->save();
            return redirect()->route('show.companies');
        }else{
            abort(404);
        }
    }
    public function show(){
        $permission=$this->permission->getPermission();
        if((array_key_exists('company',$permission))?(($permission['company']['r']==1)?1:0):0) {
            $companies = Company::all();
            return view('companies.showCompanies')->with(['companies' => $companies, 'permission' => $permission]);
        }else{
            abort(404);
        }
    }
    public function delete($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('company',$permission))?(($permission['company']['d']==1)?1:0):0) {
            $company = Company::find($id);
            File::delete("uploads/companies/" . $company->image);
            $company->delete();
            return redirect()->route('show.companies');
        }else{
            abort(404);
        }
    }
    public function showCompanyDetails($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('company',$permission))?(($permission['company']['r']==1)?1:0):0) {
            $company = Company::find($id);
            return view('companies.companyDetails')->with(['company' => $company, 'permission' => $permission]);
        }else{
            abort(404);
        }
    }
}
