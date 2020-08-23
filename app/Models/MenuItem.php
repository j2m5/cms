<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_id',
        'parent_id',
        'type_id',
        'position',
        'label',
        'url',
        'attributes',
        'external'
    ];

    protected $casts = ['attributes' => 'json'];

    protected $appends = ['name', 'slug', 'items'];

    public function getNameAttribute()
    {
        return $this->menuItemType()->first()->name;
    }

    public function getSlugAttribute()
    {
        return $this->menuItemType()->first()->slug;
    }

    public function getItemsAttribute()
    {
        return $this->where('parent_id', $this->id)->get();
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    public function menuItemType()
    {
        return $this->belongsTo(MenuItemType::class, 'type_id');
    }
}
