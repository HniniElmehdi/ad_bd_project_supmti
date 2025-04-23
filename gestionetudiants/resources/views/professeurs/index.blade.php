@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Professeurs</h1>


        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <a href="{{ route('register.form', 'professeur') }}" class="btn btn-primary mb-3">Ajouter Professeur</a>
        <form method="GET" action="{{ route('professeurs.index') }}" class="d-flex gap-2 mb-3">
            <select name="column" class="form-select w-auto">
                <option value="Nom" {{ request('column') == 'Nom' ? 'selected' : '' }}>Nom</option>
                <option value="Prénom" {{ request('column') == 'Prénom' ? 'selected' : '' }}>Prénom</option>
                <option value="Email" {{ request('column') == 'Email' ? 'selected' : '' }}>Email</option>
                <option value="TitreCours" {{ request('column') == 'TitreCours' ? 'selected' : '' }}>Cours Assigné</option>
            </select>

            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                placeholder="Rechercher..." />

            <button type="submit" class="btn btn-primary">Rechercher</button>

            @if(request('search'))
                <a href="{{ route('professeurs.index') }}" class="btn btn-secondary">Annuler</a>
            @endif
        </form>



        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Cours Assigné</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($professeurs as $prof)
                    <tr>
                        <td>{{ $prof->IDProfesseur }}</td>
                        <td>{{ $prof->Nom }}</td>
                        <td>{{ $prof->Prénom }}</td>
                        <td>{{ $prof->Email }}</td>
                        <td>{{ $prof->TitreCours ?? 'Non assigné' }}</td>
                        <td>
                            <a href="{{ route('professeurs.edit', $prof->IDProfesseur) }}"
                                class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('professeurs.destroy', $prof->IDProfesseur) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Supprimer ce professeur ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection