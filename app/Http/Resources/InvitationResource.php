<?php

namespace App\Http\Resources;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvitationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $event = Event::where('id', '=', $this->event_id)->get();

        return [
            'id' => $this->id,
            'email' => $this->email,
            // 'event' => $this->$event,
        ];
    }

    public function Event(Request $request)
    {
        return $this->belongsTo(Event::class);
    }

}
