<?php

namespace App\Http\Controllers\Blog;

use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCommentController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function store(Request $request, $slug)
    {
        $validator = Validator::make($request->input(), ['content' => 'required|min:2|max:1000']);
        $comment = new BlogComment($request->input());
        if ($validator->fails()) return redirect('/posts/'.$slug.'/#enter-comment')->withErrors($validator);
        if (auth()->user()->banned) return back()->withErrors(['errors' => 'Вы не можете оставлять комментарии']);
        if (!auth()->check()) return back();
        $comment->save();
        if ($comment) return redirect('posts/'.$slug.'/#comment-'.$comment->id)->with(['success' => 'Комментарий успешно добавлен']);
        else return redirect('posts/'.$slug.'/#enter-comment')->withErrors(['errors' => 'Произошла ошибка'])->withInput();
    }
}
