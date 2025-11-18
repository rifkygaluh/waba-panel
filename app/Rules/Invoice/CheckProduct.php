<?php

namespace App\Rules\Invoice;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckProduct implements ValidationRule
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
        if ($this->items->whereNotNull('product_id')->count()) {
            if (is_null($value)) $fail("$attribute is required");
            if ($value < 1) $fail("Minimum of $attribute is 1");
        }
    }
}
