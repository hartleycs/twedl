<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    protected $fillable = [
        'country_code',   // e.g. "US"
        'iso_3166_2',     // e.g. "US-CA"
        'name',           // e.g. "California"
    ];

    /**
     * State belongs to a country.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_code', 'iso_code');
    }

    /**
     * If you have a Postcode model/table:
     */
    public function postcodes(): HasMany
    {
        return $this->hasMany(Postcode::class, 'state_code', 'iso_3166_2');
    }
}
