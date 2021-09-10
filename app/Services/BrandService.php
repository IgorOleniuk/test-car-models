<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandService
{
    public function saveOrUpdateBrand(Request $request, $id = null): Brand
    {
        return Brand::updateOrCreate(
            ['id' => $id],
            ['brand' => $request->get('brand')]
        );
    }

    public function createConfirmationToken(Brand $brand)
    {
        $token = (string) Str::uuid();
        $brand->token()->updateOrCreate([],['confirmation_token' => $token]);
    }
}
