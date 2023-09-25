<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingHallRequest;
use Illuminate\Support\Str;
use App\Models\TrainingHall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TrainingHallsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $trainingHalls = TrainingHall::filter($request->query())
            ->orderByDesc('created_at')
            ->paginate(6);

        $trainingHallsCount = $trainingHalls->count();
        $msg = session('msg');
        $type = session('type');
        return view('officeSpaces.trainingHalls.index', compact('trainingHalls', 'msg', 'type', 'trainingHallsCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingHall $trainingHall)
    {
        return view('officeSpaces.trainingHalls.edit', compact('trainingHall'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrainingHallRequest $request, TrainingHall $trainingHall)
    {
        $validated = $request->validated();
        if ($request->hasFile('image_path')) {
            File::delete(public_path('storage/' . $trainingHall->image_path));
            $file = $request->file('image_path');
            $path = $file->store('/covers', 'public');
        } else {
            $path = $trainingHall->image_path;
        }
        $validated['image_path'] = $path;


        $trainingHall->update($validated);
        return redirect()->route('trainingHalls.index')->with('msg', 'Training Hall Updated Successfully')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingHall $trainingHall)
    {
        File::delete(public_path('storage/' . $trainingHall->image_path));
        $trainingHall->delete();
        return redirect()->route('trainingHalls.index')->with('msg', 'Training Hall Deleted Successfully')->with('type', 'danger');
    }
}
