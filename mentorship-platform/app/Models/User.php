<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_STARTUP = 'startup';
    const ROLE_MENTOR = 'mentor';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'mentor_tag');
    }

    public function mentorshipRequestsAsMentor(): HasMany
    {
        return $this->hasMany(MentorshipRequest::class, 'mentor_id');
    }

    public function mentorshipRequestsAsStartup(): HasMany
    {
        return $this->hasMany(MentorshipRequest::class, 'startup_id');
    }

    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'to_user_id');
    }

    public function isMentor()
    {
        return $this->role === self::ROLE_MENTOR;
    }

    public function isStartup()
    {
        return $this->role === self::ROLE_STARTUP;
    }
}
