<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatMessageReceived implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    public $message;
    public $receivedAt;
    public $senderName;

    /**
     * Create a new event instance.
     *
     */
    public function __construct($senderName, $message)
    {
        $this->message = $message;
        $this->senderName = $senderName;
        $this->receivedAt = Carbon::now()->toW3cString();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat-channel');
    }
}
