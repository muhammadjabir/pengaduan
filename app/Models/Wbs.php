<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wbs extends Model
{
    protected $table='wbs';
    protected $appends = ['file_pengaduan'];
    public function warga(){
        return $this->belongsTo('App\Models\Warga','id_warga');
    }
    public function getFilePengaduanAttribute()
    {
       return $this->attributes['file_pengaduan'] ? asset('storage/' .$this->attributes['file_pengaduan']) : '';
    }
    public function user(){
        return $this->belongsTo('App\User','id_admin');
    }
}
