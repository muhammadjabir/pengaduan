<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Masterdata extends Model
{
    use SoftDeletes;

    protected $table = 'master_data';
    protected $fillable = ['description'];

    public function detail(){
        return $this->hasMany('App\Models\MasterDataDetail','id_master_data');
    }
}
