<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['file_path', 'file_mime', 'ticket_id'];

    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }
}
