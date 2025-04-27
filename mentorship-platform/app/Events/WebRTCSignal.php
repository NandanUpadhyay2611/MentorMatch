<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WebRTCSignal implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $type;
    public $data;
    public $fromUserId;
    public $toUserId;
    public $mentorshipRequestId;

    public function __construct($type, $data, $fromUserId, $toUserId, $mentorshipRequestId)
    {
        $this->type = $type;
        $this->data = $data;
        $this->fromUserId = $fromUserId;
        $this->toUserId = $toUserId;
        $this->mentorshipRequestId = $mentorshipRequestId;
    }

    public function broadcastOn()
    {
        return new PresenceChannel('video-call.' . $this->mentorshipRequestId);
    }

    public function broadcastAs()
    {
        return 'webrtc.signal';
    }
} 