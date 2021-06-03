<?php

namespace App\Http\Controllers;

use App\Mail\Welcome;
use App\Models\Admin;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SuperAdminController extends Controller
{
    public $permission;
    public function __construct()
    {
        $this->permission=new PermissionController();
    }
    public function registerSuperAdmin(){
        $permission=$this->permission->getPermission();
        if((array_key_exists('super_admin',$permission))?(($permission['super_admin']['c']==1)?1:0):0) {
            return view('admins.registerSuperAdmin')->with('permission',$permission);
        }else{
            abort(404);
        }
    }
    public function storeSuperAdmin(Request $request){
        $permission=$this->permission->getPermission();
        if((array_key_exists('super_admin',$permission))?(($permission['super_admin']['c']==1)?1:0):0) {
            $this->validate($request, [
                'email' => 'email|required|unique:admins,email',
//                'password' => 'required|confirmed|min:6|max:32',
                'name' => 'required|min:3|max:64',
                'contact' => 'required|min:9|max:16',
                'profile_picture' => 'image',
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
            $password=Str::random(10);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->contact = $request->contact;
            $admin->password = bcrypt($password);
            $admin->status = 1;
            $admin->gender = $request->gender;
            $admin->profile_picture = $fileNameToStore;
            $admin->type = 0;
            if ($admin->save()) {
                Mail::to($admin)->send(new Welcome($admin,$password));
                return redirect()->route('show.admins')->with('success', 'Super Admin added successfully');
            } else {
                return redirect()->route('show.admins')->with('error', 'Super Admin addition failed!!!');
            }
        }else{
            abort(404);
        }
    }
    public function editSuperAdmin($id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('super_admin',$permission))?(($permission['super_admin']['u']==1)?1:0):0) {
            $admin = Admin::find($id);
            return view('admins.editSuperAdmin')->with(['admin'=> $admin,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }
    public function updateSuperAdmin(Request $request,$id){
        $permission=$this->permission->getPermission();
        if((array_key_exists('super_admin',$permission))?(($permission['super_admin']['u']==1)?1:0):0) {
            $admin = Admin::find($id);
            $this->validate($request, [
                'email' => 'email|required|unique:admins,email,' . $id,
                'name' => 'required|min:3|max:64',
                'contact' => 'required|min:9|max:16',
                'profile_picture' => 'image',
                'gender' => 'required'
            ]);
            if ($request->hasFile('profile_picture')) {
                if($admin->profile_picture!='nopp.jpg') {
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
            $admin->gender = $request->gender;
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $admin->updated_admin()->associate($updated_by);
            if ($admin->save()) {
                if ($admin->status == 1) {
                    return redirect()->route('show.admins')->with('success', 'Super Admin updated successfully');
                } else {
                    return redirect()->route('show.admin.trash')->with('success', 'Super Admin updated successfully');
                }
            } else {
                return redirect()->route('show.admins')->with('error', 'Super Admin update failed!!!');
            }
        }
    }
}
