<?php

namespace App;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function admin_roles(){
        return $this->hasMany(AdminRole::class,'role_id','id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }
    public function role_crudables(){
        return $this->hasMany('App\RoleCrudable','role_id','id');
    }
    public function updated_admin(){
        return $this->belongsTo(Admin::class,'updated_by','id');
    }
    public function deleted_admin(){
        return $this->belongsTo(Admin::class,'deleted_by','id');
    }
}
