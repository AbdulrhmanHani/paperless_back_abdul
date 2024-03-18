<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoinPlanRequest;
use App\Http\Resources\CoinPlanResource;
use App\Models\CoinPlan;

class CoinPlanController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', CoinPlan::class);

        return CoinPlanResource::collection(CoinPlan::all());
    }

    public function store(CoinPlanRequest $request)
    {
        $this->authorize('create', CoinPlan::class);

        return new CoinPlanResource(CoinPlan::create($request->validated()));
    }

    public function show(CoinPlan $coinPlan)
    {
        $this->authorize('view', $coinPlan);

        return new CoinPlanResource($coinPlan);
    }

    public function update(CoinPlanRequest $request, CoinPlan $coinPlan)
    {
        $this->authorize('update', $coinPlan);

        $coinPlan->update($request->validated());

        return new CoinPlanResource($coinPlan);
    }

    public function destroy(CoinPlan $coinPlan)
    {
        $this->authorize('delete', $coinPlan);

        $coinPlan->delete();

        return response()->json();
    }
}
