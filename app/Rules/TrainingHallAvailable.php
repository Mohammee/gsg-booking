<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class TrainingHallAvailable implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startAt = request()->input('startAt');
        $booking_datetime = request()->input('booking_datetime');
        $endAt = $value;
        $trainingHallId = request()->input('training_hall_id');

        $bookingCount = DB::table('bookings')
            ->where('training_hall_id', $trainingHallId)
            ->where('booking_datetime', $booking_datetime)
            ->where(function ($query) use ($startAt, $endAt) {
                $query->whereBetween('startAt', [$startAt, $endAt])
                    ->orWhereBetween('endAt', [$startAt, $endAt])
                    ->orWhere(function ($query) use ($startAt, $endAt) {
                        $query->where('startAt', '<', $startAt)
                            ->where('endAt', '>', $endAt);
                    });
            })
            ->count();

        if ($bookingCount > 0) {
            $fail("The selected training hall is not available for the specified time range.");
        }
    }
}
