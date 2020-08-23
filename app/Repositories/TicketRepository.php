<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Ticket::class;
    }

    public function getAdminIndex()
    {
        $columns = ['*'];
        $tickets = $this->startQuery()
            ->select($columns)
            ->latest()
            ->with('category:id,title')
            ->paginate(countOnPage());
        return $tickets;
    }

    public function getAdminIndexFiltered($query)
    {
        $columns = ['*'];
        $tickets = $this->startQuery()
            ->select($columns)
            ->where('title', 'LIKE', '%'.$query.'%')
            ->orderBy('priority')
            ->latest()
            ->with('category:id,title')
            ->paginate(countOnPage());
        return $tickets;
    }

    public function getAdminShow($id)
    {
        $columns = ['*'];
        $ticket = $this->startQuery()
            ->select($columns)
            ->where('id', $id)
            ->with('user:id,login,name,email,avatar')
            ->withCount('messages')
            ->first();
        return $ticket;
    }

    public function getBlogTickets($user_id)
    {
        $columns = ['id', 'category_id', 'title', 'question', 'status'];
        $tickets = $this->startQuery()
            ->select($columns)
            ->where('user_id', $user_id)
            ->latest()
            ->with('category:id,title')
            ->get();
        return $tickets;
    }

    public function getBlogTicket($id)
    {
        $columns = ['id', 'category_id', 'title', 'question', 'status'];
        $ticket = $this->startQuery()
            ->select($columns)
            ->where('id', $id)
            ->with('category:id,title')
            ->first();
        return $ticket;
    }

    public function getCountOfProcessingTickets()
    {
        return $this->startQuery()
            ->where('status', 'processing')
            ->count();
    }
}
