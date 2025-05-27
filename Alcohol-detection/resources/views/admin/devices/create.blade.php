@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add New Device</h1>

        <form method="POST" action="{{ route('admin.devices.store') }}">
            @csrf

            <div class="mb-3">
                <label for="device_name" class="form-label">Device Name</label>
                <input type="text" class="form-control" name="name" id="device_name" required>
            </div>

            <div class="mb-3">
                <label for="serial_number" class="form-label">Serial Number</label>
                <input type="text" class="form-control" name="serial_number" id="serial_number" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
