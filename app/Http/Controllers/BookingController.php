<?php

namespace App\Http\Controllers;

use App\Events\RequestBookingEvent;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BookingController extends Controller
{

    public function index(Request $request)
    {
        $bookings = Booking::status()->paginate(5);
        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $type = session('type');
        $msg = session('msg');
        return view('bookings.show', compact('booking', 'type', 'msg'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:denied,accepted'
        ]);

        $booking->status = $request->status;
        $booking->save();


        event(new RequestBookingEvent($booking));

        return back()->with(['msg' => 'Status updated Successfully.', 'type' => 'success']);
    }
}
