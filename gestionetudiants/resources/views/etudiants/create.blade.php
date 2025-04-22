@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un étudiant</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('etudiants.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="Nom">Nom</label>
            <input type="text" class="form-control" name="Nom" value="{{ old('Nom') }}" required>
        </div>

        <div class="form-group">
            <label for="Prénom">Prénom</label>
            <input type="text" class="form-control" name="Prénom" value="{{ old('Prénom') }}" required>
        </div>

        <div class="form-group">
            <label for="DateNaissance">Date de naissance</label>
            <input type="date" class="form-control" name="DateNaissance" value="{{ old('DateNaissance') }}" required>
        </div>

        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" class="form-control" name="Email" value="{{ old('Email') }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-2">Enregistrer</button>
    </form>
</div>
@endsection