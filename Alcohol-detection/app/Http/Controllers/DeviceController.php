<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\User;

class DeviceController extends Controller
{




public function index()
{
    $devices = Device::with('user')->get();
    return view('admin.devices.index', compact('devices'));
}
public function create()
{
    $users = User::all();
    return view('admin.devices.create', compact('users'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'serial_number' => 'required|unique:devices',
        'user_id' => 'nullable|exists:users,id',
    ]);

    Device::create($request->all());

    return redirect()->route('admin.devices.index')->with('success', 'Device created successfully!');
}

public function edit($id)
{
    $device = Device::findOrFail($id);
    $users = User::all();
    return view('admin.devices.edit', compact('device', 'users'));
}

public function update(Request $request, $id)
{
    $device = Device::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'serial_number' => 'required|unique:devices,serial_number,' . $id,
        'user_id' => 'nullable|exists:users,id',
    ]);

    $device->update($request->all());

    return redirect()->route('admin.devices.index')->with('success', 'Device updated!');
}

public function destroy($id)
{
    $device = Device::findOrFail($id);
    $device->delete();

    return redirect()->route('admin.devices.index')->with('success', 'Device deleted!');
}
 //
}
