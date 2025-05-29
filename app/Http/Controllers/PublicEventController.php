<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventType;

class PublicEventController extends Controller
{
    public function index(Request $request)
    {
        // Base query: only approved/live events
        $query = Event::query()->where('status', 'A');

        // Pull all event types for the filter dropdown
        $eventTypes = EventType::orderBy('name')->get();
        $eventSubTypes = collect();

        // Event type filter
        if ($request->filled('type')) {
            $query->where('event_type_id', $request->type);
            $eventSubTypes = EventType::findOrFail($request->type)
                ->subTypes()
                ->orderBy('name')
                ->get();
        }

        // Sub-type filter
        if ($request->filled('subtype')) {
            $query->where('event_sub_type_id', $request->subtype);
        }

        // Date range filters
        if ($request->filled('from')) {
            $query->whereDate('start_datetime', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('end_datetime', '<=', $request->to);
        }

        // Location radius filter (Haversine formula)
        if ($request->filled('lat') && $request->filled('lng') && $request->filled('radius')) {
            $lat = $request->lat;
            $lng = $request->lng;
            $radius = $request->radius;

            $haversine = "(6371 * acos(
                cos(radians(?)) * cos(radians(latitude)) *
                cos(radians(longitude) - radians(?)) +
                sin(radians(?)) * sin(radians(latitude))
            ))";

            $query->select('*')
                ->selectRaw("$haversine AS distance", [$lat, $lng, $lat])
                ->having('distance', '<=', $radius)
                ->orderBy('distance');
        } else {
            $query->orderBy('start_datetime', 'asc');
        }

        // Audience type filter
        if ($request->filled('audience_type')) {
            $query->where('audience_type', $request->audience_type);
        }

        if ($request->filled('city')) {
            $query->city($request->city); // This uses the scopeCity() on your Event model
        }

        // Paginate results
        $events = $query->paginate(12)->withQueryString();

        // List of selectable audience types
        $audienceTypes = ['Adults', 'Families', 'Kids', 'Students', 'Professionals', 'All Ages'];

        return view('public.events.index', compact(
            'events', 'eventTypes', 'eventSubTypes', 'audienceTypes'
        ));
    }
}
