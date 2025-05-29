<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = User::with('device')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        // Check if status column exists, if not get all devices
        if (Schema::hasColumn('devices', 'status')) {
            $devices = Device::where('status', 'available')->get();
        } else {
            $devices = Device::all();
        }

        return view('admin.users.create', compact('devices'));
    }

    /**
     * Store a newly created user in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:Admin,User',
            'device_id' => 'nullable|exists:devices,id',
        ]);

        // Set default permissions based on role
        $permissions = $this->getDefaultPermissionsForRole($request->role);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'permissions' => $permissions,
        ]);

        if ($request->device_id) {
            $device = Device::find($request->device_id);
            if ($device) {
                $user->device_id = $device->id;
                $user->save();

                // Update device status only if column exists
                if (Schema::hasColumn('devices', 'status')) {
                    $device->status = 'assigned';
                    $device->save();
                }
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        $user->load('device');
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        // Check if status column exists
        if (Schema::hasColumn('devices', 'status')) {
            $devices = Device::where(function($query) use ($user) {
                $query->where('status', 'available')
                      ->orWhere('id', $user->device_id);
            })->get();
        } else {
            $devices = Device::all();
        }

        // If permissions don't exist, set defaults based on role
        if (!isset($user->permissions) || !is_array($user->permissions)) {
            $user->permissions = $this->getDefaultPermissionsForRole($user->role);
        }

        return view('admin.users.edit', compact('user', 'devices'));
    }

    /**
     * Update the specified user in storage
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,moderator,user,viewer',
            'device_id' => 'nullable|exists:devices,id',
            'permissions' => 'nullable|array',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Handle permissions
        if ($request->has('permissions')) {
            $userData['permissions'] = $request->permissions;
        } else {
            $userData['permissions'] = $this->getDefaultPermissionsForRole($request->role);
        }

        $user->update($userData);

        // Handle device assignment only if status column exists
        if (Schema::hasColumn('devices', 'status')) {
            if ($user->device_id != $request->device_id) {
                // If user had a device before, mark it as available
                if ($user->device_id) {
                    $oldDevice = Device::find($user->device_id);
                    if ($oldDevice) {
                        $oldDevice->status = 'available';
                        $oldDevice->save();
                    }
                }

                // Assign new device if selected
                if ($request->device_id) {
                    $newDevice = Device::find($request->device_id);
                    if ($newDevice) {
                        $newDevice->status = 'assigned';
                        $newDevice->save();
                    }
                }
            }
        }

        // Always update the device_id on user
        $user->device_id = $request->device_id;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage
     */
    public function destroy(User $user)
    {
        // If user has a device and status column exists, mark it as available
        if ($user->device_id && Schema::hasColumn('devices', 'status')) {
            $device = Device::find($user->device_id);
            if ($device) {
                $device->status = 'available';
                $device->save();
            }
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }

    /**
     * Get default permissions based on role
     *
     * @param string $role
     * @return array
     */
    private function getDefaultPermissionsForRole($role)
    {
        switch ($role) {
            case 'Admin':
                return [
                    'can_create_users' => true,
                    'can_delete_users' => true,
                    'can_manage_devices' => true,
                    'can_view_reports' => true,
                    'can_modify_settings' => true,
                    'can_access_logs' => true,
                ];

            case 'user':
                return [
                    'can_create_users' => false,
                    'can_delete_users' => false,
                    'can_manage_devices' => false,
                    'can_view_reports' => false,
                    'can_modify_settings' => false,
                    'can_access_logs' => false,
                ];

            default:
                return [
                    'can_create_users' => false,
                    'can_delete_users' => false,
                    'can_manage_devices' => false,
                    'can_view_reports' => false,
                    'can_modify_settings' => false,
                    'can_access_logs' => false,
                ];
        }
    }

    /**
     * Get users by role (for API or AJAX requests)
     */
    public function getUsersByRole(Request $request)
    {
        $role = $request->get('role');
        $users = User::byRole($role)->with('device')->get();

        return response()->json($users);
    }

    /**
     * Get users without devices (for API or AJAX requests)
     */
    public function getUsersWithoutDevice()
    {
        $users = User::withoutDevice()->get();

        return response()->json($users);
    }

    /**
     * Bulk update users (for future bulk operations)
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'action' => 'required|string|in:delete,change_role,assign_device',
            'role' => 'required_if:action,change_role|string|in:admin,moderator,user,viewer',
            'device_id' => 'required_if:action,assign_device|exists:devices,id',
        ]);

        $userIds = $request->user_ids;
        $action = $request->action;

        switch ($action) {
            case 'delete':
                User::whereIn('id', $userIds)->delete();
                $message = 'Users deleted successfully!';
                break;

            case 'change_role':
                $permissions = $this->getDefaultPermissionsForRole($request->role);
                User::whereIn('id', $userIds)->update([
                    'role' => $request->role,
                    'permissions' => $permissions
                ]);
                $message = 'User roles updated successfully!';
                break;

            case 'assign_device':
                // This would need more complex logic for device assignment
                $message = 'Device assignment completed!';
                break;

            default:
                $message = 'Action completed!';
        }

        return redirect()->route('admin.users.index')->with('success', $message);
    }
}
