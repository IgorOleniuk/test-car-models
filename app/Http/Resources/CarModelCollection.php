<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarModelCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    => $this->id,
            'model' => $this->car_model,
        ];
    }
}
