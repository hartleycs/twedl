<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventType;
use App\Models\EventSubType;
use Illuminate\Http\Request;

class EventSubTypeController extends Controller
{
    /**
     * Show list of sub-types for a given type.
     */
    public function index(EventType $eventType)
    {
        $subs = $eventType->subTypes()->orderBy('name')->get();
        return view('admin.event-sub-types.index', compact('eventType','subs'));
    }

    /**
     * Show form to create a new sub-type.
     */
    public function create(EventType $eventType)
    {
        return view('admin.event-sub-types.create', compact('eventType'));
    }

    /**
     * Store a newly created sub-type.
     */
    public function store(Request $request, EventType $eventType)
    {
        $request->validate([
            'name' => "required|unique:event_sub_types,name,NULL,id,event_type_id,{$eventType->id}"
        ]);

        $eventType->subTypes()->create($request->only('name'));

        return redirect()
            ->route('admin.event-types.sub-types.index', $eventType)
            ->with('success', 'Sub-type added.');
    }

    /**
     * Show form to edit an existing sub-type.
     */
    public function edit(EventType $eventType, EventSubType $subType)
    {
        return view('admin.event-sub-types.edit', compact('eventType','subType'));
    }

    /**
     * Update the specified sub-type.
     */
    public function update(Request $request, EventType $eventType, EventSubType $subType)
    {
        $request->validate([
            'name' => "required|unique:event_sub_types,name,{$subType->id},id,event_type_id,{$eventType->id}"
        ]);

        $subType->update($request->only('name'));

        return redirect()
            ->route('admin.event-types.sub-types.index', $eventType)
            ->with('success', 'Sub-type updated.');
    }

    /**
     * Delete a sub-type.
     */
    public function destroy(EventType $eventType, EventSubType $subType)
    {
        $subType->delete();

        return redirect()
            ->route('admin.event-types.sub-types.index', $eventType)
            ->with('success', 'Sub-type deleted.');
    }
}
