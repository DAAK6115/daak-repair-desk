@extends('layouts.app')

@section('title', 'Liste des dépôts')

@section('content')
    <div class="page-header">
        <div>
            <h2>Liste des dépôts</h2>
            <p class="muted">Tous les appareils déposés chez DAAK_TECH.</p>
        </div>

        <a class="btn btn-primary" href="{{ route('repairs.create') }}">
            Nouveau dépôt
        </a>
    </div>

    <div class="card">
        <table>
            <thead>
            <tr>
                <th>Reçu</th>
                <th>Client</th>
                <th>Téléphone</th>
                <th>Appareil</th>
                <th>Statut</th>
                <th>Date dépôt</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @forelse ($repairs as $repair)
                <tr>
                    <td>{{ $repair->receipt_number }}</td>
                    <td>{{ $repair->client->full_name }}</td>
                    <td>{{ $repair->client->phone }}</td>
                    <td>
                        {{ $repair->device->device_type }}
                        —
                        {{ $repair->device->brand }}
                        {{ $repair->device->model }}
                    </td>
                    <td><span class="badge">{{ $repair->status }}</span></td>
                    <td>{{ optional($repair->deposit_date)->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('repairs.show', $repair) }}">Voir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="muted">Aucun dépôt enregistré.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top: 18px;">
            {{ $repairs->links() }}
        </div>
    </div>
@endsection