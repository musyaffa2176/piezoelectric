<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    // =========================================
    // SIMPAN DATA SENSOR
    // =========================================
    public function store(Request $request)
    {
        $request->validate([
            'nama_sensor' => 'required',
            'tegangan'    => 'required|numeric',
            'tekanan'     => 'required|numeric',
            'energi'      => 'required|numeric',
        ]);

        Sensor::create([
            'nama_sensor' => $request->nama_sensor,
            'tegangan'    => $request->tegangan,
            'tekanan'     => $request->tekanan,
            'energi'      => $request->energi,
            'status'      => 1
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success'
            ], 201);
        }

        return back()->with(
            'success',
            'Data sensor berhasil disimpan.'
        );
    }

    // =========================================
    // HAPUS SENSOR
    // =========================================
    public function destroy($id)
    {
        $sensor = Sensor::find($id);

        if ($sensor) {
            $sensor->delete();
        }

        return back();
    }

    // =========================================
    // TOGGLE SENSOR
    // =========================================
    public function toggle($id)
    {
        $sensor = Sensor::find($id);

        if ($sensor) {
            $sensor->status = !$sensor->status;
            $sensor->save();
        }

        return back();
    }

    // =========================================
    // UPDATE SENSOR
    // =========================================
    public function update(Request $request, $id)
    {
        $sensor = Sensor::find($id);

        if ($sensor) {
            $sensor->nama_sensor = $request->nama_sensor;
            $sensor->save();
        }

        return back();
    }

    // =========================================
    // HISTORY SENSOR
    // =========================================
    public function history()
    {
        $sensorHistory = Sensor::where(
                'created_at',
                '>=',
                now()->subDays(7)
            )
            ->orderBy('created_at', 'desc')
            ->get();

        return view(
            'history',
            compact('sensorHistory')
        );
    }

    // =========================================
    // EXPORT PDF
    // =========================================
    public function exportPdf()
    {
        \Carbon\Carbon::setLocale('id');

        $data = Sensor::orderBy(
                'created_at',
                'desc'
            )
            ->take(7)
            ->get();

        $pdf = Pdf::loadView(
            'pdf.history',
            compact('data')
        );

        $pdf->setPaper('a4', 'portrait');

        return $pdf->download(
            'history-sensor.pdf'
        );
    }

    // =========================================
    // API REALTIME FIREBASE
    // =========================================
    public function latestSensor()
    {
        try {

            $database = app('firebase.database');

            $data = $database
                ->getReference('sensor')
                ->getValue();

            return response()->json([

                'tegangan' =>
                    $data['tegangan'] ?? 0,

                'arus' =>
                    $data['arus'] ?? 0,

                'ldr' =>
                    $data['ldr'] ?? 0,

                'piezo' =>
                    $data['piezo'] ?? 0,

                'battery_percent' =>
                    $data['battery_percent'] ?? 0,

                'status_getaran' =>
                    $data['status_getaran'] ?? '-',

                'status_led' =>
                    $data['status_led'] ?? '-',
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}