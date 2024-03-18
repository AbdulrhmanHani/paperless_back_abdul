<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoinPointRequest;
use App\Http\Resources\CoinPlanResource;
use App\Models\CoinPlan;
use Exception;
use App\Helpers\Helpers;
use App\Http\Traits\WalletPointsTrait;
use App\Http\Requests\WalletPointsRequest;
use App\GraphQL\Exceptions\ExceptionHandler;
use App\Http\Requests\CreditDebitPointsRequest;
use App\Repositories\Eloquents\PointsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PointsController extends Controller
{
    use WalletPointsTrait;

    public $repository;

    public function __construct(PointsRepository $repository)
    {
        return $this->repository = $repository;
    }

    /**
     * Display a Consumer Points Transactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WalletPointsRequest $request)
    {
        try {

            return $this->filter($this->repository, $request);

        } catch (Exception $e) {

            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Credit Amount from Consumer Points.
     *
     * @return \Illuminate\Http\Response
     */
    public function credit(CreditDebitPointsRequest $request)
    {
        return $this->repository->credit($request);
    }

    /**
     * Debit Amount from Consumer Points.
     *
     * @return \Illuminate\Http\Response
     */
    public function debit(CreditDebitPointsRequest $request)
    {
        return $this->repository->debit($request);
    }

    public function coin(CoinPointRequest $request)
    {
        return $this->repository->debit($request);
    }

    public function filter($points, $request)
    {
        $consumer_id = $request->consumer_id ?? Helpers::getCurrentUserId();
        $points = $this->repository->where('consumer_id', $consumer_id)->first();

        if (!$points) {
            $points = $this->getPoints($request->consumer_id);
            $points = $points->fresh();
        }

        $transactions = $points->transactions()->where('type', 'LIKE', "%{$request->search}%");
        if ($request->start_date && $request->end_date) {
            $transactions->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $paginate = $request->paginate ?? $points->transactions()->count();
        $points->setRelation('transactions', $transactions->paginate($paginate));

        return $points;
    }

    public function showCoinPlan()
    {
        $coinPlanId = CoinPlan::all();
        return response()->json([
            'data' => CoinPlanResource::collection($coinPlanId),
        ], 200);
    }

    public function coinPlan(Request $request)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'amount' => 'required|integer|min:1|unique:coin_plans,amount', //coins amount
            'price' => 'required|decimal:2,4', //price per amount of coins
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $CoinPlan = CoinPlan::create([
            'amount' => $request->amount,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'plan created successfully',
            'data' => $CoinPlan,
        ], 201);

    }

    public function coinPlanDelete(Request $request, $coinId)
    {
        $coinPlan = CoinPlan::find($coinId);
        if ($coinPlan) {
            $coinPlan->delete();
            return response()->json([
                'message' => 'plan deleted successfully',
                'data' => $coinPlan,
            ], 200);
        }
        return response()->json([
            'error' => 'plan id not found',
        ], 404);
    }

    public function coinPlanUpdate(Request $request, $coinPlanId)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'amount' => 'nullable|integer|min:1|unique:coin_plans,amount',
            'price' => 'nullable|decimal:2,4',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }

        $coinPlan = CoinPlan::find($coinPlanId);

        if ($coinPlan) {
            $coinPlan->update([
                'amount' => $request->amount ?? $coinPlan->amount,
                'price' => $request->price ?? $coinPlan->price,
            ]);
            return response()->json([
                'message' => 'plan updated successfully',
                'data' => $coinPlan,
            ], 200);
        }
        return response()->json([
            'error' => 'plan id not found',
        ], 404);
    }

}
