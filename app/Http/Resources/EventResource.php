<?php

namespace App\Http\Resources;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::where('id', '=', $this->user_id)->first();
        return [
            'id' => $this->id,
            'title' => $this->title,
            // 'user' => $user,
            'created_at' => $this->created_at,
        ];
    }

    public function Invitations()
    {
        return $this->hasMany(Invitation::class);
    }

}
