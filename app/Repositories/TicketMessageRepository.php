<?php

namespace App\Repositories;

use App\Models\TicketMessage;

class TicketMessageRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return TicketMessage::class;
    }

    public function getMessagesOfTicket($ticket_id)
    {
        $columns = ['*'];
        $messages = $this->startQuery()
            ->select($columns)
            ->where('ticket_id', $ticket_id)
            ->latest()
            ->with('userFrom:id,login,name,avatar', 'userTo:id,login,name,avatar')
            ->get();
        return $messages;
    }

    public function getBlogTicketMessages($ticket_id)
    {
        $columns = ['id', 'ticket_id', 'from', 'to', 'read', 'message', 'created_at'];
        $messages = $this->startQuery()
            ->select($columns)
            ->where('ticket_id', $ticket_id)
            ->latest()
            ->with('userFrom:id,login,name', 'userTo:id,login,name')
            ->get();
        return $messages;
    }

    public function getPreviousTicketMessages($id)
    {
        $columns = ['id'];
        $messages = $this->startQuery()
            ->select($columns)
            ->where('id', '<>', $id)
            ->get();
        return $messages;
    }

    public function getCountOfUnreadMessages()
    {
        return $this->startQuery()
            ->where('read', 0)
            ->count();
    }
}
