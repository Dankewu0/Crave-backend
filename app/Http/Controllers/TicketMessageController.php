<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketMessageRequest;
use App\Models\TicketMessage;
use App\Services\TicketMessageService;
use Illuminate\Http\JsonResponse;

class TicketMessageController extends Controller
{
    public function __construct(
        protected TicketMessageService $ticketMessageService,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->ticketMessageService->getAllMessages());
    }

    public function store(TicketMessageRequest $request): JsonResponse
    {
        $message = $this->ticketMessageService->createMessage(
            $request->validated(),
        );
        return response()->json($message, 201);
    }

    public function show(TicketMessage $ticketMessage): JsonResponse
    {
        return response()->json(
            $this->ticketMessageService->getMessage($ticketMessage),
        );
    }

    public function update(
        TicketMessageRequest $request,
        TicketMessage $ticketMessage,
    ): JsonResponse {
        $updatedMessage = $this->ticketMessageService->updateMessage(
            $ticketMessage,
            $request->validated(),
        );
        return response()->json($updatedMessage);
    }

    public function destroy(TicketMessage $ticketMessage): JsonResponse
    {
        $this->ticketMessageService->deleteMessage($ticketMessage);
        return response()->json(null, 204);
    }
}
