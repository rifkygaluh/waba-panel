<?php

namespace App\Http\Requests\Invoice;

use App\Rules\Invoice\CheckProduct;
use App\Rules\Invoice\InvoiceDate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RejectRequest extends FormRequest
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
            'total_pieces' => [new CheckProduct($this->items), 'integer'],
            'amount' => [new CheckProduct($this->items), 'integer'],
            'invoice_date' => ['nullable', Rule::date()->format('Y-m-d'), new InvoiceDate($this->id, 'reject')],
            'comments' => ['required', 'string'],
            'items.*.product_id' => ['nullable', 'exists:products,id'],
            'items.*.quantity' => ['required_with:items.*.product_id', 'integer', 'min:1'],
            'items.*.discount' => ['nullable', 'integer', 'min:1', 'max:100'],
            'items.*.discount_type' => ['nullable', 'in:percentage,fixed'],
            'items.*.price' => ['required_with:items.*.product_id', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'items.*.product_id.required_with' => 'Product is required on each item',
            'items.*.quantity.required_with' => 'Quantity is required on each item',
            'items.*.price.required_with' => 'Price is required on each item',
        ];
    }
}
