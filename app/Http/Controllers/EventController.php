<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $validator = validator($request->all(), [
            "title" => "required|unique:events,title|string|min:5|max:100",
            'user_id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }
        $event = Event::create([
            'title' => $request->title,
            'user_id' => $request->user_id,
        ]);
        return response()->json([
            'message' => 'event created successfully',
            'event' => new EventResource($event),
        ]);
    }
}
