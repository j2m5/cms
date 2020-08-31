<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'md',
        'mk',
        'is_public',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
