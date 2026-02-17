<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Conversation;

class MessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        $conversation = $this->route("conversation");

        if (!$conversation instanceof Conversation) {
            return false;
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
            "body" => ["required", "string", "min:1", "max:5000"],
        ];
    }
}
