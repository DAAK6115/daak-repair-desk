<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - DAAK Repair Desk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #111827;
        }

        .topbar {
            background: #0f172a;
            color: white;
            padding: 18px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container {
            padding: 32px;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        }

        .btn {
            border: none;
            border-radius: 8px;
            padding: 10px 14px;
            background: #ef4444;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background: #dc2626;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <div>
            <strong>DAAK Repair Desk</strong>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn" type="submit">Déconnexion</button>
        </form>
    </div>

    <div class="container">
        <div class="card">
            <h1>Tableau de bord</h1>
            <p>Bienvenue, {{ auth()->user()->name }}.</p>
            <p>La connexion username + mot de passe fonctionne correctement.</p>
        </div>
    </div>
</body>
</html>