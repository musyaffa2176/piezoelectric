@extends('layout')

@section('content')
<!-- Google Fonts: Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
    /* 1. ELEGANT SAPPHIRE THEME (MENGIKUTI DASHBOARD) */
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
        margin: 20px 0 40px 0;
        text-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    /* 2. MODERN GLASS CARD (AERO DESIGN) */
    .card {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(25px) saturate(180%);
        -webkit-backdrop-filter: blur(25px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 32px !important;
        padding: 50px;
        margin-bottom: 35px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3) !important;
        position: relative;
    }

    h4 {
        color: #ffffff !important;
        font-weight: 800;
        letter-spacing: -1px;
        font-size: 1.8rem;
        margin-bottom: 25px;
    }

    p {
        line-height: 1.8;
        font-size: 1.1rem;
        color: #94a3b8;
        margin-bottom: 20px;
    }

    /* 3. LIST STYLING (IDENTIK DENGAN BARIS TABEL) */
    .feature-list, .tech-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 40px;
    }

    .feature-list li, .tech-list li {
        position: relative;
        padding: 18px 25px 18px 55px;
        margin-bottom: 12px;
        color: #ffffff;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.02); /* Sama dengan baris tabel */
        border-radius: 20px;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .feature-list li::before {
        content: "✓";
        position: absolute;
        left: 22px;
        font-weight: 900;
        color: #22d3ee; /* Warna Cyan Terang */
        text-shadow: 0 0 10px rgba(34, 211, 238, 0.5);
    }

    .tech-list li::before {
        content: "•";
        position: absolute;
        left: 22px;
        font-size: 1.5rem;
        line-height: 1;
        top: 15px;
        color: #6366f1; /* Warna Indigo */
        text-shadow: 0 0 10px rgba(99, 102, 241, 0.5);
    }

    .feature-list li:hover, .tech-list li:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        transform: translateX(10px);
    }

    /* 4. ACCENTS */
    .highlight {
        color: #22d3ee;
        font-weight: 700;
        background: rgba(34, 211, 238, 0.1);
        padding: 2px 10px;
        border-radius: 8px;
    }

    .section-title {
        color: #64748b;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 2px;
        margin-bottom: 20px;
        display: block;
    }

    hr {
        border-color: rgba(255, 255, 255, 0.05);
        margin: 40px 0;
    }

    .footer-text {
        font-size: 0.85rem;
        color: #475569;
        margin-top: 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
</style>

<div class="ambient-glow"></div>

<div class="container mt-5 pb-5">
    <h2>System <span style="font-weight: 300; color: #22d3ee;">Information</span></h2>

    <div class="card">
        <h4>Piezoelectric Energy Monitoring System</h4>
        
        <p>
            Project <span class="highlight">PiezoCore IoT</span> adalah sistem cerdas yang dirancang khusus untuk memonitoring konversi energi mekanik menjadi energi listrik melalui sensor <span class="highlight">Piezoelectric</span> secara real-time dan presisi.
        </p>

        <hr>

        <span class="section-title">Core Capabilities</span>
        <ul class="feature-list">
            <li>Monitoring output tegangan dan daya secara realtime.</li>
            <li>Kontrol perangkat output LED secara remote via Dashboard.</li>
            <li>Visualisasi data interaktif menggunakan grafik gelombang energi.</li>
            <li>Penyimpanan history log untuk analisis performa sistem mingguan.</li>
        </ul>

        <span class="section-title">Technological Stack</span>
        <ul class="tech-list">
            <li><strong>Backend Framework:</strong> Laravel 11 (PHP 8.x Engine)</li>
            <li><strong>Frontend Interface:</strong> Aero-Glass Aero UI Design</li>
            <li><strong>Data Visualization:</strong> Chart.js 4.x (High Precision)</li>
            <li><strong>Hardware Node:</strong> ESP32 Architecture via REST API</li>
        </ul>

        <p class="footer-text">
            &copy; 2024 PiezoCore Project Team — Sustainable Intelligence Monitoring System.
        </p>
    </div>
</div>
@endsection