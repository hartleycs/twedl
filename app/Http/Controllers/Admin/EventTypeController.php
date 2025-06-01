<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the event types.
     */
    public function index()
    {
        $types = EventType::orderBy('name')->get();
        return view('admin.event-types.index', compact('types'));
    }

    /**
     * Show the form for creating a new event type.
     */
    public function create()
    {
        return view('admin.event-types.create');
    }

    /**
     * Store a newly created event type.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:event_types,name',
        ]);

        EventType::create([
            'name' => $request->input('name'),
        ]);

        return redirect()
            ->route('admin.event-types.index')
            ->with('success', 'Event type added.');
    }

    /**
     * Show the form for editing the specified event type.
     */
    public function edit(EventType $eventType)
    {
        return view('admin.event-types.edit', compact('eventType'));
    }

    /**
     * Update the specified event type.
     */
    public function update(Request $request, EventType $eventType)
    {
        $request->validate([
            'name' => 'required|string|unique:event_types,name,' . $eventType->id,
        ]);

        $eventType->update([
            'name' => $request->input('name'),
        ]);

        return redirect()
            ->route('admin.event-types.index')
            ->with('success', 'Event type updated.');
    }

    /**
     * Remove the specified event type.
     */
    public function destroy(EventType $eventType)
    {
        $eventType->delete();

        return back()->with('success', 'Event type deleted.');
    }
}
