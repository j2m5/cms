<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Str;

class PageObserver
{

    /**
     * Handle the page "creating" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function creating(Page $page)
    {
        if (empty($page->slug)) {
            if (isExistsPostSlug(Str::slug($page->title)) && $page->isDirty('slug')) $page->slug = Str::slug($page->title.'-'.Str::random(3));
            else $page->slug = Str::slug($page->title);
        } else {
            if (isExistsPostSlug($page->slug)) $page->slug = $page->slug.'-'.Str::random(3);
        }

        if (empty($page->getAttribute('created_at'))) {
            $page->setAttribute('created_at', now());
        } else {
            $page->setAttribute('created_at', $page->getAttribute('created_at'));
        }

    }

    /**
     * Handle the page "created" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function created(Page $page)
    {
        //
    }

    /**
     * Handle the page "updating" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function updating(Page $page)
    {
        if (empty($page->slug)) {
            if (isExistsPostSlug(Str::slug($page->title))) $page->slug = Str::slug($page->title.'-'.Str::random(3));
            else $page->slug = Str::slug($page->title);
        } else {
            if (isExistsPostSlug($page->slug) && $page->isDirty('slug')) $page->slug = $page->slug.'-'.Str::random(3);
        }

        if (empty($page->getAttribute('created_at'))) {
            $page->setAttribute('created_at', now());
        } else {
            if ($page->isDirty('created_at')) {
                $page->setAttribute('created_at', $page->getAttribute('created_at'));
            }
        }
    }

    /**
     * Handle the page "updated" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function updated(Page $page)
    {
        //
    }

    /**
     * Handle the page "deleted" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function deleted(Page $page)
    {
        //
    }

    /**
     * Handle the page "restored" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function restored(Page $page)
    {
        //
    }

    /**
     * Handle the page "force deleted" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function forceDeleted(Page $page)
    {
        //
    }
}
