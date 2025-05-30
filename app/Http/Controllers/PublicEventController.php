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
        $query = Event::query()->where('status', 'V');

        // Pull all event types for the filter dropdown
        $eventTypes = EventType::orderBy('name')->get();
        $eventSubTypes = collect();

        // If no filters submitted, show search screen only
        if (!$request->hasAny(['type', 'subtype', 'from', 'to', 'radius', 'lat', 'lng', 'city', 'audience_type'])) {
            return view('public.events.index', [
                'events' => collect(),
                'eventTypes' => $eventTypes,
                'eventSubTypes' => $eventSubTypes,
                'audienceTypes' => ['Adults', 'Families', 'Kids', 'Students', 'Professionals', 'All Ages'],
                'message' => 'Please apply filters and click Search to find events.',
            ]);
        }

        // Type filter
        if ($request->filled('type')) {
            $query->where('event_type_id', $request->type);
            $eventSubTypes = EventType::findOrFail($request->type)
                ->subTypes()
                ->orderBy('name')
                ->get();
        }

        // Subtype
        if ($request->filled('subtype')) {
            $query->where('event_sub_type_id', $request->subtype);
        }

        // Date filters
        if ($request->filled('from')) {
            $query->whereDate('start_datetime', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('end_datetime', '<=', $request->to);
        }

        // Radius filter
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

        // Audience type
        if ($request->filled('audience_type')) {
            $query->where('audience_type', $request->audience_type);
        }

        // City filter
        if ($request->filled('city')) {
            $query->city($request->city); // Uses scopeCity()
        }

        // Run query only if filters provided
        $events = $query->paginate(12)->withQueryString();

        return view('public.events.index', [
            'events' => $events,
            'eventTypes' => $eventTypes,
            'eventSubTypes' => $eventSubTypes,
            'audienceTypes' => ['Adults', 'Families', 'Kids', 'Students', 'Professionals', 'All Ages'],
            'message' => null,
        ]);
    }
}
