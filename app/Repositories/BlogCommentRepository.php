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
        $comments = $this->startQuery()
            ->select($columns)
            ->latest()
            ->with('post:id,title,slug', 'user:id,login,name')
            ->paginate(countOnPage());
        return $comments;
    }

    public function getAdminIndexFiltered($query)
    {
        $columns = ['id', 'post_id', 'user_id', 'author', 'content', 'updated_by', 'created_at', 'updated_at'];
        $comments = $this->startQuery()
            ->select($columns)
            ->where('content', 'LIKE', '%'.$query.'%')
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('login', 'LIKE', '%'.$query.'%')
                    ->orWhere('name', 'LIKE', '%'.$query.'%');
            })
            ->latest()
            ->with('post:id,title,slug', 'user:id,login,name')
            ->paginate(countOnPage());
        return $comments;
    }

    public function getAdminEdit($id)
    {
        $columns = ['id', 'post_id', 'parent_id', 'user_id', 'author', 'content', 'updated_by', 'created_at', 'updated_at'];
        $comment = $this->startQuery()
            ->select($columns)
            ->where('id', $id)
            ->with('user:id,login,name')
            ->first();
        return $comment;
    }

    public function getByParentId($parent_id)
    {
        $columns = ['id', 'parent_id'];
        $comments = $this->startQuery()
            ->select($columns)
            ->where('parent_id', $parent_id)
            ->get();
        return $comments;
    }

    public function getRecentCommentsByUser($id, $limit = 15)
    {
        $columns = ['id', 'post_id', 'user_id', 'content', 'created_at'];
        $comments = $this->startQuery()
            ->select($columns)
            ->where('user_id', $id)
            ->latest()
            ->take($limit)
            ->with('post:id,title,slug', 'user:id,name,avatar')
            ->get();
        return $comments;
    }

    public function getTrashed()
    {
        $columns = ['id', 'post_id', 'parent_id', 'content', 'created_at', 'deleted_at'];
        $comments = $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->latest()
            ->with('post:id,title,deleted_at')
            ->paginate(countOnPage());
        return $comments;
    }

    public function getTrashedItem($id)
    {
        $columns = ['id', 'post_id', 'parent_id', 'content', 'created_at', 'deleted_at'];
        $comment = $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->where('id', $id)
            ->with('post:id,title,deleted_at')
            ->first();
        return $comment;
    }

    public function getTrashedByParentId($parent_id)
    {
        $columns = ['id', 'parent_id'];
        $comments = $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->where('parent_id', $parent_id)
            ->get();
        return $comments;
    }

    public function getDeletedAt($id)
    {
        $comment = $this->startQuery()
            ->select('deleted_at')
            ->withTrashed()
            ->where('id', $id)
            ->first();
        return $comment;
    }

}
