<?php

namespace App\Providers;

use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\Event;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Ticket;
use App\Models\User;
use App\Policies\BlogCategoryPolicy;
use App\Policies\BlogCommentPolicy;
use App\Policies\BlogPostPolicy;
use App\Policies\EventPolicy;
use App\Policies\PagePolicy;
use App\Policies\SettingPolicy;
use App\Policies\TagPolicy;
use App\Policies\TicketPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        BlogPost::class => BlogPostPolicy::class,
        BlogCategory::class => BlogCategoryPolicy::class,
        BlogComment::class => BlogCommentPolicy::class,
        Tag::class => TagPolicy::class,
        User::class => UserPolicy::class,
        Setting::class => SettingPolicy::class,
        Event::class => EventPolicy::class,
        Ticket::class => TicketPolicy::class,
        Page::class => PagePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
    }
}
