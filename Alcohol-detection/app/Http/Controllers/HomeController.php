<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\AlcoholRecord;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('home.welcome');
    }

    public function homepage()
    {
        return view('home.homepage');
    }

    public function register()
    {
        return view('home.register');
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($user->role === 'user') {
            $records = AlcoholRecord::where('user_id', $user->id)->orderBy('tested_at')->get();

            $dates = $records->pluck('tested_at')->map(fn($date) => $date->format('d M Y'));
            $levels = $records->pluck('alcohol_level');

            $highLevelAlert = optional($records->last())->alcohol_level > 0.8;

            $alerts = [
                '🕒 Reminder: Maintain a safe level to avoid health and legal issues.',
                '🚘 Safety Tip: Never drive under the influence!',
                '💡 Did You Know? Regular high alcohol levels can affect your liver.'
            ];


            return view('dashboard', compact('dates', 'levels', 'highLevelAlert', 'alerts'));
        }

        if ($user->role === 'admin') {
            return view('admin.index');
        }

        return redirect('/login')->withErrors('Unauthorized role access.');
    }

public function index1()
{
    // Check if user is authenticated
    $user = Auth::id() ? \App\Models\User::with('assignedDevice')->find(Auth::id()) : null;

    if (!$user) {
        return redirect('/login');
    }

    return view('dashboard', compact('user'));


}

    public function downloadReport($period)
    {
        $user = Auth::user();
        $start = now()->subDays($period === 'weekly' ? 7 : 30);

        $records = AlcoholRecord::where('user_id', $user->id)
            ->where('tested_at', '>=', $start)
            ->orderBy('tested_at')
            ->get(['tested_at', 'alcohol_level']);

        $csv = "Date,Alcohol Level\n";
        foreach ($records as $r) {
            $csv .= $r->tested_at->format('Y-m-d') . ',' . $r->alcohol_level . "\n";
        }

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=alcohol_report_{$period}.csv",
        ]);
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $user->delete();

        return redirect('/')->with('status', 'Your account has been deleted.');
    }

    public function edit()
{
    $user = Auth::user();
    return view('profile.edit', compact('user'));
}

public function update(Request $request)
{
    $user = \App\Models\User::find(Auth::id());

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'profile_image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $imagePath = $image->store('profiles', 'public');
        $user->profile_image_url = asset('storage/' . $imagePath);
    }

    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
}



}
