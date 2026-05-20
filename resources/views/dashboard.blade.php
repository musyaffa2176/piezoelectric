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
       STYLING KARTU (MENGIKUTI FOTO 1)
       =================================================== */
    .card {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(20px) saturate(160%);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 40px; /* Lebih membulat sesuai foto 1 */
        padding: 30px;
        margin-bottom: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        text-align: center;
    }

    /* Judul kecil di atas card */
    h6 { 
        color: rgba(255, 255, 255, 0.9) !important; 
        text-transform: uppercase; 
        letter-spacing: 2px; 
        font-weight: 700; 
        font-size: 0.8rem; 
        margin-bottom: 15px; 
    }

    /* Angka Utama (Warna Gelap sesuai Foto 1) */
    .energy-value { 
        font-size: 5rem; 
        font-weight: 800; 
        letter-spacing: -3px; 
        line-height: 1; 
        margin: 10px 0; 
        color: #1a1a1a; /* Angka warna gelap agar kontras */
    }

    /* Kapsul Unit (Pill shape di bawah angka) */
    .unit-pill {
        background: rgba(255, 255, 255, 0.4);
        padding: 6px 25px;
        border-radius: 100px;
        font-size: 0.85rem;
        font-weight: 700;
        color: #333;
        display: inline-block;
        margin-top: 10px;
        min-width: 120px;
    }

    /* Progress Bar (Untuk Card Status) */
    .progress-custom {
        height: 10px; 
        background: rgba(255,255,255,0.3); 
        border-radius: 10px;
        margin: 20px auto 10px;
        width: 80%;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: #ffffff;
        box-shadow: 0 0 15px #ffffff;
        border-radius: 10px;
    }

    .badge-top-right { 
        background: rgba(255, 255, 255, 0.3); 
        padding: 6px 16px; 
        border-radius: 100px; 
        font-size: 0.8rem; 
        font-weight: 600; 
        border: 1px solid rgba(255, 255, 255, 0.4); 
    }

    .pulse-white {
        height: 10px; width: 10px; background-color: #ffffff; border-radius: 50%; display: inline-block; margin-right: 8px; box-shadow: 0 0 10px #ffffff; animation: pulse 2s infinite;
    }

    @keyframes pulse { 0% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.3); opacity: 0.5; } 100% { transform: scale(1); opacity: 1; } }
    
    .chart-container { position: relative; height: 450px; }
</style>

<div class="bg-overlay"></div>

<div class="container mt-5 pb-5">
    <div class="d-flex justify-content-between align-items-end mb-5">
        <div>
            <h2 style="font-weight: 800; letter-spacing: -1px;">Piezo Dashboard</h2>
            <p class="m-0" style="color: rgba(255,255,255,0.8);">Next-Gen Energy Monitoring</p>
        </div>
        <div class="badge-top-right">
            <span class="pulse-white"></span> SYSTEM ACTIVE
        </div>
    </div>

    <div class="row">
        <!-- Kolom Grafik Utama -->
        <div class="col-md-8">
            <div class="card h-100" style="text-align: left;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6>Voltage Waveform Analytics</h6>
                    <span style="font-size: 11px; font-weight: 600; opacity: 0.7;">UNIT: VOLTS (V)</span>
                </div>
                <div class="chart-container">
                    <canvas id="mainChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Kolom Ringkasan (Mengikuti Foto 1) -->
        <div class="col-md-4">
            <!-- Card Energi -->
            <div class="card">
                <h6>Total Energi</h6>
                <div class="energy-value" id="disp-energy">0</div>
                <div class="unit-pill">Watt (W)</div>
            </div>

            <!-- Card LDR -->
            <div class="card">
                <h6>LDR</h6>
                <div class="energy-value" id="disp-ldr">0</div>
                <div class="unit-pill">Light</div>
            </div>

            <!-- Card Status -->
            <div class="card">
                <h6>Status</h6>
                <div class="energy-value" id="disp-status" style="font-size: 3rem;">-</div>
                <div class="progress-custom">
                    <div class="progress-bar-fill" style="width: 100%;"></div>
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
        chartFill.addColorStop(0, 'rgba(255, 255, 255, 0.6)');
        chartFill.addColorStop(1, 'rgba(255, 255, 255, 0)');

        const myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: Array(20).fill(""),
                datasets: [{
                    data: Array(20).fill(0),
                    borderColor: "#ffffff",
                    borderWidth: 5,
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
                        grid: { color: 'rgba(255, 255, 255, 0.2)', drawBorder: false },
                        ticks: { color: '#ffffff', font: { family: 'Plus Jakarta Sans', size: 14, weight: '600' } }
                    },
                    x: { display: false }
                }
            }
        });

        // Loop penarikan data
setInterval(() => {
    fetch('/api/latest-sensor')
        .then(response => response.json())
        .then(data => {
            console.log('Data API:', data); // Debug: cek data yang diterima

            if (data && !data.error) {

                // ==========================================
                // AMBIL DATA DARI FIREBASE
                // Firebase kamu menggunakan field:
                // arus, battery, kondisi, ldr, piezo, tegangan
                // ==========================================

                // Total Energi (menggunakan field battery)
                const energi = parseFloat(data.battery || 0);

                // LDR
                const ldr = parseInt(data.ldr || 0);

                // Status
                const kondisi = data.kondisi || '-';

                // Tegangan (jika ingin dipakai untuk debugging)
                const tegangan = parseFloat(data.tegangan || 0);

                // ==========================================
                // UPDATE CARD
                // ==========================================

                document.getElementById('disp-energy').innerText =
                    energi.toFixed(2);

                document.getElementById('disp-ldr').innerText =
                    ldr;

                document.getElementById('disp-status').innerText =
                    kondisi;

                // ==========================================
                // UPDATE GRAFIK
                // Grafik menggunakan nilai energi (battery)
                // ==========================================

                myChart.data.datasets[0].data.push(energi);
                myChart.data.datasets[0].data.shift();

                // Skala otomatis menyesuaikan data
                const maxValue = Math.max(
                    ...myChart.data.datasets[0].data,
                    10
                );

                myChart.options.scales.y.max = maxValue * 1.2;

                // Update chart tanpa animasi
                myChart.update('none');
            }
        })
        .catch(error => {
            console.error('Gagal mengambil data:', error);
        });
}, 2000);
    });
</script>
@endsection