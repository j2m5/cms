<?php

namespace App\Providers;

use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Tag;
use App\Models\User;
use App\Observers\BlogCategoryObserver;
use App\Observers\BlogCommentObserver;
use App\Observers\BlogPostObserver;
use App\Observers\PageObserver;
use App\Observers\TagObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BlogPost::observe(BlogPostObserver::class);
        BlogCategory::observe(BlogCategoryObserver::class);
        BlogComment::observe(BlogCommentObserver::class);
        User::observe(UserObserver::class);
        Tag::observe(TagObserver::class);
        Page::observe(PageObserver::class);
    }
}
