<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function department(){
        return $this->belongsTo('App\Models\Department','department_id');
    }
    public function employee_histories(){
        return $this->hasMany('App\EmployeeHistory','section_id');
    }
    public function created_admin(){
        return $this->belongsTo('App\Models\Admin','created_by');
    }
    public function updated_admin(){
        return $this->belongsTo('App\Models\Admin','updated_by');
    }
    public function deleted_admin(){
        return $this->belongsTo('App\Models\Admin','deleted_by');
    }
}
