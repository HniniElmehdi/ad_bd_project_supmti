@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un étudiant et l'inscrire à un cours</h2>

    <form action="{{ route('etudiants.storeWithInscription') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="Nom" class="form-label">Nom</label>
            <input type="text" name="Nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Prénom" class="form-label">Prénom</label>
            <input type="text" name="Prénom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="DateNaissance" class="form-label">Date de naissance</label>
            <input type="date" name="DateNaissance" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" name="Email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="IDCours" class="form-label">Cours</label>
            <select name="IDCours" class="form-control" required>
                @foreach($cours as $coursItem)
                <option value="{{ $coursItem->IDCours }}">{{ $coursItem->Titre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter & Inscrire</button>
    </form>
</div>
@endsection