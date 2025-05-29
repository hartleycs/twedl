<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Mail\EventApproved;
use App\Mail\EventRejected;
use Illuminate\Support\Facades\Mail;

class EventVettingController extends Controller
{
    public function index()
    {
        $pendingEvents = Event::where('status', 'N')->latest()->get();
        return view('admin.vetting.index', compact('pendingEvents'));
    }

    public function approve(Request $request, Event $event)
    {
        $event->update([
            'status'          => 'V',
            'reviewed_by'     => auth()->id(),
            'reviewed_at'     => now(),
            'vetting_comments'=> $request->input('vetting_comments'),
        ]);

        // Notify owner
        Mail::to($event->user->email)
            ->send(new EventApproved($event));

        return redirect()
            ->route('admin.vetting.index')
            ->with('success', 'Event approved.');
    }

    public function reject(Request $request, Event $event)
    {
        $data = $request->validate([
            'vetting_comments' => 'required|string|max:2000',
        ]);

        $event->update([
            'status'          => 'VF',
            'reviewed_by'     => auth()->id(),
            'reviewed_at'     => now(),
            'vetting_comments'=> $data['vetting_comments'],
        ]);

        // Notify owner
        Mail::to($event->user->email)
            ->send(new EventRejected($event));

        return redirect()
            ->route('admin.vetting.index')
            ->with('success', 'Event rejected.');
    }
}
