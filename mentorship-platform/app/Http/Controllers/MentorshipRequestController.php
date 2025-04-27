<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MentorshipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MentorshipRequestController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->role === 'mentor' 
            ? MentorshipRequest::where('mentor_id', $user->id)
            : MentorshipRequest::where('startup_id', $user->id);

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $requests = $query->with(['startup', 'mentor', 'messages'])->latest()->get();

        // If view=messages is specified, show the messages view
        if ($request->view === 'messages') {
            return view('messages.index', compact('requests'));
        }

        return view('mentorship-requests.index', compact('requests'));
    }

    public function create()
    {
        $this->authorize('create', MentorshipRequest::class);

        $mentors = User::where('role', 'mentor')
            ->whereHas('profile', function ($query) {
                $query->where('availability', true);
            })
            ->with('profile')
            ->get();

        $selectedMentorId = request('mentor_id');
        $selectedMentor = $selectedMentorId ? User::findOrFail($selectedMentorId) : null;

        return view('mentorship-requests.create', compact('mentors', 'selectedMentor'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', MentorshipRequest::class);

        $validated = $request->validate([
            'mentor_id' => 'required|exists:users,id',
            'topic' => 'required|string|max:255',
            'message' => 'required|string',
            'proposed_time' => 'required|date|after:now',
        ]);

        $mentorshipRequest = MentorshipRequest::create([
            'startup_id' => Auth::id(),
            'mentor_id' => $validated['mentor_id'],
            'topic' => $validated['topic'],
            'message' => $validated['message'],
            'proposed_time' => $validated['proposed_time'],
            'status' => 'pending',
        ]);

        return redirect()->route('mentorship-requests.show', $mentorshipRequest)
            ->with('success', 'Mentorship request sent successfully!');
    }

    public function show(MentorshipRequest $mentorshipRequest)
    {
        $this->authorize('view', $mentorshipRequest);
        
        $mentorshipRequest->load(['startup', 'mentor', 'messages.sender']);
        
        return view('mentorship-requests.show', compact('mentorshipRequest'));
    }

    public function update(Request $request, MentorshipRequest $mentorshipRequest)
    {
        $this->authorize('update', $mentorshipRequest);

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected',
            'confirmed_time' => 'required_if:status,accepted|nullable|date|after:now',
        ]);

        $mentorshipRequest->update([
            'status' => $validated['status'],
            'confirmed_time' => $validated['status'] === 'accepted' ? $validated['confirmed_time'] : null,
        ]);

        $message = $validated['status'] === 'accepted' 
            ? 'Mentorship request accepted successfully!'
            : 'Mentorship request rejected.';

        return redirect()->route('mentorship-requests.show', $mentorshipRequest)
            ->with('success', $message);
    }
} 