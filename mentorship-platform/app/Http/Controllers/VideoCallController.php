<?php

namespace App\Http\Controllers;

use App\Models\MentorshipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoCallController extends Controller
{
    public function index(MentorshipRequest $mentorshipRequest)
    {
        $this->authorize('view', $mentorshipRequest);
        
        $currentUser = Auth::user();
        $otherUserId = $currentUser->id === $mentorshipRequest->mentor_id 
            ? $mentorshipRequest->startup_id 
            : $mentorshipRequest->mentor_id;
        
        return view('video-call.index', [
            'mentorshipRequestId' => $mentorshipRequest->id,
            'otherUserId' => $otherUserId
        ]);
    }

    public function signal(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:offer,answer,candidate',
            'data' => 'required',
            'to_user_id' => 'required|exists:users,id',
            'mentorship_request_id' => 'required|exists:mentorship_requests,id'
        ]);

        // Broadcast the signal to the other peer
        broadcast(new \App\Events\WebRTCSignal(
            $validated['type'],
            $validated['data'],
            Auth::id(),
            $validated['to_user_id'],
            $validated['mentorship_request_id']
        ))->toOthers();

        return response()->json(['status' => 'success']);
    }
} 