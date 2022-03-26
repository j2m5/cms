<?php


namespace App\Repositories;

use App\Models\BlogCategory;

class BlogCategoryRepository extends BaseRepository
{

    protected function getModelClass()
    {
        return BlogCategory::class;
    }

    public function getWidget()
    {
        $columns = ['id', 'title'];
        $categories = $this->startQuery()
            ->select($columns)
            ->withCount('posts')
            ->get();
        return $categories;
    }

    public function getCategories()
    {
        $columns = ['id', 'title'];
        $categories = $this->startQuery()
            ->select($columns)
            ->get()
            ->pluck('title', 'id');
        return $categories;
    }

    public function getCategoriesToObject()
    {
        $columns = ['id', 'title'];
        $categories = $this->startQuery()
            ->select($columns)
            ->get();
        return $categories;
    }

    public function getAdminIndex()
    {
        $columns = ['id', 'title', 'description', 'created_at', 'updated_at'];
        $categories = $this->startQuery()
            ->select($columns)
            ->latest()
            ->paginate(countOnPage());
        return $categories;
    }

    public function getAdminIndexFiltered($query)
    {
        $columns = ['id', 'title', 'description', 'created_at', 'updated_at'];
        $categories = $this->startQuery()
            ->select($columns)
            ->where('title', 'LIKE', '%'.$query.'%')
            ->latest()
            ->paginate(countOnPage());
        return $categories;
    }

    public function getAdminEdit($id)
    {
        $columns = ['id', 'parent_id', 'title', 'slug', 'description', 'md', 'mk'];
        $category =  $this->startQuery()
            ->select($columns)
            ->where('id', $id)
            ->first();
        return $category;
    }

    public function getBlogShow($id)
    {
        $columns = ['id', 'title', 'md', 'mk'];
        $category = $this->startQuery()
            ->select($columns)
            ->where('id', $id)
            ->first();
        return $category;
    }

    public function getByParentId($parent_id)
    {
        $columns = ['id', 'parent_id'];
        $categories = $this->startQuery()
            ->select($columns)
            ->where('parent_id', $parent_id)
            ->get();
        return $categories;
    }

    public function getParentCategory($id)
    {
        $columns = ['id', 'title'];
        $category = $this->startQuery()
            ->select($columns)
            ->withTrashed()
            ->where('id', $id)
            ->first();
        return $category;
    }

    public function getTrashed()
    {
        $columns = ['id', 'parent_id', 'title', 'created_at', 'deleted_at'];
        $categories = $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->with('parentCategory:id,title')
            ->latest()
            ->paginate(countOnPage());
        return $categories;
    }

    public function getTrashedItem($id)
    {
        $columns = ['id', 'parent_id', 'title', 'created_at', 'deleted_at'];
        $category = $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->where('id', $id)
            ->first();
        return $category;
    }

    public function getTrashedByParentId($parent_id)
    {
        $columns = ['id', 'parent_id'];
        $categories = $this->startQuery()
            ->select($columns)
            ->onlyTrashed()
            ->where('parent_id', $parent_id)
            ->get();
        return $categories;
    }

    public function getDeletedAt($id)
    {
        $category = $this->startQuery()
            ->select('deleted_at')
            ->withTrashed()
            ->where('id', $id)
            ->first();
        return $category;
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

}
