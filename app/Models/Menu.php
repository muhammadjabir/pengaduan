<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use SoftDeletes;
    protected $table = 'menu';
    public function child_menu(){
        return $this->hasMany('App\Models\ChildMenu','id_menu');
    }
}
