<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * Handle the blog post "creating" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost)
    {
        if (empty($blogPost->slug)) {
            if (isExistsPostSlug(Str::slug($blogPost->title)) && $blogPost->isDirty('slug')) $blogPost->slug = Str::slug($blogPost->title.'-'.Str::random(3));
            else $blogPost->slug = Str::slug($blogPost->title);
        }
        else {
            if (isExistsPostSlug($blogPost->slug)) $blogPost->slug = $blogPost->slug.'-'.Str::random(3);
        }

        if (empty($blogPost->getAttribute('created_at'))) {
            $blogPost->setAttribute('created_at', now());
        } else {
            $blogPost->setAttribute('created_at', $blogPost->getAttribute('created_at'));
        }
    }

    /**
     * Handle the blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "updating" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost)
    {
        if (empty($blogPost->slug)) {
            if (isExistsPostSlug(Str::slug($blogPost->title))) $blogPost->slug = Str::slug($blogPost->title.'-'.Str::random(3));
            else $blogPost->slug = Str::slug($blogPost->title);
        }
        else {
            if (isExistsPostSlug($blogPost->slug) && $blogPost->isDirty('slug')) $blogPost->slug = $blogPost->slug.'-'.Str::random(3);
        }

        if (empty($blogPost->getAttribute('created_at'))) {
            $blogPost->setAttribute('created_at', now());
        } else {
            if ($blogPost->isDirty('created_at')) {
                $blogPost->setAttribute('created_at', $blogPost->getAttribute('created_at'));
            }
        }
    }

    /**
     * Handle the blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
