@extends('layout')

@section('content')
<!-- Google Fonts: Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
    /* 1. GLOBAL THEME (BRIGHT GLASSMORPHISM) */
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
    .custom-card {
        background: rgba(255, 255, 255, 0.12) !important;
        backdrop-filter: blur(25px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.25) !important;
        border-radius: 30px !important;
        padding: 40px;
        margin-bottom: 35px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05) !important;
    }

    h2 {
        font-weight: 800;
        letter-spacing: -1px;
        color: #ffffff !important;
        text-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin: 20px 0 35px 0;
    }

    .card-title-custom {
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
        color: #ffffff;
        margin: 0;
    }

    /* TABEL STYLE (TRANSPARAN) */
    .table-responsive {
        background: transparent !important;
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
        letter-spacing: 1.5px;
        padding: 15px !important;
    }

    .table tbody tr {
        background: rgba(255, 255, 255, 0.1) !important;
        transition: 0.3s ease;
    }

    .table tbody tr:hover {
        background: rgba(255, 255, 255, 0.2) !important;
        transform: scale(1.01);
    }

    .table td {
        background: transparent !important;
        border: none !important;
        padding: 20px 15px !important;
        vertical-align: middle;
        font-weight: 600;
    }

    .table td:first-child { border-radius: 15px 0 0 15px !important; }
    .table td:last-child { border-radius: 0 15px 15px 0 !important; }

    /* BADGES & STATUS */
    .status-badge {
        padding: 6px 16px;
        border-radius: 100px;
        font-size: 0.7rem;
        font-weight: 700;
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        text-transform: uppercase;
        display: inline-block;
    }

    /* TOMBOL PDF */
    .btn-pdf {
        background: white;
        color: #4158D0 !important;
        padding: 10px 22px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 800;
        font-size: 0.75rem;
        text-transform: uppercase;
        transition: 0.3s;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-pdf:hover {
        background: rgba(255, 255, 255, 0.9);
        transform: translateY(-2px);
    }

    .header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
</style>

<div class="container mt-4 pb-5">
    <h2>Weekly Analytics</h2>

    <div class="custom-card">
        
        <div class="header-flex">
            <h5 class="card-title-custom">Riwayat Sensor Piezoelectric (7 Hari Terakhir)</h5>
            <a href="/history/pdf" class="btn-pdf">
                📄 Download PDF
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Hari</th>
                        <th>Tegangan Rata-rata</th>
                        <th>Tekanan</th>
                        <th>Energi Total</th>
                        <th class="text-end">Status Sistem</th>
                    </tr>
                </thead>

                <tbody>
    @foreach($sensorHistory as $index => $data)
    <tr>
        <td style="opacity: 0.5;">#{{ $loop->iteration }}</td>
        <td><strong>{{ $data->created_at->isoFormat('dddd') }}</strong></td>
        <td>{{ number_format($data->tegangan, 2) }} V</td>
        <td>{{ $data->tekanan }} psi</td>
        <td>{{ number_format($data->energi, 1) }} W</td>
        <td class="text-end">
            <span class="status-badge">
                {{ $data->tekanan > 30 ? 'Tinggi' : 'Normal' }}
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