<?php


namespace App\Repositories;

use App\Models\Event;
use Carbon\Carbon;

class EventRepository extends BaseRepository
{

    protected function getModelClass()
    {
        return Event::class;
    }

    public function getEvents()
    {
        $columns = ['id', 'model', 'event_type', 'data', 'range', 'created_at', 'updated_at'];
        $events = $this->startQuery()
            ->select($columns)
            ->latest()
            ->get()
            ->groupBy('range');
        return $events;
    }
}
