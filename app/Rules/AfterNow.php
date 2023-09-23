<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;

class AfterNow implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $bookingDateTime = Carbon::parse($value);
        $now = Carbon::now();

        if( $bookingDateTime->isSameDay($now)){
            return;
        }
        if ($bookingDateTime->isBefore($now)) {
            $fail("The $attribute must be a date and time after the current time.");
        }
    }
}
