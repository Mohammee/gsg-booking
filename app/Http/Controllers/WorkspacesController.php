<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkspaceRequest;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WorkspacesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $workspaces = Workspace::filter($request->query())
            ->orderByDesc('created_at')
            ->paginate(6);
        $workspacesCount = $workspaces->count();

        $msg = session('msg');
        $type = session('type');
        return view('officeSpaces.workspaces.index', compact('workspaces', 'msg', 'type', 'workspacesCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workspace $workspace)
    {
        return view('officeSpaces.workspaces.edit', compact('workspace'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkspaceRequest $request, Workspace $workspace)
    {
        $validated = $request->validated();
        if ($request->hasFile('image_path')) {
            File::delete(public_path('storage/' . $workspace->image_path));
            $file = $request->file('image_path');
            $path = $file->store('/covers', 'public');
        } else {
            $path = $workspace->image_path;
        }
        $validated['image_path'] = $path;


        $workspace->update($validated);
        return redirect()->route('workspaces.index')->with('msg', 'Workspace Updated Successfully')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workspace $workspace)
    {
        File::delete(public_path('storage/' . $workspace->image_path));
        $workspace->delete();
        return redirect()->route('workspaces.index')->with('msg', 'Workspace Deleted Successfully')->with('type', 'danger');
    }
}
