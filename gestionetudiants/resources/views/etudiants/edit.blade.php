@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier Étudiant</h2>
    <form action="{{ route('etudiants.update', $etudiant->IDEtudiant) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="Nom" class="form-label">Nom</label>
            <input type="text" class="form-control" name="Nom" value="{{ $etudiant->Nom }}" required>
        </div>

        <div class="mb-3">
            <label for="Prénom" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="Prénom" value="{{ $etudiant->Prénom }}" required>
        </div>

        <div class="mb-3">
            <label for="DateNaissance" class="form-label">Date de Naissance</label>
            <input type="date" class="form-control" name="DateNaissance" value="{{ $etudiant->DateNaissance }}"
                required>
        </div>

        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" class="form-control" name="Email" value="{{ $etudiant->Email }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection