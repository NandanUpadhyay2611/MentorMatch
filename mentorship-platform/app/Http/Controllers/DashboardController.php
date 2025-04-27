<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MentorshipRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'mentor') {
            $pendingRequests = MentorshipRequest::where('mentor_id', $user->id)
                ->where('status', 'pending')
                ->with('startup')
                ->latest()
                ->get();

            $upcomingSessions = MentorshipRequest::where('mentor_id', $user->id)
                ->where('status', 'accepted')
                ->whereNotNull('confirmed_time')
                ->where('confirmed_time', '>', now())
                ->with('startup')
                ->orderBy('confirmed_time')
                ->get();

            return view('dashboard', compact('pendingRequests', 'upcomingSessions'));
        } else {
            $myRequests = MentorshipRequest::where('startup_id', $user->id)
                ->with('mentor')
                ->latest()
                ->get();

            $availableMentors = User::where('role', 'mentor')
                ->whereHas('profile', function ($query) {
                    $query->where('availability', true);
                })
                ->with('profile')
                ->latest()
                ->take(6)
                ->get();

            return view('dashboard', compact('myRequests', 'availableMentors'));
        }
    }
} 