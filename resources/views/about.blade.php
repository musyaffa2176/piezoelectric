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
       STYLING KARTU & KONTEN (GLASSMORPHISM)
       =================================================== */
    .card {
        background: rgba(255, 255, 255, 0.12) !important;
        backdrop-filter: blur(25px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        border-radius: 30px !important;
        padding: 45px;
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

    h4 {
        color: #ffffff !important;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 25px;
    }

    p {
        line-height: 1.8;
        font-size: 1.05rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 20px;
    }

    /* LIST STYLING (IDENTIK DENGAN BARIS TABEL) */
    .feature-list, .tech-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 30px;
    }

    .feature-list li, .tech-list li {
        position: relative;
        padding: 15px 20px 15px 45px;
        margin-bottom: 12px;
        color: #ffffff;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.1); /* Efek baris tabel */
        border-radius: 18px;
        transition: 0.3s ease;
    }

    .feature-list li::before {
        content: "✓";
        position: absolute;
        left: 18px;
        font-weight: 900;
    }

    .tech-list li::before {
        content: "○";
        position: absolute;
        left: 18px;
        font-weight: 900;
    }

    .feature-list li:hover, .tech-list li:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateX(10px);
    }

    .highlight {
        color: #ffffff;
        font-weight: 800;
        background: rgba(255, 255, 255, 0.2);
        padding: 3px 10px;
        border-radius: 8px;
    }

    .section-title {
        color: rgba(255, 255, 255, 0.7);
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 2px;
        margin-bottom: 20px;
        display: block;
    }

    hr {
        border-color: rgba(255, 255, 255, 0.2);
        margin: 40px 0;
    }
</style>

<div class="container mt-4 pb-5">
    <h2>System Information</h2>

    <div class="card">
        <h4>Piezoelectric Energy Monitoring System</h4>
        
        <p>
            Project <span class="highlight">PiezoCore IoT</span> adalah sistem cerdas yang dirancang khusus untuk memonitoring konversi energi mekanik menjadi energi listrik melalui sensor <span class="highlight">Piezoelectric</span> secara real-time dan presisi.
        </p>

        <hr>

        <span class="section-title">Core Features:</span>
        <ul class="feature-list">
            <li>Monitoring output tegangan dan daya secara realtime.</li>
            <li>Kontrol perangkat output LED secara remote via Dashboard.</li>
            <li>Visualisasi data interaktif menggunakan grafik gelombang energi.</li>
            <li>Penyimpanan history log untuk analisis performa sistem mingguan.</li>
        </ul>

        <span class="section-title">Development Stack:</span>
        <ul class="tech-list">
            <li><strong>Backend Framework:</strong> Laravel 11 (PHP 8.x)</li>
            <li><strong>Frontend UI:</strong> Bootstrap 5 & Bright Glassmorphism CSS</li>
            <li><strong>Data Visualization:</strong> Chart.js 4.x</li>
            <li><strong>Hardware Integration:</strong> ESP32 Framework via REST API</li>
        </ul>

        <p style="font-size: 0.85rem; color: rgba(255, 255, 255, 0.5); margin-top: 30px; font-weight: 600;">
            &copy; 2024 PiezoCore Project Team - Sustainable Energy Monitoring System.
        </p>
    </div>
</div>
@endsection