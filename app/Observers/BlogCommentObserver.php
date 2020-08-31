<?php

namespace App\Observers;

use App\Models\BlogComment;
use App\Models\Event;
use Illuminate\Support\Carbon;

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
        $event = new Event();
        $event->create([
            'model' => 'BlogComment',
            'event_type' => 'created',
            'data' => [
                'user' => auth()->user()->login,
                'target' => '#'.$blogComment->id.' комментарий',
                'add' => $blogComment->content,
                'action' => 'написал комментарий',
                'css' => 'fas fa-comments bg-success'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
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
        $event = new Event();
        $event->create([
            'model' => 'BlogComment',
            'event_type' => 'updated',
            'data' => [
                'user' => auth()->user()->login,
                'target' => '#'.$blogComment->id.' комментарий',
                'add' => $blogComment->content,
                'action' => 'обновил комментарий',
                'css' => 'fas fa-comments bg-primary'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the blog comment "deleted" event.
     *
     * @param  \App\Models\BlogComment  $blogComment
     * @return void
     */
    public function deleted(BlogComment $blogComment)
    {
        $event = new Event();
        $event->create([
            'model' => 'BlogComment',
            'event_type' => 'trashed',
            'data' => [
                'user' => auth()->user()->login,
                'target' => '#'.$blogComment->id.' комментарий',
                'add' => null,
                'action' => 'переместил в корзину комментарий',
                'css' => 'fas fa-comments bg-warning'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the blog comment "restored" event.
     *
     * @param  \App\Models\BlogComment  $blogComment
     * @return void
     */
    public function restored(BlogComment $blogComment)
    {
        $event = new Event();
        $event->create([
            'model' => 'BlogComment',
            'event_type' => 'restored',
            'data' => [
                'user' => auth()->user()->login,
                'target' => '#'.$blogComment->id.' комментарий',
                'add' => null,
                'action' => 'восстановил комментарий',
                'css' => 'fas fa-comments bg-primary'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the blog comment "force deleted" event.
     *
     * @param  \App\Models\BlogComment  $blogComment
     * @return void
     */
    public function forceDeleted(BlogComment $blogComment)
    {
        $event = new Event();
        $event->create([
            'model' => 'BlogComment',
            'event_type' => 'deleted',
            'data' => [
                'user' => auth()->user()->login,
                'target' => '#'.$blogComment->id.' комментарий',
                'add' => null,
                'action' => 'удалил комментарий',
                'css' => 'fas fa-comments bg-danger'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }
}
