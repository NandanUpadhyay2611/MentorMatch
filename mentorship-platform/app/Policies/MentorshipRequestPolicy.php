<?php

namespace App\Policies;

use App\Models\MentorshipRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MentorshipRequestPolicy
{
    use HandlesAuthorization;

    public function view(User $user, MentorshipRequest $mentorshipRequest)
    {
        return $user->id === $mentorshipRequest->startup_id || 
               $user->id === $mentorshipRequest->mentor_id;
    }

    public function create(User $user)
    {
        return $user->role === 'startup';
    }

    public function update(User $user, MentorshipRequest $mentorshipRequest)
    {
        return $user->id === $mentorshipRequest->mentor_id && 
               $mentorshipRequest->status === 'pending';
    }

    public function message(User $user, MentorshipRequest $mentorshipRequest)
    {
        return $this->view($user, $mentorshipRequest) && 
               $mentorshipRequest->status !== 'rejected';
    }
} 