<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoinPlanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => ['required'],
            'price' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
