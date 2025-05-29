<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public const STATUS_PENDING  = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = ['name', 'status'];

    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
