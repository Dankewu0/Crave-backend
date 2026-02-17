<?php

namespace App\Services;

use App\Models\Conversation;
use Illuminate\Database\Eloquent\Collection;

class ConversationService
{
    public function getAllConversations(): Collection
    {
        return Conversation::with(["user", "support"])
            ->orderByDesc("last_message_at")
            ->get();
    }

    public function createConversation(array $data): Conversation
    {
        return Conversation::create($data);
    }

    public function getConversation(Conversation $conversation): Conversation
    {
        return $conversation->load(["messages.sender", "user", "support"]);
    }

    public function updateConversation(
        Conversation $conversation,
        array $data,
    ): Conversation {
        $conversation->update($data);
        return $conversation;
    }

    public function deleteConversation(Conversation $conversation): bool
    {
        return $conversation->delete();
    }
}
