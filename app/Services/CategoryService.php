<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function getAllCategories(): Collection
    {
        return Category::orderBy("name")->get();
    }

    public function createCategory(array $data): Category
    {
        if (empty($data["slug"])) {
            $data["slug"] = Str::slug($data["name"]);
        }

        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): Category
    {
        if (isset($data["name"]) && empty($data["slug"])) {
            $data["slug"] = Str::slug($data["name"]);
        }

        $category->update($data);
        return $category;
    }

    public function deleteCategory(Category $category): bool
    {
        return $category->delete();
    }
}
