<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryObserver
{
    /**
     * Handle the blog category "creating" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function creating(BlogCategory $blogCategory)
    {
        if (empty($blogCategory->slug)) {
            if (isExistsCategorySlug(Str::slug($blogCategory->title))) $blogCategory->slug = Str::slug($blogCategory->title.'-'.Str::random(3));
            else $blogCategory->slug = Str::slug($blogCategory->title);
        }
        else {
            if (isExistsCategorySlug($blogCategory->slug) && $blogCategory->isDirty('slug')) $blogCategory->slug = $blogCategory->slug.'-'.Str::random(3);
        }
    }

    /**
     * Handle the blog category "created" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "updating" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function updating(BlogCategory $blogCategory)
    {
        if (empty($blogCategory->slug)) {
            if (isExistsCategorySlug(Str::slug($blogCategory->title))) $blogCategory->slug = Str::slug($blogCategory->title.'-'.Str::random(3));
            else $blogCategory->slug = Str::slug($blogCategory->title);
        }
        else {
            if (isExistsCategorySlug($blogCategory->slug) && $blogCategory->isDirty('slug')) $blogCategory->slug = $blogCategory->slug.'-'.Str::random(3);
        }
    }

    /**
     * Handle the blog category "updated" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function updated(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "restored" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "force deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }
}
