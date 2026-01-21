<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    public function __construct(protected ImageService $imageService) {}

    public function store(ImageRequest $request): JsonResponse
    {
        $image = $this->imageService->addImage($request->validated());

        return response()->json(
            [
                "success" => true,
                "data" => $image,
            ],
            201,
        );
    }

    public function destroy(Image $image): JsonResponse
    {
        $this->imageService->deleteImage($image);

        return response()->json([
            "success" => true,
            "message" => "Изображение удалено",
        ]);
    }
}
