<?php

namespace App\Http\Controllers;

use App\Models\TrainingHall;
use App\Models\Workspace;
use Illuminate\Http\Request;

class OfficeSpacesController extends Controller
{

    public function create()
    {
        return view('officeSpaces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['nullable', 'string'],
            'location' => ['required', 'string'],
            'capacity' => ['required', 'integer'],
            'type' => ['required'],
            'image_path' => ['nullable', 'image:jpeg,png,jpg']
        ]);
        $type = $request->input('type');
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $path = $file->store('/covers', 'public');
        } else {
            $path = null;
        }
        if ($type == 'workspace') {
            Workspace::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'location' => $request->input('location'),
                'capacity' => $request->input('capacity'),
                'image_path' => $path
            ]);
            return redirect()->route('workspaces.index')->with('msg', 'Workspace Created successfully')->with('type', 'success');
        }

        TrainingHall::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'capacity' => $request->input('capacity'),
            'image_path' => $path
        ]);
        return redirect()->route('trainingHalls.index')->with('msg', 'Training Hall Created successfully')->with('type', 'success');
    }

}
