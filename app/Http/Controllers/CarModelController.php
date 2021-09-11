<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarModelCollection;
use App\Http\Resources\CarModelResource;
use App\Models\Brand;
use App\Services\CarModelService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarModelController extends Controller
{
    public $carModelService;

    public function __construct(CarModelService $carModelService)
    {
        $this->carModelService = $carModelService;
    }

    public function getBrandModels(Brand $brand): JsonResource
    {
        return CarModelCollection::collection($brand->car_models);
    }

    public function createBrandModel(Request $request, Brand $brand): JsonResource
    {
        return new CarModelResource($this->carModelService->saveOrUpdateBrand($request, $brand));
    }

    public function updateBrandModel(Request $request, Brand $brand, int $id): JsonResource
    {
        return new CarModelResource($this->carModelService->saveOrUpdateBrand($request, $brand, $id));
    }

    public function searchCarModel(Request $request, Brand $brand): JsonResource
    {
        $data = $brand->car_models()->search($request->get('search_query'))->get();
        return CarModelCollection::collection($data);
    }
}
