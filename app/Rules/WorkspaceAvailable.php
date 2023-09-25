<?php

namespace App\Rules;

use App\Models\Workspace;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class WorkspaceAvailable implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startAt = request()->input('startAt');
        $booking_datetime = request()->input('booking_datetime');
        $endAt = $value;
        $trainingHallId = request()->input('workspace_id');

        $seats = DB::table('bookings')
            ->where('workspace_id', $trainingHallId)
            ->where('booking_datetime', $booking_datetime)
            ->where('startAt', $startAt)
            ->where('endAt', $endAt)
            ->sum('booked_seats');
        $capacity = Workspace::find($trainingHallId)->capacity;


        if($seats >= $capacity){
            $fail('All seats reserved.');
            return;
        }

        $bookingCount = DB::table('bookings')
            ->where('workspace_id', $trainingHallId)
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

        if ($bookingCount > 0 ) {
            $fail("The selected seat in this workspace is not available for the specified time range(all seat reserved).");
        }
    }
}
