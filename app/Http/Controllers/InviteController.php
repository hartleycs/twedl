<?php

namespace App\Http\Controllers;
use App\Models\EventInvite;

class InviteController extends Controller
{
    public function show($token)
    {
        $invite = EventInvite::where('token',$token)->firstOrFail();
        // mark as accepted if not yet
        if (!$invite->accepted_at) {
            $invite->update(['accepted_at'=>now()]);
        }
        // show the event details view (reuse public template or make a private one)
        return view('invites.show', ['event'=>$invite->event]);
    }
}
