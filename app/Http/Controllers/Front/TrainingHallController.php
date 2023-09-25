<?php

namespace App\Http\Controllers\Front;

use App\actions\BookingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontTrainingHallBooking;
use App\Models\Booking;
use App\Models\TrainingHall;
use App\Rules\AfterNow;
use App\Rules\AfterNowHour;
use App\Rules\TrainingHallAvailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingHallController extends Controller
{

    public function trainingHalls(Request $request)
    {
        $trainingHalls = TrainingHall::filter($request->query())
            ->orderByDesc('id')
            ->paginate(5);

        //used for load more by ajax
        if ($request->ajax()){
            return $trainingHalls;
        }

        $msg = session('msg');
        $type = session('type');
        return view('site.trainingHalls', compact('trainingHalls', 'msg', 'type'));
    }

    public function trainingHallBooking(FrontTrainingHallBooking $request, BookingService $bookingService)
    {
        $validated = $request->validated();

        $hall = TrainingHall::findOrFail($request->input('training_hall_id'));
        if($hall->capacity < 1){
            return back()->withErrors('All hall reserved.');
        }


        $booking = $bookingService->createBooking([
            'user_id' => Auth::user()->id,
            'training_hall_id' => $hall->id,
            'booking_datetime' => $validated['booking_datetime'],
            'startAt' => $validated['startAt'],
            'endAt' => $validated['endAt'],
        ]);


        return redirect()->back()->with('msg', 'Your booking request has been sent')->with('type', 'success');
    }
}
