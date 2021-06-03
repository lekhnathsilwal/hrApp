<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function admins(){
        return $this->hasMany('App\Models\Admin','company_id','id');
    }
    public function employee_histories(){
        return $this->hasMany('App\EmployeeHistory','company_id','id');
    }
}
