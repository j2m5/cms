<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Repositories\BlogCategoryRepository;

class AllCategories extends AbstractWidget
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
        $class = app(BlogCategoryRepository::class);
        $categories = $class->getWidget();
        return view('themes.'.currentTheme().'.widgets.all_categories', [
            'config' => $this->config,
            'categories' => $categories
        ]);
    }
}
