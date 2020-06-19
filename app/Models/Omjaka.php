<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Omjaka extends Model
{
    protected $table='omjaka';
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
