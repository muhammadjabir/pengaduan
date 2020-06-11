<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table= 'pengaduan';

    protected $appends = ['file_pengaduan'];
    public function kategori(){
        return $this->belongsTo('App\Models\Kategori','id_kategori');
    }

    public function warga(){
        return $this->belongsTo('App\Models\Warga','id_warga');
    }
    public function user(){
        return $this->belongsTo('App\User','id_admin');
    }
    public function getFilePengaduanAttribute()
    {
       return $this->attributes['file_pengaduan'] ? asset('storage/' .$this->attributes['file_pengaduan']) : '';
    }


}
