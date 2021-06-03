<?php

namespace App\Http\Controllers;

use App\Crudable;
use App\Models\Admin;
use App\Permission;
use App\Role;
use App\RoleCrudable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public $permission;
    public function __construct()
    {
        $this->permission=new PermissionController();
    }
    public function showRoles()
    {
        $permission=$this->permission->getPermission();
        if((array_key_exists('role',$permission))?(($permission['role']['r']==1)?1:0):0) {
            if (Auth::guard('admin')->user()->type == 0) {
                $admins = Admin::where(['type' => 0])->get();
                $roles = [];
                foreach ($admins as $admin) {
                    foreach ($admin->created_roles as $created_role) {
                        if ($created_role->status == 1) {
                            $roles[][] = $created_role;
                        }
                    }
                }
            } else {
                $admins = Admin::where(['company_id' => Auth::guard('admin')->user()->company_id])->get();
                $roles = [];
                foreach ($admins as $admin) {
                    foreach ($admin->created_roles as $created_role) {
                        if ($created_role->status == 1) {
                            $roles[][] = $created_role;
                        }
                    }
                }
            }
            return view('admins.showRoles')->with(['roles' => $roles, 'trash' => 0,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }

    public function addRole()
    {
        $permission=$this->permission->getPermission();
        if((array_key_exists('role',$permission))?(($permission['role']['c']==1)?1:0):0) {
            $crudables = Crudable::all();
            $admin = Admin::find(Auth::guard('admin')->user()->id);
            return view('admins.addRoles')->with(['admin' => $admin, 'crudables' => $crudables,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }

    public function storeRole(Request $request)
    {
        $permission=$this->permission->getPermission();
        if((array_key_exists('role',$permission))?(($permission['role']['c']==1)?1:0):0) {
            $this->validate($request, [
                'name' => 'required|min:2|max:16',
                'permission' => 'required'
            ]);
            if (Auth::guard('admin')->user()->type == 0) {
                $admins = Admin::where('type', 0)->get();
                foreach ($admins as $admin) {
                    foreach ($admin->created_roles as $created_role) {
                        if ($created_role->name == $request->name) {
                            return redirect()->back()->with('error', 'The role ' . $request->name . ' already exist');
                        }
                    }
                }
            } else {
                $admins = Admin::where('company_id', Auth::guard('admin')->user()->company_id)->get();
                foreach ($admins as $admin) {
                    foreach ($admin->created_roles as $created_role) {
                        if ($created_role->name == $request->name) {
                            return redirect()->back()->with('error', 'The role ' . $request->name . ' already exist');
                        }
                    }
                }
            }
            $role = new Role;
            $role->name = $request->input('name');
            $created_by = Admin::find(Auth::guard('admin')->user()->id);
            $role->admin()->associate($created_by);
            $role->status = 1;
            $role->save();
            foreach ($request->permission as $prmsn => $value) {
                $role_crudable = new RoleCrudable;
                $role_crudable->role()->associate(Role::find($role->id));
                $role_crudable->crudable()->associate(Crudable::find($prmsn));
                $role_crudable->save();
                $permission = new Permission;
                $permission->role_crudable()->associate(RoleCrudable::find($role_crudable->id));
                foreach ($value as $key => $val) {
                    if ($key == "c") {
                        $permission->c = 1;
                    }
                    if ($key == "r") {
                        $permission->r = 1;
                    }
                    if ($key == "u") {
                        $permission->u = 1;
                    }
                    if ($key == "d") {
                        $permission->d = 1;
                    }
                }
                $permission->save();
            }
            return redirect()->route('show.roles');
        }else{
            abort(404);
        }
    }

    public function editRole($id)
    {
        $permission=$this->permission->getPermission();
        if((array_key_exists('role',$permission))?(($permission['role']['u']==1)?1:0):0) {
            $crudables = Crudable::all();
            $admin = Admin::find(Auth::guard('admin')->user()->id);
            $role = Role::find($id);
            $role_permissions = [];
            foreach ($role->role_crudables as $role_crudable) {
                $role_permissions[$role_crudable->crudable->id] = $role_crudable->permission;
            }
            return view('admins.editRole')->with(['role' => $role, 'admin' => $admin, 'role_permissions' => $role_permissions, 'crudables' => $crudables,'permission'=>$permission]);
        }else{
            abort(404);
        }
    }

    public function updateRole(Request $request, $id)
    {
        $permission=$this->permission->getPermission();
        if((array_key_exists('role',$permission))?(($permission['role']['u']==1)?1:0):0) {
            $this->validate($request, [
                'name' => 'required|min:2|max:16',
                'permission' => 'required'
            ]);
            if (Auth::guard('admin')->user()->type == 0) {
                $admins = Admin::where('type', 0)->get();
                foreach ($admins as $admin) {
                    foreach ($admin->created_roles as $created_role) {
                        if ($created_role->name == $request->name && $created_role->id != $id) {
                            return redirect()->back()->with('error', 'The role ' . $request->name . ' already exist');
                        }
                    }
                }
            } else {
                $admins = Admin::where('company_id', Auth::guard('admin')->user()->company_id)->get();
                foreach ($admins as $admin) {
                    foreach ($admin->created_roles as $created_role) {
                        if ($created_role->name == $request->name && $created_role->id != $id) {
                            return redirect()->back()->with('error', 'The role ' . $request->name . ' already exist');
                        }
                    }
                }
            }
            $role = Role::find($id);
            $role->name = $request->input('name');
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $role->updated_admin()->associate($updated_by);
            $role->save();
            $role->role_crudables()->delete();
            foreach ($request->permission as $prmsn => $value) {
                $role_crudable = new RoleCrudable;
                $role_crudable->role()->associate(Role::find($role->id));
                $role_crudable->crudable()->associate(Crudable::find($prmsn));
                $role_crudable->save();
                $permission = new Permission;
                $permission->role_crudable()->associate(RoleCrudable::find($role_crudable->id));
                foreach ($value as $key => $val) {
                    if ($key == "c") {
                        $permission->c = 1;
                    }
                    if ($key == "r") {
                        $permission->r = 1;
                    }
                    if ($key == "u") {
                        $permission->u = 1;
                    }
                    if ($key == "d") {
                        $permission->d = 1;
                    }
                }
                $permission->save();
            }
            if ($role->status == 1) {
                return redirect()->route('show.roles')->with('success', 'role updated successfully');
            } else {
                return redirect()->route('show.role.trash')->with('success', 'role updated successfully');
            }
        }else{
            abort(404);
        }
    }
    public function deleteRole($id)
    {
        $permission=$this->permission->getPermission();
        if((array_key_exists('role',$permission))?(($permission['role']['d']==1)?1:0):0) {
            $role = Role::find($id);
            $role->status = 0;
            $updated_by = Admin::find(Auth::guard('admin')->user()->id);
            $role->deleted_admin()->associate($updated_by);
            $role->save();
            return redirect()->back()->with('success', 'Role Deleted Successfully');
        }else{
            abort(404);
        }

    }
}
