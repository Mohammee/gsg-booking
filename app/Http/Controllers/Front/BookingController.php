<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function bookingRequest()
    {
        $user = Auth::user();
        $userBookings = $user->bookings;
        $userBookingsCount = $userBookings->count();

        $msg = session('msg');
        $type = session('type');
        return view('site.bookingRequests', compact('userBookings', 'type', 'msg', 'userBookingsCount'));
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->back()->with('msg', 'Your booking request has been deleted successfully')
            ->with('type', 'success');
    }
}
