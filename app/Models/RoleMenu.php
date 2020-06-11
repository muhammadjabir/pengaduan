<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    protected $table = 'role_menu';
    protected $guarded = [''];

    protected $appends = ['child','parent'];
    protected $hidden = ['created_at','updated_at'];


    // protected $casts = [
    //     'parent' => 'array',
    //     'child' => 'array'
    // ];

    public function getParentAttribute()
    {
        return json_decode($this->parent_menu);
    }

    public function getChildAttribute()
    {
        return json_decode($this->child_menu);
    }
}
