<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TagController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $query = $request->query('query');
        $tags = $this->tagRepository->getAdminIndexFiltered($query);
        return response()->json(['query' => $query, 'tags' => $tags], 200);
    }

    public function create()
    {
        //
    }

    public function store(TagRequest $request)
    {
        $tag = new Tag($request->input());
        if (Gate::denies('create', $tag)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $tag->save();
        return response()->json(['success' => 'Тег успешно добавлен'], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tag = $this->tagRepository->getAdminEdit($id);
        return response()->json(['tag' => $tag], 200);
    }

    public function update(TagRequest $request, $id)
    {
        $tag = $this->tagRepository->getAdminEdit($id);
        if (Gate::denies('update', $tag)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $tag->update($request->input());
        return response()->json(['success' => 'Тег успешно обновлен'], 200);
    }

    public function destroy($id)
    {
        $tag = $this->tagRepository->getOne($id);
        if (Gate::denies('delete', $tag)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $tag->forceDelete($id);
        return response()->json(['success' => 'Тег удален'], 200);
    }
}
