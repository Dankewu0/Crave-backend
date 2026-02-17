<?php

namespace App\Services;

use App\Models\TicketMessage;
use Illuminate\Database\Eloquent\Collection;

class TicketMessageService
{
    public function getAllMessages(): Collection
    {
        return TicketMessage::with(["sender", "ticket"])
            ->orderByDesc("created_at")
            ->get();
    }

    public function createMessage(array $data): TicketMessage
    {
        return TicketMessage::create($data);
    }

    public function getMessage(TicketMessage $message): TicketMessage
    {
        return $message->load(["sender", "ticket"]);
    }

    public function updateMessage(
        TicketMessage $message,
        array $data,
    ): TicketMessage {
        $message->update($data);
        return $message;
    }

    public function deleteMessage(TicketMessage $message): bool
    {
        return $message->delete();
    }
}
