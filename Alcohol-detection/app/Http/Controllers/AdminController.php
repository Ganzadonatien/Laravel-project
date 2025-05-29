<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role; // <-- Use 'role' instead of 'usertype'
            $currentUser = Auth::user();

            if ($role === 'user') {
                return view('dashboard', compact('currentUser'));
            }

            if ($role === 'admin') {
                $totalUsers = User::where('role', 'user')->count(); // Only users
                $totalDevices = Device::count();
                $assignedDevices = Device::whereNotNull('user_id')->count();
                $availableDevices = $totalDevices - $assignedDevices;

                $recentUsers = User::where('role', 'user')->latest()->take(5)->get();

                $usersByRole = User::selectRaw('role, COUNT(*) as count')
                    ->whereNotNull('role')
                    ->groupBy('role')
                    ->pluck('count', 'role')
                    ->toArray();

                return view('admin.index', compact(
                    'currentUser',
                    'totalUsers',
                    'totalDevices',
                    'assignedDevices',
                    'availableDevices',
                    'recentUsers',
                    'usersByRole'
                ));
            }

            return redirect()->back();
        }

        return redirect()->route('login');
    }
}
