<?php

namespace App\Http\Requests\Invoice;

use App\Rules\Invoice\InvoiceDate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AcceptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'total_pieces' => ['required', 'integer', 'min:1'],
            'amount' => ['required', 'integer', 'min:1'],
            'invoice_date' => ['required', Rule::date()->format('Y-m-d'), new InvoiceDate($this->id)],
            'items.*.product_id' => ['exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.discount' => ['nullable', 'integer', 'min:1', 'max:100'],
            'items.*.discount_type' => ['nullable', 'in:percentage,fixed'],
            'items.*.price' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'items.*.product_id.required' => 'Product is required',
            'items.*.quantity.required' => 'Quantity is required',
            'items.*.price.required' => 'Price is required',
        ];
    }
}
