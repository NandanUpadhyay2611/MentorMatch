<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MentorshipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(MentorshipRequest $mentorshipRequest)
    {
        $this->authorize('view', $mentorshipRequest);

        $messages = $mentorshipRequest->messages()
            ->with('sender')
            ->orderBy('created_at')
            ->get();

        // Mark unread messages as read
        $mentorshipRequest->messages()
            ->where('to_user_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('messages.index', compact('mentorshipRequest', 'messages'));
    }

    public function store(Request $request, MentorshipRequest $mentorshipRequest)
    {
        $this->authorize('message', $mentorshipRequest);

        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $user = Auth::user();
        $toUserId = $user->id === $mentorshipRequest->startup_id 
            ? $mentorshipRequest->mentor_id 
            : $mentorshipRequest->startup_id;

        $message = Message::create([
            'mentorship_request_id' => $mentorshipRequest->id,
            'from_user_id' => $user->id,
            'to_user_id' => $toUserId,
            'body' => $validated['body'],
        ]);

        return back()->with('success', 'Message sent successfully!');
    }
} 