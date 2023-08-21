<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiSensorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sensor_id_unique' => $this->id_unique,
            'sensor_name' => $this->name,
            'node_id' => $this->node_id,
            'soil_moisture' => $this->soil->value,
        ];
    }
}
