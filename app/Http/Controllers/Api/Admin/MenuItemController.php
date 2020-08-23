<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\MenuItemRequest;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(MenuItemRequest $request)
    {
        $item = MenuItem::create($request->all());
        return response()->json(['success' => 'Добавлен новый пункт меню', 'item' => $item]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(MenuItemRequest $request, $id)
    {
        $item = $this->menuItemRepository->getOne($id);
        $item->update($request->all());
        return response()->json(['success' => 'Пункт меню изменен']);
    }

    public function destroy($id)
    {
        $item = $this->menuItemRepository->getOne($id);
        $children = $item->children()->get();
        $item->destroy($id);
        foreach ($children as $child) $this->destroy($child->id);
        return response()->json(['success' => 'Пункт меню удален']);
    }
}
