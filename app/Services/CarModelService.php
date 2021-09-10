<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Http\Request;

class CarModelService
{
    public function saveOrUpdateBrand(Request $request, Brand $brand, $id = null)
    {
        return $brand->car_models()->updateOrCreate(
            ['id' => $id],
            ['car_model' => $request->get('car_model')]
        );
    }
}
