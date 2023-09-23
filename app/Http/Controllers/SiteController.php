<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Rules\AfterNow;
use App\Models\Workspace;
use App\Rules\AfterNowHour;
use App\Rules\AfterStartAt;
use App\Models\TrainingHall;
use Illuminate\Http\Request;
use App\Rules\TimeAfterNowHour;
use App\Rules\TrainingHallAvailable;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        $trainingHalls = TrainingHall::orderByDesc('id')->take(3)->get();
        $workspaces = Workspace::orderByDesc('id')->take(3)->get();

        return view('site.index', compact('trainingHalls', 'workspaces'));
    }

    public function about()
    {
        return view('site.about');
    }
    public function trainingHalls(Request $request)
    {
        $trainingHalls = TrainingHall::filter($request->query())
            ->orderByDesc('id')
            ->get();

        $msg = session('msg');
        $type = session('type');
        return view('site.trainingHalls', compact('trainingHalls', 'msg', 'type'));
    }
    public function workspaces(Request $request)
    {
        $workspaces = Workspace::filter($request->query())
            ->orderByDesc('id')
            ->get();
        $msg = session('msg');
        $type = session('type');
        return view('site.workspaces', compact('workspaces', 'msg', 'type'));
    }
    public function trainingHallBooking(Request $request, string $id)
    {
        $validated = $request->validate([
            'booking_datetime' => ['required', new AfterNow],
            'startAt' => ['required', 'date_format:H:i', new AfterNowHour],
            'endAt' => ['required', 'date_format:H:i', 'after:startAt', new TrainingHallAvailable],
        ]);


        Booking::create([
            'user_id' => Auth::user()->id,
            'training_hall_id' => $request->input('training_hall_id'),
            'booking_datetime' => $validated['booking_datetime'],
            'startAt' => $validated['startAt'],
            'endAt' => $validated['endAt'],
        ]);


        return redirect()->back()->with('msg', 'Your booking request has been sent')->with('type', 'success');
    }


    public function bookingRequest(string $id)
    {
        $msg = session('msg');
        $type = session('type');
        $user = Auth::user();
        $userBookings = $user->bookings;
        $userBookingsCount =  $userBookings->count();
        return view('site.bookingRequests', compact('userBookings', 'type', 'msg', 'userBookingsCount'));
    }

    public function destroy(string $id)
    {
        $trainingHallBook = Booking::findOrFail($id);
        $trainingHallBook->delete();
        return redirect()->back()->with('msg', 'Your booking request has been deleted successfully')->with('type', 'danger');
    }
}
