<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;

class TicketService
{
    public function getAllTickets(): Collection
    {
        return Ticket::with(["user", "assignedTo", "messages"])
            ->orderByDesc("created_at")
            ->get();
    }

    public function createTicket(array $data): Ticket
    {
        return Ticket::create($data);
    }

    public function getTicket(Ticket $ticket): Ticket
    {
        return $ticket->load(["user", "assignedTo", "messages"]);
    }

    public function updateTicket(Ticket $ticket, array $data): Ticket
    {
        $ticket->update($data);
        return $ticket;
    }

    public function deleteTicket(Ticket $ticket): bool
    {
        return $ticket->delete();
    }
}
