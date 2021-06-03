<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeHistory extends Model
{
    public function admin(){
        return $this->belongsTo('App\Models\Admin','created_by');
    }
    public function employee(){
        return $this->belongsTo('App\Models\Employee','employee_id');
    }
    public function department(){
        return $this->belongsTo('App\Models\Department','department_id');
    }
    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }
    public function supervisor(){
        return $this->belongsTo('App\Models\Admin','supervisor_id');
    }
    public function updated_admin(){
        return $this->belongsTo('App\Models\Admin','updated_by');
    }
    public function deleted_admin(){
        return $this->belongsTo('App\Models\Admin','deleted_by');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company','company_id','id');
    }
}
