@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" class="text-blue-500 hover:text-blue-700">
            <i class="fas fa-arrow-left mr-1"></i> Back to Users
        </a>
    </div>

    <div class="bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Edit User: {{ $user->name }}</h1>

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <div class="flex border-b">
                    <button type="button" class="px-4 py-2 border-b-2 border-blue-500 text-blue-500 tab-button" data-tab="basic-info">
                        Basic Info
                    </button>
                    <button type="button" class="px-4 py-2 text-gray-500 hover:text-gray-700 tab-button" data-tab="role-permissions">
                        Role & Permissions
                    </button>
                    <button type="button" class="px-4 py-2 text-gray-500 hover:text-gray-700 tab-button" data-tab="device-assignment">
                        Device Assignment
                    </button>
                </div>
            </div>

            <!-- Basic Info Tab -->
            <div class="tab-content" id="basic-info">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="w-full rounded border-gray-300 @error('name') border-red-300 @enderror" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="w-full rounded border-gray-300 @error('email') border-red-300 @enderror" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password (leave blank to keep current)</label>
                    <input type="password" name="password" id="password"
                        class="w-full rounded border-gray-300 @error('password') border-red-300 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Role & Permissions Tab -->
            <div class="tab-content hidden" id="role-permissions">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-3">Role Selection</h2>

                    <div class="space-y-3">
                        @php
                            $roles = [
                                'admin' => 'Administrator - Full system access and user management',
                                'user' => 'User - Standard user access',
                            ];
                        @endphp

                        @foreach($roles as $role => $description)
                            <div class="p-3 border rounded-lg @if(old('role', $user->role) == $role) border-blue-500 bg-blue-50 @else border-gray-200 @endif">
                                <div class="flex items-center">
                                    <input type="radio" name="role" id="role_{{ $role }}" value="{{ $role }}"
                                        {{ old('role', $user->role) == $role ? 'checked' : '' }} class="mr-3 role-radio">
                                    <label for="role_{{ $role }}" class="cursor-pointer flex-1">
                                        <div class="font-medium">{{ ucfirst($role) }}</div>
                                        <div class="text-sm text-gray-500">{{ explode(' - ', $description)[1] }}</div>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-3">Permissions</h2>
                    <p class="text-sm text-gray-500 mb-4">Permissions are automatically set based on the selected role, but can be customized.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-center justify-between p-3 border rounded-lg">
                            <div>
                                <label for="can_create_users" class="font-medium">Create Users</label>
                                <p class="text-sm text-gray-500">Allow creating new user accounts</p>
                            </div>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none">
                                <input type="checkbox" name="permissions[can_create_users]" id="can_create_users"
                                    class="permission-toggle toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                    data-admin="1" data-moderator="0" data-user="0" data-viewer="0"
                                    {{ old('permissions.can_create_users', $user->permissions['can_create_users'] ?? false) ? 'checked' : '' }}>
                                <label for="can_create_users" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 border rounded-lg">
                            <div>
                                <label for="can_delete_users" class="font-medium">Delete Users</label>
                                <p class="text-sm text-gray-500">Allow deleting user accounts</p>
                            </div>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none">
                                <input type="checkbox" name="permissions[can_delete_users]" id="can_delete_users"
                                    class="permission-toggle toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                    data-admin="1" data-moderator="0" data-user="0" data-viewer="0"
                                    {{ old('permissions.can_delete_users', $user->permissions['can_delete_users'] ?? false) ? 'checked' : '' }}>
                                <label for="can_delete_users" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 border rounded-lg">
                            <div>
                                <label for="can_manage_devices" class="font-medium">Manage Devices</label>
                                <p class="text-sm text-gray-500">Allow device management</p>
                            </div>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none">
                                <input type="checkbox" name="permissions[can_manage_devices]" id="can_manage_devices"
                                    class="permission-toggle toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                    data-admin="1" data-moderator="1" data-user="0" data-viewer="0"
                                    {{ old('permissions.can_manage_devices', $user->permissions['can_manage_devices'] ?? false) ? 'checked' : '' }}>
                                <label for="can_manage_devices" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 border rounded-lg">
                            <div>
                                <label for="can_view_reports" class="font-medium">View Reports</label>
                                <p class="text-sm text-gray-500">Allow viewing system reports</p>
                            </div>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none">
                                <input type="checkbox" name="permissions[can_view_reports]" id="can_view_reports"
                                    class="permission-toggle toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                    data-admin="1" data-moderator="1" data-user="0" data-viewer="0"
                                    {{ old('permissions.can_view_reports', $user->permissions['can_view_reports'] ?? false) ? 'checked' : '' }}>
                                <label for="can_view_reports" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 border rounded-lg">
                            <div>
                                <label for="can_modify_settings" class="font-medium">Modify Settings</label>
                                <p class="text-sm text-gray-500">Allow changing system settings</p>
                            </div>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none">
                                <input type="checkbox" name="permissions[can_modify_settings]" id="can_modify_settings"
                                    class="permission-toggle toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                    data-admin="1" data-moderator="0" data-user="0" data-viewer="0"
                                    {{ old('permissions.can_modify_settings', $user->permissions['can_modify_settings'] ?? false) ? 'checked' : '' }}>
                                <label for="can_modify_settings" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 border rounded-lg">
                            <div>
                                <label for="can_access_logs" class="font-medium">Access Logs</label>
                                <p class="text-sm text-gray-500">Allow viewing system logs</p>
                            </div>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none">
                                <input type="checkbox" name="permissions[can_access_logs]" id="can_access_logs"
                                    class="permission-toggle toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                    data-admin="1" data-moderator="1" data-user="0" data-viewer="0"
                                    {{ old('permissions.can_access_logs', $user->permissions['can_access_logs'] ?? false) ? 'checked' : '' }}>
                                <label for="can_access_logs" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Device Assignment Tab -->
            <div class="tab-content hidden" id="device-assignment">
                <div class="mb-6">
                    <label for="device_id" class="block text-sm font-medium text-gray-700 mb-1">Assigned Device</label>
                    <select name="device_id" id="device_id" class="w-full rounded border-gray-300">
                        <option value="">No device</option>
                        @foreach($devices as $device)
                            <option value="{{ $device->id }}"
                                {{ old('device_id', $user->device_id) == $device->id ? 'selected' : '' }}>
                                {{ $device->name }} ({{ $device->type ?? 'Unknown' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                @if($user->device)
                    <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg mb-6">
                        <p class="text-sm text-blue-800">
                            Currently assigned to: <strong>{{ $user->device->name }}</strong>
                        </p>
                    </div>
                @endif
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Tab switching functionality
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons and hide all contents
                tabButtons.forEach(btn => {
                    btn.classList.remove('border-blue-500', 'text-blue-500');
                    btn.classList.add('text-gray-500', 'hover:text-gray-700');
                });
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });

                // Add active class to clicked button and show corresponding content
                button.classList.remove('text-gray-500', 'hover:text-gray-700');
                button.classList.add('border-b-2', 'border-blue-500', 'text-blue-500');

                const tabId = button.getAttribute('data-tab');
                document.getElementById(tabId).classList.remove('hidden');
            });
        });

        // Role-based permission toggling
        const roleRadios = document.querySelectorAll('.role-radio');
        const permissionToggles = document.querySelectorAll('.permission-toggle');

        roleRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                const selectedRole = radio.value;

                permissionToggles.forEach(toggle => {
                    const permissionValue = toggle.getAttribute(`data-${selectedRole}`);
                    toggle.checked = permissionValue === '1';
                });
            });
        });

        // Add custom styles for toggle switches
        const style = document.createElement('style');
        style.textContent = `
            .toggle-checkbox:checked {
                right: 0;
                border-color: #3b82f6;
            }
            .toggle-checkbox:checked + .toggle-label {
                background-color: #3b82f6;
            }
            .toggle-label {
                transition: background-color 0.2s ease;
            }
        `;
        document.head.appendChild(style);
    });
</script>
@endsection
