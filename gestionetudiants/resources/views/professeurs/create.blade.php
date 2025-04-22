@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ajouter Professeur</h1>

        <form action="{{ route('professeurs.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="Nom" class="form-label">Nom</label>
                <input type="text" class="form-control" name="Nom" required>
            </div>

            <div class="mb-3">
                <label for="Prénom" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="Prénom" required>
            </div>

            <div class="mb-3">
                <label for="IDCours" class="form-label">Cours Assigné</label>
                <select name="IDCours" class="form-control">
                    <option value="">-- Aucun --</option>
                    @foreach ($cours as $coursItem)
                        <option value="{{ $coursItem->IDCours }}">{{ $coursItem->Titre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Ajouter</button>
            <a href="{{ route('professeurs.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection