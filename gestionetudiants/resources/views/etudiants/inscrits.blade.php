@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Étudiants Inscrits</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Étudiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de Naissance</th>
                <th>Âge</th>
                <th>Email</th>
                <th>ID Cours</th>
                <th>Titre du Cours</th>
                <th>Crédit</th>
                <th>Date d'Inscription</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($etudiants as $etudiant)
            <tr>
                <td>{{ $etudiant->IDEtudiant }}</td>
                <td>{{ $etudiant->NomEtudiant }}</td>
                <td>{{ $etudiant->PrénomEtudiant }}</td>
                <td>{{ $etudiant->DateNaissance }}</td>
                <td>{{ $etudiant->Age }}</td>
                <td>{{ $etudiant->Email }}</td>
                <td>{{ $etudiant->IDCours }}</td>
                <td>{{ $etudiant->TitreCours }}</td>
                <td>{{ $etudiant->Crédit }}</td>
                <td>{{ $etudiant->DateInscription }}</td>
                <td>
                    <a href="{{ route('inscriptions.edit', $etudiant->IDInscription) }}"
                        class="btn btn-primary btn-sm">Modifier</a>

                    <form action="{{ route('inscriptions.destroy', $etudiant->IDInscription) }}" method="POST"
                        style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer cette inscription ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection