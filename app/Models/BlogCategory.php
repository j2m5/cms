<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes, SoftCascadeTrait;

    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'description',
        'md',
        'mk'
    ];

    protected $softCascade = ['posts'];
    protected $dates = ['deleted_at'];

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'category_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }
}
