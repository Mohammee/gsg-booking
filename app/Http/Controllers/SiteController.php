<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Rules\AfterNow;
use App\Models\Workspace;
use App\Rules\AfterNowHour;
use App\Rules\AfterStartAt;
use App\Models\TrainingHall;
use App\Rules\WorkspaceAvailable;
use Illuminate\Http\Request;
use App\Rules\TimeAfterNowHour;
use App\Rules\TrainingHallAvailable;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function __invoke()
    {
        $trainingHalls = TrainingHall::orderByDesc('id')->take(3)->get();
        $workspaces = Workspace::orderByDesc('id')->take(3)->get();

        return view('site.index', compact('trainingHalls', 'workspaces'));
    }

}
