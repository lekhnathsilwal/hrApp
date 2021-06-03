<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleCrudable extends Model
{
    public function role(){
        return $this->belongsTo('App\Role','role_id');
    }
    public function crudable(){
        return $this->belongsTo('App\Crudable','crudable_id');
    }
    public function permission(){
        return $this->hasOne('App\Permission','role_crudable_id');
    }
}
