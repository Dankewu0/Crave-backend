<?php

namespace App\Events;

use App\Models\TicketMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class TicketMessageCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public TicketMessage $message;

    public function __construct(TicketMessage $message)
    {
        $this->message = $message;
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel("ticket." . $this->message->ticket_id);
    }

    public function broadcastWith(): array
    {
        return [
            "id" => $this->message->id,
            "user_id" => $this->message->user_id,
            "content" => $this->message->content,
            "created_at" => $this->message->created_at->toDateTimeString(),
        ];
    }
}
