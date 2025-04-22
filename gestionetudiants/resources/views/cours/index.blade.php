@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Cours</h1>

    <form method="GET" action="{{ route('cours.index') }}" class="mb-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher par titre..."
            class="form-control" />
        <button type="submit" class="btn btn-primary mt-2">Rechercher</button>
    </form>

    @if(count($cours) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Crédit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cours as $cour)
            <tr>
                <td>{{ $cour->IDCours }}</td>
                <td>{{ $cour->Titre }}</td>
                <td>{{ $cour->Crédit }}</td>
                <td>
                    <a href="{{ route('cours.edit', $cour->IDCours) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('cours.destroy', $cour->IDCours) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Aucun cours trouvé.</p>
    @endif
</div>
@endsection