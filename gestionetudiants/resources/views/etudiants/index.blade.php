@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des étudiants</h1>


        @if (auth()->user()->user_role === 'admin')
            <a href="{{ route('register.form', 'etudiant') }}" class="btn btn-primary mb-3">Ajouter un étudiant</a>
        @endif
        <form method="GET" action="{{ route('etudiants.index') }}" class="mb-3 d-flex align-items-center" role="search">
            <select name="column" class="form-select me-2" style="max-width: 200px;">
                <option value="Nom" {{ request('column') == 'Nom' ? 'selected' : '' }}>Nom</option>
                <option value="Prénom" {{ request('column') == 'Prénom' ? 'selected' : '' }}>Prénom</option>
                <option value="Email" {{ request('column') == 'Email' ? 'selected' : '' }}>Email</option>
            </select>

            <input type="text" name="search" class="form-control me-2" placeholder="Rechercher..."
                value="{{ request('search') }}">

            <button type="submit" class="btn btn-outline-primary me-2">Rechercher</button>

            @if(request('search'))
                <a href="{{ route('etudiants.index') }}" class="btn btn-outline-secondary">Annuler</a>
            @endif
        </form>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($etudiants as $etudiant)
                    <tr>
                        <td>{{ $etudiant->IDEtudiant }}</td>
                        <td>{{ $etudiant->Nom }}</td>
                        <td>{{ $etudiant->Prénom }}</td>
                        <td>{{ $etudiant->DateNaissance }}</td>
                        <td>{{ $etudiant->Email }}</td>
                        <td>
                            @if (auth()->user()->user_role === 'admin')
                                <a href="{{ route('etudiants.edit', $etudiant->IDEtudiant) }}"
                                    class="btn btn-sm btn-warning">Modifier</a>
                                <form action="{{ route('etudiants.destroy', $etudiant->IDEtudiant) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                </form>
                            @endif
                            <a href="{{ route('etudiants.assign', $etudiant->IDEtudiant) }}"
                                class="btn btn-sm btn-info">Assigner Cours</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection