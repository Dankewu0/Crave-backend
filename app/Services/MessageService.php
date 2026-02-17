<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class MessageService
{
    public function getAllMessages(): Collection
    {
        return Message::with(["sender", "conversation"])
            ->orderByDesc("created_at")
            ->get();
    }

    public function createMessage(array $data): Message
    {
        return Message::create($data);
    }

    public function getMessage(Message $message): Message
    {
        return $message->load(["sender", "conversation"]);
    }

    public function updateMessage(Message $message, array $data): Message
    {
        $message->update($data);
        return $message;
    }

    public function deleteMessage(Message $message): bool
    {
        return $message->delete();
    }
}
