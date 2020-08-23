<?php

namespace App\Http\Controllers\Api\Admin;

class TrashController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $categories = $this->blogCategoryRepository->getTrashed();
        $posts = $this->blogPostRepository->getTrashed();
        $comments = $this->blogCommentRepository->getTrashed();
        $pages = $this->pageRepository->getTrashed();
        return response()->json([
            'categories' => $categories,
            'posts' => $posts,
            'comments' => $comments,
            'pages' => $pages
        ], 200);
    }

}
