<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class AdminTagController extends Controller
{
    public function index()
    {
        $tags = Tag::where('status', Tag::STATUS_PENDING)
            ->withCount('events')
            ->get();

        return view('admin.tags.index', compact('tags'));
    }

    public function approve(Tag $tag)
    {
        $tag->update(['status' => Tag::STATUS_APPROVED]);

        return redirect()->back()->with('success', 'Tag approved.');
    }

    public function reject(Tag $tag)
    {
        $tag->update(['status' => Tag::STATUS_REJECTED]);

        return redirect()->back()->with('success', 'Tag rejected.');
    }

    public function bulk(Request $request)
    {
        $ids = $request->input('selected_tags', []);
        $action = $request->input('action');

        if ($action === 'approve') {
            Tag::whereIn('id', $ids)->update(['status' => Tag::STATUS_APPROVED]);
        } elseif ($action === 'reject') {
            Tag::whereIn('id', $ids)->update(['status' => Tag::STATUS_REJECTED]);
        }

        return redirect()->back()->with('success', 'Tags updated.');
    }
}
