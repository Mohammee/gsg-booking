<?php

namespace App\Http\Controllers\Front;

use App\actions\BookingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontWorkspaceBooking;
use App\Models\Booking;
use App\Models\Workspace;
use App\Rules\AfterNow;
use App\Rules\AfterNowHour;
use App\Rules\WorkspaceAvailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    public function workspaces(Request $request)
    {
        $workspaces = Workspace::filter($request->query())
            ->orderByDesc('id')
            ->paginate(5);
        if ($request->ajax()){
            return $workspaces;
        }

        $msg = session('msg');
        $type = session('type');
        return view('site.workspaces', compact('workspaces', 'msg', 'type'));
    }

    public function workspaceBooking(FrontWorkspaceBooking $request, BookingService $bookingService)
    {
        $validated = $request->validated();

        $workspace = Workspace::findOrFail($request->input('workspace_id'));
        if($workspace->booked_seats >= $workspace->capacity){
            return back()->withErrors('All hall reserved.');
        }


        $booking = $bookingService->createBooking([
            'user_id' => Auth::user()->id,
            'workspace_id' => $workspace->id,
            'booking_datetime' => $validated['booking_datetime'],
            'startAt' => $validated['startAt'],
            'endAt' => $validated['endAt'],
            'booked_seats' => 1,
        ]);

        return redirect()->back()->with('msg', 'Your booking request has been sent')->with('type', 'success');
    }

}
