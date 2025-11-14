<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueItems implements ValidationRule
{
    /**
     * items to check
     *
     * @var \Illuminate\Support\Collection
     */
    private $items;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($items)
    {
        $this->items = collect($items);
    }
    
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->items->where('product_id', $value)->count() > 1) {
            $fail('Products in a rule must be unique');
        }
    }
}
