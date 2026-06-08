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

    /* ===================================================
       MODERN GLASS CARD (AERO DESIGN)
       =================================================== */
    .card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(25px) saturate(180%);
        -webkit-backdrop-filter: blur(25px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 28px; 
        padding: 30px;
        margin-bottom: 24px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        text-align: center;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-8px);
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(34, 211, 238, 0.3);
    }

    h6 { 
        color: #94a3b8 !important; 
        text-transform: uppercase; 
        letter-spacing: 3px; 
        font-weight: 700; 
        font-size: 0.7rem; 
        margin-bottom: 20px; 
    }

    .energy-value { 
        font-size: 4.8rem; 
        font-weight: 800; 
        letter-spacing: -3px; 
        line-height: 1; 
        margin: 10px 0; 
        color: #ffffff;
        background: linear-gradient(to bottom, #ffffff 50%, #94a3b8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .unit-pill {
        background: rgba(34, 211, 238, 0.1);
        padding: 6px 18px;
        border: 1px solid rgba(34, 211, 238, 0.2);
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 700;
        color: #22d3ee;
        display: inline-block;
        margin-top: 15px;
        text-transform: uppercase;
    }

    .progress-custom {
        height: 6px; 
        background: rgba(255, 255, 255, 0.05); 
        border-radius: 10px;
        margin: 30px auto 10px;
        width: 80%;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #22d3ee, #6366f1);
        box-shadow: 0 0 15px rgba(34, 211, 238, 0.6);
        border-radius: 10px;
    }

    .system-badge {
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 1.5px;
        color: #ffffff;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 10px 24px;
        border-radius: 100px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .pulse-dot {
        width: 8px; height: 8px;
        background: #22d3ee;
        border-radius: 50%;
        box-shadow: 0 0 12px #22d3ee;
        animation: pulse 2s infinite;
    }

    @keyframes pulse { 0% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.4); opacity: 0.5; } 100% { transform: scale(1); opacity: 1; } }
    
    .chart-container { position: relative; height: 450px; }
</style>

<div class="ambient-glow"></div>

<div class="container mt-5 pb-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 style="font-weight: 800; letter-spacing: -2px; margin: 0; font-size: 2.6rem;">
                Piezo <span style="color: #22d3ee; font-weight: 300;">Intelligence</span>
            </h2>
            <p class="m-0" style="color: #64748b; font-weight: 600; font-size: 0.9rem;">Core Energy Monitoring Stream</p>
        </div>
        <div class="system-badge">
            <div class="pulse-dot"></div> DATA ENGINE ACTIVE
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Chart -->
        <div class="col-lg-8">
            <div class="card h-100" style="text-align: left;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6>Voltage Waveform Analytics</h6>
                    <span style="font-size: 10px; font-weight: 800; color: #64748b;">UNIT: VOLTS (V)</span>
                </div>
                <div class="chart-container">
                    <canvas id="mainChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Metrics Side -->
        <div class="col-lg-4">
            <div class="card">
                <h6>Output Energy</h6>
                <div class="energy-value" id="disp-energy">0</div>
                <div class="unit-pill">Watts (W)</div>
            </div>

            <div class="card">
                <h6>Sensor Density</h6>
                <div class="energy-value" id="disp-ldr" style="color: #22d3ee; background: none; -webkit-text-fill-color: #22d3ee;">0</div>
                <div class="unit-pill">LDR Index</div>
            </div>

            <div class="card">
                <h6>Status</h6>
                <div class="energy-value" id="disp-status" style="font-size: 2.8rem; font-weight: 600; letter-spacing: -1px;">-</div>
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
        chartFill.addColorStop(0, 'rgba(34, 211, 238, 0.2)');
        chartFill.addColorStop(1, 'rgba(34, 211, 238, 0)');

        const myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: Array(20).fill(""),
                datasets: [{
                    label: 'Voltage',
                    data: Array(20).fill(0),
                    borderColor: "#22d3ee",
                    borderWidth: 3,
                    pointRadius: 0,
                    fill: true,
                    backgroundColor: chartFill,
                    tension: 0.45
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' Volt';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 1000,
                        grid: { color: 'rgba(255, 255, 255, 0.03)', drawBorder: false },
                        ticks: { 
                            color: '#64748b', 
                            font: { family: 'Plus Jakarta Sans', size: 12, weight: '600' },
                            // MENAMPILKAN KETERANGAN VOLT DI SUMBU Y
                            callback: function(value) {
                                return value + 'V';
                            }
                        }
                    },
                    x: { display: false }
                }
            }
        });

        // Real-time fetching logic
        setInterval(() => {
            fetch('/api/latest-sensor')
                .then(response => response.json())
                .then(data => {
                    if (data && !data.error) {
                        document.getElementById('disp-energy').innerText = data.energi;
                        document.getElementById('disp-ldr').innerText = data.tekanan; 
                        document.getElementById('disp-status').innerText = data.kondisi;
                        
                        myChart.data.datasets[0].data.push(data.energi);
                        myChart.data.datasets[0].data.shift();
                        myChart.update('none');
                    }
                })
                .catch(error => console.error('Fetch Error:', error));
        }, 2000);
    });
</script>
@endsection