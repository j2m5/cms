<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends BaseController
{

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

    private function getMonthlyUserCount($month, $interval)
    {
        $data = User::whereBetween('created_at', $interval)->whereMonth('created_at', $month)->get();
        $popularMails = ['gmail.com', 'mail.ru', 'mail.ua', 'mail.com', 'yandex.ru', 'yandex.ua', 'rambler.ru'];
        $users = $data->filter(function ($user) use ($popularMails) {
            $mailProvider = explode('@', $user->email);
            return in_array($mailProvider[1], $popularMails);
        });
        $bots = $data->filter(function ($user) use ($popularMails) {
            $mailProvider = explode('@', $user->email);
            return !in_array($mailProvider[1], $popularMails);
        });
        return ['all' => $data->count(), 'users' => $users->count(), 'bots' => $bots->count()];
    }

    private function getMonths($interval)
    {
        $months = [];
        $users = $this->userRepository->getUsersOfPeriod($interval[0], $interval[1]);
        if (!empty($users)) {
            foreach ($users as $user) {
                $month_number = Carbon::parse($user)->format('m');
                $month_name = Carbon::parse($user)->translatedFormat('F');
                $months[intval($month_number)] = $month_name;
            }
        }
        ksort($months, SORT_NUMERIC);
        return $months;
    }
}
