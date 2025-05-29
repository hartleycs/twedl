<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function index()
    {
        $pendingEvents = Event::where('status', 'N')->with('user')->latest()->get();
        return view('admin.events.index', compact('pendingEvents'));
    }

    public function approve(Event $event)
    {
        $event->update([
            'status' => 'V',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Event approved.');
    }

    public function reject(Event $event)
    {
        $event->update([
            'status' => 'VF',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Event rejected.');
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

}
