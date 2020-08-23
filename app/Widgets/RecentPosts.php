<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Repositories\BlogPostRepository;

class RecentPosts extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'count' => 10
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $class = app(BlogPostRepository::class);
        $posts = $class->getRecentPosts();
        return view('themes.'.currentTheme().'.widgets.recent_posts', [
            'config' => $this->config,
            'posts' => $posts
        ]);
    }
}
