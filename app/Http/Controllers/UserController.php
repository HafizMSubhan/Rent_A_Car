<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show a user's details
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Create a new user
    public function create()
    {
        return view('users.create');
    }

    // Store a new user
    public function store(Request $request)
    {
        // Validation logic here
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
        ]);

        // User creation logic here
        User::create($request->all());

        return redirect()->route('users.index');
    }

    // Edit a user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update a user
    public function update(Request $request, User $user)
    {
        // Validation logic here
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->user_id],
            'phone_number' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
        ]);

        // User update logic here
        $user->update($request->all());

        return redirect()->route('users.index');
    }

    // Delete a user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
