<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventVettingController extends Controller
{
    /**
     * Display a listing of the pending events.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $events = Event::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for reviewing a specific event.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\View\View
     */
    public function review(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * Approve the specified event.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Event $event)
    {
        $event->status = 'approved';
        $event->save();
        
        return redirect()->route('admin.events.pending')
            ->with('success', 'Event has been approved successfully.');
    }

    /**
     * Reject the specified event.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(Event $event)
    {
        $event->status = 'rejected';
        $event->save();
        
        return redirect()->route('admin.events.pending')
            ->with('success', 'Event has been rejected.');
    }
}
