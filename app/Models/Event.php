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

    // Define status constants to replace magic strings
    public const STATUS_PENDING = 'N';
    public const STATUS_APPROVED = 'V';
    public const STATUS_REJECTED = 'VF';
    
    // Define visibility constants
    public const VISIBILITY_PUBLIC = 'public';
    public const VISIBILITY_PRIVATE = 'private';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
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

    /**
     * The attributes that should be guarded from mass assignment.
     *
     * @var array<string>
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
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

    /**
     * Get the tags associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the user that owns the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event type associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }

    /**
     * Get the event sub-type associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eventSubType(): BelongsTo
    {
        return $this->belongsTo(EventSubType::class, 'event_sub_type_id');
    }

    /**
     * Get the invites for the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invites(): HasMany
    {
        return $this->hasMany(EventInvite::class);
    }

    /**
     * Get the user who reviewed the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Scope a query to find events in a specific city
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $city
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCity($query, $city)
    {
        // Fixed SQL injection vulnerability by using parameter binding
        return $query->where('location_address', 'like', "%?%")->setBindings([$city]);
    }

    /**
     * Get event occurrences between two dates
     * 
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return array
     */
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
