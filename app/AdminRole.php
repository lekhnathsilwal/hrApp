<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    public function admin(){
        return $this->belongsTo('App\Models\Admin','admin_id','id');
    }
    public function role(){
        return $this->belongsTo('App\Role','role_id','id');
    }
}
