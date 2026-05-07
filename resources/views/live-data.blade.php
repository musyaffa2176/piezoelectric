@extends('layout')

@section('content')
<!-- Google Fonts: Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
    /* 1. GLOBAL THEME (MENGIKUTI DASHBOARD) */
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

    /* ===================================================
       STYLING KARTU & TABEL (GLASSMORPHISM)
       =================================================== */
    .card {
        background: rgba(255, 255, 255, 0.12) !important;
        backdrop-filter: blur(25px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.25) !important;
        border-radius: 30px !important;
        padding: 25px;
        margin-bottom: 35px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05) !important;
    }

    h2 { font-weight: 800; letter-spacing: -1px; text-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    h5 { color: #ffffff !important; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; margin-bottom: 25px; }

    .table-responsive { background: transparent !important; border: none !important; }
    .table { background: transparent !important; color: #ffffff !important; border-collapse: separate !important; border-spacing: 0 8px !important; border: none !important; }
    .table thead th { background: transparent !important; color: rgba(255, 255, 255, 0.8) !important; border: none !important; text-transform: uppercase; font-size: 0.7rem; padding: 15px !important; }
    .table tbody tr { background: rgba(255, 255, 255, 0.1) !important; transition: 0.3s ease; }
    .table tbody tr:hover { background: rgba(255, 255, 255, 0.2) !important; transform: scale(1.01); }
    .table td { background: transparent !important; border: none !important; padding: 18px 15px !important; vertical-align: middle !important; }
    .table td:first-child { border-radius: 15px 0 0 15px !important; }
    .table td:last-child { border-radius: 0 15px 15px 0 !important; }

    /* INPUT & BUTTONS */
    input[type="text"] { background: rgba(255, 255, 255, 0.1) !important; border: 1px solid rgba(255, 255, 255, 0.2) !important; color: #ffffff !important; padding: 8px 15px; border-radius: 12px; outline: none; }
    input[type="text"]:focus { background: rgba(255, 255, 255, 0.2) !important; border-color: #ffffff !important; }

    .battery-container { width: 120px; height: 10px; background: rgba(255, 255, 255, 0.2); border-radius: 20px; overflow: hidden; }
    .battery-fill { height: 100%; background: #ffffff; box-shadow: 0 0 10px rgba(255, 255, 255, 0.8); }

    .status-badge { background: rgba(255, 255, 255, 0.2); padding: 4px 12px; border-radius: 100px; font-size: 0.7rem; font-weight: 700; border: 1px solid rgba(255,255,255,0.3); }
    .btn-modern { border-radius: 12px; font-weight: 700; text-transform: uppercase; font-size: 0.7rem; padding: 8px 15px; border: 1px solid rgba(255,255,255,0.3); background: rgba(255, 255, 255, 0.2); color: white; transition: 0.3s; }
    .btn-modern:hover { background: white; color: #C850C0; transform: translateY(-2px); }
    .btn-add { background: white !important; color: #4158D0 !important; border: none !important; }
</style>

<div class="container mt-4 pb-5">
    <h2>Monitoring Data</h2>

    <!-- TABEL LIVE DATA -->
    <div class="card">
        <h5><span class="status-badge" style="background: white; color: #4158D0; margin-right: 10px;">LIVE</span> Real-time Datalink</h5>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tegangan (V)</th>
                        <th>Tekanan</th>
                        <th>Energi (W)</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody id="liveSensor"></tbody>
            </table>
        </div>
    </div>

    <!-- TABEL BATERAI -->
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

    <!-- MANAJEMEN SENSOR -->
    <div class="card">
        <h5>Piezo Sensor Configuration</h5>
        <form action="/sensor/store" method="POST" class="mb-4 d-flex gap-2">
            @csrf
            <input type="text" name="nama_sensor" class="flex-grow-1" placeholder="Input Nama Sensor..." required>
            <button type="submit" class="btn-modern btn-add shadow-sm">Add Sensor</button>
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
                        <td style="opacity: 0.6">#{{ $sensor->id }}</td>
                        <td>
                            <form action="/sensor/update/{{ $sensor->id }}" method="POST" class="d-flex gap-2">
                                @csrf @method('PUT')
                                <input type="text" name="nama_sensor" value="{{ $sensor->nama_sensor }}" style="font-size: 0.8rem;">
                                <button class="btn-modern btn-sm">Save</button>
                            </form>
                        </td>
                        <td><span class="status-badge">{{ $sensor->status ? 'ACTIVE' : 'OFFLINE' }}</span></td>
                        <td class="text-end">
                            <form action="/sensor/toggle/{{ $sensor->id }}" method="POST" style="display:inline"> @csrf
                                <button class="btn-modern btn-sm">Power</button>
                            </form>
                            <form action="/sensor/delete/{{ $sensor->id }}" method="POST" style="display:inline"> @csrf @method('DELETE')
                                <button class="btn-modern btn-sm" style="background: rgba(255,0,0,0.2);">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MANAJEMEN DEVICE -->
    <div class="card">
        <h5>Output Device Management</h5>
        <form action="/device/store" method="POST" class="mb-4 d-flex gap-2">
            @csrf
            <input type="text" name="nama_device" class="flex-grow-1" placeholder="Input Nama Device..." required>
            <button type="submit" class="btn-modern btn-add shadow-sm">Add Device</button>
        </form>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Device Name</th>
                        <th>State</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($devices as $device)
                    <tr>
                        <td style="opacity: 0.6">#{{ $device->id }}</td>
                        <td>
                            <form action="/device/update/{{ $device->id }}" method="POST" class="d-flex gap-2">
                                @csrf @method('PUT')
                                <input type="text" name="nama_device" value="{{ $device->nama_device }}" style="font-size: 0.8rem;">
                                <button class="btn-modern btn-sm">Save</button>
                            </form>
                        </td>
                        <td><span class="status-badge">{{ $device->status ? 'ON' : 'OFF' }}</span></td>
                        <td class="text-end">
                            <form action="/device/toggle/{{ $device->id }}" method="POST" style="display:inline"> @csrf
                                <button class="btn-modern btn-sm">Switch</button>
                            </form>
                            <form action="/device/delete/{{ $device->id }}" method="POST" style="display:inline"> @csrf @method('DELETE')
                                <button class="btn-modern btn-sm" style="background: rgba(255,0,0,0.2);">Delete</button>
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
                if (data && !data.error) {
                    // 1. UPDATE TABEL LIVE DATALINK
                    const tableBody = document.getElementById("liveSensor");
                    const time = new Date().toLocaleTimeString();
                    
                    let row = `<tr>
                        <td style="opacity: 0.5">#${data.id}</td>
                        <td style="font-weight: 800">${data.tegangan} V</td>
                        <td>${data.tekanan} psi</td>
                        <td style="font-weight: 800">${data.energi} W</td>
                        <td style="opacity: 0.7; font-size: 0.7rem;">${time}</td>
                    </tr>`;

                    // Cek apakah data ini berbeda dengan data terakhir di tabel agar tidak duplikat
                    const firstRow = tableBody.firstChild;
                    if (!firstRow || firstRow.cells[0].innerText !== `#${data.id}`) {
                        tableBody.insertAdjacentHTML("afterbegin", row);
                    }

                    // Batasi hanya 5 baris terakhir agar tidak kepanjangan
                    if (tableBody.children.length > 5) {
                        tableBody.removeChild(tableBody.lastChild);
                    }

                    // 2. UPDATE TABEL BATERAI (Simulasi Berdasarkan Tegangan Asli)
                    // Kita asumsikan baterai penuh di 12V dan kosong di 3V
                    let batteryPersen = Math.min(100, Math.max(0, (data.tegangan / 12) * 100)).toFixed(0);
                    
                    document.getElementById("batteryTable").innerHTML = `
                        <tr>
                            <td style="opacity: 0.5">BT-X1</td>
                            <td><div class="battery-container"><div class="battery-fill" style="width: ${batteryPersen}%"></div></div></td>
                            <td style="font-weight: 800">${batteryPersen}%</td>
                            <td style="font-weight: 800">${data.tegangan} V</td>
                            <td><span class="status-badge">${data.tegangan > 0 ? 'CHARGING' : 'STANDBY'}</span></td>
                        </tr>`;
                }
            })
            .catch(error => console.error('Gagal memuat data:', error));
    }

    // Jalankan setiap 2 detik
    setInterval(updateLiveLogs, 2000);
    updateLiveLogs();
</script>
@endsection