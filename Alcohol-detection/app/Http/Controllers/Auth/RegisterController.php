<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Add detailed logging to track the process
        Log::info('Registration attempt with data:', $request->except('password'));

        try {
            // Validate the request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'phone' => 'nullable|string|max:20',
                'dob' => 'nullable|date',
                // Make role optional with default value set below
                'role' => 'nullable|string|in:user,admin',
            ]);

            Log::info('Validation passed');

            // Set default role if not provided
            if (!isset($validated['role'])) {
                $validated['role'] = 'user';
            }

            // IMPORTANT: Hash the password
            $validated['password'] = Hash::make($validated['password']);

            // Create the user
            $user = User::create($validated);

            Log::info('User created successfully with ID: ' . $user->id);

            // Redirect to login page with success message
            return redirect('/login')->with('success', 'Registration successful! Please log in.');

        } catch (\Exception $e) {
            // Log any errors
            Log::error('Registration failed: ' . $e->getMessage());

            // Return to the registration form with errors
            return back()
                ->withInput($request->except('password'))
                ->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }
}
