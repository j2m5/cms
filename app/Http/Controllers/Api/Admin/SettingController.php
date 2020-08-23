<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class SettingController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $siteName = siteName();
        $siteDesc = siteDescription();
        $siteLogo = siteLogo();
        $siteMD = siteMetaDescription();
        $siteMK = siteMetaKeywords();
        $adminEmail = adminEmail();
        $countOnPage = countOnPage();
        $countPostsOnPage = countPostsOnPage();
        return response()->json(['siteName' => $siteName, 'siteDesc' => $siteDesc, 'siteLogo' => $siteLogo, 'siteMD' => $siteMD, 'siteMK' => $siteMK, 'adminEmail' => $adminEmail, 'countOnPage' => $countOnPage, 'countPostsOnPage' => $countPostsOnPage], 200);
    }

    public function themes()
    {
        $themes = $this->getThemes();
        $currentTheme = currentTheme();
        return response()->json(['themes' => $themes, 'currentTheme' => $currentTheme], 200);
    }

    public function updateSiteSettings(Request $request, $id)
    {
        $setting = $this->settingRepository->getOne($id);
        if (Gate::denies('update', $setting)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $setting->update($request->input());
        return response()->json(['success' => 'Настройки успешно обновлены'], 200);
    }

    public function updateTheme(Request $request, $id)
    {
        $theme = $this->settingRepository->getOne($id);
        if (Gate::denies('update', $theme)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        $theme->update($request->input());
        return response()->json(['success' => 'Тема успешно активирована'], 200);
    }

    private function getThemes()
    {
        $dirs = File::directories(public_path('themes'));
        $result = [];
        foreach($dirs as $dir) {
            $files = File::files($dir);
            foreach($files as $file) {
                $result[] = basename(dirname($file));
            }
        }
        return $result;
    }

}
