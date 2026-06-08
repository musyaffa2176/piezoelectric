@extends('layout')

@section('content')
<!-- Google Fonts: Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
    /* 1. ELEGANT SAPPHIRE THEME (SAMA DENGAN DASHBOARD) */
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

    /* 2. MODERN GLASS CARD (AERO DESIGN) */
    .custom-card {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(25px) saturate(180%);
        -webkit-backdrop-filter: blur(25px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 30px !important;
        padding: 40px;
        margin-bottom: 35px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3) !important;
    }

    .card-title-custom {
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
        color: #94a3b8;
        margin: 0;
    }

    /* 3. TABLE STYLING (TRANSPARAN & TERANG) */
    .table-responsive {
        background: transparent !important;
    }

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

    .table tbody tr:hover {
        background: rgba(255, 255, 255, 0.05) !important;
        transform: scale(1.005);
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

    /* CLASS UNTUK ANGKA AGAR MENYALA (TIDAK GELAP) */
    .data-highlight {
        color: #ffffff !important;
        font-weight: 800 !important;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }

    .data-cyan {
        color: #00f2ff !important;
        font-weight: 800 !important;
        text-shadow: 0 0 12px rgba(0, 242, 255, 0.6);
    }

    /* 4. BADGES & BUTTONS */
    .status-badge {
        padding: 6px 16px;
        border-radius: 100px;
        font-size: 0.7rem;
        font-weight: 800;
        background: rgba(34, 211, 238, 0.1);
        border: 1px solid rgba(34, 211, 238, 0.3);
        color: #22d3ee;
        text-transform: uppercase;
        display: inline-block;
    }

    .btn-pdf {
        background: #ffffff;
        color: #0f172a !important;
        padding: 12px 24px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 800;
        font-size: 0.75rem;
        text-transform: uppercase;
        transition: 0.3s ease;
        border: none;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-pdf:hover {
        background: #f8fafc;
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    }

    .header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .day-label {
        font-weight: 700;
        color: #ffffff;
    }
</style>

<div class="ambient-glow"></div>

<div class="container mt-5 pb-5">
    <h2>Weekly <span style="font-weight: 300; color: #22d3ee;">Analytics</span></h2>

    <div class="custom-card">
        
        <div class="header-flex">
            <h5 class="card-title-custom">Sensor History (Last 7 Days)</h5>
            <a href="/history/pdf" class="btn-pdf">
                📄 Export to PDF
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="80">Log ID</th>
                        <th>Day of Week</th>
                        <th>Avg. Voltage</th>
                        <th>Pressure</th>
                        <th>Energy Total</th>
                        <th class="text-end">System State</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($sensorHistory as $index => $data)
                    <tr>
                        <td style="color: #64748b; font-size: 0.8rem;">#HIST-{{ $loop->iteration }}</td>
                        <td class="day-label">{{ $data->created_at->isoFormat('dddd') }}</td>
                        
                        <!-- Angka-angka di bawah ini sudah diberi class agar TERANG -->
                        <td class="data-highlight">{{ number_format($data->tegangan, 2) }} V</td>
                        <td class="data-highlight">{{ $data->tekanan }} psi</td>
                        <td class="data-cyan">{{ number_format($data->energi, 1) }} W</td>
                        
                        <td class="text-end">
                            <span class="status-badge" style="{{ $data->tekanan > 30 ? 'color: #fbbf24; border-color: rgba(251, 191, 36, 0.3); background: rgba(251, 191, 36, 0.1);' : '' }}">
                                {{ $data->tekanan > 30 ? 'High Load' : 'Optimal' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection