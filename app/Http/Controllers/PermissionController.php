<?php

namespace App\Http\Controllers;
use App\Crudable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function getPermission()
    {
        $permission = [];
        $allCrudable=Crudable::all();
        foreach ($allCrudable as $crudable){
            if (Auth::guard('admin')->user()->type != 0)
                foreach (Auth::guard('admin')->user()->admin_role->role->role_crudables as $role_crudable) {
                    if ($role_crudable->crudable->name == $crudable->name) {
                        if ($role_crudable->permission->c == 1) {
                            $permission[$crudable->name]['c'] = 1;
                        } else {
                            $permission[$crudable->name]['c'] = 0;
                        }
                        if ($role_crudable->permission->r == 1) {
                            $permission[$crudable->name]['r'] = 1;
                        } else {
                            $permission[$crudable->name]['r'] = 0;
                        }
                        if ($role_crudable->permission->u == 1) {
                            $permission[$crudable->name]['u'] = 1;
                        } else {
                            $permission[$crudable->name]['u'] = 0;
                        }
                        if ($role_crudable->permission->d == 1) {
                            $permission[$crudable->name]['d'] = 1;
                        } else {
                            $permission[$crudable->name]['d'] = 0;
                        }
                    }
                }
            else {
                $permission[$crudable->name]['c'] = 1;
                $permission[$crudable->name]['r'] = 1;
                $permission[$crudable->name]['u'] = 1;
                $permission[$crudable->name]['d'] = 1;
            }
        }
        return $permission;
    }
}
