<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarModelResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'car_model' => $this->car_model,
            'brand'     => $this->brand->brand
        ];
    }
}
