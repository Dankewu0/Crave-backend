<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Ticket;

class TicketMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        $ticket = $this->route("ticket");

        if (!$ticket instanceof Ticket) {
            return false;
        }

        $user = $this->user();

        if (!$user) {
            return false;
        }

        if ($user->hasRole("admin") || $user->hasRole("support")) {
            return true;
        }

        return $ticket->user_id === $user->id;
    }

    public function rules(): array
    {
        return [
            "body" => ["required", "string", "min:1", "max:5000"],
        ];
    }
}
