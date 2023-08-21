<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiNodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'control_id_unique' => $this->control->name,
            'node_id_unique' => $this->id_unique,
            'node_name' => $this->name,
            'sensor' => ApiSensorResource::collection($this->sensor),
        ];
    }
}
