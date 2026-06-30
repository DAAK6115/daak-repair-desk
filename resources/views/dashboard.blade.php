@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    <div class="page-header">
        <div>
            <h2>Tableau de bord</h2>
            <p class="muted">Bienvenue, {{ auth()->user()->name }}.</p>
        </div>

        <a class="btn btn-primary" href="{{ route('repairs.create') }}">
            Nouveau dépôt
        </a>
    </div>

    <div class="grid grid-5" style="margin-bottom: 24px;">
        <div class="stat-card">
            <span>Dépôts du jour</span>
            <strong>{{ $stats['today'] }}</strong>
        </div>

        <div class="stat-card">
            <span>En diagnostic</span>
            <strong>{{ $stats['diagnosis'] }}</strong>
        </div>

        <div class="stat-card">
            <span>En réparation</span>
            <strong>{{ $stats['repairing'] }}</strong>
        </div>

        <div class="stat-card">
            <span>Prêts</span>
            <strong>{{ $stats['ready'] }}</strong>
        </div>

        <div class="stat-card">
            <span>Livrés</span>
            <strong>{{ $stats['delivered'] }}</strong>
        </div>
    </div>

    <div class="card">
        <h3>Derniers dépôts</h3>

        <table>
            <thead>
            <tr>
                <th>Reçu</th>
                <th>Client</th>
                <th>Appareil</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @forelse ($latestRepairs as $repair)
                <tr>
                    <td>{{ $repair->receipt_number }}</td>
                    <td>{{ $repair->client->full_name }}</td>
                    <td>{{ $repair->device->brand }} {{ $repair->device->model }}</td>
                    <td><span class="badge">{{ $repair->status }}</span></td>
                    <td>{{ optional($repair->deposit_date)->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('repairs.show', $repair) }}">Voir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="muted">Aucun dépôt enregistré pour le moment.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection