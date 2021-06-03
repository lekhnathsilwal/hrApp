<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
class Admin extends User
{
    protected $hidden=['remember_token','password'];
    public function admin(){
        return $this->belongsTo('App\Models\Admin','created_by');
    }
    public function admins(){
        return $this->hasMany('App\Models\Admin');
    }
    public function updated_admin(){
        return $this->belongsTo('App\Models\Admin','updated_by');
    }
    public function deleted_admin(){
        return $this->belongsTo('App\Models\Admin','deleted_by');
    }
    public function created_roles(){
        return $this->hasMany('App\Role','created_by','id');
    }
    public function created_departments(){
        return $this->hasMany('App\Models\Department','created_by','id');
    }
    public function admin_role(){
        return $this->hasOne('App\AdminRole','admin_id');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company','company_id');
    }
}
