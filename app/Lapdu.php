<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lapdu extends Model
{
    protected $table= 'pengaduan_lapdu';
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
