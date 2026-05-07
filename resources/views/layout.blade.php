<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiezoCore IoT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --main-gradient: linear-gradient(135deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
            --glass-bg: rgba(255, 255, 255, 0.15);
            --glass-border: rgba(255, 255, 255, 0.3);
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--main-gradient);
            background-attachment: fixed;
            min-height: 100vh;
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px) saturate(150%);
            padding: 40px 20px;
            border-right: 1px solid var(--glass-border);
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .sidebar h3 {
            font-weight: 800;
            margin-bottom: 40px;
            color: #ffffff;
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
            text-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .sidebar-menu {
            flex-grow: 1;
        }

        .sidebar a {
            display: block;
            color: rgba(255, 255, 255, 0.8);
            padding: 14px 18px;
            text-decoration: none;
            border-radius: 15px;
            margin-bottom: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateX(5px);
        }

        .sidebar a.active {
            background: white;
            color: #4158D0;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .logout-container {
            margin-top: auto;
            padding-top: 20px;
        }

        .logout-btn {
            width: 100%;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid var(--glass-border);
            color: white;
            padding: 12px;
            border-radius: 12px;
            transition: all 0.3s;
            cursor: pointer;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .logout-btn:hover {
            background: #ff4b2b;
            border-color: transparent;
            box-shadow: 0 8px 20px rgba(255, 75, 43, 0.3);
        }

        .main {
            margin-left: 260px;
            padding: 40px;
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-right: none;
                border-bottom: 1px solid var(--glass-border);
            }
            .main {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h3>PIEZOELECTRIC</h3>

        <div class="sidebar-menu">
            <a href="/dashboard" class="{{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="/live-data" class="{{ Request::is('live-data') ? 'active' : '' }}">Live Data</a>
            <a href="/history" class="{{ Request::is('history') ? 'active' : '' }}">History</a>
            <a href="/about" class="{{ Request::is('about') ? 'active' : '' }}">About Project</a>
        </div>

        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="main">
        @yield('content')
    </div>

    {{-- ✅ FIX UTAMA: script dipindah ke bawah --}}
    @yield('scripts')

</body>

</html>