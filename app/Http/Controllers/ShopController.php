<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Services\ShopService;
use Illuminate\Http\JsonResponse;
use Exception;

class ShopController extends Controller
{
    public function __construct(protected ShopService $shopService) {}

    public function index(): JsonResponse
    {
        try {
            $shops = $this->shopService->getActiveShops();

            return response()->json([
                "success" => true,
                "data" => $shops,
            ]);
        } catch (Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" =>
                        "Ошибка при получении магазинов: " . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function store(ShopRequest $request): JsonResponse
    {
        try {
            $shop = $this->shopService->createShop($request->validated());

            return response()->json(
                [
                    "success" => true,
                    "data" => $shop,
                ],
                201,
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Ошибка: " . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->authorize("manage admins");

            $this->shopService->deleteShop($id);
            return response()->json([
                "success" => true,
                "message" => "Магазин удален",
            ]);
        } catch (Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Ошибка удаления: " . $e->getMessage(),
                ],
                404,
            );
        }
    }
}
