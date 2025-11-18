<?php

namespace App\Http\Requests\BenefitRules;

use App\Rules\UniqueItems;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'type' => ['required', 'in:quantity,price'],
            'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d'],
            'items.*.product_id' => ['required', 'exists:products,id', new UniqueItems($this->items)],
            'items.*.min_value' => ['required', 'integer', 'min:1'],
            'items.*.benefit' => ['required', 'integer', 'min:1'],
            'items.*.is_rollover' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'items.*.product_id.required' => 'Product of an item is required',
            'items.*.min_value.required' => 'Minimum value of an item is required',
            'items.*.benefit.required' => 'Benefit of an item is required',
            'items.*.is_rollover.required' => 'Rollover of an item is required',
        ];
    }
}
