<?php

namespace App\actions;

use App\Models\Booking;

class BookingService
{

    public function createBooking(array $bookingData): Booking
    {
        return Booking::create($bookingData);
    }

}
