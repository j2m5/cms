<?php


namespace App\Repositories;

use App\Models\BlogComment;

class BlogCommentRepository extends BaseRepository
{

    protected function getModelClass()
    {
        return BlogComment::class;
    }

    public function getAdminIndex()
    {
        $columns = ['id', 'post_id', 'user_id', 'author', 'content', 'updated_by', 'created_at', 'updated_at'];
        return $this->startQuery()
            ->select($columns)
            ->latest()
            ->with('post:id,title,slug', 'user:id,login,name')
            ->paginate(countOnPage());
    }

    public function getAdminIndexFiltered($query)
    {
        $columns = ['id', 'post_id', 'user_id', 'author', 'content', 'updated_by', 'created_at', 'updated_at'];
        return $this->startQuery()
            ->select($columns)
            ->where('content', 'LIKE', '%'.$query.'%')
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('login', 'LIKE', '%'.$query.'%')
                    ->orWhere('name', 'LIKE', '%'.$query.'%');
            })
            ->latest()
            ->with('post:id,title,slug', 'user:id,login,name')
            ->paginate(countOnPage());
    }

    public function getAdminEdit($id)
    {
        $columns = ['id', 'post_id', 'parent_id', 'user_id', 'author', 'content', 'updated_by', 'created_at', 'updated_at'];
        return $this->startQuery()
            ->select($columns)
            ->where('id', $id)
            ->with('user:id,login,name')
            ->first();
    }

    public function getByParentId($parent_id)
    {
        $columns = ['id', 'parent_id'];
        return $this->startQuery()
            ->select($columns)
            ->where('parent_id', $parent_id)
            ->get();
    }

    public function getRecentCommentsByUser($id, $limit = 15)
    {
        $columns = ['id', 'post_id', 'user_id', 'content', 'created_at'];
        return $this->startQuery()
            ->select($columns)
            ->where('user_id', $id)
            ->latest()
            ->take($limit)
            ->with('post:id,title,slug', 'user:id,name,avatar')
            ->get();
    }

    public function getTrashed()
    {
        $columns = ['id', 'post_id', 'parent_id', 'content', 'created_at', 'deleted_at'];
        return $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->latest()
            ->with('post:id,title,deleted_at')
            ->paginate(countOnPage());
    }

    public function getTrashedItem($id)
    {
        $columns = ['id', 'post_id', 'parent_id', 'content', 'created_at', 'deleted_at'];
        return $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->where('id', $id)
            ->with('post:id,title,deleted_at')
            ->first();
    }

    public function getTrashedByParentId($parent_id)
    {
        $columns = ['id', 'parent_id'];
        return $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->where('parent_id', $parent_id)
            ->get();
    }

    public function getDeletedAt($id)
    {
        return $this->startQuery()
            ->select('deleted_at')
            ->withTrashed()
            ->where('id', $id)
            ->first();
    }

    public function getCommentsOfPeriod($start, $end)
    {
        return $this->startQuery()
            ->select(['*'])
            ->whereBetween('created_at', [$start, $end])
            ->get()
            ->pluck('created_at');
    }

}
