<?php


namespace App\Repositories;

use App\Models\BlogPost;
use Illuminate\Support\Carbon;

class BlogPostRepository extends BaseRepository
{

    protected function getModelClass()
    {
        return BlogPost::class;
    }

    public function getRecentPosts()
    {
        $columns = ['id', 'title', 'slug', 'created_at'];
        $posts = $this->startQuery()
            ->select($columns)
            ->latest()
            ->take(10)
            ->get();
        return $posts;
    }

    public function getBlogIndex()
    {
        $columns = ['id', 'category_id', 'user_id', 'views', 'title', 'slug', 'image', 'excerpt', 'created_at'];
        $posts = $this->startQuery()
            ->select($columns)
            ->where('is_public', 1)
            ->latest()
            ->with('category:id,title', 'user:id,name', 'tags:tag_id,name,slug', 'comments:id,post_id')
            ->paginate(countPostsOnPage());
        return $posts;
    }

    public function getBlogShow($slug)
    {
        $columns = ['id', 'category_id', 'user_id', 'views', 'slug', 'title', 'image', 'excerpt', 'content', 'is_discuss', 'md', 'mk', 'created_at'];
        $post = $this->startQuery()
            ->select($columns)
            ->where('slug', $slug)
            ->where('is_public', 1)
            ->firstOrFail();

        if ($post) {
            $post->load('comments:id,post_id,parent_id,user_id,content,created_at');
            $post->comments->load('user:id,name,avatar');
            $post->load('tags:tag_id,name,slug');
        }
        return $post;
    }

    public function getAdminIndex()
    {
        $columns = ['id', 'category_id', 'user_id', 'views', 'title', 'slug', 'image', 'excerpt', 'content', 'is_public', 'created_at', 'updated_at'];
        $posts = $this->startQuery()
            ->select($columns)
            ->latest()
            ->with('category:id,title', 'user:id,name,login', 'tags:tag_id,name,slug')
            ->paginate(countOnPage());
        return $posts;
    }

    public function getAdminIndexFiltered($query)
    {
        $columns = ['id', 'category_id', 'user_id', 'views', 'title', 'slug', 'image', 'excerpt', 'content', 'is_public', 'created_at', 'updated_at'];
        $posts = $this->startQuery()
            ->select($columns)
            ->where('is_public', 1)
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', '%'.$query.'%')
                    ->orWhere('excerpt', 'LIKE', '%'.$query.'%')
                    ->orWhere('content', 'LIKE', '%'.$query.'%');
            })
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('login', 'LIKE', '%'.$query.'%')
                    ->orWhere('name', 'LIKE', '%'.$query.'%');
            })
            ->latest()
            ->with('category:id,title', 'user:id,name,login', 'tags:tag_id,name,slug')
            ->paginate(countOnPage());
        return $posts;
    }

    public function search($query)
    {
        return $this->getAdminIndexFiltered($query);
    }

    public function getAdminEdit($id)
    {
        $columns = ['id', 'category_id', 'user_id', 'title', 'slug', 'excerpt', 'content', 'md', 'mk', 'is_public', 'is_discuss', 'created_at'];
        $post = $this->startQuery()
            ->select($columns)
            ->where('id', $id)
            ->with('tags:tag_id,name')
            ->first();
        return $post;
    }

    public function getByCategoryId($id)
    {
        $columns = ['id', 'category_id', 'user_id', 'views', 'title', 'slug', 'image', 'excerpt', 'created_at'];
        $posts = $this->startQuery()
            ->select($columns)
            ->where('category_id', $id)
            ->where('is_public', 1)
            ->latest()
            ->with('category:id,title', 'user:id,name', 'tags:tag_id,name,slug')
            ->paginate(countPostsOnPage());
        return $posts;
    }

    public function getSimilarPosts($id, $category_id, $title, $excerpt, $limit)
    {
        $columns = ['id', 'category_id', 'user_id', 'title', 'slug', 'image', 'excerpt', 'is_public', 'created_at'];
        $posts = $this->startQuery()
            ->select($columns)
            ->where('is_public', 1)
            ->where('created_at', '>', Carbon::now()->subYear())
            ->where('category_id', $category_id)
            ->orWhere(function ($get) use ($title, $excerpt) {
                $get->where('title', 'LIKE', '%'.$title.'%')
                    ->orWhere('excerpt', 'LIKE', '%'.$excerpt.'%');
            })
            ->having('id', '<>', $id)
            ->inRandomOrder()
            ->take($limit)
            ->get();
        return $posts;
    }

    public function getTrashed()
    {
        $columns = ['id', 'category_id', 'user_id', 'title', 'created_at', 'deleted_at'];
        $posts = $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->latest()
            ->with('category:id,title,deleted_at', 'user:id')
            ->paginate(countOnPage());
        return $posts;
    }

    public function getTrashedItem($id)
    {
        $columns = ['id', 'category_id', 'user_id', 'title', 'created_at', 'deleted_at'];
        $post = $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->where('id', $id)
            ->with('category:id,title,deleted_at', 'user:id')
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

    public function getPostIdBySlug($slug)
    {
        return $this->startQuery()
            ->select(['id'])
            ->where('slug', $slug)
            ->first();
    }

}
