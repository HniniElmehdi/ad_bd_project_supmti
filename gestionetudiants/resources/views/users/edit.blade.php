@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier Utilisateur</h1>

        <form action="{{ route('admin.users.update', $user->IDUser) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="Nom" value="{{ $user->Nom }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Prénom</label>
                <input type="text" name="Prénom" value="{{ $user->Prénom }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="Email" value="{{ $user->Email }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Date de naissance</label>
                <input type="date" name="DateNaissance"
                    value="{{ \Carbon\Carbon::parse($user->DateNaissance)->format('Y-m-d') }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label>Rôle</label>
                <select name="user_role" class="form-control" required>
                    <option value="admin" {{ $user->user_role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="professeur" {{ $user->user_role === 'professeur' ? 'selected' : '' }}>Professeur</option>
                    <option value="etudiant" {{ $user->user_role === 'etudiant' ? 'selected' : '' }}>Étudiant</option>
                </select>
            </div>
            <a href="{{ route('admin.users.index') }}"> cancel</a>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection