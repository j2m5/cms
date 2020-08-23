<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

class BlogCategoryController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $category = $this->blogCategoryRepository->getBlogShow($id);
        $posts = $this->blogPostRepository->getByCategoryId($id);
        return view('themes.'.currentTheme().'.categories.show', compact('posts', 'category'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
