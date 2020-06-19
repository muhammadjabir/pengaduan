<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table='barang';
    protected $appends = ['file_barang'];

    public function getFileBarangAttribute()
    {
       return $this->attributes['file_barang'] ? asset('storage/' .$this->attributes['file_barang']) : '';
    }

}
