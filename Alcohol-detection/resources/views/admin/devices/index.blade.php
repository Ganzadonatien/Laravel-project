@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Manage Devices</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.devices.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-3 inline-block">Add Device</a>

    <table class="table-auto w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Name</th>
                <th>Serial</th>
                <th>Assigned To</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devices as $device)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $device->name }}</td>
                <td>{{ $device->serial_number }}</td>
                <td>{{ $device->user->name ?? 'Unassigned' }}</td>
                <td>
                    <a href="{{ route('admin.devices.edit', $device) }}" class="text-blue-500 mr-2">Edit</a>
                    <form action="{{ route('admin.devices.destroy', $device) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-500" onclick="return confirm('Delete this device?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
