<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagModerationController extends Controller
{
    public function index()
    {
        $tags = Tag::where('status', 'pending')
            ->withCount('events')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.tags.index', compact('tags'));
    }

    public function approve(Tag $tag)
    {
        $tag->update(['status' => 'approved']);
        return redirect()->back()->with('success', "Tag '{$tag->name}' approved.");
    }

    public function reject(Tag $tag)
    {
        $tag->update(['status' => 'rejected']);
        return redirect()->back()->with('success', "Tag '{$tag->name}' rejected.");
    }

    public function batchApprove(Request $request)
    {
        $ids = $request->input('tag_ids', []);
        Tag::whereIn('id', $ids)->update(['status' => 'approved']);

        return redirect()->back()->with('success', count($ids) . ' tag(s) approved.');
    }

    public function batchReject(Request $request)
    {
        $ids = $request->input('tag_ids', []);
        Tag::whereIn('id', $ids)->update(['status' => 'rejected']);

        return redirect()->back()->with('success', count($ids) . ' tag(s) rejected.');
    }
}
