<?php

namespace App\Rules\Invoice;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class InvoiceDate implements ValidationRule
{
    /**
     * id to check
     *
     * @var integer
     */
    private $id;

    /**
     * type to check
     *
     * @var enum-string 'accept' | 'reject'
     */
    private $type;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id, $type = 'accept')
    {
        $this->id = $id;
        $this->type = $type;
    }
    
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $invoice = DB::table('invoices')->find($this->id);

        if (Carbon::make($value)->gt(Carbon::make($invoice->created_at)->toDateString())) {
            $fail('Invoice Date cannot be defined after Upload Date');
        }
        
        if ($this->type === 'accept' && Carbon::parse($invoice->created_at)->toDateString() !== $value) {
            $fail('Invoice Date must match the Upload Date of the invoice');
        }
    }
}
