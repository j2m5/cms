<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin');
    }

    public function getSiteName()
    {
        return response()->json(['name' => siteName()], 200);
    }

    public function getSiteLogo()
    {
        return response()->json(['logo' => siteLogo() ?? '']);
    }

    public function getAuthUser()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}
