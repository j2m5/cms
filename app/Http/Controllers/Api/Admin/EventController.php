<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Pagination\LengthAwarePaginator;

class EventController extends BaseController
{

    private $perPage = 1;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $events = $this->eventRepository->getEvents();
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = $this->perPage;
        $total = count($events);
        $events = array_slice($events->toArray(), $perPage * ($currentPage - 1), $perPage);
        $events = new LengthAwarePaginator($events, $total, $perPage, $currentPage, ['path' => LengthAwarePaginator::resolveCurrentPath(), 'pageName' => 'page']);
        return response()->json(['events' => $events], 200);
    }
}
