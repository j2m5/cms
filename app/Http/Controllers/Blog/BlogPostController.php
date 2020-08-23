<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

class BlogPostController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $posts = $this->blogPostRepository->getBlogIndex();
        return view('themes.'.currentTheme().'.posts.index', compact('posts'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($slug)
    {
        $post = $this->blogPostRepository->getBlogShow($slug);
        $similar = $this->blogPostRepository->getSimilarPosts($post->id, $post->category_id, $post->title, $post->excerpt, 6);
        $comments = $post->comments->groupBy('parent_id');
        return view('themes.'.currentTheme().'.posts.show', compact('post', 'comments', 'similar'));
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
