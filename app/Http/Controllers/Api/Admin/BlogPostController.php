<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\BlogPostRequest;
use App\Models\BlogPost;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $query = $request->query('query');
        $posts = $this->blogPostRepository->getAdminIndexFiltered($query);
        return response()->json(['query' => $query, 'posts' => $posts], 200);
    }

    public function create()
    {
        $user = auth()->user()->id;
        $categories = $this->blogCategoryRepository->getCategoriesToObject();
        $tags = $this->tagRepository->getTagsToObject();
        return response()->json(['user' => $user, 'categories' => $categories, 'tags' => $tags], 200);
    }

    public function store(BlogPostRequest $request)
    {
        $post = new BlogPost($request->input());
        if (Gate::denies('create', $post)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $post->save();
        if (!empty($request->input('tags'))) $this->syncTags($post, $request->input('tags'));
        return response()->json(['success' => 'Запись успешно добавлена'], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $post = $this->blogPostRepository->getAdminEdit($id);
        $categories = $this->blogCategoryRepository->getCategoriesToObject();
        $tags = $this->tagRepository->getTagsToObject();
        $relatedTags = ($post->tags) ? $post->tags->pluck('tag_id')->toArray() : null;
        return response()->json(['post' => $post, 'categories' => $categories, 'tags' => $tags, 'relatedTags' => $relatedTags], 200);
    }

    public function update(BlogPostRequest $request, $id)
    {
        $post = $this->blogPostRepository->getAdminEdit($id);
        if (Gate::denies('update', $post)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $post->update($request->input());
        $this->syncTags($post, $request->input('tags'));
        return response()->json(['success' => 'Запись успешно обновлена'], 200);
    }

    public function destroy($id)
    {
        $post = $this->blogPostRepository->getOne($id);
        if (Gate::denies('delete', $post)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $post->destroy($id);
        return response()->json(['success' => 'Запись удалена в корзину'], 200);
    }

    public function forceDelete($id)
    {
        $post = $this->blogPostRepository->getTrashedItem($id);
        if (Gate::denies('forceDelete', $post)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $post->forceDelete($id);
        return response()->json(['success' => 'Запись успешно удалена'], 200);
    }

    public function restore($id)
    {
        $post = $this->blogPostRepository->getTrashedItem($id);
        if (Gate::denies('restore', $post)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        if ($post->category->deleted_at) return response()->json(['errors' => 'Запись находится в удаленном разделе "'.$post->category->title.'" и не может быть восстановлена'], 423);
        $post->restore($id);
        return response()->json(['success' => 'Запись и все содержимое восстановлены'], 200);
    }

    public function uploadPreviewImage(Request $request)
    {
        $image = Storage::disk('public')->putFile('uploads/posts', $request->file('image'));
        return response()->json(['success' => 'Превью успешно загружено', 'newImage' => $image ]);
    }

    private function syncTags($post, $tags)
    {
        $fresh = [];
        foreach ($tags as $tag) {
            if ($this->tagRepository->getOne($tag)) $fresh[] = $tag;
            elseif ($post->tags()->where('name', $tag)->exists()) $fresh[] = $post->tags()->where('name', $tag)->latest()->first()->id;
            else {
                $t = new Tag();
                $t->name = $tag;
                $t->save();
                $fresh[] = $t->id;
            }
        }
        $post->tags()->sync($fresh);
    }

}
