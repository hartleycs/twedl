<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the event types.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // In a real implementation, you would fetch event types from the database
        $eventTypes = [];
        
        return view('admin.event-types.index', compact('eventTypes'));
    }

    /**
     * Show the form for creating a new event type.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.event-types.create');
    }

    /**
     * Store a newly created event type in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // In a real implementation, you would validate and store the event type
        
        return redirect()->route('admin.event-types.index')
            ->with('success', 'Event type created successfully.');
    }

    /**
     * Show the form for editing the specified event type.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // In a real implementation, you would fetch the event type from the database
        $eventType = null;
        
        return view('admin.event-types.edit', compact('eventType'));
    }

    /**
     * Update the specified event type in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // In a real implementation, you would validate and update the event type
        
        return redirect()->route('admin.event-types.index')
            ->with('success', 'Event type updated successfully.');
    }

    /**
     * Remove the specified event type from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // In a real implementation, you would delete the event type
        
        return redirect()->route('admin.event-types.index')
            ->with('success', 'Event type deleted successfully.');
    }
}
