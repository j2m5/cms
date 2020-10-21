<?php

namespace App\Http\Controllers\Api\Admin\Traits\Chart;

use App\Models\BlogComment;
use App\Models\User;
use Illuminate\Support\Carbon;

trait ChartHelper
{
    private function getMonthlyUserCount($month, $interval)
    {
        $data = User::whereBetween('created_at', $interval)->whereMonth('created_at', $month)->get();
        $popularMails = $this->popularMails();
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

    private function getMonthlyCommentCount($month, $interval)
    {
        $data = BlogComment::whereBetween('created_at', $interval)->whereMonth('created_at', $month)->get();
        $popularMails = $this->popularMails();
        $comments = $data->filter(function ($comment) use ($popularMails) {
            $mailProvider = explode('@', $comment->user->email);
            return in_array($mailProvider[1], $popularMails);
        });
        $bots = $data->filter(function ($comment) use ($popularMails) {
            $mailProvider = explode('@', $comment->user->email);
            return !in_array($mailProvider[1], $popularMails);
        });
        return ['all' => $data->count(), 'comments' => $comments->count(), 'bots' => $bots->count()];
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

    private function popularMails()
    {
        return ['gmail.com', 'mail.ru', 'mail.ua', 'mail.com', 'yandex.ru', 'yandex.ua', 'rambler.ru'];
    }
}
