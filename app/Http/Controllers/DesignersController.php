<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignersRequest;
use App\Http\Resources\DesignerResource;
use App\Models\Designer;

class DesignersController extends Controller
{
    public function index()
    {
        return DesignerResource::collection(Designer::all());
    }

    public function store(DesignersRequest $request)
    {
        $this->authorize('create', Designer::class);

        return new DesignerResource(Designer::create($request->validated()));
    }


    public function update(DesignersRequest $request, Designer $designer)
    {
        $this->authorize('update');

        $designer->update($request->validated());

        return new DesignerResource($designer);
    }

    public function destroy(Designer $designer)
    {
        $this->authorize('delete');

        $designer->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
