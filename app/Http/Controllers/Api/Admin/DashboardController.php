<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Admin\Traits\Chart\ChartHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class DashboardController extends BaseController
{
    use ChartHelper;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $categories = $this->blogCategoryRepository->getCount();
        $posts = $this->blogPostRepository->getCount();
        $tags = $this->tagRepository->getCount();
        $users = $this->userRepository->getCount();
        $comments = $this->blogCommentRepository->getCount();
        return response()->json([
            'categories' => $categories,
            'posts' => $posts,
            'tags' => $tags,
            'users' => $users,
            'comments' => $comments
        ], 200);
    }

    public function getSiteExistingYears()
    {
        $years = [];
        $groupedYears = [];
        $firstUser = $this->userRepository->getFirstUser();
        $firstYear = Carbon::parse($firstUser->created_at)->year;
        $now = Carbon::parse(now())->year;
        for ($i = $firstYear; $i <= $now; $i++) {
            array_push($years, $i);
        }
        for ($i = 0; $i < count($years); $i++) {
            array_push($groupedYears, $years[$i].'-'.($years[$i] + 1));
        }
        return response()->json(['years' => ['flatten' => $years, 'grouped' => $groupedYears]]);
    }

    public function users(Request $request)
    {
        $interval = $request->input('interval');
        $months = $this->getMonths($interval);
        $columns = ['date', 'Всего', 'Пользователи', 'Потенциальные боты'];
        $rows = [];
        if (!empty($months)) {
            foreach ($months as $month_number => $month_name) {
                $count = $this->getMonthlyUserCount($month_number, $interval);
                $rows[] = [
                    'date' => $month_name,
                    'Всего' => $count['all'],
                    'Пользователи' => $count['users'],
                    'Потенциальные боты' => $count['bots']
                ];
            }
        }
        return ['columns' => $columns, 'rows' => $rows];
    }

    public function comments(Request $request)
    {
        $interval = $request->input('interval');
        $months = $this->getMonths($interval);
        $columns = ['date', 'Всего', 'Комментарии', 'Потенциальные комментарии ботов'];
        $rows = [];
        if (!empty($months)) {
            foreach ($months as $month_number => $month_name) {
                $count = $this->getMonthlyCommentCount($month_number, $interval);
                $rows[] = [
                    'date' => $month_name,
                    'Всего' => $count['all'],
                    'Комментарии' => $count['comments'],
                    'Потенциальные комментарии ботов' => $count['bots']
                ];
            }
        }
        return ['columns' => $columns, 'rows' => $rows];
    }
}
