<?php

use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCommentRepository;
use App\Repositories\PageRepository;
use App\Repositories\UserRepository;
use App\Repositories\MenuItemRepository;
use Illuminate\Support\Carbon;

if (!function_exists('isCategoryDeleted')) {
    function isCategoryDeleted($id)
    {
        $category = app(BlogCategoryRepository::class);
        $result = $category->getDeletedAt($id);
        if (!empty($result->deleted_at)) return true;
        else return false;
    }
}

if (!function_exists('isCommentDeleted')) {
    function isCommentDeleted($id)
    {
        $comment = app(BlogCommentRepository::class);
        $result = $comment->getDeletedAt($id);
        if (!empty($result->deleted_at)) return true;
        else return false;
    }
}

if (!function_exists('getParentCategory')) {
    function getParentCategory($id)
    {
        $category = app(BlogCategoryRepository::class);
        if ($id) {
            $result = $category->getParentCategory($id);
            return $result->title;
        }
        return null;
    }
}

if (!function_exists('isExistsCategorySlug')) {
    function isExistsCategorySlug($slug)
    {
        $category = app(BlogCategoryRepository::class);
        return $category->isExistsSlug($slug);
    }
}

if (!function_exists('isExistsPostSlug')) {
    function isExistsPostSlug($slug)
    {
        $post = app(BlogPostRepository::class);
        return $post->isExistsSlug($slug);
    }
}

if (!function_exists('isExistsPageSlug')) {
    function isExistsPageSlug($slug)
    {
        $post = app(PageRepository::class);
        return $post->isExistsSlug($slug);
    }
}

if (!function_exists('numberOf')) {
    function numberOf($number, $suffix)
    {
        $keys = [2, 0, 1, 1, 1, 2];
        $mod = $number % 100;
        $suffix_key = ($mod > 7 && $mod < 20) ? 2: $keys[min($mod % 10, 5)];
        return $suffix[$suffix_key];
    }
}

if (!function_exists('jsonEncode')) {
    function jsonEncode($arr)
    {
        return json_encode($arr, JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('getDay')) {
    function getDay($timestamp)
    {
        if ($timestamp) {
            $date = Carbon::parse($timestamp);
            return $date->day;
        }
        return null;
    }
}

if (!function_exists('getRange')) {
    function getRange($timestamp)
    {
        if ($timestamp) {
            $range = Carbon::parse($timestamp);
            return $range->toDateString();
        }
        return null;
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($bytes)
    {
        if ($bytes == 0) return '0.00 Б';
        $s = [' Б', ' КБ', ' МБ', ' ГБ'];
        $e = floor(log($bytes, 1024));
        return round($bytes / pow(1024, $e), 2).$s[$e];
    }
}

if (!function_exists('ticketStatuses')) {
    function ticketStatuses($status)
    {
        if ($status === 'processing') return 'Обрабатывается';
        if ($status === 'opened') return 'Открыт';
        if ($status === 'closed') return 'Закрыт';
        return '';
    }
}

if (!function_exists('ticketMessageIsRead')) {
    function ticketMessageIsRead($read)
    {
        if (!$read) return 'Не прочитано';
        else return 'Прочитано';
    }
}

if (!function_exists('getUserLoginByEmail')) {
    function getUserLoginByEmail($email)
    {
        $user = app(UserRepository::class);
        return $user->getUserByEmail($email)->login;
    }
}

if (!function_exists('getPostIdBySlug')) {
    function getPostIdBySlug($slug)
    {
        $post = app(BlogPostRepository::class);
        return $post->getPostIdBySlug($slug);
    }
}

if (!function_exists('getPageIdBySlug')) {
    function getPageIdBySlug($slug)
    {
        $post = app(PageRepository::class);
        return $post->getPageIdBySlug($slug);
    }
}

if (!function_exists('renderMenu')) {
    function renderMenu($id, $template = 'main')
    {
        $view = 'themes.'.currentTheme().'.menu.'.$template;
        $items = app(MenuItemRepository::class);
        $items = $items->renderMenu($id);
        return view($view, compact('items'))->render();
    }
}
