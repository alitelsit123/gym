<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;

    /**
     * Create a new event instance.
     */
    public function __construct($chat)
    {
      $this->chat = $chat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    /**
   * The event's broadcast name.
    */
    public function broadcastAs(): string
    {
        return 'chat.receive';
    }
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.'.$this->chat->receiver_id),
        ];
    }
    public function broadcastWith(): array
    {
        return ['data' => $this->chat];
    }
}
