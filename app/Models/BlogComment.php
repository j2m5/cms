<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogComment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'post_id',
        'parent_id',
        'user_id',
        'author',
        'content',
        'updated_by'
    ];

    public function post()
    {
        return $this->belongsTo(BlogPost::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
