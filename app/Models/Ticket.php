<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['business_review_id', 'user_id', 'description', 'ticket_status','reviewer_user_id'];

    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class);
    }
    public function review()
    {
        return $this->belongsTo(BusinessReview::class, 'business_review_id', 'id')->with('user','businessAccount');
    }
 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_user_id');
    }
   
    public function ticketChat()
    {
        return $this->hasMany(TicketChat::class);
    }
}