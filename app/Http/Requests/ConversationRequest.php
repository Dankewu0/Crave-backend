<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Conversation;

class ConversationRequest extends FormRequest
{
    public function authorize(): bool
    {
        $conversation = $this->route("conversation");

        if (!$conversation instanceof Conversation) {
            return true;
        }

        $user = $this->user();
        if (!$user) {
            return false;
        }

        if ($user->hasRole("admin") || $user->hasRole("support")) {
            return true;
        }

        return $conversation->user_id === $user->id;
    }

    public function rules(): array
    {
        return [
            "support_id" => ["nullable", "exists:users,id"],
        ];
    }
}
