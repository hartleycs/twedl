<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Cache;
use App\Repositories\EventRepository;

class EventService
{
    protected $imageController;
    protected $eventRepository;
    
    /**
     * Create a new service instance.
     *
     * @param ImageController $imageController
     * @param EventRepository $eventRepository
     */
    public function __construct(ImageController $imageController, EventRepository $eventRepository)
    {
        $this->imageController = $imageController;
        $this->eventRepository = $eventRepository;
    }
    
    /**
     * Create a new event from request data
     *
     * @param Request $request
     * @return Event
     */
    public function createEvent(Request $request): Event
    {
        $validated = $this->validateEventData($request);
        
        $validated['user_id'] = auth()->id();
        $validated['is_free'] = $request->has('is_free');
        $validated['status'] = Event::STATUS_PENDING;
        
        // Process image if present
        if ($request->hasFile('image')) {
            $validated['image_path'] = $this->imageController->processImage($request);
        }
        
        // Process invitees
        if ($request->filled('invitees')) {
            $validated['invitees'] = $this->processInvitees($request);
        }
        
        // Process ticket pricing
        $validated['ticket_prices'] = $this->processTicketPricing($request);
        
        // Create the event without tags using repository
        $event = $this->eventRepository->create(collect($validated)->except('tags')->toArray());
        
        // Process and attach tags
        $this->processTags($event, $request);
        
        // Clear relevant caches
        Cache::forget('user_events_' . auth()->id());
        
        return $event;
    }
    
    /**
     * Update an existing event from request data
     *
     * @param Event $event
     * @param Request $request
     * @return Event
     */
    public function updateEvent(Event $event, Request $request): Event
    {
        $validated = $this->validateEventData($request);
        
        $validated['is_free'] = $request->has('is_free');
        $validated['age_restricted'] = $request->has('age_restricted');
        $validated['status'] = Event::STATUS_PENDING;
        $validated['currency'] = $request->input('currency');
        
        // Process image if present
        if ($request->hasFile('image')) {
            $validated['image_path'] = $this->imageController->processImage($request);
        }
        
        // Process invitees
        if ($request->filled('invitees')) {
            $validated['invitees'] = $this->processInvitees($request);
        } else {
            $validated['invitees'] = null;
        }
        
        // Update event without touching tags using repository
        $this->eventRepository->update($event, collect($validated)->except('tags')->toArray());
        
        // Process and attach tags
        $this->processTags($event, $request);
        
        // Clear relevant caches
        Cache::forget('user_events_' . auth()->id());
        
        return $event;
    }
    
    /**
     * Delete an event
     *
     * @param Event $event
     * @return void
     */
    public function deleteEvent(Event $event): void
    {
        $this->eventRepository->delete($event);
    }
    
    /**
     * Validate event data from request
     *
     * @param Request $request
     * @return array
     */
    protected function validateEventData(Request $request): array
    {
        return $request->validate([
            'name'                 => 'required|string|max:255',
            'description'          => 'nullable|string',
            'event_type_id'        => 'required|exists:event_types,id',
            'event_sub_type_id'    => [
                'nullable',
                \Illuminate\Validation\Rule::exists('event_sub_types','id')
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
            'age_restricted'       => 'nullable|boolean',
            'accessibility_info'   => 'nullable|string|max:1000',
            'max_attendees'        => 'nullable|integer|min:1',
            'booking_url'          => 'nullable|url|max:255',
            'language'             => 'nullable|string|max:100',
            'image'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);
    }
    
    /**
     * Process invitees from request
     *
     * @param Request $request
     * @return string|null
     */
    protected function processInvitees(Request $request): ?string
    {
        $emails = array_map('trim', explode(',', $request->input('invitees')));
        
        // Validate all email addresses
        $emailValidator = Validator::make(['emails' => $emails], [
            'emails.*' => 'email',
        ]);
        
        if ($emailValidator->fails()) {
            return back()->withErrors(['invitees' => 'One or more email addresses are invalid'])->withInput();
        }
        
        return json_encode($emails);
    }
    
    /**
     * Process ticket pricing from request
     *
     * @param Request $request
     * @return string
     */
    protected function processTicketPricing(Request $request): string
    {
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
        
        return json_encode($pricing);
    }
    
    /**
     * Process and attach tags to an event
     *
     * @param Event $event
     * @param Request $request
     * @return void
     */
    protected function processTags(Event $event, Request $request): void
    {
        $tagIds = collect($request->input('tags', []))->map(function ($tagName) {
            $tag = Tag::firstOrCreate(
                ['name' => trim($tagName)],
                ['status' => Tag::STATUS_PENDING]
            );
            
            return $tag->status === Tag::STATUS_REJECTED ? null : $tag->id;
        })->filter()->toArray();
        
        $event->tags()->sync($tagIds);
    }
}
