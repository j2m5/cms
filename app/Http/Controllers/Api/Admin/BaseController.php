<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogCommentRepository;
use App\Repositories\BlogPostRepository;
use App\Repositories\MenuItemRepository;
use App\Repositories\MenuItemTypeRepository;
use App\Repositories\MenuRepository;
use App\Repositories\PageRepository;
use App\Repositories\RoleRepository;
use App\Repositories\SettingRepository;
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
    protected $roleRepository;
    protected $userRepository;
    protected $tagRepository;
    protected $settingRepository;
    protected $ticketCategoryRepository;
    protected $ticketRepository;
    protected $ticketMessageRepository;
    protected $pageRepository;
    protected $menuRepository;
    protected $menuItemRepository;
    protected $menuItemTypeRepository;

    protected function __construct()
    {
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCommentRepository = app(BlogCommentRepository::class);
        $this->roleRepository = app(RoleRepository::class);
        $this->userRepository = app(UserRepository::class);
        $this->tagRepository = app(TagRepository::class);
        $this->settingRepository = app(SettingRepository::class);
        $this->ticketCategoryRepository = app(TicketCategoryRepository::class);
        $this->ticketRepository = app(TicketRepository::class);
        $this->ticketMessageRepository = app(TicketMessageRepository::class);
        $this->pageRepository = app(PageRepository::class);
        $this->menuRepository = app(MenuRepository::class);
        $this->menuItemRepository = app(MenuItemRepository::class);
        $this->menuItemTypeRepository = app(MenuItemTypeRepository::class);
    }

}
