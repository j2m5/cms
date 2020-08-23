<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Admin\Traits\Menu\Editable;
use App\Http\Requests\MenuUpdateRequest;
use App\Http\Requests\MenuStoreRequest;
use App\Models\Menu;

class MenuController extends BaseController
{
    use Editable;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $menus = $this->menuRepository->getMenuTree();
        return response()->json(['menus' => $menus]);
    }

    public function create()
    {
        $types = $this->menuItemTypeRepository->getAll();
        $pages = $this->pageRepository->getAll();
        $posts = $this->blogPostRepository->getAll();
        $categories = $this->blogCategoryRepository->getAll();
        return response()->json([
            'types' => $types,
            'entities' => [
                'pages' => $pages,
                'posts' => $posts,
                'categories' => $categories
            ]
        ]);
    }

    public function store(MenuStoreRequest $request)
    {
        $menu = Menu::create(['name' => $request->input('name')]);
        return response()->json(['success' => 'Меню успешно создано', 'menu' => $menu]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $menu = $this->menuRepository->getAdminEdit($id);
        $types = $this->menuItemTypeRepository->getAll();
        $pages = $this->pageRepository->getAll();
        $posts = $this->blogPostRepository->getAll();
        $categories = $this->blogCategoryRepository->getAll();
        return response()->json([
            'menu' => $menu,
            'types' => $types,
            'entities' => [
                'pages' => $pages,
                'posts' => $posts,
                'categories' => $categories
            ]
        ]);
    }

    public function update(MenuUpdateRequest $request, $id)
    {
        $menu = $this->menuRepository->getAdminEdit($id);
        $items = $request->input('items');
        $menu->update(['name' => $request->input('name')]);
        $this->updateMenu($id, $items);
        return response()->json(['success' => 'Меню успешно обновлено']);
    }

    public function destroy($id)
    {
        //
    }
}
