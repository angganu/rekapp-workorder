<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
{
    // Transform the resource into an array.
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'asset_category_id' => $this->asset_category_id,
            'company_id' => $this->company_id,
            'location_id' => $this->location_id,
            'area_id' => $this->area_id,
            'room_id' => $this->room_id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'last_maintenance' => $this->last_maintenance,
            'next_maintenance' => $this->next_maintenance,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}