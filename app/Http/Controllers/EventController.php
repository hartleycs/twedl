<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventInvitation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\EventService;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    use AuthorizesRequests;
    
    protected $eventService;
    
    /**
     * Create a new controller instance.
     *
     * @param EventService $eventService
     */
    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the user's events.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Add eager loading for relationships and pagination
        $events = Event::with(['eventType', 'eventSubType', 'tags'])
                       ->where('user_id', auth()->id())
                       ->latest()
                       ->paginate(10);

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Cache frequently accessed data
        $eventTypes = Cache::remember('event_types', 3600, function () {
            return EventType::orderBy('name')->get();
        });
        
        $countries = Cache::remember('countries', 3600, function () {
            return Country::orderBy('name')->get();
        });
        
        $availableTags = Cache::remember('approved_tags', 3600, function () {
            return \App\Models\Tag::where('status', 'approved')->orderBy('name')->get();
        });

        return view('events.create', compact('eventTypes', 'countries', 'availableTags'));
    }

    /**
     * Store a newly created event in storage.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->eventService->createEvent($request);
        
        return redirect()->route('dashboard')->with('success', 'Event submitted for review.');
    }    

    /**
     * Show the form for editing the specified event.
     * 
     * @param Event $event
     * @return \Illuminate\View\View
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        // Eager load relationships to avoid N+1 queries
        $event->load(['eventType', 'eventSubType', 'tags']);

        // Cache frequently accessed data
        $eventTypes = Cache::remember('event_types', 3600, function () {
            return EventType::orderBy('name')->get();
        });

        return view('events.edit', compact('event', 'eventTypes'));
    }

    /**
     * Update the specified event in storage.
     * 
     * @param Request $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);
        
        $this->eventService->updateEvent($event, $request);
        
        return redirect()
            ->route('events.index')
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified event from storage.
     * 
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $this->eventService->deleteEvent($event);

        return redirect()
            ->route('events.index')
            ->with('success', 'Event deleted.');
    }
}
