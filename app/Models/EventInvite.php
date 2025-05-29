<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class EventInvite extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'email',
        'token',
        'sent_at',
        'accepted_at',
    ];

    protected static function booted()
    {
        static::creating(function (self $invite) {
            if (empty($invite->token)) {
                $invite->token = (string) Str::uuid();
            }
        });
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
