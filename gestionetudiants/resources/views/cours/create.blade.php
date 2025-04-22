@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un Cours</h1>

    <form action="{{ route('cours.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="Titre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Crédit</label>
            <input type="number" name="Crédit" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection