@extends('layout')

@section('content')
<!-- Google Fonts: Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
    /* 1. ELEGANT SAPPHIRE THEME */
    body {
        margin: 0;
        padding: 0;
        background: radial-gradient(circle at top left, #1e3a8a 0%, #0f172a 60%, #020617 100%);
        background-attachment: fixed;
        min-height: 100vh;
        color: #f8fafc;
        font-family: 'Plus Jakarta Sans', sans-serif;
        overflow-x: hidden;
    }

    .ambient-glow {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: 
            radial-gradient(circle at 80% 20%, rgba(34, 211, 238, 0.08) 0%, transparent 40%),
            radial-gradient(circle at 20% 80%, rgba(99, 102, 241, 0.08) 0%, transparent 40%);
        z-index: -1;
        pointer-events: none;
    }

    h2 {
        font-weight: 800;
        letter-spacing: -2px;
        font-size: 2.5rem;
        margin-bottom: 40px;
        text-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    /* 2. MODERN GLASS CARD */
    .card {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(25px) saturate(180%);
        -webkit-backdrop-filter: blur(25px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 28px !important;
        padding: 30px;
        margin-bottom: 35px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3) !important;
        transition: all 0.4s ease;
    }

    h5 {
        color: #94a3b8 !important;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.8rem;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
    }

    /* 3. ELEGANT TABLE STYLING */
    .table {
        background: transparent !important;
        color: #ffffff !important;
        border-collapse: separate !important;
        border-spacing: 0 10px !important;
        border: none !important;
    }

    .table thead th {
        background: transparent !important;
        color: #64748b !important;
        border: none !important;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 1.5px;
        padding: 15px !important;
    }

    .table tbody tr {
        background: rgba(255, 255, 255, 0.02) !important;
        transition: all 0.3s ease;
    }

    .table td {
        background: transparent !important;
        border: none !important;
        padding: 20px 15px !important;
        vertical-align: middle !important;
        font-weight: 500;
    }

    .table td:first-child { border-radius: 18px 0 0 18px !important; }
    .table td:last-child { border-radius: 0 18px 18px 0 !important; }

    /* 4. COMPONENTS */
    .battery-container {
        width: 120px; height: 8px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        overflow: hidden;
    }

    .battery-fill {
        height: 100%;
        background: linear-gradient(90deg, #22d3ee, #6366f1);
        box-shadow: 0 0 12px rgba(34, 211, 238, 0.5);
        transition: width 1s ease;
    }

    .status-badge {
        background: rgba(34, 211, 238, 0.1);
        padding: 5px 14px;
        border-radius: 100px;
        font-size: 0.7rem;
        font-weight: 800;
        color: #22d3ee;
        border: 1px solid rgba(34, 211, 238, 0.2);
        text-transform: uppercase;
    }

    .btn-modern {
        border-radius: 14px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.7rem;
        padding: 10px 18px;
        border: 1px solid rgba(255,255,255,0.1);
        background: rgba(255, 255, 255, 0.05);
        color: white;
        transition: all 0.3s ease;
    }

    .btn-modern:hover {
        background: white;
        color: #0f172a;
        transform: translateY(-2px);
    }

    .btn-add {
        background: #ffffff !important;
        color: #0f172a !important;
        border: none !important;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    input[type="text"] {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #ffffff !important;
        padding: 12px 20px;
        border-radius: 14px;
        outline: none;
    }

    .live-dot {
        height: 8px; width: 8px;
        background-color: #22d3ee;
        border-radius: 50%;
        display: inline-block;
        margin-right: 12px;
        box-shadow: 0 0 10px #22d3ee;
        animation: blink 2s infinite;
    }

    @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0.3; } }
</style>

<div class="ambient-glow"></div>

<div class="container mt-5 pb-5">

    <h2>Monitoring <span style="font-weight: 300; color: #22d3ee;">Data</span></h2>

    <!-- LIVE DATA -->
    <div class="card">
        <h5><span class="live-dot"></span>Real-time Datalink</h5>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tegangan (V)</th>
                        <th>LDR Index</th>
                        <th>Energi (W)</th>
                        <th>Timestamp</th>
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
                        <th>Visual Level</th>
                        <th>Capacity</th>
                        <th>Inbound Current</th>
                        <th>System State</th>
                    </tr>
                </thead>
                <tbody id="batteryTable"></tbody>
            </table>
        </div>
    </div>

    <!-- SENSOR CONFIGURATION -->
    <div class="card">
        <h5>Configuration: Piezo Node</h5>
        <form action="/sensor/store" method="POST" class="mb-4 d-flex gap-3">
            @csrf
            <input type="text" name="nama_sensor" class="flex-grow-1" placeholder="Enter Node Name..." required>
            <button type="submit" class="btn-modern btn-add">Add New Sensor</button>
        </form>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sensor Name</th>
                        <th>Operational State</th>
                        <th class="text-end">Management</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sensors as $sensor)
                    <tr>
                        <td style="color: #64748b;">#{{ $sensor->id }}</td>
                        <td>
                            <form action="/sensor/update/{{ $sensor->id }}" method="POST" class="d-flex gap-2">
                                @csrf @method('PUT')
                                <input type="text" name="nama_sensor" value="{{ $sensor->nama_sensor }}" style="font-size: 0.85rem; padding: 6px 15px;">
                                <button class="btn-modern btn-sm">Save</button>
                            </form>
                        </td>
                        <td>
                            <span class="status-badge" style="{{ $sensor->status ? '' : 'color: #ef4444; border-color: rgba(239, 68, 68, 0.2); background: rgba(239, 68, 68, 0.05);' }}">
                                {{ $sensor->status ? 'ACTIVE' : 'OFFLINE' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <form action="/sensor/toggle/{{ $sensor->id }}" method="POST" style="display:inline"> @csrf
                                <button class="btn-modern btn-sm">Power</button>
                            </form>
                            <form action="/sensor/delete/{{ $sensor->id }}" method="POST" style="display:inline"> @csrf @method('DELETE')
                                <button class="btn-modern btn-sm" style="color: #ef4444;">Delete</button>
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
                const tegangan = parseFloat(data.tegangan || 0);
                const arus = parseFloat(data.arus || 0);
                const ldr = parseInt(data.tekanan ?? data.ldr ?? 0);
                const energi = parseFloat(data.piezo || 0);
                const batteryPersen = parseFloat(data.battery_percent || 0).toFixed(0);
                const kondisi = data.kondisi || '-';
                const time = new Date().toLocaleTimeString();
                const deviceId = "BT-X1";

                let batteryStatus = 'STANDBY';
                if (Number(batteryPersen) > 0) batteryStatus = 'CHARGING';
                if (Number(batteryPersen) >= 100) batteryStatus = 'FULL';
                if (kondisi === 'Gelap' && Number(batteryPersen) > 0) batteryStatus = 'ACTIVE';

                // STYLING UNTUK ANGKA AGAR MENYALA (PUTIH TERANG)
                const brightStyle = "color: #ffffff !important; font-weight: 800; text-shadow: 0 0 10px rgba(255,255,255,0.5);";
                const cyanStyle = "color: #00f2ff !important; font-weight: 800; text-shadow: 0 0 12px rgba(0,242,255,0.6);";

                // UPDATE LIVE TABLE
                document.getElementById("liveSensor").innerHTML = `
                    <tr>
                        <td style="color: #64748b;">#CORE-NX</td>
                        <td style="font-weight: 800; color: #ffffff;">${tegangan.toFixed(3)} V</td>
                        <td style="${brightStyle}">${ldr}</td> <!-- LDR INDEX: PUTIH TERANG -->
                        <td style="${cyanStyle}">${energi.toFixed(0)} W</td>
                        <td style="color: #64748b; font-size: 0.75rem;">${time}</td>
                    </tr>
                `;

                // UPDATE BATTERY TABLE
                document.getElementById("batteryTable").innerHTML = `
                    <tr>
                        <td style="color: #64748b;">${deviceId}</td>
                        <td>
                            <div class="battery-container">
                                <div class="battery-fill" style="width: ${batteryPersen}%"></div>
                            </div>
                        </td>
                        <td style="${brightStyle}">${batteryPersen}%</td> <!-- CAPACITY: PUTIH TERANG -->
                        <td style="${brightStyle}">${arus.toFixed(2)} mA</td> <!-- INBOUND: PUTIH TERANG -->
                        <td><span class="status-badge">${batteryStatus}</span></td>
                    </tr>
                `;
            }
        })
        .catch(error => console.error('Gagal mengambil data:', error));
}

setInterval(updateLiveLogs, 2000);
updateLiveLogs();
</script>
@endsection