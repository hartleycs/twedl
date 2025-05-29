<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use RRule\RRule;
use App\Models\User;
use App\Models\EventType;
use App\Models\EventSubType;
use App\Models\EventInvite;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'event_type_id',
        'event_sub_type_id',
        'start_datetime',
        'end_datetime',
        'appearance_datetime',
        'takedown_datetime',
        'recurrence_rule',
        'venue_name',
        'address_line_1',
        'address_line_2',
        'town',
        'city',
        'state',
        'postcode',
        'country',
        'location_address',
        'landmark_description',
        'latitude',
        'longitude',
        'website_url',
        'is_free',
        'ticket_prices',
        'visibility',
        'invitees',
        'age_restricted',
        'accessibility_info',
        'venue_capacity',
        'covid_measures',
        'status',
        'image_path',
        'reviewed_by',
        'reviewed_at',
        'vetting_comments',
        'max_attendees',
        'booking_url',
        'language',
    ];

    protected $casts = [
        'start_datetime'       => 'datetime',
        'end_datetime'         => 'datetime',
        'appearance_datetime'  => 'datetime',
        'takedown_datetime'    => 'datetime',
        'latitude'             => 'float',
        'longitude'            => 'float',
        'is_free'              => 'boolean',
        'age_restricted'       => 'boolean',
        'invitees'             => 'array',
        'reviewed_at'          => 'datetime',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

        public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }

    public function eventSubType(): BelongsTo
    {
        return $this->belongsTo(EventSubType::class, 'event_sub_type_id');
    }

    public function invites(): HasMany
    {
        return $this->hasMany(EventInvite::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function scopeCity($query, $city)
    {
        return $query->where('location_address', 'like', "%{$city}%");
    }

    public function getOccurrencesBetween(\DateTimeInterface $start, \DateTimeInterface $end): array
    {
        if (! $this->recurrence_rule) {
            return [ $this->start_datetime ];
        }

        $rule = new RRule(array_merge(
            RRule::parseString($this->recurrence_rule),
            ['dtstart' => $this->start_datetime, 'until' => $end]
        ));

        return iterator_to_array($rule);
    }

}
