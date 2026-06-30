<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'DAAK Repair Desk')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #111827;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .app {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 260px;
            background: #0f172a;
            color: white;
            padding: 24px 18px;
        }

        .brand {
            margin-bottom: 32px;
        }

        .brand h1 {
            margin: 0;
            font-size: 22px;
        }

        .brand p {
            margin: 6px 0 0;
            color: #cbd5e1;
            font-size: 13px;
        }

        .nav a {
            display: block;
            padding: 12px 14px;
            border-radius: 10px;
            color: #e2e8f0;
            margin-bottom: 8px;
            font-size: 15px;
        }

        .nav a:hover {
            background: #1e293b;
        }

        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 0 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar strong {
            color: #0f172a;
        }

        .content {
            padding: 28px;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
        }

        .page-header h2 {
            margin: 0;
            font-size: 26px;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.07);
            border: 1px solid #e5e7eb;
        }

        .grid {
            display: grid;
            gap: 18px;
        }

        .grid-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .grid-5 {
            grid-template-columns: repeat(5, minmax(0, 1fr));
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 7px;
            color: #334155;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            background: white;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        .form-section {
            margin-bottom: 26px;
        }

        .form-section h3 {
            margin: 0 0 14px;
            font-size: 18px;
            color: #0f172a;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 10px;
            padding: 11px 15px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-primary {
            background: #0f172a;
            color: white;
        }

        .btn-primary:hover {
            background: #1e293b;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #0f172a;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 13px;
            color: #475569;
            background: #f1f5f9;
            padding: 12px;
        }

        td {
            padding: 13px 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 999px;
            background: #e2e8f0;
            color: #334155;
            font-size: 12px;
            font-weight: bold;
        }

        .muted {
            color: #64748b;
        }

        .stat-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 18px;
        }

        .stat-card span {
            color: #64748b;
            font-size: 13px;
        }

        .stat-card strong {
            display: block;
            font-size: 28px;
            margin-top: 6px;
            color: #0f172a;
        }

        @media (max-width: 900px) {
            .app {
                display: block;
            }

            .sidebar {
                width: 100%;
            }

            .grid-2,
            .grid-5 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <div class="brand">
            <h1>DAAK Repair Desk</h1>
            <p>Gestion interne DAAK_TECH</p>
        </div>

        <nav class="nav">
            <a href="{{ route('dashboard') }}">Tableau de bord</a>
            <a href="{{ route('repairs.create') }}">Nouveau dépôt</a>
            <a href="{{ route('repairs.index') }}">Liste des dépôts</a>
        </nav>
    </aside>

    <main class="main">
        <div class="topbar">
            <strong>@yield('title', 'DAAK Repair Desk')</strong>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger" type="submit">Déconnexion</button>
            </form>
        </div>

        <div class="content">
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-error">
                    <strong>Erreur :</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>
</body>
</html>