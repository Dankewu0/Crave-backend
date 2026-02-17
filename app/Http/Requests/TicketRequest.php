<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Ticket;

class TicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        if (!$user) {
            return false;
        }

        if ($user->hasRole("admin") || $user->hasRole("support")) {
            return true;
        }

        $ticket = $this->route("ticket");
        if ($ticket instanceof Ticket) {
            return $ticket->user_id === $user->id;
        }

        return true;
    }

    public function rules(): array
    {
        return [
            "subject" => ["required", "string", "max:255"],
            "priority" => [
                "required",
                "string",
                Rule::in(["low", "medium", "high"]),
            ],
            "assigned_to" => ["nullable", "exists:users,id"],
        ];
    }
}
