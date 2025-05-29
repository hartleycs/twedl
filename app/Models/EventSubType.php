<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSubType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'event_type_id'];

    public function type()
    {
        return $this->belongsTo(EventType::class);
    }
}
