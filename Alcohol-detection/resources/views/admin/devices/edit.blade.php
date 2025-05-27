<form action="{{ route('admin.devices.update', $device->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Device Name</label>
    <input type="text" name="name" value="{{ $device->name }}" class="block mb-2">

    <label for="serial_number">Serial Number</label>
    <input type="text" name="serial_number" value="{{ $device->serial_number }}" class="block mb-2">

    <label for="user_id">Assign to User</label>
    <select name="user_id" class="block mb-4">
        <option value="">-- Unassigned --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $device->user_id == $user->id ? 'selected' : '' }}>
                {{ $user->name }} ({{ $user->email }})
            </option>
        @endforeach
    </select>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Device</button>
</form>
