<?php

namespace App\Observers;

use App\Models\BlogComment;

class BlogCommentObserver
{
    /**
     * Handle the blog comment "created" event.
     *
     * @param  \App\Models\BlogComment  $blogComment
     * @return void
     */
    public function created(BlogComment $blogComment)
    {
        //
    }

    /**
     * Handle the blog comment "updating" event.
     *
     * @param  \App\Models\BlogComment  $blogComment
     * @return void
     */
    public function updating(BlogComment $blogComment)
    {
        $blogComment->setAttribute('updated_by', auth()->user()->login);
    }

    /**
     * Handle the blog comment "updated" event.
     *
     * @param  \App\Models\BlogComment  $blogComment
     * @return void
     */
    public function updated(BlogComment $blogComment)
    {
        //
    }

    /**
     * Handle the blog comment "deleted" event.
     *
     * @param  \App\Models\BlogComment  $blogComment
     * @return void
     */
    public function deleted(BlogComment $blogComment)
    {
        //
    }

    /**
     * Handle the blog comment "restored" event.
     *
     * @param  \App\Models\BlogComment  $blogComment
     * @return void
     */
    public function restored(BlogComment $blogComment)
    {
        //
    }

    /**
     * Handle the blog comment "force deleted" event.
     *
     * @param  \App\Models\BlogComment  $blogComment
     * @return void
     */
    public function forceDeleted(BlogComment $blogComment)
    {
        //
    }
}
