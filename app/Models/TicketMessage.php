<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected $fillable = [
        'ticket_id',
        'from',
        'to',
        'read',
        'message'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function userTo()
    {
        return $this->belongsTo(User::class, 'to');
    }
}
