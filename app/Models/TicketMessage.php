<?php

namespace App\Models;

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

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function userTo()
    {
        return $this->belongsTo(User::class, 'to');
    }
}
