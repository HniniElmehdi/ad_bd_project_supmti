@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier Professeur</h1>

    <form action="{{ route('professeurs.update', $professeur->IDProfesseur) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Nom" class="form-label">Nom</label>
            <input type="text" class="form-control" name="Nom" value="{{ $professeur->Nom }}" required>
        </div>

        <div class="mb-3">
            <label for="Prénom" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="Prénom" value="{{ $professeur->Prénom }}" required>
        </div>

        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="text" class="form-control" name="Email" value="{{ $professeur->Email }}" required>
        </div>

        <div class="mb-3">
            <label for="IDCours" class="form-label">Cours Assigné</label>
            <select name="IDCours" class="form-control">
                <option value="">-- Aucun --</option>
                @foreach ($cours as $coursItem)
                <option value="{{ $coursItem->IDCours }}"
                    {{ $coursItem->IDCours == $professeur->IDCours ? 'selected' : '' }}>
                    {{ $coursItem->Titre }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('professeurs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection