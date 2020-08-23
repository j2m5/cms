<?php

namespace App\Http\Controllers\Api\Admin;


class DashboardController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $categories = $this->blogCategoryRepository->getCount();
        $posts = $this->blogPostRepository->getCount();
        $tags = $this->tagRepository->getCount();
        $users = $this->userRepository->getCount();
        $comments = $this->blogCommentRepository->getCount();
        return response()->json(['categories' => $categories, 'posts' => $posts, 'tags' => $tags, 'users' => $users, 'comments' => $comments], 200);
    }
}
