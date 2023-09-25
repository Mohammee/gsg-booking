<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembmerRequset;
use App\Models\User;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function admins(Request $request)
    {
        $admins = User::where('role', '=', 'admin')
            ->filter($request->query())
            ->orderByDesc('created_at')
            ->paginate(7);

        $adminsCount = $admins->count();

        $msg = session('msg');
        $type = session('type');
        return view('members.admins', compact('admins', 'msg', 'type', 'adminsCount'));
    }
    public function users(Request $request)
    {
        $users = User::where('role', '=', 'user')
            ->filter($request->query())
            ->orderByDesc('created_at')
            ->paginate(7);
        $usersCount = $users->count();

        $msg = session('msg');
        $type = session('type');
        return view('members.users', compact('users', 'msg', 'type', 'usersCount'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
            'role' => ['required'],
        ]);
        $role = $request->input('role');
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => $role,
        ]);
        if ($role == 'admin') {
            return redirect()->route('members.admins')->with('msg', 'Admin added successfully')->with('type', 'success');
        }
        return redirect()->route('members.users')->with('msg', 'User added successfully')->with('type', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = User::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MembmerRequset $request, User $member)
    {
        $role = $request->input('role');
        $member->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => $role,
        ]);
        if ($role == 'admin') {
            return redirect()->route('members.admins')->with('msg', 'Admin Updated successfully')->with('type', 'success');
        }
        return redirect()->route('members.users')->with('msg', 'User Updated successfully')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = User::findOrFail($id);
        $role = $member->role;

        $member->delete();
        if ($role == 'admin') {
            return redirect()->route('members.admins')->with('msg', 'Admin Deleted successfully')->with('type', 'danger');
        }
        return redirect()->route('members.users')->with('msg', 'User Deleted successfully')->with('type', 'danger');
    }
}
