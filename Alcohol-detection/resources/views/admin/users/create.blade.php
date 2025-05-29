@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="text-blue-500 hover:text-blue-700">
            <i class="fas fa-arrow-left mr-1"></i> Back to Users
        </a>
    </div>

    <div class="bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Create New User</h1>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full rounded border-gray-300 @error('name') border-red-300 @enderror" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full rounded border-gray-300 @error('email') border-red-300 @enderror" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                <input type="password" name="password" id="password"
                    class="w-full rounded border-gray-300 @error('password') border-red-300 @enderror" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-3">Role Assignment *</h2>

                <div class="space-y-3">
                    @php
                        $roles = [
                            'admin' => 'Administrator - Full system access and user management',
                            'moderator' => 'Moderator - Content management and user moderation',
                            'user' => 'User - Standard user access',
                            'viewer' => 'Viewer - Read-only access'
                        ];
                    @endphp

                    @foreach($roles as $role => $description)
                        <div class="p-3 border rounded-lg @if(old('role') == $role) border-blue-500 bg-blue-50 @else border-gray-200 @endif">
                            <div class="flex items-center">
                                <input type="radio" name="role" id="role_{{ $role }}" value="{{ $role }}"
                                    {{ old('role') == $role ? 'checked' : '' }} class="mr-3">
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
                <label for="device_id" class="block text-sm font-medium text-gray-700 mb-1">Assign Device (Optional)</label>
                <select name="device_id" id="device_id" class="w-full rounded border-gray-300">
                    <option value="">No device</option>
                    @foreach($devices as $device)
                        <option value="{{ $device->id }}" {{ old('device_id') == $device->id ? 'selected' : '' }}>
                            {{ $device->name }} ({{ $device->type ?? 'Unknown' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
