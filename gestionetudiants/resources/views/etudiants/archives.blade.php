<!-- resources/views/etudiants/archives.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Archived Students</h1>
        <form method="GET" action="{{ route('etudiants.archives') }}" class="mb-3 d-flex align-items-center" role="search">
            <select name="column" class="form-select me-2" style="max-width: 200px;">
                <option value="Nom" {{ request('column') == 'Nom' ? 'selected' : '' }}>Nom</option>
                <option value="Prénom" {{ request('column') == 'Prénom' ? 'selected' : '' }}>Prénom</option>
                <option value="Email" {{ request('column') == 'Email' ? 'selected' : '' }}>Email</option>
                <option value="DateSuppression" {{ request('column') == 'DateSuppression' ? 'selected' : '' }}>Date de
                    Supression</option>
            </select>

            <input type="text" name="search" class="form-control me-2" placeholder="Rechercher..."
                value="{{ request('search') }}">

            <button type="submit" class="btn btn-outline-primary me-2">Rechercher</button>

            @if(request('search'))
                <a href="{{ route('etudiants.archives') }}" class="btn btn-outline-secondary">Annuler</a>
            @endif
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date De Naissance</th>
                    <th>Email</th>
                    <th>Date de Supression</th>
                </tr>
            </thead>
            <tbody>
                @foreach($archives as $student)
                    <tr>
                        <td>{{ $student->Nom }}</td>
                        <td>{{ $student->Prénom }}</td>
                        <td>{{ $student->DateNaissance }}</td>
                        <td>{{ $student->Email }}</td>
                        <td>{{ $student->DateSuppression }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection