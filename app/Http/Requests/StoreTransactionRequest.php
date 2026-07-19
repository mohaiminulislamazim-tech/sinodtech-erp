<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sale_id' => 'required|exists:sales,id',
            'payment_method' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ];
    }
}
