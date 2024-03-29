<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name'];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class)->orderBy('position');
    }
}
