@extends('layout')

@section('content')
<!-- Google Fonts: Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
    /* 1. GLOBAL THEME (BRIGHT GLASSMORPHISM) */
    body {
        margin: 0;
        padding: 0;
        /* Background cerah sesuai permintaan sebelumnya */
        background: linear-gradient(135deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
        background-attachment: fixed;
        min-height: 100vh;
        color: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        overflow-x: hidden;
    }

    .bg-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(255, 255, 255, 0.1); 
        backdrop-filter: blur(50px);
        z-index: -2;
    }

    /* ===================================================
       STYLING KARTU & KONTEN (TETAP SAMA)
       =================================================== */
    .card {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(15px) saturate(150%);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 30px;
        padding: 30px;
        margin-bottom: 24px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-5px);
    }

    h2 { font-weight: 800; letter-spacing: -1px; text-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    h6 { color: rgba(255, 255, 255, 0.8) !important; text-transform: uppercase; letter-spacing: 2px; font-weight: 700; font-size: 0.75rem; margin-bottom: 10px; }
    .energy-value { font-size: 4.2rem; font-weight: 800; letter-spacing: -2px; line-height: 1; margin: 5px 0; }
    .badge-modern { background: rgba(255, 255, 255, 0.3); padding: 6px 16px; border-radius: 100px; font-size: 0.8rem; font-weight: 600; border: 1px solid rgba(255, 255, 255, 0.4); display: inline-block; }

    .pulse-white {
        height: 10px; width: 10px; background-color: #ffffff; border-radius: 50%; display: inline-block; margin-right: 8px; box-shadow: 0 0 10px #ffffff; animation: pulse 2s infinite;
    }

    @keyframes pulse { 0% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.3); opacity: 0.5; } 100% { transform: scale(1); opacity: 1; } }
    .chart-container { position: relative; height: 400px; }
</style>

<!-- BACKGROUND OVERLAY -->
<div class="bg-overlay"></div>

<div class="container mt-5 pb-5">
    <div class="d-flex justify-content-between align-items-end mb-5">
        <div>
            <h2 class="m-0">Piezo Dashboard</h2>
            <p class="m-0" style="color: rgba(255,255,255,0.8);">Next-Gen Energy Monitoring</p>
        </div>
        <div class="badge-modern">
            <span class="pulse-white"></span> SYSTEM ACTIVE
        </div>
    </div>

    <div class="row">
        <!-- Kolom Grafik Utama -->
        <div class="col-md-8">
            <div class="card h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6>Voltage Waveform Analytics</h6>
                    <span style="font-size: 11px; font-weight: 600; opacity: 0.7;">UNIT: VOLTS (V)</span>
                </div>
                <div class="chart-container">
                    <canvas id="mainChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Kolom Ringkasan -->
        <div class="col-md-4">
            <div class="card text-center">
                <h6>Total Energi</h6>
                <div class="energy-value" id="disp-energy">171</div>
                <div class="badge-modern">Watt (W)</div>
            </div>

            <div class="card text-center">
                <h6>Jumlah Tekanan</h6>
                <div class="energy-value" id="disp-steps">339</div>
                <div class="badge-modern">PSI</div>
            </div>

            <div class="card text-center mb-0">
                <h6>System Efficiency</h6>
                <h3 style="font-weight: 800; font-size: 2rem; margin: 10px 0;">94.8%</h3>
                <div class="progress" style="height: 8px; background: rgba(255,255,255,0.2); border-radius: 10px;">
                    <div class="progress-bar" style="width: 94%; background: #ffffff; box-shadow: 0 0 10px #ffffff;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('mainChart').getContext('2d');
        let chartFill = ctx.createLinearGradient(0, 0, 0, 400);
        chartFill.addColorStop(0, 'rgba(255, 255, 255, 0.4)');
        chartFill.addColorStop(1, 'rgba(255, 255, 255, 0)');

        const myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: Array(20).fill(""),
                datasets: [{
                    data: Array(20).fill(50),
                    borderColor: "#ffffff",
                    borderWidth: 4,
                    pointRadius: 0,
                    fill: true,
                    backgroundColor: chartFill,
                    tension: 0.4
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: { color: 'rgba(255, 255, 255, 0.1)', drawBorder: false },
                        ticks: { color: '#ffffff', font: { family: 'Plus Jakarta Sans', size: 12, weight: '600' } }
                    },
                    x: { display: false }
                }
            }
        });

        setInterval(() => {
    fetch('/api/latest-sensor')
        .then(response => response.json())
        .then(data => {
            if (data && !data.error) {
                // 1. Update Angka Utama (Gunakan ID yang ada di HTML kamu)
                document.getElementById('disp-energy').innerText = data.energi;
                document.getElementById('disp-steps').innerText = data.tekanan;

                // 2. Update Grafik Tegangan (Waveform)
                myChart.data.datasets[0].data.push(data.tegangan);
                myChart.data.datasets[0].data.shift();
                myChart.update('none'); // Update tanpa animasi agar smooth
            }
        })
        .catch(error => console.error('Gagal mengambil data:', error));
        }, 2000); // Cek database setiap 2 detik
    });
</script>
@endsection