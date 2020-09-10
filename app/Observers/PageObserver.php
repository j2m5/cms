<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\Page;
use Illuminate\Support\Carbon;
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

        $page->setAttribute('user_id', auth()->id());
    }

    /**
     * Handle the page "created" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function created(Page $page)
    {
        $event = new Event();
        $event->create([
            'model' => 'Page',
            'event_type' => 'created',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $page->title,
                'add' => $page->content,
                'action' => 'опубликовал страницу',
                'css' => 'fas fa-copy bg-success'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
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
        $event = new Event();
        $event->create([
            'model' => 'Page',
            'event_type' => 'updated',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $page->title,
                'add' => $page->content,
                'action' => 'обновил страницу',
                'css' => 'fas fa-copy bg-primary'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the page "deleted" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function deleted(Page $page)
    {
        $event = new Event();
        $event->create([
            'model' => 'Page',
            'event_type' => 'trashed',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $page->title,
                'add' => null,
                'action' => 'переместил страницу в корзину',
                'css' => 'fas fa-copy bg-warning'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the page "restored" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function restored(Page $page)
    {
        $event = new Event();
        $event->create([
            'model' => 'Page',
            'event_type' => 'restored',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $page->title,
                'add' => null,
                'action' => 'восстановил страницу',
                'css' => 'fas fa-copy bg-primary'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }

    /**
     * Handle the page "force deleted" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function forceDeleted(Page $page)
    {
        $event = new Event();
        $event->create([
            'model' => 'Page',
            'event_type' => 'deleted',
            'data' => [
                'user' => auth()->user()->login,
                'target' => $page->title,
                'add' => null,
                'action' => 'удалил страницу',
                'css' => 'fas fa-copy bg-danger'
            ],
            'range' => getRange(Carbon::now())
        ])->toJson();
    }
}
