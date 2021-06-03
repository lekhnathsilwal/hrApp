<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function created_admin(){
        return $this->belongsTo('App\Models\Admin','created_by');
    }
    public function updated_admin(){
        return $this->belongsTo('App\Models\Admin','updated_by');
    }
    public function deleted_admin(){
        return $this->belongsTo('App\Models\Admin','deleted_by');
    }
    public function sections(){
        return $this->hasMany('App\Models\Section','department_id');
    }
    public function employee_histories(){
        return $this->hasMany('App\EmployeeHistory','department_id');
    }
}
