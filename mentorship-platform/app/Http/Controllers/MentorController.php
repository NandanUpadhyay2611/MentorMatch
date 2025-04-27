<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = User::where('role', 'mentor')
            ->whereHas('profile', function ($query) {
                $query->where('availability', true);
            })
            ->with('profile')
            ->latest()
            ->paginate(12);

        return view('mentors.index', compact('mentors'));
    }

    public function show(User $mentor)
    {
        if ($mentor->role !== 'mentor') {
            abort(404);
        }

        return view('mentors.show', compact('mentor'));
    }
} 