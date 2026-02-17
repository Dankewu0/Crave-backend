<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Services\MessageService;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    public function __construct(protected MessageService $messageService) {}

    public function index(): JsonResponse
    {
        return response()->json($this->messageService->getAllMessages());
    }

    public function store(MessageRequest $request): JsonResponse
    {
        $message = $this->messageService->createMessage($request->validated());
        return response()->json($message, 201);
    }

    public function show(Message $message): JsonResponse
    {
        return response()->json($this->messageService->getMessage($message));
    }

    public function update(
        MessageRequest $request,
        Message $message,
    ): JsonResponse {
        $updatedMessage = $this->messageService->updateMessage(
            $message,
            $request->validated(),
        );
        return response()->json($updatedMessage);
    }

    public function destroy(Message $message): JsonResponse
    {
        $this->messageService->deleteMessage($message);
        return response()->json(null, 204);
    }
}
