<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function role_crudable(){
        return $this->belongsTo('App\RoleCrudable','role_crudable_id');
    }
}
