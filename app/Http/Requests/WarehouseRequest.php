<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WarehouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->user()->isAdmin && auth()->user()->department->name === 'WAREHOUSE'){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required',Rule::exists('products','id')],
            'opening_balance' => ['required','numeric','min:1'],
            'sales_issue' => ['required','numeric','min:1'],
            'received' => ['required','numeric','min:1'],
            'availability' => ['required','numeric','min:1'],
            'sales_return' => ['required','numeric','min:1'],
            'damage' => ['required','numeric','min:1'],
            'closing_balance' => ['required','numeric','min:1']
        ];
    }
}
