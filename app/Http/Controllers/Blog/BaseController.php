<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCommentRepository;
use App\Repositories\PageRepository;
use App\Repositories\TagRepository;
use App\Repositories\TicketCategoryRepository;
use App\Repositories\TicketMessageRepository;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;

abstract class BaseController extends Controller
{

    protected $blogCategoryRepository;
    protected $blogPostRepository;
    protected $blogCommentRepository;
    protected $tagRepository;
    protected $userRepository;
    protected $ticketCategoryRepository;
    protected $ticketRepository;
    protected $ticketMessageRepository;
    protected $pageRepository;

    protected function __construct() {
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCommentRepository = app(BlogCommentRepository::class);
        $this->tagRepository = app(TagRepository::class);
        $this->userRepository = app(UserRepository::class);
        $this->ticketCategoryRepository = app(TicketCategoryRepository::class);
        $this->ticketRepository = app(TicketRepository::class);
        $this->ticketMessageRepository = app(TicketMessageRepository::class);
        $this->pageRepository = app(PageRepository::class);
    }

}
