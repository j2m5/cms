<?php

namespace App\Observers;

use App\Models\Tag;
use Illuminate\Support\Str;

class TagObserver
{
    /**
     * Handle the tag "creating" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function creating(Tag $tag)
    {
        (empty($tag->slug)) ? $tag->slug = Str::slug($tag->name) : $tag->slug;
    }

    /**
     * Handle the tag "created" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function created(Tag $tag)
    {
        //
    }

    /**
     * Handle the tag "updating" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function updating(Tag $tag)
    {
        (empty($tag->slug)) ? $tag->slug = Str::slug($tag->name) : $tag->slug;
    }

    /**
     * Handle the tag "updated" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function updated(Tag $tag)
    {
        //
    }

    /**
     * Handle the tag "deleted" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function deleted(Tag $tag)
    {
        //
    }

    /**
     * Handle the tag "restored" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function restored(Tag $tag)
    {
        //
    }

    /**
     * Handle the tag "force deleted" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function forceDeleted(Tag $tag)
    {
        $tag->posts()->detach();
    }
}
