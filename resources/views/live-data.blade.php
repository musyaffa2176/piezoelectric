@extends('layout')

@section('content')
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
        background-attachment: fixed;
        min-height: 100vh;
        color: #ffffff !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
        overflow-x: hidden;
    }

    .card {
        background: rgba(255, 255, 255, 0.12) !important;
        backdrop-filter: blur(25px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.25) !important;
        border-radius: 30px !important;
        padding: 25px;
        margin-bottom: 35px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05) !important;
    }

    h2 {
        font-weight: 800;
        letter-spacing: -1px;
    }

    h5 {
        color: #ffffff !important;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
        margin-bottom: 25px;
    }

    .table {
        background: transparent !important;
        color: #ffffff !important;
        border-collapse: separate !important;
        border-spacing: 0 8px !important;
        border: none !important;
    }

    .table thead th {
        background: transparent !important;
        color: rgba(255, 255, 255, 0.8) !important;
        border: none !important;
        text-transform: uppercase;
        font-size: 0.7rem;
        padding: 15px !important;
    }

    .table tbody tr {
        background: rgba(255, 255, 255, 0.1) !important;
    }

    .table td {
        background: transparent !important;
        border: none !important;
        padding: 18px 15px !important;
        vertical-align: middle !important;
    }

    .table td:first-child {
        border-radius: 15px 0 0 15px !important;
    }

    .table td:last-child {
        border-radius: 0 15px 15px 0 !important;
    }

    .battery-container {
        width: 120px;
        height: 10px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        overflow: hidden;
    }

    .battery-fill {
        height: 100%;
        background: #ffffff;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
    }

    .status-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 0.7rem;
        font-weight: 700;
        border: 1px solid rgba(255,255,255,0.3);
    }

    .btn-modern {
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.7rem;
        padding: 8px 15px;
        border: 1px solid rgba(255,255,255,0.3);
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .btn-add {
        background: white !important;
        color: #4158D0 !important;
        border: none !important;
    }

    input[type="text"] {
        background: rgba(255, 255, 255, 0.1) !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        color: #ffffff !important;
        padding: 8px 15px;
        border-radius: 12px;
        outline: none;
    }
</style>

<div class="container mt-4 pb-5">

    <h2>Monitoring Data</h2>

    <!-- LIVE DATA -->
    <div class="card">
        <h5>
            <span class="status-badge"
                  style="background: white; color: #4158D0; margin-right: 10px;">
                  LIVE
            </span>
            Real-time Datalink
        </h5>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tegangan (V)</th>
                        <th>LDR</th>
                        <th>Energi (W)</th>
                        <th>Waktu</th>
                    </tr>
                </thead>

                <tbody id="liveSensor"></tbody>
            </table>
        </div>
    </div>

    <!-- BATTERY -->
    <div class="card">
        <h5>Battery Storage Status</h5>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Device ID</th>
                        <th>Visual</th>
                        <th>Capacity</th>
                        <th>Inbound</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id="batteryTable"></tbody>
            </table>
        </div>
    </div>

    <!-- SENSOR -->
    <div class="card">
        <h5>Piezo Sensor Configuration</h5>

        <form action="/sensor/store" method="POST" class="mb-4 d-flex gap-2">
            @csrf

            <input type="text"
                   name="nama_sensor"
                   class="flex-grow-1"
                   placeholder="Input Nama Sensor..."
                   required>

            <button type="submit" class="btn-modern btn-add shadow-sm">
                Add Sensor
            </button>
        </form>

        <div class="table-responsive">
            <table class="table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sensor Name</th>
                        <th>State</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($sensors as $sensor)
                    <tr>

                        <td style="opacity: 0.6">
                            #{{ $sensor->id }}
                        </td>

                        <td>
                            <form action="/sensor/update/{{ $sensor->id }}"
                                  method="POST"
                                  class="d-flex gap-2">

                                @csrf
                                @method('PUT')

                                <input type="text"
                                       name="nama_sensor"
                                       value="{{ $sensor->nama_sensor }}"
                                       style="font-size: 0.8rem;">

                                <button class="btn-modern btn-sm">
                                    Save
                                </button>
                            </form>
                        </td>

                        <td>
                            <span class="status-badge">
                                {{ $sensor->status ? 'ACTIVE' : 'OFFLINE' }}
                            </span>
                        </td>

                        <td class="text-end">

                            <form action="/sensor/toggle/{{ $sensor->id }}"
                                  method="POST"
                                  style="display:inline">

                                @csrf

                                <button class="btn-modern btn-sm">
                                    Power
                                </button>
                            </form>

                            <form action="/sensor/delete/{{ $sensor->id }}"
                                  method="POST"
                                  style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn-modern btn-sm"
                                        style="background: rgba(255,0,0,0.2);">

                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

<script>

function updateLiveLogs() {

    fetch('/api/latest-sensor')

        .then(response => response.json())

        .then(data => {

            console.log('Firebase Data:', data);

            if (data && !data.error) {

                // ============================
                // AMBIL DATA FIREBASE
                // ============================

                // Tegangan
                const tegangan = parseFloat(data.tegangan || 0);

                // Arus
                const arus = parseFloat(data.arus || 0);

                // LDR
                const ldr = parseInt(data.tekanan ?? data.ldr ?? 0);

                // Energi Piezo
                const energi = parseFloat(data.piezo || 0);

                // Battery %
                const batteryPersen = parseFloat(
                    data.battery_percent || 0
                ).toFixed(0);

                // Kondisi
                const kondisi = data.kondisi || '-';

                // Waktu
                const time = new Date().toLocaleTimeString();

                // Device ID
                const deviceId = "BT-X1";

                // ============================
                // STATUS BATERAI
                // ============================

                let batteryStatus = 'STANDBY';

                if (Number(batteryPersen) > 0) {
                    batteryStatus = 'CHARGING';
                }

                if (Number(batteryPersen) >= 100) {
                    batteryStatus = 'FULL';
                }

                if (kondisi === 'Gelap' &&
                    Number(batteryPersen) > 0) {

                    batteryStatus = 'ACTIVE';
                }

                // ============================
                // UPDATE LIVE TABLE
                // ============================

                document.getElementById("liveSensor").innerHTML = `
                    <tr>

                        <td style="opacity: 0.5">
                            #${deviceId}
                        </td>

                        <td style="font-weight: 800">
                            ${tegangan.toFixed(3)} V
                        </td>

                        <td>
                            ${ldr}
                        </td>

                        <td style="font-weight: 800">
                            ${energi.toFixed(0)} W
                        </td>

                        <td style="opacity: 0.7; font-size: 0.7rem;">
                            ${time}
                        </td>

                    </tr>
                `;

                // ============================
                // UPDATE BATTERY TABLE
                // ============================

                document.getElementById("batteryTable").innerHTML = `
                    <tr>

                        <td style="opacity: 0.5">
                            ${deviceId}
                        </td>

                        <td>
                            <div class="battery-container">

                                <div class="battery-fill"
                                     style="width: ${batteryPersen}%">
                                </div>

                            </div>
                        </td>

                        <td style="font-weight: 800">
                            ${batteryPersen}%
                        </td>

                        <td style="font-weight: 800">
                            ${arus.toFixed(2)} mA
                        </td>

                        <td>
                            <span class="status-badge">
                                ${batteryStatus}
                            </span>
                        </td>

                    </tr>
                `;
            }
        })

        .catch(error => {
            console.error('Gagal mengambil data:', error);
        });
}

// Refresh setiap 2 detik
setInterval(updateLiveLogs, 2000);

// Pertama kali load
updateLiveLogs();

</script>

@endsection