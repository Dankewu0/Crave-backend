<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    public function createReview(array $data): Review
    {
        return Review::create([
            "user_id" => Auth::id(),
            "product_id" => $data["product_id"],
            "rating" => $data["rating"],
            "comment" => $data["comment"] ?? null,
        ]);
    }

    public function deleteReview(Review $review): bool
    {
        return $review->delete();
    }

    public function getProductReviews(int $productId)
    {
        return Review::where("product_id", $productId)
            ->with("user")
            ->latest()
            ->get();
    }
}
