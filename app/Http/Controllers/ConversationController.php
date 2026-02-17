<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConversationRequest;
use App\Models\Conversation;
use App\Services\ConversationService;
use Illuminate\Http\JsonResponse;

class ConversationController extends Controller
{
    public function __construct(
        protected ConversationService $conversationService,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json(
            $this->conversationService->getAllConversations(),
        );
    }

    public function store(ConversationRequest $request): JsonResponse
    {
        $conversation = $this->conversationService->createConversation(
            $request->validated(),
        );
        return response()->json($conversation, 201);
    }

    public function show(Conversation $conversation): JsonResponse
    {
        return response()->json(
            $this->conversationService->getConversation($conversation),
        );
    }

    public function update(
        ConversationRequest $request,
        Conversation $conversation,
    ): JsonResponse {
        $updatedConversation = $this->conversationService->updateConversation(
            $conversation,
            $request->validated(),
        );
        return response()->json($updatedConversation);
    }

    public function destroy(Conversation $conversation): JsonResponse
    {
        $this->conversationService->deleteConversation($conversation);
        return response()->json(null, 204);
    }
}
