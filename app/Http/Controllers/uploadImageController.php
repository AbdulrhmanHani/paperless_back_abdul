<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class uploadImageController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images.*' => 'required|image|mimes:jpg,png|max:2050',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        }

        $images_paths = [];
        foreach ($request->images as $image) {
            $image_path = Storage::put('img', $image);
            $images_paths[] = url('') . '/' . $image_path;
        }

        return response()->json([
            'message' => "You have uploaded " . count($request->images) . ' images',
            'images' => [
                'paths' => $images_paths,
            ],
        ]);
    }

}
