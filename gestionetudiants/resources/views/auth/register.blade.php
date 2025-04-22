@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Register</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="Nom" class="form-label">Nom </label>
                <input type="text" class="form-control" id="Nom" name="Nom" value="{{ old('Nom') }}" required>
            </div>
            <div class="mb-3">
                <label for="Prénom" class="form-label">Prénom </label>
                <input type="text" class="form-control" id="Prénom" name="Prénom" value="{{ old('Prénom') }}" required>
            </div>
            <div class="mb-3">
                <label for="DateNaissance" class="form-label">DateNaissance </label>
                <input type="date" class="form-control" id="DateNaissance" name="DateNaissance"
                    value="{{ old('DateNaissance') }}" required>
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="Email" name="Email" value="{{ old('Email') }}" required>
            </div>
            <div class="mb-3">
                <label for="MotDePasse" class="form-label">Mot de Passe</label>
                <input type="password" class="form-control" id="MotDePasse" name="MotDePasse" required>
            </div>
            <div class="mb-3">
                <label for="MotDePasse_confirmation" class="form-label">Confirmer Mot de Passe</label>
                <input type="password" class="form-control" id="MotDePasse_confirmation" name="MotDePasse_confirmation"
                    required>
            </div>
            <div class="mb-3">
                <label for="user_role" class="form-label">Role</label>
                <select class="form-control" id="user_role" name="user_role">
                    <option value="etudiant" {{ old('user_role') == 'etudiant' ? 'selected' : '' }}>Etudiant</option>
                    <option value="professeur" {{ old('user_role') == 'professeur' ? 'selected' : '' }}>Professeur</option>
                    <option value="admin" {{ old('user_role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection