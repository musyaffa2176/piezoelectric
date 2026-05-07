<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function store(Request $request)
    {
        Device::create([
            'nama_device' => $request->nama_device,
            'status' => 1
        ]);

        return back();
    }

    public function destroy($id)
    {
        Device::find($id)->delete();
        return back();
    }

    public function toggle($id)
    {
        $device = Device::find($id);
        $device->status = !$device->status;
        $device->save();

        return back();
    }

    public function update(Request $request,$id)
    {
        $device = Device::find($id);
        $device->nama_device = $request->nama_device;
        $device->save();

        return back();
    }
}