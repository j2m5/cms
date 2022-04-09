<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PageController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $query = $request->query('query');
        $pages = $this->pageRepository->getAdminIndexFiltered($query);
        return response()->json(['query' => $query, 'pages' => $pages], 200);
    }

    public function create()
    {
        $user = auth()->user()->id;
        return response()->json(['user' => $user], 200);
    }

    public function store(PageRequest $request)
    {
        $page = new Page($request->input());
        if (Gate::denies('create', $page)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $page->save();
        return response()->json(['success' => 'Страница успешно добавлена'], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $page = $this->pageRepository->getAdminEdit($id);
        return response()->json(['page' => $page], 200);
    }

    public function update(PageRequest $request, $id)
    {
        $page = $this->pageRepository->getAdminEdit($id);
        if (Gate::denies('update', $page)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $page->update($request->input());
        return response()->json(['success' => 'Страница успешно обновлена'], 200);
    }

    public function destroy($id)
    {
        $page = $this->pageRepository->getOne($id);
        if (Gate::denies('delete', $page)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $page->destroy($id);
        return response()->json(['success' => 'Страница удалена в корзину'], 200);
    }

    public function forceDelete($id)
    {
        $page = $this->pageRepository->getTrashedItem($id);
        if (Gate::denies('forceDelete', $page)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $page->forceDelete($id);
        return response()->json(['success' => 'Страница успешно удалена'], 200);
    }

    public function restore($id)
    {
        $page = $this->pageRepository->getTrashedItem($id);
        if (Gate::denies('restore', $page)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $page->restore($id);
        return response()->json(['success' => 'Страница восстановлена'], 200);
    }
}
