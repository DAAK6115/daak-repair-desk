@extends('layouts.app')

@section('title', 'Détail du dépôt')

@section('content')
    <div class="page-header">
        <div>
            <h2>{{ $repair->receipt_number }}</h2>
            <p class="muted">Dossier de réparation</p>
        </div>

        <a class="btn btn-secondary" href="{{ route('repairs.index') }}">
            Retour
        </a>
    </div>

    <div class="grid grid-2">
        <div class="card">
            <h3>Client</h3>
            <p><strong>Nom :</strong> {{ $repair->client->full_name }}</p>
            <p><strong>Téléphone :</strong> {{ $repair->client->phone }}</p>
            <p><strong>Email :</strong> {{ $repair->client->email ?? '-' }}</p>
            <p><strong>Adresse :</strong> {{ $repair->client->address ?? '-' }}</p>
            <p><strong>Type :</strong> {{ $repair->client->client_type }}</p>
        </div>

        <div class="card">
            <h3>Appareil</h3>
            <p><strong>Type :</strong> {{ $repair->device->device_type }}</p>
            <p><strong>Marque :</strong> {{ $repair->device->brand }}</p>
            <p><strong>Modèle :</strong> {{ $repair->device->model ?? '-' }}</p>
            <p><strong>N° série :</strong> {{ $repair->device->serial_number ?? '-' }}</p>
            <p><strong>Mot de passe fourni :</strong> {{ $repair->device->password_provided ? 'Oui' : 'Non' }}</p>
        </div>

        <div class="card">
            <h3>Dépôt</h3>
            <p><strong>Statut :</strong> <span class="badge">{{ $repair->status }}</span></p>
            <p><strong>Date dépôt :</strong> {{ optional($repair->deposit_date)->format('d/m/Y H:i') }}</p>
            <p><strong>Date prévue :</strong> {{ optional($repair->expected_delivery_date)->format('d/m/Y H:i') ?? '-' }}</p>
            <p><strong>Frais diagnostic :</strong> {{ number_format($repair->diagnostic_fee, 0, ',', ' ') }} FCFA</p>
        </div>

        <div class="card">
            <h3>Changer le statut</h3>

            <form method="POST" action="{{ route('repairs.update-status', $repair) }}">
                @csrf
                @method('PATCH')

                <div style="margin-bottom: 14px;">
                    <label>Nouveau statut</label>
                    <select name="status" required>
                        @foreach (\App\Models\Repair::statuses() as $status)
                            <option value="{{ $status }}" @selected($repair->status === $status)>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 14px;">
                    <label>Note</label>
                    <textarea name="note" placeholder="Exemple : diagnostic terminé, client appelé..."></textarea>
                </div>

                <button class="btn btn-primary" type="submit">
                    Mettre à jour
                </button>
            </form>
        </div>
    </div>

    <div class="card" style="margin-top: 20px;">
        <h3>Panne déclarée</h3>
        <p>{{ $repair->declared_issue }}</p>
    </div>

    <div class="grid grid-2" style="margin-top: 20px;">
        <div class="card">
            <h3>Accessoires déposés</h3>
            <p>{{ $repair->device->accessories }}</p>
        </div>

        <div class="card">
            <h3>État physique constaté</h3>
            <p>{{ $repair->device->physical_condition }}</p>
        </div>
    </div>

    <div class="card" style="margin-top: 20px;">
        <h3>Historique des statuts</h3>

        <table>
            <thead>
            <tr>
                <th>Date</th>
                <th>Ancien statut</th>
                <th>Nouveau statut</th>
                <th>Utilisateur</th>
                <th>Note</th>
            </tr>
            </thead>

            <tbody>
            @forelse ($repair->statusLogs as $log)
                <tr>
                    <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $log->old_status ?? '-' }}</td>
                    <td><span class="badge">{{ $log->new_status }}</span></td>
                    <td>{{ $log->user->name ?? '-' }}</td>
                    <td>{{ $log->note ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="muted">Aucun historique.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection