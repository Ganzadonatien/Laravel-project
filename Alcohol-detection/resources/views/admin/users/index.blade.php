@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Manage Users</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3">{{ session('success') }}</div>
    @endif

    <table class="table-auto w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Assigned Device</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>{{ $user->device->name ?? 'Unassigned' }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500 mr-2">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-500" onclick="return confirm('Delete this user?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
