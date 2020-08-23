<?php

namespace App\Observers;

use App\Models\BlogPost;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

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
    }

    /**
     * Handle the blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        $event = new Event();
        $event->create([
            'model' => 'BlogPost',
            'event_type' => 'created',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $blogPost->title,
                'add' => $blogPost->excerpt,
                'action' => 'опубликовал запись',
                'css' => 'fas fa-pencil-alt bg-success'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
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
    }

    /**
     * Handle the blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        $event = new Event();
        $event->create([
            'model' => 'BlogPost',
            'event_type' => 'updated',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $blogPost->title,
                'add' => $blogPost->excerpt,
                'action' => 'обновил запись',
                'css' => 'fas fa-pencil-alt bg-primary'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        $event = new Event();
        $event->create([
            'model' => 'BlogPost',
            'event_type' => 'trashed',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $blogPost->title,
                'add' => null,
                'action' => 'переместил запись в корзину',
                'css' => 'fas fa-pencil-alt bg-warning'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        $event = new Event();
        $event->create([
            'model' => 'BlogPost',
            'event_type' => 'restored',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $blogPost->title,
                'add' => null,
                'action' => 'восстановил запись',
                'css' => 'fas fa-pencil-alt bg-primary'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        $blogPost->tags()->detach();
        $event = new Event();
        $event->create([
            'model' => 'BlogPost',
            'event_type' => 'deleted',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $blogPost->title,
                'add' => null,
                'action' => 'удалил запись',
                'css' => 'fas fa-pencil-alt bg-danger'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }
}
