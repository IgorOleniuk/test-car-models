<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    => $this->id,
            'brand' => $this->brand
        ];
    }
}
