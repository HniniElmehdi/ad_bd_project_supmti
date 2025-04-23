@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier l'Inscription</h1>

        <form action="{{ route('inscriptions.update', $inscription->IDInscription) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="IDEtudiant" class="form-label">Étudiant</label>
                <select name="IDEtudiant" id="IDEtudiant" class="form-control" required disabled>
                    @foreach ($etudiants as $etudiant)
                        <option value="{{ $etudiant->IDEtudiant }}" {{ $etudiant->IDEtudiant == $inscription->IDEtudiant ? 'selected' : '' }}>
                            {{ $etudiant->Nom }} {{ $etudiant->Prénom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="IDCours" class="form-label">Cours</label>
                <select name="IDCours" id="IDCours" class="form-control" required>
                    @foreach ($cours as $c)
                        <option value="{{ $c->IDCours }}" {{ $c->IDCours == $inscription->IDCours ? 'selected' : '' }}>
                            {{ $c->Titre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="DateInscription" class="form-label">Date d'Inscription</label>
                <input type="date" name="DateInscription" class="form-control" value="{{ $inscription->DateInscription }}"
                    required>
            </div>

            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('etudiants.inscrits') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection