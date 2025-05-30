<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventSubTypeController extends Controller
{
    /**
     * Display a listing of the event sub-types for a specific event type.
     *
     * @param  int  $eventTypeId
     * @return \Illuminate\View\View
     */
    public function index($eventTypeId)
    {
        // In a real implementation, you would fetch the event type and its sub-types
        $eventType = null;
        $subTypes = [];
        
        return view('admin.event-sub-types.index', compact('eventType', 'subTypes'));
    }

    /**
     * Show the form for creating a new event sub-type.
     *
     * @param  int  $eventTypeId
     * @return \Illuminate\View\View
     */
    public function create($eventTypeId)
    {
        // In a real implementation, you would fetch the event type
        $eventType = null;
        
        return view('admin.event-sub-types.create', compact('eventType'));
    }

    /**
     * Store a newly created event sub-type in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $eventTypeId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $eventTypeId)
    {
        // In a real implementation, you would validate and store the event sub-type
        
        return redirect()->route('admin.event-types.sub-types.index', $eventTypeId)
            ->with('success', 'Event sub-type created successfully.');
    }

    /**
     * Show the form for editing the specified event sub-type.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // In a real implementation, you would fetch the event sub-type
        $subType = null;
        
        return view('admin.event-sub-types.edit', compact('subType'));
    }

    /**
     * Update the specified event sub-type in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // In a real implementation, you would validate and update the event sub-type
        
        // Assuming we have a way to get the event type ID
        $eventTypeId = 1;
        
        return redirect()->route('admin.event-types.sub-types.index', $eventTypeId)
            ->with('success', 'Event sub-type updated successfully.');
    }

    /**
     * Remove the specified event sub-type from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // In a real implementation, you would delete the event sub-type
        
        // Assuming we have a way to get the event type ID
        $eventTypeId = 1;
        
        return redirect()->route('admin.event-types.sub-types.index', $eventTypeId)
            ->with('success', 'Event sub-type deleted successfully.');
    }
}
