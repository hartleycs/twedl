<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    // if your table is named `countries`, you don't need to override $table
    protected $fillable = [
        'iso_code', // e.g. "US"
        'code',     // duplicate if needed, but you probably only need one of these
        'name',     // e.g. "United States"
    ];

    /**
     * A country has many states.
     */
    public function states(): HasMany
    {
        // make sure you have an App\Models\State class
        return $this->hasMany(State::class, 'country_code', 'iso_code');
    }
}
