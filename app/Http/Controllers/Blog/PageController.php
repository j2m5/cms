<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function show($slug)
    {
        $page = $this->pageRepository->getBlogShow($slug);
        return view('themes.'.currentTheme().'.pages.show', compact('page'));
    }
}
