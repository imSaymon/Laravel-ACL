<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['name', 'resource', 'is_menu'];

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }
}
