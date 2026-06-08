<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - PiezoElectric</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* 1. BACKGROUND LAMPU JALAN MALAM HARI */
        body {
            margin: 0;
            padding: 0;
            /* Menggunakan gambar jalanan malam yang estetik */
            background: 
                /* Overlay Gelap Sapphire agar teks putih tetap terbaca jelas */
                linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)),
                url('https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow: hidden;
        }

        /* Ambient Glow di pojok untuk memperkuat kesan lampu */
        .ambient-glow {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(34, 211, 238, 0.05) 0%, transparent 70%);
            z-index: -1;
            pointer-events: none;
        }

        /* 2. LUXURY GLASS CARD */
        .login-card {
            /* Efek Kaca yang sangat kuat karena background di belakangnya adalah gambar */
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            padding: 55px 45px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6);
            text-align: center;
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .title {
            font-weight: 800;
            font-size: 2rem;
            letter-spacing: -2px;
            margin-bottom: 5px;
            color: #ffffff;
        }

        .title span {
            font-weight: 300;
            color: #22d3ee;
        }

        .subtitle {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-bottom: 40px;
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* FORM STYLING */
        .form-control {
            background: rgba(255, 255, 255, 0.05);
            color: white !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 14px 20px;
            margin-bottom: 18px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(34, 211, 238, 0.5);
            box-shadow: 0 0 15px rgba(34, 211, 238, 0.2);
            outline: none;
        }

        /* BUTTON LOGIN GRADIENT */
        .btn-login {
            background: linear-gradient(135deg, #22d3ee 0%, #6366f1 100%);
            color: #ffffff;
            font-weight: 700;
            border-radius: 16px;
            padding: 14px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.85rem;
            margin-top: 10px;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            box-shadow: 0 10px 20px rgba(34, 211, 238, 0.2);
        }

        .btn-login:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 30px rgba(34, 211, 238, 0.4);
            filter: brightness(1.1);
        }

        .alert {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 12px;
            font-size: 0.85rem;
            margin-bottom: 25px;
        }

        .copyright {
            margin-top: 45px;
            font-size: 0.65rem;
            color: rgba(148, 163, 184, 0.5);
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

<div class="ambient-glow"></div>

<div class="login-card">
    <h3 class="title">PIEZO<span>ELECTRIC</span></h3>
    <p class="subtitle">Smart Street Light Portal</p>

    @if(session('error'))
        <div class="alert text-center">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="mb-1">
            <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off">
        </div>

        <div class="mb-1">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-login w-100">
            Authorize System
        </button>
    </form>
    
    <p class="copyright">
        &copy; 2026 PIEZOELECTRIC INFRASTRUCTURE
    </p>
</div>

</body>
</html>