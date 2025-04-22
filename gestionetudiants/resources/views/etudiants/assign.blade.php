@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Assigner un cours à l'étudiant</h2>

    <p><strong>Nom:</strong> {{ $etudiant->Nom }} {{ $etudiant->Prénom }}</p>

    @if (empty($availableCours))
    <div class="alert alert-info">Cet étudiant est déjà assigné à tous les cours.</div>
    @else
    <form action="{{ route('etudiants.assign.store', $etudiant->IDEtudiant) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="IDCours">Cours disponible</label>
            <select name="IDCours" id="IDCours" class="form-control" required>
                <option value="">-- Sélectionner un cours --</option>
                @foreach ($availableCours as $cours)
                <option value="{{ $cours->IDCours }}">{{ $cours->Titre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Assigner</button>
        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary mt-3">Retour</a>
    </form>
    @endif
</div>
@endsection