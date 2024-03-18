<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductPhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "paper_image" => url('') . '/' . $this->paper_image,
            "envelope_image" => url('') . '/' . $this->envelope_image,
            "backdrop_image" => url('') . '/' . $this->backdrop_image,
            // "added_at" => $this->created_at,
            // "product" => $this->Product,
        ];
    }
}
