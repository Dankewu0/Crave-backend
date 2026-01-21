<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected ReviewService $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index(int $productId): JsonResponse
    {
        $reviews = $this->reviewService->getProductReviews($productId);

        return response()->json($reviews);
    }

    public function store(ReviewRequest $request): JsonResponse
    {
        $review = $this->reviewService->createReview($request->validated());

        return response()->json($review, 201);
    }

    public function destroy(Review $review): JsonResponse
    {
        if (Auth::id() !== $review->user_id) {
            return response()->json(["error" => "Unauthorized"], 403);
        }

        $this->reviewService->deleteReview($review);

        return response()->json(null, 204);
    }
}
