<?php

namespace App\Http\Controllers\Blog;

use App\Models\Tag;
use Illuminate\Http\Request;

class BlogSearchController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
        $posts = $this->blogPostRepository->search($query);
        return view('themes.'.currentTheme().'.posts.search', compact('posts', 'query'));
    }

    public function show(Tag $tag)
    {
        $posts = $tag->posts()->with('tags:tag_id,name,slug')->paginate(10);
        return view('themes.'.currentTheme().'.posts.tag', compact('posts'));
    }

}
