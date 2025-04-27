<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'bio' => 'nullable|string|max:1000',
            'expertise' => 'nullable|string|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:100',
            'experience' => 'nullable|string|max:1000',
            'availability' => 'boolean',
        ]);

        $profile = $user->profile ?? new Profile();
        $profile->user_id = $user->id;
        $profile->bio = $request->bio;
        $profile->expertise = $request->expertise;
        $profile->skills = $request->skills;
        $profile->experience = $request->experience;
        $profile->availability = $request->availability ?? true;
        $profile->save();

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/');
    }
}
