<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventInvitation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use App\Models\Tag;

class EventController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the user's events.
     */
    public function index()
    {
        $events = Event::where('user_id', auth()->id())
                       ->latest()
                       ->get();

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        $eventTypes = EventType::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        $availableTags = \App\Models\Tag::where('status', 'approved')->orderBy('name')->get();

        return view('events.create', compact('eventTypes', 'countries', 'availableTags'));
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'description'          => 'nullable|string',
            'event_type_id'        => 'required|exists:event_types,id',
            'event_sub_type_id'    => [
                'nullable',
                Rule::exists('event_sub_types','id')
                    ->where(fn($q) => $q->where('event_type_id', $request->input('event_type_id'))),
            ],
            'start_datetime'       => 'required|date',
            'end_datetime'         => 'required|date|after_or_equal:start_datetime',
            'appearance_datetime'  => 'nullable|date',
            'takedown_datetime'    => 'nullable|date|after:start_datetime',
            'recurrence_rule'      => 'nullable|string',
            'venue_name'           => 'nullable|string|max:255',
            'address_line_1'       => 'required|string|max:255',
            'address_line_2'       => 'nullable|string|max:255',
            'town'                 => 'nullable|string|max:100',
            'city'                 => 'nullable|string|max:100',
            'state'                => 'nullable|string|max:100',
            'postcode'             => 'nullable|string|max:20',
            'country'              => 'required|string|max:2',
            'landmark_description' => 'nullable|string|max:1000',
            'latitude'             => 'nullable|numeric|between:-90,90',
            'longitude'            => 'nullable|numeric|between:-180,180',
            'website_url'          => 'nullable|url|max:255',
            'is_free'              => 'nullable|boolean',
            'ticket_labels'        => 'nullable|array',
            'ticket_labels.*'      => 'nullable|string|max:100',
            'ticket_prices'        => 'nullable|array',
            'ticket_prices.*'      => 'nullable|numeric|min:0',
            'currency'             => 'required|string|max:3',
            'visibility'           => 'required|in:public,private',
            'audience_type'        => ['nullable', 'in:Adults,Families,Kids,Students,Professionals,All Ages'],
            'invitees'             => 'nullable|string',
            'max_attendees'        => 'nullable|integer|min:1',
            'booking_url'          => 'nullable|url|max:255',
            'language'             => 'nullable|string|max:100',
            'image'                => 'nullable|image|max:4096',
        ]);

        $validated['user_id']  = auth()->id();
        $validated['is_free']  = $request->has('is_free');
        $validated['status']   = 'N';

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('event-images', 'public');
        }

        if ($request->filled('invitees')) {
            $emails = array_map('trim', explode(',', $request->input('invitees')));
            $validated['invitees'] = json_encode($emails);
        }

        // Pricing logic
        $labels = $request->input('ticket_labels', []);
        $prices = $request->input('ticket_prices', []);
        $pricing = [];

        foreach ($labels as $i => $label) {
            if (!empty($label) && isset($prices[$i])) {
                $pricing[] = [
                    'label' => $label,
                    'price' => $prices[$i]
                ];
            }
        }

        $validated['ticket_prices'] = json_encode($pricing);

        // Create the event *without* tags
        $event = Event::create(collect($validated)->except('tags')->toArray());

        // Attach tags (skip rejected ones)
        $tagIds = collect($request->input('tags', []))->map(function ($tagName) {
            $tag = \App\Models\Tag::firstOrCreate(
                ['name' => trim($tagName)],
                ['status' => \App\Models\Tag::STATUS_PENDING]
            );

            return $tag->status === \App\Models\Tag::STATUS_REJECTED ? null : $tag->id;
        })->filter()->toArray();

        $event->tags()->sync($tagIds);


        return redirect()->route('dashboard')->with('success', 'Event submitted for review.');
    }    

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        $eventTypes = EventType::orderBy('name')->get();

        return view('events.edit', compact('event', 'eventTypes'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'description'          => 'nullable|string',
            'event_type_id'        => 'required|exists:event_types,id',
            'event_sub_type_id'    => [
                'nullable',
                Rule::exists('event_sub_types','id')
                    ->where(fn($q) => $q->where('event_type_id', $request->input('event_type_id'))),
            ],
            'start_datetime'       => 'required|date',
            'end_datetime'         => 'required|date|after_or_equal:start_datetime',
            'appearance_datetime'  => 'nullable|date',
            'takedown_datetime'    => 'nullable|date|after:start_datetime',
            'recurrence_rule'      => 'nullable|string',

            'venue_name'           => 'nullable|string|max:255',
            'address_line_1'       => 'required|string|max:255',
            'address_line_2'       => 'nullable|string|max:255',
            'town'                 => 'nullable|string|max:100',
            'city'                 => 'nullable|string|max:100',
            'state'                => 'nullable|string|max:100',
            'postcode'             => 'nullable|string|max:20',
            'country'              => 'required|string|max:2',
            'landmark_description' => 'nullable|string|max:1000',
            'latitude'             => 'nullable|numeric|between:-90,90',
            'longitude'            => 'nullable|numeric|between:-180,180',
            'category'             => 'nullable|string|max:50',
            'website_url'          => 'nullable|url|max:255',
            'is_free'              => 'nullable|boolean',
            'ticket_labels'        => 'nullable|array',
            'ticket_labels.*'      => 'nullable|string|max:100',
            'ticket_prices'        => 'nullable|array',
            'ticket_prices.*'      => 'nullable|numeric|min:0',
            'currency'             => 'required|string|max:3',
            'visibility'           => 'required|in:public,private',
            'audience_type'        => ['nullable', 'in:Adults,Families,Kids,Students,Professionals,All Ages'],
            'invitees'             => 'nullable|string',
            'age_restricted'       => 'nullable|boolean',
            'accessibility_info'   => 'nullable|string|max:1000',
            'max_attendees'        => 'nullable|integer|min:1',
            'booking_url'          => 'nullable|url|max:255',
            'language'             => 'nullable|string|max:100',
            'image'                => 'nullable|image|max:4096',
        ]);

        $validated['is_free']        = $request->has('is_free');
        $validated['age_restricted'] = $request->has('age_restricted');
        $validated['status']         = 'N';
        $validated['currency']       = $request->input('currency');

        // handle new image
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')
                                               ->store('event-images','public');
        }

        // invitees
        if ($request->filled('invitees')) {
            $emails = array_map('trim', explode(',', $request->input('invitees')));
            $validated['invitees'] = json_encode($emails);
        } else {
            $validated['invitees'] = null;
        }

        // Update event without touching tags directly
        $event->update(collect($validated)->except('tags')->toArray());

        // Re-attach tags
        $tagIds = collect($request->input('tags', []))->map(function ($tagName) {
            $tag = \App\Models\Tag::firstOrCreate(
                ['name' => trim($tagName)],
                ['status' => \App\Models\Tag::STATUS_PENDING]
            );

            return $tag->status === \App\Models\Tag::STATUS_REJECTED ? null : $tag->id;
        })->filter()->toArray();

        $event->tags()->sync($tagIds);

        
        return redirect()
            ->route('events.index')
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', 'Event deleted.');
    }
}
