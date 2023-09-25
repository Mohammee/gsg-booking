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
