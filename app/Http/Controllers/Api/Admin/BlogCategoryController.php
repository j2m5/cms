<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\BlogCategoryRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BlogCategoryController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $query = $request->query('query');
        $categories = $this->blogCategoryRepository->getAdminIndexFiltered($query);
        return response()->json(['query' => $query, 'categories' => $categories], 200);
    }

    public function create()
    {
        $categories = $this->blogCategoryRepository->getCategoriesToObject();
        return response()->json(['categories' => $categories], 200);
    }

    public function store(BlogCategoryRequest $request)
    {
        $category = new BlogCategory($request->input());
        if (Gate::denies('create', $category)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $category->save();
        return response()->json(['success' => 'Раздел успешно добавлен'], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = $this->blogCategoryRepository->getAdminEdit($id);
        $categories = $this->blogCategoryRepository->getCategoriesToObject();
        return response()->json(['category' => $category, 'categories' => $categories], 200);
    }

    public function update(BlogCategoryRequest $request, $id)
    {
        $category = $this->blogCategoryRepository->getAdminEdit($id);
        if (Gate::denies('update', $category)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $category->update($request->input());
        return response()->json(['success' => 'Раздел успешно обновлен'], 200);
    }

    public function destroy($id)
    {
        $category = $this->blogCategoryRepository->getOne($id);
        $subcategories = $this->blogCategoryRepository->getByParentId($category->id);
        if (Gate::denies('delete', $category)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $category->destroy($id);
        foreach ($subcategories as $subcategory) $this->destroy($subcategory->id);
        return response()->json(['success' => 'Раздел удален в корзину'], 200);
    }

    public function forceDelete($id)
    {
        $category = $this->blogCategoryRepository->getTrashedItem($id);
        $subcategories = $this->blogCategoryRepository->getTrashedByParentId($category->id);
        if (Gate::denies('forceDelete', $category)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $category->forceDelete($id);
        foreach ($subcategories as $subcategory) $this->forceDelete($subcategory->id);
        return response()->json(['success' => 'Раздел удален, также удалены все его записи и их комментарии'], 200);
    }

    public function restore($id)
    {
        $category = $this->blogCategoryRepository->getTrashedItem($id);
        $subcategories = $this->blogCategoryRepository->getTrashedByParentId($category->id);
        if (Gate::denies('restore', $category)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        if (isCategoryDeleted($category->parent_id)) return response()->json(['errors' => '"'.$category->title.'" является вложенным разделом, и не может быть восстановлен пока его родительский раздел удален'], 423);
        $category->restore($id);
        foreach ($subcategories as $subcategory) $this->restore($subcategory->id);
        return response()->json(['success' => 'Раздел и все содержимое восстановлены'], 200);
    }
}
