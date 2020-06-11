<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MasterDataDetail extends Model
{
    use SoftDeletes;


    protected $table = 'master_data_detail';
    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function role_menu(){
        return $this->hasOne('App\Models\RoleMenu','id_role');
    }
}
