<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    use HasFactory;

    // fillable so you can mass‐assign ->create(['name' => ...])
    protected $fillable = ['name'];

    /**
     * Get the sub‐types for this event type.
     */
    public function subTypes()
    {
        return $this->hasMany(EventSubType::class);
    }
}
