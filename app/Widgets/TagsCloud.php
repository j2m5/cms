<?php

namespace App\Widgets;

use App\Repositories\TagRepository;
use Arrilot\Widgets\AbstractWidget;

class TagsCloud extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $class = app(TagRepository::class);
        $tags = $class->getWidget();
        return view('themes.'.currentTheme().'.widgets.tags_cloud', [
            'config' => $this->config,
            'tags' => $tags
        ]);
    }
}
