<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    // ✅ SIMPAN DATA SENSOR (Otomatis dari alat atau form)
    public function store(Request $request)
    {
        // Gunakan nullable atau default jika kamu ingin alat tidak wajib mengirim semua field
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
            // Kolom 'created_at' tidak perlu ditulis karena Laravel/Database mengisinya otomatis
        ]);

        // Jika request berasal dari alat (API), sebaiknya kembalikan JSON
        if ($request->expectsJson()) {
            return response()->json(['status' => 'success'], 201);
        }

        return back()->with('success', 'Data sensor berhasil disimpan.');
    }

    // ✅ HAPUS SENSOR
    public function destroy($id)
    {
        $sensor = Sensor::find($id);
        if ($sensor) {
            $sensor->delete();
        }
        return back();
    }

    // ✅ TOGGLE ON/OFF (Status Sensor)
    public function toggle($id)
    {
        $sensor = Sensor::find($id);
        if ($sensor) {
            $sensor->status = !$sensor->status;
            $sensor->save();
        }
        return back();
    }

    // ✅ UPDATE NAMA SENSOR
    public function update(Request $request, $id)
    {
        $sensor = Sensor::find($id);
        if ($sensor) {
            $sensor->nama_sensor = $request->nama_sensor;
            $sensor->save();
        }
        return back();
    }

    // ✅ MENAMPILKAN HALAMAN RIWAYAT (WEEKLY ANALYTICS)
    public function history()
    {
        // Mengambil data sensor 7 hari terakhir sesuai logika desain kamu
        $sensorHistory = Sensor::where('created_at', '>=', now()->subDays(7))
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('history', compact('sensorHistory'));
    }

    public function exportPdf()
    {
        // Mengatur bahasa Carbon ke Indonesia agar nama hari otomatis benar
        \Carbon\Carbon::setLocale('id');
    
        // Ambil data 7 hari terakhir agar sesuai dengan judul di gambar
        $data = Sensor::orderBy('created_at', 'desc')->take(7)->get();
    
        $pdf = Pdf::loadView('pdf.history', compact('data'));
        $pdf->setPaper('a4', 'portrait');
    
        return $pdf->download('history-sensor.pdf');
    }
}