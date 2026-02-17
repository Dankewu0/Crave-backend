<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    public function __construct(protected TicketService $ticketService) {}

    public function index(): JsonResponse
    {
        return response()->json($this->ticketService->getAllTickets());
    }

    public function store(TicketRequest $request): JsonResponse
    {
        $ticket = $this->ticketService->createTicket($request->validated());
        return response()->json($ticket, 201);
    }

    public function show(Ticket $ticket): JsonResponse
    {
        return response()->json($this->ticketService->getTicket($ticket));
    }

    public function update(TicketRequest $request, Ticket $ticket): JsonResponse
    {
        $updatedTicket = $this->ticketService->updateTicket(
            $ticket,
            $request->validated(),
        );
        return response()->json($updatedTicket);
    }

    public function destroy(Ticket $ticket): JsonResponse
    {
        $this->ticketService->deleteTicket($ticket);
        return response()->json(null, 204);
    }
}
