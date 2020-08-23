<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\BlogCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BlogCommentController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $query = $request->query('query');
        $comments = $this->blogCommentRepository->getAdminIndexFiltered($query);
        return response()->json(['query' => $query, 'comments' => $comments], 200);
    }

    public function create()
    {
        //
    }

    public function store(BlogCommentRequest $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $updated_by = auth()->user()->login;
        $comment = $this->blogCommentRepository->getAdminEdit($id);
        return response()->json(['updated_by' => $updated_by, 'comment' => $comment], 200);
    }

    public function update(BlogCommentRequest $request, $id)
    {
        $comment = $this->blogCommentRepository->getAdminEdit($id);
        if (Gate::denies('update', $comment)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $comment->update($request->input());
        return response()->json(['success' => 'Комментарий успешно обновлен'], 200);
    }

    public function destroy($id)
    {
        $comment = $this->blogCommentRepository->getOne($id);
        $replies = $this->blogCommentRepository->getByParentId($comment->id);
        if (Gate::denies('delete', $comment)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $comment->destroy($id);
        foreach ($replies as $reply) $this->destroy($reply->id);
        return response()->json(['success' => 'Комментарий и все ответы удалены в корзину'], 200);
    }

    public function forceDelete($id)
    {
        $comment = $this->blogCommentRepository->getTrashedItem($id);
        $replies = $this->blogCommentRepository->getTrashedByParentId($comment->id);
        if (Gate::denies('forceDelete', $comment)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $comment->forceDelete($id);
        foreach ($replies as $reply) $this->forceDelete($reply->id);
        return response()->json(['success' => 'Комментарий и все ответы удалены'], 200);
    }

    public function restore($id)
    {
        $comment = $this->blogCommentRepository->getTrashedItem($id);
        $replies = $this->blogCommentRepository->getTrashedByParentId($comment->id);
        if (Gate::denies('restore', $comment)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        if ($comment->post->deleted_at) return response()->json(['errors' => 'Комментарий принадлежит к удаленной записи "'.$comment->post->title.'" и не может быть восстановлен'], 423);
        if (isCommentDeleted($comment->parent_id)) return response()->json(['errors' => 'Комментарий является ответом к комментарию #'.$comment->parent_id.' и не может быть восстановлен'], 423);
        $comment->restore($id);
        foreach ($replies as $reply) $this->restore($reply->id);
        return response()->json(['success' => 'Комментарий и все ответы восстановлены'], 200);
    }
}
