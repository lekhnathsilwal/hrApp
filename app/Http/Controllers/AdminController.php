<?php

namespace App\Http\Controllers;

use App\AdminRole;
use App\Crudable;
use App\EmployeeHistory;
use App\Mail\ForgetPassword;
use App\Mail\Welcome;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Section;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Hash;
use App\RoleCrudable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public $permission;
    public function __construct()
    {
        $this->permission=new PermissionController();
    }
    public function showLoginForm(){
        return view('admins.loginForm');
    }
    public function checkLogin(Request $request){

        if($request->remember){
            $remember=true;
        }else{
            $remember=false;
        }
        $this->validate($request,[
            'email'=>'email|required',
            'password'=>'required|min:6|max:32'
        ]);
        if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $remember)){
            if(Auth::guard('admin')->user()->status==1){
                return redirect()->intended(route('dashboard'));
            }else{
                Auth::guard('admin')->logout();
                return redirect()->back()->with('error','Sorry your account has been deleted');
            }
        }
        else{
            return redirect()->back()->with('error','Email or password doesnot match');
        }
    }
    public function showDashboard(){
        $permission=$this->permission->getPermission();
        $company=count(Company::all());
        $employee_experience=count(EmployeeHistory::all());
        $employee=count(Employee::all());
        return view('admins.dashboard')->with(['permission'=>$permission,'company'=>$company,'employee'=>$employee,'employee_experience'=>$employee_experience]);
    }
    public function showAdmins(){
        $permission=$this->permission->getPermission();
        if((array_key_exists('admin',$permission))?(($permission['admin']['r']==1)?1:0):0){
            if (Auth::guard('admin')->user()->type == 0) {
                $admins = Admin::where(['type' => 0, 'status' => 1])->get();
            } else {
                $admins = Admin::where(['company_id' => Auth::guard('admin')->user()->company_id, 'status' => 1])->get();
            }
            return view('admins.showAdmins')->with(['admins' => $admins, 'trash' => 0,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function showAdminRegisterForm(){
        $permission=$this->permission->getPermission();
        if((array_key_exists('admin',$permission))?(($permission['admin']['c']==1)?1:0):0) {
            $company = Company::find(Auth::guard('admin')->user()->company_id);
            if (Auth::guard('admin')->user()->type == 0) {
                $admins = Admin::where('type', 0)->get();
                $roles = [];
                foreach ($admins as $admin) {
                    foreach ($admin->created_roles as $created_role) {
                        if ($created_role->status == 1) {
                            $roles[][] = $created_role;
                        }
                    }
                }
            } else {
                $admins = Admin::where('company_id', Auth::guard('admin')->user()->company_id)->get();
                $roles = [];
                foreach ($admins as $admin) {
                    foreach ($admin->created_roles as $created_role) {
                        if ($created_role->status == 1) {
                            $roles[][] = $created_role;
                        }
                    }
                }
            }
            if (count($roles) > 0) {
                return view('admins.registerAdmin')->with(['roles' => $roles, 'company'=>$company, 'permission'=>$permission]);
            } else {
                return redirect()->back()->with('error', 'There are no any active roles first create role and try to register admin');
            }
        }else{
            abort(404);
        }
    }
    public function companyAdminRegister($company_id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('admin',$permission))?(($permission['admin']['c']==1)?1:0):0) {
            $company = Company::find($company_id);
            $admins = Admin::where('type', 0)->get();
            $roles = [];
            foreach ($admins as $admin) {
                foreach ($admin->created_roles as $created_role) {
                    if ($created_role->status == 1) {
                        $roles[][] = $created_role;
                    }
                }
            }
            if (count($roles) > 0) {
                return view('admins.registerAdmin')->with(['roles' => $roles, 'company'=>$company, 'permission'=>$permission]);
            } else {
                return redirect()->back()->with('error', 'There are no any active roles first create role and try to register admin');
            }
        }else{
            abort(404);
        }
    }
    public function storeAdmin(Request $request)
    {
        $permission=$this->permission->getPermission();
        if((array_key_exists('admin',$permission))?(($permission['admin']['c']==1)?1:0):0) {
            $this->validate($request, [
                'email' => 'email|required|unique:admins,email',
//                'password' => 'required|confirmed|min:6|max:32',
                'name' => 'required|min:3|max:64',
                'contact' => 'required|min:9|max:16',
                'role' => 'required',
                'profile_picture' => 'image',
                'position' => 'required|min:2|max:64',
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
                $path = $request->file('profile_picture')->move(public_path().'/uploads/admin/profile_picture', $fileNameToStore);
            } else {
                $fileNameToStore = 'nopp.jpg';
            }
            $admin = new Admin;
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->contact = $request->contact;
            $admin->position = $request->position;
            $password=Str::random(10);
            $admin->password = bcrypt($password);
            $admin->status = 1;
            $admin->gender = $request->gender;
            $admin->profile_picture = $fileNameToStore;
            if (Auth::guard('admin')->user()->type == 0) {
                $admin->type = 1;
            } else {
                $admin->type = 2;
            }
            if ($request->has('company_id')) {
                $admin->company()->associate(Company::find($request->input('company_id')));
            } else {
                $admin->company()->associate(Company::find(Auth::guard('admin')->user()->company_id));
            }
            $created_by = Admin::find(Auth::guard('admin')->user()->id);
            $admin->admin()->associate($created_by);
            if ($admin->save()) {
                Mail::to($admin)->send(new Welcome($admin,$password));
                $admin_role = new AdminRole;
                $rol = Role::find($request->role);
                $admin_role->admin()->associate($admin);
                $admin_role->role()->associate($rol);
                $admin_role->save();
                return redirect()->route('show.admins')->with('success', 'Admin added successfully');
            } else {
                return redirect()->back()->with('error', 'Admin addition failed!!!');
            }
        }else{
            abort(404);
        }
    }
    public function showAdminDetails($id){
        $permission=$this->permission->getPermission();
        $admin=Admin::find($id);
        if($admin->type==0 && Auth::guard('admin')->user()->type!=0){
            abort(404);
        }else {
            if ((array_key_exists('admin', $permission)) ? (($permission['admin']['r'] == 1) ? 1 : 0) : 0) {
                return view('admins.showAdminDetails')->with(['admin' => $admin, 'permission' => $permission]);
            } else {
                abort(404);
            }
        }
    }
    public function editAdmin($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('admin',$permission))?(($permission['admin']['u']==1)?1:0):0) {
            $roles = [];
            $admins = Admin::where('company_id', Auth::guard('admin')->user()->company_id)->get();
            foreach ($admins as $admin) {
                foreach ($admin->created_roles as $created_role) {
                    $roles[][] = $created_role;
                }
            }
            $admin = Admin::find($id);
            return view('admins.editAdmin')->with(['admin' => $admin, 'roles' => $roles,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function updateAdmin(Request $request,$id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('admin',$permission))?(($permission['admin']['c']==1)?1:0):0) {
            $admin = Admin::find($id);
            $this->validate($request, [
                'email' => 'email|required|unique:admins,email,' . $id,
                'name' => 'required|min:3|max:64',
                'contact' => 'required|min:9|max:16',
                'profile_picture' => 'image',
                'position' => 'required|min:2|max:64',
                'gender' => 'required'
            ]);
            if ($request->hasFile('profile_picture')) {
                if($admin->profile_picture!='nopp.jpg'){
                    //delete old image
                    File::delete("uploads/admin/profile_picture/" . $admin->profile_picture);
                }
                //Get name of file with extension
                $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();
                //Get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //Upload image
                $path = $request->file('profile_picture')->move(public_path().'/uploads/admin/profile_picture', $fileNameToStore);
                $admin->profile_picture = $fileNameToStore;
            }
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->contact = $request->contact;
            $admin->position = $request->position;
            $admin->gender = $request->gender;
            if ($request->has('company_id')) {
                $admin->company()->associate(Company::find('company_id'));
            }
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $admin->updated_admin()->associate($updated_by);
            if ($admin->save()) {
                if ($request->has('role')) {
                    $admin_role = AdminRole::find($admin->admin_role->id);
                    $rol = Role::find($request->role);
                    $admin_role->admin()->associate($admin);
                    $admin_role->role()->associate($rol);
                    $admin_role->save();
                }
                if ($admin->status == 1) {
                    return redirect()->route('show.admins')->with('success', 'Admin updated successfully');
                } else {
                    return redirect()->route('show.admin.trash')->with('success', 'Admin updated successfully');
                }
            } else {
                return redirect()->route('show.admins')->with('error', 'Admin update failed!!!');
            }
        }else{
            abort(404);
        }
    }
    public function deleteAdmin($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('admin',$permission))?(($permission['admin']['d']==1)?1:0):0) {
            $admin = Admin::find($id);
            $deleted_by = Admin::find(Auth::guard('admin')->user()->id);
            $admin->deleted_admin()->associate($deleted_by);
            $admin->status = 0;
            $admin->save();
            return redirect()->back()->with('success', 'Admin Deleted Successfully');
        }else{
            abort(404);
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin');
    }
    public function changePassword(){
        $permission=$this->permission->getPermission();
        return view('admins.changePassword')->with('permission',$permission);
    }
    public function updatePassword(Request $request){
        $this->validate($request,[
            'old_password' => 'required|min:6|max:32',
            'password' => 'required|confirmed|min:6|max:32'
        ]);
        $admin=Auth::guard('admin')->user();
        if(Hash::check($request->input('old_password'), $admin->password)){
            $admin->password=bcrypt($request->input('password'));
            $admin->save();
        }
        else{
            return back()->with('error','Old password does not match');
        }
        return redirect()->route('show.admin.details',['id'=>$admin->id]);
    }
    public function forgetPassword(){
        return view('admins.forgetPassword');
    }
    public function forgetPasswordMail(Request $request){
        $admin=Admin::where('email',$request->input('email'))->first();
        if($admin){
            Mail::to($admin)->send(new ForgetPassword($admin));
            return redirect()->back()->with('success','The password reset link is sent to the email');
        }
        else{
            return redirect()->back()->withErrors('The Email is not associated with us.');
        }
    }
    public function resetForgetPassword($id){
        return view('admins.resetForgetPassword')->with('id',$id);
    }
    public function storeForgetPassword(Request $request,$id){
        $this->validate($request,[
            'password' => 'required|confirmed|min:6|max:32'
        ]);
        $admin=Admin::find($id);
        $admin->password=bcrypt($request->input('password'));
        $admin->save();
        return redirect()->route('admin')->with('success', 'The password Reset Successfully please proceed login');
    }
    public function removePp($id){
        $admin=Admin::find($id);
        if($admin->profile_picture!='nopp.jpg') {
            File::delete("uploads/admin/profile_picture/" . $admin->profile_picture);
        }
        $admin->profile_picture='nopp.jpg';
        $admin->save();
        return redirect()->back()->with('success','Profile Picture Removed Successfully');
    }
    public function uploadPp(Request $request,$id){
        $this->validate($request,[
            'profile_picture' => 'required|image'
        ],['profile_picture.required'=>'No file is selected']);
        $admin=Admin::find($id);
        if ($request->hasFile('profile_picture')) {
            if($admin->profile_picture!='nopp.jpg'){
                //delete old image
                File::delete("uploads/admin/profile_picture/" . $admin->profile_picture);
            }
            //Get name of file with extension
            $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();
            //Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            //Upload image
            $path = $request->file('profile_picture')->move(public_path().'/uploads/admin/profile_picture', $fileNameToStore);
            $admin->profile_picture = $fileNameToStore;
            if($admin->save()){
                return redirect()->back()->with('success','Profile Picture Updated Successfully');
            }
        }else{
            return redirect()->back()->with('error','No file is selected');
        }
    }
    public function storeSnap(Request $request,$id){
        $this->validate($request,[
            'image_URI' => 'required'
        ],['image_URI.required'=>'Image is not captured']);
        if ($request->has('image_URI')){
            $admin=Admin::find($id);
            if($admin->profile_picture!='nopp.jpg'){
                //delete old image
                File::delete("uploads/admin/profile_picture/" . $admin->profile_picture);
            }
            $uri = $request->input('image_URI');
            $date=date('YmdHis');
            $file_name=public_path()."/uploads/admin/profile_picture/snap" . $date . ".jpg";
            file_put_contents($file_name,file_get_contents($uri));
            $admin->profile_picture="snap" . $date . ".jpg";
            $admin->save();
            return redirect()->back()->with('success','Image Uploaded Successfully');
        }else{
            return redirect()->back()->with('error','Image is not captured');
        }
    }
}
