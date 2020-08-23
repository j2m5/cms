<?php


namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Tag::class;
    }

    public function getAdminIndex()
    {
        $columns = ['id', 'name', 'slug', 'created_at', 'updated_at'];
        $tags = $this->startQuery()
            ->select($columns)
            ->latest()
            ->with('posts:post_id')
            ->paginate(countOnPage());
        return $tags;
    }

    public function getAdminIndexFiltered($query)
    {
        $columns = ['id', 'name', 'slug', 'created_at', 'updated_at'];
        $tags = $this->startQuery()
            ->select($columns)
            ->where('name', 'LIKE', '%'.$query.'%')
            ->latest()
            ->with('posts:post_id')
            ->paginate(countOnPage());
        return $tags;
    }

    public function getWidget()
    {
        $columns = ['id', 'name', 'slug'];
        $tags = $this->startQuery()
            ->select($columns)
            ->take(50)
            ->get();
        return $tags;
    }

    public function getAdminEdit($id)
    {
        $columns = ['id', 'name', 'slug'];
        $tag = $this->startQuery()
            ->select($columns)
            ->where('id', $id)
            ->first();
        return $tag;
    }

    public function getTags()
    {
        $columns = ['id', 'name', 'slug'];
        $tags = $this->startQuery()
            ->select($columns)
            ->with('posts:post_id')
            ->get()
            ->pluck('name', 'id');
        return $tags;
    }

    public function getTagsToObject()
    {
        $columns = ['id', 'name as text'];
        $tags = $this->startQuery()
            ->select($columns)
            ->get();
        return $tags;
    }

    public function getTrashed()
    {
        $columns = ['id', 'name', 'deleted_at'];
        $tags = $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->latest()
            ->paginate(countOnPage());
        return $tags;
    }

}
