<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - DAAK Repair Desk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }

        .page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .card {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.12);
        }

        .logo {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo h1 {
            margin: 0;
            font-size: 26px;
            color: #0f172a;
        }

        .logo p {
            margin-top: 8px;
            font-size: 14px;
            color: #64748b;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            box-sizing: border-box;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #475569;
        }

        .btn {
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 13px 16px;
            background: #0f172a;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-size: 15px;
        }

        .btn:hover {
            background: #1e293b;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="page">
    <div class="card">
        <div class="logo">
            <h1>DAAK Repair Desk</h1>
            <p>Connexion à l’espace interne DAAK_TECH</p>
        </div>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <label for="username">Nom d’utilisateur</label>
            <input
                id="username"
                type="text"
                name="username"
                value="{{ old('username') }}"
                required
                autofocus
            >

            <label for="password">Mot de passe</label>
            <input
                id="password"
                type="password"
                name="password"
                required
            >

            <label class="remember">
                <input type="checkbox" name="remember">
                Se souvenir de moi
            </label>

            <button class="btn" type="submit">
                Se connecter
            </button>
        </form>
    </div>
</div>
</body>
</html>