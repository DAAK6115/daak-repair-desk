@extends('layouts.app')

@section('title', 'Nouveau dépôt')

@section('content')
    <div class="page-header">
        <div>
            <h2>Nouveau dépôt</h2>
            <p class="muted">Enregistrer un client, son appareil et la panne déclarée.</p>
        </div>

        <a class="btn btn-secondary" href="{{ route('repairs.index') }}">
            Voir les dépôts
        </a>
    </div>

    <form method="POST" action="{{ route('repairs.store') }}" class="card">
        @csrf

        <div class="form-section">
            <h3>Informations client</h3>

            <div class="grid grid-2">
                <div>
                    <label>Nom complet *</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" required>
                </div>

                <div>
                    <label>Téléphone *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required>
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>

                <div>
                    <label>Type client</label>
                    <select name="client_type">
                        <option value="Particulier">Particulier</option>
                        <option value="Entreprise">Entreprise</option>
                        <option value="École">École</option>
                        <option value="Organisation">Organisation</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                <div style="grid-column: 1 / -1;">
                    <label>Adresse / Quartier</label>
                    <input type="text" name="address" value="{{ old('address') }}">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Informations appareil</h3>

            <div class="grid grid-2">
                <div>
                    <label>Type d’appareil *</label>
                    <select name="device_type" required>
                        <option value="">Choisir</option>
                        <option value="Ordinateur portable">Ordinateur portable</option>
                        <option value="Ordinateur bureau">Ordinateur bureau</option>
                        <option value="Téléphone">Téléphone</option>
                        <option value="Tablette">Tablette</option>
                        <option value="Imprimante">Imprimante</option>
                        <option value="Disque dur">Disque dur</option>
                        <option value="Accessoire">Accessoire</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                <div>
                    <label>Marque *</label>
                    <input type="text" name="brand" value="{{ old('brand') }}" required>
                </div>

                <div>
                    <label>Modèle</label>
                    <input type="text" name="model" value="{{ old('model') }}">
                </div>

                <div>
                    <label>Numéro de série</label>
                    <input type="text" name="serial_number" value="{{ old('serial_number') }}">
                </div>

                <div style="grid-column: 1 / -1;">
                    <label>Accessoires déposés *</label>
                    <textarea name="accessories" required>{{ old('accessories') }}</textarea>
                </div>

                <div style="grid-column: 1 / -1;">
                    <label>État physique visible *</label>
                    <textarea name="physical_condition" required>{{ old('physical_condition') }}</textarea>
                </div>

                <div>
                    <label>Mot de passe fourni ?</label>
                    <select name="password_provided">
                        <option value="0">Non</option>
                        <option value="1">Oui</option>
                    </select>
                </div>

                <div>
                    <label>Mot de passe appareil</label>
                    <input type="text" name="device_password" value="{{ old('device_password') }}">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Panne déclarée</h3>

            <div class="grid grid-2">
                <div style="grid-column: 1 / -1;">
                    <label>Panne déclarée par le client *</label>
                    <textarea name="declared_issue" required>{{ old('declared_issue') }}</textarea>
                </div>

                <div>
                    <label>Frais de diagnostic</label>
                    <input type="number" name="diagnostic_fee" value="{{ old('diagnostic_fee', 0) }}" min="0">
                </div>

                <div>
                    <label>Date prévue de livraison</label>
                    <input type="datetime-local" name="expected_delivery_date" value="{{ old('expected_delivery_date') }}">
                </div>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">
            Enregistrer le dépôt
        </button>
    </form>
@endsection