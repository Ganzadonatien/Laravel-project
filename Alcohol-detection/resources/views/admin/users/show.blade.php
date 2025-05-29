@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" class="text-blue-500 hover:text-blue-700">
            <i class="fas fa-arrow-left mr-1"></i> Back to Users
        </a>
    </div>

    <div class="bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-6">User Details</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded">
                <h2 class="text-lg font-semibold mb-4">Basic Information</h2>

                <div class="mb-4">
                    <p class="text-sm text-gray-600">Name</p>
                    <p class="font-medium">{{ $user->name }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-medium">{{ $user->email }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Role</p>
                    @php
                        $roleClass = match(strtolower($user->role)) {
                            'admin' => 'bg-red-100 text-red-800',
                            'moderator' => 'bg-blue-100 text-blue-800',
                            'user' => 'bg-green-100 text-green-800',
                            default => 'bg-gray-100 text-gray-800'
                        };

                        $roleDescription = match(strtolower($user->role)) {
                            'admin' => 'Full system access and user management',
                            'moderator' => 'Content management and user moderation',
                            'user' => 'Standard user access',
                            default => 'Custom role'
                        };
                    @endphp
                    <div class="flex items-center mt-1">
                        <span class="px-2 py-1 text-xs rounded-full {{ $roleClass }}">
                            {{ ucfirst($user->role) }}
                        </span>
                        <span class="ml-2 text-sm text-gray-600">{{ $roleDescription }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded">
                <h2 class="text-lg font-semibold mb-4">Device Assignment</h2>

                <div class="mb-4">
                    <p class="text-sm text-gray-600">Assigned Device</p>
                    @if($user->device)
                        <p class="font-medium">{{ $user->device->name }}</p>
                        <p class="text-sm text-gray-600">Type: {{ $user->device->type ?? 'N/A' }}</p>
                    @else
                        <p class="text-gray-500 italic">No device assigned</p>
                    @endif
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded">
                <h2 class="text-lg font-semibold mb-4">Account Activity</h2>

                <div class="mb-4">
                    <p class="text-sm text-gray-600">Account Created</p>
                    <p class="font-medium">{{ $user->created_at->format('M d, Y') }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Last Login</p>
                    @if($user->last_login)
                        <p class="font-medium">{{ \Carbon\Carbon::parse($user->last_login)->format('M d, Y H:i') }}</p>
                    @else
                        <p class="text-gray-500 italic">Never logged in</p>
                    @endif
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded">
                <h2 class="text-lg font-semibold mb-4">Actions</h2>

                <div class="flex space-x-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        <i class="fas fa-edit mr-1"></i> Edit User
                    </a>

                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded" onclick="return confirm('Are you sure you want to delete this user?')">
                            <i class="fas fa-trash mr-1"></i> Delete User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
