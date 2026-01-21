<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;

class ImageService
{
    public function getProductImages(int $productId): Collection
    {
        return Image::where("product_id", $productId)->get();
    }

    public function addImage(array $data): Image
    {
        return Image::create($data);
    }

    public function deleteImage(Image $image): bool
    {
        return $image->delete();
    }
}
