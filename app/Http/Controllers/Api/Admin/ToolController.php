<?php

namespace App\Http\Controllers\Api\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Watson\Sitemap\Facades\Sitemap;

class ToolController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //
    }

    public function siteMapGenerate()
    {
        if (auth()->user()->role_id !== 4) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $posts = $this->blogPostRepository->getAll();
        $categories = $this->blogCategoryRepository->getAll();
        Sitemap::addTag(config('app.url'), Carbon::now(), 'daily', '0.8');
        Sitemap::addTag(route('login'), Carbon::now(), 'daily', '0.8');
        Sitemap::addTag(route('register'), Carbon::now(), 'daily', '0.8');
        foreach ($posts as $post) {
            Sitemap::addTag(route('posts.show', $post->slug), $post->updated_at, 'daily', '0.8');
        }
        foreach ($categories as $category) {
            Sitemap::addTag(route('categories.show', $category->id), $category->updated_at, 'daily', '0.8');
        }
        $map = Sitemap::xml();
        File::put(public_path('sitemap.xml'), $map);
        return response()->json(['success' => 'Карта сайта успешно создана'], 200);
    }

    public function symLinkGenerate()
    {
        if (auth()->user()->role_id !== 4) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        Artisan::call('storage:link');
        Artisan::output();
        return response()->json(['success' => 'Папка для загружаемых на сервер файлов успешно создана'], 200);
    }
}
