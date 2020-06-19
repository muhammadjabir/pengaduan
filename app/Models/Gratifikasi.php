<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gratifikasi extends Model
{
    protected $table= 'gratifikasi';
    public function warga(){
        return $this->belongsTo('App\Models\Warga','id_warga');
    }

    public function barang(){
        return $this->hasMany('App\Models\Barang','id_gratifikasi');
    }
}
