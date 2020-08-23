<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Page::class;
    }

    public function getBlogShow($slug)
    {
        $columns = ['id', 'title', 'slug', 'content', 'md', 'mk', 'created_at'];
        $page = $this->startQuery()
            ->select($columns)
            ->where('slug', $slug)
            ->where('is_public', 1)
            ->firstOrFail();
        return $page;
    }

    public function getAdminIndexFiltered($query)
    {
        $columns = ['id', 'user_id', 'title', 'slug', 'content', 'is_public', 'created_at', 'updated_at'];
        $pages = $this->startQuery()
            ->select($columns)
            ->where('is_public', 1)
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', '%'.$query.'%')
                    ->orWhere('content', 'LIKE', '%'.$query.'%');
            })
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('login', 'LIKE', '%'.$query.'%')
                    ->orWhere('name', 'LIKE', '%'.$query.'%');
            })
            ->latest()
            ->with('user:id,name,login')
            ->paginate(countOnPage());
        return $pages;
    }

    public function getAdminEdit($id)
    {
        $columns = ['id', 'user_id', 'title', 'slug', 'content', 'md', 'mk', 'is_public', 'created_at'];
        $page = $this->startQuery()
            ->select($columns)
            ->where('id', $id)
            ->first();
        return $page;
    }

    public function getTrashed()
    {
        $columns = ['id', 'user_id', 'title', 'created_at', 'deleted_at'];
        $posts = $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->latest()
            ->paginate(countOnPage());
        return $posts;
    }

    public function getTrashedItem($id)
    {
        $columns = ['id', 'user_id', 'title', 'created_at', 'deleted_at'];
        $post = $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->where('id', $id)
            ->first();
        return $post;
    }

    public function isExistsSlug($slug)
    {
        $data = $this->startQuery()
            ->select('id')
            ->where('slug', $slug)
            ->get();
        if (count($data) === 0) return false;
        return true;
    }

    public function getPageIdBySlug($slug)
    {
        return $this->startQuery()
            ->select(['id'])
            ->where('slug', $slug)
            ->first();
    }
}
