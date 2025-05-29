<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketPrice extends Model
{
    protected $fillable = ['event_id', 'label', 'price'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
