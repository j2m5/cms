<?php

namespace App\Observers;

use App\Models\BlogCategory;
use App\Models\Event;
use Illuminate\Support\Carbon;
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
     * @param Event $event
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        $event = new Event();
        $event->create([
            'model' => 'BlogCategory',
            'event_type' => 'created',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $blogCategory->title,
                'add' => $blogCategory->description ?? null,
                'action' => 'создал раздел',
                'css' => 'fas fa-folder-open bg-success'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
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
        $event = new Event();
        $event->create([
            'model' => 'BlogCategory',
            'event_type' => 'updated',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $blogCategory->title,
                'add' => $blogCategory->description ?? null,
                'action' => 'обновил раздел',
                'css' => 'fas fa-folder-open bg-primary'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the blog category "deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        $event = new Event();
        $event->create([
            'model' => 'BlogCategory',
            'event_type' => 'trashed',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $blogCategory->title,
                'add' => null,
                'action' => 'переместил в корзину раздел',
                'css' => 'fas fa-folder-open bg-warning'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the blog category "restored" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        $event = new Event();
        $event->create([
            'model' => 'BlogCategory',
            'event_type' => 'restored',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $blogCategory->title,
                'add' => null,
                'action' => 'восстановил раздел',
                'css' => 'fas fa-folder-open bg-primary'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the blog category "force deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        $event = new Event();
        $event->create([
            'model' => 'BlogCategory',
            'event_type' => 'deleted',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $blogCategory->title,
                'add' => null,
                'action' => 'удалил раздел',
                'css' => 'fas fa-folder-open bg-danger'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }
}
