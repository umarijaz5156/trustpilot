<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketChat extends Model
{
    use HasFactory;

    protected $table = 'ticket_chats';
    protected $guarded = [];


    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    

   
}
