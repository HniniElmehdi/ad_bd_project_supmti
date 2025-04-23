@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4 text-center fw-bold text-primary">Liste des Utilisateurs</h1>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

    <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex gap-2 mb-3">
        <select name="column" class="form-select w-auto">
            <option value="Nom" {{ request('column') == 'Nom' ? 'selected' : '' }}>Nom</option>
            <option value="Prénom" {{ request('column') == 'Prénom' ? 'selected' : '' }}>Prénom</option>
            <option value="Email" {{ request('column') == 'Email' ? 'selected' : '' }}>Email</option>
        </select>

        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Rechercher..." />

        <button type="submit" class="btn btn-primary">Rechercher</button>

        @if(request('search'))
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Annuler</a>
        @endif
    </form>



        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Date de naissance</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->IDUser }}</td>
                            <td>{{ $user->Nom }}</td>
                            <td>{{ $user->Prénom }}</td>
                            <td>{{ $user->Email }}</td>
                            <td>{{ $user->DateNaissance }}</td>
                            <td>
                                <span class="badge bg-info text-dark text-uppercase">{{ $user->user_role }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->IDUser) }}"
                                    class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i> Modifier
                                </a>
                                <a href="{{ route('admin.users.resetPasswordForm', $user->IDUser) }}"
                                    class="btn btn-sm btn-outline-danger" title="renitialiser mot de passe ">
                                    <i class="bi bi-lock-fill"></i> Réinitialiser MDP
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection