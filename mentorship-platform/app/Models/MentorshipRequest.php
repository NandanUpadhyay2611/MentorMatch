<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MentorshipRequest extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'startup_id',
        'mentor_id',
        'topic',
        'message',
        'status',
        'proposed_time',
        'confirmed_time',
    ];

    protected $casts = [
        'proposed_time' => 'datetime',
        'confirmed_time' => 'datetime',
    ];

    public function startup(): BelongsTo
    {
        return $this->belongsTo(User::class, 'startup_id');
    }

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
} 