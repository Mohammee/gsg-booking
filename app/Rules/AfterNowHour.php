<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;

class AfterNowHour implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $bookingDateTime = Carbon::parse(request()->input('booking_datetime'));
        $now = now()->format('H:i');
        $inputTime = strtotime($value);

        $inputTime = date('H:i', $inputTime);
        if ($inputTime < $now && $bookingDateTime->isSameDay(Carbon::now())) {
            $fail("The $attribute must be a time after the current time.");
        }
    }
}
