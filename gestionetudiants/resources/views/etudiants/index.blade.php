@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des étudiants</h1>

    <a href="{{ route('etudiants.create') }}" class="btn btn-primary mb-3">Ajouter un étudiant</a>

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
                    <a href="{{ route('etudiants.edit', $etudiant->IDEtudiant) }}"
                        class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('etudiants.destroy', $etudiant->IDEtudiant) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('POST')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                    </form>
                    <a href="{{ route('etudiants.assign', $etudiant->IDEtudiant) }}"
                        class="btn btn-sm btn-info">Assigner Cours</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection