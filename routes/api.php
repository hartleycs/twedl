<?php

use Illuminate\Support\Facades\Route;
use App\Models\EventType;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Event Type → Sub-Type
Route::get('event-types/{type}/sub-types', function (EventType $type) {
    return $type->subTypes()
                ->select('id', 'name')
                ->orderBy('name')
                ->get();
});
