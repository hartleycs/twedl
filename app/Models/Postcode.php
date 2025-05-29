<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    // if you didn’t already set $table = 'postcodes', Laravel will
    // infer it from the class name (Postcode → postcodes) correctly.

    protected $fillable = [
        'state_code',
        'postcode',
    ];
}
