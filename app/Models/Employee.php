<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function admin(){
        return $this->belongsTo('App\Models\Admin','created_by');
    }
    public function employee_histories(){
        return $this->hasMany('App\EmployeeHistory','employee_id');
    }
    public function updated_admin(){
        return $this->belongsTo('App\Models\Admin','updated_by');
    }
    public function deleted_admin(){
        return $this->belongsTo('App\Models\Admin','deleted_by');
    }
}
