<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - PiezoElectric</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --main-gradient: linear-gradient(135deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--main-gradient);
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow: hidden;
        }

        /* GLASSMORPHISM CARD */
        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 35px;
            padding: 50px 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .title {
            font-weight: 800;
            font-size: 1.8rem;
            letter-spacing: -1px;
            margin-bottom: 10px;
            color: #ffffff;
        }

        .subtitle {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 35px;
        }

        /* FORM CONTROL STYLING */
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 12px 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: none;
            outline: none;
        }

        /* BUTTON STYLING */
        .btn-login {
            background: #ffffff;
            color: #4158D0;
            font-weight: 800;
            border-radius: 15px;
            padding: 12px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            color: #4158D0;
        }

        .alert {
            background: rgba(255, 59, 59, 0.2);
            border: 1px solid rgba(255, 59, 59, 0.3);
            color: white;
            border-radius: 12px;
            font-size: 0.85rem;
            margin-bottom: 25px;
        }
    </style>
</head>

<body>

<div class="login-card">
    <h3 class="title">PIEZOELECTRIC</h3>
    <p class="subtitle">Please enter your credentials to login</p>

    @if(session('error'))
        <div class="alert text-center">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="mb-1">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>

        <div class="mb-1">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-login w-100">
            LOGIN
        </button>
    </form>
    
    <p style="margin-top: 30px; font-size: 0.75rem; color: rgba(255,255,255,0.4); font-weight: 600;">
        &copy; 2026 PIEZOELECTRIC PROJECT TEAM
    </p>
</div>

</body>
</html>