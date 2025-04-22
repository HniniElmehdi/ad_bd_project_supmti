@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le Cours</h1>

    <form action="{{ route('cours.update', $cours->IDCours) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="Titre" class="form-control" value="{{ $cours->Titre }}" required>
        </div>
        <div class="mb-3">
            <label>Crédit</label>
            <input type="number" name="Crédit" class="form-control" value="{{ $cours->Crédit }}" required min="1">
        </div>
        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
</div>
@endsection